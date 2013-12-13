<?php
class portfolioproject_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'portfolio_project';
    }

    /**
     * insert a user to user table
     * @param $data
     * @return mixed
     */
    public function addProject($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function getUserPortfolioProjects($id) {
        $sql = "SELECT * FROM " . $this->table . " WHERE uid=$id";
        return $this->db->query($sql)->result_array();
    }

    public function delProject($pid) {
        $sql = "DELETE FROM  " . $this->table . " WHERE pid=$pid";
        $this->db->query($sql);
        return $this->db->affected_rows()>0;
    }
}