<?php
require('php/functions.php');
session_start();

if(isset($_POST['login']) and isset($_POST['password']) and !empty($_POST['login'])){
	
	mysqli_report(MYSQLI_REPORT_STRICT);
		try {
			$bazaLynk = new mysqli('localhost', 'root', '', 'mazurprojekt');
			} 
			catch (mysqli_sql_exception $e) {
				 die ("Problem z dostepen do MySql");
			}
		
	mysqlcomm($bazaLynk, 'SET NAMES utf8;');
			
	$out = multi_mysqlselect($bazaLynk, 'select count(user) from users where user="'.$_POST['login'].'" and password="'.$_POST['password'].'";');
	$row = mysqli_fetch_array($out);
	
	if($row['count(user)'] != 0){
			$out = multi_mysqlselect($bazaLynk, 'select * from users where user="'.$_POST['login'].'" and password="'.$_POST['password'].'";');
			$row = mysqli_fetch_array($out);
				$_SESSION['id'] = $row['id'];
				$_SESSION['userName'] = $row['name'];
				
			header("Refresh:0");
	}
	else{
		$err = 'Błedny login badź hasło!';
		echo displayPage(0, $err);
	}
}
/*else{
	displayPage(0);

}*/

if(!isset($_SESSION['id'])){
	displayPage(0);
}
else
	displayPage(1);

function displayPage($id, $err=''){
	if($id == 0){
		?>
		<html>
			<head>
				<title>Egzaminator T-1000</title>

				<meta charset="UTF-8">
				<link rel="stylesheet" type="text/css" href="css/main.css">
				<link rel="stylesheet" type="text/css" href="css/index.css">
					
					
				<link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
			</head>

			<body>
				<div id="wrapper">
					<div id="header">
						<div id="headerWrapp">
							
							<div id="logo">
								<img src="img/terminator.jpg" alt="Arni"/>
								<h3>Egzaminator T-1000</h3>
								<h4>PWSZ - twoja uczelnia</h4>
								<div class="EOF"></div>
							</div>
							
							<div id="userData">
								<!--<p>Alexander Nowak</p>
								<div>
									<p>Wyloguj</p>
								</div>-->
							</div>
							
							<div class="EOF"></div>
						</div>
						
						<div class="EOF"></div>
					</div>
					
					<div id="contentLog">
						<form action="" method="POST">
							<p>Logowanie: </p>
								<input class="text" type="text" name="login"><br>
							<p>Hasło: </p>
								<input class="text" type="text" name="password"><br>
							
							<input class="sumbit" type="submit" value="Zaloguj">
							<?php echo (!empty($err))?('<p>'.$err.'</p>'):'';?>
							<div class="EOF"></div>
						</form>
					</div>
					
					<div id="footer">
						<div id="footerWrapp">
							<p>Storna wykonana przez Giemaziak Studio</p>
							<p>Wszelkie prawa sastrzeżone &#169;</p>
						</div>
					</div>
				</div>
			</body>
		</html>
		<?php
	}
	
	if($id == 1){
		?>
			<html>
			<head>
				<title>Egzaminator T-1000</title>

				<meta charset="UTF-8">
				<link rel="stylesheet" type="text/css" href="css/main.css">
				<link rel="stylesheet" type="text/css" href="css/examsList.css">
					
				<script type="text/javascript" src="js/jquery.js"></script>
				<script type="text/javascript" src="js/main.js"></script>
				<script type="text/javascript" src="js/dirList.js"></script>
					
				<link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
			</head>

			<body>
				<div id="wrapper">
					<div id="header">
						<div id="headerWrapp">
							
							<div id="logo">
								<img src="img/terminator.jpg" alt="Arni"/>
								<h3>Egzaminator T-1000</h3>
								<h4>PWSZ - twoja uczelnia</h4>
								<div class="EOF"></div>
							</div>
							<?php
								if(isset($_SESSION['userName'])){
									?>
									<div id="userData">
										<p><?php echo $_SESSION['userName']; ?></p>
										<div onclick="logout(0)">
											<p>Wyloguj</p>
										</div>
									</div>
									<?php
								}
							?>
							<div class="EOF"></div>
						</div>
						
						<div class="EOF"></div>
					</div>
					
					<div id="content">
						
						<?php
							if(!isset($_SESSION['pg'])){
								$_SESSION['pg'] = 1;
							}
							
							if($_SESSION['pg']==1){
								?><script>loadScreen(1)</script><?php
							}
						?>

					</div>
					
					<div id="footer">
						<div id="footerWrapp">
							<p>Storna wykonana przez Giemaziak Studio</p>
							<p>Wszelkie prawa sastrzeżone &#169;</p>
						</div>
					</div>
					
				</div>
			</body>
		</html>
	<?php
	}

}


?>