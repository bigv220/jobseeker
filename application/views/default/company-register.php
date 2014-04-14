<?php $this->load->view($front_theme.'/header-block');?>

<!--Deletion Works. -->
<link href="<?php echo $theme_path?>style/delete.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $theme_path?>style/changepass.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $theme_path?>js/deletecompany.js"></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/changepass.js"></script>
<!--Deletion Works. Ends here. -->

<?php 
/**
 * Image Upload & Cropping: 
 * See the documentaion in user/uploadimage
 * 
 * URL http://defunkt.io/facebox/ [Popup Implementation]
 */
?>
<link href="<?php echo $theme_path?>cropimage/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="<?php echo $theme_path?>cropimage/facebox.js" type="text/javascript"></script>

<!--company page body-->
<div class="reg-page w770 clearfix rel">
    <div class="reg-left abs box mb20">
        <h2 class="reg-left-tit">NiHAO <span title="<?php echo $basic_info['first_name'];?>"><?php echo substr($basic_info['first_name'],0,8);?></span></h2>
        <ul class="reg-ul-top">
        <li><a href="<?php echo $site_url?>job/postjob">Post a Job</a></li>
        <li><a href="<?php echo $site_url?>company/joblisting">Find Staff</a></li>
        </ul>
        <ul class="reg-ul">
            <?php 
            $cla = '';
            if(!empty($basic_info['description'])) {
                $cla = ' class = "curr"';
            }
            ?>
            <li <?php echo $cla; ?> id="step1"><a href="#reg1">Basic Information</a></li>
            <?php 
            $cla = '';
            if(!empty($basic_info['last_name'])) {
                $cla = ' class = "curr"';
            }
            ?>
            <li <?php echo $cla; ?> id="step2"><a href="#reg2">Contact Details</a></li>
        </ul>
    </div>
    <div class="reg-right-wrap">
        <div class="reg-right box mb20"> 
            <p class="reg-right-text">Please fill out the mandatory fields to enhance your JingJobs
                experience and promote your company to jobseekers.</p>
            <form action="" id="basicForm" method="post">
            <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
            <div class="reg-area"> <a id="reg1" name="reg1"></a>
                <div class="reg-area-tit">Basic Information</div>
                <div class="reg-row"> <strong>Full Company Name <i class="star">*</i></strong>
                    <div>
                        <input type="text" class="reg-input" id="name" name="name" title="" value="<?php echo $basic_info['first_name']; ?>" required/>
                    </div>
                </div>
                <style>
                .location select, .location dl.kyo-select-list {width:145px !important;}
                </style>
                <div class="reg-row clearfix location"> <strong>Location <i class="star">*</i></strong>
                    <div>
                        <select name="country" required>
                            <option value="">All Countries</option>
                            <?php foreach ($location as $k=>$v):?>
                                <?php if ($k == $basic_info['country']): ?>
                                <option value="<?php echo $k ?>" selected><?php echo $k ?></option>
                                <?php else: ?>
                                <option value="<?php echo $k ?>"><?php echo $k ?></option>
                                <?php endif; ?>
                            <?php endforeach;?>
                        </select>
                        <select name="province">
                            <option value="">All Province</option>
                            <?php foreach ($location['China'] as $k=>$v):?>
                                <?php if ($k == $basic_info['province']): ?>
                                <option value="<?php echo $k ?>" selected><?php echo $k ?></option>
                                <?php else: ?>
                                <option value="<?php echo $k ?>"><?php echo $k ?></option>
                                <?php endif; ?>
                            <?php endforeach;?>
                        </select>
                        <select name="city">
                            <option value="">All Cities</option>
                            <option value="1">Beijing</option>
                        </select>
                    </div>
                </div>
                <div class="reg-row clearfix"> <b>Company Logo</b>
                    <input type="hidden" name="avatar" id="avatar" value="<?php echo $basic_info['profile_pic']; ?>" />
                    <div id="upload_button">
                        <?php if($basic_info['profile_pic']) {
                                        $pic = $site_url.'attached/users/'.$basic_info['profile_pic'];
                                   } else {
                                        $pic = $theme_path.'style/reg/com-img.gif';
                                   }
                            ?>
                            <img id="image_profile" height='100px' src="<?php echo $pic; ?>" class="reg-company-img" />
                            <p><span>Select jpg, gif or png image with size less than 3MB.</span></p>
                    </div>
                    <span class="" id="errorRemind"></span>
                </div>
                
                
                
                <div class="reg-row clearfix"> <strong>Industry <i class="star">*</i></strong>
                    
                    <select name="industry" id="industry" title="" <?php if (empty($industries)): ?>required<?php endif; ?>>
                    <option value="">All industry</option>
                    <?php foreach($industry_list as $key=>&$v) {
                                    if(empty($v['name'])) continue;
                                    
                    ?>
                    <option value="<?php echo $v['name']; ?>"><?php echo $v['name']; ?></option>
                    <?php } ?>
                </select>
                <input type="hidden" name="industry_tag" id="industry_tag"/>
                 <ul id="industry_box" data-name="nameOfSelect"></ul>
                </div>
                <div class="reg-row clearfix"> <strong>Company Description <i class="star">*</i></strong>
                    <div>
                        <textarea class="reg-textarea" name="description" required><?php echo $basic_info['description']; ?></textarea>
                    </div>
                </div>
                <div class="reg-area-bar">
                    <input type="button" class="reg-save" value=""  data-index="0" id="basic_submit" onclick="basicFormSubmit();"/>
                </div>
            </div>
        </form>
            <div class="reg-area"> <a id="reg2" name="reg2"></a>
                <div class="reg-area-tit">Contact Details</div>
                <form action="" id="contactForm" method="post">
                <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
                <div class="reg-row"> <strong>Contact Name <i class="star">*</i></strong>
                    <div>
                        <input type="text" class="reg-input" name="last_name" value="<?php echo $basic_info['last_name']; ?>" required/>
                    </div>
                </div>
                <div class="reg-row"> <strong>Email Address <i class="star">*</i></strong>
                    <div>
                        <input type="text" class="reg-input" name="email" value="<?php echo $basic_info['email']; ?>" required/>
                    </div>
                </div>
                <div class="reg-row"> <strong>Phone Number <i class="star">*</i> <span>(including area code)</span></strong>
                    <div>
                        <input type="text" class="reg-input" name="phone" value="<?php echo $basic_info['phone']; ?>" required/>
                    </div>
                    <input id="is_allow_phone" name="is_allow_phone" value="<?php echo $basic_info['is_allow_phone']; ?>" class="kyo-radio" style="display:none;"/>
                    <div><span style="padding-right:10px;">Allow jobseekers to see your phone number</span> <i class="kyo-radio" data-id="is_allow_phone" data-val="1">Yes</i> <i class="kyo-radio" data-id="is_allow_phone" data-val="0">No</i></div>
                </div>
                <div class="reg-row"> <strong>Username for Jing Chat <i class="star">*</i></strong>
                    <div>
                        <input type="" class="reg-input" name="jingchat_username" value="<?php echo $basic_info['jingchat_username']; ?>" required/>
                    </div>
                    <input id="is_allow_online_msg" name="is_allow_online_msg" value="<?php echo $basic_info['is_allow_online_msg']; ?>" class="kyo-radio" style="display:none;"/>
                    <div><span style="padding-right:10px;">Allow jobseekers to contact you via Jingchat</span> <i class="kyo-radio" data-id="is_allow_online_msg" data-val="1">Yes</i> <i class="kyo-radio" data-id="is_allow_online_msg" data-val="0">No</i></div>
                </div>
                <div class="reg-row"> <b>Company Website</b>
                    <div>
                        <input type="" class="reg-input" name="personal_website" value="<?php echo $basic_info['personal_website']; ?>"/>
                    </div>
                </div>
                <div class="reg-row"> <b>Twitter</b>
                    <div>
                        <input type="" class="reg-input" name="twitter" value="<?php echo $basic_info['twitter']; ?>"/>
                    </div>
                </div>
                <div class="reg-row"> <b>Linkedin</b>
                    <div>
                        <input type="" class="reg-input" name="linkedin" value="<?php echo $basic_info['linkedin']; ?>"/>
                    </div>
                </div>
                <div class="reg-row"> <b>Weibo</b>
                    <div>
                        <input type="" class="reg-input" name="weibo" value="<?php echo $basic_info['weibo']; ?>"/>
                    </div>
                </div>
                <div class="reg-row"> <b>Facebook</b>
                    <div>
                        <input type="" class="reg-input" name="facebook" value="<?php echo $basic_info['facebook']; ?>"/>
                    </div>
                </div>
                <!-- <div class="reg-row"> <b>Other Social Network</b>
                    <div>
                        <input type="text" id="reg-Network" value="">
                        <div class="reg-row-tip">+ Add Another Soical Network</div>
                        <div id="reg-network-val" class="show-selval"></div>
                    </div>
                </div> -->
                <div class="reg-area-bar">
                    <input type="button" class="reg-save" value="" id="contact_submit" data-index="1" onclick="contactFormSubmit();"/>
                </div>
            </form>
            </div>
        </div>
         <div class="reg-btns">
            <a href="javascript: void(0);" class="reg-btns-saveall png" onclick="saveAll();"></a>
            <p class="right reg-btns-down-page">
            <a href="javascript:void(0);" class="pbn-change-password-btn">Change Password</a>
            <a href="javascript:void(0);" class="pbn-delete-company-btn">Delete Account</a>
            <p>
        </div>
    </div>
