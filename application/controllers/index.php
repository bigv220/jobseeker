<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class index extends Front_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$data = $this->data;
		$this->load->model('article_model');
		$data['news_list'] = $this->article_model->getListByCat('company-news', $limit=10);
		$this->load->view($data['front_theme'].'/index', $data);
	}
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */