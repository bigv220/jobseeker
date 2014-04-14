	<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Employer Controller, Registraion, Profile page, etc.
 *
 **/
class jobseeker extends Front_Controller
{
    public function __construct()
    {
        parent::__construct();  
        //$this->load->helper('json');    
    }

    public function index()
    {
        redirect('/');
    }

    /**
     * Jobseeker registration
     */
    public function register() {
        //$this->load->library('session');
    	$uid = $this->session->userdata('uid');
        if (!$uid)
        {
            redirect('/');
        }
        //Load Model
        $this->load->model('jobseeker_model');

        $data = $this->data;
        

        $register_step = $this->jobseeker_model->getRegisterStep($uid);
        if(empty($register_step)) {
            $step_arr = array();
        } else {
            $step_arr = explode('&', $register_step);
        }

        // get location
        $this->load->helper('location');
        $data['location'] = getLoction();
        
        //get data from db
        $userinfo = $this->jobseeker_model->getUserInfo($uid);
        $education_history = $this->jobseeker_model->getAllEducationInfo($uid);
        $workhistory = $this->jobseeker_model->getWorkHistory($uid);
        $personal_skills = $this->jobseeker_model->getPersonalSkills($uid);
        $professional_skills = $this->jobseeker_model->getProfessionalSkills($uid);
        //get language from db
        $language = $this->jobseeker_model->getLanguage($uid);
        $seekingIndustry = $this->jobseeker_model->getSeekingIndustry($uid);

        //industry lists
        $industry = $this->jobseeker_model->getIndustry();

        //generate year lists
        $year_arr = array();
        for($i = date('Y'); $i >= 1970; $i--) {
            array_push($year_arr, $i);
        }

        $month_arr = array();
        for($i = 1; $i <= 12; $i++) {
            array_push($month_arr, $i);
        }

        //language and level array
        $language_arr = language_arr();
        $level_arr = language_level();

        $userinfo['country'] = 'China';

        $data["uid"] = $uid;
        $data["userinfo"] = $userinfo;
        $data["education_history"] = $education_history;
        $data["work_history"] = $workhistory;
        $data["step_arr"] = $step_arr;
        $data["personal_skills"] = $personal_skills;
        $data['professional_skills'] = $professional_skills;
        $data['seekingIndustry'] = $seekingIndustry;
        $data["industry"] = $industry;
        $data['monthArray'] = $month_arr;
        $data['yearArray'] = $year_arr;

        //user language settings
        $data['language'] = $language;
        $data['language_arr'] = $language_arr;
        $data['level_arr'] = $level_arr;
        $this->load->view($data['front_theme']."/jobseeker-register",$data);
    }

    private function _saveRegisterStep($uid, $step) {
        //Load Model
        $this->load->model('jobseeker_model');

        $register_step = $this->jobseeker_model->getRegisterStep($uid);
        if(empty($register_step)) {
            $step_arr = array();
        } else {
            $step_arr = explode('&', $register_step);
        }

        if(!in_array($step, $step_arr)) {
            array_push($step_arr, $step);
        }

        //update register step according to the operations
        if( count($step_arr) ) {
            $reg_step_str = implode('&', $step_arr);
            $this->jobseeker_model->saveRegisterStep($uid, $reg_step_str);
        }
    }
    
    /*
     * Delete work history item 
     */
    public function deleteWorkHistoryItem() {
        $this->load->model('jobseeker_model');
        $work_id = $_POST['work_id'];
        
        if ($work_id != 0 && $work_id != null) {
            if ($this->jobseeker_model->delWorkHistory($work_id)) {
	            if ($this->jobseeker_model->delWorkHistoryIndustry($work_id)) {
	                echo true; 
	            } else {
	                echo false;
                    }
            } else {
                echo false;
            }
        } else {
            redirect('/');
        }
    }
    
    public function getWorkHistoryRow() {
        $this->load->model('jobseeker_model');
        $work_id = $_POST['work_id'];
        
        $work_history = $this->jobseeker_model->getWorkHistoryFromId($work_id);
        
        if ($work_history == null) {
            $work_history = $this->jobseeker_model->getWorkHistoryWithoutIndustry($work_id);
        }
        
        echo json_encode($work_history);
    }
    
    
    /*
     * Delete education history item 
     */

    public function deleteEducationHistoryItem() {
        $this->load->model('jobseeker_model');
        $edu_id = $_POST['edu_id'];

        if ($edu_id != 0 && $edu_id != null) {
            if ($this->jobseeker_model->delEducationHistory($edu_id)) {
                echo true;
            } else {
                echo false;
            }
        } else {
            redirect('/');
        }
    }

