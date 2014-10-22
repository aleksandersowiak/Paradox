<?php
if ((isset($_SESSION['user_id'])) && (isset($_SESSION['login']))){
if (isset($_GET['dell'])){
	mysql_query("DELETE FROM pokazy WHERE id_pokaz='".$_GET['dell']."'")  
    or die(mysql_error()); 
    echo '<div class="success">Pokaz został usunięty z bazy danych</div>';
      header( "refresh:2;url=upload_show.php" );	
}else{
	echo $data = $_POST['date'];
	echo $title = $_POST['title'];
	echo $where = $_POST['where'];
	//INSERT INTO pokazy (`date`,`title`,`where`) VALUES ('$date','$title','$where')";
	$zapytanie="INSERT INTO pokazy (`date`, `title`, `where`) VALUES ('$data', '$title', '$where')";
	
   mysql_query($zapytanie) or die(mysql_error());
   
   echo '<div class="success">Pokaz został dodany do bazy danych</div>';
     header( "refresh:2;url=upload_show.php" );
}
			}
?>