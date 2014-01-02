<?php $this->load->view($front_theme.'/header-block');

$expat_profile = $expat_profile[0];
?>

    <div class="w770 rel clearfix">

        <div class="news-index expat_profile box rel mb10">
            <div class="profile">
                <div class="profile_header">
                    <div class="titles">
                        <div class="main_title"><?php echo $expat_profile['title']; ?></div>
                    </div>
                    <div class="profile_img" style="position:absolute;left:620px;">
                        <img class="round_img" src="<?php echo $theme_path?>style/home/temp/newsletter-expat.png" width="120" height="120" alt="" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="content titles">
                    <p>
                        <?php echo $expat_profile['content_general']; ?>
                    </p>
                    <p>
                        <?php echo $expat_profile['content']; ?>
                    </p>
                </div>
                <!-- <div class="share-sns">
                    <a href="#" class="like_btn">Like</a>
                    <a href="#" class="share_btn">Share</a>
                </div> -->
            </div>


        </div>

    </div>

<?php $this->load->view($front_theme.'/footer-block');?>