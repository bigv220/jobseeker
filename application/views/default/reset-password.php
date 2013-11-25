<?php $this->load->view($front_theme.'/header-block');?>

    <!-- find & singup -->
    <div class="p-bn rel">
        <div class="reset-password-wrapper">
            <form id="reset_password_form" method="post" action="/user/resetPasswordAction">
                <input type="hidden" name="uid" value="<?php echo $juid; ?>"/>
                <input type="hidden" name="token" value="<?php echo $token;?>"/>
                <p class="input-wrap"><input type="password" id="reset_password" name="password" value="" class="input input-user" /></p>
                <p class="input-wrap"><input type="password" id="reset_password_confirm" name="confirm_password" value="" class="input input-pass" /></p>
                <p class="tac" ><input type="submit" value="" class="btn" /></p>
            </form>
        </div>

        <div class="reset-password-success">
            <div class="reset-password-success-header">Yippee!</div>
            <div class="reset-password-success-content">Your password has been reset. Please login now to GetJinged!</div>
            <div class="reset-password-success-btn"></div>
        </div>
    </div>


<?php $this->load->view($front_theme.'/footer-block');?>