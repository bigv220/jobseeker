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
        $this->load->helper('time');
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

        $data['mode'] = $this->uri->segment(3);

        if (isset($_GET['uid'])) {
            $uid = $_GET['uid'];
        } else {
            $uid = $this->session->userdata('uid');
        }
        // Get current login user info
        $data['userinfo'] = $this->jobseeker_model->getUserInfo($uid);
        // Set Me ID
        $data['uid'] = $uid;

        // get message list
        if ($data['mode'] == 'jingchat') {
            $data['messages'] = $this->inbox_model->getMsg($uid);
        } else if($data['mode'] == 'sent') {
            $data['messages'] = $this->inbox_model->getMsgSentByMe($uid);
        } else {
            $data['messages'] = $this->inbox_model->getTrashMsg($uid);
        }
        $data['unread'] = $this->inbox_model->getUnReadMessageNum($uid);
        // Get first detail msg
        if (!empty($data['messages'])) {
            $data['msg_detail'] = $this->inbox_model->getDetailMsg($data['messages'][0]['id']);    
        }

        // Get other user's info, name and profile img
        if (!empty($data['msg_detail'])) {
            $user1 = $data['msg_detail'][0]['user1'];
            $user2 = $data['msg_detail'][0]['user2'];

            if ($user1 == $uid) {
                $data['other_user'] = $this->jobseeker_model->getUserInfo($user2);                
            } else {
                $data['other_user'] = $this->jobseeker_model->getUserInfo($user1);                
            }
        }

        
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
            
            $this->inbox_model->addMsg($post);
        }

        $this->load->view($data['front_theme'].'/inbox-sentmsg',$data);
    }

    public function getDetailMsg() 
    {
        $data = $this->data;

        $this->load->model('jobseeker_model');
        if (isset($_GET['uid'])) {
            $uid = $_GET['uid'];
        } else {
            $uid = $this->session->userdata('uid');
        }
        // Get current login user info
        $data['userinfo'] = $this->jobseeker_model->getUserInfo($uid);

        $this->load->model('inbox_model');
        
        $data['msg_detail'] = $this->inbox_model->getDetailMsg($_POST['msg_id']);   
        // Get other user's info, name and profile img
        if (!empty($data['msg_detail'])) {
            $user1 = $data['msg_detail'][0]['user1'];
            $user2 = $data['msg_detail'][0]['user2'];

            if ($user1 == $uid) {
                $data['other_user'] = $this->jobseeker_model->getUserInfo($user2);                
            } else {
                $data['other_user'] = $this->jobseeker_model->getUserInfo($user1);                
            }
        } 
        // Update to read for this msg
        $this->inbox_model->updateMessageToRead($_POST['msg_id']);

        $detail_msg = $this->load->view($data['front_theme'].'/inbox-detailmsg',$data);
        echo $detail_msg;
    }

    public function response()
    {
        $id = $_POST['id'];
        $data = $this->data;
        $this->load->model('inbox_model');
        $seq = $this->inbox_model->getMaxSeqForId($id);
        

        $post = array('id'=>$id,'seq'=>$seq+1,'title'=>isset($_POST['title'])?$_POST['title']:"",'message'=>$_POST['message'],'user1'=>$this->session->userdata('uid'),
                'user2'=>$_POST['user2'], 'timestamp'=>time(), 'user1read'=>'yes','user2read'=>'no','is_delete'=>0,'is_offline'=>1);
            
        $this->inbox_model->addMsg($post);
        $data['message'] = $post['message'];
        $data['timestamp'] = $post['timestamp'];

        $this->load->model('jobseeker_model');
        if (isset($_GET['uid'])) {
            $uid = $_GET['uid'];
        } else {
            $uid = $this->session->userdata('uid');
        }
        $data['userinfo'] = $this->jobseeker_model->getUserInfo($uid);
        
        $newmsg = $this->load->view($data['front_theme'].'/inbox-onemsg',$data);
        echo $newmsg;
    }

    public function delete() 
    {
        $id = $_POST['id'];
        $this->load->model('inbox_model');
        $this->inbox_model->deleteMessage($id);
    }

}
