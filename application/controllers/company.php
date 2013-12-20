<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Employer Controller, Registraion, Profile page, etc.
*
**/
class company extends Front_Controller {
	
	public function __construct()
	{
		parent::__construct();
        $this->load->library('session');
	}
	
	public function index()
	{
		$data = $this->data;
        $this->load->view($data['front_theme']."/company-info",$data);
	}

	public function register() {
        if (!$this->session->userdata('uid'))
        {
            redirect('/');
        }
		$data = $this->data;
		
        $uid = $this->session->userdata('uid');
        //Load Model            
        $this->load->model('company_model');

        $post = $_POST; // will do security filter here
        
		if ($post) {
			
			// set up default avatar
			if (empty($post['avatar'])) {
				$post['avatar'] = $data['site_url'] . 'attached/users/no-image.png';
			}
			
            if (isset($post['name']) && !isset($post['last_name'])) {
                $this->company_model->updateBasicInfo($post);    
            } elseif (!isset($post['first_name']) && isset($post['last_name'])) {
                $this->company_model->updateContactDetail($post);
            } else {
                $this->company_model->updateBasicInfo($post);    
                $this->company_model->updateContactDetail($post);
            }
			
			
            $msg = "success";
            $result['status'] = $msg;
            echo json_encode($result);
		} else {

	        $data["uid"] = $uid;
	        // get location
	        $this->load->helper('location');
	        $data['location'] = getLoction();

            //industry lists
            $this->load->model('jobseeker_model');
            $industry = $this->jobseeker_model->getIndustry();
	        $data["industry_list"] = $industry;
	        $basic_info = $this->company_model->getUserInfo($uid);
	        $data['industries'] = $this->company_model->getIndustry($uid);
	        //$contact_detail = $this->company_model->getContactDetail($uid);
	
	        $data["basic_info"] = $basic_info;
	        //$data["contact_detail"] = $contact_detail;
	
			$this->load->view($data['front_theme']."/company-register",$data);
		}
	}

    public function companyInfo($company_id){
    	if (empty($company_id)) {
    		redirect('/');
    	}

        $this->load->model('company_model');
        $this->load->model('job_model');
        $data = $this->data;

        //Save the user who reviewed it
        $uid = $this->session->userdata('uid');
        if($uid != $company_id) {
            $this->company_model->saveCompanyViewed($uid, $company_id, date('Y-m-d'));
        }

        $data["jobinfo"] = $this->job_model->getCompanyJobList($company_id);
        $data["info"] = $this->company_model->getUserInfo($company_id);
        $data['industries'] = $this->company_model->getIndustry($company_id);
        $this->load->view($data['front_theme']."/company-info",$data);
    }

    public function companyProfile(){
        if (!$this->session->userdata('uid'))
        {
            redirect('/');
        }
        $data = $this->data;
        $this->load->model('company_model');
        
        $company_id = $this->session->userdata('uid');
        $this->load->model('job_model');
        //get data from db
     
        $data = $this->data;
        $data["jobinfo"] = $this->job_model->getCompanyJobList($company_id);
        $data["info"] = $this->company_model->getUserInfo($company_id);
        $data['industries'] = $this->company_model->getIndustry($company_id);

        $this->load->model('jobseeker_model');
        $interview_num = $this->jobseeker_model->getInterviews("i.company_id=$company_id and is_deleted=0");
        $data['interview_num'] = count($interview_num);
        $this->load->model('inbox_model');
        $data['chat_unread'] = $this->inbox_model->getUnReadMessageNum($company_id);

        $this->load->view($data['front_theme']."/company-profile",$data);
    }