    /*
     * Get selected education history row to edit 
     */

    public function getEducationHistoryRow() {
        $this->load->model('jobseeker_model');
        $edu_id = $_POST['edu_id'];

        $education = $this->jobseeker_model->getEducationHistoryFromId($edu_id);

        echo json_encode($education);
    }
    
    

    /**
     * View personal profile.
     * 
     * 
     * */
    public function profile(){
        $this->load->model('jobseeker_model');

        $data = $this->data;
        if (isset($_GET['uid'])) {
            $uid = $_GET['uid'];
        } else {
            $uid = $this->session->userdata('uid');
        }

        $data['userinfo'] = $this->jobseeker_model->getUserInfo($uid);
        $data['education_info'] = $this->jobseeker_model->getAllEducationInfo($uid);
        $data['workhistory'] = $this->jobseeker_model->getAllWorkHistory($uid);
        $data['personal_skills'] = $this->jobseeker_model->getPersonalSkills($uid);
        $data['professional_skills'] = $this->jobseeker_model->getProfessionalSkills($uid);
        //get language from db
        $data['language'] = $this->jobseeker_model->getLanguage($uid);
        $data['seekingIndustry'] = $this->jobseeker_model->getAllSeekingIndustry($uid);
        $data['similar_peoples'] = $this->jobseeker_model->getSimilarUsers($uid);
        //get the number of interviews user received
        $interview_num = $this->jobseeker_model->getInterviews("i.uid=$uid and is_deleted=0");
        $data['interview_num'] = count($interview_num);
        $this->load->model('inbox_model');
        $data['chat_unread'] = $this->inbox_model->getUnReadMessageNum($uid);
        $this->load->view($data['front_theme']."/jobseeker-profile",$data);
    }
    public function viewProfile(){
    $this->load->model('jobseeker_model');

    $data = $this->data;
    if (isset($_GET['uid'])) {
        $uid = $_GET['uid'];
    } else {
        $uid = $this->session->userdata('uid');
    }

    $data['userinfo'] = $this->jobseeker_model->getUserInfo($uid);
    $data['education_info'] = $this->jobseeker_model->getAllEducationInfo($uid);
    $data['workhistory'] = $this->jobseeker_model->getAllWorkHistory($uid);
    $data['personal_skills'] = $this->jobseeker_model->getPersonalSkills($uid);
    $data['professional_skills'] = $this->jobseeker_model->getProfessionalSkills($uid);
    //get language from db
    $data['language'] = $this->jobseeker_model->getLanguage($uid);
    $data['seekingIndustry'] = $this->jobseeker_model->getAllSeekingIndustry($uid);
    $data['similar_peoples'] = $this->jobseeker_model->getSimilarUsers($uid);

    $this->load->model('portfolioproject_model');
    $data['portfolio_projects'] = $this->portfolioproject_model->getUserPortfolioProjects($uid);

    //get the number of interviews user received
    $interview_num = $this->jobseeker_model->getInterviews("i.uid=$uid and is_deleted=0");
    $data['interview_num'] = count($interview_num);
    $this->load->model('inbox_model');
    $data['chat_unread'] = $this->inbox_model->getUnReadMessageNum($uid);
    //get the top 3 jobs user applied
    $this->load->model('job_model');
    $applied_jobs = $this->job_model->getAppliedJobByUser($uid);
    $data['applied_jobs'] = array_slice($applied_jobs, 0, 3);
    //industry lists
    $industry = $this->jobseeker_model->getIndustry();
    $data["industry"] = $industry;
    //get the top 3 companies user reviewed
    $viewed_company = $this->jobseeker_model->getViewedCompany($uid);
    $data['viewed_company'] = $viewed_company;
    $data['language_arr'] = language_arr();
    $this->load->view($data['front_theme']."/jobseeker-myprofile",$data);
}
    public function savedBookmarks(){
        $uid = $this->session->userdata('uid');
        if (!$uid)
        {
            redirect('/');
        }

        $this->load->model('jobseeker_model');

        $data = $this->data;
        if (isset($_GET['uid'])) {
            $uid = $_GET['uid'];
        } else {
            $uid = $this->session->userdata('uid');
        }

        $post = $_POST;
        $where = " WHERE user_id=$uid";
        $where_arr = array();
        $filter_type = 'jobs';
        $jobs = array();
        $companies = array();
        if($post) {
            if ($post["keywords"] == 'Enter Keywords') {
                $post['keywords'] = '';
            }

            if($post['filter_type'] == 'jobs') {
                if(!empty($post["keywords"])) {
                    array_push($where_arr, "job_name like '%" . $post["keywords"] . "%'");
                }

                if(!empty($post["country"])) {
                    array_push($where_arr, "job.country='" .$post["country"]."'");
                }
                if(!empty($post["province"])) {
                    array_push($where_arr, "job.province='" .$post["province"]."'");
                }
                if(!empty($post["city"])) {
                    array_push($where_arr, "job.city='" .$post["city"]."'");
                }

                if (!empty($post['industry'])) {
                    for($i=0;$i<count($post['industry']);$i++) {
                        if(!empty($post["industry"][$i])) {
                            array_push($where_arr, "jip.industry like '%".$post["industry"][$i]."%'");
                        }
                    }
                }
            }// filter type "if" condition

            if($post['filter_type'] == 'companies') {
                $filter_type = 'companies';
                if(!empty($post["keywords"])) {
                    array_push($where_arr, "username like '%" . $post["keywords"] . "%'");
                }

                if(!empty($post["country"])) {
                    array_push($where_arr, "u.country='" .$post["country"]."'");
                }
                if(!empty($post["province"])) {
                    array_push($where_arr, "u.province='" .$post["province"]."'");
                }
                if(!empty($post["city"])) {
                    array_push($where_arr, "u.city='" .$post["city"]."'");
                }

                if (!empty($post['industry'])) {
                    for($i=0;$i<count($post['industry']);$i++) {
                        if(!empty($post["industry"][$i])) {
                            array_push($where_arr, "ci.industry like '%".$post["industry"][$i]."%'");
                        }
                    }
                }
            }// filter type judgement
        }

        // get where string
        if(count($where_arr)) {
            $where_str = implode(' AND ', $where_arr);

            if(count($where_arr)) {
                $where .= " AND " . $where_str;
            }
        }

        $this->load->model('job_model');
        if($filter_type == 'jobs') {
            // get jobs according to the search
            $jobs = $this->job_model->searchBookmarkedJob($where);

            foreach($jobs as $key=>$v) {
                $jobs[$key]['industry_arr'] = $this->job_model->getJobIndustry($jobs[$key]['id']);

                $jobs[$key]['other_jobs'] = $this->job_model->getCompanyJobList($jobs[$key]['company_id']);
            }
        } else {
            // get jobs according to the search
            $this->load->model('company_model');
            $companies = $this->company_model->searchBookmarkedCompany($where);
            foreach($companies as $key=>$v) {
                $companies[$key]['jobs'] = $this->job_model->getCompanyJobList($v['company_id']);
            }
        }

        $data['jobs'] = $jobs;
        $data['companies'] = $companies;
        $data['filter_type'] = $filter_type;

        //the left side, industry lists
        $industry = $this->jobseeker_model->getIndustry();
        $data["industry"] = $industry;

        // get location
        $this->load->helper('location');
        $data['location'] = getLoction();

        $data['userinfo'] = $this->jobseeker_model->getUserInfo($uid);

        $interview_num = $this->jobseeker_model->getInterviews("i.uid=$uid and is_deleted=0");
        $data['interview_num'] = count($interview_num);
        $this->load->model('inbox_model');
        $data['chat_unread'] = $this->inbox_model->getUnReadMessageNum($uid);
        $this->load->view($data['front_theme']."/jobseeker-saved-bookmarks",$data);
    }

