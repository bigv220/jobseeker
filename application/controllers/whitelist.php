<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class whitelist extends Front_Controller 
{	
    public function __construct()
    {
            parent::__construct();
    }

    public function index()
    {
        $data   =   $this->data;
        $this->load->view($data['front_theme'].'/whitelist_index', $data);
        
        
    }        
}
