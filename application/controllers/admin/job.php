<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class job extends Admin_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('job_model');
		//$this->load->library('pagination');
	}
	
	public function index()
	{
		$data = $this->data;
		//$data['user'] = $this->job_model->getTable();
		$data['jobs'] = $this->job_model->searchJobUnique(null);
		$this->load->view($data['admin_theme'].'/job-index', $data);
	}
	
	public function edit($id)
	{
		if (empty($_POST))
		{
			$this->data['user'] = $this->user_model->getOne($id, 'uid');
			$this->load->view($this->data['admin_theme'].'/job-edit', $this->data);
		}
		else
		{
			$post = $_POST;
			if ('' == trim($post['password']))
			{
				unset($post['password']);
			}
			else 
			{
				$post['password'] = md5($post['password']);
			}
			$flag = $this->user_model->edit($post, 'id');
			if ($flag)
			{
				//addSysLog('编辑用户ID：'.$id);
				showmsg(site_url().'admin/job/');
			}
			else 
			{
				showmsg(site_url().'admin/job/edit/'.$id, 'Error');
			}
		}
	}
	
	public function delete($id)
	{
		$flag = $this->job_model->delete($id, 'id');
				$this->job_model->delJobLang($id);
		if ($flag)
		{
			showmsg(site_url().'admin/job/');
		}
		else 
		{
			showmsg(site_url().'admin/job/', 'Error');
		}
	}
}