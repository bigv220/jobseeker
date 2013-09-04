$(function(){
	//search-result sequence
    $('.reg-page .kyo-select').kyoSelect({
        width:'230',
        height:'25'
    });
    //sel-industry
    $('#reg-industry').checkSelect({
        text:'Please select industry',
        data:[
            {title:'Accounting',value:'Accounting'},
            {title:'HR',value:'HR'},
            {title:'Finance',value:'Finance'},
            {title:'Design',value:'Design'},
            {title:'Education',value:'Education'}
        ],
        showDiv:$('#reg-rndustry-val'),
        width:230,
        height:26,
        ismax:function(){alert('max 3!!!')}
    });


	//sel-industry
    $('#reg-Network').checkSelect({
        text:'Please select network',
        data:[
            {title:'Facebook',value:'Facebook'},
            {title:'QQ',value:'QQ'},
            {title:'Yelp',value:'Yelp'},
            {title:'Foursquare',value:'Foursquare'}
        ],
        showDiv:$('#reg-network-val'),
        width:230,
        height:26,
        max:10,
        ismax:function(){alert('max 10!!!')}
    });


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
	}


	//left area float
	var leftArea = $('.reg-left'),
		leftAreaTop = leftArea.offset().top;
	$(window).scroll(function () {
			var Wtop = $(window).scrollTop();
			leftArea.stop().animate({top:Wtop},500);
   });




})