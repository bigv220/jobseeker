<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class category extends Admin_Controller {
	
	public $lang = '';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('category_model');
		/*$this->lang = $this->session->userdata('lang');
		if ('en' != $this->lang)
		{
			$this->category_model->table = 'category_'.$this->lang;
		}*/
	}
	
	public function index()
	{
		$data = $this->data;
		$data['cat'] = $this->category_model->getCatList(0);
		$this->load->view($data['admin_theme'].'/category-index', $data);
	}
	
	public function order()
	{
		if (empty($_POST))
		{
			redirect('admin/category/');
		} 
		else 
		{
			$post = $_POST;
			if ($this->category_model->order($post))
			{
				showmsg(site_url().'admin/category/');
			} 
			else 
			{
				showmsg(site_url().'admin/category/', 'Error');
			}
		}
	}
	
	public function edit($id)
	{
		if (empty($_POST))
		{
			$data = $this->data;
			$data['cat'] = $this->category_model->getOne($id, 'cid');
			$data['cat_tree'] = $this->category_model->getCatList(0);
			$this->load->view($data['admin_theme'].'/category-edit', $data);
		}
		else 
		{
			$post = $_POST;
			if($this->category_model->edit($post,'cid'))
			{
				addSysLog('修改分类：'.$post['name']);
				showmsg(site_url().'admin/category/');
			}
			else 
			{
				showmsg(site_url().'admin/category/edit/'.$id, 'Error');
			}
		}
	}
	
	public function add()
	{
		if (empty($_POST))
		{
			$data = $this->data;
			$data['cat_tree'] = $this->category_model->getCatList(0);
			$this->load->view($data['admin_theme'].'/category-edit', $data);
		}
		else
		{
			$post = $_POST;
			$flag = $this->category_model->add($post);
			if ($flag)
			{
				addSysLog('增加分类：'.$post['name']);
				showmsg(site_url().'admin/category/');
			}
			else 
			{
				showmsg(site_url().'admin/category/add/', 'Error');
			}
		}
	}
	
	public function delete($id)
	{
		// 检查是否有子分类
		if ($this->category_model->getOne($id, 'pid'))
		{
			alertmsg('Sorry, This category has Subcategory, Please delete first.');
		}
		// 检查分类下是有有文章
		$this->load->model('article_model');
		$flag = $this->article_model->getOne($id, 'cid');
		if ($flag)
		{
			alertmsg('Sorry, This category has data, Please delete articles first.');
		}
		// 删除分类数据
		$flag = $this->category_model->delete($id, 'cid');
		if ($flag)
		{
			addSysLog('修改了分类：'.$id);
			showmsg(site_url().'admin/category/');
		}
		else 
		{
			showmsg(site_url().'admin/category/', 'Error');
		}
	}
	
	/**
	 * 根据模型跳转对应的编辑页面
	 * @param unknown_type $model
	 * @param unknown_type $id
	 */
	/*
	public function turn($model, $cid)
	{
		switch ($model) 
		{
			case 'page':
				$this->load->model('article');
				$rst = $this->article->getOne($cid, 'cid', $this->lang);
				if ($rst)// edit page
				{
					redirect('admin/page/edit/'.$rst['aid']);
				}
				else // add page
				{
					redirect('admin/page/add/'.$cid);
				}
			break;
			
			case 'link':
				redirect('admin/cat/edit/'.$cid);
			break;
			
			case 'news';
				redirect('admin/news/index/'.$cid);
			break;
			
			case 'profile';
				redirect('admin/profile/index/'.$cid);
			break;
			
			default:
				exit('model error.');;
			break;
		}
	}
	*/
}