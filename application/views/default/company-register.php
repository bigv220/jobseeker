<?php $this->load->view($front_theme.'/header-block');?>

<!--company page body-->
<div class="reg-page w770 clearfix rel">
    <div class="reg-left abs box mb20">
        <h2 class="reg-left-tit">NiHAO <span title="<?php echo $basic_info['first_name'];?>"><?php echo substr($basic_info['first_name'],0,8);?></span></h2>
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
        <div class="reg-btns"> <a href="javascript:void(0);" onclick="saveAll();" class="reg-btns-save"></a><a href="<?php echo $site_url?>job/postjob" class="reg-btns-post"></a><a href="<?php echo $site_url?>search/searchjobseeker" class="reg-btns-find"></a> </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    uploadImage();
    }
);
function uploadImage(old_avatar) {
        var oBtn = document.getElementById("image_profile");
        var upload_button = document.getElementById("upload_button");
        var oRemind = document.getElementById("errorRemind");
        new AjaxUpload(oBtn,{
            action:"<?php echo $site_url?>user/ajaxuploadimage",
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
                var response = response.split("|");
                if ( response[0] == 'success') {
                    oRemind.style.color = "green";
                    oRemind.innerHTML = "Upload successful.";

                    //var reg = /\s/g;
                    var filename = response[1];

                    var img_path = "<?php echo $site_url; ?>attached/users/" + filename;
                    $('#avatar').val(filename);
                    upload_button.innerHTML = "<img id='image_profile' src='" + img_path + "?" +  Math.floor(Math.random()*99999 + 1) + "' height='100' style='border:1px solid gray;' />";
                } else {
                    oRemind.style.color = "red";
                    oRemind.innerHTML = response[1];
                }
            }
        });
    }
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