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
			redirect('user/login/');
		}
		$this->data['username'] = $this->session->userdata('username');
		$this->data['theme_path'] = $this->data['base_path'] . 'theme/'.$this->data['admin_theme'].'/';
	}
	
}
