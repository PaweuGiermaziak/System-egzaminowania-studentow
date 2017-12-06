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
            document.getElementById("startBtn").innerHTML = msg;				
        },
        error: function() {
            console.log( "Ajax bład");
        }
    });
}