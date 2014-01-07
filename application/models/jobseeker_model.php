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
                        'username'=>$data['email'],
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
    public function checkUserExisting($username){
        $result = $this->db->select('uid')
            ->from($this->table)
            ->where('username', $username)
            ->get()
            ->result_array();
        return count($result)>0;
    }

    public function getUserIdByUsername($username){
        return $this->db->select('uid')
            ->from($this->table)
            ->where('username', $username)
            ->get()
            ->result_array();
    }

    public function getEmailByCompanyId($id){
        return $this->db->select('email')
            ->from($this->table)
            ->where('uid', $id)
            ->get()
            ->result_array();
    }

    public function getUser($username, $password){
        $where = array('username'=>$username, 'password'=>$password);
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

    public function getSimilarUsers($uid) {
       $result = $this->db->select('*')
            ->from('user')
            ->where_not_in('uid',$uid)
            ->limit(3)
            ->order_by('','random')
            ->get()
            ->result_array();

        return $result;   
    }

    public function updatePassword($uid, $pw){
        $data = array('password'=>md5($pw));
        return $this->db->where('uid', $uid)->update($this->table, $data);
    }
    /**
     * update jobseeker infos
     *
     **/
    public function updateBasicInfo($uid,$data)
    {
        $data = array('first_name'=>$data['first_name'],'last_name'=>$data['last_name'],'city'=>$data['city'],
            'province'=>$data['province'],'country'=>$data['country'], 'profile_pic'=>$data['avatar'],
            'birthday'=>$data['birthday'],'description'=>$data['description'],'is_private'=>$data['is_private']);
        return $this->db->where('uid', $uid)->update($this->table, $data);
    }

    public function updateBirthday($uid,$data)
    {
        $data = array('birthday'=>$data['birthday']);
        return $this->db->where('uid', $uid)->update($this->table, $data);
    }

    public function updateUserDescription($uid, $desc){
        $data = array('description'=>$desc);
        return $this->db->where('uid', $uid)->update($this->table, $data);
    }

    public function updatePhoneNumber($uid, $phoneNumber){
        $data = array('phone'=>$phoneNumber);
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
            'linkedin'=>$data['linkedin'],'facebook'=>$data['facebook'],'weibo'=>$data['weibo']);
        return $this->db->where('uid', $uid)->update($this->table, $data);
    }

    public function updateSNSInfos($uid, $data){
        $data = array('personal_website'=>$data['website'],'twitter'=>$data['twitter'],
            'linkedin'=>$data['linkedin'],'facebook'=>$data['facebook'],'weibo'=>$data['weibo']);
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

    //delete education of a user
    public function deleteEducation($uid){
        $sql = "DELETE FROM user_education WHERE uid=$uid";
        return $this->db->query($sql);
    }
    //get education
    public function getEducationInfo($uid) {
        $result = $this->db->select('*')
            ->from('user_education')
            ->where('uid',$uid)
            ->get()
            ->result_array();

        if(count($result)) {
            return $result[0];
        } else {
            return array();
        }
    }

    public function getAllEducationInfo($uid) {
        $result = $this->db->select('*')
            ->from('user_education')
            ->where('uid',$uid)
            ->get()
            ->result_array();

        if(count($result)) {
            return $result;
        } else {
            return array();
        }
    }

    //save education
    public function insertEducation($data) {
        return $this->db->insert('user_education', $data);
    }

    //get work history
    public function getWorkHistory($uid) {
        $result = $this->db->select('*')
            ->from('user_work_history')
            ->where('uid', $uid)
            ->get()
            ->result_array();

        if(count($result)) {
            return $result[0];
        } else {
            return array();
        }
    }

    //get work history
    public function getAllWorkHistory($uid) {
        $result = $this->db->select('*')
            ->from('user_work_history')
            ->where('uid', $uid)
            ->get()
            ->result_array();

        if(count($result)) {
            return $result;
        } else {
            return array();
        }
    }

    //save work history
    public function insertWorkHistory($data) {
        $this->db->insert('user_work_history', $data);

        return $this->db->insert_id();
    }

    public function updateWorkHistory($id, $data) {
        return $this->db->where('id', $id)->update("user_work_history", $data);
    }
    
    public function delWorkHistory($id) {
    	$sql = 'DELETE FROM user_work_history WHERE id='.$id;
    	return $this->db->query($sql);
    }

    //save language
    public function insertLanguage($data) {
        return $this->db->insert('user_language', $data);
    }

    //get language
    public function getLanguage($uid) {
        $sql = "SELECT language,level FROM user_language WHERE uid=$uid";
        return $this->db->query($sql)->result_array();
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

    //get register step
    public function getRegisterStep($uid) {
        $result = $this->db->select('register_step')
                ->from('user')
                ->where('uid', $uid)
                ->get()
                ->result_array();
        return $result[0]["register_step"];
    }

    //save register step
    public function saveRegisterStep($uid, $reg_str) {
        $data = array('register_step'=>$reg_str);
        return $this->db->where('uid', $uid)->update($this->table, $data);
    }

    public function addSocialNetwork($uid, $social_name, $social_id=null) {
        $sql = "REPLACE INTO user_social VALUE ($uid, '". $social_name."','".$social_id."')";

        $this->db->query($sql);
    }

    public function deleteSocialNetwork($uid) {
        $sql = "DELETE FROM user_social WHERE uid=$uid";
        return $this->db->query($sql);
    }

    // save the settings of seeking industry in Preferences item
    public function addSeekingIndustry($uid, $industry, $position) {
        $sql = "REPLACE INTO user_seeking_industry VALUE ($uid, '". $industry."','".$position."')";

        $this->db->query($sql);
    }
    
    public function delSeekingIndustry($uid) {
    	$sql = 'DELETE FROM user_seeking_industry WHERE uid= '.$uid;
    	return $this->db->query($sql);
    }

    public function getSeekingIndustry($uid) {
        $sql = "SELECT industry,position FROM user_seeking_industry WHERE uid=$uid";

        $rtn = $this->db->query($sql)->result_array();

        if(count($rtn)) {
            return $rtn;
        } else {
            return array();
        }
    }

    public function getAllSeekingIndustry($uid) {
        $sql = "SELECT industry,position FROM user_seeking_industry WHERE uid=$uid";

        $rtn = $this->db->query($sql)->result_array();

        if(count($rtn)) {
            return $rtn;
        } else {
            return array();
        }
    }

    // get personal skills
    public function getPersonalSkills($uid) {
        $sql = "SELECT personal_skill FROM user_personal_skills WHERE uid=$uid";

        $rtn = $this->db->query($sql)->result_array();
        return $rtn;
    }

    // delete personal skills
    public function delPersonalSkills($uid, $skill) {
        $sql = "DELETE FROM user_personal_skills WHERE uid=$uid AND personal_skill='".$skill."'";
        $this->db->query($sql);
    }

    // add personal skills
    public function addPersonalSkills($uid, $skill) {
        $sql = "REPLACE INTO user_personal_skills VALUES ($uid,'". $skill."')";
        $this->db->query($sql);
    }

    //get professional skills
    public function getProfessionalSkills($uid) {
        $sql = "SELECT professional_skill FROM user_professional_skills WHERE uid=$uid";

        $rtn = $this->db->query($sql)->result_array();
        return $rtn;
    }

    // delete professional skills
    public function delProfessionalSkills($uid, $skill) {
        $sql = "DELETE FROM user_professional_skills WHERE uid=$uid AND professional_skill='".$skill."'";
        $this->db->query($sql);
    }

    // add professional skills
    public function addProfessionalSkills($uid, $skill) {
        $sql = "REPLACE INTO user_professional_skills VALUES ($uid,'". $skill."')";
        $this->db->query($sql);
    }

    //get newest job seekers
    public function getNewestJobSeekers($count){
        $sql = "SELECT first_name,city FROM user ORDER BY uid DESC LIMIT 0, $count";
        $rtn = $this->db->query($sql)->result_array();
        return $rtn;
    }

    public function getIndustry() {
        $sql = "SELECT id,name FROM industry WHERE parent='0' ORDER BY id ASC";
        $rtn = $this->db->query($sql)->result_array();
        return $rtn;
    }

    public function getSkills($skill_type, $query_str) {
        if(!empty($query_str)) {
            $sql = "SELECT id,skill FROM " . $skill_type . " WHERE skill like '" . $query_str . "%'";
        } else {
            $sql = "SELECT id,skill FROM " . $skill_type;
        }

        return $this->db->query($sql)->result_array();
    }

    public function getPosition($name) {
        $sql = "SELECT name FROM industry WHERE parent='". $name ."'";
        return $this->db->query($sql)->result_array();
    }

    public function delSeekingIndusry($uid, $ind, $pos) {
        $sql = "DELETE FROM user_seeking_industry WHERE uid=$uid AND industry ='" . $ind . "' AND position='".$pos."'";
        $this->db->query($sql);
    }

    public function delLanguage($uid, $lan=null) {
    	if (empty($lan)) {
    		$sql = 'DELETE FROM user_language WHERE uid='.$uid;
    	} else {
        	$sql = "DELETE FROM user_language WHERE uid=$uid AND language ='" . $lan . "'";
    	}
        $this->db->query($sql);
    }

    public function insertUserIndustry($data) {
        return $this->db->insert('user_industry_position', $data);
    }

    public function updateUserIndustry($id, $data) {
        return $this->db->where('id', $id)->update("user_industry_position", $data);
    }

    public function delUserIndusry($id) {
        $sql = 'DELETE FROM user_industry_position WHERE id='.$id;
        $this->db->query($sql);
    }

    public function getUserIndustry($uid, $id) {
        $sql = "SELECT * from user_industry_position WHERE uid=$uid AND parent_id=$id";

        return $this->db->query($sql)->result_array();
    }

    public function sendInterviewRequest($data) {
        return $this->db->insert('interview', $data);
    }

    public function getInterviews($where) {
        $sql = "SELECT *,i.id as interview_id, i.company_id as company_id,i.country as time_country
            ,i.city as time_city from interview as i LEFT JOIN user as u on u.uid=i.company_id
            LEFT JOIN job as j on i.job_id=j.id
            WHERE $where";

        return $this->db->query($sql)->result_array();
    }

    public function deleteInterviews($id) {
        $select_sql = 'SELECT is_deleted FROM interview WHERE id=' . $id;
        $result = $this->db->query($select_sql)->result_array();

        if($result[0]['is_deleted'] == 0) {
            $sql = 'UPDATE interview SET is_deleted=1 WHERE id='.$id;
        } else {
            $sql = 'DELETE FROM interview WHERE id='.$id;
        }
        return $this->db->query($sql);
    }

    public function saveInterviewReply($reply_id, $id) {
        $sql = "UPDATE interview SET reply_id=$reply_id WHERE id=".$id;
        return $this->db->query($sql);
    }

    public function getViewedCompany($uid) {
        $sql = "SELECT company_id, profile_pic, username as job_name FROM company_viewed as cv
                LEFT JOIN user as u on cv.company_id=u.uid WHERE cv.uid=$uid ORDER BY view_date DESC LIMIT 3";

        return $this->db->query($sql)->result_array();
    }

    public function updateUserLastRequest($uid, $status)
    {
        $time = date("Y-m-d H:i:s",time());
        $data = array('lastrequest'=>$time);
        $this->db->where('uid', $uid);
        $this->db->update('user_status',$data);
    }

    /**
     * Update User online status
     * 
     **/
    public function updateUserStatus($uid, $status) {
        $time = date("Y-m-d H:i:s",time());
        $sql = "REPLACE INTO user_status values($uid, $status, '$time','$time')";

        return $this->db->query($sql);
    }

    public function getUserOnlineStatusById($user_ids='') {
        $user_arr = explode(',',$user_ids);
        $result = $this->db->select('*')
                 ->from('user_status')
                 //->where('status',1)
                 ->where_in('uid',$user_arr)
                 ->get()
                 ->result_array();
        return $result;
    }

    public function getUserOnlineStatus($user_ids='') {
        $result = $this->db->select('*')
                 ->from('user_status')
                 //->where('status',1)
                 //->where_in('uid',$user_ids)
                 ->get()
                 ->result_array();
        return $result;
    }

    public function cleanUp() {
        if (rand(1,3) == 1) {
            $timestamp = 144;
            $sql = "update user_status set status=-1 where UNIX_TIMESTAMP(Now())-UNIX_TIMESTAMP(lastrequest)>" . $timestamp;

            @ $this->db->query($sql);
        }
    }

    public function updateVisitNum($uid) {
        $sql = "UPDATE user set visit_num=visit_num+1 WHERE uid=$uid";
        return $this->db->query($sql);
    }
}