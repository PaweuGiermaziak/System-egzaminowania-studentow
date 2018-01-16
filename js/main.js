var curTime = 100;
var lastQuest = 1;

function dirTree(vr){
	if(document.getElementById("ul"+vr).style.display != "block")
		document.getElementById("ul"+vr).style.display = "block";
	else
		document.getElementById("ul"+vr).style.display = "none";
}

function loadScreen(id){
	
	$.ajax({
        type: "POST",
        url: "php/loadScreen.php",
        data: {
            id: id,
        },
        success: function(msg) {
				 document.getElementById("content").innerHTML = msg;
					if(id==1){
						refreshClock(0);
						chngQuest(1);
					}
						
        },
        error: function() {
            console.log( "Ajax bład");
        }
    });
	
}

function sessionStart(x){
	$.ajax({
        type: "POST",
        url: "php/sessionStart.php",
        data: {
            id: x,
        },
        success: function(msg) {
			console.log( "Sesja wystarowala");
			// document.getElementById("infoAndBegin").innerHTML = msg;
			loadScreen(x);
        },
        error: function() {
            console.log( "Ajax bład");
        }
    });
}

function refreshClock(x){
		
	$.ajax({
        type: "POST",
        url: "php/refreshClock.php",
        data: {
            id: x,
        },
        success: function(msg) {
            curTime = msg;	
			console.log(curTime);
			setTimeout(clock(), 1000);
        },
        error: function() {
            console.log( "Ajax bład");
        }
    });
}

function logout(id){
	
	$.ajax({
        type: "POST",
        url: "php/logout.php",
        data: {
            user: id,
        },
        success: function(msg) {
            if (msg == "refresh")
				location.reload();			
        },
        error: function() {
            console.log( "Ajax bład");
        }
    });
	
}

$(document).ready(function(){  

;

});



function clock(){
	curTime--;
	document.getElementById("userTimer").innerHTML = secToHour(curTime);
		if(curTime>1)
			setTimeout(clock, 1000);
		else
			exitTest(0);
}

function secToHour(sec){
	return ((Math.floor(sec/60)<=9)?'0':'') + Math.floor(sec/60)+':'+((sec%60<=9)?'0':'')+sec%60;
}

function chngQuest(id){
		
	$.ajax({
        type: "POST",
        url: "php/generQestion.php",
        data: {
            qtn: id,
        },
        success: function(msg) {
            document.getElementById("question").innerHTML = msg;
			$('#Tsk_'+id).removeClass('sideMenuBtn').addClass("sideMenuBtnActv");
			$('#Tsk_'+lastQuest).removeClass('sideMenuBtnActv').addClass("sideMenuBtn");
			
			lastQuest = id;
			
			if(lastQuest == 45)
				document.getElementById("nastPytanie").innerHTML = "Zakończ test";
			else
				document.getElementById("nastPytanie").innerHTML = "Następne pytanie";
			
			chngAnserws(id);
        },
        error: function() {
            console.log( "Ajax bład");
        }
    });
	
}

function chngAnserws(id){
	
	$.ajax({
        type: "POST",
        url: "php/generAnserws.php",
        data: {
            qtn: id,
        },
        success: function(msg) {
            document.getElementById("anserws").innerHTML = msg;
        },
        error: function() {
            console.log( "Ajax bład");
        }
    });
	
}

function displayList(id){//potencjalne id dla gróp uczniów typur kucharz, elektryk
	
	$.ajax({
        type: "POST",
        url: "php/generList.php",
        data: {
            qtn: id,
        },
        success: function(msg) {
            document.getElementById("dirList").innerHTML = msg;				
        },
        error: function() {
            console.log( "Ajax bład");
        }
    });
	
}

function startButton(id, id_dzialy){
		
	$.ajax({
        type: "POST",
        url: "php/buttonList.php",
        data: {
            id: id,
            id_dzialy: id_dzialy,
        },
        success: function(msg) {
            document.getElementById("startBtnSlot").innerHTML = msg;	
        },
        error: function() {
            console.log( "Ajax bład");
        }
    });
}

function exitTest(test){//czy admin czy user
	
	loadScreen(2);
	
	$.ajax({
        type: "POST",
        //url: "php/exitTest.php",    
        url: "php/commitTest.php",
        data: {
            id: test,
        },
        success: function(msg) {
            document.getElementById("wynik").innerHTML = msg;	
        },
        error: function() {
            console.log( "Ajax bład");
        }
    });
}

function nextQuestion(x){
	out = 0;
		var radios = document.getElementsByTagName('input');
		for (var i = 0; i < radios.length; i++) {
			if (radios[i].type === 'radio' && radios[i].checked) { 
				out = i+1;
			}
		}
	
	$.ajax({
        type: "POST",
        url: "php/nextQuestion.php",
        data: {
            odp: out,
        },
        success: function(msg) {
			if(lastQuest<45)
				chngQuest(lastQuest+1);
			else
				exitTest(0);
			
			if(lastQuest == 44)
				document.getElementById("nastPytanie").innerHTML = "Zakończ test";
			else
				document.getElementById("nastPytanie").innerHTML = "Następne pytanie";
        },
        error: function() {
            console.log( "Ajax bład");
        }
    });	
}

function refreshPg(){
	location.reload();			
}