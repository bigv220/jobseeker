<?php
class Common_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
	}
    
	public function getConfig($category = '')
	{
		if ('' == $category)
		{
			$arr = $this->db->select('key, value, name')
							->get('config')->result_array();
		}
		else
		{
			$arr = $this->db->select('key, value, name')
							->where('category', $category)
							->get('config')->result_array();
		}
		foreach ($arr as $v) 
		{
			$data[$v['key']] = $v['value'];
		}
		$data['base_path'] = base_url();
		$data['site_url'] = $data['base_url'] = site_url();
		$data['theme_path'] = $data['base_path'] . 'theme/'.$data['front_theme'].'/';
		return $data;
	}

}