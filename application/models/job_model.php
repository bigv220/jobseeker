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

        return $result[0];
    }


}