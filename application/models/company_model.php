<?php
class company_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->table = 'user';
	}

    /**
     * Get Company Basic info.
     * @param  int $company_id Company ID
     * @return Array             Company info in key-array
     */
	public function getCompanyInfo($company_id)
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

    public function getUserInfo($uid) {
        $result = $this->db->select('*')
            ->from('user')
            ->where('uid',$uid)
            ->get()
            ->result_array();

        return $result[0];
    }

	/**
	 * Add new Company
	 * @param int $data Last insert id
	 */
	public function updateBasicInfo($data)
	{
		$uid = $data['uid'];
		$data = array('first_name'=>$data['name'],'country'=>$data['country'],'city'=>$data['city'],
				'profile_pic'=>$data['avatar'], 'description'=>$data['description']);
		$this->db->where('uid', $uid);
		$this->db->update('user', $data); 
		if (isset($_POST['industry_tag'])) {
			$this->company_model->addIndustry($_POST['industry_tag']);
		}
        return true;
	}

	public function updateContactDetail($data) {
		$uid = $data['uid'];
		$data = array('last_name'=>$data['last_name'],
				'email'=>$data['email'],'phone'=>$data['phone'],'is_allow_phone'=>$data['is_allow_phone'],
				'jingchat_username'=>$data['jingchat_username'],'is_allow_online_msg'=>$data['is_allow_online_msg'],
				'personal_website'=>isset($data['personal_website'])?$data['personal_website']:"",
				 'twitter'=>isset($data['twitter'])?$data['twitter']:"", 'linkedin'=>isset($data['linkedin'])?$data['linkedin']:"",
				  'wechat'=>isset($data['wechat'])?$data['wechat']:"");
		$this->db->where('uid', $uid);
		$this->db->update('user', $data); 
	}

	public function addIndustry($data) 
	{
		
	}

	public function getSimilarCompanys($company_id, $industry)
	{
		
	}
	
	
}