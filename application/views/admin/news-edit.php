<?php $this->load->view($admin_theme.'/header-block');?>
      <div id="top-panel">
            <div id="panel">
                <ul>
                    <li><a href="<?php echo $site_url?>admin/news/add/" class="add">增加新闻</a></li>
                    <li><a href="<?php echo $site_url?>admin/news/" class="invoices">查看新闻</a></li>
                </ul>
            </div>
      </div>
      <div id="wrapper">
            <div id="content">
              
                <div id="box">
                	<h3 id="adduser"><?php echo empty($article)?'增加':'编辑' ?> 新闻</h3>
                    <form id="form" action="<?php echo $site_url?>admin/news/<?php echo empty($article)?'add':'edit/'.$article['aid'] ?>/" method="post">
                    	<fieldset id="news">
                    		<label for="title">标题:</label> 
                    		<input name="title" id="title" type="text" value="<?php if(!empty($article)) echo $article['title']?>" />
                    		<br />
                    		<label for="descrip">摘要:</label> 
                    		<textarea name="descrip" id="descrip" style="height:50px;"><?php if(!empty($article)) echo $article['descrip']?></textarea>
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
                    			<?php if(!empty($article)) echo htmlspecialchars($article['content']) ?>
                    		</textarea>
                    		<br />
                    		
                    		<link rel="stylesheet" type="text/css" href="<?php echo $theme_path?>js/datepicker/jquery-ui-1.8.4.datepicker.css" />
							<script type="text/javascript" src="<?php echo $theme_path?>js/datepicker/jquery-ui-1.8.4.datepicker.min.js"></script> 
							<script type="text/javascript" src="<?php echo $theme_path?>js/datepicker/jquery.ui.datepicker-zh-CN.js"></script> 
							<script type="text/javascript"> 
								$(function() {
									$("#datepicker").datepicker();
								});
							</script> 
                    		<label for="date">日期:</label> 
                    		<input name="date" id="datepicker" type="text" value="<?php echo empty($article) ? date('Y-m-d', time()) : date('Y-m-d',$article['date'])?>" />
                    		<br />
                    		
                    		<label for="cid">父分类:</label>
                    		<select id="cid" name="cid">
                    		<?php foreach ($cat_tree as $row):?>
                    			<option <?php if(!empty($article)&&$article['cid']==$row['cid']) echo 'selected="selected"';?> value="<?php echo $row['cid']?>"><?php echo str_repeat('&nbsp;', $row['level']*3).$row['name']?></option>
            				<?php endforeach;?>
            				</select>
                    		<br />
                    		<label for="lang">语言:</label> 
                    		<select name="lang">
	                    		<option value="en" <?php if($lang=='en') echo 'selected="selected"'?>><?php echo langName('en')?></option>
	                    		<option value="cn" <?php if($lang=='cn') echo 'selected="selected"'?>><?php echo langName('cn')?></option>
                    		</select>
                    		<br />
                    	</fieldset>
                      <div align="center">
                      <?php if(!empty($article)):?>
                      <input type="hidden" name="aid" value="<?php echo $article['aid']?>" />
                      <?php endif;?>
                      <input type="hidden" name="type" value="news" />
                      <input id="button1" type="submit" value="提交" /> 
                      <input id="button2" type="reset" value="重置" />
                      </div>
                    </form>
					<script type="text/javascript">
					$("#form").submit(function(){
						if($("#title").val() == "") {
							alert("请填写标题。");
							$("#title").focus();
							return false;
						}
						if($("#cid option:selected").html().substr(0,2) == "--") {
							alert("请选择父分类。");
							$("#cid").focus();
							return false;
						}
					});
					</script>
                </div>

                	
            </div>
			<?php $this->load->view($admin_theme.'/sidebar-block');?>
      </div>
<?php $this->load->view($admin_theme.'/footer-block');?>