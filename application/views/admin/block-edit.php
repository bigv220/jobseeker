<?php $this->load->view($admin_theme.'/header-block');?>
      <div id="top-panel">
            <div id="panel">
                <ul>
                    <li><a href="<?php echo $site_url?>admin/block/add/" class="add">增加碎片</a></li>
                    <li><a href="<?php echo $site_url?>admin/block/" class="invoices">查看碎片</a></li>
                </ul>
            </div>
      </div>
      <div id="wrapper">
            <div id="content">
              
                <div id="box">
                	<h3 id="adduser"><?php echo empty($block)?'增加':'编辑' ?> 碎片</h3>
                    <form id="form" action="<?php echo $site_url?>admin/block/<?php echo empty($block)?'add':'edit/'.$block['aid'] ?>/" method="post">
                    	<fieldset id="page">
                    		<label for="url">Key:</label> 
                    		<input name="url" id="url" type="text" value="<?php if(!empty($block)) echo $block['url']?>" />
                    		<br />
                    		<label for="title">描述:</label> 
                    		<input name="title" id="title" type="text" value="<?php if(!empty($block)) echo $block['title']?>" />
                    		<br />
                    		<label for="content1">内容:</label> 
                    		<script charset="utf-8" src="<?php echo $theme_path?>js/editor/kindeditor-min.js"></script>
                    		<script charset="utf-8" src="<?php echo $theme_path?>js/editor/lang/zh_CN.js"></script>
                    		<script>
		                    		var editor;
							        KindEditor.ready(function(K) {
							                editor = K.create('#content1', {
							                        resizeType : 2,
							                        newlineTag : 'br',
							                        minWidth : 580,
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
                    			<?php if(!empty($block)) echo htmlspecialchars($block['content']) ?>
                    		</textarea>
                    		<br />
                    		
                    		<label for="lang">语言:</label> 
                    		<select name="lang">
	                    		<option value="en" <?php if($lang=='en') echo 'selected="selected"'?>><?php echo langName('en')?></option>
	                    		<option value="cn" <?php if($lang=='cn') echo 'selected="selected"'?>><?php echo langName('cn')?></option>
                    		</select>
                    		<br />
                    		
                    	</fieldset>
                      <div align="center">
                      <?php if(!empty($block)):?>
                      <input type="hidden" name="aid" value="<?php echo $block['aid']?>" />
                      <?php endif;?>
                      
                      <input type="hidden" name="type" value="block" />
                      <input id="button1" type="submit" value="提交" /> 
                      <input id="button2" type="reset" value="重置" />
                      </div>
                    </form>

                </div>

                	
            </div>
			<?php $this->load->view($admin_theme.'/sidebar-block');?>
      </div>
<?php $this->load->view($admin_theme.'/footer-block');?>