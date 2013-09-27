<?php $this->load->view($front_theme.'/header-block');?>

    <!-- find & singup -->
    <div class="p-bn rel">
        <div class="reset-password-wrapper">
            <form id="reset_password_form" method="post" action="/user/login">
                <p class="input-wrap"><input type="password" id="username" name="username" value="" class="input input-user" /></p>
                <p class="input-wrap"><input type="password" id="login_password" name="login_password" value="" class="input input-pass" /></p>
                <p class="tac" ><input type="submit" value="" class="btn" /></p>
            </form>
        </div>
    </div>


<?php $this->load->view($front_theme.'/footer-block');?>