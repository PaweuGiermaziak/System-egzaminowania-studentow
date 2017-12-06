function dirTree(vr){
	if(document.getElementById("ul"+vr).style.display != "block")
		document.getElementById("ul"+vr).style.display = "block";
	else
		document.getElementById("ul"+vr).style.display = "none";
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




