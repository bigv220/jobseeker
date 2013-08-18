<?php $this->load->view($admin_theme.'/header-block');?>
      <div id="top-panel">
            <!-- <div id="panel">
                <ul>
                    <li><a href="<?php echo $site_url?>admin/page/add/" class="add">增加页面</a></li>
                    <li><a href="<?php echo $site_url?>admin/page/" class="invoices">查看页面</a></li>
                </ul>
            </div> -->
      </div>
      <div id="wrapper" style="background: #fff;">
            
                    <form id="form" action="<?php echo $site_url?>admin/template/<?php echo empty($filename)?'add':'edit/'.$filename ?>/" method="post">

                    		编辑文件:
                    		<input name="filename" id="filename" type="text" readonly="readonly" value="<?php if(!empty($filename)) echo $filename?>" />
                    		<br />
                    		
                    		<link rel="stylesheet" href="<?php echo $theme_path?>js/codemirror/lib/codemirror.css">
						    <script src="<?php echo $theme_path?>js/codemirror/lib/codemirror.js"></script>
						    <script src="<?php echo $theme_path?>js/codemirror/mode/htmlmixed/htmlmixed.js"></script>
						    <script src="<?php echo $theme_path?>js/codemirror/mode/xml/xml.js"></script>
						    <script src="<?php echo $theme_path?>js/codemirror/mode/javascript/javascript.js"></script>
						    <script src="<?php echo $theme_path?>js/codemirror/mode/css/css.js"></script>
						    <script src="<?php echo $theme_path?>js/codemirror/mode/clike/clike.js"></script>
						    <script src="<?php echo $theme_path?>js/codemirror/mode/php/php.js"></script>
						    <style type="text/css">
								.CodeMirror {border-top: 1px solid black; border-bottom: 1px solid black;height:auto;}
								.CodeMirror-scroll { overflow-y: hidden;overflow-x: auto;}
      						</style>
                    		
                    		<textarea name="code" id="code"><?php echo $code_string ?></textarea>
                    		
                    		<script>
						      var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
						        lineNumbers: true,
						        matchBrackets: true,
						        mode: "application/x-httpd-php",
						        indentUnit: 4,
						        indentWithTabs: true,
						        enterMode: "keep",
						        tabMode: "shift",
						        viewportMargin: Infinity
						      });
						    </script>
                    		<br />
                    		
                      <div align="center">
                      <input id="button1" type="submit" value="提交" /> 
                      </div>
                    </form>

    
      </div>
<?php $this->load->view($admin_theme.'/footer-block');?>