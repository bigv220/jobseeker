<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class database extends Admin_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('database_model');
	}
	
	public function index()
	{
		redirect('admin/database/backup/');
	}
	
	public function backup()
	{
		if (empty($_POST))
		{
			$data = $this->data;
			$this->load->view($data['admin_theme'].'/database-backup', $data);
		}
		else
		{
			$post = $_POST;
			if ($post['action'] == 'backup' && $this->database_model->backup())
			{
				showmsg(site_url().'admin/database-backup/');
			}
			else
			{
				showmsg(site_url().'admin/database-backup/', 'Error');
			}
		}
	}
	
	public function restore()
	{
	
	}
	
	public function optimize()
	{
		if (empty($_POST))
		{
			$data = $this->data;
			$this->load->view($data['admin_theme'].'/database-optimize', $data);
		}
		else
		{
			$post = $_POST;
			if ($post['action'] == 'optimize' && $this->database_model->optimize())
			{
				showmsg(site_url().'admin/database-optimize/');
			}
			else
			{
				showmsg(site_url().'admin/database-optimize/', 'Error');
			}
		}
	}
	
	public function sql()
	{
	
	}
	
}