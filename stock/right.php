    <div style="float:left">  
    <div id="news">
    	<div class="title"><h2>Pokazy</h2></div>
        <div class="show">
        <?php
		$zapytanie_pokazy = mysql_query("SELECT * FROM pokazy ORDER BY date DESC LIMIT 5") or die (mysql_error());
		$wynik_pokaz = mysql_fetch_assoc($zapytanie_pokazy);
		do{
							if ($wynik_pokaz['date'] > date('Y-m-d')){
				echo '<img style="position:absolute; margin:10px 0 0 240px" src="images/icons/new.gif" width="30px" height="30px"/>';
				}
			echo '<div class="pokazy">';
				echo $wynik_pokaz['date'].'<br />'.$wynik_pokaz['title'].'<br />'.$wynik_pokaz['where'];
			echo '</div>';
		}while ($wynik_pokaz = mysql_fetch_assoc($zapytanie_pokazy));
		
		?>
        </div>
        <div class="title1"><h2>Kontakt</h2></div>
        <div class="show" style="height:63px;">
        Irek "Melon" Mielnik<br />
		Tel. kom. 662628992<br />
		GG : <a href="gg:9194061">9194061</a>
        </div>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/pl_PL/all.js#xfbml=1";
			fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>
		<div class="fb-like-box" data-href="https://www.facebook.com/paradoxnysa" data-width="297" data-height="185" data-colorscheme="dark" data-show-faces="true" data-stream="false" data-header="false" data-show-border="false"></div>
    </div>
		
	<script type="text/javascript"> 
	function showhidechat(thechosenone) {
		var chat = document.getElementsByTagName("div");
			for(var x=0; x<chat.length; x++) {
				name = chat[x].getAttribute("name");
				if (name == 'chat') {
					if (chat[x].id == thechosenone) {
						if (chat[x].style.display == 'block') {
							chat[x].style.display = 'none';
							date = new Date();
							date.setDate(date.getDate() -1);
							document.cookie = escape("chat") + '=;expires=' + date;
							document.cookie = "chat=show";
						} else {
							chat[x].style.display = 'block';
							date = new Date();
							date.setDate(date.getDate() -1);
							document.cookie = escape("chat") + '=;expires=' + date;
							document.cookie = "chat=hide";
						}
					} else {
						chat[x].style.display = 'none';
						date = new Date();
						date.setDate(date.getDate() -1);
							document.cookie = escape("chat") + '=;expires=' + date;
							document.cookie = "chat=show";
					}
				}
			 }
			}	
	</script>
	<div name="chat" id="chat1" style="-webkit-box-shadow: -3px -4px 15px 0px rgba(50, 50, 50, 0.75); -moz-box-shadow: -3px -4px 15px 0px rgba(50, 50, 50, 0.75); box-shadow: -3px -4px 15px 0px rgba(50, 50, 50, 0.75); position: fixed; bottom: 0; right: 5px; max-width:350px; <?php if (($_COOKIE['chat'] == "show") || (!isset($_COOKIE['chat']))) { ?>display: block;<? }else{ ?>display: none; <?php } ?>">
		<div style="display:block; padding:5px">
			<div style="float:right"><a href="javascript:showhidechat('chat1')" title="Zamknij">X</a></div>
		</div>
		<div style="display:block">
			<iframe id="pokazy_show" src="data/chat/index.php" style="height: 310px; width:305px" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no"></iframe>
		</div>
	</div>
	<div name="chat" id="chat1" style="position: fixed; bottom: 0; right: 0; max-width:350px; padding:10px; <?php if (($_COOKIE['chat'] == "show") || (!isset($_COOKIE['chat']))) { ?>display: none;<? }else{ ?>display: block; <?php } ?>">
		<p><a href="javascript:showhidechat('chat1')">Chat Paradox<a/></p>
	</div>