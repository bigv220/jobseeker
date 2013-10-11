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

    public function getSimilarJobs($id, $industry) {
        $sql = "SELECT * FROM job WHERE id!=$id AND industry='".$industry ."'";

        $rtn = $this->db->query($sql)->result_array();
        return $rtn;
    }
    
    public function saveJob($data) {
    	return $this->add($data);
    }
}