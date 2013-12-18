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

    public function checkIfConversationExist($user1, $user2) {
        $result = $this->db->select('*')
                           ->from($this->table)
                           ->where('user1',$user1)
                           ->where('user2',$user2)
                           ->get()
                           ->result_array();
        return $result;                           
    }

    public function addMsg($data) 
    {
    	$this->db->insert('inbox', $data);
        return $this->db->insert_id();
    }

    public function getGeneralMsgForUser($uid)
    {
        $result = $this->db->select('*')
                 ->from($this->table)
                 ->where('user1',$uid)
                 ->or_where('user2',$uid)
                 ->where('is_delete',0)
                 ->group_by('id')
                 ->get()
                 ->result_array();
        $key_value_result = array();                 
        foreach($result as $row){
            if ($row['user2'] == $uid) {
                $key_value_result[$row['user1']] = $row;    
            } else {
                $key_value_result[$row['user2']] = $row;    
            }
            
        }         
        return $key_value_result;   
    }

    public function getMsg($uid)
    {
        $result = $this->db->select('*')
                 ->from($this->table)
                 ->join('user', 'user.uid='.$this->table.'.user1')
                 ->where('user2',$uid)
                 ->where('is_delete',0)
                 ->group_by('id')
                 ->get()
                 ->result_array();
        return $result;
    }

    public function getTrashMsg($uid)
    {
        $result = $this->db->select('*')
                 ->from($this->table)
                 ->join('user', 'user.uid='.$this->table.'.user1')
                 ->where('user2',$uid)
                 ->where('is_delete',1)
                 ->group_by('id')
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
        $result = $this->db->select('id,max(seq) as seq')
                 ->from($this->table)
                 //->join('user', 'user.uid='.$this->table.'.user1')
                 ->where('user1',$uid)
                 ->where('is_delete',0)
                 ->group_by('id')
                 ->get()
                 ->result_array();
        $where = "";
        foreach($result as $value) {
            if (!empty($value['id']))
                $where .= "(id=".$value['id'].' and seq='.$value['seq'] . ') or ';
        }
        if (!empty($where)) {
            $where = substr($where, 0,-4);
        } else {
            return array();
        }
        $msg = $this->db->select('*')
                 ->from($this->table)
                 ->join('user', 'user.uid='.$this->table.'.user1')
                 ->where($where)
                 ->get()
                 ->result_array();
        return $msg;
    }

    public function getDetailMsg($msg_id)
    {
        $result = $this->db->select('*')
                 ->from($this->table)
                 ->where('id',$msg_id)
                 ->where('is_delete',0)
                 ->get()
                 ->result_array();
        return $result;   
    }

    public function getRealTimeMessage($msg_id, $seq) {
        $result = $this->db->select('*')
                 ->from($this->table)
                 ->where('id',$msg_id)
                 ->where('seq >',$seq)
                 ->order_by('seq','desc')
                 ->limit(1)
                 ->get()
                 ->result_array();
        return $result;                
    }

    public function deleteMessage($msg_id) 
    {
        $data = array('is_delete'=>1);
        $this->db->where_in('id', $msg_id);
        $this->db->update('inbox', $data); 
    }

    public function getUnReadMessageNum($uid) 
    {
        $result = $this->db->select('*')
                 ->from($this->table)
                 ->where('user2', $uid)
                 ->where('user2read', 'no')
                 ->where('is_delete', 0)
                 ->group_by('id')
                 ->get()
                 ->result_array();
        return count($result);                 
    }

    public function updateMessageToRead($msg_id)
    {
        $data = array('user2read'=>'yes');
        $this->db->where('id', $msg_id);
        $this->db->update('inbox', $data); 
    }
}