<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class syslog extends Admin_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('syslog_model');
	}
	
	public function index()
	{
		$data = $this->data;
		$data['logs'] = $this->syslog_model->getLogs();
		$this->load->view($data['admin_theme'].'/syslog-index', $data);
	}
	
	public function delete()
	{
		// 31536000 = 1 year  mktime(0,0,0,0,0,2011) - mktime(0,0,0,0,0,2010);
		$del_days = time() - 31536000;
		$flag = $this->syslog_model->deleteLogs($del_days);
		if ($flag)
		{
			addSysLog('清除日志'.$this->db->affected_rows().'条');
			showmsg(site_url().'admin/syslog/');
		}
		else 
		{
			showmsg(site_url().'admin/syslog/', 'Error');
		}
	}
	
	public function deleteAll() // for Superuser
	{
		if ('Superuser' == $this->session->userdata('username'))
		{
			$flag = $this->syslog_model->deleteLogs('all');
			if ($flag)
			{
				showmsg(site_url().'admin/syslog/');
			}
			else 
			{
				showmsg(site_url().'admin/syslog/', 'Error');
			}
		}
		else 
		{
			exit;
		}
	}
}