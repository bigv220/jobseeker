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
        $uid = $this->session->userdata('uid');
        if (!$uid)
        {
            redirect('/');
        }
    }

    public function index()
    {
        $this->load->model('jobseeker_model');
        $this->load->model('inbox_model');
        $data = $this->data;
        if (isset($_GET['uid'])) {
            $uid = $_GET['uid'];
        } else {
            $uid = $this->session->userdata('uid');
        }

        $data['userinfo'] = $this->jobseeker_model->getUserInfo($uid);
        $data['messages'] = $this->inbox_model->getmsg($uid);
        $this->load->view($data['front_theme'].'/inbox-index', $data);
    }

    public function sendmsg()
    {
        $this->load->model('inbox_model');
        $data = $this->data;
        if (isset($_POST['title'])) {
            // Get ID
            $id = $this->inbox_model->getMaxMessageId();
            if ($id === 0) {
                echo "Error occured"; exit;
            }
            $post = array('id'=>$id+1,'seq'=>1,'title'=>$_POST['title'],'message'=>$_POST['message'],'user1'=>$this->session->userdata('uid'),
                'user2'=>$_POST['user2'], 'timestamp'=>time(), 'user1read'=>'yes','user2read'=>'no','is_delete'=>0,'is_offline'=>1);
            
            $this->inbox_model->addmsg($post);
        }

        $this->load->view($data['front_theme'].'/inbox-sentmsg',$data);
    }

}
