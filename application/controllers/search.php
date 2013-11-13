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
                array_push($where_arr, 'employment_length='.$post["employment_length"]);
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
            if(!empty($post["PersonalSkills_str"])) {
                array_push($where_arr, "preferred_personal_skills like '%".$post["PersonalSkills_str"]."%'");
            }
            if(!empty($post["ProfessionalSkills_str"])) {
                array_push($where_arr, "preferred_technical_skills like '%".$post["ProfessionalSkills_str"]."%'");
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
	                if(!empty($post["position"][$i]) && $post["position"][$i]!='none') {
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

        for($i=0; $i<count($jobs); $i++) {
            $jobs[$i]['industry_arr'] = $this->job_model->getJobIndustry($jobs[$i]['id']);
        }

        $data['jobs'] = $jobs;

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
        $where = '';
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
                $where .= ' WHERE ' . $where_str . " AND (" . $where_or_str . ")";
            } else {
                $where .= ' WHERE ' . $where_str . $where_or_str;
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
        $where = '';
        if($post) {
//            if(!empty($post["post_date"])) {
//                $post_date_timestamp = mktime(0, 0, 0, date("m"), date("d")-$post["post_date"], date("Y"));
//                $post_date = date('Y-m-d', $post_date_timestamp);
//                $where .= " WHERE post_date>='$post_date'";
//            }

            if(!empty($post["staffIdStr"])) {
                $where .= " AND uid in(" . $post["staffIdStr"] . ")";
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
        $post = $_POST;
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
            /*if(!empty($post["employment_type"])) {
                array_push($where_arr, 'employment_type=' . $post["employment_type"]);
            }
            if(!empty($post["industry"])) {
                array_push($where_arr, "industry like '%".$post["industry"]."%'");
            }
            if(!empty($post["position"])) {
                array_push($where_arr, "position like '%".$post["position"]."%'");
            }*/
            if(!empty($post["employment_length"])) {
                array_push($where_arr, 'employment_length='.$post["employment_length"]);
            }
            if(!empty($post["salary"])) {
                array_push($where_arr, 'salary_range='.$post["salary"]);
            }
          
            if(!empty($post["language"])) {
                array_push($where_arr, "language like '%".$post["language"]."%'");
            }
            
            // set up user_type=0
            array_push($where_arr, "user_type = 0");
        }
        $where = "";
        if(count($where_arr)) {
            $where_str = implode(' AND ', $where_arr);
            $where .= ' WHERE ' . $where_str;
        }

        // get jobseekers according to the search
        $jobseekers = $this->job_model->searchJobseeker($where);
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

        //Load Model
        $this->load->model('jobseeker_model');

        for($i=0; $i<count($jobseekers); $i++) {
            $jobseekers[$i]['educations'] = $this->jobseeker_model->getAllEducationInfo($jobseekers[$i]['uid']);
            $jobseekers[$i]['work_history'] = $this->jobseeker_model->getAllWorkHistory($jobseekers[$i]['uid']);
            $jobseekers[$i]['industry_arr'] = $this->jobseeker_model->getSeekingIndustry($jobseekers[$i]['uid']);
            $jobseekers[$i]['personal_skills'] = $this->jobseeker_model->getPersonalSkills($jobseekers[$i]['uid']);
            $jobseekers[$i]['professional_skills'] = $this->jobseeker_model->getProfessionalSkills($jobseekers[$i]['uid']);
            $jobseekers[$i]['languages'] = $this->jobseeker_model->getLanguage($jobseekers[$i]['uid']);
        }
        $data['jobseekers'] = $jobseekers;

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

}