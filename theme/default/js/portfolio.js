function showContentOfPortfolio(name, desc, type, file_url){
    $('.view_portfolio_header h1').html(name);
    $('.view_portfolio_header p').html(desc);
    var filenames = file_url.split(".");
    var extension = filenames[filenames.length - 1];
    $('.text_style').hide();
    $('.audio_style').hide();
    $('.image_style').hide();
    $('.other_text_style').hide();
    if(type == 0){//text type files, includes txt, pdf, ppt,pptx,xls
        if(extension == 'txt'){//show content of txt file
            $('.text_style .content_text').html("Loading content...");
            $('.text_style').show();
            //load TXT file content from server
            var file_path = './' + file_url.substring(file_url.indexOf('attached'));
            $.post(site_url + '/jobseeker/readPortfolioTextFileContent',
                {file_path:file_path},
                function(result, status){
                    result = eval('(' + result + ')');
                    $('.text_style .content_text').html(result.content);
                });

        }
        else{//allow user to download other kinds of text type files
            $('.other_text_style .other_text_content a').attr('href', file_url);
            $('.other_text_style').show();
        }
    }
    else if(type == 1){//show image file directly
        $('.content_img img').attr('src', file_url);
        $('.image_style').show();
    }
    else if(type == 2){//play audio file

        $("#jquery_jplayer_1").jPlayer({
            ready: function (event) {
                $(this).jPlayer("setMedia", {
                    mp3:file_url
                });
            },
            swfPath: "js",
            supplied: "mp3",
            wmode: "window",
            smoothPlayBar: true,
            keyEnabled: true
        });
        $('.audio_style').show();
    }
    else if(type == 3){//play video file
        $('.audio_style').show();
    }
    else{
        $('.other_text_style .other_text_content a').attr('href', file_url);
        $('.other_text_style').show();
    }
}

function recreatePortfolioList(portfolio_projects){
    var htmltext = "";
    var navigatorBarHtml = "";
    var portfolioMgmtListHtml = "";

    if(portfolio_projects.length > 0){
        for(var i = 0, len = portfolio_projects.length; i < len; i++){
            if(i%6 == 0){
                htmltext += '<div class="als-item">';
            }
            if(i%3 == 0){
                htmltext += '<div class="portfolio_row">';
            }
            var itemParameterStr = 'project-name="' + portfolio_projects[i]['name']
                + '" project-description="' + portfolio_projects[i]['description']
                + '" project-id="' + portfolio_projects[i]['pid']
                + '" file-type="' + portfolio_projects[i]['type']
                + '" file-url="' + site_url + 'attached/workExamples/' + portfolio_projects[i]['file_url'] + '">';

            htmltext = htmltext + '<a href="javascript:void(0);" class="portfolio_item" ' + itemParameterStr;
            navigatorBarHtml = navigatorBarHtml + '<li class="als-item" ';
            portfolioMgmtListHtml = portfolioMgmtListHtml + "<li><span>" + portfolio_projects[i]['name'] + "</span><img project-id=''"
                + portfolio_projects[i]['pid'] + "'  project-file='"
                + portfolio_projects[i]['file_url'] + "' "
                + 'class="delete_portfolio_project" src="' + theme_url + 'style/btns/btn_inbox_multi_delete_off.png"></li>';

            var imgHtml = "";
            switch(portfolio_projects[i]['type']){
                case 0:
                    imgHtml = "<img src='" + theme_url + "/style/portfolio/portfolio_text_file.png" + "'/>";
                    break;
                case 1:
                    imgHtml = "<img src='" + site_url + "attached/workExamples/" .$portfolio_projects[i]['file_url']  +"'/>";
                    break;
                case 2:
                    imgHtml = "<img src='" + theme_url + "/style/portfolio/portfolio_audio_file.png" +"'/>";
                    break;
                case 3:
                    imgHtml = "<img src='" + theme_url + "/style/portfolio/portfolio_audio_file.png" +"'/>";
                    break;
                case 4:
                    imgHtml = "<img src='" + theme_url + "/style/portfolio/portfolio_text_file.png" +"'/>";
                    break;
                default:
                    imgHtml = "<img src='" + theme_url + "/style/portfolio/portfolio_text_file.png" +"'/>";
                    break;
            }
            htmltext = htmltext + imgHtml + '<div class="portfolio_caption"><span>' + portfolio_projects[i]['name'] + '</span></div></a>';
            navigatorBarHtml = navigatorBarHtml + imgHtml + "</li>";
            if(i%3==2 || i == len - 1){
                htmltext+= '<div style="clear:both;"></div></div>';//<!-- end of portfolio_row -->
            }
            if(i%6==5 || i == len - 1){
                htmltext+= "</div>";//<!-- end of als-item -->
            }
        }
        $('#portfolio_list .profile_portfolios').html(htmltext);
        $("#portfolio_list").als({
            circular: "no",
            //autoscroll: "yes",
            visible_items: 1
        });

        $('#portfolio_view_bar').html(navigatorBarHtml);
        $("#portfolio_view_bar").als({
            circular: "no",
            autoscroll: "no",
            scrolling_items: 1,
            visible_items: 6
        });

        $('.portfolio_list ul').html(portfolioMgmtListHtml);
    }
    else{
        $('#portfolio_list .profile_portfolios').html("No Projects in Portfolio.");
    }
}

