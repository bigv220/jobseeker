<?php $this->load->view($front_theme.'/header-block');?>

    <div class="top-search w70 rel">
        <input type="text" class="abs top-search-input input-tip" value="Search our job database" data-tipval="Search our job database"/>
        <input type="submit" class="abs top-search-btn " value=""  title="search"   />
        <a href="#" class="abs top-search-a">More Options</a> </div>

    <div class="advsearch w770 rel clearfix">

        <div class="advsearch-bd box rel mb10">
            <div class="advsearch-tit">Find a Job</div>
            <div class="advsearch-min">
                <div class="advsearch-row clearfix">
                    <div class="span1">
                        <strong>Search our job database</strong>
                        <div><input type="text" class="kyo-input input-tip" data-tipval="Enter Keywords" value="Enter Keywords"></div>
                    </div>
                    <div class="span2">
                        <strong>City</strong>
                        <input type="text" id="sel-city" value="" style="display: none;">
                        <div class="search-row-tip">Hold down 'Command' to select a max of 3</div>
                        <div id="sel-city-val" class="show-selval"><ul></ul></div>
                    </div>
                    <div class="span3">
                        <strong>Type of employment</strong>
                        <div>
                            <select class="kyo-select">
                                <option value="0">--Select--</option>
                                <option value="1">value1</option>
                                <option value="2">value2</option>
                                <option value="3">value3</option>
                                <option value="4">value4</option>
                                <option value="5">value5</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="advsearch-row clearfix">
                    <div class="span1">
                        <strong>Industry</strong>
                        <input type="text" id="sel-industry" value="" style="display: none;">
                        <div class="search-row-tip">Hold down 'Command' to select a max of 3</div>
                        <div id="sel-industry-val" class="show-selval"><ul></ul></div>
                    </div>
                    <div class="span2">
                        <strong>Position</strong>
                        <input type="text" id="sel-position" value="" style="display: none;">
                        <div class="search-row-tip">Hold down 'Command' to select a max of 10</div>
                        <div id="sel-position-val" class="show-selval"><ul></ul></div>
                    </div>
                    <div class="span3">
                        <strong>Length of employment</strong>
                        <div>
                            <select class="kyo-select">
                                <option value="0">Start Term</option>
                                <option value="1">value1</option>
                                <option value="2">value2</option>
                                <option value="3">value3</option>
                                <option value="4">value4</option>
                                <option value="5">value5</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="advsearch-below">
                <div class="advsearch-row clearfix">
                    <div class="span1">
                        <strong>Salary </strong>
                        <select class="kyo-select">
                            <option value="0">All Salary</option>
                            <option value="1">value1</option>
                            <option value="2">value2</option>
                            <option value="3">value3</option>
                            <option value="4">value4</option>
                            <option value="5">value5</option>
                        </select>
                    </div>
                    <div class="span2">
                        <strong>Language</strong>
                        <input type="text" id="sel-language" value="" style="display: none;">
                        <div class="search-row-tip">Hold down 'Command' to select a max of 3</div>
                        <div id="sel-language-val" class="show-selval"></div>
                    </div>
                    <div class="span3">
                        <strong>Personal Skills</strong>
                        <input type="text" id="sel-personal" value="" style="display: none;">
                        <div class="search-row-tip">Hold down 'Command' to select a max of 5</div>
                        <div id="sel-personal-val" class="show-selval"></div>

                    </div>
                </div>
                <div class="advsearch-row clearfix">
                    <div class="span1">
                        <strong>Technical Skills</strong>
                        <input type="text" id="sel-technical" value="" style="display: none;">
                        <div class="search-row-tip">Hold down 'Command' to select a max of 5</div>
                        <div id="sel-technical-val" class="show-selval"></div>
                    </div>
                </div>
            </div>
            <div class="adv-search-bar">
                <a href="#" class="text base">Basic Search</a>
                <a href="#" class="text adv">Advanced Search</a>
                <a href="#" class="btn find"></a>
                <a href="#" class="btn findnow"></a>
            </div>
        </div>

    </div>




    <script type="text/javascript" src="<?php echo $theme_path?>js/advsearch.js"></script>
<?php $this->load->view($front_theme.'/footer-block');?>