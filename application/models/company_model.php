<?php
class company_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->table = 'company';
	}

    /**
     * Get Company Basic info.
     * @param  int $company_id Company ID
     * @return Array             Company info in key-array
     */
	public function getCompanyInfo($company_id	)
	{
		$data = $this->db->select('company.*')
						->from('company')
						->where('company_id', $company_id)
						->get()
						->result_array();
		return $data;
	}

	/**
	 * Get Job list for a company.
	 * @param  int $company_id Company Id
	 * @return arrayList             Job list array
	 */
	public function getJobsByCompanyId($company_id)
	{
		$data = $this->db->select('*')
						 ->from('job')
						 ->where('company_id', $company_id)
						 ->get()
						 ->result_array();

		return $data;						 
	}

	/**
	 * Add new Company
	 * @param int $data Last insert id
	 */
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

	public function getSimilarCompanys($company_id, $industry)
	{
		
	}
	
	
}