</div>


<!-- Delete Company Account - starts here -->
<div class="pop-mark-company-delete"></div>

<!--First Pop Up window for Delete Account. -->
<div class="pop-reg-company-delete png">
    <div class="pop-reg-company-delete-wrap rel">
        <form id="signup_form" method="post" action="">
            <div class="pop-reg-company-delete-close abs" title="close"></div>
            
            <div class="pop-reg-company-delete-tit">
                Deleting your account can be done in 3 easy steps:
            </div>

            
            <div class="pop-reg-company-delete-personal">
                1. Type "DELETE" in all Caps. <br>
                <input type="text" id="delete_text" name="delete_text" class="kyo-input"/>
            </div>
            <div class="pop-reg-company-delete-agree">
               2. Check the box below to confirm that you know this is an irreversible action (there is no way to restore your account after it is deleted). <br>
               
                             
               <br> <input id="confirm_deletion" value="0" class="kyo-checkbox" style="display:none;"/>
                    <i class="kyo-checkbox" data-id="confirm_deletion" data-val="1"></i>

                
            </div>
            <div class="pop-reg-company-delete-mail">
                3. Click button below
            </div>
            
            <div class="pop-reg-company-delete-submit">
                <input type="button" id="pop-reg-company-delete-submit" class="pop-reg-company-delete-submit-btn" />
            </div>
        </form>
    </div>
    <div class="pop-reg-company-delete-footer"></div>
