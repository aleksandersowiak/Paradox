<?php 
session_start();
ob_start();
include ('data/conn.php');
include ('data/bbcode.php');
include ('data/cookies.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Teatr tancerzy ognia Paradox</title>
</head>
	<link rel="stylesheet" href="data/css.css" type="text/css" />
    <!--<link rel="stylesheet" href="data/calendar/calendar.css" type="text/css" />-->
    <script src="data/bbcode.js"></script>
  <!--	<script src="http://code.jquery.com/jquery-latest.js"></script>
  <script type="text/javascript" src="data/calendar/ui.core.js"></script>
  <script type="text/javascript" src="data/calendar/datepicker.js"></script>-->
   <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
</head>
<body>
<script type="text/javascript"> 
function showhide(thechosenone) {
	var box = document.getElementsByTagName("div");
		for(var x=0; x<box.length; x++) {
			name = box[x].getAttribute("name");
			if (name == 'box') {
				if (box[x].id == thechosenone) {
					if (box[x].style.display == 'block') {
						box[x].style.display = 'none';
					} else {
						box[x].style.display = 'block';
					}
				} else {
					box[x].style.display = 'none';
				}
			}
	 	 }
		}
</script>
<div id="body">
	<div id="header">
    	<!-- <div class="logo">PaRaDoX</div>
        <div class="logo_bottom">TEATR TANCERZY OGNIA</div> -->
		<div class="login">
        	<?php 
			if ((isset($_SESSION['user_id'])) && (isset($_SESSION['login']))){
			?>
            <div class="login_button"><a href="javascript:showhide('box2')">Konto</a></div>
            	<div class="uparrowdiv" name="box" id="box2">
                	<div onclick="window.location='upload.php'">Dodaj Zdjęcia</div>
                    <div onclick="window.location='upload_show.php'">Dodaj nowy pokaz</div>
                    <div onclick="window.location='stock/edit_account.php'">Zmień dane</div>
                	<div onclick="window.location='index.php?logout=true'">Wyloguj</div>
                </div>
            <?php
			}else{
			?>
        	<div class="login_button"><a href="javascript:showhide('box1')">Zaloguj</a></div>
        	<?php
			}
			?>
        </div>
	</div>
    <div id="menu">
        <ul class="menu_ul">
            <li><a href="./">Główna</a></li>
			<li><a href="page.php?id=1">Oferta</a></li>
            <li><a href="page.php?id=2">Grupa</a></li>
            <li><a href="page.php?id=3">Galeria</a></li>	
            <li><a href="page.php?id=4">Pokazy</a></li>
           <!-- <li><a href="page.php?id=5">Księga Gości</a></li>	 -->
        </ul>
    </div>

    <div id="group">
			 <?php
			 	if ($_GET['page'] == 'no'){
					echo '<p class="tip">Brak jeszcze strony o podanym adresie.<br />
<br />
Przepraszamy za usterki i zapraszamy później.</p>';	
				}
				if (isset($_POST['submit'])){
					include ('data/login.php');
				}
				if (isset($_GET['logout'])){
					if ($_GET['logout'] = 'true'){
						include ('data/logout.php');
					}
				}
			?>
		<div class="login_box1" name="box" id="box1"  style="display:none;">
        	<form action="index.php" method="post">
        	<table>
            	<tr>
                	<td>Login:</td><td><input type="text" name="konto"/></td>
				</tr>
				<tr>
					<td>Hasło:</td><td><input type="password" name="password"/></td>
				</tr>
                <tr>
                	<td></td><td><input type="submit" name="submit" value="Zaloguj" class="button"/> <input type="button" value="Anuluj" onclick="javascript:showhide('box1')" class="button"/></td>
                </tr>
			</table>
            </form>  
        </div>
    </div>
    <div style="float:left">
    	<div id="continer">
		<div id="add" style=" height:168px; border-bottom:1px solid #ccc; padding:10px;">
        
                <?php
		if (isset($_POST['add_show'])){
			include ('stock/add_show.php');	
		}elseif (isset($_GET['dell'])){
			include ('stock/add_show.php');	
		}else{
		?>
        <div class="information">Dodaj nowy pokaz do strony</div>
        <?php } ?>
        <div>
        <form action="upload_show.php" method="post">
        <table>
        	<tr>
			<!--
		<script type="text/javascript">
		$(function() {
			$("#datepicker").datepicker({dateFormat: 'yy-mm-dd', showOn: 'button',
				buttonImage: 'images/icons/calendar_icon.png',
				buttonWidth: "20px;",
				buttonImageOnly: true,
				changeMonth: true,
				changeYear: true
			});
		});
		</script>
		-->
		<script>
  $(function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
  });
  </script>
        		
				<td>Data:</td><td><input type="text" id="datepicker" autocomplete="off"  name="date"><!-- End demo -->
</td>
                <td colspan="3"><input type="submit" value="Dodaj" class="button" name="add_show"/></td><td><input type="reset" class="button" value="Wyczyść"/></td>
            </tr>
            <tr>
            	<td>Tytuł:</td><td><input type="text" name="title" /></td>
            </tr>
            <tr>
            	<td>Gdzie:</td><td><input type="text" name="where" /></td>
            </tr>  
        </table>
        </form>
        </div>
        </div>
        <h2>Wszystkie pokazy</h2>
		<!--
		<script>
			$(document).ready(function() {
				$("#pokazy_show").load("stock/all_show.php");
			});
		  </script> 
          <div id="pokazy_show"></div>-->
		  <iframe id="pokazy_show" src="stock/all_show.php" width="500px" height="384px" marginwidth="0"
 marginheight="0"
 hspace="0"
 vspace="0"
 frameborder="0"
 scrolling="no"></iframe>
          </div>
    </div>
    <div style="float:left">  
    </div>
	<?php include ('stock/right.php'); ?>
    </div>
    <div id="footer">
    Amateurishly © <?php echo date('Y'); ?> All Rights Reserved.  •  Designed by Aleksander Sowiak.
    </div>
</div>
<style>
	#box5:hover { cursor: pointer }
</style>
	<div name="box" id="box37" class="tip" style="position: fixed; bottom: 0; left: 0; max-width:250px; display: block;" title="Zamknij" >
		<div style="float:right"><a href="javascript:showhide('box37')">x</a></div>
		<p>Poprawiony został "Data Picker" Dodawanie daty, kliknięcie na pole do wpisania wyświetli kalendarz z datą.</p>
		<p>Pierwszym dniem tygodnia jest niedziela. Kalendarz chwilowo jest po angielsku, ale w miarę możliwości postaram się go przetłumaczyć</p>
	</div>
</body>
</html>
<?php } ?>