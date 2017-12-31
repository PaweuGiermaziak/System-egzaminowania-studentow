$(document).ready(function(){  

//init main
$('ul', '.active-nav').css({'display': 'block', 'margin-top': -($('ul', this).height() + 75)});

$('#messJS').css({'display': 'none'});
//init MG
$('p', '.subbox').css({'float': 'left'});
$('ul', '.subbox').css({'float': 'right'});
$('ul,p', '.subbox').css({'opacity': '0'});
$('.title').css({'opacity': '0.5'});


//console.log( $('ul', '#acivLi1').height() );//popraw

//wysowane menu
$(".active-nav").hover(function(){
	$('ul', '.active-nav').stop().animate({'margin-top': '12px'}, 500);
},
function(){
	$('ul', '.active-nav').stop().animate({'margin-top': -($('ul', this).height() +75)}, 500);//?
});

	
//do nowego pliku	
//cookies switch
$("#CloseCookies").click(function(){
	$('#messCookies').css({'display': 'none'});
	createCookie("acceptCookie", "accept", 7);
});
	
	
//obsługa alertu cookie
if(getCookie("acceptCookie") != "")
	$('#messCookies').css({display : 'none'});
	
	
//galeria menu glowne ????????????????????????????????????????????????????????????
$(".image-box").hover(function(){
	$(this).find('div').stop().animate({'top': '0%'}, 500);	
},
function(){
	$(this).find('div').stop().animate({'top': '100%'}, 500);
}
);	
	
	
	

	/*

	
function slider(){
console.log("ok");

setTimeout(slider(), 3000);
}
	
	
	
	slider();
	
	*/
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	
$(window).scroll(function(){
				
		if(($(window).scrollTop() + window.innerHeight ) > $('#second-box').offset().top ){
						
			$('p', '.subbox').animate({'margin-left': '5%', 'opacity': '1'}, 800); 
			$('ul', '.subbox').animate({'margin-right': '5%', 'opacity': '1'}, 800);
			$('.title').animate({'opacity': '1'}, 800);
			
		}
			
});
	
		
//slider przejscie w dol MG	
if (document.addEventListener) {
    document.addEventListener("mousewheel", MouseWheelHandler(), false);
    document.addEventListener("DOMMouseScroll", MouseWheelHandler(), false);
} else {
    sq.attachEvent("onmousewheel", MouseWheelHandler());
	document.attachEventListener("mousewheel", MouseWheelHandler(), false);
    document.attachEventListener("DOMMouseScroll", MouseWheelHandler(), false);
}

function MouseWheelHandler() {
    return function (e) {
        var e = window.event || e;
        var delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));

        //scrolling down
        if (delta < 0) {
			pos_curr = $(document).scrollTop();
			
			if(pos_curr == 0)
				$('html, body').animate({
					scrollTop: $("#first-box").offset().top
				}, 1500);
        }

        //scrolling up
        else {
			 $('html, body').stop();
        }
        return false;
    }
}
	
	
	

	
	
function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length,c.length);
        }
    }
    return "";
} 

});