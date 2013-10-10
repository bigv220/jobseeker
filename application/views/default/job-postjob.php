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
		<form action="" method="post">
		postion title: <input type="text" name="job_name"><br>
		industry: 		<input type="text" name="industry"><br>
		language: 		<input type="text" name="language"><br>
		tech skills: 	<input type="text" name="preferred_technical_skills"><br>
		pers skills: 	<input type="text" name="preferred_personal_skills"><br>
		location:	 	<input type="text" name="location"><br>
		postion: 		<input type="text" name="position"><br>
		language level: <input type="text" name=""><br>
		type of job: 	<input type="text" name="employment_type"><br>
		length of job: 	<input type="text" name="employment_length"><br>
		salary: 		<input type="text" name="salary_range"><br>
		experience: 	<input type="text" name="preferred_year_of_experience"><br>
		descrip: 		<textarea name="job_desc"></textarea><br>
		<input type="submit">
		</form>
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

<?php $this->load->view($front_theme.'/footer-block');?>