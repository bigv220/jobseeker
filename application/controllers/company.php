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
		$data = $this->data;
        $this->load->view($data['front_theme']."/company-info",$data);
	}

	public function register() {
		$data = $this->data;
		
        $uid = 6;
        //Load Model            
        $this->load->model('company_model');

		if ($_POST) {
            if (isset($_POST['first_name']) && !isset($_POST['last_name'])) {
                $this->company_model->updateBasicInfo($_POST);    
            } elseif (!isset($_POST['first_name']) && isset($_POST['last_name'])) {
                $this->company_model->updateContactDetail($_POST);
            } else {
                $this->company_model->updateBasicInfo($_POST);    
                $this->company_model->updateContactDetail($_POST);
            }
			
			
            $msg = "success";
            $result['status'] = $msg;
            echo json_encode($result);
		}

        $data["uid"] = $uid;
        // get location
        $this->load->helper('location');
        $data['location'] = getLoction();

        $basic_info = $this->company_model->getUserInfo($uid);
        $industries = $this->company_model->getIndustry($uid);
        $data['industries'] = $this->company_model->getIndustry($uid);
        //$contact_detail = $this->company_model->getContactDetail($uid);

        $data["basic_info"] = $basic_info;
        //$data["contact_detail"] = $contact_detail;

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

    /**
     *  update user's photo
     */
    public function ajaxuploadimage() {
        $data = $this->data;

        // create folder
        $this->load->model('jobseeker_model');
        $user_path = realpath(dirname(__FILE__))."/../../theme/default/company/";
        $this->jobseeker_model->creatUserfolder ( $user_path ) or exit ( 'error: can not create folder.' );
        // upload
        if (is_uploaded_file ( $_FILES ['avatar'] ['tmp_name'] )) {
            $file_name = iconv('utf-8','gb2312',$_FILES['avatar']['name']);

            $i = 1;
            while (file_exists($user_path .$file_name)) {
            	$file_name = $i++."_".$file_name;
            }
            
            move_uploaded_file ( $_FILES ['avatar'] ['tmp_name'], $user_path .$file_name);

            // new image url
            $data ['avatar'] = '/company/' . $file_name;

            exit ( 'success' );
        } else {
            exit ( 'error: can not upload avatar image.' );
        }
    }
}