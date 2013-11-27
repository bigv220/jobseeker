<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Job Controller, Job details page, etc.
 *
 **/
class inbox extends Front_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function index()
    {
        $this->load->model('jobseeker_model');
        $data = $this->data;
        if (isset($_GET['uid'])) {
            $uid = $_GET['uid'];
        } else {
            $uid = $this->session->userdata('uid');
        }

        $data['userinfo'] = $this->jobseeker_model->getUserInfo($uid);
        $this->load->view($data['front_theme'].'/inbox-index', $data);
    }

}
