<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Employer Controller, Registraion, Profile page, etc.
*
**/
class company extends Front_Controller {
	
	public function __construct()
	{
		parent::__construct();
        $this->load->library('session');
	}
	
	public function index()
	{
		$data = $this->data;
        $this->load->view($data['front_theme']."/company-info",$data);
	}

	public function register() {
        if (!$this->session->userdata('uid'))
        {
            redirect('/');
        }
		$data = $this->data;
		
        $uid = $this->session->userdata('uid');
        //Load Model            
        $this->load->model('company_model');

        $post = $_POST; // will do security filter here
        
		if ($post) {
			
			// set up default avatar
			if (empty($post['avatar'])) {
				$post['avatar'] = $data['site_url'] . 'attached/users/no-image.png';
			}
			
            if (isset($post['name']) && !isset($post['last_name'])) {
                $this->company_model->updateBasicInfo($post);    
            } elseif (!isset($post['first_name']) && isset($post['last_name'])) {
                $this->company_model->updateContactDetail($post);
            } else {
                $this->company_model->updateBasicInfo($post);    
                $this->company_model->updateContactDetail($post);
            }
			
			
            $msg = "success";
            $result['status'] = $msg;
            echo json_encode($result);
		} else {

	        $data["uid"] = $uid;
	        // get location
	        $this->load->helper('location');
	        $data['location'] = getLoction();

            //industry lists
            $this->load->model('jobseeker_model');
            $industry = $this->jobseeker_model->getIndustry();
	        $data["industry_list"] = $industry;
	        $basic_info = $this->company_model->getUserInfo($uid);
	        $data['industries'] = $this->company_model->getIndustry($uid);
	        //$contact_detail = $this->company_model->getContactDetail($uid);
	
	        $data["basic_info"] = $basic_info;
	        //$data["contact_detail"] = $contact_detail;
	
			$this->load->view($data['front_theme']."/company-register",$data);
		}
	}

    public function companyInfo($company_id){
    	if (empty($company_id)) {
    		redirect('/');
    	}
        $this->load->model('company_model');
        $data = $this->data;
        $data["info"] = $this->company_model->getUserInfo($company_id);
        $data['industries'] = $this->company_model->getIndustry($company_id);
        $this->load->view($data['front_theme']."/company-info",$data);
    }

    public function companyProfile(){
        if (!$this->session->userdata('uid'))
        {
            redirect('/');
        }
        $data = $this->data;
        $this->load->model('company_model');
        
        $company_id = $this->session->userdata('uid');
        $this->load->model('job_model');
        //get data from db
     
        $data = $this->data;
        $data["jobinfo"] = $this->job_model->getCompanyJobList($company_id);
        $data["info"] = $this->company_model->getUserInfo($company_id);
        $data['industries'] = $this->company_model->getIndustry($company_id);
        $this->load->view($data['front_theme']."/company-profile",$data);
    }

}