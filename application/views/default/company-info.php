<?php $this->load->view($front_theme . '/header-block'); ?><!--company page body--><div class="company-page w770 clearfix rel">    <div class="company-body box rel mb20">        <div class="company-hd rel">             <div class="people_icon">                <img src="<?php echo $site_url . 'attached/users/' . $info['profile_pic'] ?>" alt="" width="128px" height="128px"/>                <i class="abs face png"></i>            </div>            <div class="text_wrapper">                <h2 class="title_not_bold"><?php echo $info['first_name']; ?></h2>    
            
<h4><?php
                    echo $info['city'];
                    if (isset($info['city']) && isset($info['country'])) {
                        echo ', ';
                    }
                    echo $info['country'];
                    ?>
                </h4>  
                
                 <p>Offline now</p>            
                 </div>            
                 <div class="btnarea"> 
                 
                 <!--<a href="<?php // echo $info['personal_website']; ?>" class="png combtn website"></a>--> 
                 
                  <!-- <a href="#" class="png combtn bookmark"></a> -->
                  <!-- <a href="#" class="combtn bookmarded" style="display:none;"></a> -->
                  
                  
                  <a href="javascript:void(0);" id="company-mark<?php echo $info['uid']; ?>" class="png combtn click_bookmark_company <?php
                if (isset($info['uid']) && in_array($info['uid'], $bookmark))
                    echo "bookmarded";
                ?>" data-company-id="<?php echo $info['uid']; ?>"></a>
                  
                  
                  </div>  
                      
                    </div>      
                    
                    <div class="company-bd">    
                            <div class="company-bd-left">         
                                   <dl class="mb30">    
                                                   <dt>About <?php echo $info['first_name']; ?></dt>   
                                                                    <dd><strong><?php echo $info['description']; ?></strong></dd>
                                                                                    </dl>       
                                                                                             <dl class="mb30"> 
                                                                                                                <dt>Industry</dt> 
                                                                                                                                   <dd class="idustry">                        <?php foreach ($industries as $industry): ?>       
                                                                                                                                   
                                                                                                                              
                                                                                                                               <?php echo $industry['industry']; ?>           
                                                                                                                                                                     <?php endforeach; ?>                    </dd>   
                                                                                                                                                                                  </dl>                <dl>                    <dt>Phone</dt>   
                                                                                                                                                                                                   <dd><strong><?php if ($info['country'] == 'China'): ?> (+86) <?php else: ?> (+1) <?php endif; ?> <?php echo $info['phone']; ?></strong></dd>                </dl>            </div>            <div class="company-bd-right">                <dl class="mb20">                    <dt>Jobs at <?php echo $info['first_name'] ?></dt>                    <dd class="mb40">                        <?php if (empty($jobinfo)): ?>                            <div class="listed">                                <p>You are not currently advertising any job positions.</p>                                <a href="<?php echo $site_url ?>job/postjob"><img src="<?php echo $theme_path ?>style/company/post.png" alt="" border="0" /></a> </div>                        <?php else: ?>                            <ul class="redstar-works">                                <?php foreach ($jobinfo as $job): ?>                                    <li><a href="<?php echo $site_url . 'job/jobDetails/' . $job['id'] ?>"><?php echo ucwords(strtolower($job['job_name'])); ?></a></li>                                                <?php endforeach; ?>                            </ul>                        <?php endif; ?>                    </dd>                </dl>                <dl>                    <dt><?php echo $info['first_name']; ?> elsewhere on the web</dt>                    <dd>                        <ul class="redstar-web">                            <?php if (!empty($info['twitter'])): ?>                                <li><a href="<?php echo $info['twitter'] ?>">Twitter</a></li>                            <?php endif; ?>                            <?php if (!empty($info['facebook'])): ?>                                <li><a href="<?php echo $info['facebook'] ?>">Facebook</a></li>                            <?php endif; ?>                            <?php if (!empty($info['linkedin'])): ?>                                <li><a href="<?php echo $info['linkedin'] ?>">Linkedin</a></li>                            <?php endif; ?>                            <?php if (!empty($info['weibo'])): ?>                                
                                                                                                                                                                                                   <li><a href="<?php echo $info['weibo'] ?>">Weibo</a></li>                            
                                                                                                                                                                                                   <?php endif; ?>                        
                                                                                                                                                                                                   </ul>              
                                                                                                                                                                                                         </dd>               
                                                                                                                                                                                                          </dl>            
                                                                                                                                                                                                         </div>        
                                                                                                                                                                                                   </div>   
                                                                                                                                                                                                    </div>
                                                                                                                                                                                                   </div><!-- Partners -->
                                                                                                                                                                                                   
                                                                                                                                                                                                   <?php $this->load->view($front_theme . '/partners-block'); ?>
                                                                                                                                                                                                   
                                                                                                                                                                                                   <!--popmark-->
<div class="pop-mark"></div>
<!--pop bookmark company box-->
<div class="box pop-box pop-bookmark">
    <div class="rel">
        <div class="pop-close pop-apply-close"></div>
        <div class="pop-nav pop-apply-nav">
            <p>Are you sure you want to bookmark this company?</p>
        </div>
        <div class="pop-bar">            
            <input type="hidden" id="selected_company_id" />            
            <a href="javascript:void(0);" class="pop-bar-btn pop-bookmark-company-yes">Yes</a>            
            <a href="javascript:void(0);" class="pop-bar-btn pop-btn-no">No</a>        
        </div>
    </div>
</div>
<div class="signup-pop-bookmark">
    <div class="rel">
        <div class="pop-close signup-pop-apply-close abs"></div>
        <div class="pop-nav signup-pop-apply-nav">
            <p>Please register as a jobseeker to bookmark companies.</p>
        </div>
        <div class="pop-bar">            
            <button href="javascript:void(0);" class="signup-pop-btn"></button>    
        </div>
    </div>
</div>
                                                                                                                                                                                                   <!--backtop--><div class="backtop png"></div>

<script type="text/javascript" src="<?php echo $theme_path ?>js/search-result.js"></script>                                                                                                                                                                             <?php $this->load->view($front_theme . '/footer-block'); ?>