		$(document).ready(function(){
			var left = -100;
			$('#slider_container').find('img').each(function(){
				$(this).css({left: left+'%'});
				if(left == -100)
				{
					$(this).addClass('current');
				}
				
				left = left - 100;
			});
			$("#fader > div:gt(0)").hide();
			$("#fader > div:first").addClass('currentBg');
			initSlider();
			swapImage('in', 'LTR');
			
			$('#nav-back').click(function() {
				$('#fader > div:first').clearQueue();
				clearInterval(fadeVar);
				mainSlider('RTL');
				initSlider();
			});
			$('#nav-next').click(function() {
				$('#fader > div:last').clearQueue();
				clearInterval(fadeVar);
				mainSlider('LTR');
				initSlider();
			});
			
			
		});
		var fadeVar;
		var timeoutVar;
		var fadeHandle;
		function initSlider()
		{
			fadeVar=setInterval(function() {
				mainSlider('LTR');
			}, 12000);
		}
		function mainSlider(direction)
		{
			if(direction == 'RTL')
			{
				var el = $('#fader .currentBg');
				if($( "#fader > div:first" ).hasClass('currentBg'))
				{
					$( "#fader > div:last" ).insertAfter('#fader_placeholder');
				}
				el.fadeOut({
					duration: 2000,
					start:function(){
						swapImage('out', direction);
					}
				})
				.removeClass('currentBg')
				.prev()
				.addClass('currentBg')
				.fadeIn({
					duration: 2000,
					start:function(){
						swapImage('in', direction);
					}
				})
				.end();
			}
			else if(direction == 'LTR')
			{
				var el = $('#fader .currentBg');
				if(el.is(":last-child"))
				{
					$( "#fader > div:first" ).appendTo('#fader');
				}
				el.fadeOut({
					duration: 2000,
					start:function(){
						swapImage('out', direction);
					}
				})
				.removeClass('currentBg')
				.next()
				.addClass('currentBg')
				.fadeIn({
					duration: 2000,
					start:function(){
						swapImage('in', direction);
					}
				})
				.end();
				
			}
		}
		function swapImage(x, direction) {
			
			var el = $('#slider_container .current');
			var title = el.attr('data-title');
			
			if(direction == 'RTL')
			{
				
				
				if(el.is(":first-child"))
				{
					$( "#slider_container > img:last" ).prependTo('#slider_container');
				}
				if(x == 'in')
				{
					el.animate({left:'0%'}, 1000);
					sliderDots(title);
				}
				if(x == 'out')
				{
					el.animate({left:'-100%'}, 1000);
					el.removeClass('current');
					el.prev().addClass('current');
					el.prev().css({left:'100%'});
				}	
			}
			if(direction == 'LTR')
			{
				
				if(el.is(":last-child"))
				{
					$( "#slider_container > img:first" ).appendTo('#slider_container');
				}
				
				if(x == 'in')
				{
					el.animate({left:'0%'}, 1000);
					sliderDots(title);
				}
				if(x == 'out')
				{
					el.animate({left:'100%'}, 1000);
					el.removeClass('current');
					el.next().addClass('current');
					el.next().css({left:'-100%'});
				}	
			}
			
		}
		function sliderDots(title)
		{
			$('#slider_buttons .slider_dot').removeClass('slider_dot_down');
			$('#slider_buttons .slider_dot').each(function(){
				
				if($(this).attr('data-title') == title)
				{
					$(this).addClass('slider_dot_down');
				}
			});
		}