    public function viewAppliedJobs(){
        $uid = $this->session->userdata('uid');
        if (!$uid)
        {
            redirect('/');
        }

        $this->load->model('jobseeker_model');

        $data = $this->data;
        if (isset($_GET['uid'])) {
            $uid = $_GET['uid'];
        } else {
            $uid = $this->session->userdata('uid');
        }


        $data['userinfo'] = $this->jobseeker_model->getUserInfo($uid);
        $this->load->view($data['front_theme']."/jobseeker-applied-jobs",$data);
    }

    public function viewInterviews(){
        $uid = $this->session->userdata('uid');
        if (!$uid)
        {
            redirect('/');
        }

        $this->load->model('jobseeker_model');

        $data = $this->data;
        if (isset($_GET['uid'])) {
            $uid = $_GET['uid'];
        } else {
            $uid = $this->session->userdata('uid');
        }
        $data['userinfo'] = $this->jobseeker_model->getUserInfo($uid);

        if (1 == $this->session->userdata('user_type')) {
            $where = 'i.company_id=' . $uid . ' And is_deleted=0';
        } else {
            $where = 'i.uid=' . $uid . ' And is_deleted=0';
        }

        $post = $_POST;
        if($post) {
            if ($post["interview_keywords"] == 'Enter Keywords') {
                $post['interview_keywords'] = '';
            }
            if(!empty($post["interview_keywords"])) {
                 $where .= " AND j.job_name like '%" . $post["interview_keywords"] . "%' or u.username like '%". $post['interview_keywords'] ."%'";
            }
        }

        $this->load->model('job_model');

        $interviews = $this->jobseeker_model->getInterviews($where);
        for($i=0; $i<count($interviews);$i++) {
            $positions = $this->job_model->getJobIndustry($interviews[$i]['id']);
            $interviews[$i]['position_arr'] = $positions;
        }
        $data['interviews'] = $interviews;
        $data['selected_tab'] = 1;

        $this->load->model('inbox_model');
        $data['chat_unread'] = $this->inbox_model->getUnReadMessageNum($uid);

        $this->load->view($data['front_theme']."/jobseeker-view-interviews",$data);
    }

