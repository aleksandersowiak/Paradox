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
            <li class="current"><a href="./">Główna</a></li>
            <li><a href="page.php?id=1">Oferta</a></li>
            <li><a href="page.php?id=2">Grupa</a></li>
            <li><a href="page.php?id=3">Galeria</a></li>	
            <li><a href="page.php?id=4">Pokazy</a></li>
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
    <div id="continer" style="height:427px;">

            <?php 
			if ((isset($_SESSION['user_id'])) && (isset($_SESSION['login']))){
			?>
    <div style="float:right;">
    <input type="submit" value="" class="img_edit" title="Edytuj Wpis" onclick="window.location='index.php?edit=frontpage'"/>
    </div>
    <?php } ?>
    <h2>Nowości</h2>
    <?php if ($_GET['edit'] == 'frontpage') {
		include ('edit/frontpage.php');
	}else{
		?>
		<script src="data/all.js?1256410438" type="text/javascript"></script>
        <script>
		document.observe('dom:loaded',function(){		
			var scrollbar = new Control.ScrollBar('scrollbar_content','scrollbar_track');	
		});
		</script>
    	<div id="scrollbar_container">
		<div id="scrollbar_track">
        <div id="scrollbar_handle" class="selected" style="position: relative; height: 91.37426900584795px; top: 0px; "></div></div>
		<div id="scrollbar_content" class="scrolling">
		<?php
		$zapytanie_front_page = mysql_query ("SELECT frontpage FROM containers");
		$wynik_front_page = mysql_fetch_assoc($zapytanie_front_page);
		do{
			echo bbcode($wynik_front_page['frontpage']);
		}while ($wynik_front_page = mysql_fetch_assoc($zapytanie_front_page));
		?>
   				</div>
	</div>
    <?php } ?>
    </div>
    <div id="cos" style="height:185px">
    	<h2 style="float:left">Ostatnio dodane zdjęcia i filmy</h2>
        <div style="float:right; margin:15px 10px auto;"><a href="page.php?id=3">Zobacz wszystkie</a></div>    
		<script>
		function createDiv(){
		var continer = document.getElementById("continer");
		   var newdiv = document.createElement('div');
		   var divIdName = 'box_img';
		   newdiv.setAttribute('id',divIdName);
////////////////////////////////
		   var next = document.createElement('a');
		   var prev = document.createElement('a');
		   next.setAttribute('id','next');
		   prev.setAttribute('id','prev');
////////////////////////////////
		var attr = arguments[0];
		var z = attr;
		var max_width = 780;
		var max_height = 600;
		function nastepny() {
			var w = z ;
			if (w == w){
				w = z++;
		xmlDoc=loadXMLDoc("plik.xml");
		x=xmlDoc.getElementsByTagName('photo');
			txt=xmlDoc.getElementsByTagName("photo")[w].getAttribute("id_photo");
				if (prev.style.display = "none"){
				prev.style.display = "block";	
				}
				if (x.length == w+1)
				{
					next.style.display = "none";
				}else{ 
					next.style.display = "block";
				}
				adressa=xmlDoc.getElementsByTagName("adress")[w].getAttribute("link");
				img.src = adressa;
			}
		}
		function poprzedni() {
		xmlDoc=loadXMLDoc("plik.xml");
		x=xmlDoc.getElementsByTagName('photo');
			var w = z ;
			if (w == w){
				w = z--;	
				if (next.style.display = "none"){
				next.style.display = "block";	
				}
				if (w <= 2)
				{
					prev.style.display = "none";
				}else{ 
					prev.style.display = "block";
				}
			txt=xmlDoc.getElementsByTagName("photo")[w-2].getAttribute("id_photo");
				adressa=xmlDoc.getElementsByTagName("adress")[w-2].getAttribute("link");
				img.src = adressa;
			}
		}
			next.addEventListener('click', nastepny , true);   
			prev.addEventListener('click', poprzedni , true);	
///////////////////////////////////
		  var lnk = document.createElement('a');
		   if(lnk.addEventListener){
			 lnk.addEventListener('click', (function(i){
					  return function(){
							continer.removeChild(i)}
					  })(newdiv), false);
		   }else
			if(lnk.attachEvent){
			 lnk.attachEvent('onclick', (function(i){
					  return function(){
							continer.removeChild(i)}
					  })(newdiv));
		   }else{
			 lnk.onclick = (function(i){
					  return function(){
							continer.removeChild(i)}
					  })(newdiv);
		   };
		   var img = document.createElement("IMG");
		   function loadXMLDoc(dname){
			if (window.XMLHttpRequest){
				xhttp=new XMLHttpRequest();
			}else{
				xhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xhttp.open("GET",dname,false);
			xhttp.send();
			return xhttp.responseXML;
		}
		xmlDoc=loadXMLDoc("plik.xml");
		x=xmlDoc.getElementsByTagName('photo');
		for (i=0;i<x.length;i++){
			txt=xmlDoc.getElementsByTagName("photo")[i].getAttribute("id_photo");
			if (txt == z){
				adress=xmlDoc.getElementsByTagName("adress")[i].getAttribute("link");
				img.src = adress;
		  
				if (i == 0)
				{
					prev.style.display = "none";
				}else{ 
					prev.style.display = "block";
				}
				if (x.length == txt)
				{
					next.style.display = "none";
				}else{ 
					next.style.display = "block";
				}
			}
		}
		/////////////////
 			newdiv.appendChild(next);
		   	newdiv.appendChild(prev);
			var oblicz = (max_height-img.height)/2;	
		  	newdiv.appendChild(img);
		////////////////
		   	lnk.appendChild(document.createTextNode("Zamknij"));
		   	lnk.setAttribute('id','clouse');
		   	newdiv.appendChild(lnk);
		   	continer.appendChild(newdiv);
		   
		};
		</script>
   		<div id="tS2" class="jThumbnailScroller">
			<div class="jTscrollerContainer">
				<div class="jTscroller">
				<?php
				$bookList = array();
				$i=0;
				$xmlReader = new XMLReader();
				$xmlReader->open('plik.xml');
				do{
					if($xmlReader->nodeType == XMLReader::ELEMENT) {
						if($xmlReader->localName == 'photo') {
							$bookList[$i]['photo'] = $xmlReader->getAttribute('id_photo');
							$id = $bookList[$i]['photo'];
						}
						if($xmlReader->localName == 'adress') {
							$bookList[$i]['adress'] = $xmlReader->getAttribute('link');
							$img = $bookList[$i]['adress'];
							$i++;
						}
							
						
					}
				}while($xmlReader->read());
								$link = ceil($i);
								if ($link >= 11){
									$k = 10;
								}else{
									$k = $link;
								}
								
				for ($x=0; $x <= $k;$x++){ 
					if ($bookList[$i]['photo'] == '' ){ $i--; }else{
						$w = $i;
						
						if ($bookList[$i]['photo'] == '0'){}else{
							echo '<a onclick= "createDiv('.$bookList[$i]['photo'].')"><div style="background:url(\''.$bookList[$i]['adress'].'\') 50% 50%; width:100px; height:100px;" id="div"></div></a>';
							 
						}
						$i--; 
					}
				}
				?>    
				</div>
			</div>
            <a href="#" class="jTscrollerPrevButton"></a>
            <a href="#" class="jTscrollerNextButton"></a>
		</div>
<script>
jQuery.noConflict(); 
(function($){
window.onload=function(){ 
	$("#tS1").thumbnailScroller({ 
		scrollerType:"hoverAccelerate", 
		scrollerOrientation:"horizontal", 
		scrollEasing:"easeOutCirc", 
		scrollEasingAmount:800, 
		acceleration:4, 
		scrollSpeed:800, 
		noScrollCenterSpace:10, 
		autoScrolling:0, 
		autoScrollingSpeed:2000, 
		autoScrollingEasing:"easeInOutQuad", 
		autoScrollingDelay:500 
	});
	$("#tS2").thumbnailScroller({ 
		scrollerType:"clickButtons", 
		scrollerOrientation:"horizontal", 
		scrollSpeed:2, 
		scrollEasing:"easeOutCirc", 
		scrollEasingAmount:600, 
		acceleration:4, 
		scrollSpeed:800, 
		noScrollCenterSpace:10, 
		autoScrolling:0, 
		autoScrollingSpeed:2000, 
		autoScrollingEasing:"easeInOutQuad", 
		autoScrollingDelay:500 
	});
	$("#tS3").thumbnailScroller({ 
		scrollerType:"hoverPrecise", 
		scrollerOrientation:"vertical", 
		scrollSpeed:2, 
		scrollEasing:"easeOutCirc", 
		scrollEasingAmount:800, 
		acceleration:4, 
		scrollSpeed:800, 
		noScrollCenterSpace:10, 
		autoScrolling:0, 
		autoScrollingSpeed:2000, 
		autoScrollingEasing:"easeInOutQuad", 
		autoScrollingDelay:500 
	});
}
})(jQuery);
</script>
    </div>  
    </div>
	<?php include ('stock/right.php'); ?>
    </div>
    <div id="footer">
    Amateurishly © <?php echo date('Y'); ?> All Rights Reserved.  •  Designed by Aleksander Sowiak.
    </div>
</div>
</body>
</html>