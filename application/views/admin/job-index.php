<?php $this->load->view($admin_theme.'/header-block');?>
      <div id="top-panel">
            <div id="panel">
                <ul>
                    <!-- <li><a href="<?php echo $site_url?>admin/user/add/" class="useradd">增加用户</a></li>
                    <li><a href="<?php echo $site_url?>admin/user/" class="group">查看用户</a></li> -->
                </ul>
            </div>
      </div>
      <div id="wrapper">
            <div id="content">
                
                <div id="box">
                	<h3>Job list</h3>
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
                            	<th>Job Title</th>
                                <th width="300px">Company</th>
                                <th width="100px">Posted Date</th>
                                <!-- <th width="120px">登录时间</th> -->
                                <th width="60px">Action</th>
                            </tr>
						</thead>
						<tbody>
						<?php foreach ($jobs as $row) :?>
							<tr>
                            	<td class="a-center"><?php echo $row['id']?></td>
                            	<td><?php echo $row['job_name']?></td>
                                <td><?php echo $row['first_name']?></td>
                                <td class="a-center"><?php echo $row['post_date']?></td>
                                <!-- <td class="a-center"><?php //echo $row['lastlogon']==0 ? '从未登录' : date('Y-m-d H:i',$row['lastlogon'])?></td> -->
                                <td class="a-center">
                                	<!-- <a href="<?php echo $site_url.'admin/job/edit/'.$row['id']?>"><img src="<?php echo $theme_path?>img/icons/user_edit.png" title="Edit" width="16" height="16" /></a> &nbsp;  -->
                                	<a href="<?php echo $site_url.'admin/job/delete/'.$row['id']?>" onclick="javascript:return confirm('Delete ?');"><img src="<?php echo $theme_path?>img/icons/user_delete.png" title="Delete" width="16" height="16" /></a>
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