    public function getInterviewsInTrash(){
        $uid = $this->session->userdata('uid');
        if (!$uid)
        {
            redirect('/');
        }

        $this->load->model('jobseeker_model');

        $data = $this->data;
        if (isset($_GET['uid'])) {
            $uid = $_GET['uid'];
        } else {
            $uid = $this->session->userdata('uid');
        }
        $data['userinfo'] = $this->jobseeker_model->getUserInfo($uid);

        if (1 == $this->session->userdata('user_type')) {
            $where = 'i.company_id=' . $uid . ' And is_deleted=1';
        } else {
            $where = 'i.uid=' . $uid . ' And is_deleted=1';
        }

        $this->load->model('job_model');
        $interviews = $this->jobseeker_model->getInterviews($where);
        for($i=0; $i<count($interviews);$i++) {
            $positions = $this->job_model->getJobIndustry($interviews[$i]['job_id']);
            $interviews[$i]['position_arr'] = $positions;
        }
        $data['interviews'] = $interviews;
        $data['selected_tab'] = 2;

        $this->load->model('inbox_model');
        $data['chat_unread'] = $this->inbox_model->getUnReadMessageNum($uid);

        $this->load->view($data['front_theme']."/jobseeker-view-interviews",$data);
    }

    public function updateDescription(){
        $this->load->model('jobseeker_model');
        $uid = $this->session->userdata('uid');
        $post = $_POST;
        $status = "failed";
        if($post){
            $rtn = $this->jobseeker_model->updateUserDescription($uid, $post['description']);
            if($rtn){
                $status = "success";
            }
        }
        $result['status'] = $status;
        echo json_encode($result);
    }

    public function updatePhoneNumber(){
        $this->load->model('jobseeker_model');
        $uid = $this->session->userdata('uid');
        $post = $_POST;
        $status = "failed";
        if($post){
            $rtn = $this->jobseeker_model->updatePhoneNumber($uid, $post['phoneNumber']);
            if($rtn){
                $status = "success";
            }
        }
        $result['status'] = $status;
        echo json_encode($result);
    }

    public function updateSNSInfos(){
        $this->load->model('jobseeker_model');
        $uid = $this->session->userdata('uid');
        $post = $_POST;
        $status = "failed";
        if($post){
            $rtn = $this->jobseeker_model->updateSNSInfos($uid, $post);
            if($rtn){
                $status = "success";
            }
        }
        $result['status'] = $status;
        echo json_encode($result);
    }

    public function updateProfileSeekingIndustry(){
        $this->load->model('jobseeker_model');
        $uid = $this->session->userdata('uid');
        $post = $_POST;
        $status = "failed";
        if($post){
            // delete old industry data
            $this->jobseeker_model->delSeekingIndustry($uid);
            //save seeking industry to db
            $industry_len = count($post['industry_1']);
            for($i=0; $i<$industry_len;$i++) {
                if($post['industry_1'][$i] && $post['position_1'][$i]) {
                    $this->jobseeker_model->addSeekingIndustry($uid, $post['industry_1'][$i], $post['position_1'][$i]);
                }
            }
            $status = "success";
        }
        $result['status'] = $status;
        echo json_encode($result);
    }

