<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class setting extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function Index()
	{
		if (empty($_POST))
		{
			$data = $this->data;
			$this->common_model->table = 'config';
			$data['setting'] = $this->common_model->getTable(array('category'=>'global'));
			$this->load->view($data['admin_theme'].'/setting',$data);
		} else {
			$post = $_POST;
			$this->load->model('setting_model');
			if ($this->setting_model->setconfig($post))
			{
				addSysLog('修改网站设置');
				showmsg(site_url().'admin/setting/');
			}
			else 
			{
				showmsg(site_url().'admin/setting/', 'Error');
			}
		}
	}
}