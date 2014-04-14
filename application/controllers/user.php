<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends Front_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		redirect('/');
	}

    /**
     * user signup action
     * user_type: 1 is employer, 0 is job seeker
     */
    public function signup(){

    	$post = $this->input->post();
    	if (empty($post)) {
    		securelychk();
    	}
    	
        $this->load->model('jobseeker_model');
        $userId = -1;
        $status = "success";
        $message = "success";
        if(!$this->jobseeker_model->checkUserExisting($post['email'])){
        	$uType = $post['user_type'];
        	$post['user_type'] = 4; // no confirmation
            $userId = $this->jobseeker_model->addUser($post);
            
            // send email
            $uEmail = $post['email'];
            $code = md5($uEmail.$userId.$uType);
            $code = $code[3].$code[1].$code[10].$code[5].$code[12].$code[9];
            $url = $this->data['site_url'].'user/confirm/?q='.$uEmail.'-'.$userId.'-'.$uType.'-'.$code;
            
            $this->load->library('email');
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            $this->email->reply_to('do-not-reply@jingjobs.com', 'JingJobs');
            $this->email->from('do-not-reply@jingjobs.com', 'JingJobs');
            $this->email->to($uEmail);
            $this->email->subject('Email confirmation');
            $this->email->message('<html>
            						<head><title>Email confirmation</title></head>
            						<body>Hi, <br><br>
            						Please click <a href="'.$url.'">HERE</a> to complete email confirmation.<br><br>
            						JingJobs.com');
            if($this->email->send()) {
            	$message = 'Please check your email and complete email confirmation.';
            } else {
            	$message = 'Send email failed';
            }
            //$this->load->library('session');
            //$result['uid'] = $userId;
            //$result['first_name'] = $_POST['first_name'];
            //$result['last_name'] = $_POST['last_name'];
            //$result['user_type'] = $_POST['user_type'];
            //$this->session->set_userdata($result);
            //$data = $this->data;
        }
        else{
            $status = "error";
            $message = "This email already exists.";
        }
        echo json_encode(array('status'=>$status, 'userId'=>$userId,'message'=>$message));
    }

	public function login()
	{
        $post = $_POST;

        $result = array('uid'=>-1,'status'=>'error', 'message'=>'Either your email or password is incorrect, try again.');
        if ('' == $post['username'])
        {
            $result['message'] = 'Invalid email';
        }
        else{
            $this->load->model('jobseeker_model');
            $user = $this->jobseeker_model->getUser($post['username'], md5($post['login_password']));



            if($user){
                if ( isset($user['user_type']) && 4 == $user['user_type'] ) {
                    //alertmsg('Please check your email and complete email confirmation.');
                    $result['message'] = 'Please check your email and complete email confirmation.';
                }
                else{
                    $this->load->library('session');
                    $result['status'] = 'success';
                    $result['message'] = '';
                    $result['uid'] = $user['uid'];
                    $result['first_name'] = $user['first_name'];
                    $result['last_name'] = $user['last_name'];
                    $result['user_type'] = $user['user_type'];

                    $this->session->set_userdata($result);

                    $this->jobseeker_model->updateUserStatus($user['uid'], 1);
                }
            }
        }
        //return login status with user data
        echo json_encode($result);
	}
	
	public function logout()
	{
		$this->load->library('session');
        if ($this->session->userdata('uid')) {
            $this->load->model('jobseeker_model');
            $this->jobseeker_model->updateUserStatus($this->session->userdata('uid'), -1);
        }
		$this->session->sess_destroy();

		redirect('/');
	}

    public function sendResetPwRequest(){
        $data = $this->data;
        $this->load->model('jobseeker_model');
        $userId = $this->jobseeker_model->getUserIdByUsername($_POST['username']);
        $status = "success";
        $message = "success";

        if(count($userId) < 1){
            $status = "error";
            $message = "No one with that email was found, please try again with an alternative email address.";
        }
        else{
            $userId = $userId[0]['uid'];
            $md5username = md5(substr(md5($_POST['username']), 3, 9)); // just make it complicated
            $resetPwLink = $this->config->item('base_url') . 'user/resetPassword?juid='. $userId . '&token=' . $md5username;
            //send email to this user's email address
            $this->load->library('email');

            $this->email->from('do-not-reply@jingjobs.com', 'JingJobs Team');
            $this->email->to($_POST['username']);

            $this->email->subject('RESET PASSWORD EMAIL FROM JINGJOBS');
            $this->email->message("<HTML><BODY><div>You requested that your password be reset. To reset your password please follow this link: <br/>[<a href='$resetPwLink'>Reset My Password</a>]<br/>Thanks,<br/>The JingJobs Team</div></BODY></HTML>");

            if (!$this->email->send()) {
            	$message = 'Send email failed';
            }

        }
        echo json_encode(array('status'=>$status, 'message'=>$message));
    }

    public function resetPassword(){
        $data = $this->data;
        $data['juid'] = $_GET['juid'];
        $data['token'] = $_GET['token'];
        $this->load->view($data['front_theme'].'/reset-password', $data);
    }

    public function resetPasswordAction(){
        $this->load->model('jobseeker_model');
        $status = "success";
        $message = "success";
        $user = $this->jobseeker_model->getUserInfo($_POST["uid"]);
        if($user != null){
            if( md5(substr(md5($user['username']), 3, 9)) != $_POST['token'] ){
                $status = "error";
                $message = "The link is bad, please contact us.";
            }
            else{
                //set the new password for this user
                $this->jobseeker_model->updatePassword($_POST['uid'], $_POST['password']);
            }
        }
        else{
            $status = "error";
            $message = "Invalid user.";
        }
        echo json_encode(array('status'=>$status, 'message'=>$message));
    }

	public function adminlogin() {
		$this->load->model('admin_model');
		
		if (empty($_POST))
		{
			$data = $this->data;
			$this->load->view($data['front_theme'].'/admin-login', $data);
		}
		else
		{
			$post = $_POST;
			if ('' == $post['username'])
				alertmsg('Please input username.');
			$user = $this->admin_model->getUser($post['username'], md5($post['password']));
		
			if($user)
			{
				// set last login time
				$this->admin_model->updateUserLogonTime($user['uid']);
				if (1 == $user['isadmin']) // admin
				{
					$this->load->library('session');
					$sess_arr = array(
							'uid' => $user['uid'],
							'username' => $user['username'],
							'isadmin' => 1,
					);
					$this->session->set_userdata($sess_arr);
					redirect('admin/category');
				}
				else // member
				{
					alertmsg('Access deny.');
				}
			}
			else
			{
				alertmsg('Username or Password error, Please try again.');
			}
		}
	}
	
	/**
	 *  update user's photo
	 */
	public function ajaxuploadimage() {
		// create folder
		$this->load->model('jobseeker_model');
		$uid = $this->session->userdata('uid');
		//$user_path = realpath(dirname(__FILE__))."/../../theme/default/users/";
		$user_path = FCPATH . 'attached/users/';
		$this->jobseeker_model->creatUserfolder ( $user_path.$uid.'/' ) or exit ( 'error: can not creat folder.' );
		// upload
		if (is_uploaded_file ( $_FILES ['avatar'] ['tmp_name'] )) {
			$file_name = $uid.'/'.uniqid().'-'.iconv('utf-8','gb2312',$_FILES['avatar']['name']);
			move_uploaded_file ( $_FILES ['avatar'] ['tmp_name'], $user_path .$file_name);
	
			exit('success|'.$file_name);
		} else {
			exit('error|can not upload avatar image.');
		}
	}
	
	public function confirm() {
		if (!isset($_GET['q'])) {
			securelychk();
		}
		$str = $_GET['q'];
		$arr = explode('-', $str);
		$uEmail = $arr[0];
		$userId = $arr[1];
		$uType = $arr[2];
		$code1 = $arr[3];
		$code2 = md5($uEmail.$userId.$uType);
		$code2 = $code2[3].$code2[1].$code2[10].$code2[5].$code2[12].$code2[9];
		if ($code1 == $code2) {
			
			$this->load->model('jobseeker_model');
			$flag = $this->jobseeker_model->edit(array('uid'=>$userId, 'user_type'=> $uType), 'uid');
			if ($flag) {
				$user = $this->jobseeker_model->getUserInfo($userId);
				$sess['uid'] = $userId;
				$sess['first_name'] = $user['first_name'];
				$sess['last_name'] = $user['last_name'];
				$sess['user_type'] = $user['user_type'];
				$this->load->library('session');
				$this->session->set_userdata($sess);
				redirect('/?welcome');
			} else {
				alertmsg('error:u1');
			}
		} else {
			securelychk();
		}
	}

    public function getstatus() 
    {
        $this->load->model('jobseeker_model');
        if (!empty($_POST['userid'])) {
            $result = $this->jobseeker_model->getUserOnlineStatusById($_POST['userid']);    
        } else {
            $result = $this->jobseeker_model->getUserOnlineStatus();
        }
        
        $this->output->set_header('Content-Type: application/json; charset=utf-8');  
        echo json_encode($result);
    }

    public function awaystatus() 
    {
        $this->load->model('jobseeker_model');
        $this->jobseeker_model->updateUserLastRequest($this->session->userdata('uid'), 1);
    }
    
    public function checkstatus()
    {   
        if (!$this->session->userdata('uid')) {
            return;
        }
        $this->load->model('jobseeker_model');
        $this->jobseeker_model->cleanUp();
        $this->jobseeker_model->updateUserStatus($this->session->userdata('uid'), 1);
    }

    public function updateVisitNum() {
        $this->load->model('jobseeker_model');

        $post = $_POST;
        $uid = $post['uid'];

        if ($post) {
            $rtn = $this->jobseeker_model->updateVisitNum($uid);

            if($rtn) {
                $msg = "success";
            } else {
                $msg = "failed";
            }

            $result['status'] = $msg;
            echo json_encode($result);
        }
    }
    
        /**
         * This function generate the Image based on the attributes or area selected by the User from the FACEBOX POPUP.
         * This page serves via Ajax Request. 
         * It generates the image using CROP LIBRARY and returns details back to calling page.
         * 
         * PHASE 3 is going here. Check PHASE 1 for more information.
         */
        public function cropimagesave()
        {
            error_reporting (E_ALL ^ E_NOTICE);
            session_start(); //Do not remove this             
            
            $this->load->model('cropimage_model');
           
            $crop_info      =   $_SESSION['crop'];
            
            if (isset($_POST["x1"])) 
            {
                //Get the new coordinates to crop the image.
                $x1         =   $_POST["x1"];
                $y1         =   $_POST["y1"];
                $x2         =   $_POST["x2"];
                $y2         =   $_POST["y2"];
                $w          =   $_POST["w"];
                $h          =   $_POST["h"];
                //Scale the image to the thumb_width set above
                $scale      =   $crop_info['thumb_width']/$w;
                $cropped    =   $this->cropimage_model->resizeThumbnailImage($crop_info['thumb_image_location'], $crop_info['large_image_location'],$w,$h,$x1,$y1,$scale);
                $result     =	array('status'	=> 'success', 'message' => 'Cropping is comppleted.','thumb_image_name_with_ext'    =>  $crop_info['thumb_image_name_with_ext']);
            }
            else
            {
                $result     =	array('status'	=> 'error', 'message' => 'Image Cropping is failed.','thumb_image_name_with_ext'    =>  '');
            }            
            
            echo json_encode($result);
        }         
        
        /**
         * This function shows the IMAGE which is Uploaded via Ajax Upload in a Facebox PopUp page.
         * 
         * This PopUp is called from previous ajax file upload page. This page doesnt have Site Layout.
         * This page shows the IMAGE and instantiates the CROPIMAGE Library and its functions. 
         * 
         * PHASE 2 work is going here. Check PHASE 1 for more information.
         */
        public function cropimage()
        {
            error_reporting (E_ALL ^ E_NOTICE);
            session_start(); //Do not remove this  
            
            $data               =   $this->data;
            $data['crop']       =   $_SESSION['crop'];           
            $this->load->view($data['front_theme'].'/cropimage', $data);
        }        
        
        
        /**
         * Function upload the IMAGE via AJAX FILE UPLOAD from company/register.
         * The same function can be used for other pages also.
         * 
         * IMAGE UPLOAD and CROP functions. This is done in three steps and are:
         * 
         * PHASE 1. (uploadimage function) Image Upload page using Ajax File Upload.
         * PHASE 2. (cropimage function) Shows a Preview of the Image in Facebox PopUp for IMAGE CROPPING.
         * PHASE 3. (cropimagesave function) Generate the CROPPED IMAGE and return the information back.
         * 
         * PHASE 1 is handling in this function. Major works are: 
         * 
         * Initialize the IMAGE CROP library and assoictaed works.
         * Receive the UPLOAD FILE.
         * Resize it to a size which can be shown for CROP
         * Save some details into SESSION for using in the coming phases.
         * Return the details into calling page.
         * 
         * PACKAGE for IMAGE CROP: http://www.webmotionuk.co.uk/php-jquery-image-upload-and-crop/
         * PACKAGE for AJAX FILE UPLOAD: see (company-register.php view file)
         * PACKAGE for PopUp: facebox PopUp (URL http://defunkt.io/facebox/)
         * 
         * Implemented by: Aniesh Joseph on FEB/11/2014 (anieshjoseph@gmail.com)
         * 
         */
	public function uploadimage() 
        {
            // Contains the CROP IMAGE functions which are available in the LIBRRAY.
            $this->load->model('cropimage_model');
            
            // IMAGE CROPPING: LIBRARY Works STARTS >>
            error_reporting (E_ALL ^ E_NOTICE);
            session_start(); //Do not remove this
            //File Name creation. (Combine User ID and Time)
            $_SESSION['random_key']     =   $this->session->userdata('uid').strtotime(date('Y-m-d H:i:s'));
            $_SESSION['user_file_ext']  =   "";
            
            // echo '<pre>SESSION DIRECT: '; print_r($_SESSION);  echo '</pre>'; 
           
            #########################################################################################################
            # CONSTANTS
            # You can alter the options below														#
            #########################################################################################################
            $upload_dir         = "attached/users/profileimage";    // The directory for the images to be saved in
            $upload_path        = $upload_dir."/";                  // The path to where the image will be saved
            $large_image_prefix = "resize_";                        // The prefix name to large image
            $thumb_image_prefix = "thumbnail_";                     // The prefix name to the thumb image
            $large_image_name   = $large_image_prefix.$_SESSION['random_key'];     // New name of the large image (append the timestamp to the filename)
            $thumb_image_name   = $thumb_image_prefix.$_SESSION['random_key'];     // New name of the thumbnail image(append the timestamp to the filename)
            $max_file           = "3"; 							// Maximum file size in MB
            $max_width          = "500";						// Max width allowed for the large image
            $thumb_width        = "138";    // Width of thumbnail image. Other places, we use the same settings. So change here will effect everywhere.
            $thumb_height       = "138";    // Height of thumbnail image Other places, we use the same settings. So change here will effect everywhere.
            // Only one of these image types should be allowed for upload
            $allowed_image_types = array('image/pjpeg'=>"jpg",'image/jpeg'=>"jpg",'image/jpg'=>"jpg",'image/png'=>"png",'image/x-png'=>"png",'image/gif'=>"gif");
            $allowed_image_ext = array_unique($allowed_image_types); // do not change this
            $image_ext = "";	// initialise variable, do not change this.
            foreach ($allowed_image_ext as $mime_type => $ext) {
                $image_ext.= strtoupper($ext)." ";
            }

            //Image Locations
            $large_image_location = $upload_path.$large_image_name.$_SESSION['user_file_ext'];
            $thumb_image_location = $upload_path.$thumb_image_name.$_SESSION['user_file_ext'];

            //Create the upload directory with the right permissions if it doesn't exist
            if(!is_dir($upload_dir)){
                    mkdir($upload_dir, 0777);
                    chmod($upload_dir, 0777);
            }

            //Check to see if any images with the same name already exist
            $large_photo_exists     =   "";
            $thumb_photo_exists     =   "";          

            // FILE UPLOADING - Validation
            if(is_uploaded_file ( $_FILES ['image'] ['tmp_name'])) 
            { 
                    //Get the file information
                    $userfile_name = $_FILES['image']['name'];
                    $userfile_tmp = $_FILES['image']['tmp_name'];
                    $userfile_size = $_FILES['image']['size'];
                    $userfile_type = $_FILES['image']['type'];
                    $filename = basename($_FILES['image']['name']);
                    $file_ext = strtolower(substr($filename, strrpos($filename, '.') + 1));

                    //Only process if the file is a JPG, PNG or GIF and below the allowed limit
                    if((!empty($_FILES["image"])) && ($_FILES['image']['error'] == 0)) {

                            foreach ($allowed_image_types as $mime_type => $ext) {
                                    //loop through the specified image types and if they match the extension then break out
                                    //everything is ok so go and check file size
                                    if($file_ext==$ext && $userfile_type==$mime_type){
                                            $error = "";
                                            break;
                                    }else{
                                            $error = "Only <strong>".$image_ext."</strong> images accepted for upload<br />";
                                    }
                            }
                            //check if the file size is above the allowed limit
                            if ($userfile_size > ($max_file*1048576)) {
                                    $error.= "Images must be under ".$max_file."MB in size";
                            }

                    }else{
                            $error= "Select an image for upload";
                    }
                    //Everything is ok, so we can upload the image.
                    if (strlen($error)==0)
                    {

                            if (isset($_FILES['image']['name']))
                            {
                                    //this file could now has an unknown file extension (we hope it's one of the ones set above!)
                                    $large_image_location = $large_image_location.".".$file_ext;
                                    $thumb_image_location = $thumb_image_location.".".$file_ext;

                                    //put the file ext in the session so we know what file to look for once its uploaded
                                    $_SESSION['user_file_ext']=".".$file_ext;

                                    move_uploaded_file($userfile_tmp, $large_image_location);
                                    chmod($large_image_location, 0777);

                                    $width  =   $this->cropimage_model->getWidth($large_image_location);
                                    $height =   $this->cropimage_model->getHeight($large_image_location);
                                    //Scale the image if it is greater than the width set above
                                    if ($width > $max_width)
                                    {
                                            $scale = $max_width/$width;
                                            $uploaded = $this->cropimage_model->resizeImage($large_image_location,$width,$height,$scale);
                                    }
                                    else
                                    {
                                            $scale = 1;
                                            $uploaded = $this->cropimage_model->resizeImage($large_image_location,$width,$height,$scale);
                                    }
                                    //Delete the thumbnail file so the user can create a new one
                                    if (file_exists($thumb_image_location)) 
                                    {
                                            unlink($thumb_image_location);
                                    }
                            }                            
                            
                            //Refresh the page to show the new uploaded image
                            $return_path                                    =   $upload_path.$large_image_name.$_SESSION['user_file_ext'];
                            
                            // Save necessary info into SESSION for CROP Works in the coming PHASES.
                            // Otherwise, we need to initialise the CROP Variables everywhere.
                            $crop_info['current_large_image_width']         =   $this->cropimage_model->getWidth($large_image_location);
                            $crop_info['current_large_image_height']        =   $this->cropimage_model->getHeight($large_image_location);
                            $crop_info['thumb_width']                       =   $thumb_width;
                            $crop_info['thumb_height']                      =   $thumb_height; 
                            
                            // Created by Aniesh. This is for storing the random generated NAMES of both Resized & Thumbnail images.
                            $crop_info['large_image_name_with_ext']         =   $large_image_name.$_SESSION['user_file_ext'];
                            $crop_info['thumb_image_name_with_ext']         =   $thumb_image_name.$_SESSION['user_file_ext'];
                            
                            $crop_info['thumb_height']                      =   $thumb_height;                             
                            
                            $crop_info['thumb_image_location']              =   $thumb_image_location; // Used in ajax crop save page
                            $crop_info['large_image_location']              =   $large_image_location; // Used in ajax crop save page  
                            
                            $crop_info['image_path']                        =   $return_path; 
                            $_SESSION['crop']                               =   $crop_info;

                            exit("success|$return_path");
                    }
                    else
                    {
                        exit("error|$error");
                    }
            }
            else
            {
                exit("error|Upload an image.");
            }
	}        
    
    
    
}
