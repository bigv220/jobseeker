<?php
class admin_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->table = 'admin';
	}
	
	public function getUser($username, $password)
	{
    	$where = array('username'=>$username, 'password'=>$password);
        return $this->db->select('*')
					->from($this->table)
					->where($where)
					->get()->row_array();
	}
	
	public function updateUserLogonTime($uid)
	{
		return $this->db->where('uid', $uid)->update($this->table, array('lastlogon'=>time()));
	}

    public function getAllActiveEmails()
    {
        return $this->db->select("email,firstname,lastname")->from($this->table)->where(array('status'=>'active'))->get()->result_array();
    }
	
	public function getOneUser($uid)
	{
		return $this->db->get_where($this->table, array('uid' => $uid))->row_array();
	}
	
	public function deleteUser($uid)
	{
		return $this->db->delete($this->table, array('uid' => $uid)); 
	}
	
	public function editUser($data)
	{
		return $this->db->where('uid', $data['uid'])->update($this->table, $data);
	}
	
	public function checkUser($data)
	{
		return $this->db->get_where($this->table, array('username'=>$data['username'], 'password'=>$data['password']))->row_array();
	}

    public function checkSameUsername($data) {
        return $this->db->get_where($this->table, $data)->row_array();
    }

    public function checkEmail($email)
	{
		return $this->db->get_where($this->table, array('email'=>$email))->row_array();
	}
	
	public function addUser($data)
	{
		$this->db->insert($this->table, $data);
        return $this->db->insert_id();
	}

    public function getAdminUsersEmail()
    {
        return $this->db->select('email')->from($this->table)->where(array('isadmin'=>1))->get()->result_array();
    }
    
}