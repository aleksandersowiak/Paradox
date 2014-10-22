<?php
$uploaddir = 'gallery/'; 
$file = basename($_FILES['uploadfile']['name']); 
$size=$_FILES['uploadfile']['size'];
if($size>1048576)
{
	echo "error file size > 1 MB";
	unlink($_FILES['uploadfile']['tmp_name']);
	exit;
}

	$max_height = "600";
	$max_width = "780";
							
	$allowed_image_types = array('image/pjpeg'=>"jpg",'image/jpeg'=>"jpg",'image/jpg'=>"jpg",'image/png'=>"png",'image/x-png'=>"png",'image/gif'=>"gif");
	$allowed_image_ext = array_unique($allowed_image_types);
	$image_ext = "";	
	foreach ($allowed_image_ext as $mime_type => $ext) {
		$image_ext.= strtoupper($ext)." ";
	}
	$file_ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
	
	//////////////////
	
	function normalize ($string) {
    $table = array(
		'Ę'=>'e', 'Ó'=>'o', 'Ą'=>'a', 'Ś'=>'s', 'Ł'=>'l', 'Ż'=>'z', 'Ź'=>'z', 'Ć'=>'c', 'Ń'=>'n', 'ę'=>'e', 'ó'=>'o', 
		'ą'=>'a', 'ś'=>'s', 'ł'=>'l', 'ż'=>'z', 'ź'=>'z', 'ć'=>'c', 'ń'=>'n', 
        'Š'=>'s', 'š'=>'s', 'Đ'=>'dj', 'đ'=>'dj', 'Ž'=>'z', 'ž'=>'z', 'Č'=>'c', 'č'=>'c', 'Ć'=>'c', 'ć'=>'c',
        'À'=>'a', 'Á'=>'a', 'Â'=>'a', 'Ã'=>'a', 'Ä'=>'a', 'Å'=>'a', 'Æ'=>'a', 'Ç'=>'c', 'È'=>'e', 'É'=>'e',
        'Ê'=>'e', 'Ë'=>'e', 'Ì'=>'i', 'Í'=>'i', 'Î'=>'i', 'Ï'=>'i', 'Ñ'=>'n', 'Ò'=>'O', 'Ó'=>'o', 'Ô'=>'O',
        'Õ'=>'o', 'Ö'=>'o', 'Ø'=>'o', 'Ù'=>'u', 'Ú'=>'u', 'Û'=>'u', 'Ü'=>'u', 'Ý'=>'y', 'Þ'=>'b', 'ß'=>'ss',
        'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
        'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
        'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
        'ÿ'=>'y', 'Ŕ'=>'r', 'ŕ'=>'r', ' '=>'_',
    );
    
    return strtr($string, $table);
}
	/////////////////
	$large_image_location = $uploaddir.strtolower(normalize($file));
	function resizeImage($image,$width,$height,$scale) {
	list($imagewidth, $imageheight, $imageType) = getimagesize($image);
	$imageType = image_type_to_mime_type($imageType);
	$newImageWidth = ceil($width * $scale);
	$newImageHeight = ceil($height * $scale);
	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
	switch($imageType) {
		case "image/gif":
			$source=imagecreatefromgif($image); 
			break;
	    case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			$source=imagecreatefromjpeg($image); 
			break;
	    case "image/png":
		case "image/x-png":
			$source=imagecreatefrompng($image); 
			break;
  	}
	imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
	
	switch($imageType) {
		case "image/gif":
	  		imagegif($newImage,$image); 
			break;
      	case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
	  		imagejpeg($newImage,$image,90); 
			break;
		case "image/png":
		case "image/x-png":
			imagepng($newImage,$image);  
			break;
    }
	
	chmod($image, 0777);
	return $image;
}

if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $large_image_location)) { 
move_uploaded_file($userfile_tmp, $large_image_location);
			chmod($large_image_location, 0777);
			$check = getimagesize($large_image_location);
            $width =  $check[0];
            $height = $check[1];	
			if ($width > $max_width){
				$scale = $max_width/$width;
				$uploaded = resizeImage($large_image_location,$width,$height,$scale);
			}elseif ($height > $max_height){
				$scale = $max_height/$height;
				$uploaded = resizeImage($large_image_location,$width,$height,$scale);
			}else{
				$scale = 1;
				$uploaded = resizeImage($large_image_location,$width,$height,$scale);
			}
			
			$bookList = array();
			$i=0;
			$xmlReader = new XMLReader();
			$xmlReader->open('plik.xml');
			while($xmlReader->read()){
				if($xmlReader->nodeType == XMLReader::ELEMENT) {
					if($xmlReader->localName == 'adress') {
						$bookList[$i]['adress'] = $xmlReader->getAttribute('link');
						$i++;
					}
				}
			}
			
			$link = ceil($i);
			$x = $link+1;
			
			$data = date('Y-M-d');
			
				$xml = simplexml_load_file ('plik.xml'); 
				$sxe = new SimpleXMLElement (  $xml -> asXML () ); 
				$photo = $sxe->addChild('photo', $x );
				$photo->addAttribute('id_photo', $x );
				$albume = $photo->addChild('albume', $albume );
				$albume->addAttribute('album', $albume );		
				$adress = $photo->addChild('adress', $large_image_location );
				$adress->addAttribute('link', $large_image_location );			
				$data = $photo->addChild('date', $data );
				$data->addAttribute('data', $data );
				$sxe -> asXML ( 'plik.xml' ); 

} else {
	echo "error ".$_FILES['uploadfile']['error']." --- ".$_FILES['uploadfile']['tmp_name']." %%% ".$file."($size)";
}
?>