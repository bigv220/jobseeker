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
        $data = $this->data;
        $this->load->view($data['front_theme']."/search-job-result",$data);
    }

    public function searchJob() {
        $data = $this->data;
        $this->load->view($data['front_theme']."/search-job-result",$data);
    }

    public function staff() {
        $data = $this->data;
        $this->load->view($data['front_theme']."/search-staff",$data);   
    }

    public function findstaff() {
        $data = $this->data;
        $this->load->view($data['front_theme']."/search-advance-staff",$data);   
    }

    public function findjob() {
        $data = $this->data;
        $this->load->view($data['front_theme']."/search-advance-job",$data);   
    }

}