</div>
<!-- Delete Company Account - Ends here -->

<!-- Delete Company Account - Success window. -->
<div class="pop-message-delete-message png">
    <div class="pop-message-delete-message-wrap rel">
        <i class="pop-message-delete-message-close abs" title="close"></i>
        <b>Your account is deleted.</b>
        <div class="pop-message-delete-message-bd">
            <div class="message_title">Logout and redirecting you to Site Index....</div>
            <div class="message_content"></div>
        </div>
    </div>
</div>
<!-- Delete Company Account - Success window. Ends here -->

<!-- Edit Password - starts here -->
<div class="pop-mark-change-password"></div>

<!--First Pop Up window for Edit Password. -->
<div class="pop-reg-change-password png">
    <div class="pop-reg-change-password-wrap rel">
        <form id="change_pass_form" method="post" action="">
            <div class="pop-reg-change-password-close abs" title="close"></div>
            
            <div class="pop-reg-change-password-tit">
                Change Password:
            </div>
            <div class="pop-reg-change-password-agree">
                1. Old password. <br>
                <input type="password" id="old-pass" name="old-pass" class="kyo-input"/>
                <p id="wrong-old" class="red"></p>
            </div>
            <div class="pop-reg-change-password-agree">
                2. New password. <br>
                <input type="password" id="new-pass" name="new-pass" class="kyo-input"/>  
                <p id="wrong-new" class="red"></p>              
            </div>
            <div class="pop-reg-change-password-agree">
                3. Confirm new password. <br>
                <input type="password" id="conf-pass" name="conf-pass" class="kyo-input"/>
                <p id="wrong-conf" class="red"></p>
            </div>
            
            <div class="pop-reg-change-password-submit">
                <input type="text" id="pop-reg-change-password-submit" class="pop-reg-change-password-submit-btn" />
            </div>
        </form>
    </div>
    <div class="pop-reg-change-password-footer"></div>
