<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Employer Controller, Registraion, Profile page, etc.
 *
 **/
class jobseeker extends Front_Controller {

    public function __construct()
    {
        parent::__construct();
       
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
        $education_info = $this->jobseeker_model->getEducationInfo($uid);
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
        $data["education_info"] = $education_info;
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
            $positions = $this->job_model->getJobIndustry($interviews[$i]['job_id']);
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
                }
            }

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

        if ($post) {
            //we should delete all schools related to this jobseeker
            $this->jobseeker_model->deleteEducation($uid);
            //save schools to db
            $school_len = count($post['school_name']);
            for($i=0; $i<$school_len;$i++) {
                if($post['school_name'][$i]) {
                    $data = array('uid'=>$post['uid'],'school_name'=>$post['school_name'][$i],
                        'attend_date_from'=>$post['attended_from'][$i] . '-' . $post['attended_from_month'][$i],
                        'attend_date_to'=>$post['attended_to'][$i] . '-' . $post['attended_to_month'][$i],
                        'degree'=>$post['degree'][$i],
                        'major'=>$post['major'][$i],'achievements'=>$post['achievements'][$i]);

                    $rtn = $this->jobseeker_model->insertEducation($data);
                }
            }

            if($rtn) {
                $msg = "success";
                $this->_saveRegisterStep($uid, 4);
            } else {
                $msg = "failed";
            }

            $result['status'] = $msg;
            echo json_encode($result);
        }
    }

    //save workhistory
    public function workhistory() {
        //Load Model
        $this->load->model('jobseeker_model');

        $post = $_POST;
        $uid = $this->session->userdata('uid');

        if ($post) {
            //save job to db
            $company_len = count($post['company_name']);
            for($i=0; $i<$company_len;$i++) {
                $id = $post["id"][$i];
                if($id) {
                    // delete old jobs
                    $this->jobseeker_model->delWorkHistory($id);
                }

                if($post['company_name'][$i]) {
                    $work_example = $post['work_example'][$i]?$post['work_example'][$i]:'';

                    $desc = $post['description'][$i] == '350 Characters' ? '' : $post['description'][$i];

                    $data = array('uid'=>$post['uid'],'introduce'=>$post['introduce'][$i],
                        'company_name'=>$post['company_name'][$i],
                        'period_time_from'=>$post['period_time_from'][$i].'-'.$post['period_time_from_month'][$i],
                        'period_time_to'=>$post['period_time_to'][$i].'-'.$post['period_time_to_month'][$i],
                        'location'=>null,'description'=>$desc,'is_stillhere'=>$post['is_stillhere'][$i],
                        'work_examples_url'=>$work_example);

                    $id = $this->jobseeker_model->insertWorkHistory($data);

                    $user_industry_num = $post["grop_num"][$i];
                    $num = $i*$post["grop_num"][0] + $user_industry_num;
                    for($j=$i*$post["grop_num"][0];$j<$num;$j++) {
                        $data_arr = array('parent_id'=>$id,'uid'=>$post["uid"],'industry'=>$post['industry'][$j],'position'=>$post['position'][$j]);
                        $this->jobseeker_model->insertUserIndustry($data_arr);
                    }//end for
                }//end if
            }

            $msg = "success";
            $this->_saveRegisterStep($uid, 5);

            $result['status'] = $msg;
            echo json_encode($result);
        }
    }

    //save language
    public function language() {
        //Load Model
        $this->load->model('jobseeker_model');

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
                }
            }

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

    //upload work examples
    public function ajaxuploadfile() {
        $data = $this->data;

        $uid = $this->session->userdata('uid');
        // load model
        $this->load->model('jobseeker_model');
        $user_path = FCPATH . 'attached/workExamples/';
        $this->jobseeker_model->creatUserfolder ( $user_path.$uid.'/' ) or exit ( 'error: can not creat folder.' );
        // upload
        if (is_uploaded_file ( $_FILES ['workexample'] ['tmp_name'] )) {
            $file_name = $uid.'/'.uniqid().'-'.iconv('utf-8','gb2312',$_FILES['workexample']['name']);
            move_uploaded_file ( $_FILES ['workexample'] ['tmp_name'], $user_path .$file_name);
            exit ( 'success|'.$file_name );
        } else {
            exit ( 'error: can not upload avatar image.' );
        }
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