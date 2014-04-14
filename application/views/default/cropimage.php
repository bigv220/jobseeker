<!-- JQuery Image Crop librray and its css file.<script type="text/javascript" src="<?php echo $theme_path?>js/jslib/jquery-1.7.2.min.js" ></script> -->

<!--<script src="cropimage/jquery.imgareaselect.min.js" type="text/javascript"></script>-->
<script src="<?php echo $theme_path?>cropimage/jquery.imgareaselect.js" type="text/javascript"></script>
<link href="<?php echo $theme_path?>cropimage/imgareaselect-default.css" rel="stylesheet" type="text/css" />

<!-- Facebox PopUp file to get the CLOSE function working automatically. -->
<script src="<?php echo $theme_path?>cropimage/facebox.js" type="text/javascript"></script>

<?php
//Only display the javacript if an image has been uploaded
$current_large_image_width  =   $crop['current_large_image_width'];
$current_large_image_height =   $crop['current_large_image_height'];
?>
<script type="text/javascript">

/**
 * Shows Preview of the IMAGE (which is already resized to fit on this window from parent AJAX UPLAOD page -->
 */
function preview(img, selection) 
{
	var scaleX = <?php echo $crop['thumb_width'];?> / selection.width; 
	var scaleY = <?php echo $crop['thumb_height'];?> / selection.height; 
	
	$('#thumbnail + div > img').css({ 
		width: Math.round(scaleX * <?php echo $current_large_image_width;?>) + 'px', 
		height: Math.round(scaleY * <?php echo $current_large_image_height;?>) + 'px',
		marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px', 
		marginTop: '-' + Math.round(scaleY * selection.y1) + 'px' 
	});
	
	
	//change the size of the image inside selection arear w.r.t. size of selection area
	var height = $('.imgareaselect-selection').height();
	var width = $('.imgareaselect-selection').width();
	$('.imgareaselect-selection').find('img').css({width: width, height: height});
} 


/**
 * Style the selection area
 */
function styleSelectionArea(img, selection)
{
	var height = $('.imgareaselect-selection').height();
	var width = $('.imgareaselect-selection').width();
	var imgUrl = "<?php echo $theme_path?>cropimage/bounding_box.png";
	var $img = $('<img>', { width : width, height : height, src : imgUrl });
	$img.load(function(){
		$('.imgareaselect-selection').html($img);
		
	});
	
	$('#x1').val(selection.x1);
	$('#y1').val(selection.y1);
	$('#x2').val(selection.x2);
	$('#y2').val(selection.y2);
	$('#w').val(selection.width);
	$('#h').val(selection.height);
}

$(document).ready(function () { 
	/**
         * Handling the THUMBNAIL SAVE action. Check whether it selected or shows the alert message.
         * if selected, then generate image based on the image attributes selected using ajax.
         * Close the facebox popup and trigger parent function to show the preview image.
         */
        $('#save_thumb').click(function() {
		var x1 = $('#x1').val();
		var y1 = $('#y1').val();
		var x2 = $('#x2').val();
		var y2 = $('#y2').val();
		var w = $('#w').val();
		var h = $('#h').val();
		if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h==""){
			alert("You must make a selection first");
			return false;
		}
                else
                {                            
                    $("#save_status").show();
                    $("#save_status").html('Please wait while croping image...');
                    dataString = $("#thumbnail_form").serialize();
                    $.ajax({
                    type: "POST",
                    url: "<?php echo $site_url?>user/cropimagesave",
                    data: dataString,
                    dataType: "json",
                    success: function(data){
                                if(data.status == "error")
                                {    
                                    $("#save_status").html(data.message); 
                                } 
                                else if(data.status == "success")
                                {   
                                    // Trigger close
                                    $(document).trigger('close.facebox');
                                    // Call Parent Page function.
                                    thumbnailPreview(data.thumb_image_name_with_ext);
                                }
                            }
                    });      
		}
	});

        // Invoke Crop Image function.
	
	
	$('#thumbnail').load(function(){
		
		//calculate the positions of the selection box
		var imgWidth = <?=$crop['current_large_image_width'];?>,
		    imgHeight = <?=$crop['current_large_image_height'];?>;
		if(imgWidth > imgHeight)
		{
			var fix = imgHeight;
			var a = fix / 5;
			var b = (imgWidth - (fix - (2 * a))) / 2;
			
			var X1 = parseInt(b),
			Y1 = parseInt(a),
			X2 = parseInt(imgWidth - b),
			Y2 = parseInt(fix - a);
		}
		else if(imgWidth < imgHeight)
		{
			var fix = imgWidth;
			var a = fix / 5;
			var b = (imgHeight - (fix - (2 * a))) / 2;
			
			var X1 = parseInt(a),
			Y1 = parseInt(b),
			X2 = parseInt(fix - a),
			Y2 = parseInt(imgHeight - b);
		}
		else
		{
			var fix = imgWidth;
			var a = fix / 5;
			var b = (imgHeight - (fix - (2 * a))) / 2;
			
			var X1 = parseInt(a),
			Y1 = parseInt(b),
			X2 = parseInt(fix - a),
			Y2 = parseInt(imgHeight - b);
		}
		
		
		
		$('#thumbnail').imgAreaSelect({
			x1: X1,
			y1: Y1,
			x2: X2,
			y2: Y2,
			imageHeight: <?=$crop['current_large_image_height'];?>,
			imageWidth: <?=$crop['current_large_image_width'];?>,
			show: true,
			aspectRatio: '1:<?php echo $crop['thumb_height']/$crop['thumb_width'];?>',
			onInit: styleSelectionArea,
			onSelectChange: preview,
			onSelectEnd: function (img, selection) {
				$('#x1').val(selection.x1);
				$('#y1').val(selection.y1);
				$('#x2').val(selection.x2);
				$('#y2').val(selection.y2);
				$('#w').val(selection.width);
				$('#h').val(selection.height);           
			}
			
		}); 
	});
	
	 
        
}); 
</script>

<div style="text-align:center;"><b>Select an area from the image below for your thumbnail.</b></div>
<div align="center" style="text-align:center;">        
<img src="<?php echo $site_url?><?php echo $crop['image_path'];?>" id="thumbnail" alt="Create Thumbnail" />

<div align="center" style="display:none;border:1px #e5e5e5 solid; padding-top: 3px; float:left; position:relative; overflow:hidden; width:<?php echo $crop['thumb_width'];?>px; height:<?php echo $crop['thumb_height'];?>px;"><img src="<?php echo $site_url?><?php echo $crop['image_path'];?>" style="position: relative;" alt="Thumbnail Preview" /></div>          


        <br style="clear:both;"/>
        <form name="thumbnail" action="" method="post" id="thumbnail_form">
                <input type="hidden" name="x1" value="" id="x1" />
                <input type="hidden" name="y1" value="" id="y1" />
                <input type="hidden" name="x2" value="" id="x2" />
                <input type="hidden" name="y2" value="" id="y2" />
                <input type="hidden" name="w" value="" id="w" />
                <input type="hidden" name="h" value="" id="h" />
                <input type="button" name="upload_thumbnail" value="" id="save_thumb" class="btn_crop_button" />
                <p style="display: none;" id="save_status"></p>
        </form>
</div>
