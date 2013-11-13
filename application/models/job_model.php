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
            ->get()
            ->result_array();
        if (isset($result))    
            return $result;
        else
            return array();
    }

    public function getSimilarJobs($id, $industry) {
        $sql = "SELECT * FROM job WHERE id!=$id AND industry='".$industry ."'";

        $rtn = $this->db->query($sql)->result_array();
        return $rtn;
    }
    
    public function saveJob($data) {
        $this->db->insert('job', $data);
        return $this->db->insert_id();
    }

    public function insertJobLanguage($data) {
        return $this->db->insert('job_language_level', $data);
    }

    public function getJobLanguages($id) {
        $sql = "SELECT language,level from job_language_level WHERE job_id=$id";

        return $this->db->query($sql)->result_array();
    }

    public function insertJobIndustry($data) {
        return $this->db->insert('job_industry_position', $data);
    }

    public function getJobIndustry($id) {
        $sql = "SELECT industry,position from job_industry_position WHERE job_id=$id";

        return $this->db->query($sql)->result_array();
    }

    public function searchJob($where) {
        $sql = "SELECT *,job.id as id, job.city as city,jl.language as language,job.employment_length as employment_length, job.employment_type employment_type
        		FROM job 
        		LEFT JOIN user as u on job.company_id=u.uid LEFT JOIN job_language_level as jl on job.id=jl.job_id
        		LEFT JOIN job_industry_position as jip on job.id=jip.job_id".$where;

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

    public function searchJobseeker($where) {
        $sql = "SELECT * FROM user ".$where;

        $rtn = $this->db->query($sql)->result_array();
        return $rtn;
    }
    
    public function getRecentJobs($limit = 4) {
    	$sql = 'SELECT *, job.city as city FROM job LEFT JOIN user as u on job.company_id=u.uid ORDER BY job.post_date DESC LIMIT 0,'.$limit;
    	return $this->db->query($sql)->result_array();
    }

    /**
     * APPLY JOB
     **/
    public function applyJob($job_id, $uid, $status) {
        $sql = "REPLACE INTO job_apply values($job_id, $uid, $status);";
        return $this->db->query($sql);
    }

    public function getAppliedJobByUser($uid) {
        $sql = "SELECT * FROM job_apply WHERE user_id = $uid";
        return $this->db->query($sql)->result_array();
    }
    
    public function delJobLang($job_id) {
    	$this->table = 'job_language_level';
    	return $this->delete($job_id, 'job_id');
    }
    
}