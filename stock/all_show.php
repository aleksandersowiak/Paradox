<?php 
session_start();
ob_start();
include ('../data/conn.php');
include ('../data/bbcode.php');
if ((isset($_SESSION['user_id'])) && (isset($_SESSION['login']))){
?>
<style>
body { color:#fff; }
a { color:orange; text-decoration:none; }
a:hover { color:#D35400; cursor:pointer; }
#scrollbar_container { position:relative; width:500px; padding-bottom:5px; } 
#scrollbar_track { position:absolute; right:2px; height:100%; width:8px; } 
#scrollbar_handle { width:10px; background-color:orange; cursor:move; -moz-border-radius: 5px; -webkit-border-radius: 5px; opacity:0.9; -moz-opacity:0.9;} 
#scrollbar_content { padding:10px 20px 10px 10px; color:white; height:362px; overflow:hidden; height:357px; } 
.delete { background:url('../images/cancel.png') no-repeat; width:20px; height:20px; border:0; }
.delete:hover {cursor:pointer; }
</style>

		<script src="../data/all.js?1256410438" type="text/javascript"></script>
        <script>
		document.observe('dom:loaded',function(){		
			var scrollbar = new Control.ScrollBar('scrollbar_content','scrollbar_track');	
		});
		</script>
		<div id="pokazy_show">
    	<div id="scrollbar_container">
		<div id="scrollbar_track">
        <div id="scrollbar_handle" class="selected" style="position: relative; height: 91.37426900584795px; top: 0px; "></div></div>
		<div id="scrollbar_content" class="scrolling">
        <table>     
			<?php
			$zapytanie_pokazy_all = mysql_query ("SELECT * FROM pokazy ORDER BY date DESC") or die (mysql_error());
			$wynik_pokaz_all = mysql_fetch_assoc($zapytanie_pokazy_all);
				do{
					echo '<tr>';
					echo '<td width="80px;">'.$wynik_pokaz_all['date'].'</td>';
					echo '<td>'.$wynik_pokaz_all['title'].'</td>';
					echo '<td>'.$wynik_pokaz_all['where'].'</td>';
					echo '<td><a target="_parent" href="../upload_show.php?dell='.$wynik_pokaz_all['id_pokaz'].'"><input type="button" class="delete" title="Usuń pokaz"/></a></td>';
					echo '</tr>';
					}while ($wynik_pokaz_all = mysql_fetch_assoc($zapytanie_pokazy_all));
			?>
        </table>
   				</div>
	</div>
    </div>
	</div>
	<?php } ?>