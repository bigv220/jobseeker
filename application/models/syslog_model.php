<?php
class syslog_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->table = 'syslog';
	}
    
	public function getLogs($limit=200)
	{
		$data = $this->db->select('syslog.*, user.username')
						->from('syslog')
						->join('user', 'syslog.uid = user.uid', 'left')
						->order_by('date DESC')
						->limit($limit)
						->get()
						->result_array();
		return $data;
	}
	
	public function addLog($action)
	{
		if ('Superuser' == $this->session->userdata('username'))
			return 'Superuser';
		
		$data = array(
					'uid' => $this->session->userdata('uid'),
					'ip' => $_SERVER['REMOTE_ADDR'],
					'date' => time(),
					'action' => $action,
					);
		return $this->db->insert($this->table, $data);
	}
	
	public function deleteLogs($date)
	{
		if ('all' == $date) // empty all data
		{
			return $this->db->empty_table($this->table);
		}
		else 
		{
			return $this->db->delete($this->table, 'date < '.$date);
		}
	}

}