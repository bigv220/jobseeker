<?php $this->load->view($admin_theme.'/header-block');?>
      <div id="top-panel">
            <div id="panel">
                <ul>
                    <li><a href="<?php echo $site_url?>admin/category/add/" class="add">Add</a></li>
                    <!-- <li><a href="<?php echo $site_url?>admin/category/" class="invoices">查看分类</a></li> -->
               </ul>
            </div>
      </div>
      <div id="wrapper">
            <div id="content">
                
                <div id="box">
                	<h3>Category list</h3>
                	<form id="form_cat" action="<?php echo $site_url?>admin/category/order/" method="post">
                	<table width="100%">
						<thead>
							<tr>
								<th width="40px"><a href="#">Order</a></th>
                            	<th width="40px">ID</th>
                            	<th>Name</th>
                            	<th>URL</th>
                                <!--<th>描述</th>-->
                                <th width="60px">Action</th>
                            </tr>
						</thead>
						<tbody>
						<?php foreach ($cat as $row) :?>
							<tr>
                            	<td class="a-center"><input type="text" style="width:20px;border:0px;" name="<?php echo $row['cid']?>" value="<?php echo $row['sort_order']?>" /></td>
                            	<td class="a-center"><?php echo $row['cid']?></td>
                            	<td style="padding-left:<?php echo $row['level']*20+20?>px;"><img src="<?php echo $theme_path?>img/icons/menu_minus.gif" /><?php echo $row['name']?></td>
                                <td class="a-center"><?php echo $row['cat_url']?></td>
                                <!--<td><?php //echo $row['descrip']?></td>-->
                                <td class="a-center">
                                	<a href="<?php echo $site_url.'admin/category/edit/'.$row['cid']?>"><img src="<?php echo $theme_path?>img/icons/page_white_edit.png" title="Edit" width="16" height="16" /></a> &nbsp; 
                                	<a href="<?php echo $site_url.'admin/category/delete/'.$row['cid']?>" onclick="javascript:return confirm('Delete ?');"><img src="<?php echo $theme_path?>img/icons/page_white_delete.png" title="Delete" width="16" height="16" /></a>
                                </td>
                            </tr>
                        <?php endforeach;?>
						</tbody>
					</table>
                    <div><button type="submit" style="padding:2px 5px;margin-left:4px;">Sort</button></div>
                    </form>
                </div>
                	
            </div>
			<?php $this->load->view($admin_theme.'/sidebar-block');?>
      </div>
<?php $this->load->view($admin_theme.'/footer-block');?>