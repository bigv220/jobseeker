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
	
	$('#basic_submit').click(function() {
		$('#basicForm').validate();
		if ($('#basicForm').valid()) {
			$.post(
				site_url + '/company/register',
				$('#basicForm').serialize(),
            	function(result,status){
                if(status == 'success'){
                    $('#basicForm .reg-area-tit').addClass('reg-area-tit-curr');
                    $('#step1').addClass('curr');
                    alert('Save successful!');
                }
                else{
                    alert('Save failed!');
                }
            }
			);
		}
	});
	$('#contact_submit').click(function() {
		$('#contactForm').validate();
		if ($('#contactForm').valid()) {
			$.post(
				site_url + '/company/register',
				$('#contactForm').serialize(),
            	function(result,status){
                if(status == 'success'){
                    $('#contactForm .reg-area-tit').addClass('reg-area-tit-curr');
                    $('#step2').addClass('curr');
                    alert('Save successful!');
                }
                else{
                    alert('Save failed!');
                }
            }
			);
		}
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
//	$('.reg-save').click(function(){
//		var index=$(this).data('index');
//		// go Verification
//		var ok = Verification(index);
//		if(ok){
//			$('.reg-ul li').eq(index).addClass('curr');
//			$('.reg-area-tit').eq(index).addClass('reg-area-tit-curr');
//		}
//	});
	
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
function saveAll() {
	var basicInfoForm = $('#basicForm');
    basicInfoForm.validate();

    var contactForm = $('#contactForm');
    contactForm.validate();
    if(basicInfoForm.valid() && contactForm.valid()) {
    	$('#basic_submit').click();
    	$('#contact_submit').click();
    }
		

}
// ajax localtion
function change_location(this1, key, location) {
	
	var selected = this1.val();
	var html_option = "";

	if("country" == key) {
		var url = site_url + "jobseeker/ajaxlocation/" + key + "/" + selected;
		$.get(url, function(data){
			var obj = eval('('+data+')');
			for ( var i = 0; i < obj.length; i++) {
				html_option += "<option value='"+obj[i]+"'>"+obj[i]+"</option>";
			}
			$("select[name='province']").html(html_option);
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
		});
	}
	
}
function select_location(key,location) {
	if("country" == key) {
		$("select[name='country']").val(location);

	} else {
		$("select[name='province']").val(location);
		$("select[name='province']").change();
	}
}





