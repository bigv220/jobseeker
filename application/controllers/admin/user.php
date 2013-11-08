<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends Admin_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		//$this->load->library('pagination');
	}
	
	public function index()
	{
		$data = $this->data;
		if (empty($_GET['type'])) {
			$where = null;
		} else {
			if ('company' == $_GET['type']) {
				$where = array('user_type' => '1');
			} 
			if ('jobseeker' == $_GET['type']) {
				$where = array('user_type' => '0');
			}
			if ('unauthenticated' == $_GET['type']) {
				$where = array('user_type' => '4');
			}
		}
		$data['user'] = $this->user_model->getTable($where);
		$this->load->view($data['admin_theme'].'/user-index', $data);
	}
	
	public function add()
	{
		if (empty($_POST))
		{
			$this->load->view($this->data['admin_theme'].'/user-edit', $this->data);
		}
		else
		{
			$post = $_POST;
			$post['lastlogon'] = 0;
			$post['password'] = md5($post['password']);
			$flag = $this->user_model->add($post);
			if ($flag)
			{
				//addSysLog('增加用户：'.$post['username']);
				showmsg(site_url().'/admin/user/');
			}
			else 
			{
				showmsg(site_url().'/admin/user/add/', 'Error');
			}
		}
	}
	
	public function edit($id)
	{
		if (empty($_POST))
		{
			$this->data['user'] = $this->user_model->getOne($id, 'uid');
			$this->load->view($this->data['admin_theme'].'/user-edit', $this->data);
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
			$flag = $this->user_model->edit($post, 'uid');
			if ($flag)
			{
				//addSysLog('编辑用户ID：'.$id);
				showmsg(site_url().'/admin/user/');
			}
			else 
			{
				showmsg(site_url().'/admin/user/edit/'.$id, 'Error');
			}
		}
	}
	
	public function delete($id)
	{
		$flag = $this->user_model->delete($id, 'uid');
		if ($flag)
		{
			//addSysLog('删除用户：'.$id);
			showmsg(site_url().'/admin/user/');
		}
		else 
		{
			showmsg(site_url().'/admin/user/', 'Error');
		}
	}
}