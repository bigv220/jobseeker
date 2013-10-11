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
//		if($(this).hasClass('kyo-checkbox-sel')){
//			$(this).removeClass('kyo-checkbox-sel');
//		}else{
//			$(this).addClass('kyo-checkbox-sel');
//		}
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
				bg.css({'left':'0px'});
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
	});
	
	//下拉选择框
	jQuery.fn.extend({
	kyoSelect:function(opt){
		return this.each(function() {
			var t = $(this),
				option = t.find('option'),
				isselect = true,
				width,
				height;
			t.hide().after($('<div class="kyo-select"><div class="kyo-select-val"></div><dl class="kyo-select-list"></dd></dl></div>'));
			width  = opt.width ?  opt.width : 150;
			height = opt.height ?  opt.height : 26;

			//模拟下拉框
			var l = t.next(),
				show = l.find('.kyo-select-val'),
				list = l.find('.kyo-select-list'),
				listHtml='';

			//初始化赋值
			option.each(function(i){
				listHtml += '<dd data-val="'+$(this).val()+'" data-index="'+ i +'">'+$(this).text()+'</dd>';
				if($(this).attr('selected')=='selected'){
					show.html($(this).text())
				}
			});
			
			//显示值的div			
			show.css({'height':height,'line-height':height+'px'});
			
			//外框处理
			l.css({'width':opt.width,'height':opt.height})
			.click(function(e){
				var status = "";
				if(list.is(":visible")==false)
					status = "none";
				else
					status = "block";

            	$('.kyo-select-list').hide();
            	$('.fx-checkselect-list').hide();
            	list.css('display',status);
                $('.fx-checkselect').css({'z-index':11});
            	$('.kyo-select').css({'z-index':11});

				if(list.css('display') == 'none') {
					 	list.show();
						$(this).css({'z-index':12});
					}
					 else{ 
					 	list.hide();
						$(this).css({'z-index':10});
					};
				
				e.stopPropagation();
            	e.preventDefault();
			})
			.mouseover(function(){
				$(this).addClass('kyo-select-hover');
				isselect = true;
			})
			.mouseout(function(){
				$(this).removeClass('kyo-select-hover');
				isselect = false;
			});
			//列表处理
			list.html(listHtml).hide()
			.css({'top':height+'px','width':width})
			.find('dd')
			.mouseover(function(){
				$(this).addClass('kyo-select-list-hover');
			})
			.mouseout(function(){
				$(this).removeClass('kyo-select-list-hover');
			})
			.click(function(){
				//change_location(this); // trigger an event when the select changed. fun in reg.js
				l.css({'z-index':12});
				isselect = true;
				show.text($(this).text());
				var index= $(this).data('index');
				option.eq(index).attr('selected','selected').siblings().removeAttr('selected');
			});
			$(document).click(function(){
				isselect == false && list.hide();
				l.css({'z-index':10});
			})
		})
	},
	
	//多选下拉框-------------------------------------------------------------
	checkSelect:function(opt){
		var t =  $(this),
			input =t,
			text = opt.text || '',
			data = opt.data,
			showDiv = opt.showDiv,
			width = opt.width || 160,
			height = opt.height || 22,
			max = opt.max || 3,
			ismax = opt.ismax;

		//Input框隐藏
		t.hide();

		//模拟下拉选择框
		$('<div class="fx-checkselect"></div>')
		.html('<div class="fx-checkselect-arr"></div><dl class="fx-checkselect-list"></dl>')
		.css({position:'relative'})
		.insertAfter(t);
		var pop = t.next();
			pop.css({'width':width});
		var arr = pop.find('.fx-checkselect-arr')
			.css({'height':height,'line-height':height+'px'})
			.text(text);
		var dl = pop.find('.fx-checkselect-list')
			.hide()
			.css({position:'absolute',top:height,left:0,'width':width-2});

		arr.bind('click',function(e){
			var status = "";
			if(dl.is(":visible")==false)
				status = "none";
			else
				status = "block";

            $('.kyo-select-list').hide();
            $('.fx-checkselect-list').hide();
            dl.css('display',status);
            $('.fx-checkselect').css({'z-index':11});
            $('.kyo-select').css({'z-index':11});
			var vv = dl.css('display');
			
			var ddLength = dl.find('dd').length;
			
			if(vv=='none' && ddLength > 0){
				dl.show();	
				pop.css({'z-index':12});
			}
			else{
				dl.hide();	
				pop.css({'z-index':10});
			}
			e.stopPropagation();
            e.preventDefault();
			
		});


		$('html').bind('click',function(){
			dl.hide();
			pop.css({'z-index':10});
		})

		//初始化赋值
		showSelect();

		//显示已经选择的值
		function showSelect(){
			var div1 = $('<div><ul></ul></div>');
			var div2 = $('<dl></dl>');
			$.each(data,function(index,d){			
				if(isVal(d.title)){
					$('<li></li>')
					.text(d.title)
					.append('<i class="del"></i>')
					.attr('data-val',d.title)
					.appendTo(div1.find('ul'));
				}else{
					$('<dd></dd>')
					.text(d.title)
					.addClass('add')
					.attr('data-val',d.title)
					.appendTo(div2);
				};	
			})
			showDiv.html(div1.html());
			dl.html(div2.html());
		
			//删除一已经选中的值
			showDiv.find('.del').bind('click',function(){
				var val = $(this).parent('li').data('val');
				delVal(val);
			});
			hover(showDiv.find('.del'));

			//增加加一条选中
			dl.find('.add').bind('click',function(){
				var val = $(this).data('val');
				addVal(val);
			});
			hover(dl.find('.add'));
		}

		//判断这个值是否在input里面
		function isVal(val){
			var inputVals = input.val().split(',');
			var back = false;
			for(var i = 0, iLeng = inputVals.length; i<iLeng; i++){
				if(val===inputVals[i]) back = true;
			}
			return back;
		}

		//移过加css
		function hover(obj){
			obj.bind('mouseover',function(){
				$(this).addClass('hover');
			}).bind('mouseout',function(){
				$(this).removeClass('hover');
			});	
		}

		//添加方法
		function addVal(val){
			var arr = input.val() ? input.val().split(',') :[];
			if(arr.length < max)
			{
				arr.push(val);
				input.val(arr);
				showSelect();
			}else{
				ismax();
			}
		}

		//删除方法
		function delVal(val){
			var arr = [];
			var inputVals = input.val().split(',');
			for(var i = 0, iLeng = inputVals.length; i<iLeng; i++){
				if (inputVals[i] != val){
					arr.push(inputVals[i])
				}
			}
			input.val(arr);
			showSelect();
		}
	}
	
	
	
});

	
	
})