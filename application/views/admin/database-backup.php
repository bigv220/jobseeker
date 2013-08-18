<?php $this->load->view($admin_theme.'/header-block');?>
      <div id="top-panel">
            <div id="panel">
                <ul>
                    <li><a href="<?php echo $site_url?>admin/database/backup/" class="add">数据库备份</a></li>
                    <li><a href="<?php echo $site_url?>admin/database/restore/" class="invoices">数据库恢复</a></li>
                    <li><a href="<?php echo $site_url?>admin/database/optimize/" class="invoices">数据表优化</a></li>
                    <li><a href="<?php echo $site_url?>admin/database/sql/" class="invoices">SQL查询</a></li>
                </ul>
            </div>
      </div>
      <div id="wrapper">
            <div id="content">
              
                <div id="box">
                	<h3 id="adduser">数据库备份</h3>
                    <form id="form" action="<?php echo $site_url?>admin/database/backup/" method="post">

                      <div align="center">
                      <input type="hidden" name="action" value="backup" />
					  <input id="button1" type="submit" value="备份" /> 
                      </div>
                    </form>

                </div>

                	
            </div>
			<?php $this->load->view($admin_theme.'/sidebar-block');?>
      </div>
<?php $this->load->view($admin_theme.'/footer-block');?>