    //save basic info
    public function basicInfo() {
        //Load Model
        $this->load->model('jobseeker_model');

        $post = $_POST;
        $uid = $this->session->userdata('uid');

        if ($post) {
            $rtn = $this->jobseeker_model->updateBasicInfo($uid, $post);

            if($rtn) {
                $msg = "success";
                $this->_saveRegisterStep($uid, 1);
            } else {
                $msg = "failed";
            }

            $result['status'] = $msg;
            echo json_encode($result);
        }
    }

    //save birthday
    public function updateBirthday() {
        //Load Model
        $this->load->model('jobseeker_model');

        $post = $_POST;
        $uid = $this->session->userdata('uid');

        if ($post) {
            $rtn = $this->jobseeker_model->updateBirthday($uid, $post);

            if($rtn) {
                $msg = "success";
            } else {
                $msg = "failed";
            }

            $result['status'] = $msg;
            echo json_encode($result);
        }
    }

    //save contact details
    public function contactdetails() {
        //Load Model
        $this->load->model('jobseeker_model');

        $post = $_POST;
        $uid = $this->session->userdata('uid');

        if ($post) {
        
		if ($post['website'] != "")  {
	                if (strncasecmp('http://', $post['website'], 7) && strncasecmp('https://', $post['website'], 8)) {
	                    $post['website'] = "http://" . $post['website'];
	                }
	        }
	        
	        if ($post['linkedin'] != "")  {
	                if (strncasecmp('http://', $post['linkedin'], 7) && strncasecmp('https://', $post['linkedin'], 8)) {
	                    $post['linkedin'] = "http://" . $post['linkedin'];
	                }
	        }
	        
	        if ($post['twitter'] != "")  {
	                if (strncasecmp('http://', $post['twitter'], 7) && strncasecmp('https://', $post['twitter'], 8)) {
	                    $post['twitter'] = "http://" . $post['twitter'];
	                }
	        }
	        
	        if ($post['weibo'] != "")  {
	                if (strncasecmp('http://', $post['weibo'], 7 && strncasecmp('https://', $post['weibo'], 8))) {
	                    $post['weibo'] = "http://" . $post['weibo'];
	                }
	        }
	        
	        if ($post['facebook'] != "")  {
	                if (strncasecmp('http://', $post['facebook'], 7) && strncasecmp('https://', $post['facebook'], 8)) {
	                    $post['facebook'] = "http://" . $post['facebook'];
	                }
	        }

        
            $rtn = $this->jobseeker_model->updateContactDetails($uid, $post);

            $socialNetwork = $post['socialNetwork'];
            $networkArray = explode(',', $socialNetwork);

            $this->jobseeker_model->deleteSocialNetwork($uid);
            foreach($networkArray as $v) {
                $this->jobseeker_model->addSocialNetwork($uid, $v);
            }

            if($rtn) {
                $msg = "success";
                $this->_saveRegisterStep($uid, 2);
            } else {
                $msg = "failed";
            }

            $result['status'] = $msg;
            echo json_encode($result);
        }
    }

    //save preference
    public function preferences() {
        //Load Model
        $this->load->model('jobseeker_model');
        $this->load->model('match_model');
        
        $post = $_POST;
        $uid = $this->session->userdata('uid');

        if ($post) {

            $rtn = $this->jobseeker_model->updatePreferences($uid, $post);

            // delete old industry data
            $this->jobseeker_model->delSeekingIndustry($uid);
            //save seeking industry to db
            $industry_len = count($post['industry_1']);
            for($i=0; $i<$industry_len;$i++) {
                if($post['industry_1'][$i] && $post['position_1'][$i]) {
                    $this->jobseeker_model->addSeekingIndustry($uid, $post['industry_1'][$i], $post['position_1'][$i]);
                    
                    $data_arr                   =   array('industry'=>$post['industry_1'][$i],'position'=>$post['position_1'][$i]);
                    $industry_position_array[]  =   $data_arr;
                }
            }
            
            $industry_position                              =       $this->match_model->generateIndustryPositionInfo($industry_position_array); 
            $employment_type_id                             =       $this->match_model->getEmploymentTypeId($post['employment_type']);
            $match_score_info['employment_type']            =       $employment_type_id;
            $match_score_info['employment_length']          =       1; //$post['employment_length'];
            $match_score_info['industry_position']          =       $industry_position;
            $match_score_info['is_visa_assistance']         =       $post['is_visa_assistance'];
            $match_score_info['is_housing_assistance']      =       $post['is_accomodation_assistance'];

            $this->match_model->createRecordIfNotExists($uid,$job_id=0); // All usertypes are 4 during SIGNUP.Call record creation during SIGNUP.
            $this->match_model->updateRecordUsingUserID($uid,$match_score_info);            

            if($rtn) {
                $msg = "success";
                $this->_saveRegisterStep($uid, 3);
            } else {
                $msg = "failed";
            }

            $result['status'] = $msg;
            echo json_encode($result);
        }
    }

