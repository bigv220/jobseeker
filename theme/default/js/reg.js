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
	if($('#reg-rndustry').length>0){
    $('#reg-rndustry').checkSelect({
        text:'Plase select rndustry',
        data:[
            {title:'value1',value:'1'},
            {title:'value2',value:'2'},
            {title:'value3',value:'3'},
            {title:'value4',value:'4'},
            {title:'value5',value:'5'},
            {title:'value6',value:'6'},
            {title:'value7',value:'7'},
            {title:'value8',value:'8'},
            {title:'value9',value:'9'},
            {title:'value10',value:'10'},
            {title:'value11',value:'11'},
            {title:'value12',value:'12'},
            {title:'value13',value:'13'}
        ],
        showDiv:$('#reg-rndustry-val'),
        width:230,
        height:26,
        max:3,
        ismax:function(){alert('max 3!!!')}
    });
	
	}
	
	//sel-industry
	if($('#reg-Network').length>0){
		$('#reg-Network').checkSelect({
			text:'Plase select network',
			data:[
				{title:'value1',value:'1'},
				{title:'value2',value:'2'},
				{title:'value3',value:'3'},
				{title:'value4',value:'4'},
				{title:'value5',value:'5'},
				{title:'value6',value:'6'}
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