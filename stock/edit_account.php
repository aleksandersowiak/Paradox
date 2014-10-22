<?php 
session_start();
ob_start();
if ((isset($_SESSION['user_id'])) && (isset($_SESSION['login']))){
include ('../data/conn.php');
include ('../data/bbcode.php');
include ('data/cookies.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Teatr tancerzy ognia Paradox</title>
</head>
	<link rel="stylesheet" href="../data/css.css" type="text/css" />
    <script src="../data/bbcode.js"></script>
  	<script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="../data/jquery.thumbnailscroller.js"></script>
    <script src="../data/jquery-ui-1.8.13.custom.min.js"></script>
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
			
			?>
            <div class="login_button"><a href="javascript:showhide('box2')">Konto</a></div>
            	<div class="uparrowdiv" name="box" id="box2">
                	<div onclick="window.location='../upload.php'">Dodaj Zdjęcia</div>
                    <div onclick="window.location='../upload_show.php'">Dodaj nowy pokaz</div>
                    <div onclick="window.location='../stock/edit_account.php'">Zmień dane</div>
                	<div onclick="window.location='../index.php?logout=true'">Wyloguj</div>
                </div>
            <?php

			?>
        </div>
	</div>
    <div id="menu">
        <ul class="menu_ul">
            <li><a href="../">Główna</a></li>
            <li><a href="../page.php?id=1">Oferta</a></li>
            <li><a href="../page.php?id=2">Grupa</a></li>
            <li><a href="../page.php?id=3">Galeria</a></li>	
            <li><a href="../page.php?id=4">Pokazy</a></li>
            <!-- <li><a href="page.php?id=5">Księga Gości</a></li>	-->
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
    <div id="continer" style="height:600px; width:780px; padding:10px;">
        	<form action="edit_account.php" method="post" name="zmien">
    <?php
				if (isset($_POST['zmiana'])){
		$zapytanie_haslo = mysql_query("SELECT password FROM user WHERE id_user = '".$_SESSION['user_id']."'") or die (mysql_error());
		$wynik_haslo = mysql_fetch_assoc($zapytanie_haslo);
			if ($_POST['password_check'] == $wynik_haslo['password']){
				echo '<div class="success" style="position:absolute; margin-left:300px;">Dane zostały zmienione.</div>';
				if (isset($_POST['new_password'])){
					$password = base64_decode($_POST['new_password']);
				}else{
					$password = $wynik_haslo['password'];
				}
				@mysql_query("UPDATE user SET password='".$password."', name='".$_POST['name']."', surname='".$_POST['surname']."', email='".$_POST['email']."', admin= '".$_POST['admin']."' WHERE id_user='".$_SESSION['user_id']."'") or die (mysql_error());
				if (isset($_POST['send'])){
				$email = $_POST['email'];
				$wiadomosc = $password;
				$tytul = 'Hasło do konta. http://paradox.nysa.pl/';
				$naglowki = "MIME-Version: 1.0" . "\r\n";
                $naglowki .= "Content-type:text/html;charset=utf-8" . "\r\n";
                $naglowki .= 'From: <'.$email.'>' . "\r\n";
					echo $wynik = mail($email, $tytul, $wiadomosc, $naglowki);
				}
				echo '<meta http-equiv="refresh" content="2">';
			}else{
				echo '<div class="error" style="position:absolute; margin-left:200px;" >Podane hasło jest nieprawidłowe. Dane nie zostały zmienione.</div>';
				echo '<meta http-equiv="refresh" content="2">';
			}
		}
	if (isset($_POST['zmien_dane'])){
		$zapytanie_haslo = mysql_query("SELECT password, email FROM user WHERE id_user = '".$_SESSION['user_id']."'") or die (mysql_error());
		$wynik_haslo = mysql_fetch_assoc($zapytanie_haslo); 
			if ((isset($_POST['password'])) && ($_POST['password'] != '')){
				$ile = strlen($_POST['password']);
				echo '<div class="tip"><table><tr><td>Hasło aktualnie jest zmieniane na nowe:</td><td><div name="box" id="box5" style="display:block;">';
				for ($x=0; $x < $ile; $x++){
					echo '*';
				}
				echo'</div><div name="box" id="box5" style="display:none;">'.$_POST['password'].'</div></td><td><div name="box" id="box5" style="display:block;"><a href="javascript:showhide(\'box5\')">Pokaż hasło</a></div></td></tr></table></div>';
				echo '<input type="hidden" name="new_password" value="'.base64_encode($_POST['password']).'"/>';
				if (($_POST['email'] != '') || ($wynik_haslo['email'] != '')) {
					if ($_POST['email'] != ''){
				echo '<div><input type="checkbox" name="send"/> Wyślij hasło na email</div>';
					}
				
				}
			}else{}
		echo '
		<input type="hidden" name="name" value="'.$_POST['name'].'"/>
		<input type="hidden" name="surname" value="'.$_POST['surname'].'"/>
		<input type="hidden" name="email" value="'.$_POST['email'].'"/>
		<input type="hidden" name="admin" value="'.$_POST['admin'].'"/>
		<table>
		<tr>
			<td>Podaj aktualne hasło:</td>
			<td><input type="password" name="password_check"/></td>
			<td><input type="submit" name="zmiana" value="Zatwierdź" class="button"/></td>
		</tr>
		</table>';

	}else{
	?>

        <?php
		$zapytanie_uzytkownik = mysql_query("SELECT login, name, surname, email, admin FROM user WHERE id_user = '".$_SESSION['user_id']."'") or die (mysql_error());
		$wynik_uzytkownik = mysql_fetch_assoc($zapytanie_uzytkownik); 
		?>
        	<table>
            	<tr>
                	<td>Nazwa użytkownika:</td><td><input type="text" value="<?php echo $wynik_uzytkownik['login']; ?>" readonly="readonly" onmouseover="javascript:showhide('box3')" onmouseout="javascript:showhide('box3')"/></td>
				</tr>
                <tr>
                	<td>Hasło do konta:</td><td><input type="password" value="" name="password" onmouseover="javascript:showhide('box4')" onmouseout="javascript:showhide('box4')"/></td>
				</tr>
                <tr>
                	<td>Imię:</td><td><input type="text" value="<?php echo $wynik_uzytkownik['name']; ?>" name="name"/></td>
                </tr>
                <tr>
                	<td>Nazwisko:</td><td><input type="text" value="<?php echo $wynik_uzytkownik['surname']; ?>" name="surname"/></td>
                </tr>
                <tr>
                	<td>Email:</td><td><input type="text" value="<?php echo $wynik_uzytkownik['email']; ?>" name="email"/></td>
                </tr>
                <tr>
                	<td>Admin:</td><td>
                    <?php
					if ($wynik_uzytkownik['admin'] == '1'){
					if ($wynik_uzytkownik['admin'] == '1'){
						echo 'Tak <input type="radio" name="admin" value="1" checked="checked"/> Nie <input type="radio" name="admin" value="0"/>';
					}else{
						echo 'Tak <input type="radio" name="admin" value="1"/> Nie <input type="radio" name="admin" value="0" checked="checked"/>';
					}
					}
					?>
                    </td>
                </tr>
                <tr>
                	<td></td><td><input type="submit" name="zmien_dane" value="Zatwierdź" class="button" style="width:100%;"/></td></tr>
		</table>
        <div class="warning" name="box" id="box3"  style="display:none; position:absolute; margin-top:-215px; margin-left:300px;">
        Nazwy konta nie można zmienić.
        </div>
        <div class="information" name="box" id="box4"  style="display:none; position:absolute; margin-top:-182px; margin-left:300px;">
        W tym miejscu możesz wprowadzić nowe hasło do konta.
        </div>
      
        <?php
        if ($wynik_uzytkownik['admin'] == '1'){
        ?>
        </form>
        <form action="edit_account.php" method="post" name="zmiena">
        <table width="100%" style="padding:5px;">
        <tr><td>Imie</td><td>Nazwisko</td><td></td><td>Login</td><td>Hasło</td><td>Admin</td>
        <hr />
		
    <?php

	
	$zapytanies = mysql_query("SELECT * FROM user") or die (mysql_error());
	$wyniks = mysql_fetch_assoc($zapytanies);
	do {
		echo '<tr><td>'.$wyniks['name'].'</td><td>'.$wyniks['surname'].'</td><td>';
		if ($wyniks	['password'] == ''){
			echo 'Brak hasła';	
		echo '<td><input type="text" value="'.$wyniks['login'].'" name="login" disabled="disabled"/></td>';
		echo '<td><input type="password" name="password_'.$wyniks['login'].'"/></td>';
		echo '<td><input type="checkbox" name="admins" value="1"/></td>';
		echo '<input type="hidden" name="zaznacz[]" value="'.$wyniks['id_user'].'" />';
		}else{
			echo '<img src="../images/button_v.png"/>';	
		}
		echo'</tr>';
			
	}while($wyniks = mysql_fetch_assoc($zapytanies));

	}
	?>
    </table>
    <center><input type="submit" name="ustal" value="Zapisz" class="button" style="width:100px;"/></center>
    </form>
        <?php
	}
	////////////////
	
	if (isset($_POST['ustal'])){
			foreach($_POST['zaznacz'] as $id)
      {

		$zapytanie_login = mysql_query("SELECT login,id_user FROM user WHERE id_user = '".$id."'") or die (mysql_error());
		$wynik_login = mysql_fetch_assoc($zapytanie_login);
				if ($_POST['password_'.$wynik_login['login'].''] != ''){
					if (isset($_POST['admins'])){
						$admin = '1';
					}else{
						$admin = '0';
					}
					 for ($i = 0; $i<10; $i++) 
    { 
		$d=rand(1,20)%2;
        $kod .=  $d ? chr(rand(65,90)) : chr(rand(48,57)); 
    } 
		@mysql_query("UPDATE user SET login ='".$wynik_login['login']."', password='".$_POST['password_'.$wynik_login['login'].'']."',  admin='".$admin."', code = '".$kod."' WHERE id_user='".$wynik_login['id_user']."'") or die (mysql_error());
		header ('location: edit_account.php');
			}
	  }
		
	}
	
	////////////////

	?>
    
    </div>
    </div>
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
			<iframe id="pokazy_show" src="../data/chat/index.php" style="height: 310px; width:305px" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no"></iframe>
		</div>
	</div>
	<div name="chat" id="chat1" style="position: fixed; bottom: 0; right: 0; max-width:350px; padding:10px; <?php if (($_COOKIE['chat'] == "show") || (!isset($_COOKIE['chat']))) { ?>display: none;<? }else{ ?>display: block; <?php } ?>">
		<p><a href="javascript:showhidechat('chat1')">Chat Paradox<a/></p>
	</div>
    </div>
<?php    }else{ 
header ('location: index.php');
}
?>
    </body>
    </html>