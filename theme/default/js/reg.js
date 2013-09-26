$(function(){
	//search-result sequence
    $('.kyo-select').kyoSelect({
        width:'230',
        height:'25'
    });
	
	//reg user
	$('.birthday-select').kyoSelect({
        width:'130',
        height:'25'
    });
	
	
	//sel-industry
	if($('#reg-industry').length>0){
    $('#reg-industry').checkSelect({
        text:'Please select industry',
        data:[
          {title:'Accounting',value:'Accounting'},
          {title:'HR',value:'HR'},
          {title:'Finance',value:'Finance'},
          {title:'Design',value:'Design'},
          {title:'Education',value:'Education'}
        ],
        showDiv:$('#reg-industry-val'),
        width:230,
        height:26,
        max:100,
        ismax:function(){alert('max 100.')}
    });
	
	}
	 
	//sel-industry
	if($('#reg-Network').length>0){
		$('#reg-Network').checkSelect({
			text:'Please select network',
			data:[
				{title:'Twitter',value:'Twitter'},
				{title:'Facebook',value:'Facebook'},
				{title:'Pinterest',value:'Pinterest'},
				{title:'WeChat',value:'WeChat'}
			],
			showDiv:$('#reg-network-val'),
			width:230,
			height:26,
			max:10,
			ismax:function(){alert('max 10!!!')}
		});
	
	}
	
	//click save
	$('.reg-save').click(function(){
		var index=$(this).data('index');
		// go Verification
		var ok = Verification(index);
		if(ok){
			$('.reg-ul li').eq(index).addClass('curr');
			$('.reg-area-tit').eq(index).addClass('reg-area-tit-curr');
		}
	});
	
	function Verification(index){
		switch (index){
			case 0:{
				return true;
				break;
			}
			case 1:{
				return true;
				break;
			}
		}
		return true;
	}


	//left area float
	var leftArea = $('.reg-left'),
		leftAreaTop = leftArea.offset().top;
		$(window).scroll(function () {
			var Wtop = $(window).scrollTop();
			leftArea.stop().animate({top:Wtop},500);
  		});
	
	
	
	 //gotop
    $('.backtop').fxBacktop();



	
	















})



// ajax localtion
function change_location(o) {
	var key = $(o).parent().parent().prev("select").attr("name");
	var selected = $(o).html();
	var html_option = "";

	if("country" == key) {
		var url = site_url + "jobseeker/ajaxlocation/" + key + "/" + selected;
		$.get(url, function(data){
			var obj = eval('('+data+')');
			for ( var i = 0; i < obj.length; i++) {
				html_option += "<option value='"+obj[i]+"'>"+obj[i]+"</option>";
			}
			$("select[name='province']").html(html_option);
			$("select[name='province']").next(".kyo-select").remove();
			$("select[name='province']").kyoSelect({
		        width:'145',
		        height:'25'
		    });
		});
	}
	
	if("province" == key) {
		var country = $("select[name='country']").val();
		var url = site_url + "jobseeker/ajaxlocation/" + key + "/" + selected + "/" + country;
		$.get(url, function(data){
			var obj = eval('('+data+')');
			for ( var i = 0; i < obj.length; i++) {
				html_option += "<option value='"+obj[i]+"'>"+obj[i]+"</option>";
			}
			$("select[name='city']").html(html_option);
			$("select[name='city']").next(".kyo-select").remove();
			$("select[name='city']").kyoSelect({
		        width:'145',
		        height:'25'
		    });
		});
	}
	
}






