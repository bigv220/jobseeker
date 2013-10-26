$(function(){
	 //adv search city
	 
	if($('#sel-city').length>0){
		$('#sel-city').checkSelect({
			text:'City',
			data:[
				{title:'value1',value:'1'},
				{title:'value2',value:'2'},
				{title:'value3',value:'3'},
				{title:'value4',value:'4'}
			],
			showDiv:$('#sel-city-val'),
			width:230,
			height:26,
			max:3,
			ismax:function(){alert('max 3!!!')}
		});
	};
	
	//adv search industry
	if($('#sel-industry').length>0){
		$('#sel-industry').checkSelect({
			text:'All Industry',
			data:[
				{title:'value1',value:'1'},
				{title:'value2',value:'2'},
				{title:'value3',value:'3'},
				{title:'value4',value:'4'}
			],
			showDiv:$('#sel-industry-val'),
			width:230,
			height:26,
			max:3,
			ismax:function(){alert('max 3!!!')}
		});
	};
	
	//adv search position
	if($('#sel-position').length>0){
		$('#sel-position').checkSelect({
			text:'All Position',
			data:[
				{title:'Employee',value:'1'},
				{title:'Manager',value:'2'},
				{title:'Director',value:'3'}
			],
			showDiv:$('#sel-position-val'),
			width:230,
			height:26,
			max:10,
			ismax:function(){alert('max 10!!!')}
		});
	};
	
	//adv search language
	if($('#sel-language').length>0){
		$('#sel-language').checkSelect({
			text:'All Languages',
			data:[
				{title:'value1',value:'1'},
				{title:'value2',value:'2'},
				{title:'value3',value:'3'},
				{title:'value4',value:'4'}
			],
			showDiv:$('#sel-language-val'),
			width:230,
			height:26,
			max:3,
			ismax:function(){alert('max 3!!!')}
		});
	};
	
	//adv search personal
	if($('#sel-personal').length>0){
		$('#sel-personal').checkSelect({
			text:'Start Typing',
			data:[
				{title:'value1',value:'1'},
				{title:'value2',value:'2'},
				{title:'value3',value:'3'},
				{title:'value4',value:'4'}
			],
			showDiv:$('#sel-personal-val'),
			width:230,
			height:26,
			max:3,
			ismax:function(){alert('max 3!!!')}
		});
	};
	//adv search personal
	if($('#sel-technical').length>0){
		$('#sel-technical').checkSelect({
			text:'Start Typing',
			data:[
				{title:'value5',value:'5'},
				{title:'value6',value:'6'},
				{title:'value7',value:'7'},
				{title:'value8',value:'8'},
				{title:'value9',value:'9'},
				{title:'value10',value:'10'}
			],
			showDiv:$('#sel-technical-val'),
			width:230,
			height:26,
			max:5,
			ismax:function(){alert('max 5!!!')}
		});
	};
	
	
	//adv-select
    if($('.kyo-select').length>0){
		$('.kyo-select').kyoSelect({
			width:'228',
			height:'25'
		});
	};
	
	
	//adv-search-bar  job
	var below = $('.advsearch-below'),
		advbar = $('.adv-search-bar'),
		textbase = advbar.find('.base'),
		textadv = advbar.find('.adv'),
		btnfind = advbar.find('.find'),
		btnfindnow = advbar.find('.findnow');
	
	textadv.click(function(){
		below.slideDown();
		textadv.hide();
		textbase.show().css({display:'inline-block'});
		btnfind.hide();
		btnfindnow.show().css({display:'inline-block'});
	});
	textbase.click(function(){
		below.slideUp();
		textbase.hide();
		textadv.show().css({display:'inline-block'});
		btnfindnow.hide();
		btnfind.show().css({display:'inline-block'});
	})
	
	//adv-search-bar  seekers
	
	
	//sponsors rool
	if($('.com-roll').length>0){
		$('.com-roll').roll({
			box:{
				width:990,   //整块的宽
				height:97,   //整块的高
				hspace:125    //两边空的间距
			},
			item:{
				width:187,    //小块的宽
				height:69,   //小块的高
				mr:0        //左边空的间距
			},
			speed:600       //滚动速度      
		});
	};
	

})