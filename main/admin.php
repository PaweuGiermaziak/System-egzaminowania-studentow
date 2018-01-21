<?php
require('php/functions.php');
session_start();

mysqli_report(MYSQLI_REPORT_STRICT);
		try {
			$bazaLynk = new mysqli('localhost', 'root', '', 'mazurprojekt');
			} 
			catch (mysqli_sql_exception $e) {
				 die ("Problem z dostepen do MySql");
			}
		
	mysqlcomm($bazaLynk, 'SET NAMES utf8;');
?>

<html>
	<head>
		<title>Egzaminator T-1000</title>

		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" type="text/css" href="css/examsList.css">
		<link rel="stylesheet" type="text/css" href="css/admin.css">
		
		<script type="text/javascript" src="js/main.js"></script>
			
			
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
					
					<!--<div id="userData">
						<p>Admin</p>
						<div>
							<p>Wyloguj</p>
						</div>
					</div>-->
					
					<div class="EOF"></div>
				</div>
				
				<div class="EOF"></div>
			</div>
			
			<div id="content">
			<!--
				<div id="directoryTree">
					<div>	
						<h1>Rokowie</h1>
						
						<ol>
							<li><span onclick="dirTree('1')">Rok 1</span>
								<ul id="ul1">
									<li>1IS(s)</li>
									<li>1M(s)</li>
									<li>1LNA(s)</li>
								</ul>
							</li>
							
							<li><span onclick="dirTree('2')">Rok 2</span>
								<ul id="ul2">
									<li>2IS(s)</li>
									<li>2M(s)</li>
									<li>2LNA(s)</li>
								</ul>
							</li>
						</ol>
						<div class="EndOFloat"></div>
					</div>
				</div>
			-->
					<div id="menuAdmin">
						<a href="admin.php?m=0" class="menuAdminBtn" id="menuAdminBtnActv"><p>Oceny</p></a>
						<a href="admin.php?m=1" class="menuAdminBtn"><p>Dodaj Studenta</p></a>
						<a href="admin.php?m=2" class="menuAdminBtn"><p>Dodaj Pytanie</p></a>
						<div class="EOF"></div>
					</div>
				
				<div id="infoAndBegin">			
					
					<!--<h2><span>Zakładka:</span> 3IS(s)</h2>-->
					
					<?php
					
						if(isset($_GET['m']) and $_GET['m']!=0){
							if($_GET['m']==1){
								?>
									<form action="" method="POST">
										<p class="adminsDesc">Login:</p> <input type="text" name="login"><br>
										<p class="adminsDesc">Hasło:</p> <input type="text" name="password"><br>
										<p class="adminsDesc">Osoba:</p> <input type="text" name="osoba"><br>
										<input type="submit" value="Dodaj">
									</form>
								<?php
								
								if(isset($_POST['login']) and isset($_POST['password']) and isset($_POST['osoba'])){
									multi_mysqlselect($bazaLynk, 'INSERT INTO users VALUES (null, "'.$_POST['login'].'", "'.$_POST['password'].'", "'.$_POST['osoba'].'");');
									unset($_POST);
								}
							}
							else{
								?>
									<form action="" method="POST">
										<p class="adminsDesc">Dział: </p><input type="text" name="dzial"><br>
										<p class="adminsDesc">Kolokwium: </p><input type="text" name="kolokwium"><br>
										<p class="adminsDesc">Pytanie: </p><textarea  name="pytanie" rows="4" cols="50"></textarea><br>
										<p class="adminsDesc">Odpowiedź 1: </p><textarea name="odp1" rows="4" cols="50"></textarea><br>
										<p class="adminsDesc">Odpowiedź 2: </p><textarea name="odp2" rows="4" cols="50"></textarea><br>
										<p class="adminsDesc">Odpowiedź 3: </p><textarea name="odp3" rows="4" cols="50"></textarea><br>
										<p class="adminsDesc">Odpowiedź 4: </p><textarea name="odp4" rows="4" cols="50"></textarea><br>
										<p class="adminsDesc">Poprawna: </p><input type="text" name="poprawna"><br>
										<input type="submit" value="Dodaj">
									</form>
								<?php
																
								if(isset($_POST['dzial']) and isset($_POST['kolokwium']) and isset($_POST['pytanie']) and isset($_POST['odp1']) and isset($_POST['odp2']) and isset($_POST['odp3']) and isset($_POST['odp4']) and isset($_POST['poprawna'])){
									multi_mysqlselect($bazaLynk, 'INSERT INTO pytania VALUES (null, '.$_POST['dzial'].', '.$_POST['kolokwium'].', "'.$_POST['pytanie'].'", "'.$_POST['odp1'].'", "'.$_POST['odp2'].'"
									, "'.$_POST['odp3'].'", "'.$_POST['odp4'].'", '.$_POST['poprawna'].');');
									unset($_POST);
								}
							}
							
						}
						else{
							$out = multi_mysqlselect($bazaLynk, 'select * from session;');
							$output = '<table><tr><th>Imie</th><th>Nazwisko</th><th>Test</th><th>Czas</th><th>Ocena</th></tr>';
							
							while($row = mysqli_fetch_array($out)){
								
								$im = multi_mysqlselect($bazaLynk, 'select * from users where id='.$row['id_user'].';');
								$imie = mysqli_fetch_array($im);
								
								$im = array();
								$im = explode(" ", $imie['name']);
								
								$output .= '<tr><td>'.$im[0].'</td><td>'.$im[1].'</td><td>'.($row['id_działu'].'/'.$row['id_kolokwium']).'</td><td>'.date('Y-m-d', $row['czas']).'</td><td>'.((round($row['ocena']/4.5, 1)).'/10').'</td></tr>';
							}
							
							$output .= '</table>';
							echo $output;
						}
							
					?>
					
				<!--	<table>
						<tr>
							<th>Imie</th>
							<th>Nazwisko</th>
							<th>Test1</th>
							<th>Test2</th>
							<th>Test3</th>
							<th>Test3</th>
						</tr>
						
						<tr>
							<td>Paweu</td>
							<td>Uewap</td>
							<td>5.0</td>
							<td>5.0</td>
							<td>5.0</td>
						</tr>
						
					</table>-->
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
	
	<style>
		#infoAndBegin,#menuAdmin{
			width: 100%;
		}
		a {
		  color: inherit; /* blue colors for links too */
		  text-decoration: inherit; /* no underline */
		}
		
		.adminsDesc{
		    display: inline-block;
			width: 95px;
			padding: 0;
			margin: 0;
		}
	</style>
</html>