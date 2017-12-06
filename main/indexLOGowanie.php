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
						<div id="directoryTree">
							<div>	
								<h1>menu</h1>
								
								<ol id="dirList">
									<li><span onclick="dirTree('1')">Calki</span>
										<ul id="ul1">
											<li>Całe</li>
											<li>Połowa</li>
											<li>Dla studentów</li>
										</ul>
									</li>
									<li><span onclick="dirTree('2')">Matematyka dysktetna</span>
										<ul id="ul2">
											<li>Costam</li>
											<li>Trala</li>
											<li>Lubiu Placki</li>
										</ul>
									</li>
								</ol>
								<div class="EndOFloat"></div>
							</div>
						</div>
						<script>displayList(0)</script>

						<div id="infoAndBegin">
							<h2>Lorem ipsum dolor sit amet!</h2>
							<p>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec molestie est. Sed arcu arcu, scelerisque at turpis sit amet, porta sagittis ligula. Nunc tristique odio vel ligula rutrum maximus at a purus. Vestibulum tempus sem at sem fermentum bibendum. Nunc dignissim nisi dui, a interdum mi cursus vitae. Quisque dignissim neque id purus fermentum, et iaculis ipsum dictum. Aliquam id metus vel ipsum aliquet ullamcorper. Nulla vel nibh laoreet, placerat risus ac, hendrerit diam.
							</p>
							<p>
							Ut luctus urna non vestibulum tincidunt. In pharetra risus eu leo elementum, dictum porta urna pellentesque. Sed et quam luctus, pulvinar sem nec, varius libero. Quisque vitae scelerisque nisi. Aenean sit amet ligula lectus. Cras quis leo consequat, malesuada ex id, congue nisl. Vestibulum ullamcorper vestibulum turpis, a pharetra erat pretium quis. Mauris nec accumsan justo. Sed luctus dolor ut mauris tincidunt imperdiet. In vitae mollis lorem. Mauris a libero hendrerit, tempus nibh ac, auctor dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
							</p>
							<p>
							Donec in ultricies ligula. Curabitur a condimentum sapien, id faucibus odio. Nulla blandit est tellus, vel aliquet ante volutpat ac. Praesent sit amet ante vitae massa vehicula semper. Nulla suscipit, lacus a euismod mollis, ligula lacus efficitur metus, eget tempor mi lectus ornare quam. Donec quam urna, tincidunt ut volutpat et, dictum sit amet mi. Nulla venenatis aliquam lacinia. Curabitur ut bibendum diam. Vestibulum ligula orci, varius sed molestie eget, dictum sed orci. Suspendisse eget luctus leo, sed vulputate magna. Sed justo sem, scelerisque a fringilla a, efficitur vel nulla.
							</p>
							<p>
							Aenean lectus sapien, ultricies vitae bibendum porta, pellentesque quis ligula. Vivamus a augue felis. Nam molestie fringilla neque vitae sodales. Donec quis tincidunt elit. Integer et molestie lorem, at accumsan ex. Nullam turpis eros, pulvinar id condimentum et, rutrum at enim. Donec tempor laoreet sollicitudin. Sed mattis dapibus eros vulputate maximus. Suspendisse at gravida magna, a porttitor nunc. Phasellus in enim et leo interdum tempor in in erat. Pellentesque ultrices mollis magna et fermentum.
							</p>
							
							<div id="startButton">
								<h4>Rozpocznij</h4>
								<p id="startBtn"></p>
							</div>
						</div>
						
						<div class="EOF"></div>
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