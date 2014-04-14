<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?php
            if (!empty($title))
                echo $title . ' | ';
            if (!empty($article['title']))
                echo $article['title'] . ' | ';
            echo $site_name;
            ?></title>
        <meta name="keywords" content="<?php echo $keyword ?>" >
        <meta name="description" content="<?php echo $description ?>" >

        <link rel='shortcut icon' type='image/x-icon' href='<?php echo $theme_path ?>style/site/favicon.ico' />

        <link href="<?php echo $theme_path ?>style/pub.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $theme_path ?>style/home.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $theme_path ?>style/company.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $theme_path ?>style/reg.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $theme_path ?>style/search.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $theme_path ?>style/adv-search.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $theme_path ?>style/kyo-form/kyo-form.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $theme_path ?>style/index.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $theme_path ?>style/support.css" rel="stylesheet" type="text/css" />
        <!--Import Select TAG CSS -->
        <link href="<?php echo $theme_path ?>css/tag/tagit-simple-grey.css" rel="stylesheet" type="text/css" />
    
        <script type="text/javascript" src="<?php echo $theme_path ?>js/jslib/jquery-1.7.2.min.js" ></script>
        <script type="text/javascript" src="<?php echo $theme_path ?>js/jslib/jquery.lazyload.min.js" ></script>
        <script type="text/javascript" src="<?php echo $theme_path ?>js/jslib/kyo4311.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path ?>js/jslib/kyo4311-form.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path ?>js/jslib/jquery-ui.1.8.20.min.js" ></script>
        <script type="text/javascript" src="<?php echo $theme_path ?>js/jslib/jquery.validate.js" ></script>
        <script type="text/javascript" src="<?php echo $theme_path ?>js/jslib/ajaxupload.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path ?>js/common.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path ?>js/home.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path ?>js/interview.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path ?>js/support.js"></script>
        <script src="http://code.jquery.com/jquery-latest.min.js"></script>

        <script>
            var site_url = "<?php echo $site_url ?>";
            var base_url = "<?php echo $base_url ?>";
            var theme_url = "<?php echo $theme_path ?>";
            var current_login_user_id = "<?php echo (isset($uid) ? $uid : -1) ?>";
            function topSearchSubmit() {
                $('#topSearchForm').submit();
            }


            function funcFindstaff() {
                var user_type = <?php echo json_encode($this->session->userdata('user_type')); ?>;

                if (user_type != 1) {
                    alert("You have to be logged in as a company to be able to see this page.");
                } else {
                    window.location = site_url + "search/findstaff";
                }
            }

//            $('input[type="submit"].login-btn').on("click",(function(e) {
//                e.preventDefault();
//                alert('e');
//                $('.login-btn').html('Loading...');
//            });

        </script>

        <script>
            (function(i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function() {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-48145475-1', 'jingjobs.com');
            ga('send', 'pageview');

        </script>	
         		<script type="text/javascript" src="<?php echo $theme_path ?>js/index.js"></script>
</head>
<html>
	<div id="main_container">
		<body>
<!-- SLIDER -->		
			<div id="fader">
				<img id="fader_placeholder" src="<?php echo $theme_path ?>style/pub/slider_bg_1.jpg">
				<div data-title="1">
					<a href=""><img src="<?php echo $theme_path ?>style/pub/slider_bg_1.jpg"></a>
				</div>
				<div data-title="2">
					<a href=""><img  src="<?php echo $theme_path ?>style/pub/slider_bg_2.jpg"></a>
				</div>
				<div data-title="3">
					<a href=""><img  src="<?php echo $theme_path ?>style/pub/slider_bg_3.jpg"></a>
				</div>
			</div>
			<div id="slider_container">		
				<img id="slider" data-title="1" src="<?php echo $theme_path ?>style/pub/slider_img_1.png">
				<img id="slider" data-title="2" src="<?php echo $theme_path ?>style/pub/slider_img_2.png">
				<img id="slider" data-title="3" src="<?php echo $theme_path ?>style/pub/slider_img_3.png">
			</div>
<!--header-->
<?php $this->load->view($front_theme.'/header-block-v3');?>		
<!-- PARTNERS  SLIDER DOTS -->	
			<div id="partners">
	<!-- SLIDER DOTS -->
				<div id="slider_buttons">
					<img src="<?php echo $theme_path ?>style/pub/slider_arrow.png" id="nav-back">
					<div data-title="1" class="slider_dot"> </div>
					<div data-title="2" class="slider_dot slider_dot_down"> </div>
					<div data-title="3" class="slider_dot"> </div>
					<img src="<?php echo $theme_path ?>style/pub/slider_arrow.png" id="nav-next">
				</div>
	<!-- /SLIDER DOTS -->
				<div id="partner_box_container">
					<h2 class="slogan">Connecting the right people with the right jobs in China</h2>
					<div class="row">
						Our Partners
					</div>
					<div class="partner_box">
						<div class="partner_image_container">
							<img src="<?php echo $theme_path ?>style/home/temp/pertner-hb.png">
						</div>
					</div>
					<div class="partner_box">
						<div class="partner_image_container">
							  <img src="<?php echo $theme_path ?>style/home/temp/pertner-ca.png">
						</div>
					</div>
					<div class="partner_box">
						<div class="partner_image_container">
							  <img src="<?php echo $theme_path ?>style/home/temp/pertner-hds.png">
						</div>
					</div>
					<div class="partner_box">
						<div class="partner_image_container last">
							  <img src="<?php echo $theme_path ?>style/home/temp/pertner-bc.png">
						</div>
					</div>
				</div>
			</div>
		</body>
<!-- FOOTER -->
			<?php $this->load->view($front_theme.'/footer-block-v3');?>			