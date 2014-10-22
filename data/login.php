<?php 
if (isset($_POST['konto']) and isset($_POST['password'])) {
	$konto= $_POST['konto'];
	$password= $_POST['password'];
	if ($konto!="" and $password!="") {
		$password = ($password);
		$konto = ($konto);
   		$zapytanie="SELECT id_user, admin, code FROM user WHERE login='".$konto."' and password ='".$password."'";	
   		$temp=mysql_query($zapytanie) or die(mysql_error());
   		$ile=mysql_num_rows($temp);
   		$temp=mysql_fetch_array($temp);
   		echo $id=$temp['id_user'];
		if ($ile==1) {
			if ($temp['code'] != ''){
			$_SESSION['user_id'] = $id;
			$_SESSION['login'] = $konto;

			echo '<p class="success_login">Zostałeś(aś) Poprawnie zalogowany(a) do serwisu.</p>';
			echo '<meta http-equiv="refresh" content="2">';
			}else{
			echo '<p class="error_login">Nie zostałeś zalogowany ponieważ, nie odnaleziono kodu aktywacji, skontaktuj się z administratorem serwiu.</p>';
			echo '<meta http-equiv="refresh" content="2">';
			}
		}else{
			echo '<p class="error_login">Podałeś(aś) złe dane do zalowania się.</p>';
			echo '<meta http-equiv="refresh" content="2">';
		}
	}
}
?>