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
            $user = $this->jobseeker_model->getUser($post['username'], md5($post['login_password']));

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
	
	public function adminlogin() {
		$this->load->model('admin_model');
		
		if (empty($_POST))
		{
			$data = $this->data;
			$this->load->view($data['front_theme'].'/admin-login', $data);
		}
		else
		{
			$post = $_POST;
			if ('' == $post['username'])
				alertmsg('Please input username.');
			$user = $this->admin_model->getUser($post['username'], md5($post['password']));
		
			if($user)
			{
				// set last login time
				$this->admin_model->updateUserLogonTime($user['uid']);
				if (1 == $user['isadmin']) // admin
				{
					$this->load->library('session');
					$sess_arr = array(
							'uid' => $user['uid'],
							'username' => $user['username'],
							'isadmin' => 1,
					);
					$this->session->set_userdata($sess_arr);
					redirect('admin/category');
				}
				else // member
				{
					alertmsg('Access deny.');
				}
			}
			else
			{
				alertmsg('Username or Password error, Please try again.');
			}
		}
	}
}
