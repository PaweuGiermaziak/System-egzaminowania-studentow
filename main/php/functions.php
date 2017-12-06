<?php
function multi_mysqlselect($con, $order){
	$out = mysqli_query($con, $order) or die("problem z zapytaniem mysql");
		return $out;
}

function mysqlcomm($con, $order){
	$out = mysqli_query($con, $order) or die("problem z poleceniem mysql");
		return $out;
}



// WK - tu coś się kicka na 'ó' - na razie odłączyłem tę funkcję (zwraca oryginalny argument)
function sanitize($txt){//dokoncz
return $txt;

//$txt = $mysqli->real_escape_string($txt);
$txt = htmlentities($txt,ENT_QUOTES,'UTF-8');
$txt = strip_tags($txt);

return $txt;
}

function dbg( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}







?>