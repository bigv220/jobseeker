<?php
class setting_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->table = 'config';
	}
	
	function setconfig($data)
	{
		foreach ($data as $k => $v)
		{
			$this->db->where('key', $k);
			$result = $this->db->update('config', array('value'=>$v)); 
		}
		return $result;
	}
}