    //save education
    public function education() {
        //Load Model
        $this->load->model('jobseeker_model');

        $post = $_POST;
        $uid = $this->session->userdata('uid');
        $edu_id = $post['hidden_education_history_id'];

        if ($post) {
            //save schools to db
            if ($post['school_name']) {
                $data = array('uid' => $post['uid'], 'school_name' => $post['school_name'],
                    'attend_date_from' => $post['attended_from'] . '-' . $post['attended_from_month'],
                    'attend_date_to' => $post['attended_to'] . '-' . $post['attended_to_month'],
                    'degree' => $post['degree'],
                    'major' => $post['major'], 'achievements' => $post['achievements']);

                if ($edu_id != 0) {
                    $this->jobseeker_model->updateEducationHistory($edu_id, $data);
                } else {
                    $edu_id = $this->jobseeker_model->insertEducation($data);
                }


                if ($edu_id != 0) {
                    $msg = $edu_id;
                    $this->_saveRegisterStep($uid, 4);
                } else {
                    $msg = "failed";
                }

                $result['status'] = $msg;
                echo json_encode($result);
            }
        }
    }

    //save workhistory
    public function workhistory() {
        //Load Model
        $this->load->model('jobseeker_model');

        $post = $_POST;
        $uid = $this->session->userdata('uid');
        $work_id = $post['hidden_work_history_id'];

        if ($post) {
            //save job to db     
            if ($post['company_name']) {
                $work_example = $post['work_example'] ? $post['work_example'] : '';

                $desc = $post['description'] == '350 Characters' ? '' : $post['description'];

                $data = array('uid' => $post['uid'], 'introduce' => null,
                    'company_name' => $post['company_name'],
                    'period_time_from' => $post['period_time_from'] . '-' . $post['period_time_from_month'],
                    'period_time_to' => $post['period_time_to'] . '-' . $post['period_time_to_month'],
                    'location' => null, 'description' => $desc, 'is_stillhere' => $post['is_stillhere'],
                    'work_examples_url' => $work_example);

                if ($work_id != 0) {
                    $this->jobseeker_model->updateWorkHistory($work_id, $data);
                } else {
                    $work_id = $this->jobseeker_model->insertWorkHistory($data);
                }

                $data_arr = array('parent_id' => $work_id, 'uid' => $post["uid"], 'industry' => $post['industry'][0], 'position' => $post['position'][0]);
                if ($post['ind_id'][0]) {
                    $this->jobseeker_model->updateUserIndustry($post['ind_id'][0], $data_arr);
                } else {
                    $this->jobseeker_model->insertUserIndustry($data_arr);
                }

                $msg = $work_id;
                $this->_saveRegisterStep($uid, 5);

                $result['status'] = $msg;
                echo json_encode($result);
            }
        }
    }
    
    

    //save language
    public function language() {
        //Load Model
        $this->load->model('jobseeker_model');
        $this->load->model('match_model');
        
        $post = $_POST;
        $uid = $this->session->userdata('uid');

        if ($post) {
        	// delete old language data
        	$this->jobseeker_model->delLanguage($uid);
            //save language to db
            $lan_len = count($post['language']);
            for($i=0; $i<$lan_len;$i++) {
                if($post['language'][$i]) {
                    $data = array('uid'=>$uid,
                        'language'=>$post['language'][$i],
                        'level'=>$post['level'][$i]);

                    $rtn = $this->jobseeker_model->insertLanguage($data);
                    
                    $language_level_array[] =   $data;
                }
            }
            $language_level                                 =       $this->match_model->generateLanguageLevelInfoUsingText($language_level_array);
            $match_score_info['language_level']             =       $language_level;
            $this->match_model->createRecordIfNotExists($uid,$job_id=0); // All usertypes are 4 during SIGNUP.Call record creation during SIGNUP.
            $this->match_model->updateRecordUsingUserID($uid,$match_score_info);

            if($rtn) {
                $msg = "success";
                $this->_saveRegisterStep($uid, 6);
            } else {
                $msg = "failed";
            }

            $result['status'] = $msg;
            echo json_encode($result);
        }
    }

