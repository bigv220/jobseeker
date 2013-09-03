<?php $this->load->view($front_theme.'/header-block');?>
<form action="" method="post" id="companyForm">
<div class="p-bn rel">
<p>

		<div class="pop-reg-personal">

            <label class="fl">
                <b>COMPANY FULL NAME</b>
                <input type="text" name="name" class="kyo-input"/><br/>
            </label>
           
        </div>
        <div class="pop-reg-company" >
            <label>
                <b>Country</b>
                <input type="text" name="country" value="China" class="kyo-input"><br/>
            </label>
        </div>
        <div class="pop-reg-mail">
            <label>
                <b>City</b>
                <input type="text" name="city" value="Qingdao" class="kyo-input">
            </label>
        </div>
        <div class="pop-reg-company" >
            <label>
                <b>Industry</b>
                <select name="industry" id="industry">
                	<option value="">All industry</option>
                	<option>Accounting</option>
                	<option>HR</option>
                	<option>Finance</option>
                	<option>Design</option>
                	<option>Education</option>
                </select>
            </label>
        </div>
        <input type="hidden" name="industry_tag" id="industry_tag" value="" />
        <ul id="industry_box" data-name="nameOfSelect"></ul>

        <div class="pop-reg-password">
            <label>
                <b>Company Description</b>
                <input type="text" name="description" class="kyo-input" />
            </label>
        </div>
        <div class="pop-reg-password">
            <label>
                <b>Contact Name</b>
                <input type="text" name="contact_name" class="kyo-input" />
            </label>
        </div>
        <div class="pop-reg-password">
            <label>
                <b>Email</b>
                <input type="text" name="email" class="kyo-input" />
            </label>
        </div>
        

</div>
<div class="p-bn rel">
	<p>
		<div class="pop-reg-password">
            <label>
                <b>Phone</b>
                <input type="text" name="phone" class="kyo-input" />
            </label>
        </div>
        IS PHONE PUBLIC<input type="radio" name="is_phone_public">
        <div class="pop-reg-password">
            <label>
                <b>jingchat</b>
                <input type="text" name="jingchat" class="kyo-input" />
            </label>
        </div>
        IS ALLOW CONTACT BY JINGCHAT:<input type="radio" name="is_allow_jingchat_contact">
        <div class="pop-reg-password">
            <label>
                <b>website</b>
                <input type="text" name="website" class="kyo-input" />
            </label>
        </div>
         <div class="pop-reg-password">
            <label>
                <b>twitter</b>
                <input type="text" name="twitter" class="kyo-input" />
            </label>
        </div>
          <div class="pop-reg-password">
            <label>
                <b>linkedin</b>
                <input type="text" name="linkedin" class="kyo-input" />
            </label>
        </div>
        <div class="pop-reg-password">
            <label>
                <b>wechat</b>
                <input type="text" name="wechat" class="kyo-input" />
            </label>
        </div>
        <input type="button" value="Save All" onclick="doCompanySubmit();">
	</p>
</div>
</form>

<?php $this->load->view($front_theme.'/footer-block');?>