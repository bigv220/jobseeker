<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class help extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$data = $this->data;
		$this->load->view($data['admin_theme'].'/help', $data);
	}
}