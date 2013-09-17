<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Andrew Wang
 * Date: 13-9-15
 * Time: 下午7:05
 * To change this template use File | Settings | File Templates.
 */
class newsletter_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'newsletter';
    }

    /**
     * insert a newsletter to newsletter table
     * @param $data
     * @return mixed
     */
    public function addToNewsletter($email){
        $data = array('email'=>$email);
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    /**
     * check if the user with the pass-in email is exist
     * @param $email
     * @return bool if the email is exist in newsletter return true, else return false
     */
    public function checkExisting($email){
        $result = $this->db->select('id')
            ->from($this->table)
            ->where('email', $email)
            ->get()
            ->result_array();
        return count($result)>0;
    }


}