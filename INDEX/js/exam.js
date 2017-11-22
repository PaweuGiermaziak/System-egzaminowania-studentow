var curTime = 2700;
//var curTime = 5;

$(document).ready(function(){  

setTimeout(clock(), 1000);

});



function clock(){
	curTime--;
	document.getElementById("userTimer").innerHTML = secToHour(curTime);
		if(curTime>0)
			setTimeout(clock, 1000);
}

function secToHour(sec){
	return ((Math.floor(sec/60)<=9)?'0':'') + Math.floor(sec/60)+':'+((sec%60<=9)?'0':'')+sec%60;
}