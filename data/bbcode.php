<?php
 //notifikacion

   
function bbcode($bb_tab)
{
	 $bb_tab = preg_replace("/\[info\]([^\\[]*)\[\/info\]/i","<p class='information'>\\1</p>",$bb_tab);
  $bb_tab = preg_replace("/\[tip\]([^\\[]*)\[\/tip\]/i","<p class='tip'>\\1</p>",$bb_tab);
   $bb_tab = preg_replace("/\[war\]([^\\[]*)\[\/war\]/i","<p class='warning'>\\1</p>",$bb_tab);
	// $bb_tab = preg_replace("/\[img=http:\/\/([^\\[]*)\]/i","<div class=\"pic_container\"><a href=\"http:\/\/\\1\" title=\"Kliknij aby powiększyć\" target=\"_blank\"><div id=\"forum_img\" style=\"background-image:url('http:\/\/\\1'); position:relative; width:200px; height:100px;\"><p style=\"background-color:#000;\">Pokaż obrazek</p></div></a></div>",$bb_tab);
 //$bb_tab = preg_replace("/\[img=([^\\[]*)\]/i","<div class=\"pic_container\"><a href=\"http:\/\/\\1\" title=\"Kliknij aby powiększyć\" target=\"_blank\"><div id=\"forum_img\" style=\"background-image:url('http:\/\/\\1'); position:relative; width:200px; height:100px;\"><p style=\"background-color:#000;\">Pokaż obrazek</p></div></a></div>",$bb_tab);
// $bb_tab = preg_replace("/\[img=www.([^\\[]*)\]/i","<div class=\"pic_container\"><a href=\"http:\/\/\\1\" title=\"Kliknij aby powiększyć\" target=\"_blank\"><div id=\"forum_img\" style=\"background-image:url('http:\/\/\\1'); position:relative; width:200px; height:100px;\"><p style=\"background-color:#000;\">Pokaż obrazek</p></div></a></div>",$bb_tab);

   preg_match ('`((?:https?|ftp)://\S+[[:alnum:]]/?)`si', $bb_tab, $link); 
  if ( empty ($link [0])) {  
  } else { 
  $url =  $link [0]; 
  } 
   preg_match ('`((?<!//)(www\.\S+[[:alnum:]]/?))`si', $bb_tab, $link); 
  if ( empty ($link [0])) {  
  } else { 
  $url =  'http://'.$link [0]; 
  }
  //////////
if(!empty($url)){ // $obrazek = http://th.interia.pl/30,bc1fb686e3846949/kot.jpg 
$headers=get_headers($url,1); // pobieramy head obrazka // LINIA 78 
$type = array("image/jpeg", "image/gif", "image/png"); // dostepne rozszerzenia 

if(!in_array($headers['Content-Type'], $type)){ 
//////////////////////////////////
$content = file_get_contents($url);
preg_match_all('/<img src=\"(.*)\".*>/iU', $content, $images);
preg_match_all('/<title.*>(.*)\<title.*>/iU', $content, $title);
$i = 0;
foreach ($images[1] as $image)
{
$i++;
}
    preg_match('/<title>([^>]*)<\/title>/si', $content, $title);
   
    if($title[1]) {
      $metatagi['title'] = $title[1];
    }

$tags = get_meta_tags($url);
$description = $tags['description'];

 $bb_tab = preg_replace("/\[url=http:\/\/([^\\[]*)\]([^\\[]*)\[\/url\]/i",'$1',$bb_tab);
 $bb_tab = preg_replace("/\[url=www.([^\\[]*)\]([^\\[]*)\[\/url\]/i",'http://$1',$bb_tab);
 $bb_tab = preg_replace("/\[url=([^\\[]*)\]([^\\[]*)\[\/url\]/i",'http://$1',$bb_tab);
 ////////////////////////////////////////
$tablica = explode("www.", $bb_tab);
$tablica_www = explode(".", $tablica[1]);
$tablica2 = explode("http://", $bb_tab);
$tablica3 = explode("https://", $bb_tab);
$tablica2_http = explode(".", $tablica2[1]);
$tablica3_http = explode(".", $tablica3[1]);
 if ($tablica_www[0] == 'youtube'){

	 $link_youtube_www = explode("v=", substr($tablica_www[1], 0, strpos($tablica_www[1], "&")));
	 
	 if (isset($link_youtube_www[1])){
		 $link = $link_youtube_www[1];
	 }else{
		 $link_x = explode("v=", $tablica_www[1]);
		 $link = substr($link_x[1],0,11);
	 }
	if (!isset($link)){
		$bb_tab = preg_replace('`((?:https?|ftp)://\S+[[:alnum:]]/?)`si','<br /><a href="$1" target="_new">$1</a>',$bb_tab);
		//$bb_tab = preg_replace('`((?:https?|ftp)://\S+[[:alnum:]]/?)`si','<br /><a href="$1" target="_new"><div class="container_link"><div class="header_link"><table width="100%"><tr><td class="td_link"><strong>'.utnij($metatagi['title'],40).'</strong></td><td>'.utnij($url,20).'</td></tr></table></div><div class="sidebar1_link"><center>'.$images[0][1].'</center></div><div class="content_link">'.utnij($description,200).'</div></div></a><br />',$bb_tab);
 //$bb_tab = preg_replace('`((?<!//)(www\.\S+[[:alnum:]]/?))`si','<br /><a href="http://$1" target="_new"><div class="container_link"><div class="header_link"><table width="100%"><tr><td class="td_link"><strong>'.utnij($metatagi['title'],40).'</strong></td><td>'.utnij($url,20).'</td></tr></table></div><div class="sidebar1_link"><center>'.$images[0][1].'</center></div><div class="content_link">'.utnij($description,200).'</div></div></a><br />',$bb_tab);
		}else{ 
	 $bb_tab =  preg_replace('`((?<!//)(www\.\S+[[:alnum:]]/?))`si','<br /><iframe width="410" height="280" src="http://www.youtube.com/embed/'.$link.'" frameborder="0" allowfullscreen></iframe><br />',$bb_tab);
	 
	 $sprawdz = explode ("www.", $bb_tab);
	 if  (($sprawdz[0] == 'https://') || ($sprawdz[0] == 'http://')){
	
 	 	 $bb_tab =  preg_replace('`((?:https?|ftp)://\S+[[:alnum:]]/?)`si','<br /><iframe width="410" height="280" src="http://www.youtube.com/embed/'.$link.'" frameborder="0" allowfullscreen></iframe><br />',$bb_tab);
	 }
	}
 }else if ($tablica2_http[0] == 'youtube'){
$link_youtube_http = explode("v=", substr($tablica2_http[1], 0, strpos($tablica2_http[1], "&")));
	 if (isset($link_youtube_http[1])){
		 $link = $link_youtube_http[1];
	 }else{
		 $link_x = explode("v=", $tablica2_http[1]);
		 $link = substr($link_x[1],0,11);
	 }
	 if (!isset($link)){
		 $bb_tab = preg_replace('`((?:https?|ftp)://\S+[[:alnum:]]/?)`si','<br /><a href="$1" target="_new">$1</a>',$bb_tab);
		 //$bb_tab = preg_replace('`((?:https?|ftp)://\S+[[:alnum:]]/?)`si','<br /><a href="$1" target="_new"><div class="container_link"><div class="header_link"><table width="100%"><tr><td class="td_link"><strong>'.utnij($metatagi['title'],40).'</strong></td><td>'.utnij($url,20).'</td></tr></table></div><div class="sidebar1_link"><center>'.$images[0][1].'</center></div><div class="content_link">'.utnij($description,200).'</div></div></a><br />',$bb_tab);
 //$bb_tab = preg_replace('`((?<!//)(www\.\S+[[:alnum:]]/?))`si','<br /><a href="http://$1" target="_new"><div class="container_link"><div class="header_link"><table width="100%"><tr><td class="td_link"><strong>'.utnij($metatagi['title'],40).'</strong></td><td>'.utnij($url,20).'</td></tr></table></div><div class="sidebar1_link"><center>'.$images[0][1].'</center></div><div class="content_link">'.utnij($description,200).'</div></div></a><br />',$bb_tab);
		 }else{ 
	 	 $bb_tab =  preg_replace('`((?:https?|ftp)://\S+[[:alnum:]]/?)`si','<br /><iframe width="410" height="280" src="http://www.youtube.com/embed/'.$link.'" frameborder="0" allowfullscreen></iframe><br />',$bb_tab);
	 }
 }
 ////
else if ($tablica3_http[0] == 'youtube'){
$link_youtube_http = explode("v=", substr($tablica3_http[1], 0, strpos($tablica3_http[1], "&")));
	 if (isset($link_youtube_http[1])){
		 $link = $link_youtube_http[1];
	 }else{
		 $link_x = explode("v=", $tablica3_http[1]);
		 $link = substr($link_x[1],0,11);
	 }
	 if (!isset($link)){
		 $bb_tab = preg_replace('`((?:https?|ftp)://\S+[[:alnum:]]/?)`si','<br /><a href="$1" target="_new">$1</a>',$bb_tab);
		 //$bb_tab = preg_replace('`((?:https?|ftp)://\S+[[:alnum:]]/?)`si','<br /><a href="$1" target="_new"><div class="container_link"><div class="header_link"><table width="100%"><tr><td class="td_link"><strong>'.utnij($metatagi['title'],40).'</strong></td><td>'.utnij($url,20).'</td></tr></table></div><div class="sidebar1_link"><center>'.$images[0][1].'</center></div><div class="content_link">'.utnij($description,200).'</div></div></a><br />',$bb_tab);
 //$bb_tab = preg_replace('`((?<!//)(www\.\S+[[:alnum:]]/?))`si','<br /><a href="http://$1" target="_new"><div class="container_link"><div class="header_link"><table width="100%"><tr><td class="td_link"><strong>'.utnij($metatagi['title'],40).'</strong></td><td>'.utnij($url,20).'</td></tr></table></div><div class="sidebar1_link"><center>'.$images[0][1].'</center></div><div class="content_link">'.utnij($description,200).'</div></div></a><br />',$bb_tab);
		 }else{ 
	 	 $bb_tab =  preg_replace('`((?:https?|ftp)://\S+[[:alnum:]]/?)`si','<br /><iframe width="410" height="280" src="http://www.youtube.com/embed/'.$link.'" frameborder="0" allowfullscreen></iframe><br />',$bb_tab);
	 }
 }else{
$bb_tab = preg_replace('`((?:https?|ftp)://\S+[[:alnum:]]/?)`si','<br /><a href="$1" target="_new">$1</a>',$bb_tab);
//$bb_tab = preg_replace('`((?:https?|ftp)://\S+[[:alnum:]]/?)`si','<br /><a href="$1" target="_new"><div class="container_link"><div class="header_link"><table width="100%"><tr><td class="td_link"><strong>'.utnij($metatagi['title'],40).'</strong></td><td>'.utnij($url,20).'</td></tr></table></div><div class="sidebar1_link"><center>'.$images[0][1].'</center></div><div class="content_link">'.utnij($description,200).'</div></div></a><br />',$bb_tab);
// $bb_tab = preg_replace('`((?<!//)(www\.\S+[[:alnum:]]/?))`si','<br /><a href="http://$1" target="_new"><div class="container_link"><div class="header_link"><table width="100%"><tr><td class="td_link"><strong>'.utnij($metatagi['title'],40).'</strong></td><td>'.utnij($url,20).'</td></tr></table></div><div class="sidebar1_link"><center>'.$images[0][1].'</center></div><div class="content_link">'.utnij($description,200).'</div></div></a><br />',$bb_tab);
 
}}else{ 
	$max_height = "600";
	$max_width = "260";

			$check = getimagesize($url);
            $width =  $check[0];
            $height = $check[1];	
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
			$bb_tab = preg_replace('`((?:https?|ftp)://\S+[[:alnum:]]/?)`si','<center><a href="$1" target="_new"><img src="$1" style ="width:'.$newImageWidth.'px; height:'.$newImageHeight.'px;"/></a></center>',$bb_tab);
			
 			$bb_tab = preg_replace('`((?<!//)(www\.\S+[[:alnum:]]/?))`si','<center><a href="http://$1" target="_new"><img src="$1" style ="width:'.$newImageWidth.'px; height:'.$newImageHeight.'px;"/></a></center>',$bb_tab);			


} 
}
 // Przejście do nowej lini
 $bb_tab = preg_replace("/\\\n/i","<br>",$bb_tab);
 
 // Emotki
 $bb_tab = preg_replace("/\:\)/i","<img src=\"http://".$_SERVER['HTTP_HOST']."/images/bbcode/emotki/smile.png\"/>",$bb_tab);
 $bb_tab = preg_replace("/\:\(/i","<img src=\"http://".$_SERVER['HTTP_HOST']."/images/bbcode/emotki/unhappy.png\"/>",$bb_tab);
 $bb_tab = preg_replace("/\:O/i","<img src=\"http://".$_SERVER['HTTP_HOST']."/images/bbcode/emotki/surprised.png\"/>",$bb_tab);
 $bb_tab = preg_replace("/\:P/i","<img src=\"http://".$_SERVER['HTTP_HOST']."/images/bbcode/emotki/tongue.png\"/>",$bb_tab);
 $bb_tab = preg_replace("/\;\)/i","<img src=\"http://".$_SERVER['HTTP_HOST']."/images/bbcode/emotki/wink.png\"/>",$bb_tab);
 $bb_tab = preg_replace("/\:D/i","<img src=\"http://".$_SERVER['HTTP_HOST']."/images/bbcode/emotki/happy.png\"/>",$bb_tab);
 $bb_tab = preg_replace("/\:\*/i","<img src=\"http://".$_SERVER['HTTP_HOST']."/images/bbcode/emotki/kiss.png\"/>",$bb_tab);
 $bb_tab = preg_replace("/\:-\)/i","<img src=\"http://".$_SERVER['HTTP_HOST']."/images/bbcode/emotki/smile.png\"/>",$bb_tab);
 $bb_tab = preg_replace("/\:-\(/i","<img src=\"http://".$_SERVER['HTTP_HOST']."/images/bbcode/emotki/unhappy.png\"/>",$bb_tab);
 $bb_tab = preg_replace("/\:-O/i","<img src=\"http://".$_SERVER['HTTP_HOST']."/images/bbcode/emotki/surprised.png\"/>",$bb_tab);
 $bb_tab = preg_replace("/\:-P/i","<img src=\"http://".$_SERVER['HTTP_HOST']."/images/bbcode/emotki/tongue.png\"/>",$bb_tab);
 $bb_tab = preg_replace("/\;-\)/i","<img src=\"http://".$_SERVER['HTTP_HOST']."/images/bbcode/emotki/wink.png\"/>",$bb_tab);
 $bb_tab = preg_replace("/\:-D/i","<img src=\"http://".$_SERVER['HTTP_HOST']."/images/bbcode/emotki/happy.png\"/>",$bb_tab);
 $bb_tab = preg_replace("/\:-\*/i","<img src=\"http://".$_SERVER['HTTP_HOST']."/images/bbcode/emotki/kiss.png\"/>",$bb_tab);

 $bb_tab = preg_replace("/\&/i","&amp;",$bb_tab);


	
 $bb_tab = preg_replace("/\[url=([^\\[]*)\]([^\\[]*)\[\/url\]/i","<a href=\"\\1\" style=\"text-decoration:underline\">\\2</a>",$bb_tab);
	
 // Kolor tekstu
 $bb_tab = preg_replace("/\[color=([^\\[]*)\]([^\\[]*)\[\/color\]/i","<span style=\"color:\\1\">\\2</span>",$bb_tab);
   
 // Rozmiar czcionki
 $bb_tab = preg_replace("/\[size=([^\\[]*)\]([^\\[]*)\[\/size\]/i","<span style='font-size:\\1px'>\\2</span>",$bb_tab);
   
 // Pogrubienie
 $bb_tab = preg_replace("/\[b\]([^\\[]*)\[\/b\]/i","<strong>\\1</strong>",$bb_tab);
 

 // Kursywa
 $bb_tab = preg_replace("/\[i\]([^\\[]*)\[\/i\]/i","<span style='font-style:italic'>\\1</span>",$bb_tab);
   
 // Podkreślenie
 $bb_tab = preg_replace("/\[u\]([^\\[]*)\[\/u\]/i","<span style='text-decoration:underline'>\\1</span>",$bb_tab);
   
 // Przekreślenie
 $bb_tab = preg_replace("/\[s\]([^\\[]*)\[\/s\]/i","<span style='text-decoration:line-through'>\\1</span>",$bb_tab);
   
 // Zamiana na wielkie litery
 $bb_tab = preg_replace("/\[upper\]([^\\[]*)\[\/upper\]/i","<span style='text-transform:uppercase'>\\1</span>",$bb_tab);
 
 // Zamiana na małe litery
 $bb = preg_replace("/\[lower\]([^\\[]*)\[\/lower\]/i","<span style='text-transform:lowercase'>\\1</span>",$bb_tab);
   
 return $bb_tab;
}

function utnij($tekst,$ile) {
$licz = strlen($tekst);

if ($licz>=$ile) {
$tnij = substr($tekst,0,$ile);
$uciete = $tnij."...";
}else {
$uciete = $tekst;
}
return $uciete;
}
?>