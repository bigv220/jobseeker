<script type="text/javascript">
    function addIndustryBtnClick(thisO) {
        var industry_num = $(thisO).parent().prev().val();

        if(industry_num >= 3) {
            alert("The can only add 3 industries.");
            return;
        }

        $(thisO).parent().prev().val(parseInt(industry_num)+1);

        var html = $('#industry_list').html();
        html += '<span class="delSeekingIndustry"><i class="del" onclick="delNewUserIndustry(this);" style="top:30px;left:5px;"></i></span>';
        $(thisO).parent().parent().before(html);
    }

    function delUserIndustry(thisO,id) {
        var uid = $('#uid').val();

        $.post(site_url + '/jobseeker/delUserIndustry',
            {id:id},
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
        var v = $(thisO).parent().parent().find('input[name="grop_num[]"]').val();
        $(thisO).parent().parent().find('input[name="grop_num[]"]').val(parseInt(v)-1);

        $(thisO).parent().prev().remove();
        $(thisO).parent().prev().remove();
        $(thisO).parent().remove();
    }
</script>

<?php
    $i = 0;
    foreach($userIndustry as $ind):
    $i++;
    if($i == 1) echo '<div id="industry_list">';
?>

<div class="reg-row" style="clear:both;float:left;width:240px;">
    <strong>Industry<i class="star">*</i></strong><br />
    <select name="industry[]" id="industry_11" onchange="changeIndustry(this, false);"  required>
        <option value="">All industries</option>
        <?php
        foreach($industry as $v) {
            $str = '';
            if($v['name'] == $ind['industry']) {
                $str = ' selected="selected"';
            }
            ?>
            <option value="<?php echo $v['name']; ?>"<?php echo $str; ?>><?php echo $v['name']; ?></option>
            <?php } ?>
    </select>
</div>
<div class="reg-row" style="float:left;width:220px;">
    <strong>Position</strong><br />
    <select name="position[]" id="position_11" required>
        <option value="<?php echo $ind['position']; ?>"><?php echo $ind['position']; ?></option>
    </select>
</div>

<?php if($i==1) echo "</div>"; ?>
<?php if($i>1) { ?>
    <span class="delSeekingIndustry">
        <i class="del" onclick="delUserIndustry(this, '<?php echo $ind['id']; ?>');" style="top:30px;left:5px;"></i>
    </span>
<?php }?>

<?php endforeach;?>