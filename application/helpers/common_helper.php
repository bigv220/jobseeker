<?php
	
	function isLogin()
	{
		$c = &get_instance();
		return $c->session->userdata('username') ? TRUE : FALSE;
	}
	
	function isAdmin()
	{
		$c = &get_instance();
		return $c->session->userdata('isadmin');
	}
	
	function checkLogin()
	{
		if (!isLogin())
			redirect('/');
	}
	
	function checkAdmin()
	{
		if (!isAdmin())
			redirect('main');
	}
	
	function langName($lang)
	{
		$lang_arr = array(
					'en' => '英文',
					'cn' =>	'中文',
					'kr' => '韩文',
		);
		return $lang_arr[$lang];
	}
	
	/**
	 * Add system log
	 * @param String $action
	 */
	function addSysLog($action)
	{
		$c = &get_instance();
		$c->load->model('syslog_model');
		$c->syslog_model->addLog($action);
	}
	
	/**
	 * js alert message
	 * @param String $msg
	 * @param String $url
	 */
	function alertmsg($msg, $url = '')
	{
		$href = $url == '' ? 'window.history.go(-1);' : 'window.location.href="'.$url.'";';
		
		$html = '<!DOCTYPE HTML>
				<html><head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<title>'.$msg.'</title>
				<script>alert("'.$msg.'");'.$href.'</script>
				</head>
				<body></body></html>';
		
		exit($html);
	}
	
	/**
	 * Show message
	 * @param String $url
	 * @param String $show
	 */
	function showmsg($url, $show = 'Success')
	{
		$html = '<!DOCTYPE HTML>
				<html><head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<meta http-equiv="refresh" content="2; url='.$url.'" />
				<title>Message</title>
				<style>
				body{font-size: 12px;}
				p{margin:20px;}
				table{border:1px #999 solid;}
				.title{background:#f0f0f0;height:25px;border-bottom:1px #999 solid;}
				</style>
				</head>
				<body>
				<div id="man_zone">
				  <table width="280px" align="center"  cellpadding="3" cellspacing="0" class="table" style="margin-top:100px;">
				    <tr>
				      <th align="center" class="title">Message</th>
				    </tr>
				    <tr>
				      <td align="center"><p><b>' .$show. '</b> &nbsp; After 2 seconds back.<br /><br />
				                If your browser doesn\'t respond,<br><a href="'.$url.'"> please click here.</a></p></td>
				    </tr>
				  </table>
				</div>
				</body>
				</html>';
		exit($html);
	}

function getFirstImgInArticle($article, $themePath){
    $firstImage = '';
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $article['content'], $matches);
    if(count($matches[1]) > 0)
        $firstImage = $matches[1][0];
    if(empty($firstImage)){
        $firstImage = $themePath . "style/home/temp/temp-h1.gif";
    }
    return $firstImage;
}

function language_arr() {
	return array('Albanian','Amharic','Arabic','Armenian','Belarusan','Bengali','Bulgarian','Burmese',
				'Chinese (Dialect)','Chinese (Mandarin)','Danish','Dutch','English (UK)','English (US)',
				'Estonian','Farsi','Filipino','Finnish','Flemish','French','Georgian','German','Greek',
				'Hausa','Hebrew','Hindi','Hungarian','Icelandic','Indonesian','Italian','Japanese',
				'Khmer','Korean','Lao','Latvian','Malay','Maori','Nepali','Norwegian','Panjabi','Polish',
				'Portuguese','Romanian','Russian','Samoan','Serbian','Sindhi','Spanish','Swedish','Taiwanese',
				'Tamil','Thai','Tongan','Turkish','Ukrainian','Urdu','Uzbek','Vietnamese');
}
function getLanguageByID($id) {
	$arr = language_arr();echo $id;
    if(empty($id)) {
        return $arr[0];
    }
	return $arr[$id-1];
}

function language_level() {
	return array('Beginner','Intermediate','Fluent','Native Tongue');
}
function getLanguageLevelByID($id) {
	$arr = language_level();
    if(empty($id)) {
        return $arr[0];
    }
	return $arr[$id-1];
}

function getSalary() {
	return array('Unpaid','<10,000','10,000-15,000','15,000-20,000','20,000-30,000','30,000-40,000','40,000+','Negotiable');
}
function getSalaryByID($id) {
	$arr = getSalary();
    if(empty($id)) {
        return $arr[0];
    }
	return $arr[$id-1];
}

function getExperience() {
	return array('No preference','1+','2+','3+','4>');
}
function getExperienceByID($id) {
	$arr = getExperience();
    if(empty($id)) {
        return $arr[0];
    }
	return $arr[$id-1];
}

function jobtype() {
	return array('Full Time','Part Time','Contract','Internship');
}
function getJobtypeByID($id) {
	$arr = jobtype();
	return $arr[$id-1];
}

function getEmploymentLength() {
	return array('Long term employment (1+ years)','Short term employment (-1 years)','No preference');
}
function getEmploymentLengthByID($id) {
	$arr = getEmploymentLength();
	return $arr[$id-1];
}

function getVisaAssistance() {
    return array('Visa will not be provided','Visa will be provided');
}
function getVisaAssistanceByID($id) {
    $arr = getVisaAssistance();
    return $arr[$id];
}

function getHousingAssistance() {
    return array('Accomodation will not be provided','Accomodation will be provided');
}
function getHousingAssistanceByID($id) {
    $arr = getHousingAssistance();
    return $arr[$id];
}

function securelychk($msg = 'unknown error.') {
	alertmsg($msg);
}

function isCompany($utype) {
	if (1 == $utype) {
		return true;
	} else {
		return false;
	}
}

