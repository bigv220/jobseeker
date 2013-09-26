<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class index extends Front_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$data = $this->data;
        $this->load->library('session');

		$this->load->model('article_model');
		$data['news_list'] = $this->article_model->getLatestArtical();

        $data['uid'] = $this->session->userdata('uid')?$this->session->userdata('uid'):-1;
        $data['first_name'] = $this->session->userdata('first_name');
        $data['last_name'] = $this->session->userdata('last_name');

        $this->load->model('jobseeker_model');
        //get today's hot jobs

        //get newest job seekers
        $data['newest_jobseekers'] = $this->jobseeker_model->getNewestJobSeekers(4);
        $this->load->view($data['front_theme'].'/index', $data);
	}

    public function newsletter(){
        $this->load->model('newsletter_model');
        $status = true;
        $message = "The email address has been added to our newsletter successfully.";

        if(!$this->newsletter_model->checkExisting($_POST['newsletter_email'])){//insert this email to newsletter list
            $this->newsletter_model->addToNewsletter($_POST['newsletter_email']);
        }
        else{
            $status = false;
            $message = "The email is already in our newsletter.";
        }
        echo json_encode(array('status'=>$status, 'message'=>$message));
    }
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */