<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * SUPPORT SYSTEM.
 */
class support extends Front_Controller 
{	
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }
    
    /**
     * Resend Authentication Email.
     * 
     * This function is called via ajax. It receives an Email, check whether this email is valid & if valid, send an authentication mail.
     * 
     * Validation Cases:
     *  1. Email must be registered and not activated status.
     * 
     * The EMAIL VERIFICATION link is generated in the same format of "user/signup" function.
     * 
     */
    public function resendmail() 
    {  
        $this->load->model('support_model');       

        // Validation
        if($_POST['support_option1_email']=='')
        {      
            $error      =   TRUE;
            $json_array =   array('returnstatus'=>'error','message'=>'Please enter email.');
        }
        elseif($_POST['support_option1_user_type']!=0 AND $_POST['support_option1_user_type']!=1)
        {
            $error      =   TRUE;
            $json_array =   array('returnstatus'=>'error','message'=>'Please choose User Type.');
        }   
        
        if($error==FALSE)
        {
            // Read User Info for further checking.
            $user_info      =   $this->support_model->selectUserInfo($_POST['support_option1_email']);
            
            if($user_info['uid']=='')
            {
                $error      =   TRUE;
                $json_array =   array('returnstatus'=>'error','message'=>'No record exists with this email.');                
                
            }
            elseif($user_info['user_type']!=4)
            {
                $error      =   TRUE;
                $json_array =   array('returnstatus'=>'error','message'=>'Your account is already activated.'); 
            }
            else
            {
                // No error. Sending authentication email.
                $code               =   md5($user_info['username'].$user_info['uid'].$_POST['support_option1_user_type']);
                $code               =   $code[3].$code[1].$code[10].$code[5].$code[12].$code[9];
                $url                =   $this->data['site_url'].'user/confirm/?q='.$user_info['username'].'-'.$user_info['uid'].'-'.$_POST['support_option1_user_type'].'-'.$code;
                $json_array         =   $this->support_model->resendAuthenticationEmail($user_info['username'],$url);
            }
        }
        echo json_encode($json_array);
    }
    
    
    /**
     * Handling of Request Support via Ajax.
     * 
     * It receives the form submission, validates the entries and create a record in Support Table.
     * All fields are required. Email is read from database, if the user is logged in.
     * 
     * Return status & message based on different cases.
     */
    public function create() 
    {  
        $this->load->model('support_model');       
        $uid            =   $this->session->userdata('uid');
        
        if(isLogin())
            $email      =   $this->support_model->selectEmail($uid);
        else
            $email      =   $_POST['support_option3_email'];
        
        // Validation
        if($_POST['support_option3_name']=='')
        {      
            $error      =   TRUE;
            $json_array =   array('returnstatus'=>'error','message'=>'Please enter name.');
        }
        elseif($email=='')
        {
            $error      =   TRUE;
            $json_array =   array('returnstatus'=>'error','message'=>'Please enter email.');
        }   
        elseif($_POST['support_option3_problem']=='')
        {
            $error      =   TRUE;
            $json_array =   array('returnstatus'=>'error','message'=>'Please choose your problem.');
        }  
        elseif($_POST['support_option3_description']=='')
        {
            $error      =   TRUE;
            $json_array =   array('returnstatus'=>'error','message'=>'Please describe your issue.');
        }          
               
        
        if($error==FALSE)
        {
            // create an new instant of OS_BR class
            $obj                                        =   new OS_BR();
            $os_browser_info                            =   $obj->showInfo("all");
            
            $request_info['support_type_id']            =   1;
            $request_info['uid']                        =   $uid;
            $request_info['name']                       =   $_POST['support_option3_name'];
            $request_info['email']                      =   $email;
            $request_info['problem']                    =   $_POST['support_option3_problem'];
            $request_info['problem_description']        =   $_POST['support_option3_description'];            
            $request_info['page_url']                   =   $_POST['current_page_url'];
            
            $request_info['browser']                    =   $os_browser_info[2].' '.$os_browser_info[0];
            $request_info['ip_address']                 =   $_SERVER['REMOTE_ADDR'];
            $request_info['screen_size']                =   $_POST['screen_width'].'*'.$_POST['screen_height'];            
            $request_info['os_vendor']                  =   $os_browser_info[1];   
                  
            // Save details into Support Table.
            $this->support_model->createSupportRequest($request_info);
            
            $json_array =   array('returnstatus'=>'success','message'=>'Your request has been saved.'); 
        }
        echo json_encode($json_array);
    }    
    
    
}

/**
 * Browser & OS Information.
 * 
 * URL: http://www.codeproject.com/Articles/545047/Get-Browser-and-Operating-System-with-PHP
 */
class OS_BR{

    private $agent = "";
    private $info = array();

    function __construct(){
        $this->agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : NULL;
        $this->getBrowser();
        $this->getOS();
    }

    function getBrowser(){
        $browser = array("Navigator"            => "/Navigator(.*)/i",
                         "Firefox"              => "/Firefox(.*)/i",
                         "Internet Explorer"    => "/MSIE(.*)/i",
                         "Google Chrome"        => "/chrome(.*)/i",
                         "MAXTHON"              => "/MAXTHON(.*)/i",
                         "Opera"                => "/Opera(.*)/i",
                         );
        foreach($browser as $key => $value){
            if(preg_match($value, $this->agent)){
                $this->info = array_merge($this->info,array("Browser" => $key));
                $this->info = array_merge($this->info,array(
                  "Version" => $this->getVersion($key, $value, $this->agent)));
                break;
            }else{
                $this->info = array_merge($this->info,array("Browser" => "UnKnown"));
                $this->info = array_merge($this->info,array("Version" => "UnKnown"));
            }
        }
        return $this->info['Browser'];
    }

    function getOS(){
        $OS = array("Windows"   =>   "/Windows/i",
                    "Linux"     =>   "/Linux/i",
                    "Unix"      =>   "/Unix/i",
                    "Mac"       =>   "/Mac/i"
                    );

        foreach($OS as $key => $value){
            if(preg_match($value, $this->agent)){
                $this->info = array_merge($this->info,array("Operating System" => $key));
                break;
            }
        }
        return $this->info['Operating System'];
    }

    function getVersion($browser, $search, $string){
        $browser = $this->info['Browser'];
        $version = "";
        $browser = strtolower($browser);
        preg_match_all($search,$string,$match);
        switch($browser){
            case "firefox": $version = str_replace("/","",$match[1][0]);
            break;

            case "internet explorer": $version = substr($match[1][0],0,4);
            break;

            case "opera": $version = str_replace("/","",substr($match[1][0],0,5));
            break;

            case "navigator": $version = substr($match[1][0],1,7);
            break;

            case "maxthon": $version = str_replace(")","",$match[1][0]);
            break;

            case "google chrome": $version = substr($match[1][0],1,10);
        }
        return $version;
    }

    function showInfo($switch){
        $switch = strtolower($switch);
        switch($switch){
            case "browser": return $this->info['Browser'];
            break;

            case "os": return $this->info['Operating System'];
            break;

            case "version": return $this->info['Version'];
            break;

            case "all" : return array($this->info["Version"], 
              $this->info['Operating System'], $this->info['Browser']);
            break;

            default: return "Unkonw";
            break;

        }
    }
}


