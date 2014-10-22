<?php
header('Content-Type: text/html; charset=utf-8');

$serwer = "localhost";
$baza = "garota_paradox";
$uzytkownik = "garota_paradox";
$haslo = "niepodam";

$polaczenie = mysql_connect($serwer, $uzytkownik, $haslo)
or die('Nie udało się połączyć z bazą danych. '.mysql_error());
mysql_select_db($baza, $polaczenie) or die ("Nie mozna skomunikowac sie z baza danych");
		
mysql_query("SET NAMES 'utf8'");
mysql_select_db($baza,$polaczenie);

?>