function deletePortfolioProject(project_id, file){
    $.post(site_url + 'jobseeker/deletePortfolioProject',
        {pid:project_id,file:file,uid:current_login_user_id},
        function(result, status){
            result = eval('(' + result + ')');
            if(result.status == 'success'){
                alert("This project has been deleted.");
                //we should re-create the portfolio list here to keep the list structure
                recreatePortfolioList(result.portfolio_projects);
            }
        });
}

$(function(){
    //Pop mark
    var popMark =$('.pop-mark'),
        popViewPortfolio = $('.view_portfolio_pop');

    function openPortfolioDetails(){
        var clicked_project_id = $(this).attr('project-id');
        var clicked_project_type = $(this).attr('file-type');
        var clicked_project_name = $(this).attr('project-name');
        var clicked_project_desc = $(this).attr('project-description');
        var file_url = $(this).attr('file-url');

        $('#portfolio_view_bar ul li').each(function(){
            var current_project_id = $(this).attr('project-id');
            if(clicked_project_id == current_project_id){
                $(this).children("img").addClass('current');
            }
            else
                $(this).children("img").removeClass('current');
        });
        //load content for portfolio pop view
        showContentOfPortfolio(clicked_project_name, clicked_project_desc, clicked_project_type, file_url);
        popMark.fadeIn();
        popViewPortfolio.fadeIn();
    }

    $('.portfolio_item').click(openPortfolioDetails);
    $('#portfolio_view_bar ul li').click(openPortfolioDetails);

    $('.view_portfolio_pop_close').click(function(){
        popMark.fadeOut();
        popViewPortfolio.fadeOut();
    });

    $('.delete_portfolio_project').click(function(){
        var project_id = $(this).attr('project-id');
        var file = $(this).attr('project-file');
        alert(project_id);
        deletePortfolioProject(project_id, file);
    });

    $('.add_portfolio_project_btn').click(function(){
        var projectName = $('#project_name').val();
        var projectDesc = $('#project_desc').val();
        var portfolioFileName = $('#portfolio_file_name').val();
        var type = getUploadedFileType(portfolioFileName);

        $.post(site_url + '/jobseeker/addPortfolioProject',
            {name:projectName, description:projectDesc, file_url:portfolioFileName, type:type,uid:current_login_user_id},
            function(result, status){
                result = eval('(' + result + ')');
                $('#project_name').val('');
                $('#project_desc').val('');
                //we should re-create the portfolio list here to keep the list structure
                recreatePortfolioList(result.portfolio_projects);
            });
    });

    $('.font_zoom_bar .zoom_in').click(function(){
        var currentFontSize = $('.text_style .content_text').css('font-size');
        currentFontSize = parseInt(currentFontSize);
        $('.text_style .content_text').css('font-size',++currentFontSize + 'px');
    });

    $('.font_zoom_bar .zoom_out').click(function(){
        var currentFontSize = $('.text_style .content_text').css('font-size');
        currentFontSize = parseInt(currentFontSize);
        $('.text_style .content_text').css('font-size',--currentFontSize + 'px');
    });

    $('.edit_portfolio_link').click(function(){
        popMark.fadeIn();
        $('.edit_portfolio_pop').fadeIn();
    });

    $('.edit_portfolio_pop_close').click(function(){
        popMark.fadeOut();
        $('.edit_portfolio_pop').fadeOut();
    });

})