<?php 
session_start();
require('functions.php');

if($_POST['id']==0){
	
	$lista = '';

$bazaLynk = new mysqli('localhost', 'root', '', 'mazurprojekt') or die();
mysqlcomm($bazaLynk, 'SET NAMES utf8;');

$out = multi_mysqlselect($bazaLynk, 'select * from dzialy;');

	for($i = 1; $row = mysqli_fetch_array($out); $i++){
		$lista .=  '<li><span onclick="dirTree('.$i.')">'.$row['name'].'</span><ul id="ul'.$i.'">';
			$outKolokwia = multi_mysqlselect($bazaLynk, 'select * from kolokwia where id_dzialy = "'.$row['id'].'";');

				while($rowKolokwia = mysqli_fetch_array($outKolokwia)){
					$lista .= '<li onclick="startButton('.$rowKolokwia['id'].', '.$rowKolokwia['id_dzialy'].')">'.$rowKolokwia['name'].'</li>';
				}
			$lista .= '</ul></li>';
	}
	
echo '
						<div id="directoryTree">
							<div>	
								<h1>menu</h1>
							<ol id="dirList">
								'.$lista
								
								/*
									<li><span onclick="dirTree(\'1\')">Calki</span>
										<ul id="ul1">
											<li>Całe</li>
											<li>Połowa</li>
											<li>Dla studentów</li>
										</ul>
									</li>
									<li><span onclick="dirTree(\'2\')">Matematyka dysktetna</span>
										<ul id="ul2">
											<li>Costam</li>
											<li>Trala</li>
											<li>Lubiu Placki</li>
										</ul>
									</li>
								*/
								.'
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
							<div id="startBtnSlot"></div>
							'.
							
							
							/*<div id="startButton">
								<h4>Rozpocznij</h4>
								<p id="startBtn"></p>
							</div>*/
							'
						</div>
						
						<div class="EOF"></div>
';
}

if($_POST['id']==1){
	
	$sideMenu;
	
	if(!isset($_SESSION['time']))
		$_SESSION['time'] = time();
	
	for($i = 0; $i < 45; $i++){
		if($i==0)
			$sideMenu = '<div onclick="chngQuest('.($i+1).');" class="sideMenuBtnActv" id="Tsk_1"><p>1</p></div>';
		else
			$sideMenu .= '<div onclick="chngQuest('.($i+1).');" class="sideMenuBtn" id="Tsk_'.($i+1).'"><p>'.($i+1).'</p></div>';
	}
	
echo '				
				<div id="sideMenu">
					<h2 id="userTimer">00:00</h2>
					<div id="sideMenuTable">
						'.
							$sideMenu
						.'	
					</div>
					
					<div onclick="exitTest(0)" id="sideMenuBtnClose">
						<p>Zakoncz test</p>
					</div>
					
				</div>
				<div id="output">
					<h2 id="question"></h2>
					<form id="anserws">
						<p><input type="radio" name="T1_a" value=""> Ut nec molestie est.</p>
						<p><input type="radio" name="T1_a" value=""> Sed arcu arcu.</p>
						<p><input type="radio" name="T1_a" value=""> Sporta sagittis ligula.</p>
						<p><input type="radio" name="T1_a" value=""> Sporta sagittis amet.</p>
					</form>
					
					<div onclick="nextQuestion()" id="outputNext">
						<p id="nastPytanie">Następne pytanie</p>
					</div>
				</div>
				<div class="EOF"></div>';
}

if($_POST['id']==2){
	echo '
	<div id="output">
					<h2>Koniec. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec molestie est. Sed arcu arcu, scelerisque at turpis sit amet, porta sagittis ligula. Nunc tristique odio vel ligula rutrum maximus at a purus. Vestibulum tempus sem at sem fermentum bibendum. Nunc dignissim nisi dui?</h2>
					<p>Nunc tristique odio vel ligula rutrum maximus at a purus. Vestibulum tempus sem at sem fermentum bibendum.Nunc tristique odio vel ligula rutrum maximus at a purus. Vestibulum tempus sem at sem fermentum bibendum.Nunc tristique odio vel ligula rutrum maximus at a purus. Vestibulum tempus sem at sem fermentum bibendum.Nunc tristique odio vel ligula rutrum maximus at a purus. Vestibulum tempus sem at sem fermentum bibendum.</p>
					<h3 id="wynik">6.66/10</h3>
					
					<div id="outputNext" onclick="refreshPg()">
						<p>Zakończ</p>
					</div>
				</div>
				<div class="EOF"></div>
					<style>
						#output{
							width: 100%;
						}

						#output > h2{
						font-size: 1.15em;
						margin: 0;
						}

						#output > p{
						padding: 0;
							margin: 5px 0;
							font-size: 0.966em;
							color: #525252;
							font-family: \'PT Sans\', sans-serif;
						}

						#output > h3{
							padding: 0;
							margin: 20px 0px 20px 0;
							font-size: 1.5em;
							color: #525252;
							font-family: \'PT Sans\', sans-serif;
							text-align: center;
						}

						#outputNext{
						margin: 0 auto 0 auto;
						font-size: 1.2em;
						}

						#outputNext:hover{
						background-color: #74d074; 
						}
					</style>
	';
}
?>