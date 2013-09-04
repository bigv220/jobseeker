$.fn.extend({
    fxuiTab: function(opt) {
        return this.each(function() {
            var t = $(this), 
			o = opt || {}, 
			tit = o.tit || t.find(".fxui-tab-tit"), 
			nav = o.nav || t.find(".fxui-tab-nav"), 
			evt = o.evt || "click", 
			eq = o.eq || 0;
            tit.bind(evt, function() {
                $(this).addClass("curr").siblings(tit).removeClass("curr");
				nav.hide().eq(tit.index($(this))).show();
            }).hover(function() {
                $(this).addClass("fxui-tab-hover").siblings(tit).removeClass("fxui-tab-hover");
            });
			evt === "click" ? tit.eq(eq).click() : tit.eq(eq).mouseover();
        });
    },
    fxuiHover:function(opt){
        return this.each(function() {
        });
    },
    fxBacktop:function(){
    var t = $(this).show()
        .click(function () {$('html,body').animate({scrollTop: 0},500);});

	$(window).scroll(function () {
			var Wtop = $(window).scrollTop();
			t.stop().animate({top:Wtop+300},500);
	  });
		
		
    },
    roll:function(opt) {
        var opt = opt || {};
        var t = $(this);
        //id style
        var w1 = opt.box.width;
        var h1 = opt.box.height;
        t.css({'width':w1,'height':h1,'zoom':1,'overflow':'hidden','position':'relative'})
        
        
        //out style
        var w2 = w1 - opt.box.hspace*2;
        var h2 = opt.item.height;
        var h2Top=(h1-h2)/2;
        var h2Left = opt.box.hspace;
        var out =t.find('.scroll-out');
        out.css({'width':w2,'height':h2,'margin-top':h2Top,'margin-left':h2Left,'position':'relative','overflow':'hidden'});
        
        //box style
        var box=t.find('.scroll-box');
        box.css({'width':'99999px','position':"absolute"})
        
        //item style
        var w3 = opt.item.width,
            h3 = opt.item.height,
            r3 = opt.item.mr,
            block =t.find('.scroll-item');
        block.each(function(){
            $(this).css({'width':w3,'height':h3,'display':'inline-block','margin-right':r3,'overflow':'hidden','float':'left'})
        })
        
        //bar style
        if(opt.bar){
            var w4 = opt.bar.width;
            var h4 = opt.bar.height;
            t.find('.scroll-bar').css({'width':w4,'height':h4,'top':'50%','margin-top':-h4/2,'position':"absolute"});
            t.find('.scroll-left').css({'left':opt.bar.left});
            t.find('.scroll-right').css({'right':opt.bar.right});
        }
        
        var speed = opt.speed;
        var move = false;
        //左滚
        t.find('.scroll-right').click(function(){
            if(move){return}else{
                 move =true;
            }
            var step = w3+r3;
            var block =t.find('.scroll-item');
            box.stop().animate({'left':-step},speed,function(){
                block.eq(0).appendTo(box);
                box.css({'left':0});
                move=false;
            });
        })
        
        //右滚
        t.find('.scroll-left').click(function(){
            if(move){
                return
            }else{
                move =true;
                t.move();
            }
            
        })
        var h;
        t.live('mouseover',function(){
            clearInterval(h);
        }).live('mouseout',function(){
            h =setInterval(t.move, 4000);
        });
        
        
        t.move = function(){
            var step = w3+r3;
            var block =t.find('.scroll-item');
                block.last().prependTo(box);
                box.css({'left':-step});      
            box.stop().animate({'left':0},speed,function(){
                move = false;
            });
        }
        
        h = setInterval(t.move, 4000);
        return this;
    }
});



    
