<?php
class user_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'user';
    }
    
    /**
     * ADMIN - user listing - Authenticate action.
     * 
     * It updates the user table with new User Type selected.
     */
    public function authenticate($uid,$user_type)
    {
        $data = array('user_type'=>$user_type);
        return $this->db->where('uid', $uid)->update($this->table, $data);
    }
}