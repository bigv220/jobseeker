<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class news extends Front_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('article_model');
    }

    public function index()
    {
        //redirect('/');
        $data = $this->data;
        $this->load->view($data['front_theme'].'/news-index', $data);
    }

    public function view($aid)
    {
        $data = $this->data;
        //$url = $this->input->post($url, TRUE);
        $data['article'] = $this->article_model->getOne($aid, 'aid');
        $this->load->view($data['front_theme'].'/page', $data);
    }
}
