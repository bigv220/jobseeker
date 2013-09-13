<?php $this->load->view($front_theme.'/header-block');?>
<link href="<?php echo $theme_path?>style/jquery.autocomplete.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<?php echo $theme_path?>js/jslib/ajaxupload.js"></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/jslib/jquery.autocomplete.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("input.date").jSelectDate({
            css:"date",
            yearBeign: 1995,
            disabled : false
        });

        uploadImage();

        $("#keyword").autocomplete("<?PHP echo $site_url; ?>/jobseeker/autocomplete",{
            delay:10,
            matchSubset:1,
            matchContains:1,
            cacheLength:10,
            onItemSelect:selectItem,
            formatItem: formatItem,
            formatResult: formatResult
        });
    });

    function formatItem(row){
        return " <p>"+row +" </p>";
    }

    function formatResult(row){
        return row[0].replace(/(<.+?>)/gi, '');
    }

    function selectItem(li){
        makeSearchUrl(document.searchform);
    }

    function uploadImage(old_avatar) {
        var oBtn = document.getElementById("image_profile");
        var upload_button = document.getElementById("upload_button");
        var oRemind = document.getElementById("errorRemind");
        new AjaxUpload(oBtn,{
            action:"<?php echo $site_url?>/../jobseeker/ajaxuploadimage",
            name:"avatar",
            data: {},
            onSubmit:function(file,ext){
                if(ext && /^(jpg|jpeg|png|gif)$/.test(ext)){
                    oRemind.style.color = "orange";
                    oRemind.innerHTML = "uploading...";
                    oBtn.disabled = "disabled";
                }else{
                    oRemind.style.color = "red";
                    oRemind.innerHTML = "Sorry, Do not support this image type.";
                    return false;
                }
            },
            onComplete:function(file,response){
                oBtn.disabled = "";
                if ( response == 'success') {
                    oRemind.style.color = "green";
                    oRemind.innerHTML = "Upload successful.";

                    var reg = /\s/g;
                    file = file.replace(reg, "");

                    var img_path = "<?php echo $theme_path; ?>" + "users/" + file;
                    $('#avatar').val(file);
                    upload_button.innerHTML = "<img id='image_profile' src='" + img_path + "?" +  Math.floor(Math.random()*99999 + 1) + "' height='100' style='border:1px solid gray;' />";
                } else {
                    oRemind.style.color = "red";
                    oRemind.innerHTML = response;
                }

            }
        });
    }

    function contactDetailsSubmit() {
        var uid = $('#uid').val();
        $('#contactDetailsForm').submit();
    }
</script>

    <!--top search area-->
    <div class="top-search w70 rel">
        <input type="text" class="abs top-search-input input-tip" value="Search our job database" data-tipval="Search our job database"/>
        <input type="submit" class="abs top-search-btn " value=""  title="search"   />
        <a href="#" class="abs top-search-a">More Options</a>
    </div>