    /**
     * delete personal skills
     */
    public function delPersonalSkills() {
        $post = $_POST;
        $uid = $post['uid'];
        $skill = $post['skill'];

        // create folder
        $this->load->model('jobseeker_model');
        $this->jobseeker_model->delPersonalSkills($uid, $skill);

        $msg = "success";
        $result['status'] = $msg;
        echo json_encode($result);
    }

    /**
     * add personal skills
     */
    public function addPersonalSkills() {
        $post = $_POST;
        $uid = $this->session->userdata('uid');
        $skill = $post['skill'];

        if (!empty($uid)) {
            // create folder
            $this->load->model('jobseeker_model');
            $this->jobseeker_model->addPersonalSkills($uid, $skill);

            $this->_saveRegisterStep($uid, 7);

            $msg = "success";
        } else {
            $msg = "failed";
        }
        $result['status'] = $msg;
        echo json_encode($result);
    }

    /**
     * add professional skills
     */
    public function addProfessionalSkills() {
        $post = $_POST;
        $uid = $this->session->userdata('uid');
        $skill = $post['skill'];

        if (!empty($uid)) {
            // create folder
            $this->load->model('jobseeker_model');
            $this->jobseeker_model->addProfessionalSkills($uid, $skill);

            $this->_saveRegisterStep($uid, 8);
            $msg = "success";
        } else if ($this->session->userdata('user_type') == 0) {
            $msg = "success";
        } else {
            $msg = "failed";
        }
        
        $result['status'] = $msg;
        echo json_encode($result);
    }

    /**
     * delete professional skills
     */
    public function delProfessionalSkills() {
        $post = $_POST;
        $uid = $post['uid'];
        $skill = $post['skill'];
        if (isset($uid)) {
            // create folder
            $this->load->model('jobseeker_model');
            $this->jobseeker_model->delProfessionalSkills($uid, $skill);

            $msg = "success";
        } else if ($this->session->userdata('user_type') == 0) {
            $msg = "success";
        } else {
            $msg = "failed";
        }
        $result['status'] = $msg;
        echo json_encode($result);
    }

    /**
     * This function receive an IMAGE File uploaded from User-View Profile -> Portfolio section. 
     * The image is uploaded using Ajax File Upload. 
     * 
     * It checks whether the image is valid (jpg/gif/png) and size less than 10mb.
     * User have a limit of 12 Images in their Portfolio.
     * 
     * It returns the File Name, on completion.
     */
    public function ajaxuploadfile()
    {
        $data                       =   $this->data;
        $uid                        =   $this->session->userdata('uid');
    
        $this->load->model('portfolioproject_model');
        $image_upload_directory     =   FCPATH.'attached/workExamples/tmp/';
               
        $error                      =   FALSE; // Not an image or not an allowed image type.
        $error_message              =   ''; // Store Error Message to send back to calling page.
       
        /**
         * Image Type & Size Validation.
         * 
         * Type can be Gif/PNG/JPEG 
         * Size muts be less than 10 MB.
         */
        if ($error == FALSE AND is_uploaded_file($_FILES['workexample']['tmp_name']))
        {            
            // Type Validation
            $sizes              =       getimagesize($_FILES['workexample']['tmp_name']);
            if($sizes[2] == 1)
                    $imgformat	=	strtoupper('gif');
            elseif($sizes[2] == 2)
                    $imgformat	=	strtoupper('jpg');
            elseif($sizes[2] == 3)
                    $imgformat	=	strtoupper('png');
            else
            {
                 $error         =       TRUE; // Not an image or not an allowed image type.
                 $error_message =       'Only jpg/png/gif image is allowed.';
            }
            
            // Size Validation.
            if($error == FALSE AND ($_FILES['workexample']['size']/1048576) > 10): // A Megabyte is 1,048,576 bytes. Limit is 10 MB
                $error         =       TRUE; // Not an image or not an allowed image type.
                $error_message =       'Image with less than 10MB is allowed.';            
            endif;   
            
            // Limit Validation    
            if($error == FALSE AND $this->portfolioproject_model->canUploadPortfolioImage($uid)==FALSE):
                $error                  =       TRUE; 
                $error_message          =       'You have reached the allowed Portfolio Limit of 12 Images.';                 
            endif;
        }
        else
        {
            $error         =       TRUE; // Not an image or not an allowed image type.
            $error_message =       'Image Upload failed. Please try again.';     
        }        
        
        if($error==FALSE):

            $unique_name	=	$uid.'_'.uniqid().'.'.strtolower($imgformat);             

            move_uploaded_file($_FILES ['workexample']['tmp_name'],$image_upload_directory.$unique_name);
            
            $this->portfolioproject_model->proportionThumbGeneration($unique_name,'attached/workExamples/tmp/','attached/workExamples/500/',500,275);
            chmod('attached/workExamples/500/'.$unique_name, 0644);
            
            $this->portfolioproject_model->proportionThumbGeneration($unique_name,'attached/workExamples/tmp/','attached/workExamples/200/',200,275);
            chmod('attached/workExamples/200/'.$unique_name, 0644);
            
            exit('success|'.$unique_name);
            
        else:
           
            exit("$error_message");
            
        endif;
        
        
        
        
    }