    public function shortlistCandidates(){
        if (!isCompany($this->session->userdata('user_type'))) {
            securelychk();
        }

        $uid = $this->session->userdata('uid');
        if (!$uid)
        {
            redirect('/');
        }

        $this->load->model('jobseeker_model');
        $this->load->model('company_model');
        $data = $this->data;
        if (isset($_GET['uid'])) {
            $uid = $_GET['uid'];
        } else {
            $uid = $this->session->userdata('uid');
        }


        $data['userinfo'] = $this->jobseeker_model->getUserInfo($uid);
        if (!isset($_GET['keywords']) || $_GET['keywords'] == 'Enter Keywords') {
            $filter = '';
        } else {
            $filter = $_GET['keywords'];
        }

        // Get All Chat Message of this user, include SENT AND RECEIVED
        $this->load->model('inbox_model');
        $chats = $this->inbox_model->getGeneralMsgForUser($this->session->userdata('uid'));

        $data['candidates'] = $this->company_model->getCandidatesForCompany($uid, $filter);
        foreach ($data['candidates'] as $key=>$value) {
            $data['candidates'][$key]['industry_arr'] = $this->jobseeker_model->getSeekingIndustry($data['candidates'][$key]['uid']);
            $data['candidates'][$key]['educations'] = $this->jobseeker_model->getAllEducationInfo($data['candidates'][$key]['uid']);
            $data['candidates'][$key]['work_history'] = $this->jobseeker_model->getAllWorkHistory($data['candidates'][$key]['uid']);
            $data['candidates'][$key]['industry_arr'] = $this->jobseeker_model->getSeekingIndustry($data['candidates'][$key]['uid']);
            $data['candidates'][$key]['languages'] = $this->jobseeker_model->getLanguage($data['candidates'][$key]['uid']);

            $personal_arr = $this->jobseeker_model->getPersonalSkills($data['candidates'][$key]['uid']);
            //filter personal skills
            if(!empty($post["PersonalSkills_str"])) {
                $post_arr = explode(',', $post["PersonalSkills_str"]);

                $delete_flag = true;
                foreach ($personal_arr as $v) {
                    if (in_array($v['personal_skill'] , $post_arr) === TRUE) {
                        $delete_flag = false;
                    }
                }
                if($delete_flag) {
                    unset($data['candidates'][$key]);
                    continue;
                }
            }
            $data['candidates'][$key]['personal_skills'] = $personal_arr;

            //filter Technical skills
            $technical_arr = $this->jobseeker_model->getProfessionalSkills($data['candidates'][$key]['uid']);
            if(!empty($post["ProfessionalSkills_str"])) {
                $post_arr = explode(',', $post["ProfessionalSkills_str"]);

                $delete_flag = true;
                foreach ($technical_arr as $v) {
                    if (in_array($v['professional_skill'] , $post_arr) === TRUE) {
                        $delete_flag = false;
                    }
                }
                if($delete_flag) {
                    unset($data['candidates'][$key]);
                    continue;
                }
            }
            $data['candidates'][$key]['professional_skills'] = $technical_arr;
             // Jingchat
            if (isset($chats[$data['candidates'][$key]['uid']])) {
                $data['candidates'][$key]['jingchat'] = $chats[$data['candidates'][$key]['uid']];            
            }
        }

        $interview_num = $this->jobseeker_model->getInterviews("i.uid=$uid and is_deleted=0");
        $data['interview_num'] = count($interview_num);
        $this->load->model('inbox_model');
        $data['chat_unread'] = $this->inbox_model->getUnReadMessageNum($uid);

        $this->load->model('job_model');
        $current_user_jobs = $this->job_model->getCompanyJobList($uid);
        $data['current_user_jobs'] = $current_user_jobs;

        $this->load->view($data['front_theme']."/company_view_shortlist_cadidates",$data);
    }

    
    public function joblisting() {
    	$uid = $this->session->userdata('uid');
    	if (!$uid)
    	{
    		redirect('/');
    	}
    	
    	$data = $this->data;
    	$this->load->model('jobseeker_model');
    	$data['userinfo'] = $this->jobseeker_model->getUserInfo($uid);

        // get location
        $this->load->helper('location');
        $data['location'] = getLoction();

        $data['selected_tab'] = 1;

        $post = $_POST;
        $where = "  WHERE uid=$uid";
        if($post) {
            if ($post["search_keywords"] == 'Enter Keywords') {
                $post['search_keywords'] = '';
            }
            if(!empty($post["search_keywords"])) {
                $where .= " AND job.job_name like '%" . $post["search_keywords"] . "%' or u.username like '%". $post['search_keywords'] ."%'";
            }

            $data['selected_tab'] = 3;
        }
    	
    	$this->load->model('job_model');
        $jobs = $this->job_model->searchJob($where);

        foreach($jobs as $key=>&$job) {
            $job['languages'] = $this->job_model->getJobLang($job['id']);
        }

        $data['jobs'] = $jobs;

        // get the number of interviews
        $interview_num = $this->jobseeker_model->getInterviews("i.company_id=$uid and is_deleted=0");
        $data['interview_num'] = count($interview_num);

        //get the number of messages
        $this->load->model('inbox_model');
        $data['chat_unread'] = $this->inbox_model->getUnReadMessageNum($uid);

    	$this->load->view($data['front_theme']."/company_job_listing",$data);
    }

    public function addCandidate() {
        $uid = $this->session->userdata('uid');
        if (!$uid)
        {
            redirect('/');
        }

        $this->load->model('company_model');
        $post = array('company_id'=>$uid, 'user_id'=>$_POST['user_id']);
        $insert_id = $this->company_model->addCandidate($post);

        if ($insert_id != -1) {
            $msg = "success";
        } else {
            $msg = "failed";
        }
        $result['status'] = $msg;
        echo json_encode($result);
    }
}