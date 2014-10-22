    <div style="float:left">
<div id="continer">

<script>
function createRequestObject() 
{
	var returnObj = false;
	
    if(window.XMLHttpRequest) {
        returnObj = new XMLHttpRequest();
    } else if(window.ActiveXObject) {
		try {
			returnObj = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
			try {
			returnObj = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e) {}
			}
			
    }
	return returnObj;
}
var http = createRequestObject();
var target;

function sendRequest(scriptFile, targetElement, name)
{	
	target = targetElement;
	try{
	http.open('get', scriptFile+name, true);
	}
	catch (e){
	document.getElementById(target).innerHTML = e;
	return;
	}
	http.onreadystatechange = handleResponse;
	http.send();	
}
function handleResponse()
{	
	if(http.readyState == 4) {		
	try{
		var strResponse = http.responseText;
		document.getElementById(target).innerHTML = strResponse;
		} catch (e){
		document.getElementById(target).innerHTML = e;
		}	
	}
}
</script>
<?php
if (isset($_GET['edit'])){
?>
<div style="height:385px" id="show_number">
	<?php if ($_GET['edit'] == 'history'){
		include ('edit/history.php');
	}else{
	 include ('edit/user.php'); 
     }
	 ?>
</div>
<?php
}else{
?>
<div style="height:385px" id="show_number">
<div align="center" style="padding:10px 6px">
<script>
function square_move(aaa){
	var boxx = document.getElementById (aaa);
	boxx.style.display = "block";
};
function square_out(aaa){
	var boxx = document.getElementById (aaa);
	boxx.style.display = "none";
};
</script>
	<div style="position:absolute; width:100px; height:100px; background:#000; opacity:0.3; border:3px solid #CCC; z-index:5; margin:110px 0 0 340px; display:none;" id="melon"></div>
	<div style="position:absolute; width:100px; height:100px; background:#000; opacity:0.3; border:3px solid #CCC; z-index:5; margin:92px 0 0 120px; display:none;" id="bercik"></div>
	<div style="position:absolute; width:100px; height:100px; background:#000; opacity:0.3; border:3px solid #CCC; z-index:5; margin:100px 0 0 160px; display:none;" id="bomba"></div>
    <div style="position:absolute; width:100px; height:100px; background:#000; opacity:0.3; border:3px solid #CCC; z-index:5; margin:110px 0 0 385px; display:none;" id="bozek"></div>
    <div style="position:absolute; width:100px; height:100px; background:#000; opacity:0.3; border:3px solid #CCC; z-index:5; margin:120px 0 0 300px; display:none;" id="orzech"></div>
    <div style="position:absolute; width:100px; height:100px; background:#000; opacity:0.3; border:3px solid #CCC; z-index:5; margin:120px 0 0 260px; display:none;" id="chabaz"></div>
    <div style="position:absolute; width:100px; height:100px; background:#000; opacity:0.3; border:3px solid #CCC; z-index:5; margin:100px 0 0 0px; display:none;" id="grucha"></div>
    <div style="position:absolute; width:100px; height:100px; background:#000; opacity:0.3; border:3px solid #CCC; z-index:5; margin:120px 0 0 65px; display:none;" id="justa"></div>
    <div style="position:absolute; width:100px; height:100px; background:#000; opacity:0.3; border:3px solid #CCC; z-index:5; margin:125px 0 0 200px; display:none;" id="zylwek"></div>
    
	<img src="images/paradox2.jpg" width="490" />
</div>
</div>
<?php } ?>

</div>
</div>

    <div style="float:left">
  <div id="offer" style="height:365px;">
    <a href="javascript:void()" onclick="javascript:sendRequest('stock/show_numer.php?user=', 'show_number', 'melon')" onmouseover="javascript:square_move('melon')" onmouseout="javascript:square_out('melon')"><div class="menu_offer" >Ireneusz Mielnik (Melon)</div></a>
    <a href="javascript:void()" onclick="javascript:sendRequest('stock/show_numer.php?user=', 'show_number', 'bercik')" onmouseover="javascript:square_move('bercik')" onmouseout="javascript:square_out('bercik')"><div class="menu_offer">Robert Mielnik (Bercik)</div></a>
    <a href="javascript:void()" onclick="javascript:sendRequest('stock/show_numer.php?user=', 'show_number', 'bozek')" onmouseover="javascript:square_move('bozek')" onmouseout="javascript:square_out('bozek')"><div class="menu_offer">Patryk Bożek (Bożek)</div></a>
    <a href="javascript:void()" onclick="javascript:sendRequest('stock/show_numer.php?user=', 'show_number', 'bomba')" onmouseover="javascript:square_move('bomba')" onmouseout="javascript:square_out('bomba')"><div class="menu_offer">Sebastian Bomba (Bomba)</div></a>
    <a href="javascript:void()" onclick="javascript:sendRequest('stock/show_numer.php?user=', 'show_number', 'orzech')" onmouseover="javascript:square_move('orzech')" onmouseout="javascript:square_out('orzech')"><div class="menu_offer">Rafał Michalewski (Orzech)</div></a>
    <a href="javascript:void()" onclick="javascript:sendRequest('stock/show_numer.php?user=', 'show_number', 'chabaz')" onmouseover="javascript:square_move('chabaz')" onmouseout="javascript:square_out('chabaz')"><div class="menu_offer">Michał Klakla (Chabaź)</div></a>
    <a href="javascript:void()" onclick="javascript:sendRequest('stock/show_numer.php?user=', 'show_number', 'grucha')" onmouseover="javascript:square_move('grucha')" onmouseout="javascript:square_out('grucha')"><div class="menu_offer">Mateusz Gruszka (Grucha)</div></a>
    <a href="javascript:void()" onclick="javascript:sendRequest('stock/show_numer.php?user=', 'show_number', 'justa')" onmouseover="javascript:square_move('justa')" onmouseout="javascript:square_out('justa')"><div class="menu_offer">Justyna Zelent (Justa)</div></a>
    <a href="javascript:void()" onclick="javascript:sendRequest('stock/show_numer.php?user=', 'show_number', 'zylwek')" onmouseover="javascript:square_move('zylwek')" onmouseout="javascript:square_out('zylwek')"><div class="menu_offer">Sylwia Klimas (Zylwek)</div></a>
  </div>
  </div>

  <div id="history">
	<?php include ('pages/history.php'); ?>
  </div>