</div>
<!-- change-password - Ends here -->


<script type="text/javascript">
/**
 * Called from facebox popup page once the real IMAGE CROPPING is over.
 * 1. It hide the IMAGE AREA containers (in some cases, it is not closing automatically)
 * 2. Shows preview of new cropped image.
 * 3. Store the cropped image name into avatar for datbase updation.
 */                      
function thumbnailPreview(thumb_image_name_with_ext)
{ 
   $(".imgareaselect-outer").hide(); 
   $(".imgareaselect-selection").hide(); 
   $(".imgareaselect-border1").hide(); 
   $(".imgareaselect-border2").hide(); 
   
   var img_path = "<?php echo $site_url; ?>attached/users/profileimage/"+thumb_image_name_with_ext;
   
   $("#image_profile").attr( "src", img_path);
   $("#errorRemind").html('Image has been saved.');
   
    var profile_pic = "profileimage/"+thumb_image_name_with_ext;
    $('#avatar').val(profile_pic);
}   

    
$(document).ready(function(){
    uploadImage();

/**
 * It hide the IMAGE AREA containers (in some cases, it is not closing automatically).
 * This is needed when user started cropping but stopped without completing all steps.
 */
$(document).bind('close.facebox', function() {
	// close tinymce or whatever you need..
    $(".imgareaselect-outer").hide(); 
    $(".imgareaselect-selection").hide(); 
    $(".imgareaselect-border1").hide(); 
    $(".imgareaselect-border2").hide(); 
});

/**
 * Company Logo uploaded to Server via ajax.
 * Trigger Facebox for PopUp and shows the Image Preview (Resized version) for Cropping. 
 */
function uploadImage(old_avatar) {
        var oBtn = document.getElementById("image_profile");
        var upload_button = document.getElementById("upload_button");
        var oRemind = document.getElementById("errorRemind");
        new AjaxUpload(oBtn,{
            action:"<?php echo $site_url?>user/uploadimage",
            name:"image",
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
                var response = response.split("|");
                if ( response[0] == 'success') {
                    oRemind.style.color =   "green";
                    oRemind.innerHTML   =   "Now cropping image...";
                    
                    // Trigger Facebox PopUp call.
                    // After successfull cropping, the thumbnailPreview() will be calledback.
                    jQuery.facebox({ ajax: '<?php echo $site_url; ?>user/cropimage' });
                    
                } else {
                    oRemind.style.color = "red";
                    oRemind.innerHTML = response[1];
                }
            }
        });
    }
    
        }
);
</script>
<script type="text/javascript">
$(document).ready(function() {
    $("select[name='country']").change(function() {
        change_location($(this),'country', '<?php echo $basic_info['country'];?>');
    });
    $("select[name='province']").change(function() {
        change_location($(this), 'province', '<?php echo $basic_info['province'];?>');
    });
    
    select_location('country','<?php echo $basic_info['country'];?>');
    select_location('province','<?php echo $basic_info['province'];?>');
    $( "#basicForm" ).validate();

    $('#industry_box').tagit({
        initialTags:[<?php foreach ($industries as $industry) echo '"'.$industry['industry'].'",'; ?>],
        select:true, 
        sortable:true,
        tagsChanged:function () {
            var tags = $('#industry_box').tagit('tags');
            var tagString = [];
                                    
            //Pull out only value
            for (var i in tags){
              tagString.push(tags[i].value);
            }
            $('#industry_tag').val(tagString.join(','));
        }
    });
    $('.tagit-input').attr('disabled','disabled');
    $('#industry').change(function() {
        addTag($('#industry').val());
    });

});
var addTag = function(tag) {
    $('#industry_box').tagit("add", {label: tag, value: tag});

}
</script>
<script type="text/javascript" src="<?php echo $theme_path?>js/reg.js"></script>
<?php $this->load->view($front_theme.'/footer-block');?>