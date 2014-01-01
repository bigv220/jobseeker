<?php $this->load->view($admin_theme.'/header-block');?>
<script type="text/javascript" src="<?php echo $theme_path?>js/jslib/ajaxupload.js"></script>
      <div id="top-panel">
            <div id="panel">
                <ul>
                    <li><a href="<?php echo $site_url?>admin/news/add/" class="add">Add</a></li>
                    <!-- <li><a href="<?php echo $site_url?>admin/news/" class="invoices">查看新闻</a></li> -->
                </ul>
            </div>
      </div>
      <div id="wrapper">
            <div id="content">
              
                <div id="box">
                	<h3 id="adduser"><?php echo empty($article)?'Add':'Edit' ?> News</h3>
                    <form id="form" action="<?php echo $site_url?>admin/news/<?php echo empty($article)?'add':'edit/'.$article['aid'] ?>/" method="post">
                    	<fieldset id="news">
                    		<label for="title">Title:</label> 
                    		<input name="title" id="title" type="text" value="<?php if(!empty($article)) echo $article['title']?>" />
                    		<br />
                    		<label for="descrip">Description:</label> 
                    		<textarea name="descrip" id="descrip" style="height:50px;"><?php if(!empty($article)) echo $article['descrip']?></textarea>
                    		<br />
                    		<label for="content_short">General Content:</label> 
                    		<script charset="utf-8" src="<?php echo $theme_path?>js/editor/kindeditor-min.js"></script>
                    		<script charset="utf-8" src="<?php echo $theme_path?>js/editor/lang/zh_CN.js"></script>
                    		<script>
		                    		var editor;
							        KindEditor.ready(function(K) {
							                editor = K.create('#content_general', {
							                        resizeType : 2,
							                        newlineTag : 'br',
							                        minWidth : 580,
							                        width : '760px',
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
                    		<textarea name="content" id="content_general">
                    			<?php if(!empty($article)) echo htmlspecialchars($article['content_general']) ?>
                    		</textarea>
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
                                      minWidth : 580,
                                      width : '760px',
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
                    		
                    		<link rel="stylesheet" type="text/css" href="<?php echo $theme_path?>js/datepicker/jquery-ui-1.8.4.datepicker.css" />
							<script type="text/javascript" src="<?php echo $theme_path?>js/datepicker/jquery-ui-1.8.4.datepicker.min.js"></script> 
							<script type="text/javascript" src="<?php echo $theme_path?>js/datepicker/jquery.ui.datepicker-zh-CN.js"></script> 
							<script type="text/javascript"> 
								$(function() {
									$("#datepicker").datepicker();
								});
							</script> 
                    		<label for="date">Date:</label> 
                    		<input name="date" id="datepicker" type="text" value="<?php echo empty($article) ? date('Y-m-d', time()) : date('Y-m-d',$article['date'])?>" />
                    		<br />
                    		
                    		<label for="cid">Parent:</label>
                    		<select id="cid" name="cid">
                    		<?php foreach ($cat_tree as $row):?>
                    			<option <?php if(!empty($article)&&$article['cid']==$row['cid']) echo 'selected="selected"';?> value="<?php echo $row['cid']?>"><?php echo str_repeat('&nbsp;', $row['level']*3).$row['name']?></option>
            				<?php endforeach;?>
            				</select>
                    		<br />

                <label for="date">Speical Image:</label> 
                    <div>
                        <input type="hidden" name="profile_pic" id="avatar" value="<?php if(!empty($article)) echo $article['profile_pic']; ?>" />
                        <div id="upload_button">
                            <?php if(!empty($article['profile_pic'])) {
                                        $pic = $site_url.'attached/article/'.$article['profile_pic'];
                                   } else {
                                        $pic = $theme_path.'img/com-img.gif';
                                   }
                            ?>
                            <img id="image_profile" height='100px' src="<?php echo $pic; ?>" class="reg-company-img" />
                        </div>
                        <span class="" id="errorRemind"></span>
                    </div>
                
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
                      <input type="hidden" name="type" value="news" />
                      <input id="button1" type="submit" value="Submit" /> 
                      <input id="button2" type="reset" value="Reset" />
                      </div>
                    </form>
					<script type="text/javascript">
					$("#form").submit(function(){
						if($("#title").val() == "") {
							alert("Please fill in title.");
							$("#title").focus();
							return false;
						}
						if($("#cid option:selected").html().substr(0,2) == "--") {
							alert("Please select a perant category.");
							$("#cid").focus();
							return false;
						}
					});
          $('document').ready(function() {
              uploadImage();
          });
          function uploadImage(old_avatar) {
    var oBtn = document.getElementById("image_profile");
    var upload_button = document.getElementById("upload_button");
    var oRemind = document.getElementById("errorRemind");
    new AjaxUpload(oBtn,{
        action:site_url+"admin/news/ajaxuploadimage",
        name:"avatar",
        data: {},
        onSubmit:function(file,ext){
            if(ext && /^(jpg|jpeg|png|gif)$/.test(ext)){
                oRemind.style.color = "orange";
                oRemind.innerHTML = "uploading...";
                oBtn.disabled = "disabled";
            }else{
                oRemind.style.color = "red";
                oRemind.innerHTML = "Sorry, Do not support this image type.";
                return false;
            }
        },
        onComplete:function(file,response){
            oBtn.disabled = "";
            var response = response.split("|");
            if ( response[0] == 'success') {
                oRemind.style.color = "green";
                oRemind.innerHTML = "Upload successful.";

                //var reg = /\s/g;
                var filename = response[1];

                var img_path = site_url+"attached/article/" + filename;
                $('#avatar').val(filename);
                upload_button.innerHTML = "<img id='image_profile' src='" + img_path + "?" +  Math.floor(Math.random()*99999 + 1) + "' height='100' style='border:1px solid gray;' />";
            } else {
                oRemind.style.color = "red";
                oRemind.innerHTML = response[1];
            }
        }
    });
}

					</script>
                </div>

                	
            </div>
			<?php $this->load->view($admin_theme.'/sidebar-block');?>
      </div>

<?php $this->load->view($admin_theme.'/footer-block');?>