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
        $data['hot_news'] = $this->article_model->getListByCat('hot-news', 'en', 1);
        $data['expat_profile'] = $this->article_model->getListByCat('expat-profile', 'en', 1);

        $data['stories'] = $this->article_model->getListByCat('top-stories', 'en', 4);
        $data['events'] = $this->article_model->getListByCat('upcoming-events', 'en', 4);
        $this->load->view($data['front_theme'].'/news-index', $data);
    }

    public function view($aid)
    {
        $data = $this->data;
        //$url = $this->input->post($url, TRUE);
        $data['article'] = $this->article_model->getOne($aid, 'aid');
        $this->load->view($data['front_theme'].'/news-view', $data);
    }

    public function newsDetails(){
        $data = $this->data;
        $data['hot_news'] = $this->article_model->getListByCat('hot-news', 'en', 1);
        $data['stories'] = $this->article_model->getListByCat('top-stories', 'en', 3);
        $this->load->view($data['front_theme'].'/news-details', $data);
    }

    public function expatProfile(){
        $data = $this->data;
        $data['expat_profile'] = $this->article_model->getListByCat('expat-profile', 'en', 1);
        $this->load->view($data['front_theme'].'/expat-profile', $data);
    }

    public function topStories(){
        $data = $this->data;
        $this->load->view($data['front_theme'].'/top-stories', $data);
    }
}
