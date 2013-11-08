<?php $this->load->view($admin_theme.'/header-block');?>
      <!-- <div id="top-panel">
            <div id="panel">
                <ul>
                </ul>
            </div>
      </div> -->
      <div id="wrapper">
            <div id="content">
              
                <div id="box">
                	<h3 id="adduser">Setting</h3>
                    <form id="form" action="" method="post">
                    	<fieldset id="Category">
                    	<?php foreach ($setting as $row):?>
                    		<label for="<?php echo $row['key']?>"><?php echo $row['descrip']?>:</label> 
                    		<!-- <input name="<?php echo $row['key']?>" id="<?php echo $row['key']?>" type="text" value="<?php echo $row['value']?>" /> -->
                    		<textarea name="<?php echo $row['key']?>" id="<?php echo $row['key']?>" rows="" cols="" style="height:30px;"><?php echo $row['value']?></textarea>
                    		<br />
                    	<?php endforeach;?>
                    	</fieldset>
                      <div align="center">
                      <input id="button1" type="submit" value="Submit" /> 
                      <input id="button2" type="reset" value="Reset" />
                      </div>
                    </form>

                </div>

                	
            </div>
			<?php $this->load->view($admin_theme.'/sidebar-block');?>
      </div>
<?php $this->load->view($admin_theme.'/footer-block');?>