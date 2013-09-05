<?php $this->load->view($front_theme.'/header-block');?>
<form action="" method="post" id="companyForm">
<!--top search area-->
<div class="top-search w70 rel">
    <input type="text" class="abs top-search-input input-tip" value="Search our job database" data-tipval="Search our job database"/>
    <input type="submit" class="abs top-search-btn " value=""  title="search"   />
    <a href="#" class="abs top-search-a">More Options</a> </div>

<!--company page body-->
<div class="reg-page w770 clearfix rel">
    <div class="reg-left abs box mb20">
        <h2 class="reg-left-tit">NiHAO REDSTAR</h2>
        <ul class="reg-ul">
            <li class="curr"><a href="#reg1">Basic Information</a></li>
            <li><a href="#reg2">Contact Details</a></li>
        </ul>
    </div>
    <div class="reg-right-wrap">
        <div class="reg-right box mb20"> <a id="reg1" name="reg1"></a>
            <p class="reg-right-text">Please fill out the mandatory fields to enhance your JingJobs experience,and promote your company to jobseekers.</p>
            <div class="reg-area">
                <div class="reg-area-tit">Basic Information</div>
                <div class="reg-row"> <strong>Full Company Name <i class="star">*</i></strong>
                    <div>
                        <input type="" class="reg-input" />
                    </div>
                </div>
                <div class="reg-row clearfix"> <strong>Location <i class="star">*</i></strong>
                    <div>
                        <select class="kyo-select">
                            <option value="0">All Counties</option>
                            <option value="30">China</option>
                            <option value="30">USA</option>
                        </select>
                        <select class="kyo-select">
                            <option value="0">All City</option>
                            <option value="30">Beijing</option>
                            <option value="30">Shanghai</option>
                        </select>
                    </div>
                </div>
                <div class="reg-row clearfix"> <b>Company Logo</b>
                    <div> <img src="<?php echo $theme_path?>style/reg/com-img.gif" class="reg-company-img" /> </div>
                </div>
                <div class="reg-row clearfix"> <strong>Industry <i class="star">*</i></strong>
                    <div>
                        <input type="text" id="reg-industry" value="">
                        <div class="reg-row-tip">+ Add Another Industry</div>
                        <div id="reg-rndustry-val" class="show-selval"></div>
                    </div>
                </div>
                <div class="reg-row clearfix"> <strong>Company Description <i class="star">*</i></strong>
                    <div>
                        <textarea class="reg-textarea"></textarea>
                    </div>
                </div>
                <div class="reg-area-bar">
                    <input type="submit" class="reg-save" value=""  data-index="0"/>
                </div>
            </div>
            <div class="reg-area"> <a id="reg2" name="reg2"></a>
                <div class="reg-area-tit">Contact Details</div>
                <div class="reg-row"> <strong>Contact Name <i class="star">*</i></strong>
                    <div>
                        <input type="" class="reg-input" />
                    </div>
                </div>
                <div class="reg-row"> <strong>Email Address <i class="star">*</i></strong>
                    <div>
                        <input type="" class="reg-input" />
                    </div>
                </div>
                <div class="reg-row"> <strong>Phone Number <i class="star">*</i> <span>(including area code)</span></strong>
                    <div>
                        <input type="" class="reg-input" />
                    </div>
                    <input id="phoneNumber" value="0" class="kyo-radio" style="display:none;"/>
                    <div><span style="padding-right:10px;">Allow jobseekers to see your phone number</span> <i class="kyo-radio" data-id="phoneNumber" data-val="0">Yes</i> <i class="kyo-radio" data-id="phoneNumber" data-val="1">No</i></div>
                </div>
                <div class="reg-row"> <strong>Username for Jing Chat <i class="star">*</i></strong>
                    <div>
                        <input type="" class="reg-input" />
                    </div>
                    <input id="Username" value="0" class="kyo-radio" style="display:none;"/>
                    <div><span style="padding-right:10px;">Allow jobseekers to see your phone number</span> <i class="kyo-radio" data-id="Username" data-val="0">Yes</i> <i class="kyo-radio" data-id="Username" data-val="1">No</i></div>
                </div>
                <div class="reg-row"> <b>Company Website</b>
                    <div>
                        <input type="" class="reg-input" />
                    </div>
                </div>
                <div class="reg-row"> <b>Twitter Username</b>
                    <div>
                        <input type="" class="reg-input" />
                    </div>
                </div>
                <div class="reg-row"> <b>Linkedin Username</b>
                    <div>
                        <input type="" class="reg-input" />
                    </div>
                </div>
                <div class="reg-row"> <b>WeChat ID</b>
                    <div>
                        <input type="" class="reg-input" />
                    </div>
                </div>
                <div class="reg-row"> <b>Other Social Network</b>
                    <div>
                        <input type="text" id="reg-Network" value="">
                        <div class="reg-row-tip">+ Add Another Soical Network</div>
                        <div id="reg-network-val" class="show-selval"></div>
                    </div>
                </div>
                <div class="reg-area-bar">
                    <input type="submit" class="reg-save" value=""  data-index="1"/>
                </div>
            </div>
        </div>
        <div class="reg-btns"> <a href="#"  class="reg-btns-save"></a><a href="#" class="reg-btns-post"></a><a href="#" class="reg-btns-find"></a> </div>
    </div>
</div>
</form>
    <script type="text/javascript" src="<?php echo $theme_path?>js/reg.js"></script>
<?php $this->load->view($front_theme.'/footer-block');?>