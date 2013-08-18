<?php $this->load->view($admin_theme.'/header-block');?>
      <div id="top-panel">
            <div id="panel">
                <ul>
                    <li><a href="<?php echo $site_url?>admin/category/add/" class="add">添加分类</a></li>
                    <li><a href="<?php echo $site_url?>admin/category/" class="invoices">查看分类</a></li>
                </ul>
            </div>
      </div>
      <div id="wrapper">
            <div id="content">
              
                <div id="box">
                	<h3 id="adduser"><?php echo empty($article)?'添加':'编辑' ?> 分类</h3>
                    <form id="form" action="<?php echo $site_url?>admin/category/<?php echo empty($cat)?'add':'edit/'.$cat['cid'] ?>/" method="post">
                    	<fieldset id="Category">
                    		<label for="name">分类名称:</label> 
                    		<input name="name" id="name" type="text" value="<?php if(!empty($cat)) echo $cat['name']?>" />
                    		<br />
                    		<label for="cat_url">分类地址:</label> 
                    		<input name="cat_url" id="cat_url" type="text" value="<?php if(!empty($cat)) echo $cat['cat_url']?>" />
                    		<br />
                    		<label for="pid">父分类:</label> 
                    		<select id="pid" name="pid">
                    			<option <?php if (!empty($cat)&&$cat['pid']==0) echo 'selected="selected"'?>value="0">--TOP--</option>
                    		<?php foreach ($cat_tree as $row):?>
                    			<option <?php if (!empty($cat)&&$cat['pid']==$row['cid']) echo 'selected="selected"'?>value="<?php echo $row['cid']?>"><?php echo str_repeat('&nbsp;', $row['level']*3).$row['name']?></option>
            				<?php endforeach;?>
            				</select>
                    		<br />
                    	</fieldset>
                      <div align="center">
                      <?php if(!empty($cat)):?>
                      <input type="hidden" name="cid" value="<?php echo $cat['cid']?>" />
                      <?php else:?>
                      <input type="hidden" name="sort_order" value="50" />
                      <?php endif;?>
                      <input id="button1" type="submit" value="提交" /> 
                      <input id="button2" type="reset" value="重置" />
                      </div>
                    </form>

                </div>

                	
            </div>
			<?php $this->load->view($admin_theme.'/sidebar-block');?>
      </div>
<?php $this->load->view($admin_theme.'/footer-block');?>