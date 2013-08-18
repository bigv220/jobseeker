<?php
class user_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->table = 'user';
	}
	
	public function getUser($username, $password)
	{
    	$where = array('username'=>$username, 'password'=>$password);
        return $this->db->select('*')
					->from($this->table)
					->where($where)
					->get()->row_array();
	}
	
	public function getAllUserNoAdmin()
	{
		return $this->db->select('*')->from('user')->where(array('uid <>' => '1'))->get()->result_array(); 
	}

    public function getAllActiveEmails()
    {
        return $this->db->select("email,firstname,lastname")->from('user')->where(array('status'=>'active'))->get()->result_array();
    }
	
	public function getOneUser($uid)
	{
		return $this->db->get_where('user', array('uid' => $uid))->row_array();
	}
	
	public function deleteUser($uid)
	{
		return $this->db->delete('user', array('uid' => $uid)); 
	}
	
	public function editUser($data)
	{
		return $this->db->where('uid', $data['uid'])->update('user', $data);
	}
	
	public function checkUser($data)
	{
		return $this->db->get_where('user', array('username'=>$data['username'], 'password'=>$data['password']))->row_array();
	}

    public function checkSameUsername($data) {
        return $this->db->get_where('user', $data)->row_array();
    }

    public function checkEmail($email)
	{
		return $this->db->get_where('user', array('email'=>$email))->row_array();
	}
	
	public function updateUserLogonTime($uid)
	{
		return $this->db->where('uid', $uid)->update('user', array('lastlogon'=>time()));
	}
	
	public function addUser($data)
	{
		$this->db->insert('user', $data);
        return $this->db->insert_id();
	}

    public function getAdminUsersEmail()
    {
        return $this->db->select('email')->from('user')->where(array('isadmin'=>1))->get()->result_array();
    }
}