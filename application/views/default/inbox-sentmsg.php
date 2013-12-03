<?php $this->load->view($front_theme.'/header-block');?>
                    <form action="" method="post">
                      <div class="inbox_detail_header">
                          <p><label>Title:</label><span><input type="text" name="title" /></span></p>
                          <p><label>User2:</label><span><input type="text" name="user2" /></span></p>
                      </div>
                      <div class="inbox_detail_content">
                          <p>
                              Message:
                              <textarea name="message"></textarea>
                          </p>
                          <input type="submit" value="Sent"/>
                      </div>
                    </form>
<!-- Partners -->
<?php $this->load->view($front_theme.'/partners-block');?>
<script type="text/javascript" src="<?php echo $theme_path?>js/search-result.js"></script>
<?php $this->load->view($front_theme.'/footer-block');?>