<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class news extends Admin_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('article_model');
	}
	
	public function index()
	{
		$data = $this->data;
		// set cid and base_url
		//$data['cid'] = $cid = empty($_GET['cid']) ? 0 : $_GET['cid'];
		if (empty($_GET['cid']))
		{
			$data['cid'] = $cid = 0;
			$config['base_url'] = '?';
		}
		else 
		{
			$data['cid'] = $cid = $_GET['cid'];
			$config['base_url'] = '?cid='.$_GET['cid'];
		}
		// set where and total_where
		$where = array();
		if (0 == $cid)// if cid == 0, get all news
		{
			$where = array('type'=>'news', 'lang'=>$this->session->userdata('lang'));
			//$total_where = "type='news' and lang='".$this->session->userdata('lang')."'";
		}
		else 
		{
			$where = array('cid'=>$cid, 'type'=>'news', 'lang'=>$this->session->userdata('lang'));
			//$total_where = "cid=".$cid." and type='news' and lang='".$this->session->userdata('lang')."'";
		}
		
		// load pagination
		$this->load->library('pagination');
		$config['per_page'] = 100;
		$total = $this->article_model->getTotal($where);
		$config['total_rows'] = $data['total_rows'] = $total;
		$page_num = !empty($_GET['per_page']) ? $_GET['per_page'] : 0;
		$this->pagination->initialize($config); 
		$data['pagination'] = $this->pagination->create_links();
		
		// get article data
		$data['article'] = $this->article_model->getTable($where, $config['per_page'].','.$page_num, 'date DESC');
		
		// get category data
		$this->load->model('category_model');
		$cat_arr = $this->category_model->getTable();
		$num = count($data['article']);
		for ($i = 0; $i < $num; $i++) 
		{
			foreach ($cat_arr as $c) 
			{
				if ($data['article'][$i]['cid'] == $c['cid'])
				{
					$data['article'][$i]['cat'] = $c['name'];
				}
			}
		}
		$this->load->view($data['admin_theme'].'/news-index', $data);
	}
	
	public function add()
	{
		if (empty($_POST))
		{
			//$this->data['cid'] = $cid;
			$this->load->model('category_model');
			$this->data['cat_tree'] = $this->category_model->getCatList(1);
			$this->data['lang'] = $this->session->userdata('lang')==null?'en':$this->session->userdata('lang');
			$this->load->view($this->data['admin_theme'].'/news-edit', $this->data);
		}
		else
		{
			$post = $_POST;
			$post['lang'] = 'en';
			$post['date'] = strtotime($post['date']);
			$flag = $this->article_model->add($post);
			if ($flag)
			{
				//addSysLog('增加新闻：'.$post['title']);
				showmsg(site_url().'admin/news/');
			}
			else 
			{
				showmsg(site_url().'admin/news/add/', 'Error');
			}
		}
	}
	
	public function edit($id)
	{
		if (empty($_POST))
		{
			$this->load->model('category_model');
			$this->data['cat_tree'] = $this->category_model->getCatList(1);
			$this->data['lang'] = $this->session->userdata('lang');
			$this->data['article'] = $this->article_model->getOne($id, 'aid');
			$this->load->view($this->data['admin_theme'].'/news-edit', $this->data);
		}
		else
		{
			$post = $_POST;
			$post['date'] = strtotime($post['date']);
			$flag = $this->article_model->edit($post, 'aid');
			if ($flag)
			{
				//addSysLog('编辑新闻：'.$post['title']);
				showmsg(site_url().'admin/news/');
			}
			else 
			{
				showmsg(site_url().'admin/news/edit/'.$id, 'Error');
			}
		}
	}
	
	public function delete($id)
	{
		$cid = $this->session->userdata('cid');
		$flag = $this->article_model->delete($id, 'aid');
		if ($flag)
		{
			//addSysLog('删除新闻：'.$id);
			showmsg(site_url().'admin/news/');
		}
		else 
		{
			showmsg(site_url().'admin/news/index/'.$cid, 'Error');
		}
	}

		/**
	 *  update user's photo
	 */
	public function ajaxuploadimage() {
		// create folder
		$this->load->model('jobseeker_model');
		$uid = $this->session->userdata('uid');
		//$user_path = realpath(dirname(__FILE__))."/../../theme/default/users/";
		$user_path = FCPATH . 'attached/article/';
		$this->jobseeker_model->creatUserfolder ( $user_path.'/' ) or exit ( 'error: can not creat folder.' );
		// upload
		if (is_uploaded_file ( $_FILES ['avatar'] ['tmp_name'] )) {
			$file_name = uniqid().'-'.iconv('utf-8','gb2312',$_FILES['avatar']['name']);
			move_uploaded_file ( $_FILES ['avatar'] ['tmp_name'], $user_path .$file_name);
	
			exit('success|'.$file_name);
		} else {
			exit('error|can not upload avatar image.');
		}
	}
}