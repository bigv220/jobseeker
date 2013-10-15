<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

abstract class MY_Controller extends CI_Controller {

	public $data = array();
	
	public function __construct()
	{
		parent::__construct();
		$this->data = $this->common_model->getConfig();
	}

}

abstract class Front_Controller extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->data['lang'] = 'en';
        $this->load->library('session');
        $this->data['uid'] = $this->session->userdata('uid');
        $this->data['first_name'] = $this->session->userdata('first_name');
        $this->data['last_name'] = $this->session->userdata('last_name');
        $this->data['user_type'] = $this->session->userdata('user_type');
	}
	
}

abstract class User_Controller extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}
	
}

abstract class Admin_Controller extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		if (!$this->session->userdata('isadmin'))
		{
			redirect('user/adminlogin/');
		}
		$this->data['username'] = $this->session->userdata('username');

		$this->data['theme_path'] = $this->data['base_path'] . 'theme/'.$this->data['admin_theme'].'/';
	}
	
}
