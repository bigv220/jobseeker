<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class page extends Front_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('article_model');
	}
	
	public function index()
	{
		redirect('/');
	}
	
	public function view($url)
	{
		$data = $this->data;
		$url = $this->input->post($url, TRUE);
		$data['article'] = $this->article_model->getOne($url, 'url');
		$this->load->view($data['front_theme'].'/page', $data);
	}
}
