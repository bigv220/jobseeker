<?php
class inbox_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'inbox';
    }

    public function getMaxMessageId() {
    	$result = $this->db->select_max('id')->get('inbox')->result_array();
        
    	if (!empty($result)) {
    		return $result[0]['id'];
    	}
    	return 0;
    }

    public function addmsg($data) 
    {
    	$this->db->insert('inbox', $data);
        return $this->db->insert_id();
    }

    public function getmsg($uid)
    {
        $result = $this->db->select('*')
                 ->from($this->table)
                 ->join('user', 'user.uid='.$this->table.'.user1')
                 ->where('user2',$uid)
                 ->get()
                 ->result_array();
        return $result;
    }
}