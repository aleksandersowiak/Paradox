<?php
include ('../data/conn.php');
$img = $_GET['name'];
$zapytanie_view_image = mysql_query("SELECT * FROM user_team INNER JOIN team USING (id_team) WHERE name_team = '".$img."'") or die(mysql_error());
$wynik_view_image = mysql_fetch_assoc($zapytanie_view_image);
$photo = getimagesize('../'.$wynik_view_image['zdjecie']);
$width = $photo[0];
$height = $photo[1];
$max_width_big = 380;
$max_height_big = 640;
			if ($width > $max_width_big){
				$scale = $max_width_big/$width;
				$newImageWidth_big = ceil($width * $scale);
				$newImageHeight_big = ceil($height * $scale);
			}elseif ($height > $max_height_big){
				$scale = $max_height_big/$height;
				$newImageWidth_big = ceil($width * $scale);
				$newImageHeight_big = ceil($height * $scale);
			}else{
				$scale = 1;
				$newImageWidth_big = ceil($width * $scale);
				$newImageHeight_big = ceil($height * $scale);
			}
echo '<div style="width:800px; height:590px; padding:20px 0; background:#000;"  align="center">';	
echo '<a href="javascript:void()" onclick="javascript:sendRequest(\'stock/show_numer.php?user=\', \'show_number\', \''.$img.'\')">
<img src="'.$wynik_view_image['zdjecie'].'" width="'.$newImageWidth_big.'" height="'.$newImageHeight_big.'"/></a>';
echo '</div>';
?>