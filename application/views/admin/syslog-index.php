<?php $this->load->view($admin_theme.'/header-block');?>
      <?php if (1 == $this->session->userdata('uid')):?>
      <div id="top-panel">
      		<div id="panel">
                <ul>
                    <li><a href="<?php echo $site_url?>admin/syslog/delete/" class="delete">清除一年以前的日志</a></li>
                </ul>
            </div>
      </div>
      <?php endif;?>
      <div id="wrapper">
            <div id="content">
                
                <div id="box">
                	<h3>日志列表</h3>
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
                            	<th width="120px">用户</th>
                            	<th>行为</th>
                                <th width="100px">IP</th>
                                <th width="120px">日期</th>
                            </tr>
						</thead>
						<tbody>
						<?php foreach ($logs as $row) :?>
							<tr>
                            	<td class="a-center"><?php echo $row['lid']?></td>
                            	<td class="a-center"><?php echo $row['username']?></td>
                            	<td><?php echo $row['action']?></td>
                                <td class="a-center"><?php echo $row['ip']?></td>
                                <td class="a-center"><?php echo date('Y-m-d H:i',$row['date'])?></td>
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
                    <?php if (!empty($pagination)):?><div id="pager"><?php echo $pagination?> | 共 <strong><?php echo $total_rows?></strong> 条数据.</div><?php endif;?>
                </div>
                	
            </div>
			<?php $this->load->view($admin_theme.'/sidebar-block');?>
      </div>
<?php $this->load->view($admin_theme.'/footer-block');?>