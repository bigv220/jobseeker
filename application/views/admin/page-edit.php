<?php $this->load->view($admin_theme.'/header-block');?>
      <div id="top-panel">
            <div id="panel">
                <ul>
                    <li><a href="<?php echo $site_url?>admin/page/add/" class="add">Add</a></li>
                    <!-- <li><a href="<?php echo $site_url?>admin/page/" class="invoices">查看页面</a></li> -->
                </ul>
            </div>
      </div>
      <div id="wrapper">
            <div id="content">
              
                <div id="box">
                	<h3 id="adduser"><?php echo empty($article)?'Add':'Edit' ?> Page</h3>
                    <form id="form" action="<?php echo $site_url?>admin/page/<?php echo empty($article)?'add':'edit/'.$article['aid'] ?>/" method="post">
                    	<fieldset id="page">
                    		<label for="title">Title:</label> 
                    		<input name="title" id="title" type="text" value="<?php if(!empty($article)) echo $article['title']?>" />
                    		<br />
                    		<label for="url">URL:</label> 
                    		<input name="url" id="url" type="text" value="<?php if(!empty($article)) echo $article['url']?>" />
                    		<br />
                    		<label for="content1">Content:</label> 
                    		<script charset="utf-8" src="<?php echo $theme_path?>js/editor/kindeditor-min.js"></script>
                    		<script charset="utf-8" src="<?php echo $theme_path?>js/editor/lang/zh_CN.js"></script>
                    		<script>
							        var editor;
							        KindEditor.ready(function(K) {
							                editor = K.create('#content1', {
							                        resizeType : 2,
							                        newlineTag : 'br',
							                        minWidth : 760,
							                        width : '580px',
							                        allowFileManager : true,
							                        uploadJson : '<?php echo $site_url?>admin/ajax/upload_json/',
							                        fileManagerJson : '<?php echo $site_url?>admin/ajax/file_manager_json/',
							                        items : [
															'source', '|', 'undo', 'redo', '|', 'preview', 'template', 'cut', 'copy', 'paste',
															'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
															'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
															'superscript', 'clearhtml', 'quickformat', '/',
															'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
															'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage', 
															'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 
															'link', 'unlink', 'fullscreen'
											            	]
							                });
							        });
							</script>
                    		<textarea name="content" id="content1">
                    			<?php if(!empty($article)) echo htmlspecialchars($article['content']) ?>
                    		</textarea>
                    		<br />
                    		
                    		<!-- <label for="lang">语言:</label> 
                    		<select name="lang">
	                    		<option value="en" <?php if($lang=='en') echo 'selected="selected"'?>><?php echo langName('en')?></option>
	                    		<option value="cn" <?php if($lang=='cn') echo 'selected="selected"'?>><?php echo langName('cn')?></option>
                    		</select>
                    		<br /> -->
                    		
                    	</fieldset>
                      <div align="center">
                      <?php if(!empty($article)):?>
                      <input type="hidden" name="aid" value="<?php echo $article['aid']?>" />
                      <?php endif;?>
                      
                      <input type="hidden" name="type" value="page" />
                      <input id="button1" type="submit" value="Submit" /> 
                      <input id="button2" type="reset" value="Reset" />
                      </div>
                    </form>

                </div>

                	
            </div>
			<?php $this->load->view($admin_theme.'/sidebar-block');?>
      </div>
<?php $this->load->view($admin_theme.'/footer-block');?>