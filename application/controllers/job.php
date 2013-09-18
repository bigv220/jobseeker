<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Job Controller, Job details page, etc.
 *
 **/
class job extends Front_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        redirect('/');
    }

    public function jobDetails() {
        $length_of_employment = array('1'=>'Long term (1+years)','2'=>'Short term (-1 years)','3'=>'No preferences');
        $type_of_employment = array('1'=>'Contract','2'=>'Part Time','3'=>'Full Time',
                                '4'=>'Internship','5'=>'Any');
        $visa_assistance = array('1'=>'Visa will be provided','0'=>'Visa will not be provided');
        $housing_assistance = array('1'=>'Accomodation will be provided','0'=>'Accomodation will not be provided');

        $data = $this->data;

        //Load Model
        $this->load->model('job_model');
        //get data from db
        $jobinfo = $this->job_model->getJobInfo(1);

        $constants = array('len_emp'=>$length_of_employment,
                    'type_emp'=>$type_of_employment,
                    'visa_assist'=>$visa_assistance,
                    'housing_assist'=>$housing_assistance);

        $data['constants_arr'] = $constants;
        $data['jobinfo'] = $jobinfo;
        $this->load->view($data['front_theme']."/job-details-demo",$data);
    }

}