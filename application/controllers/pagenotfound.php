<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pagenotfound extends Front_Controller 
{	
    public function __construct()
    {
            parent::__construct();
    }
    
    /**
     * Used for PAGE NOT FOUND.
     * To display custom message while someone accessing a page not available. Ex: Job which is not approved.
     * 
     * This is set from application/config/routes.php file.
     */
    public function index()
    {
        $data   =   $this->data;
        
        if($this->session->flashdata('error')) // Read Flas Messages if any. Ex: Passed from Job/Details with error key.
            $data['error_message']      =   $this->session->flashdata('error');
                
        $this->load->view($data['front_theme'].'/pagenotfound_index', $data);
    }        
}
