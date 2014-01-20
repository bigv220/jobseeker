<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Employer Controller, Registraion, Profile page, etc.
 *
 **/
class search extends Front_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        redirect('search/searchJob');
    }

    public function searchJob() {
        $data = $this->data;

        $visa_assistance = array('1'=>'Visa will be provided','0'=>'Visa will not be provided');
        $housing_assistance = array('1'=>'Accomodation will be provided','0'=>'Accomodation will not be provided');

        //Load Model
        $this->load->model('job_model');
        $this->load->model('match_model');
        
        $this->load->helper('location');
        $data['location'] = getLoction();

        $data['selected_date'] = "";
        $data['salary_sort'] = "";

        //get all search conditions at the left side
        $post = $_POST;
        $where = '';
        $where_arr = array();
        $where_or = array();
        if($post) {
            if ($post["keywords"] == 'Enter Keywords') {
                $post['keywords'] = '';
            }
            if(!empty($post["keywords"])) {
                array_push($where_arr, "job_name like '%" . $post["keywords"] . "%'");
            }
            if(isset($post["top_search"]) && $post["top_search"]==1 && !empty($post["search_text"]) && $post["search_text"]!="Search our job database") {
                array_push($where_arr, "job_name like '%" . $post["search_text"] . "%' or job_desc like '%" . $post["search_text"]."%'");
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
            if(!empty($post["location"])) {
                array_push($where_arr, 'location=' .$post["location"]);
            }
            if(!empty($post["employment_length"])) {
                array_push($where_arr, 'job.employment_length='.$post["employment_length"]);
            }
            if(!empty($post["salary"])) {
                array_push($where_arr, 'salary_range='.$post["salary"]);
            }
            if(!empty($post["experience_year"])) {
                array_push($where_arr, 'preferred_year_of_experience='.$post["experience_year"]);
            }
            if(!empty($post["language"])) {
                array_push($where_arr, "jl.language=".$post["language"]);
            }

            if (!empty($post['industry'])) {
	            for($i=0;$i<count($post['industry']);$i++) {
	                if(!empty($post["industry"][$i])) {
	                    array_push($where_or, "jip.industry like '%".$post["industry"][$i]."%'");
	                }
	            }
            }

            if (!empty($post['position'])) {
	            for($i=0;$i<count($post['position']);$i++) {
	                if(!empty($post["position"][$i]) && $post["position"][$i]!='All Positions' && $post["position"][$i]!='none') {
	                    array_push($where_or, "jip.position like '%".$post["position"][$i]."%'");
	                }
	            }
            }
        }

        // get where string
        if(count($where_arr) || count($where_or)) {
            $where_str = implode(' AND ', $where_arr);
            $where_or_str = implode(' OR ', $where_or);

            if(count($where_arr) && count($where_or)) {
                $where .= ' WHERE ' . $where_str . " AND (" . $where_or_str . ")";
            } else {
                $where .= ' WHERE ' . $where_str . $where_or_str;
            }

        }

        // get jobs according to the search
        $jobs = $this->job_model->searchJob($where);
        if ($this->session->userdata('uid')) {
            $appyied_job = $this->job_model->getAppliedJobByUser($this->session->userdata('uid'));
        } else {
            $appyied_job = array();
        }
        $apply = array();
        foreach ($appyied_job as $a_job) {
            array_push($apply, $a_job['job_id']);
        }
        $data['apply'] = $apply;

        // get bookmarked jobs
        if ($this->session->userdata('uid')) {
            $bookmarked_job = $this->job_model->getBookmarkedJobByUser($this->session->userdata('uid'));
        } else {
            $bookmarked_job = array();
        }
        $bookmark = array();
        foreach ($bookmarked_job as $a_job) {
            array_push($bookmark, $a_job['job_id']);
        }
        $data['bookmark'] = $bookmark;

        // Filter employment_type
        if(!empty($post['employment_type'])) {
            $filter_employment_type = explode(",", $post['employment_type']);

            foreach ($jobs as $key => $one_job) {
                $employment_type_arr = explode(",", $one_job['employment_type']);

                foreach ($employment_type_arr as $one_type) {
                    if (in_array($one_type , $filter_employment_type) === FALSE) {
                        unset($jobs[$key]);
                    } else {
                        break;
                    }
                }

            }
        }

        //filter personal skills
        if(!empty($post["PersonalSkills_str"])) {
            $post_arr = explode(',', $post["PersonalSkills_str"]);

            foreach ($jobs as $key => $one_job) {
                $skills_arr = explode(",", $one_job['preferred_personal_skills']);

                $delete_flag = true;
                foreach ($skills_arr as $one_type) {
                    if (in_array($one_type , $post_arr) === TRUE) {
                        $delete_flag = false;
                    }
                }
                if($delete_flag) {
                    unset($jobs[$key]);
                }
            }
        }

        // filter technical skills
        if(!empty($post["ProfessionalSkills_str"])) {
            $post_arr = explode(',', $post["ProfessionalSkills_str"]);

            foreach ($jobs as $key => $one_job) {
                $skills_arr = explode(",", $one_job['preferred_technical_skills']);

                $delete_flag = true;
                foreach ($skills_arr as $one_type) {
                    if (in_array($one_type , $post_arr) === TRUE) {
                        $delete_flag = false;
                    }
                }
                if($delete_flag) {
                    unset($jobs[$key]);
                }
            }
        }

        foreach($jobs as $key=>$v) {
            $jobs[$key]['industry_arr'] = $this->job_model->getJobIndustry($jobs[$key]['id']);
        }
        
        // MATCH-SCORE Calculation
        if ($this->session->userdata('uid') != '' AND $this->session->userdata('user_type') ==0 AND (count($jobs)>0 AND is_array($jobs)==TRUE)) 
        {           
            // User is logged in and the User Type is "0" ie STAFF, we will shows MATCH%
            $jobs               =   $this->match_model->jobMatchPercentageForUser($jobs,$this->session->userdata('uid'));
            $jobs_match         =   1; // match calculation is performed.
        }
        else 
        {
           $jobs_match  =   '0'; // User is not logged in or not the prefered user type.      
        }
        
        $data['jobs_match'] = $jobs_match;
        $data['jobs']       = $jobs;
        
        //echo '<pre>'; print_r($data['jobs']); echo '</pre>';

        // generate job id string, this will be used in the filter function at the right side
        $job_id_str = '';
        if(count($jobs)) {
            foreach($jobs as $job) {
                if (isset($job['id'])) 
                    $job_id_str .= "," . $job['id'];
            }

            $job_id_str = substr($job_id_str, 1);
        }

        //the left side, industry lists
        $this->load->model('jobseeker_model');
        $industry = $this->jobseeker_model->getIndustry();
        $data["industry"] = $industry;

        $position = $this->jobseeker_model->getPosition('General');
        $data["position"] = $position;

        $data["job_id_str"] = $job_id_str;

        $constants = array(//'len_emp'=>$length_of_employment,
            //'type_emp'=>$type_of_employment,
            'visa_assist'=>$visa_assistance,
            'housing_assist'=>$housing_assistance);

        $data['constants_arr'] = $constants;
        $this->load->view($data['front_theme']."/search-job-result",$data);
    }

    public function filterJob() {
        $data = $this->data;

        //Load Model
        $this->load->model('job_model');

        $data['selected_date'] = "";
        $data['salary_sort'] = "";
        $data["job_id_str"] = "";

        $post = $_POST;
        $where = '';
        if($post) {
            if(!empty($post["post_date"])) {
                $post_date_timestamp = mktime(0, 0, 0, date("m"), date("d")-$post["post_date"], date("Y"));
                $post_date = date('Y-m-d', $post_date_timestamp);
                $where .= " WHERE post_date>='$post_date'";
            }

            if(!empty($post["jobIdStr"])) {
                $where .= " AND id in(" . $post["jobIdStr"] . ")";
            }

            if(!empty($post["salary_sort"])) {
                $salary_sort = $post["salary_sort"];
                $where .= " ORDER BY salary_range $salary_sort";
            }

            $data['selected_date'] = $post["post_date"];
            $data['salary_sort'] = $post["salary_sort"];
            $data["job_id_str"] = $post["jobIdStr"];
        }

        $jobs = $this->job_model->searchJob($where);
        $data['jobs'] = $jobs;

        //the left side, industry lists
        $this->load->model('jobseeker_model');
        $industry = $this->jobseeker_model->getIndustry();
        $data["industry"] = $industry;

        $position = $this->jobseeker_model->getPosition('General');
        $data["position"] = $position;

        $this->load->view($data['front_theme']."/search-job-result",$data);
    }

    public function staff() {
        $data = $this->data;

        //Load Model
        $this->load->model('job_model');

        $this->load->helper('location');
        $data['location'] = getLoction();

        $data['selected_date'] = "";
        $data['salary_sort'] = "";

        //get all search conditions at the left side
        $post = $_POST;
        $where = ' WHERE is_private=1 ';
        $where_arr = array();
        $where_or = array();
        if($post) {
            if ($post["keywords"] == 'Enter Keywords') {
                $post['keywords'] = '';
            }
            if(!empty($post["keywords"])) {
                array_push($where_arr, "username like '%" . $post["keywords"] . "%'");
            }

            if(!empty($post["country"])) {
                array_push($where_arr, "country='" .$post["country"]."'");
            }
            if(!empty($post["province"])) {
                array_push($where_arr, "province='" .$post["province"]."'");
            }
            if(!empty($post["city"])) {
                array_push($where_arr, "city='" .$post["city"]."'");
            }

            if(!empty($post["employment_length"])) {
                array_push($where_arr, 'employment_length='.$post["employment_length"]);
            }

            if(!empty($post["language"])) {
                array_push($where_arr, "ul.language='".$post["language"]."'");
            }
            if(!empty($post["PersonalSkills_str"])) {
                array_push($where_arr, "personal_skill like '%".$post["PersonalSkills_str"]."%'");
            }
            if(!empty($post["ProfessionalSkills_str"])) {
                array_push($where_arr, "professional_skill like '%".$post["ProfessionalSkills_str"]."%'");
            }

            for($i=0;$i<count($post['industry']);$i++) {
                if(!empty($post["industry"][$i])) {
                    array_push($where_or, "industry like '%".$post["industry"][$i]."%'");
                }
            }

            for($i=0;$i<count($post['position']);$i++) {
                if(!empty($post["position"][$i]) && $post["position"][$i]!='none') {
                    array_push($where_or, "position like '%".$post["position"][$i]."%'");
                }
            }
        }

        // get where string
        if(count($where_arr) || count($where_or)) {
            $where_str = implode(' AND ', $where_arr);
            $where_or_str = implode(' OR ', $where_or);

            if(count($where_arr) && count($where_or)) {
                $where .= 'AND ' . $where_str . " AND (" . $where_or_str . ")";
            } else {
                $where .= 'AND ' . $where_str . $where_or_str;
            }

        }

        // get jobs according to the search
        $staffs = $this->job_model->searchStaff($where);
        // Filter employment_type
        if(!empty($post['employment_type'])) {
            $filter_employment_type = explode(",", $post['employment_type']);

            foreach ($staffs as $key => $one_staff) {
                $employment_type_arr = explode(",", $one_staff['employment_type']);

                foreach ($employment_type_arr as $one_type) {
                    if (in_array($one_type , $filter_employment_type) === FALSE) {
                        unset($staffs[$key]);
                    } else {
                        break;
                    }
                }

            }
        }

        //Load Model
        $this->load->model('jobseeker_model');

        for($i=0; $i<count($staffs); $i++) {
            $staffs[$i]['educations'] = $this->jobseeker_model->getAllEducationInfo($staffs[$i]['uid']);
            $staffs[$i]['work_history'] = $this->jobseeker_model->getAllWorkHistory($staffs[$i]['uid']);
            $staffs[$i]['industry_arr'] = $this->jobseeker_model->getSeekingIndustry($staffs[$i]['uid']);
            $staffs[$i]['personal_skills'] = $this->jobseeker_model->getPersonalSkills($staffs[$i]['uid']);
            $staffs[$i]['professional_skills'] = $this->jobseeker_model->getProfessionalSkills($staffs[$i]['uid']);
            $staffs[$i]['languages'] = $this->jobseeker_model->getLanguage($staffs[$i]['uid']);
        }

        $data['staff_arr'] = $staffs;

        // generate job id string, this will be used in the filter function at the right side
        $staff_id_str = '';
        if(count($staffs)) {
            foreach($staffs as $staff) {
                $staff_id_str .= "," . $staff['uid'];
            }

            $staff_id_str = substr($staff_id_str, 1);
        }

        //the left side, industry lists
        $this->load->model('jobseeker_model');
        $industry = $this->jobseeker_model->getIndustry();
        $data["industry"] = $industry;

        $position = $this->jobseeker_model->getPosition('General');
        $data["position"] = $position;

        $data["staff_id_str"] = $staff_id_str;
        $this->load->view($data['front_theme']."/search-staff",$data);   
    }

    public function filterStaff() {
        $data = $this->data;

        //Load Model
        $this->load->model('job_model');

        $data['selected_date'] = "";
        //$data['salary_sort'] = "";
        $data["staff_id_str"] = "";

        $post = $_POST;
        $where = ' WHERE is_private=1 ';
        if($post) {
//            if(!empty($post["post_date"])) {
//                $post_date_timestamp = mktime(0, 0, 0, date("m"), date("d")-$post["post_date"], date("Y"));
//                $post_date = date('Y-m-d', $post_date_timestamp);
//                $where .= " WHERE post_date>='$post_date'";
//            }

            if(!empty($post["staffIdStr"])) {
                $where .= "AND uid in(" . $post["staffIdStr"] . ")";
            }

//            if(!empty($post["salary_sort"])) {
//                $salary_sort = $post["salary_sort"];
//                $where .= " ORDER BY salary_range $salary_sort";
//            }

//            $data['selected_date'] = $post["post_date"];
//            $data['salary_sort'] = $post["salary_sort"];
            $data["staff_id_str"] = $post["staffIdStr"];
        }

        $staffs = $this->job_model->searchStaff($where);

        //the left side, industry lists
        $this->load->model('jobseeker_model');
        
        for($i=0; $i<count($staffs); $i++) {
            $staffs[$i]['educations'] = $this->jobseeker_model->getAllEducationInfo($staffs[$i]['uid']);
            $staffs[$i]['work_history'] = $this->jobseeker_model->getAllWorkHistory($staffs[$i]['uid']);
            $staffs[$i]['industry_arr'] = $this->jobseeker_model->getSeekingIndustry($staffs[$i]['uid']);
            $staffs[$i]['personal_skills'] = $this->jobseeker_model->getPersonalSkills($staffs[$i]['uid']);
            $staffs[$i]['professional_skills'] = $this->jobseeker_model->getProfessionalSkills($staffs[$i]['uid']);
            $staffs[$i]['languages'] = $this->jobseeker_model->getLanguage($staffs[$i]['uid']);
        }
        $data['staff_arr'] = $staffs;

        $industry = $this->jobseeker_model->getIndustry();
        $data["industry"] = $industry;

        $position = $this->jobseeker_model->getPosition('General');
        $data["position"] = $position;

        $this->load->view($data['front_theme']."/search-staff",$data);
    }

    public function searchJobseeker() {
        $data = $this->data;
        $this->load->model('job_model');
        $this->load->model('match_model');
        //Only if a JOB is selected from Listing Manager. LEFT MENU SEARCH form submission url is modified with this value, if present.
        $url_params     =   $this->uri->uri_to_assoc();
        $jobid          =   0;
        if(array_key_exists('jobid', $url_params))
            $jobid      =   $url_params['jobid'];
        
        $post   =   $_POST;
        $where_arr = array();
        // get location
        $this->load->helper('location');
        $data['location'] = getLoction();
        
        $this->load->model('jobseeker_model');
        $data["industry"] = $this->jobseeker_model->getIndustry();
        
        if($post) {
            if ($post["keywords"] == 'Enter Keywords') {
                $post['keywords'] = '';
            }
            if(!empty($post["keywords"])) {
                array_push($where_arr, "first_name like '%" . $post["keywords"] . "%' or last_name like '%". $post['keywords'] ."'");
            }
            if(isset($post["top_search"]) && $post["top_search"]==1 && !empty($post["search_text"]) && $post["search_text"]!="Search our job database") {
                array_push($where_arr, "job_name like '%" . $post["search_text"] . "%' or job_desc like '%" . $post["search_text"]."%'");
            }
            if(!empty($post["country"])) {
                array_push($where_arr, "country='" .$post["country"]."'");
            }
            if(!empty($post["province"])) {
                array_push($where_arr, "province='" .$post["province"]."'");
            }
            if(!empty($post["city"])) {
                array_push($where_arr, "city='" .$post["city"]."'");
            }
            if(!empty($post["location"])) {
                array_push($where_arr, 'location=' .$post["location"]);
            }

            if(!empty($post["employment_length"])) {
                array_push($where_arr, 'employment_length='.$post["employment_length"]);
            }
            if(!empty($post["salary"])) {
                array_push($where_arr, 'salary_range='.$post["salary"]);
            }
          
            if(!empty($post["language"])) {
                array_push($where_arr, "language like '%".$post["language"]."%'");
            }
        }
        $where = " WHERE is_private=0 AND user_type = 0 ";
        if(count($where_arr)) {
            $where_str = implode(' AND ', $where_arr);
            $where .= 'AND ' . $where_str;
        }

        // get jobseekers according to the search
        $jobseekers = $this->job_model->searchJobseeker($where,$jobid); // Modified as part of MATCH% calculation. 
        // Filter employment_type
        if (!empty($post['employment_type'])) {
        $filter_employment_type = explode(",", $post['employment_type']);

            foreach ($jobseekers as $key => $one_job) {
                $employment_type_arr = explode(",", $one_job['employment_type']);
                
                foreach ($employment_type_arr as $one_type) {
                    if (in_array($one_type , $filter_employment_type) === FALSE) {
                        unset($jobseekers[$key]);
                    } else {
                        break;
                    }
                }
                
            }
        }

        // Get shortlist candiate
        $this->load->model('company_model');
        if ($this->session->userdata('uid')) {
            $candiates_arr = $this->company_model->getCandidateIdForCompany($this->session->userdata('uid'));
        } else {
            $candiates_arr = array();
        }
        $candidates = array();
        foreach ($candiates_arr as $value) {
            array_push($candidates, $value['user_id']);
        }
        // Get All Chat Message of this user, include SENT AND RECEIVED
        $this->load->model('inbox_model');
        $chats = $this->inbox_model->getGeneralMsgForUser($this->session->userdata('uid'));

        $ids = "";
        $this->load->model('portfolioproject_model');

        for($i=0; $i<count($jobseekers); $i++) {
            $ids .= $jobseekers[$i]['uid'].',';
            // Check if Shortlist Candidate is checked
            if (in_array($jobseekers[$i]['uid'], $candidates)) {
                $jobseekers[$i]['is_shortlisted'] = true;
            } else {
                $jobseekers[$i]['is_shortlisted'] = false;
            }
            //get portfolio projects of the user
            $jobseekers[$i]['portfolio_projects'] = $this->portfolioproject_model->getUserPortfolioProjects($jobseekers[$i]['uid']);

            $personal_arr = $this->jobseeker_model->getPersonalSkills($jobseekers[$i]['uid']);
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
                    unset($jobseekers[$i]);
                    continue;
                }
            }
            $jobseekers[$i]['personal_skills'] = $personal_arr;

            //filter Technical skills
            $technical_arr = $this->jobseeker_model->getProfessionalSkills($jobseekers[$i]['uid']);
            if(!empty($post["ProfessionalSkills_str"])) {
                $post_arr = explode(',', $post["ProfessionalSkills_str"]);

                $delete_flag = true;
                foreach ($technical_arr as $v) {
                    if (in_array($v['professional_skill'] , $post_arr) === TRUE) {
                        $delete_flag = false;
                    }
                }
                if($delete_flag) {
                    unset($jobseekers[$i]);
                    continue;
                }
            }
            $jobseekers[$i]['professional_skills'] = $technical_arr;

            $jobseekers[$i]['educations'] = $this->jobseeker_model->getAllEducationInfo($jobseekers[$i]['uid']);
            $jobseekers[$i]['work_history'] = $this->jobseeker_model->getAllWorkHistory($jobseekers[$i]['uid']);
            $jobseekers[$i]['industry_arr'] = $this->jobseeker_model->getSeekingIndustry($jobseekers[$i]['uid']);
            $jobseekers[$i]['languages'] = $this->jobseeker_model->getLanguage($jobseekers[$i]['uid']);

            // Jingchat
            if (isset($chats[$jobseekers[$i]['uid']])) {
                $jobseekers[$i]['jingchat'] = $chats[$jobseekers[$i]['uid']];            
            }
        }
        $data['ids'] = substr($ids, 0, -1);
        

        $uid = $this->session->userdata('uid');
        $current_user_jobs = $this->job_model->getCompanyJobList($uid);
        $data['current_user_jobs']      = $current_user_jobs;
        
        
        $data['jobid']                  = $jobid; // See the declaration in the top.
        // MATCH-SCORE Calculation
        if ($this->session->userdata('uid') != '' AND $this->session->userdata('user_type') ==1 AND $jobid !=0 AND (count($jobseekers)>0 AND is_array($jobseekers)==TRUE)) 
        {   
            // User is logged in and the User Type is "0" ie STAFF, we will shows MATCH%
            $jobseekers         =   $this->match_model->jobMatchPercentageForUser($jobseekers,0,$jobid);
            $jobs_match         =   1; // match calculation is performed.
        }
        else 
        {
           $jobs_match          =   '0'; // User is not logged in or not the prefered user type.      
        }
        
        $data['jobs_match']     =   $jobs_match;        
        
        $data['jobseekers']     =   $jobseekers;
        
        $this->load->view($data['front_theme']."/search-jobseeker-result",$data);
    }

    public function findstaff() {
        $data = $this->data;

         // get location
        $this->load->helper('location');
        $data['location'] = getLoction();
        
        //get recently jobs
        $this->load->model('job_model');
        $data['recently_jobs'] = $this->job_model->getRecentJobs();

        //the left side, industry lists
        $this->load->model('jobseeker_model');
        $industry = $this->jobseeker_model->getIndustry();
        $data["industry"] = $industry;

        $position = $this->jobseeker_model->getPosition('General');
        $data["position"] = $position;


        $tech_skills_arr = $this->jobseeker_model->getSkills('tech_skills','');
        $pro_skills_arr = $this->jobseeker_model->getSkills('personal_skills','');

        $data["tech_skills"] = $tech_skills_arr;
        $data["pro_skills"] = $pro_skills_arr;

        $this->load->view($data['front_theme']."/search-advance-staff",$data);   
    }

    public function findjob() {
        $data = $this->data;

        // get location
        $this->load->helper('location');
        $data['location'] = getLoction();
        
        //get recently jobs
        $this->load->model('job_model');
        $data['recently_jobs'] = $this->job_model->getRecentJobs();

        //the left side, industry lists
        $this->load->model('jobseeker_model');
        $industry = $this->jobseeker_model->getIndustry();
        $data["industry"] = $industry;

        $position = $this->jobseeker_model->getPosition('General');
        $data["position"] = $position;

        $tech_skills_arr = $this->jobseeker_model->getSkills('tech_skills','');
        $pro_skills_arr = $this->jobseeker_model->getSkills('personal_skills','');

        $data["tech_skills"] = $tech_skills_arr;
        $data["pro_skills"] = $pro_skills_arr;

        $this->load->view($data['front_theme']."/search-advance-job",$data);
    }

    //Send interview request
    public function sendinterviewrequest() {
        //Load Model
        $this->load->model('jobseeker_model');

        $post = $_POST;
        $uid = $this->session->userdata('uid');

        if ($post) {
            $data = array('uid'=>$post['jobseeker_uid'],'company_id'=>$uid,
                'job_id'=>$post['job_id'],
                'communication_type'=>$post['preferred_communication'],
                'message'=>$post['optional_message'],
                'communication_other'=>$post['other_preferred_communication'],
                'date'=>$post['interview_date'],'country'=>$post['country'],'city'=>$post['city'],
                'time'=>$post['time_input'],'insert_date'=>date('d/m/Y'),'is_deleted'=>0,
                'reply_id'=>null);
            $rtn = $this->jobseeker_model->sendInterviewRequest($data);

            if($rtn) {
                $msg = "success";
            } else {
                $msg = "failed";
            }

            $result['status'] = $msg;
            echo json_encode($result);
        }
    }

    //Reply interview request
    public function replyinterviewrequest() {
        //Load Model
        $this->load->model('jobseeker_model');
        $this->load->model('inbox_model');

        $post = $_POST;
        $uid = $this->session->userdata('uid');

        if ($post) {
            $interview_id = $post['interviewId'];
            // Get ID
            $id = $this->inbox_model->getMaxMessageId();
            $data = array('id'=>$id+1,'seq'=>1,'title'=>$post['message_subject'],'message'=>$post['message'],
                'user1'=>$uid,
                'user2'=>$interview_id, 'timestamp'=>time(), 'user1read'=>'yes',
                'user2read'=>'no','is_delete'=>0,'is_offline'=>1);
            $this->inbox_model->addmsg($data);

            $rtn = $this->jobseeker_model->saveInterviewReply($id+1, $interview_id);

            if($rtn) {
                $msg = "success";
            } else {
                $msg = "failed";
            }

            $result['status'] = $msg;
            echo json_encode($result);
        }
    }

    //Send interview request
    public function deleteinterviewrequest() {
        //Load Model
        $this->load->model('jobseeker_model');

        $post = $_POST;
        if ($post) {
            $id = $post['id'];
            $rtn = $this->jobseeker_model->deleteInterviews($id);

            if($rtn) {
                $msg = "success";
            } else {
                $msg = "failed";
            }

            $result['status'] = $msg;
            echo json_encode($result);
        }
    }
}