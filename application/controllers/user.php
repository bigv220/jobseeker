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
	
	public function login()
	{
		if (empty($_POST))
		{
			$data = $this->data;
			$this->load->view($data['front_theme'].'/user-login', $data);
		}
		else 
		{
			$post = $_POST;
			if ('' == $post['username'])
			{
				alertmsg('Please input username.');
			}
			$this->load->model('admin_model');
			$user = $this->admin_model->getUser($post['username'], md5($post['password']));

			if($user)
			{
				// set last login time
				$this->admin_model->updateUserLogonTime($user['uid']);
				if (1 == $user['isadmin']) // goto admin panel
				{
					$this->load->library('session');
					$sess_arr = array(
									//'lang' => 'cn', // set default language
									'uid' => $user['uid'],
									'username' => $user['username'],
									'isadmin' => 1,
									);
					$this->session->set_userdata($sess_arr);
					//addSysLog('登录系统');
					redirect('admin/page');
				}
				else // goto member panel
				{
					alertmsg('Access deny.');
					redirect('member/index');
				}
			}
			else 
			{
				alertmsg('Username or Password error, Please try again.');
			}
		}
	}
	
	public function logout()
	{
		$this->load->library('session');
		$this->session->sess_destroy();
		redirect('user/login');
	}
}