<!--Jobseeker registration page body-->
<div class="reg-page w770 clearfix rel">
    <div class="reg-left abs box mb20">
        <h2 class="reg-left-tit">NiHAO REDSTAR</h2>
        <ul class="reg-ul">
            <li class="curr"><a href="#reg1">Basic Information</a></li>
            <li><a href="#reg2">Contact Details</a></li>
            <li><a href="#reg3">Preferences</a></li>
            <li><a href="#reg4">Education</a></li>
            <li><a href="#reg5">Work History</a></li>
            <li><a href="#reg6">Languages</a></li>
            <li><a href="#reg7">Personal Skills</a></li>
            <li><a href="#reg8">Profesional Skills</a></li>
        </ul>
    </div>
    <div class="reg-right-wrap">
        <div class="reg-right box mb20">
            <p class="reg-right-text">
                Please fill out the mandatory fields to apply for jobs, to streamline your job search and highlight your profile to employers fill out all optional fields. <br/>
                <a href="#">Or start searching for jobs now </a></p>

            <div class="reg-area">
            <form action="<?php echo $site_url; ?>/jobseeker/userinfo" method="post" id="basicInfoForm">
                <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
                <div class="reg-area-tit">Basic Information</div>
                <div class="reg-row"> <strong>First Name <i class="star">*</i></strong>
                    <div>
                        <input type="text" name="first_name" class="reg-input" value="<?php echo $userinfo['first_name']; ?>" />
                    </div>
                </div>
                <div class="reg-row clearfix"> <strong>Last Name <i class="star">*</i></strong>
                    <div>
                        <input type="text" name="last_name" class="reg-input" value="<?php echo $userinfo['last_name']; ?>" />
                    </div>
                </div>
                <div class="reg-row clearfix"> <strong>Location <i class="star">*</i></strong>
                    <div>
                        <select class="kyo-select" name="country">
                            <option value="1">All Counties</option>
                            <option value="2">China</option>
                            <option value="3">USA</option>
                        </select>
                        <select class="kyo-select" name="city">
                            <option value="1">All City</option>
                            <option value="2">Beijing</option>
                            <option value="3">Shanghai</option>
                        </select>
                    </div>
                </div>
                <div class="reg-row clearfix"> <b>Profile Picture</b>
                    <div>
                        <input type="hidden" name="avatar" id="avatar" />
                        <div id="upload_button">
                            <img id="image_profile" src="<?php echo $theme_path?>style/reg/com-img.gif" class="reg-company-img" />
                        </div>
                        <span class="" id="errorRemind"></span>
                    </div>
                </div>
                <div class="reg-row clearfix"> <strong>Birthday<i class="star">*</i></strong>
                    <div>
                        <input type="text" name="birthday" id="txtName" class="date" value="<?php echo $userinfo['birthday']; ?>" />
                    </div>
                </div>
                <div class="reg-row clearfix">
                    <span style="padding-right:10px;">Keep this private</span>
                    <input type="checkbox" name="is_private" id="is_private" value="1" />
                </div>
                <div class="reg-area-bar">
                    <input type="hidden" name="register_step" value="1" />
                    <input type="submit" class="reg-save" value=""  data-index="1"/>
                </div>
            </form>
            </div>

            <div class="reg-area">
            <form action="<?php echo $site_url; ?>/jobseeker/userinfo" method="post" id="contactDetailsForm">
                <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
                <div class="reg-area-tit">Contact Details</div>
                <div class="reg-row"> <strong>Emial Address<i class="star">*</i></strong>
                    <div>
                        <input type="text" name="email" class="reg-input" value="<?php echo $userinfo['email']; ?>" />
                    </div>
                </div>
                <div class="reg-row"> <strong>Phone Number<i class="star">*</i> <span>(including area code)</span></strong>
                    <div>
                        <input type="text" name="phone" class="reg-input" value="<?php echo $userinfo['phone']; ?>" />
                    </div>
                </div>
                <div class="reg-row">Allow employers to contatct you by phone
                        Yes<input type="radio" name="is_allow_phone" value="1" checked="checked" />
                        No<input type="radio" name="is_allow_phone" value="0" />
                </div>
                <div class="reg-row"> <strong>Username for Jing Chat<i class="star">*</i></strong>
                    <div>
                        <input type="text" name="jingchat_username" class="reg-input" value="<?php echo $userinfo['jingchat_username']; ?>" />
                    </div>
                </div>
                <div class="reg-row">Allow employers to contact you through online messager
                        Yes<input type="radio" name="is_allow_online_msg" value="1" checked="checked" />
                        No<input type="radio" name="is_allow_online_msg" value="0" />
                </div>
                <div class="reg-row"> <b>Personal website</b>
                    <div>
                        <input type="text" name="website" class="reg-input" value="<?php echo $userinfo['personal_website']; ?>" />
                    </div>
                </div>
                <div class="reg-row"> <b>twitter Username</b>
                    <div>
                        <input type="text" name="twitter" class="reg-input" value="<?php echo $userinfo['twitter']; ?>" />
                    </div>
                </div>
               <div class="reg-row"> <b>linkedin Username</b>
                    <div>
                        <input type="text" name="linkedin" class="reg-input" value="<?php echo $userinfo['linkedin']; ?>" />
                    </div>
                </div>
                <div class="reg-row"> <b>wechat</b>
                    <div>
                        <input type="text" name="wechat" class="reg-input" value="<?php echo $userinfo['wechat']; ?>" />
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
                    <input type="hidden" name="register_step" value="2" />
                    <input type="submit" class="reg-save" value=""  data-index="1"/>
                </div>
            </form>
            </div>

            <!-- Preferences -->
            <div class="reg-area">
                <div class="reg-area-tit">Preferences</div>
                <form action="<?php echo $site_url; ?>/jobseeker/userinfo" method="post" id="preferencesForm">
                    <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
                    <div class="reg-row"><strong>Prefered length of employment?<i class="star">*</i></strong>
                        <div>
                            Long term employment(1+years)<input type="radio" name='employment_length' value="1" checked="checked" /><br />
                            Short term employment(-1 years)<input type="radio" name='employment_length' value="2" /><br />
                            No preferences<input type="radio" name='employment_length' value="3" />
                        </div>
                    </div>
                    <div class="reg-row"><strong>Prefered type of employment?<i class="star">*</i></strong>
                        <div>
                            Contract<input type="radio" name="employment_type" value="1" /><br />
                            Part Time<input type="radio" name="employment_type" value="2" /><br />
                            Full Time<input type="radio" name="employment_type" value="3" /><br />
                            Internship<input type="radio" name="employment_type" value="4" /><br />
                            Any<input type="radio" name="employment_type" value="5" />
                        </div>
                    </div>
                    <div class="reg-row"><strong>Do you require Visa assistance from employers?<i class="star">*</i></strong>
                            Yes<input type="radio" name="is_visa_assistance" value="1" checked="checked" />
                            No<input type="radio" name="is_visa_assistance" value="0" />
                    </div>
                    <div class="reg-row"><strong>Do you require accomodation assistance from employer?<i class="star">*</i></strong>
                            Yes<input type="radio" name="is_accomodation_assistance" value="1" checked="checked" />
                            No<input type="radio" name="is_accomodation_assistance" value="0" />
                    </div>
                    <div class="reg-row"><strong>What industry are you seeking employment in?<i class="star">*</i></strong>
                        <div>
                            <select name="industry[]" class="kyo-select">
                                <option value="0">Industry</option>
                                <option value="1">Doctor</option>
                                <option value="2">Teacher</option>
                            </select>
                            <select name="position[]" class="kyo-select">
                                <option value="0">Position</option>
                                <option value="1">professor</option>
                                <option value="2">boss</option>
                            </select>
                        </div>
                        <a class="reg-row-tip" href="#">+ Add Another Industry</a>
                    </div>
                    <div class="reg-row"><b>What is your availability?</b>
                        <div>
                            Weekdays<input type="radio" name="availability" value="1" /><br />
                            Evenings<input type="radio" name="availability" value="2" /><br />
                            Weekends<input type="radio" name="availability" value="3" /><br />
                            Any<input type="radio" name="availability" value="4" /><br />
                        </div>
                    </div>
                    <div class="reg-area-bar">
                        <input type="hidden" name="register_step" value="3" />
                        <input type="submit" class="reg-save" value=""  data-index="1"/>
                    </div>
                </form>
            </div>

            <!-- Education -->
            <div class="reg-area">
                <div class="reg-area-tit">Educations</div>
                <form action="<?php echo $site_url; ?>/jobseeker/userinfo" method="post" id="educationForm">
                    <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
                    <div class="reg-row"> <strong>School/Collage name<i class="star">*</i></strong>
                        <div>
                            <input type="text" class="reg-input" name="school_name" />
                        </div>
                    </div>
                    <div class="reg-row"> <strong>Dates Attended<i class="star">*</i></strong>
                        <div class="clearfix">
                            <select class="kyo-select" name="attended_from">
                                <option value="0">Year</option>
                                <option value="1970">1970</option>
                                <option value="1971">1971</option>
                                <option value="1972">1972</option>
                                <option value="1973">1973</option>
                                <option value="1974">1974</option>
                            </select>
                            <input type="text" class="reg-input input-tip" value="year" data-tipval="year" style="width:80px">
                        </div>
                        <p class="p5">To</p>
                        <div class="clearfix">
                            <select class="kyo-select" name="attended_to">
                                <option value="0">Year</option>
                                <option value="1970">1970</option>
                                <option value="1971">1971</option>
                                <option value="1972">1972</option>
                                <option value="1973">1973</option>
                                <option value="1974">1974</option>
                            </select>
                            <input type="text" class="reg-input input-tip" value="year" data-tipval="year" style="width:80px">
                        </div>

                        <br />or expected graduation year
                    </div>
                    <div class="reg-row"> <b>Degree title</b>
                        <div>
                            <input type="text" class="reg-input" name="degree" />
                        </div>
                    </div>
                    <div class="reg-row"> <b>Major</b>
                        <div>
                            <input type="text" class="reg-input" name="major" />
                        </div>
                    </div>
                    <div class="reg-row"> <b>Achievements</b>
                        <div>
                            <textarea class="reg-textarea" name="achievements"></textarea>
                        </div>
                        <a class="reg-row-tip" href="#">+ Add Another Industry</a>
                    </div>
                    <div class="reg-area-bar">
                        <input type="hidden" name="register_step" value="4" />
                        <input type="submit" class="reg-save" value=""  data-index="0"/>
                    </div>
                </form>
            </div>

            <!-- work history -->
            <div class="reg-area">
                <div class="reg-area-tit">Work History</div>
                <form action="<?php echo $site_url; ?>/jobseeker/userinfo" method="post" id="workhistoryForm">
                    <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
                    <div class="reg-row"> <b>Introduce yourself</b>
                        <div>
                            <textarea class="reg-textarea" name="introduce"></textarea>
                        </div>
                    </div>
                    <div class="reg-row"> <strong>Company name<i class="star">*</i></strong>
                        <div>
                            <input type="text" class="reg-input" name="company_name" />
                        </div>
                    </div>
                    <div class="reg-row"> <strong>Time period<i class="star">*</i></strong>
                        <div class="clearfix">
                            <select name="period_time_from" class="kyo-select">
                                <option value="2000">2000</option>
                                <option value="2001">2001</option>
                                <option value="2002">2002</option>
                            </select>
                            <input type="text" class="reg-input input-tip" value="year" data-tipval="year" style="width:80px">
                        </div>
                        <p class="p5">To</p>
                        <div class="clearfix">
                            <select name="period_time_to" class="kyo-select">
                                <option value="2003">2003</option>
                                <option value="2004">2004</option>
                                <option value="2005">2005</option>
                            </select>
                            <input type="text" class="reg-input input-tip" value="year" data-tipval="year" style="width:80px">
                            I still work here<input type="checkbox" name="still_here" />
                        </div>
                    </div>
                    <div class="reg-row clearfix"> <strong>Industry<i class="star">*</i></strong>
                        <div class="clearfix">
                            <select class="kyo-select" name="industry[]">
                                <option value="0">select</option>
                                <option value="v1">v1</option>
                                <option value="v2">v2</option>
                            </select>
                        </div>
                        <div>

                    </div>
                    <div class="reg-row clearfix"> <strong>Position<i class="star">*</i></strong>
                        <div>
                            <input type="text" class="reg-input" name="position" />
                        </div>
                    </div>

                    <div class="reg-row clearfix"> <strong>Description</strong>
                        <div>
                            <textarea class="reg-textarea input-tip" name="description" data-tipval="350 Characters">350 Characters</textarea>
                        </div>
                    </div>
                    <div class="reg-row">
                        <p><a class="reg-row-tip" href="#">Upload examples of work</a></p>
                        <p><a class="reg-row-tip" href="#">+ Add Another Job</a></p>
                    </div>
                    <div class="reg-area-bar">
                        <input type="hidden" name="register_step" value="5" />
                        <input type="submit" class="reg-save" value=""  data-index="0"/>
                    </div>
                </form>
            </div>

            <!-- languages -->
            <div class="reg-area">
                <div class="reg-area-tit">Languages</div>
                <form action="<?php echo $site_url; ?>/jobseeker/userinfo" method="post" id="languageForm">
                    <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
                    <div class="reg-row"> <strong>Language<i class="star">*</i></strong>
                        <div>
                            <select name="language" class="kyo-select">
                                <option value="cn">China</option>
                                <option value="en">English</option>
                            </select>
                        </div>
                    </div>
                    <div class="reg-row clearfix" style="clear:both;"> <strong>Proficiency</strong>
                        <div>
                            <select name="level" class="kyo-select">
                                <option value="1">Level-1</option>
                                <option value="2">Level-2</option>
                            </select>
                        </div>
                    </div>
                    <div class="reg-row">
                        <p><a class="reg-row-tip" href="#">+ Add another language</a></p>
                    </div>
                    <div class="reg-area-bar">
                        <input type="hidden" name="register_step" value="6" />
                        <input type="submit" class="reg-save" value=""  data-index="0"/>
                    </div>
                </form>
            </div>

            <!-- personal skills -->
            <div class="reg-area">
                <div class="reg-area-tit">Personal Skills</div>
                <form action="<?php echo $site_url; ?>/jobseeker/userinfo" method="post" id="personalSkillsForm">
                    <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
                    <div class="reg-skills-text">
                        <b>Start typing to choose up to 5 personal skills that best suit you</b><span>
                        If you can't find a personal skill from our database just hit the return button to add it</span>
                    </div>
                    <div class="skills-vals clearfix">
                        <ul>
                            <li data-val="2">Customer Service<i class="del"></i></li>
                            <li data-val="3">Resourcefulness<i class="del"></i></li>
                            <li data-val="5">Time Management<i class="del"></i></li>
                        </ul>
                    </div>
                    <div class="reg-row">
                        <div>
                            <input type="text" name="keyword" size="24" maxlength="255" autocomplete="on" value="" id="keyword" class="text skills-input">
                        </div>
                    </div>
                    <div class="reg-area-bar">
                        <input type="hidden" name="register_step" value="7" />
                        <input type="submit" class="reg-save" value=""  data-index="0"/>
                    </div>
                </form>
            </div>

            <!-- professional skills -->
            <div class="reg-area"> <a id="reg2" name="reg2"></a>
                <div class="reg-area-tit">Professional Skills</div>
                <form action="<?php echo $site_url; ?>/jobseeker/userinfo" method="post" id="professionalSkillsForm">
                    <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
                    <div class="reg-skills-text">
                        <b>Start typing to choose up to 5 professional skills that best suit you</b><span>
                        If you can't find a personal skill from our database just hit the return button to add it</span>
                    </div>
                    <div class="skills-vals clearfix">
                        <ul>
                            <li data-val="2">Customer Service<i class="del"></i></li>
                            <li data-val="3">Resourcefulness<i class="del"></i></li>
                            <li data-val="5">Time Management<i class="del"></i></li>
                        </ul>
                    </div>
                    <div class="reg-row">
                        <div>
                            <input type="text" name="keyword" size="24" maxlength="255" autocomplete="on" value="" id="keyword" class="text skills-input">
                        </div>
                    </div>
                    <div class="reg-area-bar">
                        <input type="hidden" name="register_step" value="8" />
                        <input type="submit" class="reg-save" value=""  data-index="0"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
        <div class="reg-btns">
            <a href="#"  class="reg-btns-saveall png"></a>
            <a href="#" class="reg-btns-job png"></a>
        </div>
        <div class="backtop png" style="display: block; top: 564px; right:-80px"></div>
     </div>

</div>
<script type="text/javascript" src="<?php echo $theme_path?>js/reg.js"></script>
<?php $this->load->view($front_theme.'/footer-block');?>