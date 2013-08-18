<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class template extends Admin_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//$this->load->model('article_model');
		//$this->load->library('pagination');
		$this->data['front_theme_path'] = APPPATH.'views/'.$this->data['front_theme'].'/';
	}
	
	public function index()
	{
		$data = $this->data;
		
		$this->load->helper('directory');
		$data['file_map_arr']  = directory_map( $data['front_theme_path'], 2 );
		
		$this->load->view($data['admin_theme'].'/template-index', $data);
	}
	
	/*public function add()
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
				addSysLog('增加页面：'.$post['title']);
				showmsg(site_url().'admin/page/');
			}
			else 
			{
				showmsg(site_url().'admin/page/add/', 'Error');
			}
		}
	}*/
	
	public function edit($filename)
	{
		$data = $this->data;
		$this->load->helper('file');
		if (empty($_POST))
		{
			$data['filename'] = $filename;
			$data['code_string'] = read_file($data['front_theme_path'].$filename);
			$this->load->view($data['admin_theme'].'/template-edit', $data);
		}
		else
		{
			$post = $_POST;
			$file_path = $data['front_theme_path'].$post['filename'];
			if (write_file($file_path, $post['code']))
			{
				addSysLog('编辑模板：'.$post['filename']);
				showmsg(site_url().'admin/template/');
			}
			else 
			{
				showmsg(site_url().'admin/template/edit/'.$post['filename'], 'Error');
			}
		}
	}
	
	/*public function delete($id)
	{
		$flag = $this->article_model->delete($id, 'aid');
		if ($flag)
		{
			addSysLog('删除页面：'.$id);
			showmsg(site_url().'admin/page/');
		}
		else 
		{
			showmsg(site_url().'admin/page/', 'Error');
		}
	}*/
}