    public function personalskillsautocomplete() {
        $q = $_GET["q"];
        $rtn_str = '';

        $this->load->model('jobseeker_model');
        $arr = $this->jobseeker_model->getSkills('personal_skills', $q);

        foreach($arr as $v) {
            $rtn_str = $rtn_str == ''?$v["skill"]:($rtn_str."|".$v["skill"]);
        }

        exit($rtn_str);
    }

    public function professionalskillsautocomplete() {
        $q = $_GET["q"];
        $rtn_str = '';

        $this->load->model('jobseeker_model');
        $arr = $this->jobseeker_model->getSkills('tech_skills', $q);

        foreach($arr as $v) {
            $rtn_str = $rtn_str == ''?$v["skill"]:($rtn_str."|".$v["skill"]);
        }

        exit($rtn_str);
    }
    
    public function ajaxlocation($key, $selected, $country=null) {
    	$this->load->helper('location');
    	$location = getLoction();
    	if("country" == $key) {
    		echo json_encode( array_keys( $location[$selected] ) );
    		exit;
    	}
    	if("province" == $key) {
            $selected = urldecode($selected);
    		echo json_encode( $location[$country][$selected] );
    		exit;
    	}
    }

    public function ajaxchangeindustry() {
        $post = $_POST;
        $name = $post['ind_name'];

        // load model
        $this->load->model('jobseeker_model');
        $rtn = $this->jobseeker_model->getPosition($name);

        $msg = "success";
        $result['data'] = $rtn;
        $result['status'] = $msg;
        echo json_encode($result);
    }

    public function delSeekingIndustry() {
        $post = $_POST;
        $uid = $post['uid'];
        $ind = $post['industry'];
        $pos = $post['position'];

        // load model
        $this->load->model('jobseeker_model');
        $this->jobseeker_model->delSeekingIndusry($uid, $ind, $pos);

        $msg = "success";;
        $result['status'] = $msg;
        echo json_encode($result);
    }

    public function delUserIndustry() {
        $post = $_POST;
        $id = $post['id'];

        // load model
        $this->load->model('jobseeker_model');
        $this->jobseeker_model->delUserIndusry($id);

        $msg = "success";;
        $result['status'] = $msg;
        echo json_encode($result);
    }

    public function delLanguage() {
        $post = $_POST;
        $uid = $uid = $this->session->userdata('uid');
        $language = $post['language'];

        // load model
        $this->load->model('jobseeker_model');
        $this->jobseeker_model->delLanguage($uid, $language);

        $msg = "success";;
        $result['status'] = $msg;
        echo json_encode($result);
    }

    public function addPortfolioProject(){
        $post = $_POST;
        $result = array('pid'=>-1);
        $this->load->model('portfolioproject_model');
        $result['pid'] = $this->portfolioproject_model->addProject($post);
        //select all projects of the current user, so that his portfolio list will be update with js code
        $result['portfolio_projects'] = $this->portfolioproject_model->getUserPortfolioProjects($post['uid']);
        echo json_encode($result);
    }

    public function readPortfolioTextFileContent(){
        $post = $_POST;
        $result = array('content'=>'Loading content...');
        $this->load->helper('file');
        $result['content'] = read_file($post['file_path']);
        echo json_encode($result);
    }

    public function deletePortfolioProject(){
        $post = $_POST;
        $result = array('status'=>"error");
        $this->load->model('portfolioproject_model');
        $deleted = $this->portfolioproject_model->delProject($post['pid']);
        if($deleted){//delete the uploaded file
            $this->load->helper('file');
            delete_files($post['file']);
            $result['status'] = 'success';
            //select all projects of the current user, so that his portfolio list will be update with js code
            $result['portfolio_projects'] = $this->portfolioproject_model->getUserPortfolioProjects($post['uid']);
        }

        echo json_encode($result);
    }
}