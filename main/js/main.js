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
            user: id,
        },
        success: function(msg) {
				 document.getElementById("content").innerHTML = msg;				
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




