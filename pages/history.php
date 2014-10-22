		<script src="data/all.js?1256410438" type="text/javascript"></script>
        <script>
		document.observe('dom:loaded',function(){		
			var scrollbar = new Control.ScrollBar('scrollbar_content','scrollbar_track');	
		});
		</script>

        <div id="scrollbar_container" style="width:800px; height:225px">
		<div id="scrollbar_track" >
        <div id="scrollbar_handle" class="selected" style="position: relative; height: 91.37426900584795px; top: 0px; "></div></div>
		<div id="scrollbar_content" class="scrolling"  style="width:770px; height:211px; text-align:justify;">
               <?php
        			if ((isset($_SESSION['user_id'])) && (isset($_SESSION['login']))){
			?>
    <div style="float:right;">
    <input type="submit" value="" class="img_edit" title="Edytuj Wpis" onclick="window.location='page.php?id=2&edit=history'"/>
    </div>
<?php } ?>
        <h2>Historia Grupy</h2>
<?php
$zapytanie_history = mysql_query("SELECT history FROM containers");
$wynik_history= mysql_fetch_assoc($zapytanie_history);
echo bbcode($wynik_history['history']);
?>
       
        </div>
        </div>
        