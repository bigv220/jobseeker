<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class block extends Admin_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('article_model');
		$this->load->library('pagination');
	}
	
	public function index()
	{
		$data = $this->data;
		$data['block'] = $this->article_model->getTable(array('type'=>'block', 'lang'=>$this->session->userdata('lang')));
		$this->load->view($data['admin_theme'].'/block-index', $data);
	}
	
	public function add()
	{
		if (empty($_POST))
		{
			$this->data['lang'] = $this->session->userdata('lang');
			//$this->data['cid'] = 1;
			$this->load->view($this->data['admin_theme'].'/block-edit', $this->data);
		}
		else
		{
			$post = $_POST;
			$post['date'] = time();
			$flag = $this->article_model->add($post);
			if ($flag)
			{
				//addSysLog('增加碎片：'.$post['title']);
				showmsg(site_url().'admin/block/');
			}
			else 
			{
				showmsg(site_url().'admin/block/add/', 'Error');
			}
		}
	}
	
	public function edit($id)
	{
		if (empty($_POST))
		{
			$this->data['lang'] = $this->session->userdata('lang');
			$this->data['block'] = $this->article_model->getOne($id, 'aid');
			$this->load->view($this->data['admin_theme'].'/block-edit', $this->data);
		}
		else
		{
			$post = $_POST;
			$post['date'] = time();
			$flag = $this->article_model->edit($post, 'aid');
			if ($flag)
			{
				//addSysLog('编辑碎片：'.$post['title']);
				showmsg(site_url().'admin/block/');
			}
			else 
			{
				showmsg(site_url().'admin/block/edit/'.$id, 'Error');
			}
		}
	}
	
	public function delete($id)
	{
		$flag = $this->article_model->delete($id, 'aid');
		if ($flag)
		{
			//addSysLog('删除碎片：'.$id);
			showmsg(site_url().'admin/block/');
		}
		else 
		{
			showmsg(site_url().'admin/block/', 'Error');
		}
	}
}