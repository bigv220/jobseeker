<?php $this->load->view($front_theme.'/header-block');?>

<!--top search area-->
<div class="top-search w70 rel">
    <input type="text" class="abs top-search-input input-tip" value="Search our job database" data-tipval="Search our job database"/>
    <input type="submit" class="abs top-search-btn " value=""  title="search"   />
    <a href="#" class="abs top-search-a">More Options</a>
</div>

<!--company page body-->
<div class="company-page w770 clearfix rel">
  <div class="company-body box rel mb20">
    <div class="company-hd rel"> <i class="abs face png"></i>
      <div class="text" <?php echo $theme_path?>style="width:320px;">
        <h2>JOB TITLE HERE</h2>
        <h4>Redstar Works, Beijing</h4>
        <p>Posted on 6th Aug 2013</p>
      </div>
      <div class="about-btns"> <a href="#" class="png abtn apply"></a> <a href="#" class="png abtn view"></a> <a href="#" class="png abtn bkmk"></a> <a href="#" class="png abtn bkmked" <?php echo $theme_path?>style="display:none;"></a> </div>
    </div>
    <div class="company-bd">
      <div class="company-bd-left">
        <dl class="mb30">
          <dt>About Job</dt>
          <dd>We have an exciting opportunity for a full time Graphic Designer to join our creative team.We are?a leading creative, events and media agency with offices in Beijing, London and Qingdao.<br />
            We create and distribute amazing work for a variety of retailers and clients. You will be working on great brands such as Baccarat, Arcosteel, Alex Liddy and Marie Claire.
            We offer the opportunity to work with a great team on exciting, creative and challenging designs.<br />
            Reporting to the marketing manager, you will be assisting on projects ranging from packaging, catalogues, theme and design concepts, product development, decals and surface decorations applied to a range of home products, flyers, ads, signage, posters, for a variety of brands and various brand <?php echo $theme_path?>style applications. </dd>
        </dl>
        <dl class="mb30">
          <dt>Preferred Years of Experience</dt>
          <dd class="idustry">1 to 3 years</dd>
        </dl>
        <dl class="mb30">
          <dt>Preferred Personal Skills</dt>
          <dd><strong>Time Managment, Public Speaking, Networking, Leadership, Risk taking</strong></dd>
        </dl>
        <dl class="mb30">
          <dt>Preferred Technical Skills</dt>
          <dd><strong>Time Managment, Public Speaking, Networking, Leadership, Risk taking</strong></dd>
        </dl>
        <dl class="mb30">
          <dt>Language(s) Required</dt>
          <dd>
          <dd> <span class="required"> <b>English</b> <i>Fluent</i> </span> <span class="required"> <b>French</b> <i>Fluent</i> </span> <span class="required"> <b>German</b> <i>Fluent</i> </span> </dd>
          </dd>
        </dl>
        <dl class="mb30">
          <dt>Salary</dt>
          <dd><strong>10,000CNY - 15,000CNY </strong></dd>
        </dl>
        <dl class="mb30">
          <dt>Industry</dt>
          <dd class="idustry"><a href="#">graphic</a> <a href="#">Design</a> <a href="#">Media</a> <a href="#">Publishing</a> <a href="#">Marketing</a></dd>
        </dl>
        <dl class="mb30">
          <dt>Share This Job</dt>
          <dd> <a href="#" class="sharejob png sharejob-f"></a> <a href="#" class="sharejob png sharejob-t"></a> <a href="#" class="sharejob png sharejob-s"></a> <a href="#" class="sharejob png sharejob-g"></a> <a href="#" class="sharejob png sharejob-m"></a> </dd>
        </dl>
      </div>
      <div class="company-bd-right">
        <div class="match"> <b>93%</b> </div>
        <dl class="mb20">
          <dt>Location</dt>
          <dd class="location"> <img src="<?php echo $theme_path?>style/company/map.gif" alt="" /> <strong>Lee World, Room 301,Chayong District, Beijing</strong> </dd>
        </dl>
        <dl class="mb20">
          <dd>
            <ul class="industry-ul">
              <li class="n1"><b>Type of Employment</b><span>Full Time</span></li>
              <li class="n2"><b>Length of Employment</b><span>Long Term (1+ year)</span></li>
              <li class="n3"><b>Visa Assistance</b><span>Visa will be provided</span></li>
              <li class="n4"><b>Housing Assistance</b><span>Accomodation will be provided</span></li>
            </ul>
          </dd>
        </dl>
        <dl>
          <dt>Similar Jobs</dt>
          <dd>
            <ul class="similar">
              <li><img src="<?php echo $theme_path?>style/home/temp/sponsors2.gif" alt="" /><i class="png"></i><a href="#">Design Director</a>White Space Design</li>
              <li><img src="<?php echo $theme_path?>style/home/temp/sponsors2.gif" alt="" /><i class="png"></i><a href="#">Graphic Designer</a>Beige Tomato Studio</li>
              <li><img src="<?php echo $theme_path?>style/home/temp/sponsors2.gif" alt="" /><i class="png"></i><a href="#">Website Developer</a>Shanghai Creative Consultants</li>
            </ul>
          </dd>
        </dl>
      </div>
    </div>
  </div>
</div>

<!-- Our Partners -->
<div class="partners w70">
    <div class="puartners-tit">Our Partners</div>
    <div class="puartners-nav">
        <ul class="puartners-ul zoom">
            <li><a href="#"><img src="<?php echo $theme_path?>style/company/partners.png" alt="" width="176" height="103" /></a></li>
            <li><a href="#"><img src="<?php echo $theme_path?>style/company/partners.png" alt="" width="176" height="103" /></a></li>
            <li><a href="#"><img src="<?php echo $theme_path?>style/company/partners.png" alt="" width="176" height="103" /></a></li>
            <li><a href="#"><img src="<?php echo $theme_path?>style/company/partners.png" alt="" width="176" height="103" /></a></li>
        </ul>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script type="text/javascript">
    var map;
    var geocoder = new google.maps.Geocoder();
    function initialize() {
        var myOptions = {
            zoom : 13,
            center : new google.maps.LatLng(-34.397, 150.644),
            zoomControl: true,
            zoomControlOptions: {
                <?php echo $theme_path?>style: google.maps.ZoomControl<?php echo $theme_path?>style.SMALL,
            },
            panControl: false,
            scaleControl:false,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            mapTypeControl: false
        }

        map = new google.maps.Map(document.getElementById("map"),
            myOptions);
    }

    function codeAddress() {
        var address = $('#address').val();
        geocoder.geocode( { 'address': address}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location
                });
            }
        });
    }

    $(document).ready(function(){
        initialize();
        codeAddress();
    });

</script>
<?php $this->load->view($front_theme.'/footer-block');?>