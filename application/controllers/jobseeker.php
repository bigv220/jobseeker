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
        $data = $this->data;

        //Load Model
        $this->load->model('jobseeker_model');

        $uid = "1";
        $msg = '';

        //save basic info
        if ($_POST && $_POST["register_step"] == 1) {
            if(array_key_exists('is_private',$_POST)) {
                $_POST["is_private"] = 1;
            } else {
                $_POST["is_private"] = 0;
            }
            $rtn = $this->jobseeker_model->updateBasicInfo($uid, $_POST);

            if($rtn) {
                $msg = "Update successful!";
            } else {
                $msg = "Update failed!";
            }
        }

        //save contace details
        if ($_POST && $_POST["register_step"] == 2) {
            $rtn = $this->jobseeker_model->updateContactDetails($uid, $_POST);

            if($rtn) {
                $msg = "Update successful!";
            } else {
                $msg = "Update failed!";
            }
        }

        //save preferences
        if ($_POST && $_POST["register_step"] == 3) {
            if(!array_key_exists('employment_type',$_POST)) {
                $_POST["employment_type"] = null;
            }
            if(!array_key_exists('availability',$_POST)) {
                $_POST["availability"] = null;
            }

            $rtn = $this->jobseeker_model->updatePreferences($uid, $_POST);

            if($rtn) {
                $msg = "Update successful!";
            } else {
                $msg = "Update failed!";
            }
        }

        //save educations
        if ($_POST && $_POST["register_step"] == 4) {
            $rtn = $this->jobseeker_model->insertEducation($_POST);

            if($rtn) {
                $msg = "Update successful!";
            } else {
                $msg = "Update failed!";
            }
        }

        //save work history
        if ($_POST && $_POST["register_step"] == 5) {
            $rtn = $this->jobseeker_model->insertWorkHistory($_POST);

            if($rtn) {
                $msg = "Update successful!";
            } else {
                $msg = "Update failed!";
            }
        }

        //save language
        if ($_POST && $_POST["register_step"] == 6) {
            $rtn = $this->jobseeker_model->insertLanguage($_POST);

            if($rtn) {
                $msg = "Update successful!";
            } else {
                $msg = "Update failed!";
            }
        }
        
        // get location
        $this->load->helper('location');
        $data['location'] = getLoction();

        //get data from db
        $userinfo = $this->jobseeker_model->getUserInfo($uid);
        $education_info = $this->jobseeker_model->getEducationInfo($uid);
        $workhistory = $this->jobseeker_model->getWorkHistory($uid);

        $data["uid"] = $uid;
        $data["userinfo"] = $userinfo;
        $data["education_info"] = $education_info;
        $data["work_history"] = $workhistory;
        $data["msg"] = $msg;
        $this->load->view("/jobseeker/register",$data);
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

    public function autocomplete() {
//        $rtn_array = array(array('1'=>'Customer Service'),array('2'=>'Resourcefulness'),array('3'=>'Time Management'));
//        echo json_encode($rtn_array);exit;
        exit('Cus|Good');
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

}