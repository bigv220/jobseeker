<?php $this->load->view($front_theme.'/header-block');?>

    <div class="w770 rel clearfix">

        <div class="news-index box rel mb10">
            <div class="news-index-left">
                <?php if (empty($hot_news)): ?>
                <div class="article">
                    <div class="title">1Russia & China To Start Youth Exchange Program. </div>
                    <div class="content">
                        <img src="<?php echo $theme_path?>style/home/article_img.jpg"/>
                        <p>
                        JingJobs has now officially launched and is ready to use! 
                        Although we have tried our hardest, 
                        there may still be some kinks with the website in the first few weeks, 
                        so we would be incredibly grateful if you would bear with us patiently in the meantime. 
                        The launch of JingJobs coincides (very auspiciously) with the arrival of the New Year! 
                        To anyone who is stuck in a rut, or unhappy with their jobs, take this as a sign and sign up with us. 
                        China is a land of myriad opportunities and Beijing is a booming hub for job seekers, 
                        filled with new experiences. JingJobs is the first international platform of its kind based in Beijing. 
                        Our aim is to make it as easy and seamless as possible for English-speaking job seekers to find their dream career. 
                        In order to do just that we have incorporated features such as JingChat into our website, 
                        which makes the gap between potential employers and jobseekers as small as possible. 
                        Join us for a fresh outlook on life and an exciting change of environment and make 2014 your best year ever!
                        <br />                 
                        <a href="<?php echo $site_url?>news/view/166">Continue reading</a>
                        </p>
                    </div>
                    <!-- <div class="share-sns">
                        <a href="#" class="like_btn">Like</a>
                        <a href="#" class="share_btn">Share</a>
                    </div> -->
                </div>
                <?php else: 
                $hot_news = $hot_news[0];
                ?>
                <div class="article">
                    <div class="title"><?php echo $hot_news['title']; ?></div>
                    <div class="content">
                        <?php if(!empty($hot_news['profile_pic'])) {
                                        $pic = $site_url.'attached/article/'.$hot_news['profile_pic'];
                                   } else {
                                        $pic = $theme_path."style/home/article_img.jpg";
                                   }
                            ?>
                        <img src="<?php echo $pic?>" width="480"/>
                        <p>
                        <?php echo $hot_news['content_general']; ?>
                        <a href="<?php echo $site_url?>news/newsDetails/<?php echo $hot_news['aid']; ?>">Continue reading</a>
                        </p>
                    </div>
                    <!-- <div class="share-sns">
                        <a href="#" class="like_btn">Like</a>
                        <a href="#" class="share_btn">Share</a>
                    </div> -->
                </div>
                <?php endif; ?>

                <!-- EXPAT PROFILE -->
                <?php if (empty($expat_profile)): ?>
                <div class="profile">
                    <div class="profile_header">
                        <div class="titles">
                            <div class="main_title">Expat Profile</div>
                            <div class="subtitle">
                                <div>Name: Michaela Williams</div>
                                <div>Location: Shanghai</div>
                                <div>Works as a Marketing Manager</div>
                            </div>
                            <div class="small_title">There are many places around the world, but what was it about China that attracted you?</div>
                        </div>
                        <div class="profile_img">
                            <img src="<?php echo $theme_path?>style/home/temp/newsletter-expat.png" width="120" height="120" alt="" />
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="content">

                        <p> I decided to go to China for a few different reasons, firstly because China has such a vibrant and booming economy. Companies across the globe are vying to do business with China and having first-hand knowledge of Chinese business culture would be a real asset to my professional development. Another reason I chose China is because the culture is so different and it would be a completely new and interesting experience. As soon as I arrived in China, I knew that I had made the right choice. China is so vibrant and diverse that no 2 days are the same and there is never an opportunity to be bored.
                            <a href="<?php echo $site_url?>news/view/<?php echo $hot_news['aid']; ?>">Continue reading</a>
                        </p>
                    </div>
                </div>
                <?php else: 
                $expat_profile = $expat_profile[0];
                ?>
                <div class="profile">
                    <div class="profile_header">
                        <div class="titles">
                            <div class="main_title"><?php echo $expat_profile['title']; ?></div>
                        </div>
                        <?php if(!empty($expat_profile['profile_pic'])) {
                                        $pic = $site_url.'attached/article/'.$expat_profile['profile_pic'];
                                   } else {
                                        $pic = $theme_path."style/company/face.png";
                                   }
                            ?>
                        <div class="profile_img" style="position:absolute;left:350px;">
                            <img src="<?php echo $pic?>" width="120" height="120" alt="" class="round_img"/>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="content titles">

                        <p>
                            <?php echo $expat_profile['content_general']; ?>
                            <a href="<?php echo $site_url?>news/expatProfile/<?php echo $expat_profile['aid']; ?>">Continue reading</a>
                        </p>
                    </div>
                </div>
                <?php endif; ?>

                <div class="useful_links">
                    <div class="title">Useful Links and Things We Like</div>
                    <ul>
                        <li><a href="http://gradrecruiter.wordpress.com/2013/08/29/is-your-mind-set-to-global/">7 ways to improve your global mindset</a></li>
                        <li><a href="http://www.theatlantic.com/infocus/2013/09/scenes-from-21st-century-china/100586/">Scenes from 21st Century China</a></li>
                        <li><a href="<?php echo $site_url?>news/view/169">Shanghai Free Trade Zone to welcome hotel boom</a></li>
                    </ul>
                </div>

            </div>
            <div class="news-index-right">
                <div class="upcoming_events">
                    <div class="title">Upcoming Networking Events and Job Fairs</div>
                    <?php if (!empty($events)): ?>
                    <?php foreach ($events as $event): ?>
                    <div class="event_row">
                        <a href="<?php echo $site_url?>news/view/<?php echo $event['aid']; ?>">
                        <div class="event_title"><?php echo $event['title']; ?></div>
                        <p><?php echo $event['descrip']; ?></p>
                        </a>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    <div class="more_link"><a href="#">See All Upcoming Events</a></div>
                </div>
                <div class="top_stories">
                    <div class="title">Top Stories</div>
                    <?php if (!empty($stories)): ?>
                    <?php foreach ($stories as $story): ?>
                    <div class="story_row">
                        <a href="<?php echo $site_url?>news/view/<?php echo $story['aid']; ?>">
                            <div class="story_title"><?php echo $story['title']; ?></div>
                            <div class="clearfix"></div>
                        </a>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    <div class="more_link"><a href="#">See All Articles</a></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>

<?php $this->load->view($front_theme.'/footer-block');?>