$(function(){
	//单选框
	$('input.kyo-radio').each(
		function(index){
			var id=$(this).attr('id');
			var val=($(this).val());
			$('i.kyo-radio[data-id='+id+']').each( function(){
				if($(this).data('val')==val){
					$(this).addClass('kyo-radio-sel');
				}
			})
		}
	)
	$('i.kyo-radio').hover(function(){
		if($(this).hasClass('kyo-radio-sel')){
			$(this).addClass('kyo-radio-sel-hover');
		}else{
			$(this).addClass('kyo-radio-hover');
		}
	},function(){
		$(this).removeClass('kyo-radio-hover');
		$(this).removeClass('kyo-radio-sel-hover');
	}).click(function(){
		var id=$(this).data('id');
		$('#'+id).val($(this).data('val'));
		$('i.kyo-radio[data-id='+id+']').removeClass('kyo-radio-sel');
		$(this).addClass('kyo-radio-sel');
	})
	
	//复	选框
	$('input.kyo-checkbox').each(
		function(index){
			var id=$(this).attr('id');
			var val=($(this).val());
			var arr =val.split(',');		
			for(i in arr){
				$('i.kyo-checkbox[data-id='+id+'][data-val='+arr[i]+']').addClass('kyo-checkbox-sel');							
			}
		}
	)
	$('i.kyo-checkbox').hover(function(){
		if($(this).hasClass('kyo-checkbox-sel')){
			$(this).addClass('kyo-checkbox-sel-hover');
		}else{
			$(this).addClass('kyo-checkbox-hover');
		}
	},function(){
		$(this).removeClass('kyo-checkbox-hover');
		$(this).removeClass('kyo-checkbox-sel-hover');
	}).click(function(){
		if($(this).hasClass('kyo-checkbox-sel')){
			$(this).removeClass('kyo-checkbox-sel');
		}else{
			$(this).addClass('kyo-checkbox-sel');
		}
		var id=$(this).data('id');
		var arr=[];
		$('i.kyo-checkbox[data-id='+id+']').each( function(){
			if($(this).hasClass('kyo-checkbox-sel')){
				arr.push($(this).data('val'));
			}
		})
		$('#'+id).val(arr);
	})
	//开关
	$('input.kyo-switch').each(
		function(){		
			var id=$(this).attr('id');
			var inputobj=$(this);
			var val=($(this).val());
			var switchobj=$('i.kyo-switch[data-id='+id+']');
			var bg =switchobj.find('.kyo-switch-bg');
			var bar = switchobj.find('.kyo-switch-bar');
			if(val=='1'){		
				bar.css({'left':'32px'});
				bg.css({'left':'-68px'});
			}else{		
				bar.css({'left':'1px'});
				bg.css({'lleft':'0px'});
			}
			switchobj.click(function(){
				var _val =inputobj.val();
				if(_val=='1'){		
					bar.stop().animate({'left':'1px'});
					bg.stop().animate({'left':'0px'});
					inputobj.val(0);
				}else{		
					bar.stop().animate({'left':'32px'});
					bg.stop().animate({'left':'-68px'}).css({'left':'-68px'});
					inputobj.val(1);
				}
			})		
		}
	);
	$('i.kyo-switch').hover(function(){
		$(this).addClass('kyo-switch-hover');
	},function(){
		$(this).removeClass('kyo-switch-hover');
	})
	//下拉选择框
})