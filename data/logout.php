<?php
if ((isset($_SESSION['user_id'])) && (isset($_SESSION['login']))){
session_start();
session_unset();
session_destroy();
			echo '<p class="success_login">Zostałeś(aś) Poprawnie wylogowany(a) z serwisu.</p>';
			echo '<meta http-equiv="refresh" content="2;url=index.php">';
}else{
	header ('location: index.php');
}
?>