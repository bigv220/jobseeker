<?php $this->load->view($front_theme.'/header-block');

$news = $hot_news[0];?>

    <div class="w770 rel clearfix">

        <div class="news-index news_details box rel mb10">
            <div class="news_top_header">
                <div class="title"><?php echo $news['title']; ?></div>
                <div class="subtitle"><?php echo $news['descrip']; ?>
                </div>
                <!--<div class="sns_share_btns">
                    <a href="#"><img src="<?php echo $theme_path;?>/style/btns/btn_like.png" alt=""/></a>
                    <a href="#"><img src="<?php echo $theme_path;?>/style/btns/btn_share.png" alt=""/></a>
                </div>-->
            </div>
            <div class="news-index-left">
                <div class="article">
                    <div class="content">
                        <?php if(!empty($news['profile_pic'])) {
                                        $pic = $site_url.'attached/article/'.$news['profile_pic'];
                                   } else {
                                        $pic = $theme_path."style/home/article_img.jpg";
                                   }
                            ?>
                        <img src="<?php echo $pic?>" width="480"/>
                        <p>
                        <?php echo $news['content_general']; ?>
                        <?php echo $news['content']; ?>
                        </p>
                    </div>
                    <!-- <div class="share-sns">
                        <a href="#" class="like_btn">Like</a>
                        <a href="#" class="share_btn">Share</a>
                    </div> -->
                </div>


            </div>
            <div class="news-index-right">
                <div class="read_more_stories">
                    <div class="title">Read More Stories</div>
                    <ul>
                        <?php foreach ($stories as $story): ?>
                        <li><a href="<?php echo $site_url?>news/view/<?php echo $story['aid']; ?>"><?php echo $story['title']; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="read_more_stories">
                    <div class="title">Useful Links & Things We Like</div>
                    <ul>
                        <li><a href="http://gradrecruiter.wordpress.com/2013/08/29/is-your-mind-set-to-global/">7 ways to improve your global mindset</a></li>
                        <li><a href="http://www.theatlantic.com/infocus/2013/09/scenes-from-21st-century-china/100586/">Scenes from 21st Century China</a></li>
                        <li><a href="<?php echo $site_url?>news/view/169">Shanghai Free Trade Zone to welcome hotel boom</a></li>
                    </ul>
                </div>

            </div>
            <div class="clearfix"></div>
        </div>

    </div>

<?php $this->load->view($front_theme.'/footer-block');?>