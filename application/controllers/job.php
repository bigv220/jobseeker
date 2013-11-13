<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Job Controller, Job details page, etc.
 *
 **/
class job extends Front_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function index()
    {
        redirect('/');
    }

    public function jobDetails($job_id) {
    	$data = $this->data;
    	
//        $visa_assistance = array('1'=>'Visa will be provided','0'=>'Visa will not be provided');
//        $housing_assistance = array('1'=>'Accomodation will be provided','0'=>'Accomodation will not be provided');
//    	$data['constants_arr'] = array(
//    								'visa_assist'=>$visa_assistance,
//    								'housing_assist'=>$housing_assistance
//    								);
    	
    	//Load Model
        $this->load->model('job_model');
        //get data from db
        $jobinfo = $this->job_model->getJobInfo($job_id);

        // get company avatar
        $this->load->model('company_model');
        $compinfo = $this->company_model->getOne($jobinfo['company_id'], 'uid');
        $data['company_id'] = $jobinfo['company_id'];
        $data["company_avatar"] = $compinfo['profile_pic'];

        //get job languages
        $job_languages = $this->job_model->getJobLanguages($job_id);
        $data['job_languages'] = $job_languages;

        // get similar jobs
        $industry_position = $this->job_model->getJobIndustry($job_id);
        $industry_arr = array();
        foreach ($industry_position as $industry) {
           $industry_arr[] = $industry['industry'];
        }
        if (count($industry_position) > 0) {
            $industry = $industry_position[0]['industry'];
        } else {
            $industry = "";
        }
        $similar_jobs = $this->job_model->getSimilarJobs($job_id, $industry);
        
		$data['jobinfo'] = $jobinfo;
        $data['industry'] = $industry_arr;
        $data["similar_jobs"] = $similar_jobs;
        $this->load->view($data['front_theme']."/job-details",$data);
    }
    
    public function postjob() {
    	
    	if (!isCompany($this->session->userdata('user_type'))) {
    		securelychk();
    	}
    	
    	$data = $this->data;
        $this->load->model('jobseeker_model');
        //industry lists
        $uid = $this->session->userdata('uid');
        $data["industry"] = $this->jobseeker_model->getIndustry();
        $data["professional_skills"] = $this->jobseeker_model->getProfessionalSkills($uid);
        $data["personal_skills"] = $this->jobseeker_model->getProfessionalSkills($uid);
        // get location
        $this->load->helper('location');
        $data['location'] = getLoction();

    	if (empty($_POST)) {

    		$this->load->view($data['front_theme']."/job-postjob",$data);
    	} else {
    		$post = $_POST;
    		$post['post_date'] = date('Y-m-d', time());
    		if (1 == $this->session->userdata('user_type')) {
    			$post['company_id'] = $this->session->userdata('uid');
    		}
    		
    		if (empty($post['company_id'])) {
    			securelychk();
    		}

    		//Load Model
    		$this->load->model('job_model');
            unset($post['nameOfSelect']);

            $data = array('job_name'=>$post['job_name'],'job_desc'=>$post['job_desc'],
                'employment_length'=>$post['employment_length'],
                'employment_type'=>$post['employment_type'],
                'preferred_personal_skills'=>$post['preferred_personal_skills'],
                'preferred_technical_skills'=>$post['preferred_technical_skills'],
                'location'=>$post['location'],'country'=>$post['country'],'province'=>$post['province'],
                'city'=>$post['city'],'salary_range'=>$post['salary_range'],
                'preferred_year_of_experience'=>$post['preferred_year_of_experience'],
                'post_date'=>$post['post_date'],
                'company_id'=>$post['company_id']);
    		$result['status'] = $job_id = $this->job_model->saveJob($data);

            if($result['status']) {
                $user_name = $this->session->userdata('first_name').' '.$this->session->userdata('last_name');

                $this->load->library('email');
                $this->email->from('do-not-reply@jingjobs.com', 'JingJobs');
                $this->email->to('info@jingjobs.com');
                $this->email->subject('A new job is posted.');
                $this->email->message('<HTML><BODY><div>'.$user_name . 'post a new job.</div></BODY></HTML>');
                if($this->email->send()) {
                    //$message = 'Post job successful!';
                } else {
                    //$message = 'Post job failed.';
                }
            }

            for($i=0; $i<count($post["language"]);$i++) {
                $data_arr = array('job_id'=>$job_id,'language'=>$post['language'][$i],'level'=>$post['language_level'][$i]);
                $this->job_model->insertJobLanguage($data_arr);
            }//end for

            for($i=0; $i<count($post["industry"]);$i++) {
                $data_arr = array('job_id'=>$job_id,'industry'=>$post['industry'][$i],'position'=>$post['position'][$i]);
                $this->job_model->insertJobIndustry($data_arr);
            }//end for

    		$result['status'] = $result['status'] ? 'success' : 'failed.';
            $result['id'] = $job_id;
    		echo json_encode($result);
    	}
    }

    /**
     * Jobseeker apply job AJAX request.
     * 
     **/
    public function apply() {
        $uid = $this->session->userdata('uid');
        if (empty($uid)) {
            $result['status'] = 'login';
            echo json_encode($result);
            exit;
        }
        if (!empty($_POST['job_id']) && !empty($uid)) {
            // do apply
            $this->load->model('job_model');
            $result['status'] = $this->job_model->applyJob($_POST['job_id'], $uid, 1);

            $result['status'] = $result['status'] ? 'success' : 'failed.';

            $user_name = $this->session->userdata('first_name').' '.$this->session->userdata('last_name');
            if (isset($_POST['email'])) {
                $this->load->library('email');
                $this->email->from('do-not-reply@jingjobs.com', 'JingJobs');
                $this->email->to($_POST['email']);
                $this->email->subject('New Job Application');
                $this->email->message('<HTML><BODY><div>Hi '.$user_name . ',<br/>Your company has received a new job appliation, Please login 
                    <a href="http://www.jingjobs.com">Jingjobs</a> to view.</div>
                    <br />
                    <div>Thank you!</div><br />
                    <a href="http://www.jingjobs.com">Jingjobs Team</a></BODY></HTML>');
                $this->email->send();
            }
            echo json_encode($result);
        }

    }

}
