    <div style="float:left">
    <div id="continer">
                <?php 
			if ((isset($_SESSION['user_id'])) && (isset($_SESSION['login']))){
			?>
    <div style="float:right;">
    <input type="submit" value="" class="img_edit" title="Edytuj Wpis" onclick="window.location='page.php?id=<?php echo $_GET['id']; ?>&read=<?php echo $_GET['read']; ?>&edit=offer'"/>
    </div>
    <?php } ?>
    	<script src="data/all.js?1256410438" type="text/javascript"></script>
        <script>
		document.observe('dom:loaded',function(){		
			var scrollbar = new Control.ScrollBar('scrollbar_content','scrollbar_track');	
		});
		</script>
        <div style="height:423px">
        
        <?php 

		$read = $_GET['read'];
		if ($read == '1'){
			$title = 'Fire Show';
			$table = 'offer_fireshow';
		}elseif ($read == '2'){
			$title = 'Light Show';
			$table = 'offer_light_show';
		}elseif ($read == '3'){
			$title = 'Występy Kuglarskie';
			$table = 'offer_kug';
		}elseif ($read == '4'){
			$title = 'Warsztaty';
			$table = 'workshops';
		}elseif ($read == '5'){
			$title = 'Lampiony Szczęścia';
			$table = 'lanterns';
		}else{
			$title = 'Oferta';
			$table = 'offer_front_page';
		}
		if ($_GET['edit'] == 'offer'){
			include ('edit/offer.php');
		}else{
		echo '<h2>'.$title.'</h2>';
		?>
        
		<div id="scrollbar_container">
		<div id="scrollbar_track">
        <div id="scrollbar_handle" class="selected" style="position: relative; height: 91.37426900584795px; top: 0px; "></div></div>
		<div id="scrollbar_content" class="scrolling">
   
			<?php
			
			$zapytanie_offer = mysql_query ("SELECT ".$table." FROM containers") or die (mysql_error());
			$wynik_offer = mysql_fetch_assoc($zapytanie_offer);
				do{
					echo bbcode($wynik_offer[$table]);
					}while ($wynik_offer = mysql_fetch_assoc($zapytanie_offer));
		}
			?>

   				</div>
	</div>
    <div id="cos">
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
		xmlDoc=loadXMLDoc("images/offer/<?php echo $table; ?>/<?php echo $table; ?>.xml");
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
		xmlDoc=loadXMLDoc("images/offer/<?php echo $table; ?>/<?php echo $table; ?>.xml");
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
		xmlDoc=loadXMLDoc("images/offer/<?php echo $table; ?>/<?php echo $table; ?>.xml");
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
    	<h2 style="float:left">Zdjęcia <?php echo $title; ?></h2>
		<div id="tS2" class="jThumbnailScroller">
			<div class="jTscrollerContainer">
				<div class="jTscroller">
				<?php
				$bookList = array();
				$i=0;
				$xmlReader = new XMLReader();
				$xmlReader->open('images/offer/'.$table.'/'.$table.'.xml');
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
				for ($x=0; $x <= $link ;$x++){ 
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
    
<?php if ($_GET['edit'] == 'offer'){ ?>
	<div style="float:left">
	  <div id="offer">
	  <a href="page.php?id=1&read=1&edit=offer"><div class="menu_offer">Fire Show</div></a>
	  <a href="page.php?id=1&read=2&edit=offer"><div class="menu_offer">Light Show</div></a>
	  <a href="page.php?id=1&read=3&edit=offer"><div class="menu_offer">Występy Kuglarskie</div></a>
	  <a href="page.php?id=1&read=4&edit=offer"><div class="menu_offer">Warsztaty</div></a>
	  <a href="page.php?id=1&read=5&edit=offer"><div class="menu_offer">Lampiony Szczęścia</div></a>
	  </div>
	</div>
  <?php }else{ ?>
  </div>
    </div>
  <div style="float:left">
	  <div id="offer">
	  <a href="page.php?id=1&read=1"><div class="menu_offer">Fire Show</div></a>
	  <a href="page.php?id=1&read=2"><div class="menu_offer">Light Show</div></a>
	  <a href="page.php?id=1&read=3"><div class="menu_offer">Występy Kuglarskie</div></a>
	  <a href="page.php?id=1&read=4"><div class="menu_offer">Warsztaty</div></a>
	  <a href="page.php?id=1&read=5"><div class="menu_offer">Lampiony Szczęścia</div></a>
	  </div>
  </div>
  <?php } ?>