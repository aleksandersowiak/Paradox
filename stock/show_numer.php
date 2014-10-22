<?php 
session_start();
ob_start();
include ('../data/conn.php');
include ('../data/bbcode.php');
if (isset($_GET['user'])){
		$user = $_GET['user'];
		$zapytanie_user = "SELECT * FROM user_team  INNER JOIN team USING (id_team) LEFT JOIN user USING (id_user)WHERE name_team='".$user."'";  
$wynik_user=mysql_query($zapytanie_user, $polaczenie) or die (mysql_error());		
$wypisz_user= mysql_fetch_assoc($wynik_user);
$max_width = 197;
$max_height = 305;

$photo = getimagesize('../'.$wypisz_user['zdjecie']);
$width = $photo[0];
$height = $photo[1];
			if ($width > $max_width){
				$scale = $max_width/$width;
				$newImageWidth = ceil($width * $scale);
				$newImageHeight = ceil($height * $scale);
			}elseif ($height > $max_height){
				$scale = $max_height/$height;
				$newImageWidth = ceil($width * $scale);
				$newImageHeight = ceil($height * $scale);
			}else{
				$scale = 1;
				$newImageWidth = ceil($width * $scale);
				$newImageHeight = ceil($height * $scale);
			}

			if ((isset($_SESSION['user_id'])) && (isset($_SESSION['login']))){
			?>
    <div style="float:right;">
    <input type="submit" value="" class="img_edit" title="Edytuj Wpis" onclick="window.location='page.php?id=2&edit=<?php echo $user; ?>'"/>
    </div>
    
<?php } ?>
<script>
function createRequestObject() 
{
	var returnObj = false;
	
    if(window.XMLHttpRequest) {
        returnObj = new XMLHttpRequest();
    } else if(window.ActiveXObject) {
		try {
			returnObj = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
			try {
			returnObj = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e) {}
			}
			
    }
	return returnObj;
}
var http = createRequestObject();
var target;
// This is the function to call, give it the script file you want to run and
// the div you want it to output to.
function sendRequest(scriptFile, targetElement, name)
{	
	target = targetElement;
	try{
	http.open('get', scriptFile+name, true);
	}
	catch (e){
	document.getElementById(target).innerHTML = e;
	return;
	}
	http.onreadystatechange = handleResponse;
	http.send();	
}
function handleResponse()
{	
	if(http.readyState == 4) {		
	try{
		var strResponse = http.responseText;
		document.getElementById(target).innerHTML = strResponse;
		} catch (e){
		document.getElementById(target).innerHTML = e;
		}	
	}
}
</script>
<div id="box_big_img" style="position:absolute; z-index:5;"></div>
<?php
echo '<h2 style="font-variant:small-caps; font-size:32px;">'.$wypisz_user['name'].' '.$wypisz_user['surname'].' ('.$wypisz_user['pseudo'].')</h2>';

echo '<div style="padding:10px; float:left; width: 230px;"">';

echo bbcode($wypisz_user['description']);

echo '</div>';

if ($wypisz_user['zdjecie'] == ''){
echo '<div class="error" style="float:left; width: 250px; padding-top:10px;">Brak zdjęcia, osoby z grupy!</div>';	
}else{
echo '<div style="float:left; width: 250px; padding-top:10px;">';
?>

<?php
	echo '<a href="javascript:void()" onclick="javascript:sendRequest(\'stock/view_image.php?name=\', \'box_big_img\', \''.$user.'\')"/><img src="'.$wypisz_user['zdjecie'].'" width="'.$newImageWidth.'" height="'.$newImageHeight.'" border="0" ></a>';

echo '</div>';
}			
}
?>