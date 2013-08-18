<?php $this->load->view($admin_theme.'/header-block');?>
      <!-- <div id="top-panel">
            <div id="panel">
                <ul>
                    <li><a href="<?php echo $site_url?>admin/page/add/" class="add">Add page</a></li>
                    <li><a href="<?php echo $site_url?>admin/page/" class="invoices">List page</a></li>
                </ul>
            </div>
      </div> -->
      <div id="wrapper">
            <div id="content">
              
                <div id="box">
                	<h3 id="adduser"><?php echo empty($user)?'增加':'编辑' ?> 用户</h3>
                    <form id="form" action="<?php echo $site_url?>admin/user/<?php echo empty($user)?'add':'edit/'.$user['uid'] ?>/" method="post">
                    	<fieldset id="page">
                    		<label for="username">用户名:</label> 
                    		<input name="username" id="username" type="text" value="<?php if(!empty($user)) echo $user['username']?>" <?php if(!empty($user)) echo 'disabled="disabled"'?> />
                    		<br />
                    		<label for="firstname">姓名:</label> 
                    		<input name="firstname" id="firstname" type="text" value="<?php if(!empty($user)) echo $user['firstname']?>" />
                    		<br />
                    		<label for="lastname">性别:</label> 
                    		<input name="lastname" id="lastname" type="text" value="<?php if(!empty($user)) echo $user['lastname']?>" />
                    		<br />
                    		<label for="email">电子邮箱:</label> 
                    		<input name="email" id="email" type="text" value="<?php if(!empty($user)) echo $user['email']?>" />
                    		<br />
                    		<label for="password">密码:</label> 
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
                      <input type="hidden" name="isadmin" value="1" />
                      <input type="hidden" name="status" value="active" />
					  <input id="button1" type="submit" value="提交" /> 
                      <input id="button2" type="reset" value="重置" />
                      </div>
                    </form>

                </div>

                	
            </div>
			<?php $this->load->view($admin_theme.'/sidebar-block');?>
      </div>
<?php $this->load->view($admin_theme.'/footer-block');?>