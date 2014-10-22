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
    <script src="data/bbcode.js"></script>
  	<script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="data/jquery.thumbnailscroller.js"></script>
    <script src="data/jquery-ui-1.8.13.custom.min.js"></script>
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
            <?php if ($_GET['id'] == '1') { ?>
            <li class="current"><a href="page.php?id=1">Oferta</a></li>
            <li><a href="page.php?id=2">Grupa</a></li>
            <li><a href="page.php?id=3">Galeria</a></li>	
            <li><a href="page.php?id=4">Pokazy</a></li>            
            <!-- <li><a href="page.php?id=5">Księga Gości</a></li>	-->
            <?php }elseif ($_GET['id'] == '2') { ?>
			<li><a href="page.php?id=1">Oferta</a></li>
            <li class="current"><a href="page.php?id=2">Grupa</a></li>
            <li><a href="page.php?id=3">Galeria</a></li>	
            <li><a href="page.php?id=4">Pokazy</a></li>            
            <!-- <li><a href="page.php?id=5">Księga Gości</a></li>	-->
            <?php }elseif ($_GET['id'] == '3') { ?>	
			<li><a href="page.php?id=1">Oferta</a></li>
            <li><a href="page.php?id=2">Grupa</a></li>
            <li class="current"><a href="page.php?id=3">Galeria</a></li>	
            <li><a href="page.php?id=4">Pokazy</a></li>
            <!-- <li><a href="page.php?id=5">Księga Gości</a></li>	-->	
            <?php }elseif ($_GET['id'] == '4') { ?>	
			<li><a href="page.php?id=1">Oferta</a></li>
            <li><a href="page.php?id=2">Grupa</a></li>
            <li><a href="page.php?id=3">Galeria</a></li>	
            <li class="current"><a href="page.php?id=4">Pokazy</a></li>            
            <!-- <li><a href="page.php?id=5">Księga Gości</a></li>	-->
            <?php }elseif ($_GET['id'] == '5') { ?>
			<li><a href="page.php?id=1">Oferta</a></li>
            <li><a href="page.php?id=2">Grupa</a></li>
            <li><a href="page.php?id=3">Galeria</a></li>	
            <li><a href="page.php?id=4">Pokazy</a></li>
            <!-- <li class="current"><a href="page.php?id=5">Księga Gości</a></li> -->
            <?php }else { ?>
            <li><a href="page.php?id=1">Oferta</a></li>
            <li><a href="page.php?id=1">Grupa</a></li>
            <li><a href="page.php?id=1">Galeria</a></li>	
            <li><a href="page.php?id=1">Pokazy</a></li>
			<!-- <li><a href="page.php?id=5">Księga Gości</a></li>	-->
            <?php } ?>
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
   			 <?php if ($_GET['id'] == '1') { ?>
				<?php include ('pages/offer.php'); ?>
            <?php }elseif ($_GET['id'] == '2') { ?>
				<?php include ('pages/group.php'); ?>
            <?php }elseif ($_GET['id'] == '3') { ?>	
				<?php include ('gallery.php'); ?>
            <?php }elseif ($_GET['id'] == '4') { ?>
				<?php include ('pages/shows.php'); ?>
            <?php }elseif ($_GET['id'] == '5') { ?>
				<?php include ('pages/guest_book.php'); ?>
            <?php }else { ?>
			<div class="error">Nie odnaleziono artykułu!<br />Za chwilę zostaniesz przekierowany na stronę główną.</div>
            <?php header( "refresh:3;url=index.php" ); ?>
            <?php } ?>
  
    <div id="footer">
    Amateurishly © <?php echo date('Y'); ?> All Rights Reserved.  •  Designed by Aleksander Sowiak.
    </div>
	<script type="text/javascript"> 
	function showhidechat(thechosenone) {
		var chat = document.getElementsByTagName("div");
			for(var x=0; x<chat.length; x++) {
				name = chat[x].getAttribute("name");
				if (name == 'chat') {
					if (chat[x].id == thechosenone) {
						if (chat[x].style.display == 'block') {
							chat[x].style.display = 'none';
							date = new Date();
							date.setDate(date.getDate() -1);
							document.cookie = escape("chat") + '=;expires=' + date;
							document.cookie = "chat=show";
						} else {
							chat[x].style.display = 'block';
							date = new Date();
							date.setDate(date.getDate() -1);
							document.cookie = escape("chat") + '=;expires=' + date;
							document.cookie = "chat=hide";
						}
					} else {
						chat[x].style.display = 'none';
						date = new Date();
						date.setDate(date.getDate() -1);
							document.cookie = escape("chat") + '=;expires=' + date;
							document.cookie = "chat=show";
					}
				}
			 }
			}	
	</script>
	<div name="chat" id="chat1" style="-webkit-box-shadow: -3px -4px 15px 0px rgba(50, 50, 50, 0.75); -moz-box-shadow: -3px -4px 15px 0px rgba(50, 50, 50, 0.75); box-shadow: -3px -4px 15px 0px rgba(50, 50, 50, 0.75); position: fixed; bottom: 0; right: 5px; max-width:350px; <?php if (($_COOKIE['chat'] == "show") || (!isset($_COOKIE['chat']))) { ?>display: block;<? }else{ ?>display: none; <?php } ?>">
		<div style="display:block; padding:5px">
			<div style="float:right"><a href="javascript:showhidechat('chat1')" title="Zamknij">X</a></div>
		</div>
		<div style="display:block">
			<iframe id="pokazy_show" src="data/chat/index.php" style="height: 310px; width:305px" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no"></iframe>
		</div>
	</div>
	<div name="chat" id="chat1" style="position: fixed; bottom: 0; right: 0; max-width:350px; padding:10px; <?php if (($_COOKIE['chat'] == "show") || (!isset($_COOKIE['chat']))) { ?>display: none;<? }else{ ?>display: block; <?php } ?>">
		<p><a href="javascript:showhidechat('chat1')">Chat Paradox<a/></p>
	</div>
</div>
</body>
</html>