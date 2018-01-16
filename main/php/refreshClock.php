<?php
	session_start();
	echo (2700 - (time() - $_SESSION['time']));
?>