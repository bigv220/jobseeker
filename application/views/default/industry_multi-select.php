<?php
    $i = 0;
    foreach($userIndustry as $ind) {
    if(++$i == 1) {
        echo '<div class="advsearch-row clearfix" id="one_list">';
    } else {
        echo '<div class="advsearch-row clearfix">';
    }
?>

<div class="span1 long_input">
    <strong>Industry<i class="star">*</i></strong>
    <div class="reg-row">
        <select name="industry[]" onchange="changeIndustry(this, false);"  required>
            <option value="">All Industries</option>
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
</div>
<div class="span2">
    <strong>Position</strong>
    <div class="reg-row">
        <select name="position[]" required>
            <option value="<?php echo $ind['position']; ?>"><?php echo $ind['position']; ?></option>
        </select>
    </div>
</div>

<?php if($i>1) { ?>

<div class="delete">
    <i class="del" onclick="delUserIndustry(this, '<?php echo $ind['id']; ?>');"></i>
</div>

<?php }?>

</div>

<?php } ?>