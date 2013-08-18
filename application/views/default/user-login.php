<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理登陆</title>
<style>
	body{font-size:12px;}
	form{margin:5px 0px; padding:0;}
	.loginBox{width:230px; border:10px solid #ccc; padding:10px; margin:150px auto 0px auto;}
	.loginTitle{font-weight:bold; line-height:25px; text-align:center; background-color: #F0F0F0;}
	.footer{width:230px; text-align:center; margin:20px auto; color:#999;}
	.footer a{color:#999; text-decoration:none;}
</style>
</head>
<body>
<div class="loginBox">
	<div class="loginTitle">后台管理登录</div>
	<form action="<?php echo $site_url?>user/login/" method="post" name="loginForm">
		用户名：<input type="text" name="username" size="20" /><br />
		密<!--[if IE]>&nbsp;&nbsp;<![endif]-->&nbsp;&nbsp;码：<input type="password" name="password" size="20" /><br />
		<!-- 验证码：<input type="text" name="validationcode" size="5"> <img src="imagecode" title="看不清楚，换一张" align="absmiddle" style="cursor: pointer;" onclick="javascript:newcode(this);" /><br /> -->
		<input type="submit" value="登录" style="margin-left:100px" />
	</form>
</div>
<div class="footer">
	Copyright &copy; 2011 Bsmaritime<br />Powered by <a href="http://www.etonn.com">etonn</a>
</div>
</body>
<script language="javascript">
/*
var error = "";
if (error != "") alert(error);

function newcode(obj) {
	obj.src = "imagecode/" + new Date().getTime();
}
*/
</script>
</html>
<?php //$this->load->view($front_theme.'/header-block');?>
<?php //$this->load->view($front_theme.'/footer-block');?>