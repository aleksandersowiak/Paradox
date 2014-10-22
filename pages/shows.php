<h2 style="background:#3f3f3f;">pokazy</h2>
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
                <?php
		$zapytanie_pokazy = mysql_query("SELECT * FROM pokazy ORDER BY date DESC") or die (mysql_error());
		$wynik_pokaz = mysql_fetch_assoc($zapytanie_pokazy);
		echo '<table width="780px;">';
		do{
			echo '<tr>';
				echo '<td width="50px">'.$wynik_pokaz['date'].'</td><td width="200px">'.$wynik_pokaz['title'].'</td><td width="170px">'.$wynik_pokaz['where'].'</td>';
				        					if ($wynik_pokaz['date'] > date('Y-m-d')){
				echo '<td width="30px"><img src="images/icons/new.gif" width="30px" height="30px"/></td>';
				}
			echo '</tr>';

		}while ($wynik_pokaz = mysql_fetch_assoc($zapytanie_pokazy));
		
		?>
        </table>
        </div>
        </div>		
