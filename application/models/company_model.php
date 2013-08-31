<?php
class company_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->table = 'company';
	}
    
	public function getCompanyInfo($limit=200)
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

	/**
	 * Add new Company
	 * 
	 **/
	public function addCompany($data)
	{
		$data = array('name'=>$data['name'],'country'=>$data['country'],'city'=>$data['city'],
				'logo'=>'', 'description'=>$data['description'], 'contact_name'=>$data['contact_name'],
				'email'=>$data['email'],'phone'=>$data['country'],'is_phone_public'=>isset($data['is_phone_public']) && $data['is_phone_public'] =='on'?1:0,
				'jingchat'=>$data['jingchat'],'is_allow_jingchat_contact'=>isset($data['is_allow_jingchat_contact']) && $data['is_allow_jingchat_contact'] =='on'?1:0,
				'website'=>$data['website'], 'twitter'=>$data['twitter'], 'linkedin'=>$data['linkedin'], 'wechat'=>$data['wechat']);
		$this->db->insert($this->table, $data);
        return $this->db->insert_id();
	}

	public function addIndustry($data) 
	{
		
	}
	
	
}