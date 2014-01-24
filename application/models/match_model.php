<?php
class match_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'match_score';
    }    
    
    /**
     * Converts the selected LANGUAGE LEVELS into a format of MATCH-SCORE table.
     * 
     * Received array of LANGUAGE LEVELS selected. 
     * We need to create convert each Language into THREE DIGITS by adding ZERO/ZEROES as prefix. Then combine both values (LANGUAGE & LEVEL)
     * Then combine all language levels with a COMMA SEPARATION. 002001,009008 OR 001023
     * 
     * Received Array format is: [0] => ([job_id] => 98[language] => 7[level] => 2) [1] => (same)
     * 
     * @param type $language_level_array
     * @return type ARRAY
     */    
    public function generateLanguageLevelInfo($language_level_array)
    {
        foreach($language_level_array as $info)
        {
            $language       =  str_pad($info['language'],3, "0", STR_PAD_LEFT);
            $level          =  str_pad($info['level'],3, "0", STR_PAD_LEFT);
            
            $return[]       =   $language.$level;
        }
        
        $combined_language_level    =   implode(',',$return);
        
        return $combined_language_level;
    }

    
    /**
     * Received an array of the selected LANGUAGES & its LEVELS. We are creating an array using this.
     */    
    public function generateLanguageLevelInfoUsingText($language_level_array)
    {  
        $language_arr       =   language_arr();
        $language_level     =   language_level();
        
        foreach($language_level_array as $info)
        {
            $language_key   =       array_search($info['language'], $language_arr);
            $language_key++;        // Key starting from ZERO. I got this logic from VIEW PAGE.
            $language_key   =       str_pad($language_key,3, "0", STR_PAD_LEFT);
            
            $level_key      =       array_search($info['level'], $language_level);
            $level_key++;           // Key starting from ZERO. I got this logic from VIEW PAGE.
            $level_key      =       str_pad($level_key,3, "0", STR_PAD_LEFT);
            
            $return[]       =       $language_key.$level_key;
        }
        
        $combined_language_level    =   implode(',',$return);        
        return $combined_language_level; 
    }    
    
    
    /**
     * Converts the selected INDUSTRY POSITION into a format of MATCH-SCORE table.
     * 
     * Received array of INDUSTRY POSITIONS selected. Other logic is same as of "generateLanguageLevelInfo" function.
     * 
     * It received the VALUES from database rather than IDS, so we need to find ID firstly.
     * 
     * Received Array format is: [0] => Array([job_id] => 102 [industry] => Administration and Office Support [position] => Company Secretaries)
     * 
     * @return type ARRAY
     */    
    public function generateIndustryPositionInfo($industry_position_array)
    {
        foreach($industry_position_array as $info)
        {            
            $sql            =       "SELECT id from industry WHERE name='".$info['industry']."' AND parent='0'";        
            $result         =       $this->db->query($sql)->row();        
            $industry       =       str_pad($result->id,3, "0", STR_PAD_LEFT);   

            $sql            =       "SELECT id from industry WHERE name='".$info['position']."' AND parent='".$info['industry']."' ";        
            $result         =       $this->db->query($sql)->row();        
            $position       =       str_pad($result->id,3, "0", STR_PAD_LEFT);

            $return[]       =       $industry.$position;
        }
        
        $combined_industry_position    =   implode(',',$return);
        
        return $combined_industry_position;
    }

    /**
     * Inserts the values into the MATCH-SCORE table.
     * 
     * The record may either USER or JOB related. The values of uid or job_id decides this specification of the RECORD.
     * 
     * Called from JOB-POSTING or User SIGN-UP pages. 
     */    
    public function insertRecord($match_score_info)
    {
        $this->db->insert('match_score', $match_score_info);
    }
    
            
    /**
     * It checks whether the USER or JOB has a record in MATCH-SCORE. If not, create one record. 
     * 
     * Called from EDIT-PROFILE and UPDATE-JOB pages.
     * 
     */    
    public function createRecordIfNotExists($user_id=0,$job_id=0)
    {
        if($user_id)
        {
            $where              =       'uid='.$user_id;
            $match_score_info   =       array('uid' =>  $user_id);
        }            
        else
        {
            $where              =       'job_id='.$job_id;
            $match_score_info   =       array('job_id' =>  $job_id);
        }  
        
        $query                  =       $this->db->query("SELECT id from match_score WHERE $where");

        if($query->num_rows()==0)
            $this->insertRecord($match_score_info);
    }            
            
    
    /**
     * Update MATCH-SCORE table. There is no updation for Industry-Position.
     * 
     */    
    public function updateRecordUsingJobID($job_id,$match_score_info)
    {
        $this->db->where('job_id', $job_id)->update($this->table, $match_score_info);
    }    
    
    /**
     * Update MATCH-SCORE table. There is no updation for Industry-Position.
     * 
     */    
    public function updateRecordUsingUserID($user_id,$match_score_info)
    {
        $this->db->where('uid', $user_id)->update($this->table, $match_score_info);
    }      
    
    
    /**
     * Employment Type may have one or more values which are separated by a comma. Comma present only if there is more than one element. 
     * 
     * Function selects the Unique IDs of each Employment Types from database. Then create a SINGLE STRING and return that value.
     * 
     * The USER-REG page allows to select zero or more options. 
     */    
    public function getEmploymentTypeId($employment_type='')
    {
        if($employment_type=='')
            return '';
        
        $types          =       explode(',',$employment_type);
        
        foreach($types as $type_info)
        {
            $sql            =       "SELECT id from employment_type WHERE employment_type='".$type_info."'"; 
            $result         =       $this->db->query($sql)->row();  
            $final[]        =       $result->id;             
        }   
        
        return implode(',',$final);
            
    }  
    
    /**
     * Generates the MATCH PERCENTAGE for all JOBS received against the User-ID passed into the function call.
     * 
     * This function is written for Find Match Percentage when a USER uses FIND-JOBS interface. So the naming are related for that initial case.
     * 
     * I have modified this function to be used for FIND-USER-PROFILES. Here we check all users against a specific JOB. 
     * FIND-STAFF can be easily understand by the value "job_id" and "user_id" is zero in this case.
     *   1. So we receive the USERS-ARRAY rather JOBS array.
     *   2. We receive JOB-ID to fetch its specific score info.
     *   
     * Three main changes when we go for a FIND-STAFF using the same function and are:
     *   1. Read Match Score record of the Job.
     *   2. In the LANGUAGE-LEVEL checking, we check SEEKER LEVEL is Greater than or Equal to Job-Level.
     *   3. For $e & $f calculations, we consider the values from "job-listing" rather users.  
     * 
     */    
    public function jobMatchPercentageForUser($jobs,$user_id=0,$job_id=0)
    {   
        if($user_id)
            $where_case         =       "uid=$user_id";
        else
            $where_case         =       "job_id=$job_id";
        $query                  =       $this->db->query("SELECT employment_type, employment_length, is_visa_assistance, is_housing_assistance, language_level, industry_position  from match_score WHERE $where_case");
        
        if($query->num_rows()==0) // User doesn't have a record in MATCH-SCORE table.
            return $jobs; 

        // Retrieve record if present.
        $msuser_info                =       $query->row();
        
        $skip_employment_type = $skip_employment_length =   $skip_is_visa_assistance =    $skip_is_housing_assistance = $skip_language_level =  $skip_industry_position = FALSE;
        
        
        // Employment Type may contain one or more values separated by comma.
        if($msuser_info->employment_type == '') // ie No value inside this. We need to skip this checking.
            $skip_employment_type           =   TRUE;
        else
            $msuser_employment_types        =       explode(',',$msuser_info->employment_type);
        
        // If not SKIPPED, two NULL selection get full point.
        if($msuser_info->employment_length == '') // ie No value inside this. We need to skip this checking.
            $skip_employment_length         =   TRUE; 
        
        // If not SKIPPED, two NULL selection get full point.
        if($msuser_info->is_visa_assistance == '') // ie No value inside this. We need to skip this checking.
            $skip_is_visa_assistance        =   TRUE;          
        
        // If not SKIPPED, two NULL selection get full point.
        if($msuser_info->is_housing_assistance == '') // ie No value inside this. We need to skip this checking.
            $skip_is_housing_assistance     =   TRUE;             
        
        // If not SKIPPED, two NULL selection get full point.
        if($msuser_info->language_level == '') // ie No value inside this. We need to skip this checking.
            $skip_language_level            =   TRUE;
        else
        {
            $msuser_language_level          =       explode(',',$msuser_info->language_level);
            
            if(count($msuser_language_level) > 0 AND is_array($msuser_language_level) == TRUE )
            {
                foreach ($msuser_language_level as $msuser_language_level_info):
                    $tmp                                    =     substr($msuser_language_level_info, 0, 3);
                    $msuser_language[]                      =     $tmp;   
                    $msuser_level[$tmp]                     =     substr($msuser_language_level_info, 3, 3);  
                endforeach;
            }
        }
        
        // If not SKIPPED, two NULL selection get full point.
        if($msuser_info->industry_position == '') // ie No value inside this. We need to skip this checking.
            $skip_industry_position         =   TRUE;
        else
        {
            $msuser_industry_position       =       explode(',',$msuser_info->industry_position);
            
            if(count($msuser_industry_position) > 0 AND is_array($msuser_industry_position) == TRUE )
            {
                foreach ($msuser_industry_position as $msuser_industry_position_info):
                    $tmp                                    =     substr($msuser_industry_position_info, 0, 3);
                    $msuser_industry[]                      =     $tmp;   
                    $msuser_position[$tmp]                  =     substr($msuser_industry_position_info, 3, 3);  
                endforeach;
            }
        }
        
        
         
       foreach($jobs as $job_key => $job)
       {
           $a=$b=$c=$d=$e=$f = $total_msjob_language_level = $total_msjob_industry_position   =    $match=   0;  // Reset all values.
           // Emplyment Type
           if($skip_employment_type==FALSE AND $job['msjob_employment_type'] != '') // Both values doesn't EMPTY.
           {
               $msjob_employment_types      =       explode(',',$job['msjob_employment_type']);               
               $tmp_result                  =       array_intersect($msuser_employment_types, $msjob_employment_types);               
               if(count($tmp_result)> 0) // Match Found. 
                    $a                      =       10;
           }          
           
           // Employment Length
           if($skip_employment_length == FALSE AND ($msuser_info->employment_length == $job['msjob_employment_length']))
           {
                    $b                      =       10; 
           }
           
           // Visa Assistance (Either match or User selected "No Visa Assistance" option.
           if($skip_is_visa_assistance == FALSE AND ( ($msuser_info->is_visa_assistance == $job['msjob_is_visa_assistance']) OR ($msuser_info->is_visa_assistance == 2) ) )
           {
                    $c                      =       15;
           }        
            
           // Housing Assistance (Same for VISA logic)
           if($skip_is_housing_assistance == FALSE AND ( ($msuser_info->is_housing_assistance == $job['msjob_is_housing_assistance']) OR ($msuser_info->is_housing_assistance == 2) ))
           {
                    $d                      =       15;
           }                
           
           // Language Level
           if($skip_language_level == FALSE)
           {
                $msjob_language_level                          =       explode(',',$job['msjob_language_level']);

                if(count($msjob_language_level) > 0 AND is_array($msjob_language_level) == TRUE ) // Minimum one Language Level is selected.
                {
                    if($user_id)
                        $total_msjob_language_level             =     count($msjob_language_level); // Final Match works related. Job Listing Count  
                    else
                        $total_msjob_language_level             =     count($msuser_language_level); // Final Match works related. Job Listing Count  
                    
                    foreach ($msjob_language_level as $msjob_language_level_info):
                        
                        $msjob_language                         =     substr($msjob_language_level_info, 0, 3);
                        $msjob_level                            =     substr($msjob_language_level_info, 3, 3);  
                        
                        if(in_array($msjob_language,$msuser_language)): // language is matched.
                            $e                                  =       $e + 15; 
                        
                            if($user_id) // Sekker Level against Job Seeker 
                            {
                                if($msuser_level[$msjob_language] >= $msjob_level): // Seeker Level also matched or greater.
                                    $e                              =       $e + 10; 
                                endif;
                            }        
                            else
                            {
                                if($msjob_level >= $msuser_level[$msjob_language]): // Seeker Level also matched or greater.
                                    $e                              =       $e + 10; 
                                endif;
                            }
                            
                        endif;
                        
                    endforeach;
                }
           }
           
           // Industry Position
           if($skip_industry_position == FALSE)
           {
                $msjob_industry_position                       =       explode(',',$job['msjob_industry_position']);

                if(count($msjob_industry_position) > 0 AND is_array($msjob_industry_position) == TRUE ) // Minimum one Industry Position is selected.
                {
                    if($user_id)
                        $total_msjob_industry_position          =     count($msjob_industry_position); // Final Match works related 
                    else
                        $total_msjob_industry_position          =     count($msuser_industry_position); // Final Match works related  
                        
                     foreach ($msjob_industry_position as $msjob_industry_position_info):
                        
                        $msjob_industry                         =     substr($msjob_industry_position_info, 0, 3);
                        $msjob_position                         =     substr($msjob_industry_position_info, 3, 3);  
                        
                        if(in_array($msjob_industry,$msuser_industry)): // Industry is matched.
                            $f                                  =       $f + 15; 
                            if($msuser_position[$msjob_industry] == $msjob_position): // Seeker Position also matched.
                                $f                              =       $f + 10; 
                            endif;
                        endif;
                        
                    endforeach;
                }
           }   

           // Final Match Percentage Calculation           
           $final_value             =   $a + $b + $c + $d;
           if($e > 0)
            $final_value            =   $final_value + ($e / $total_msjob_language_level);
           
           if($f > 0)
            $final_value            =   $final_value + ($f / $total_msjob_industry_position);    

           $match                   =   round( ($final_value*99)/100 );
          
           $jobs[$job_key]['match'] =   $match;
       }
       
       return $jobs;
            
    }     
    
   
}