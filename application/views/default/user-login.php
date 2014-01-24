
<div class="loginBox">
	<form action="<?php echo $site_url?>user/login/" method="post" name="loginForm">
		username:<input type="text" name="username" size="20" /><br />
		password:<input type="password" name="password" size="20" /><br />
		<!-- 验证码：<input type="text" name="validationcode" size="5"> <img src="imagecode" title="看不清楚，换一张" align="absmiddle" style="cursor: pointer;" onclick="javascript:newcode(this);" /><br /> -->
		<input type="submit" value="login" style="margin-left:100px" />
	</form>
</div>