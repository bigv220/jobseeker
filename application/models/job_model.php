<?php
class job_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'job';
    }

    public function getJobInfo($id) {
        $result = $this->db->select('*')
            ->from('job')
            ->where('id',$id)
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
    	return $this->add($data);
    }

    public function searchJob($where) {
        $sql = "SELECT * FROM job LEFT JOIN user as u on job.company_id=u.uid".$where;

        $rtn = $this->db->query($sql)->result_array();
        return $rtn;
    }

    public function searchJobseeker($where) {
        $sql = "SELECT * FROM user ".$where;

        $rtn = $this->db->query($sql)->result_array();
        return $rtn;
    }
    
    public function getRecentJobs($limit = 4) {
    	$sql = 'SELECT * FROM job LEFT JOIN user as u on job.company_id=u.uid ORDER BY job.post_date DESC LIMIT 0,'.$limit;
    	return $this->db->query($sql)->result_array();
    }
}