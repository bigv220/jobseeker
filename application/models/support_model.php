<?php
class support_model extends MY_Model
{
    public function __construct()
    {
            parent::__construct();
    }
    
    
    /**
     * Read User details using Email.
     */
    public function selectUserInfo($email)
    {
        $data = $this->db->select(array('username','uid','user_type'))
                        ->from('user')
                        ->where('username', $email)
                        ->get()
                        ->result_array();
        return $data[0];
    }    
    
    /**
     * Send authnetication email. 
     * 
     * Copied function from "user/signup".
     */
    public function resendAuthenticationEmail($email,$url)
    {
        $this->load->library('email');
        $config['mailtype']     =   'html';
        $this->email->initialize($config);
        $this->email->reply_to('do-not-reply@jingjobs.com', 'JingJobs');
        $this->email->from('do-not-reply@jingjobs.com', 'JingJobs');
        $this->email->to($email);
        $this->email->subject('Email confirmation');
        $this->email->message('<html>
                                                    <head><title>Email confirmation</title></head>
                                                    <body>Hi, <br><br>
                                                    Please click <a href="'.$url.'">HERE</a> to complete email confirmation.<br><br>
                                                    JingJobs.com');
        if($this->email->send()) 
        {
            $json_array =   array('returnstatus'=>'success','message'=>'Please check your email and complete email confirmation.'); 
        } 
        else 
        {
            $json_array =   array('returnstatus'=>'error','message'=>'Resending email failed due to system error.'); 
        }
        
        return $json_array;
    }     

    /**
     * Read User details using UID.
     */
    public function selectEmail($uid)
    {
        $data = $this->db->select(array('username'))
                        ->from('user')
                        ->where('uid', $uid)
                        ->get()
                        ->result_array();
        return $data[0]['username'];
    }    
        
    /**
     * CREATE SUPPORT TABLE RECORD with User entere details. 
     *
     */
    public function createSupportRequest($request_info)
    {
        $request_info['date_posted']    =  date('Y-m-d H:i:s');
        $this->db->insert('support', $request_info);
    }    
   
}