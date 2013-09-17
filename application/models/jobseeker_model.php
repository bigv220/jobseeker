<?php
class jobseeker_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'user';
    }

    /**
     * insert a user to user table
     * @param $data
     * @return mixed
     */
    public function addUser($data){
        $data = array('first_name'=>$data['first_name'],
                        'last_name'=>$data['last_name'],
                        'email'=>$data['email'],
                        'password'=>md5($data['password']),
                        'user_type'=>$data['user_type'],
                        'newsletter'=>$data['newsletter']);
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    /**
     * check if the user with the pass-in email is exist
     * @param $email
     * @return bool if the user is exist return true, else return false
     */
    public function checkUserExisting($email){
        $result = $this->db->select('uid')
            ->from($this->table)
            ->where('email', $email)
            ->get()
            ->result_array();
        return count($result)>0;
    }

    public function getUser($email, $password){
        $where = array('email'=>$email, 'password'=>$password);
        return $this->db->select('*')
            ->from($this->table)
            ->where($where)
            ->get()->row_array();
    }
    public function getCountry() {
        $result = $this->db->select('id,name')
            ->from('country')
            ->get()
            ->result_array();

        return $result;
    }

    public function getCity($country_id = 1) {
        $result = $this->db->select('id,name')
            ->from('city')
            ->where('country_id', $country_id)
            ->get()
            ->result_array();

        return $result;
    }

    public function getUserInfo($uid) {
        $result = $this->db->select('*')
            ->from('user')
            ->where('uid',$uid)
            ->get()
            ->result_array();

        return $result[0];
    }

    /**
     * update jobseeker infos
     *
     **/
    public function updateBasicInfo($uid,$data)
    {
        $data = array('first_name'=>$data['first_name'],'last_name'=>$data['last_name'],'city'=>$data['city'],
            'country'=>$data['country'], 'profile_pic'=>$data['avatar'],
            'birthday'=>$data['birthday'],'is_private'=>$data['is_private']);
        return $this->db->where('uid', $uid)->update($this->table, $data);
    }

    /**
     * update contact details
     *
     **/
    public function updateContactDetails($uid, $data)
    {
        $data = array('email'=>$data['email'],'phone'=>$data['phone'],'is_allow_online_msg'=>$data['is_allow_online_msg'],
            'is_allow_phone'=>$data['is_allow_phone'], 'jingchat_username'=>$data['jingchat_username'],
            'personal_website'=>$data['website'],'twitter'=>$data['twitter'],
            'linkedin'=>$data['linkedin'],'wechat'=>$data['wechat']);
        return $this->db->where('uid', $uid)->update($this->table, $data);
    }

    /**
     * update preferences
     *
     **/
    public function updatePreferences($uid, $data)
    {
        $data = array('employment_length'=>$data['employment_length'],'employment_type'=>$data['employment_type'],
            'is_visa_assistance'=>$data['is_visa_assistance'],
            'is_accomodation_assistance'=>$data['is_accomodation_assistance'],'availability'=>$data['availability']);
        return $this->db->where('uid', $uid)->update($this->table, $data);
    }

    //get education
    public function getEducationInfo($uid) {
        $result = $this->db->select('*')
            ->from('user_education')
            ->where('uid',$uid)
            ->get()
            ->result_array();

        return $result[0];
    }

    //save education
    public function insertEducation($data) {
        $data = array('uid'=>$data['uid'],'school_name'=>$data['school_name'],
            'attend_date_from'=>$data['attended_from'],
            'attend_date_to'=>$data['attended_to'],'degree'=>$data['degree'],
            'major'=>$data['major'],'achievements'=>$data['achievements']);
        return $this->db->insert('user_education', $data);
    }

    //get work history
    public function getWorkHistory($uid) {
        $result = $this->db->select('*')
            ->from('user_work_history')
            ->where('uid', $uid)
            ->get()
            ->result_array();

        return $result[0];
    }

    //save work history
    public function insertWorkHistory($data) {
        $data = array('uid'=>$data['uid'],'introduce'=>$data['introduce'],
            'company_name'=>$data['company_name'],
            'period_time_from'=>$data['period_time_from'],'period_time_to'=>$data['period_time_to'],
            'industry'=>$data['industry'],'position'=>$data['position'],
            'location'=>null,'description'=>$data['description']);
        return $this->db->insert('user_work_history', $data);
    }

    //save language
    public function insertLanguage($data) {
        $data = array('uid'=>$data['uid'],'language'=>$data['language'],
            'level'=>$data['level']);
        return $this->db->insert('user_language', $data);
    }

    /**
     * creat User folder
     *
     * @param
     * @return
     */
    public function creatUserfolder($user_path) {
        if (!is_dir($user_path)) {
            if (!mkdir($user_path, 0777)) {
                return false;
            }
        }
        return true;
    }

}