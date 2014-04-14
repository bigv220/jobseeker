<?php $this->load->view($front_theme.'/header-block');?>
<div class="page clearfix rel box mb30 p20">
    <h1 class="title">Page Not Found</h1>
    <div class="content pagenotfound">
       
        <?php if($error_message): ?>
        
            <?php echo $error_message; ?>
        
        <?php else: ?>
        
        The requested page is not available. Please try again or contact to our help desk.
    
        <?php endif; ?>
    </div>
    
</div>						
<?php $this->load->view($front_theme.'/footer-block');?>