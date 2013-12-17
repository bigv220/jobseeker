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

    	$post = $this->input->post();
    	if (empty($post)) {
    		securelychk();
    	}
    	
        $this->load->model('jobseeker_model');
        $userId = -1;
        $status = "success";
        $message = "success";
        if(!$this->jobseeker_model->checkUserExisting($post['email'])){
        	$uType = $post['user_type'];
        	$post['user_type'] = 4; // no confirmation
            $userId = $this->jobseeker_model->addUser($post);
            
            // send email
            $uEmail = $post['email'];
            $code = md5($uEmail.$userId.$uType);
            $code = $code[3].$code[1].$code[10].$code[5].$code[12].$code[9];
            $url = $this->data['site_url'].'user/confirm/?q='.$uEmail.'-'.$userId.'-'.$uType.'-'.$code;
            
            $this->load->library('email');
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            
            $this->email->from('do-not-reply@jingjobs.com', 'JingJobs');
            $this->email->to($uEmail);
            $this->email->subject('Email confirmation');
            $this->email->message('<html>
            						<head><title>Email confirmation</title></head>
            						<body>Hi, <br><br>
            						Please click <a href="'.$url.'">HERE</a> to complete email confirmation.<br><br>
            						JingJobs.com');
            if($this->email->send()) {
            	$message = 'Please check your email and complete email confirmation.';
            } else {
            	$message = 'Send email failed';
            }
            //$this->load->library('session');
            //$result['uid'] = $userId;
            //$result['first_name'] = $_POST['first_name'];
            //$result['last_name'] = $_POST['last_name'];
            //$result['user_type'] = $_POST['user_type'];
            //$this->session->set_userdata($result);
            //$data = $this->data;
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

        $result = array('uid'=>-1,'status'=>'error', 'message'=>'Either your email or password is incorrect, try again.');
        if ('' == $post['username'])
        {
            $result['message'] = 'Invalid email';
        }
        else{
            $this->load->model('jobseeker_model');
            $user = $this->jobseeker_model->getUser($post['username'], md5($post['login_password']));



            if($user){
                if ( isset($user['user_type']) && 4 == $user['user_type'] ) {
                    //alertmsg('Please check your email and complete email confirmation.');
                    $result['message'] = 'Please check your email and complete email confirmation.';
                }
                else{
                    $this->load->library('session');
                    $result['status'] = 'success';
                    $result['message'] = '';
                    $result['uid'] = $user['uid'];
                    $result['first_name'] = $user['first_name'];
                    $result['last_name'] = $user['last_name'];
                    $result['user_type'] = $user['user_type'];

                    $this->session->set_userdata($result);

                    $this->jobseeker_model->updateUserStatus($user['uid'], 1);
                }
            }
        }
        //return login status with user data
        echo json_encode($result);
	}
	
	public function logout()
	{
		$this->load->library('session');
        if ($this->session->userdata('uid')) {
            $this->load->model('jobseeker_model');
            $this->jobseeker_model->updateUserStatus($this->session->userdata('uid'), -1);
        }
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
            $md5username = md5(substr(md5($_POST['username']), 3, 9)); // just make it complicated
            $resetPwLink = $this->config->item('base_url') . 'user/resetPassword?juid='. $userId . '&token=' . $md5username;
            //send email to this user's email address
            $this->load->library('email');

            $this->email->from('do-not-reply@jingjobs.com', 'JingJobs Team');
            $this->email->to($_POST['username']);

            $this->email->subject('RESET PASSWORD EMIAL FROM JINGJOBS');
            $this->email->message("<HTML><BODY><div>You requested that your password be reset. To reset your password please follow this link: <br/>[<a href='$resetPwLink'>Reset My Password</a>]<br/>Thanks,<br/>The JingJobs Team</div></BODY></HTML>");

            if (!$this->email->send()) {
            	$message = 'Send email failed';
            }

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
            if( md5(substr(md5($user['username']), 3, 9)) != $_POST['token'] ){
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
		$this->jobseeker_model->creatUserfolder ( $user_path.$uid.'/' ) or exit ( 'error: can not creat folder.' );
		// upload
		if (is_uploaded_file ( $_FILES ['avatar'] ['tmp_name'] )) {
			$file_name = $uid.'/'.uniqid().'-'.iconv('utf-8','gb2312',$_FILES['avatar']['name']);
			move_uploaded_file ( $_FILES ['avatar'] ['tmp_name'], $user_path .$file_name);
	
			exit('success|'.$file_name);
		} else {
			exit('error|can not upload avatar image.');
		}
	}
	
	public function confirm() {
		if (!isset($_GET['q'])) {
			securelychk();
		}
		$str = $_GET['q'];
		$arr = explode('-', $str);
		$uEmail = $arr[0];
		$userId = $arr[1];
		$uType = $arr[2];
		$code1 = $arr[3];
		$code2 = md5($uEmail.$userId.$uType);
		$code2 = $code2[3].$code2[1].$code2[10].$code2[5].$code2[12].$code2[9];
		if ($code1 == $code2) {
			
			$this->load->model('jobseeker_model');
			$flag = $this->jobseeker_model->edit(array('uid'=>$userId, 'user_type'=> $uType), 'uid');
			if ($flag) {
				$user = $this->jobseeker_model->getUserInfo($userId);
				$sess['uid'] = $userId;
				$sess['first_name'] = $user['first_name'];
				$sess['last_name'] = $user['last_name'];
				$sess['user_type'] = $user['user_type'];
				$this->load->library('session');
				$this->session->set_userdata($sess);
				redirect('/?welcome');
			} else {
				alertmsg('error:u1');
			}
		} else {
			securelychk();
		}
	}

    public function getstatus() 
    {
        $this->load->model('jobseeker_model');
        if (!empty($_POST['userid'])) {
            $result = $this->jobseeker_model->getUserOnlineStatusById($_POST['userid']);    
        } else {
            $result = $this->jobseeker_model->getUserOnlineStatus();
        }
        
        $this->output->set_header('Content-Type: application/json; charset=utf-8');  
        echo json_encode($result);
    }

    public function checkstatus()
    {   
        if (!$this->session->userdata('uid')) {
            return;
        }
        $this->load->model('jobseeker_model');
        $this->jobseeker_model->cleanUp();
        $this->jobseeker_model->updateUserStatus($this->session->userdata('uid'), 1);
    }

    public function updateVisitNum() {
        $this->load->model('jobseeker_model');

        $post = $_POST;
        $uid = $post['uid'];

        if ($post) {
            $rtn = $this->jobseeker_model->updateVisitNum($uid);

            if($rtn) {
                $msg = "success";
            } else {
                $msg = "failed";
            }

            $result['status'] = $msg;
            echo json_encode($result);
        }
    }
}
