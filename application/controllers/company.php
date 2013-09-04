<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Employer Controller, Registraion, Profile page, etc.
*
**/
class company extends Front_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		redirect('/');
	}

	public function register() {
		$data = $this->data;
		
		if ($_POST) {
			//Load Model			
			$this->load->model('company_model');
			$this->company_model->addCompany($_POST);
			if (isset($_POST['industry_tag'])) {
				$this->company_model->addIndustry($_POST['industry_tag']);
			}
		}

		$this->load->view($data['front_theme']."/company-register",$data);
	}

    public function companyInfo(){
        $data = $this->data;
        $this->load->view($data['front_theme']."/company-info",$data);
    }

    public function companyProfile(){
        $data = $this->data;
        $this->load->view($data['front_theme']."/company-profile",$data);
    }
}