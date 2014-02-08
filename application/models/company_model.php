<?php
class company_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->table = 'user';
	}

    /**
     * Get Company Basic info.
     * @param  int $company_id Company ID
     * @return Array             Company info in key-array
     */
	public function getCompanyInfo($company_id)
	{
		$data = $this->db->select('company.*')
						->from('company')
						->where('company_id', $company_id)
						->get()
						->result_array();
		return $data;
	}

	/**
	 * Get Job list for a company.
	 * @param  int $company_id Company Id
	 * @return arrayList             Job list array
	 */
	public function getJobsByCompanyId($company_id)
	{
		$data = $this->db->select('*')
						 ->from('job')
						 ->where('company_id', $company_id)
						 ->get()
						 ->result_array();

		return $data;						 
	}

    public function getUserInfo($uid) {
        $result = $this->db->select('*')
            ->from('user')
            ->where('uid',$uid)
            ->get()
            ->result_array();

        return $result[0];
    }

	/**
	 * Add new Company
	 * @param int $data Last insert id
	 */
	public function updateBasicInfo($data)
	{
		$uid = $data['uid'];
		$data = array('first_name'=>$data['name'],'country'=>$data['country'],'province'=>$data['province'],'city'=>$data['city'],
				'profile_pic'=>$data['avatar'], 'description'=>$data['description']);
		$this->db->where('uid', $uid);
		$this->db->update('user', $data); 
		if (isset($_POST['industry_tag'])) {
			$this->addIndustry($uid, $_POST['industry_tag']);
		}
        return true;
	}

	public function updateContactDetail($data) {
		$uid = $data['uid'];
		$data = array('last_name'=>$data['last_name'],
				'email'=>$data['email'],'phone'=>$data['phone'],'is_allow_phone'=>$data['is_allow_phone'],
				'jingchat_username'=>$data['jingchat_username'],'is_allow_online_msg'=>$data['is_allow_online_msg'],
				'personal_website'=>isset($data['personal_website'])?$data['personal_website']:"",
				 'twitter'=>isset($data['twitter'])?$data['twitter']:"", 'linkedin'=>isset($data['linkedin'])?$data['linkedin']:"",
				  'facebook'=>isset($data['facebook'])?$data['facebook']:"",'weibo'=>isset($data['weibo'])?$data['weibo']:"");
		$this->db->where('uid', $uid);
		$this->db->update('user', $data); 
	}

	public function addIndustry($company_id, $data) 
	{
		$arr = explode(',', $data);
		$this->db->delete('company_industry', array('company_id'=>$company_id));

		foreach($arr as $industry) {
			$data = array("company_id" => $company_id, "industry" => $industry);
			$this->db->insert('company_industry', $data);
		}
	}

	public function getIndustry($company_id) {
		$result = $this->db->select('*')
            ->from('company_industry')
            ->where('company_id',$company_id)
            ->get()
            ->result_array();
        return $result;
	}

	public function getSimilarCompanys($company_id, $industry)
	{
		
	}
	
	public function searchCompany($where) {
        $sql = "SELECT u.uid as company_id, description,username as name,city
        		FROM user as u
        		LEFT JOIN company_industry as ci on ci.company_id=u.uid".$where;

        $rtn = $this->db->query($sql)->result_array();
        return $rtn;
    }

    public function searchBookmarkedCompany($where) {
        $sql = "SELECT u.uid as company_id, description,username as name,city,profile_pic
        		FROM user as u
        		LEFT JOIN company_industry as ci on ci.company_id=u.uid
        		LEFT JOIN company_bookmark as cb on cb.company_id=u.uid".$where;

        $rtn = $this->db->query($sql)->result_array();
        return $rtn;
    }

    public function deleteBookmarkedCompany($id, $uid) {
        $sql = "DELETE FROM company_bookmark WHERE user_id=$uid and company_id=$id";
        return $this->db->query($sql);
    }


    public function getUsersWhoAppliedJobForCompany($company_id) {

    	// Get user_id array
    	$where = "job_id in (SELECT job_id FROM job where company_id = ".$company_id.")";
 		$result = $this->db->select('user_id')->distinct()
            			   ->from('job_apply')
            			   ->where($where)
            			   ->get()
            			   ->result_array();

        // Get detail user info by user ids.
		$user_array = array();            			
		$select_sql = "";
		if (empty($result)) {
			return array();
		}
        foreach ($result as $user_id) {
        	array_push($user_array, $user_id['user_id']);
        }
        
        $user_result = $this->db->select('*')->from('user')->where_in('uid',$user_array)
        		 ->get()->result_array();

        return $user_result;   	
    }

    public function getCandidatesForCompany($company_id, $filter = '') {
        $where = "uid in (SELECT user_id FROM company_candidate where company_id = ".$company_id.")";
        $result = $this->db->select('*')
                           ->from('user')
                           ->where($where)
                           ->like('first_name',$filter)
                           ->get()
                           ->result_array();
        return $result;                    
    }

    public function addCandidate($data) {
    	$result = $this->db->select('*')
    						 ->from('company_candidate')
    						 ->where('company_id',$data['company_id'])
    						 ->where('user_id', $data['user_id'])
    						 ->get()->result_array();

    	if (empty($result)) {
    		$this->db->insert('company_candidate', $data);
    	} else {
    		$this->deleteCandidate($data['company_id'], $data['user_id']);
    	}
    	
        return $this->db->insert_id();
    }

    /*
     *  Get Shortlist candidates for company.
	 *  @param company_id   
	 *  @return jobseeker array
     */
    public function getCandidateIdForCompany($uid) {
    	return $this->db->select('*')
    			 ->from('company_candidate')
    			 ->where('company_id', $uid)
    			 ->get()
    			 ->result_array();
    }

    public function deleteCandidate($company_id, $uid) {
        $sql = "DELETE FROM company_candidate WHERE company_id=$company_id and user_id=$uid";
        return $this->db->query($sql);
    }

    /**
     * When user view a company, record it
     */
    public function saveCompanyViewed($uid, $company_id, $date) {
        $sql = "REPLACE INTO company_viewed values($uid, $company_id, '$date');";
        return $this->db->query($sql);
    }
    
    public function getApplicants($jobid) {
    	$sql = 'SELECT * FROM job_apply 
				LEFT JOIN user 
    			ON user.uid = job_apply.user_id
    			WHERE job_apply.job_id = '.$jobid;
    	return $this->db->query($sql)->result_array();
    }
    
    
    /**
     * Account Deletion to remove records from all tables which are having UID field. 
     * Same function is used during User & Company profile deletion cases.
     */
    public function deleteRecordsUsingUID($uid)
    {
        // We have company_id but it is same to uid.
        $this->db->delete('job', array('company_id' => $uid));
        $this->db->delete('interview', array('company_id' => $uid));
        $this->db->delete('company_viewed', array('company_id' => $uid));
        $this->db->delete('company_social', array('company_id' => $uid));
        $this->db->delete('company_industry', array('company_id' => $uid));
        $this->db->delete('company_candidate', array('company_id' => $uid));
        $this->db->delete('company_bookmark', array('company_id' => $uid));
        $this->db->delete('company', array('company_id' => $uid));
        
        
        // Here the field name is user_id. I assumes it is same to uid.
        $this->db->delete('company_bookmark', array('user_id' => $uid));
        $this->db->delete('company_candidate', array('user_id' => $uid));
        $this->db->delete('job_apply', array('user_id' => $uid));
        $this->db->delete('job_bookmark', array('user_id' => $uid)); 
        
        
        // Two Tables - I think only for ADMIN User.
        $this->db->delete('article', array('uid' => $uid));
        $this->db->delete('admin', array('uid' => $uid));
        
        $this->db->delete('company_viewed', array('uid' => $uid));
        $this->db->delete('interview', array('uid' => $uid));
        $this->db->delete('match_score', array('uid' => $uid)); 
        $this->db->delete('portfolio_project', array('uid' => $uid)); 
        $this->db->delete('user', array('uid' => $uid));        
        $this->db->delete('user_education', array('uid' => $uid));        
        $this->db->delete('user_industry_position', array('uid' => $uid));         
        $this->db->delete('user_language', array('uid' => $uid));         
        $this->db->delete('user_personal_skills', array('uid' => $uid));         
        $this->db->delete('user_professional_skills', array('uid' => $uid));  
        $this->db->delete('user_seeking_industry', array('uid' => $uid)); 
        $this->db->delete('user_social', array('uid' => $uid)); 
        $this->db->delete('user_status', array('uid' => $uid)); 
        $this->db->delete('user_work_history', array('uid' => $uid));
    }   
    
    /**
     * Finding the job postings done by this specific User.
     * 
     * Here we pass the uid from SESSION. But in the job table, this field is named as "company_id".
     * One user can able associated with one company and it is clear in that way.
     * 
     */
    public function readJobIDS($company_id)
    {
     	$sql    =   'SELECT id FROM job WHERE company_id='.$company_id;
    	return $this->db->query($sql)->result_array();
    }    
    
    
    /**
     * Receive an array of the job ids (job table) which this user is posted.
     * Remove those records.
     * 
     */    
    public function deleteRecordsUsingJobID($job_ids)
    {

        $string_job_ids     =   implode(',', $job_ids);
        
        $sql = 'DELETE FROM interview WHERE job_id IN('.$string_job_ids.')';
        $this->db->query($sql);          
        
        $sql = 'DELETE FROM job_apply WHERE job_id IN('.$string_job_ids.')';
        $this->db->query($sql);          
        
        $sql = 'DELETE FROM job_bookmark WHERE job_id IN('.$string_job_ids.')';
        $this->db->query($sql);        
       
        $sql = 'DELETE FROM job_industry_position WHERE job_id IN('.$string_job_ids.')';
        $this->db->query($sql);
        
        $sql = 'DELETE FROM job_language_level WHERE job_id IN('.$string_job_ids.')';
        $this->db->query($sql); 
        
        $sql = 'DELETE FROM match_score WHERE job_id IN('.$string_job_ids.')';
        $this->db->query($sql); 
    }    
    
    /**
     * Records which are saved during CHAT. Table name is "inbox".
     * 
     * The chat is done between two users (ie user1 and user2 ) 
     * Each time any of this person respond, there is a "seq" incrementation also happening.
     * "id" value will be same for all time in between "user1 & user2".
     * 
     * What we do during deletion is, delete ALL RECORDS on which either user1 or user2 is the received uid.
     * 
     */    
    public function deleteChatRecords($uid)
    {
        $sql = "DELETE FROM inbox WHERE user1=$uid OR user2=$uid";
        $this->db->query($sql);   
    }    
    
}