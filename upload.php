<?php 
session_start();
ob_start();
include ('data/conn.php');
include ('data/bbcode.php');
			if ((isset($_SESSION['user_id'])) && (isset($_SESSION['login']))){
?>
<script>
	function hidecookie()
	{
		var divCookie = document.getElementById("hideCookie");
		divCookie.style.display = "none";
		document.cookie = "hideCookie=hide";		
	}
</script>
<?php if ($_COOKIE['hideCookie'] != "hide") { ?>
<div style="position:fixed; wight: 100%; height:50px; display: block; margin:10px; z-index:1000; -webkit-box-shadow: 0px 0px 15px 0px rgba(50, 50, 50, 0.75); -moz-box-shadow: 0px 0px 15px 0px rgba(50, 50, 50, 0.75); box-shadow: 0px 0px 15px 0px rgba(50, 50, 50, 0.75);" class="tip" id="hideCookie" >
	<p>Zgodnie z art. 173 ustawy Prawa Telekomunikacyjnego informujemy, że przeglądając tę stronę wyrażasz zgodę na zapisywanie na Twoim komputerze niezbędnych do jej poprawnego funkcjonowania plików cookie. Wykorzystujemy pliki cookies, aby nasz serwis lepiej spełniał Państwa oczekiwania. Można zablokować zapisywanie cookies, zmieniając ustawienia przeglądarki. <a href="http://wszystkoociasteczkach.pl/" target="_blank">Czytaj więcej...</a><input type="button" class="button" onclick="javascript:hidecookie()" value="Akceptuj"/></p>
    <div style="clear: both"></div>
</div>
<?php } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Teatr tancerzy ognia Paradox</title>
</head>
	<link rel="stylesheet" href="data/css.css" type="text/css" />
<script type="text/javascript" src="data/jquery-1.3.2.js"></script>
<script type="text/javascript" src="data/swfupload/swfupload.js"></script>
<script type="text/javascript" src="data/jquery.swfupload.js"></script>
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
            <li><a href="./">Główna</a></li>
			<li><a href="page.php?id=1">Oferta</a></li>
            <li><a href="page.php?id=2">Grupa</a></li>
            <li><a href="page.php?id=3">Galeria</a></li>	
            <li><a href="page.php?id=4">Pokazy</a></li>
            <!-- <li><a href="page.php?id=5">Księga Gości</a></li>	 -->
        </ul>
    </div>

    <div id="group">
    </div>
    <div style="float:left">
    <div id="continer">
<script type="text/javascript">
$(function(){
	$('#swfupload-control').swfupload({
		upload_url: "upload-file.php",
		file_post_name: 'uploadfile',
		file_size_limit : "1024",
		file_types : "*.jpg;*.png;*.gif",
		file_types_description : "Image files",
		file_upload_limit : 7,
		flash_url : "data/swfupload.swf",
		button_image_url : 'images/buttons_upload.png',
		button_width : 114,
		button_height : 29,
		button_background : "#3f3f3f" ,
		button_placeholder : $('#button')[0],
		debug: false
	})
		.bind('fileQueued', function(event, file){
			var listitem='<li id="'+file.id+'" >'+
				'Plik: <em>'+file.name+'</em> ('+Math.round(file.size/1024)+' KB) <span class="progressvalue" ></span>'+
				'<div class="progressbar" ><div class="progress" ></div></div>'+
				'<p class="status" >Pending</p>'+
				'<span class="cancel" >&nbsp;</span>'+
				'</li>';
			$('#log').append(listitem);
			$('li#'+file.id+' .cancel').bind('click', function(){
				var swfu = $.swfupload.getInstance('#swfupload-control');
				swfu.cancelUpload(file.id);
				$('li#'+file.id).slideUp('fast');
			});
			// start the upload since it's queued
			$(this).swfupload('startUpload');
		})
		.bind('fileQueueError', function(event, file, errorCode, message){
			alert('Rozmiar pliku '+file.name+' jest większa niż limit');
		})
		.bind('fileDialogComplete', function(event, numFilesSelected, numFilesQueued){
			$('#queuestatus').text('Wybrane pliki: '+numFilesSelected+' / Pliki w kolejce: '+numFilesQueued);
		})
		.bind('uploadStart', function(event, file){
			$('#log li#'+file.id).find('p.status').text('Wgrywanie...');
			$('#log li#'+file.id).find('span.progressvalue').text('0%');
			$('#log li#'+file.id).find('span.cancel').hide();
		})
		.bind('uploadProgress', function(event, file, bytesLoaded){
			//Show Progress
			var percentage=Math.round((bytesLoaded/file.size)*100);
			$('#log li#'+file.id).find('div.progress').css('width', percentage+'%');
			$('#log li#'+file.id).find('span.progressvalue').text(percentage+'%');
		})
		.bind('uploadSuccess', function(event, file, serverData){
			var item=$('#log li#'+file.id);
			item.find('div.progress').css('width', '100%');
			item.find('span.progressvalue').text('100%');
			
			item.addClass('success').find('p.status').html('Gotowe!!!');
		})
		.bind('uploadComplete', function(event, file){
			// upload has completed, try the next one in the queue
			$(this).swfupload('startUpload');
		})
	
});	

</script>

<div id="swfupload-control">
	<p class="tip">Załącz 7 plików graficznych (jpg, png, gif), z których żaden nie może być większy niż 1 MB</p>
	<div align="center"><input type="button" id="button" value="dodaj" /></div>
	<p id="queuestatus" ></p>
	<ol id="log"></ol>
</div>
   </div>  
    </div>
    <div style="float:left">  
    </div>
	<?php include ('stock/right.php'); ?>
    </div>
    <div id="footer">
    Amateurishly © <?php echo date('Y'); ?> All Rights Reserved.  •  Designed by Aleksander Sowiak.
    </div>
</div>
</body>
</html>
<?php 			}else{
				header ('location: index.php');
			} ?>