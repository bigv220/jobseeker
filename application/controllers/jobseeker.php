<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Employer Controller, Registraion, Profile page, etc.
 *
 **/
class jobseeker extends Front_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        if (!$this->session->userdata('uid'))
        {
            redirect('/');
        }
    }

    public function index()
    {
        redirect('/');
    }

    /**
     * Jobseeker registration
     */
    public function register() {
        //Load Model
        $this->load->model('jobseeker_model');

        $data = $this->data;
        $uid = $this->session->userdata('uid');

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

        //get industry and position setting of seeking industry
        if(count($seekingIndustry)) {
            $ind = $seekingIndustry['industry'];
            $position = $this->jobseeker_model->getPosition($ind);
        } else {
            $position = $this->jobseeker_model->getPosition('General');
        }

        //industry lists
        $industry = $this->jobseeker_model->getIndustry();

        //generate year lists
        $year_arr = array();
        for($i = date('Y'); $i >= 1970; $i--) {
            array_push($year_arr, $i);
        }

        //language and level array
        $language_arr = array('Chinese','English');
        $level_arr = array('Grade-1','Grade-2','Grade-3','Grade-4');

        $data["uid"] = $uid;
        $data["userinfo"] = $userinfo;
        $data["education_info"] = $education_info;
        $data["work_history"] = $workhistory;
        $data["step_arr"] = $step_arr;
        $data["personal_skills"] = $personal_skills;
        $data['professional_skills'] = $professional_skills;
        $data['seekingIndustry'] = $seekingIndustry;
        $data["industry"] = $industry;
        $data['position'] = $position;
        $data['yearArray'] = $year_arr;

        //user language settings
        $data['language'] = $language;
        $data['language_arr'] = $language_arr;
        $data['level_arr'] = $level_arr;
        $this->load->view("/jobseeker/register",$data);
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

            //save seeking industry to db
            $industry_len = count($post['industry']);
            for($i=0; $i<$industry_len;$i++) {
                if($post['industry'][$i] && $post['position'][$i]) {
                    $this->jobseeker_model->addSeekingIndustry($uid, $post['industry'][$i], $post['position'][$i]);
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
            //save school to db
            $school_len = count($post['school_name']);
            for($i=0; $i<$school_len;$i++) {
                if($post['school_name'][$i]) {
                    $data = array('uid'=>$post['uid'],'school_name'=>$post['school_name'][$i],
                        'attend_date_from'=>$post['attended_from'][$i],
                        'attend_date_to'=>$post['attended_to'][$i],'degree'=>$post['degree'][$i],
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
                if($post['company_name'][$i]) {
                    $desc = $post['description'][$i] == '350 Characters' ? '' : $post['description'][$i];

                    $data = array('uid'=>$post['uid'],'introduce'=>$post['introduce'][$i],
                        'company_name'=>$post['company_name'][$i],
                        'period_time_from'=>$post['period_time_from'][$i],'period_time_to'=>$post['period_time_to'][$i],
                        'industry'=>$post['industry'][$i],'position'=>$post['position'][$i],
                        'location'=>null,'description'=>$desc,'is_stillhere'=>$post['is_stillhere'][$i],
                        'work_examples_url'=>$post['work_example'][$i]);

                    $rtn = $this->jobseeker_model->insertWorkHistory($data);
                }
            }

            if($rtn) {
                $msg = "success";
                $this->_saveRegisterStep($uid, 5);
            } else {
                $msg = "failed";
            }

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
            //save language to db
            $lan_len = count($post['language']);
            for($i=0; $i<$lan_len;$i++) {
                if($post['language'][$i]) {
                    $data = array('uid'=>$post['uid'],
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
        $uid = $post['uid'];
        $skill = $post['skill'];

        // create folder
        $this->load->model('jobseeker_model');
        $this->jobseeker_model->addPersonalSkills($uid, $skill);

        $this->_saveRegisterStep($uid, 7);

        $msg = "success";
        $result['status'] = $msg;
        echo json_encode($result);
    }

    /**
     * add professional skills
     */
    public function addProfessionalSkills() {
        $post = $_POST;
        $uid = $post['uid'];
        $skill = $post['skill'];

        // create folder
        $this->load->model('jobseeker_model');
        $this->jobseeker_model->addProfessionalSkills($uid, $skill);

        $this->_saveRegisterStep($uid, 8);

        $msg = "success";
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

        // create folder
        $this->load->model('jobseeker_model');
        $this->jobseeker_model->delProfessionalSkills($uid, $skill);

        $msg = "success";
        $result['status'] = $msg;
        echo json_encode($result);
    }

    /**
     *  update user's photo
     */
    public function ajaxuploadimage() {
        $data = $this->data;

        // create folder
        $this->load->model('jobseeker_model');
        $user_path = realpath(dirname(__FILE__))."/../../theme/default/users/";
        $this->jobseeker_model->creatUserfolder ( $user_path ) or exit ( 'error: can not creat folder.' );
        // upload
        if (is_uploaded_file ( $_FILES ['avatar'] ['tmp_name'] )) {
            $file_name = iconv('utf-8','gb2312',$_FILES['avatar']['name']);
            move_uploaded_file ( $_FILES ['avatar'] ['tmp_name'], $user_path .$file_name);

            // new image url
            $data ['avatar'] = '/users/' . $file_name;

            exit ( 'success' );
        } else {
            exit ( 'error: can not upload avatar image.' );
        }
    }

    //upload work examples
    public function ajaxuploadfile() {
        $data = $this->data;

        // load model
        $this->load->model('jobseeker_model');
        $user_path = realpath(dirname(__FILE__))."/../../theme/default/workExamples/";
        $this->jobseeker_model->creatUserfolder ( $user_path ) or exit ( 'error: can not creat folder.' );
        // upload
        if (is_uploaded_file ( $_FILES ['workexample'] ['tmp_name'] )) {
            $file_name = iconv('utf-8','gb2312',$_FILES['workexample']['name']);
            move_uploaded_file ( $_FILES ['workexample'] ['tmp_name'], $user_path .$file_name);

            // new image url
            $data ['avatar'] = '/workExamples/' . $file_name;

            exit ( 'success' );
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

}