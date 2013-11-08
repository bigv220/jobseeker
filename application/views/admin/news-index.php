<?php $this->load->view($admin_theme.'/header-block');?>
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
                	<h3>News list</h3>
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
                            	<th width="80px">Category</th>
                            	<th>Title</th>
                                <th width="120px">Date</th>
                                <!-- <th width="60px">语言</th> -->
                                <th width="60px">Action</th>
                            </tr>
						</thead>
						<tbody>
						<?php foreach ($article as $row) :?>
							<tr>
                            	<td class="a-center"><?php echo $row['aid']?></td>
                            	<td class="a-center"><a href="<?php echo $site_url.'admin/news/?cid='.$row['cid']?>"><?php echo $row['cat']?></a></td>
                            	<td><a href="<?php echo $site_url.'news/view/'.$row['aid']?>" target="_blank"><?php echo mb_strlen($row['title'])>30 ? mb_substr($row['title'], 0, 26).'...' : $row['title']?></a></td>
                                <td class="a-center"><?php echo date('Y-m-d H:i',$row['date'])?></td>
                                <!-- <td class="a-center"><?php echo langName($row['lang'])?></td> -->
                                <td class="a-center">
                                	<a href="<?php echo $site_url.'admin/news/edit/'.$row['aid']?>"><img src="<?php echo $theme_path?>img/icons/page_white_edit.png" title="Edit" width="16" height="16" /></a> &nbsp; 
                                	<a href="<?php echo $site_url.'admin/news/delete/'.$row['aid']?>" onclick="javascript:return confirm('Delete ?');"><img src="<?php echo $theme_path?>img/icons/page_white_delete.png" title="Delete" width="16" height="16" /></a>
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
                    <?php if (!empty($pagination)):?><div id="pager"><?php echo $pagination?> | Total <strong><?php echo $total_rows?></strong> </div><?php endif;?>
                </div>
                	
            </div>
			<?php $this->load->view($admin_theme.'/sidebar-block');?>
      </div>
<?php $this->load->view($admin_theme.'/footer-block');?>