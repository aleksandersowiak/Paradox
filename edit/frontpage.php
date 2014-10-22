<?php
if ((isset($_SESSION['user_id'])) && (isset($_SESSION['login']))){
?>
<form name="photo" action="index.php?edit=frontpage" method="post">
<table align="center">
<tr><td>
<table width="100%" style="background:#ccc; border:1px solid #3f3f3f"><tr><td>
	<input type="button" id="bbcodeButton1" onclick="javascript: insertTag('b', false, true);"/>
	<input type="button" id="bbcodeButton2" onclick="javascript: insertTag('i', false, true);"/>
    <input type="button" id="bbcodeButton17" onclick="javascript: insertTag('info', false, true);"/>
    <input type="button" id="bbcodeButton18" onclick="javascript: insertTag('tip', false, true);"/>
    <input type="button" id="bbcodeButton19" onclick="javascript: insertTag('war', false, true);"/>
	<input type="button" id="bbcodeButton15" onclick="javascript: BBCurl();"/>
	<input type="button" id="bbcodeButton16" onclick="javascript: BBCimg();"/>
	<input type="button" id="bbcodeButton9" onclick="javascript: emotki(':)');"/>
	<input type="button" id="bbcodeButton10" onclick="javascript: emotki(':(');"/>
	<input type="button" id="bbcodeButton11" onclick="javascript: emotki(':O');"/>
	<input type="button" id="bbcodeButton12" onclick="javascript: emotki(':P');"/>
	<input type="button" id="bbcodeButton13" onclick="javascript: emotki(';)');"/>    
	<input type="button" id="bbcodeButton14" onclick="javascript: emotki(':D');"/>
</td></tr></table>

<textarea id="text" name="frontpage" style="margin-top: 2px; margin-bottom: 2px; margin-left: 2px; margin-right: 2px; width: 400px; height: 170px; resize:none; padding:5px; ">
<?php
		$zapytanie_front_page = mysql_query ("SELECT frontpage FROM containers");
		$wynik_front_page = mysql_fetch_assoc($zapytanie_front_page);
		do{
			echo $wynik_front_page['frontpage'];
		}while ($wynik_front_page = mysql_fetch_assoc($zapytanie_front_page));
?>
</textarea>

</td></tr>
<tr><td>
<input type="submit" class="button" name="kom" class="login" value="Zedytuj wpis"/> <input type="button" value="Zaniechaj" class="button" onclick="window.location='index.php'"/>
</td></tr></table>
</form>	
<p class="tip" align="justify">Jak dodajesz link np. Film, to dodawaj tak aby był na samej górze nad tekstem, wtedy się automatycznie przerobi. To samo dotyczy się obrazków.</p>	
<?
if (isset($_POST['kom'])){
	$text = $_POST['frontpage'];
	$w = mysql_query("UPDATE `containers` SET frontpage='".$text."'") or die (mysql_error());
	
	echo '<p class="success">Post został zaktualiwany</p>';
	echo '<meta http-equiv="refresh" content="2;url=index.php">';
	
}
}else{
	header ('location: index.php');
}
?>