<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends Front_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		redirect('/');
	}

    /**
     * user signup action
     * user_type: 1 is employer, 0 is job seeker
     */
    public function signup(){
        $data = $this->data;
        $this->load->model('jobseeker_model');
        $userId = -1;
        $status = "success";
        $message = "success";
        if(!$this->jobseeker_model->checkUserExisting($_POST['email'])){
            $userId = $this->jobseeker_model->addUser($_POST);
        }
        else{
            $status = "error";
            $message = "The email is already exist.";
        }
        echo json_encode(array('status'=>$status, 'userId'=>$userId,'message'=>$message));
    }

	public function login()
	{
        $post = $_POST;

        $result = array('uid'=>-1,'status'=>'error', 'message'=>'Username or Password error, Please try again.');
        if ('' == $post['username'])
        {
            $result['message'] = 'Invalid email';
        }
        else{
            $this->load->model('jobseeker_model');
            $user = $this->jobseeker_model->getUser($post['username'], md5($post['password']));

            if($user){
                $this->load->library('session');

                $result['status'] = 'success';
                $result['message'] = '';
                $result['uid'] = $user['uid'];
                $result['first_name'] = $user['first_name'];
                $result['last_name'] = $user['last_name'];

                $this->session->set_userdata($result);

            }
        }
        //return login status with user data
        echo json_encode($result);
	}
	
	public function logout()
	{
		$this->load->library('session');
		$this->session->sess_destroy();
		redirect('/');
	}
}
