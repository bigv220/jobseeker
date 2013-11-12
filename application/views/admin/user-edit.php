<?php $this->load->view($admin_theme.'/header-block');?>
      <div id="top-panel">
            <div id="panel">
                <ul>
                    <!-- <li><a href="<?php echo $site_url?>admin/user/add/" class="useradd">增加用户</a></li>
                    <li><a href="<?php echo $site_url?>admin/user/" class="group">查看用户</a></li> -->
                    <li><a href="<?php echo $site_url?>admin/user/?type=company" class="group">Company</a></li>
                    <li><a href="<?php echo $site_url?>admin/user/?type=jobseeker" class="group">Jobseeker</a></li>
                    <li><a href="<?php echo $site_url?>admin/user/?type=unauthenticated" class="group">unauthenticated</a></li>
                </ul>
            </div>
      </div>
      <div id="wrapper">
            <div id="content">
              
                <div id="box">
                	<h3 id="adduser"><?php echo empty($user)?'Edit':'Add' ?> User</h3>
                    <form id="form" action="<?php echo $site_url?>admin/user/<?php echo empty($user)?'add':'edit/'.$user['uid'] ?>/" method="post">
                    	<fieldset id="page">
                    		<label for="username">Username:</label> 
                    		<input name="username" id="username" type="text" value="<?php if(!empty($user)) echo $user['username']?>" <?php //if(!empty($user)) echo 'disabled="disabled"'?> />
                    		<br />
                    		<!-- <label for="firstname">姓名:</label> 
                    		<input name="firstname" id="firstname" type="text" value="<?php if(!empty($user)) echo $user['firstname']?>" />
                    		<br />
                    		<label for="lastname">性别:</label> 
                    		<input name="lastname" id="lastname" type="text" value="<?php if(!empty($user)) echo $user['lastname']?>" />
                    		<br />
                    		<label for="email">电子邮箱:</label> 
                    		<input name="email" id="email" type="text" value="<?php if(!empty($user)) echo $user['email']?>" />
                    		<br /> -->
                    		<label for="password">Password:</label> 
							<input name="password" id="password" type="password" />
                    		<br />
                    		<!-- 
                    		<label for="lang">Language:</label> 
                    		<select name="lang">
	                    		<option value="en" <?php if(!empty($article)&&$article['lang']=='en') echo 'selected="selected"'?>><?php echo langName('en')?></option>
	                    		<option value="cn" <?php if(!empty($article)&&$article['lang']=='cn') echo 'selected="selected"'?>><?php echo langName('cn')?></option>
	                    		<option value="kr" <?php if(!empty($article)&&$article['lang']=='kr') echo 'selected="selected"'?>><?php echo langName('kr')?></option>
                    		</select>
                    		 -->
                    	</fieldset>
                      <div align="center">
                      <?php if(!empty($user)):?>
                      <input type="hidden" name="uid" value="<?php echo $user['uid']?>" />
                      <?php endif;?>
					  <input id="button1" type="submit" value="Submit" /> 
                      <input id="button2" type="reset" value="Reset" />
                      </div>
                    </form>

                </div>

                	
            </div>
			<?php $this->load->view($admin_theme.'/sidebar-block');?>
      </div>
<?php $this->load->view($admin_theme.'/footer-block');?>