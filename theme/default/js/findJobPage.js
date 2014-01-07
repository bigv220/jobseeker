/**
 * Created with JetBrains PhpStorm.
 * User: sophia
 * Date: 13-11-6
 * Time: 上午10:10
 * To change this template use File | Settings | File Templates.
 */
function addIndustryBtnClick(thisO) {
    var industry_num = $(thisO).prev().val();

    if(industry_num >= 3) {
        alert("The can only add 3 industries.");
        return;
    }

    $(thisO).prev().val(parseInt(industry_num)+1);

    var html = '<div class="advsearch-row clearfix">';
    html += $('#one_list').html();
    html += '<div class="delete">'+
            '<i class="del" onclick="delNewUserIndustry(this);">'+
            '</i></div>';
    html += '</div><div class="list_id_line"><input type="hidden" value="" name="ind_id[]" /></div>';
    $(thisO).parent().parent().before(html);
}

function delUserIndustry(thisO,id) {
    var uid = $('#uid').val();

    $.post(site_url + '/jobseeker/delUserIndustry',
        { id:id },
        function(result,status){
            if(status == 'success'){
            delNewUserIndustry(thisO);
            }
        else{
            alert('Delete failed!');
            }
        });
}

function delNewUserIndustry(thisO) {
    var v = $(thisO).parent().parent().parent().find('input[name="grop_num[]"]').val();
    $(thisO).parent().parent().parent().find('input[name="grop_num[]"]').val(parseInt(v)-1);
    $(thisO).parent().parent().next().remove();
    $(thisO).parent().parent().remove();
}
