<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class page extends Admin_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('article_model');
		$this->load->library('pagination');
	}
	
	public function index()
	{
		$data = $this->data;
		$data['article'] = $this->article_model->getTable(array('type'=>'page', 'lang'=>$this->session->userdata('lang')));
		$this->load->view($data['admin_theme'].'/page-index', $data);
	}
	
	public function add()
	{
		if (empty($_POST))
		{
			$this->data['lang'] = $this->session->userdata('lang');
			//$this->data['cid'] = 1;
			$this->load->view($this->data['admin_theme'].'/page-edit', $this->data);
		}
		else
		{
			$post = $_POST;
			$post['date'] = time();
			$flag = $this->article_model->add($post);
			if ($flag)
			{
				//addSysLog('增加页面：'.$post['title']);
				showmsg(site_url().'admin/page/');
			}
			else 
			{
				showmsg(site_url().'admin/page/add/', 'Error');
			}
		}
	}
	
	public function edit($id)
	{
		if (empty($_POST))
		{
			$this->data['lang'] = $this->session->userdata('lang');
			$this->data['article'] = $this->article_model->getOne($id, 'aid');
			$this->load->view($this->data['admin_theme'].'/page-edit', $this->data);
		}
		else
		{
			$post = $_POST;
			$post['date'] = time();
			$flag = $this->article_model->edit($post, 'aid');
			if ($flag)
			{
				//addSysLog('编辑页面：'.$post['title']);
				showmsg(site_url().'admin/page/');
			}
			else 
			{
				showmsg(site_url().'admin/page/edit/'.$id, 'Error');
			}
		}
	}
	
	public function delete($id)
	{
		$flag = $this->article_model->delete($id, 'aid');
		if ($flag)
		{
			//addSysLog('删除页面：'.$id);
			showmsg(site_url().'admin/page/');
		}
		else 
		{
			showmsg(site_url().'admin/page/', 'Error');
		}
	}
}