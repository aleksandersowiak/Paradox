<h2 style="background:#3f3f3f;">Galleria grupy PaRaDoX</h2>
		<script src="data/all.js?1256410438" type="text/javascript"></script>
        <script>
		document.observe('dom:loaded',function(){		
			var scrollbar = new Control.ScrollBar('scrollbar_content','scrollbar_track');	
		});
		</script>
    	<div id="scrollbar_container" style="height:571px;; width:800px; background:url('') repeat-x #3f3f3f;">
		<div id="scrollbar_track">
        <div id="scrollbar_handle" class="selected" style="position: relative; height: 91.37426900584795px; top: 0px; "></div></div>
		<div id="scrollbar_content" class="scrolling" style="height:551px;">

		<script>
		function createDiv(){
		var continer = document.getElementById("scrollbar_container");
		   var newdiv = document.createElement('div');
		   var divIdName = 'box_img_gal';
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
<?php
$test_txt = file_exists('plik.xml'); //sprawdzenie czy plik istnieje
    if (!$test_txt) //jeżeli plik nie istnieje (zmienna $test=FALSE)  
    { 
    include ('data/error.html');
    }
    else
    {
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
									$k = $link;
								
								
				for ($x=0; $x <= $k;$x++){ 
					if ($bookList[$i]['photo'] == '' ){ $i--; }else{
						$w = $i;
						
						if ($bookList[$i]['photo'] == '0'){}else{
							echo '<div id="galery">
							<div class="inside"><div onclick= "createDiv('.$bookList[$i]['photo'].')" style="background:url(\''.$bookList[$i]['adress'].'\') 50% 50%; width:94px; height:94px;" id="div"></div></div>
                            </div>';
							 
						}
						$i--; 
					}
				}
	}
				?>    							
			</div>		
            </div>