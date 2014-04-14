<?php
class job_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'job';
    }

    public function getJobInfo($id) {
        $result = $this->db->select('*,job.id as id')
            ->from('job')
            ->join('job_language_level', 'job.id = job_language_level.job_id', 'left')
            ->where('job.id',$id)
            ->get()
            ->result_array();
        if (isset($result[0]))    
            return $result[0];
        else
            return array();
    }

    public function getCompanyJobList($company_id) {
        $result = $this->db->select('*')
            ->from('job')
            ->where('company_id',$company_id)
            ->where('job_status_id',2)    
            ->get()
            ->result_array();
        if (isset($result))    
            return $result;
        else
            return array();
    }
    public function getSimilarJobs($id, $industry) {
        $sql = "SELECT job_id FROM job_industry_position WHERE industry = '$industry'";
        $result = $this->db->query($sql)->result_array();
        $id_array = array();
        foreach ($result as $value) {
            // If current job id, don't put into select
            if ($value['job_id'] == $id) continue;
            $id_array[] = $value['job_id'];
        }
        $str = implode(',', $id_array);
        if (!empty($str)) {
            $sql = "SELECT * FROM job 
                    WHERE job.id in ($str)";

            $rtn = $this->db->query($sql)->result_array();

            return $rtn;
        }
        return array();
    }
    
    public function saveJob($data) {
        $this->db->insert('job', $data);
        return $this->db->insert_id();
    }

    public function updateJob($id, $data) {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    public function insertJobLanguage($data) {
        return $this->db->insert('job_language_level', $data);
    }

    public function getJobLanguages($id) {
        $sql = "SELECT language,level from job_language_level WHERE job_id=$id";

        return $this->db->query($sql)->result_array();
    }

    public function updateJobLanguage($data) {
        $sql = "UPDATE job_language_level SET language='".$data['language']."',level='".$data['level']."' WHERE id=".$data['id'];
        $this->db->query($sql);
    }

    public function insertJobIndustry($data) {
        return $this->db->insert('job_industry_position', $data);
    }

    public function getJobIndustry($id) {
        $sql = "SELECT industry,position from job_industry_position WHERE job_id=$id";

        return $this->db->query($sql)->result_array();
    }
    
    /**
     * SORT Function for sorting the JOBS array by MATCH-SCORE.
     * 
     * Used in Search/Job and Search/Staff results during MATCH-SCORE find.
     */
    public function sortJobsByMatchScore($x, $y) //sortJobsByMatchScore
    {
        if ( $x['match'] == $y['match'] )
            return 0;
        else if ( $x['match'] > $y['match'] )
            return -1;
        else
            return 1;
    }    
    
    /**
     * Copy of "searchJob" function. if more than one LANGUAGE available for a JOB then "this"searchJob" function shows duplicate records
     *  to the number of times equal to number of LANGUAGES added.
     * 
     * To resolved this, I have written this. This function doesn't fetch LANGUAGE information in the Query .. 
     * for this, removed the LEFT JOIN with that table & its table fields.
     * 
     * NOTE: I am replacing all places which calls the old function. But there may be other pages and so I am keeping both functions.
     * 
     * Modified on FEB/20/2014
     * 
     */    
    public function searchJobUnique($where)
    {
          $sql = "SELECT *,job.id as id, job.country as country, job.province as province, job.city as city,
                job.employment_length as employment_length, job.employment_type employment_type,
                u.username as company_name, job.company_id as company_id, u.description as description,
                job.is_visa_assistance, job.is_visa_assistance,
                ms.employment_type as msjob_employment_type,
                ms.employment_length as msjob_employment_length,
                ms.is_visa_assistance as msjob_is_visa_assistance,
                ms.is_housing_assistance as msjob_is_housing_assistance,
                ms.language_level as msjob_language_level,
                ms.industry_position as msjob_industry_position
                          FROM job
                          LEFT JOIN user as u on job.company_id=u.uid
                          LEFT JOIN job_industry_position as jip on job.id=jip.job_id
                          LEFT JOIN match_score as ms on job.id=ms.job_id".$where."  ORDER BY job.post_date DESC";
          $rtn = $this->db->query($sql)->result_array();
          return $rtn;
      }    
    

    public function searchJob($where){
        $sql = "SELECT *,job.id as id, job.country as country, job.province as province, job.city as city,jl.language as language,
              job.employment_length as employment_length, job.employment_type employment_type,
              u.username as company_name, job.company_id as company_id, u.description as description,
              job.is_visa_assistance, job.is_visa_assistance,
              ms.employment_type as msjob_employment_type,
              ms.employment_length as msjob_employment_length,
              ms.is_visa_assistance as msjob_is_visa_assistance,
              ms.is_housing_assistance as msjob_is_housing_assistance,
              ms.language_level as msjob_language_level,
              ms.industry_position as msjob_industry_position
        		FROM job 
        		LEFT JOIN user as u on job.company_id=u.uid LEFT JOIN job_language_level as jl on job.id=jl.job_id
        		LEFT JOIN job_industry_position as jip on job.id=jip.job_id
                        LEFT JOIN match_score as ms on job.id=ms.job_id".$where;

        $rtn = $this->db->query($sql)->result_array();
        return $rtn;
    }

    public function searchBookmarkedJob($where) {
        $sql = "SELECT *,jb.job_id as id, job.city as city,jl.language as language,
              job.employment_length as employment_length, job.employment_type employment_type,
              c.username as company_name,job.company_id as company_id
        		FROM job_bookmark as jb
        		LEFT JOIN job on job.id=jb.job_id LEFT JOIN job_language_level as jl on job.id=jl.job_id
        		LEFT JOIN job_industry_position as jip on job.id=jip.job_id
        		LEFT JOIN user c on job.company_id=c.uid".$where;

        $rtn = $this->db->query($sql)->result_array();
        return $rtn;
    }

    public function searchStaff($where) {
        $sql = "SELECT u.*
        		FROM user as u
        		LEFT JOIN user_language as ul on ul.uid=u.uid
              LEFT JOIN user_seeking_industry as usi on usi.uid=u.uid
              LEFT JOIN user_personal_skills as ups on ups.uid=u.uid
              LEFT JOIN user_professional_skills as upfs on upfs.uid=u.uid".$where . " GROUP BY u.uid";

        $rtn = $this->db->query($sql)->result_array();
        return $rtn;
    }

    public function searchJobseeker($where,$jobid=0)  // JOB ID is only passed from FIND JOB section as part of MATCH% calculation.
    {
        if($jobid)
        {
            $sql    =   'SELECT 
                                    user.*, 
                                    ms.employment_type as msjob_employment_type,
                                    ms.employment_length as msjob_employment_length,
                                    ms.is_visa_assistance as msjob_is_visa_assistance,
                                    ms.is_housing_assistance as msjob_is_housing_assistance,
                                    ms.language_level as msjob_language_level,
                                    ms.industry_position as msjob_industry_position 
                        FROM    user 
                                LEFT JOIN match_score as ms on user.uid=ms.uid '.$where;
        }
        else // OLD COde as it is.
            $sql = "SELECT * FROM user ".$where;        

        // ALWAYS sorting results on the DESC order of ID. ie Recent Profile firstly. We don't have DATE of REgistration.
        $sql    =   $sql.' ORDER BY user.uid DESC';
        
        $rtn = $this->db->query($sql)->result_array();
        return $rtn;
    }
    
    /**
     * Recently Approved Jobs.
     * 
     * Displayed in many places: Index Bottom, Find Job - Bottom, Job Details - Right Menu etc 
     */
    public function getRecentJobs($limit = 4) {
    	$sql = 'SELECT *, job.city as city FROM job LEFT JOIN user as u on job.company_id=u.uid WHERE job_status_id=2 ORDER BY job.post_date DESC LIMIT 0,'.$limit;
    	return $this->db->query($sql)->result_array();
    }

    /**
     * APPLY JOB
     **/
    public function applyJob($job_id, $uid, $status) {
        $sql = "REPLACE INTO job_apply values($job_id, $uid, $status, now());";
        return $this->db->query($sql);
    }

    public function getAppliedJobByUser($uid, $filter = '') {
        //$sql = "SELECT * FROM job_apply WHERE user_id = $uid";
        //return $this->db->query($sql)->result_array();

        $result = $this->db->select('*')
            ->from('job_apply')
            ->join('job', 'job.id=job_apply.job_id')
            ->join('user', 'job.company_id=user.uid')
            ->where('user_id',$uid)
            ->like('job_name',$filter)
            ->order_by('post_date','desc')
            ->get()
            ->result_array();
        if (isset($result))    
            return $result;
        else
            return array();
    }

    public function getJobLang($job_id) {
        $sql = "SELECT * FROM job_language_level WHERE job_id = $job_id";
        return $this->db->query($sql)->result_array();
    }
    
    public function delJobLang($job_id) {
    	$this->table = 'job_language_level';
    	return $this->delete($job_id, 'job_id');
    }

    public function bookmarkJob($job_id, $uid) {
        $sql = "REPLACE INTO job_bookmark values($uid, $job_id)";
        return $this->db->query($sql);
    }

    public function getBookmarkedJobByUser($uid) {
        $sql = "SELECT * FROM job_bookmark WHERE user_id = $uid";
        return $this->db->query($sql)->result_array();
    }

    public function deleteBookmarkedJob($job_id, $uid) {
        $sql = "DELETE FROM job_bookmark WHERE user_id=$uid and job_id=$job_id";
        return $this->db->query($sql);
    }
    
    public function bookmarkCompany($company_id, $uid) {
        $sql = "REPLACE INTO company_bookmark values($uid, $company_id)";
        return $this->db->query($sql);
    }

    public function getBookmarkedCompanyByUser($uid) {
        $sql = "SELECT * FROM company_bookmark WHERE user_id = $uid";
        return $this->db->query($sql)->result_array();
    }

    public function deleteBookmarkedCompany($company_id, $uid) {
        $sql = "DELETE FROM company_bookmark WHERE user_id=$uid and company_id=$company_id";
        return $this->db->query($sql);
    }

    public function deleteJob($id) {
        $sql = "DELETE FROM job WHERE id=$id";
        return $this->db->query($sql);
    }
    
    /**
     * Check whether the Job is accessible to this Logged In person or Guest.
     * 
     * Job is accessible only if it is on APPROVED STATUS.
     * But the Job Owner & Site Administrator can access Job Details page even on the Denied & UnApproved Status case also.
     */
    public function isAccessible($job_id,$job_company_id,$job_status_id)
    {
        if($job_id=='' OR $job_company_id=='' OR $job_status_id=='')
        {
            $error  =   TRUE;
        }
       
        if($error == FALSE AND $this->session->userdata('isadmin')==1)
            $accessible  =   TRUE;
        elseif($error == FALSE AND ($this->session->userdata('uid')==$job_company_id))
            $accessible  =   TRUE;
        elseif($error == FALSE AND $job_status_id==2)
            $accessible  =   TRUE;        
        else
            $error      =   TRUE;
        
        if($error==FALSE)
            return TRUE;
        else
            return FALSE;
    }        
}