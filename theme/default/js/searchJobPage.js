/**
 * Created with JetBrains PhpStorm.
 * User: sophia
 * Date: 13-11-6
 * Time: 上午11:25
 * To change this template use File | Settings | File Templates.
 */
$(document).ready(function() {
    $("select[name='country']").change(function() {
        change_location($(this),'country');
    });
    $("select[name='province']").change(function() {
        change_location($(this), 'province');
    });
    $("#PersonalSkills_input").autocomplete("<?PHP echo $site_url; ?>/jobseeker/personalskillsautocomplete",{
        delay:10,
        width: '230px',
        matchSubset:1,
        matchContains:1,
        cacheLength:10,
        onItemSelect:selectItem1,
        formatItem: formatItem,
        formatResult: formatResult
    });

    $("#ProfessionalSkills_input").autocomplete("<?PHP echo $site_url; ?>/jobseeker/professionalskillsautocomplete",{
        delay:10,
        width: '230px',
        matchSubset:1,
        matchContains:1,
        cacheLength:10,
        onItemSelect:selectItem2,
        formatItem: formatItem,
        formatResult: formatResult
    });

    initialize();
    codeAddress();
});

// change industry
function changeIndustry(thisO) {
    var name = $(thisO).val();
    $.post(site_url + '/jobseeker/ajaxchangeindustry',
        { ind_name: name },
        function(result,status) {
            var position_htm = '<option value="">Position</option>';

            if(status == 'success'){
                var obj = eval('('+result+')');
                for ( var i = 0; i < obj.data.length; i++) {
                    position_htm += "<option value=\""+obj.data[i].name+"\">"+obj.data[i].name+"</option>";
                }
            }
            $(thisO).parent().parent().next().find('select').html(position_htm);
        });
}

function addIndustryBtnClick(thisO) {
    var num = $('select[name="industry[]"]').length;

    if(num >= 3) {
        alert("The can only add 3 industries.");
        return;
    }
    var html = $('#industry_list').html();
    html += '<div class="delSearchIndustry"><i class="del" onclick="delNewUserIndustry(this);"></i></div>';
    $(thisO).parent().parent().before(html);
}

function delNewUserIndustry(thisO) {
    $(thisO).parent().prev().remove();
    $(thisO).parent().prev().remove();
    $(thisO).parent().remove();
}

var map;
var geocoder = new google.maps.Geocoder();
function initialize() {
    var myOptions = {
        zoom : 13,
        center : new google.maps.LatLng(-34.397, 150.644),
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.SMALL,
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