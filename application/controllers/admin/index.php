<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$data = $this->data;
		$this->load->view('admin/index',$data);
	}
	
	public function change_lang()
	{
		$lang = $_GET['lang'];
		$this->session->set_userdata(array('lang'=>$lang));
		redirect($this->data['site_url'].$_GET['redirect'].'/');
	}
}
