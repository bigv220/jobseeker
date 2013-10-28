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

        $this->load->model('jobseeker_model');
        $userId = -1;
        $status = "success";
        $message = "success";
        if(!$this->jobseeker_model->checkUserExisting($_POST['email'])){
            $userId = $this->jobseeker_model->addUser($_POST);
            $this->load->library('session');

            $result['uid'] = $userId;
            $result['first_name'] = $_POST['first_name'];
            $result['last_name'] = $_POST['last_name'];
            $result['user_type'] = $_POST['user_type'];

            $this->session->set_userdata($result);

            $data = $this->data;
        }
        else{
            $status = "error";
            $message = "This email already exists.";
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
                $result['user_type'] = $user['user_type'];

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

    public function sendResetPwRequest(){
        $data = $this->data;
        $this->load->model('jobseeker_model');
        $userId = $this->jobseeker_model->getUserIdByUsername($_POST['username']);
        $status = "success";
        $message = "success";

        if(count($userId) < 1){
            $status = "error";
            $message = "No one with that email was found, please try again with an alternative email address.";
        }
        else{
            $userId = $userId[0]['uid'];
            $md5username = md5($_POST['username']);
            $resetPwLink = $this->config->item('base_url') . 'user/resetPassword?juid='. $userId . '&token=' . $md5username;
            //send email to this user's email address
            $this->load->library('email');

            $this->email->from('andrew@anzury.com', 'JingJobs Team');
            $this->email->to($_POST['username']);

            $this->email->subject('RESET PASSWORD EMIAL FROM JINGJOBS');
            $this->email->message("<HTML><BODY><div>You requested that your password be reset. To reset your password please follow this link: <br/>[<a href='$resetPwLink'>Reset My Password</a>]<br/>Thanks,<br/>The JingJobs Team</div></BODY></HTML>");

            $this->email->send();

        }
        echo json_encode(array('status'=>$status, 'message'=>$message));
    }

    public function resetPassword(){
        $data = $this->data;
        $data['juid'] = $_GET['juid'];
        $data['token'] = $_GET['token'];
        $this->load->view($data['front_theme'].'/reset-password', $data);
    }

    public function resetPasswordAction(){
        $this->load->model('jobseeker_model');
        $status = "success";
        $message = "success";
        $user = $this->jobseeker_model->getUserInfo($_POST["uid"]);
        if($user != null){
            if(md5($user['username']) != $_POST['token']){
                $status = "error";
                $message = "The link is bad, please contact us.";
            }
            else{
                //set the new password for this user
                $this->jobseeker_model->updatePassword($_POST['uid'], $_POST['password']);
            }
        }
        else{
            $status = "error";
            $message = "Invalid user.";
        }
        echo json_encode(array('status'=>$status, 'message'=>$message));
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
	
	/**
	 *  update user's photo
	 */
	public function ajaxuploadimage() {
		// create folder
		$this->load->model('jobseeker_model');
		$uid = $this->session->userdata('uid');
		//$user_path = realpath(dirname(__FILE__))."/../../theme/default/users/";
		$user_path = FCPATH . 'attached/users/';
		$this->jobseeker_model->creatUserfolder ( $user_path ) or exit ( 'error: can not creat folder.' );
		// upload
		if (is_uploaded_file ( $_FILES ['avatar'] ['tmp_name'] )) {
			$file_name = $uid.'/'.uniqid().'-'.iconv('utf-8','gb2312',$_FILES['avatar']['name']);
			move_uploaded_file ( $_FILES ['avatar'] ['tmp_name'], $user_path .$file_name);
	
			exit('success|'.$file_name);
		} else {
			exit('error|can not upload avatar image.');
		}
	}
	
}
