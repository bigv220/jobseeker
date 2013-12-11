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

    public function getMaxSeqForId($id) {
        $result = $this->db->select_max('seq')->where('id',$id)->get('inbox')->result_array();
        
        if (!empty($result)) {
            return $result[0]['seq'];
        }
        return 1;   
    }

    public function addMsg($data) 
    {
    	$this->db->insert('inbox', $data);
        return $this->db->insert_id();
    }

    public function getMsg($uid)
    {
        $result = $this->db->select('*')
                 ->from($this->table)
                 ->join('user', 'user.uid='.$this->table.'.user1')
                 ->where('user2',$uid)
                 ->get()
                 ->result_array();
        return $result;
    }

    /**
     * Get Messages that I sent.
     * 
     **/
    public function getMsgSentByMe($uid)
    {
        $result = $this->db->select('*')
                 ->from($this->table)
                 //->join('user', 'user.uid='.$this->table.'.user1')
                 ->where('user1',$uid)
                 ->group_by('id')
                 ->order_by('seq','desc')
                 ->get()
                 ->result_array();
        return $result;
    }

    public function getDetailMsg($msg_id)
    {
        $result = $this->db->select('*')
                 ->from($this->table)
                 ->where('id',$msg_id)
                 ->get()
                 ->result_array();
        return $result;   
    }
}