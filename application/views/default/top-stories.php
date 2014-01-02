<?php $this->load->view($front_theme.'/header-block');?>

    <div class="w770 rel clearfix">

        <div class="news-index news_details box rel mb10">
            <div class="news_top_header">
                <div class="title">Top Stories on JingNews</div>

            </div>
            <div class="news-index-left">
                <div class="article_row">
                    <div class="article_thumbnail">
                        <img src="<?php echo $theme_path;?>style/search/job-img1.gif" alt="" width="75px" height="75px" class="round_img"/>
                    </div>
                    <div class="article_abstract">
                        <p class="title">Shanghai Free Trade Zone to Welcome Hotel Zoom</p>
                        <p class="post_date">November 20th 2013</p>
                        <p class="content_abstract">The launch of the Shanghai Free Trade Zone will be a massive step forward for the city and experts expect a knock-on effect, of increased hotel bookings.</p>
                        <a href="#">Continue Reading</a>
                    </div>
                    <div style="clear:both;"></div>
                </div>

                <div class="article_row">
                    <div class="article_thumbnail">
                        <img src="<?php echo $theme_path;?>style/search/job-img1.gif" alt="" width="75px" height="75px" class="round_img"/>
                    </div>
                    <div class="article_abstract">
                        <p class="title">Shanghai Free Trade Zone to Welcome Hotel Zoom</p>
                        <p class="post_date">November 20th 2013</p>
                        <p class="content_abstract">The launch of the Shanghai Free Trade Zone will be a massive step forward for the city and experts expect a knock-on effect, of increased hotel bookings.</p>
                        <a href="#">Continue Reading</a>
                    </div>
                    <div style="clear:both;"></div>
                </div>

                <div class="article_row">
                    <div class="article_thumbnail">
                        <img src="<?php echo $theme_path;?>style/search/job-img1.gif" alt="" width="75px" height="75px" class="round_img"/>
                    </div>
                    <div class="article_abstract">
                        <p class="title">Shanghai Free Trade Zone to Welcome Hotel Zoom</p>
                        <p class="post_date">November 20th 2013</p>
                        <p class="content_abstract">The launch of the Shanghai Free Trade Zone will be a massive step forward for the city and experts expect a knock-on effect, of increased hotel bookings.</p>
                        <a href="#">Continue Reading</a>
                    </div>
                    <div style="clear:both;"></div>
                </div>

                <div class="article_row">
                    <div class="article_thumbnail">
                        <img src="<?php echo $theme_path;?>style/search/job-img1.gif" alt="" width="75px" height="75px" class="round_img"/>
                    </div>
                    <div class="article_abstract">
                        <p class="title">Shanghai Free Trade Zone to Welcome Hotel Zoom</p>
                        <p class="post_date">November 20th 2013</p>
                        <p class="content_abstract">The launch of the Shanghai Free Trade Zone will be a massive step forward for the city and experts expect a knock-on effect, of increased hotel bookings.</p>
                        <a href="#">Continue Reading</a>
                    </div>
                    <div style="clear:both;"></div>
                </div>


            </div>
            <div class="news-index-right">
                <div class="filter_top_stories_title">Filter Top Stories</div>
                Search
                <form action="<?php echo $site_url; ?>" method="post" id="search_top_stories_form">
                    <input type="text" name="keywords" class="abs input-tip search_top_stories_input" value="Search by Keywords" data-tipval="Search by Keywords"/>
                    <input type="submit" class="abs search_top_stories_btn" value=""  title="search"/>
                </form>
                <div>View Stories From</div>
                <select name="stories_from" required>
                    <option value="">Last 30 Days</option>
                    <option value="">Last 90 Days</option>
                    <option value="">Last 180 Days</option>
                </select>


            </div>
            <div class="clearfix"></div>
        </div>

    </div>

<?php $this->load->view($front_theme.'/footer-block');?>