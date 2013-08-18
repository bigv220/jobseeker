<?php $this->load->view($admin_theme.'/header-block');?>
      <div id="top-panel">
            <div id="panel">
                <ul>
                    <li><a href="<?php echo $site_url?>admin/user/add/" class="useradd">增加用户</a></li>
                    <li><a href="<?php echo $site_url?>admin/user/" class="group">查看用户</a></li>
                </ul>
            </div>
      </div>
      <div id="wrapper">
            <div id="content">
                
                <div id="box">
                	<h3>用户列表</h3>
                	<script type="text/javascript">
                		$(document).ready(function() 
                		    { 
                		        $("#tablesorter").tablesorter(); 
                		    } 
                		);
                	</script>
                	<table width="100%" id="tablesorter" class="tablesorter">
						<thead>
							<tr>
                            	<th width="40px"><a href="#">ID</a></th>
                            	<th>用户名</th>
                                <th width="240px">电子邮箱</th>
                                <th width="120px">登录时间</th>
                                <th width="60px">操作</th>
                            </tr>
						</thead>
						<tbody>
						<?php foreach ($user as $row) :?>
							<tr>
                            	<td class="a-center"><?php echo $row['uid']?></td>
                            	<td><?php echo $row['username']?></td>
                                <td class="a-center"><?php echo $row['email']?></td>
                                <td class="a-center"><?php echo $row['lastlogon']==0 ? '从未登录' : date('Y-m-d H:i',$row['lastlogon'])?></td>
                                <td class="a-center">
                                	<a href="<?php echo $site_url.'admin/user/edit/'.$row['uid']?>"><img src="<?php echo $theme_path?>img/icons/user_edit.png" title="Edit" width="16" height="16" /></a> &nbsp; 
                                	<a href="<?php echo $site_url.'admin/user/delete/'.$row['uid']?>" onclick="javascript:return confirm('Delete ?');"><img src="<?php echo $theme_path?>img/icons/user_delete.png" title="Delete" width="16" height="16" /></a>
                                </td>
                            </tr>
                        <?php endforeach;?>
						</tbody>
					</table>
					<!--  
                    <div id="pager">
                    	Page <a href="#"><img src="<?php echo $theme_path?>img/icons/arrow_left.gif" width="16" height="16" /></a> 
                    	<input size="1" value="1" type="text" name="page" id="page" /> 
                    	<a href="#"><img src="<?php echo $theme_path?>img/icons/arrow_right.gif" width="16" height="16" /></a>of 42
                    pages | View <select name="view">
                    				<option>10</option>
                                    <option>20</option>
                                    <option>50</option>
                                    <option>100</option>
                    			</select> 
                    per page | Total <strong>420</strong> records found
                    </div>
                    -->
                </div>
                	
            </div>
			<?php $this->load->view($admin_theme.'/sidebar-block');?>
      </div>
<?php $this->load->view($admin_theme.'/footer-block');?>