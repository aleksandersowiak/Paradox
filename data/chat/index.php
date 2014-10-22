<?php 
session_start();
ob_start();
include ('../bbcode.php');
include ('../conn.php');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head> 
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <style type="text/css">
	a { color:orange; text-decoration:none; }
	a:hover { color:#D35400; cursor:pointer; }
    #daddy-shoutbox {
      padding: 5px;
      background: #000;
      color: white;
      width: 300px;
      font-family: Arial,Helvetica,sans-serif;
      font-size: 11px;
    }
    .shoutbox-list {
      border-bottom: 1px solid #627C98;
      
      padding: 5px;
      display: none;
    }
    #daddy-shoutbox-list {
      text-align: left;
      margin: 0px auto;
	  max-height:223px;
	  min-height:50px;
	  overflow:auto;
	  
    }
    #daddy-shoutbox-form {
      text-align: left;
      
    }
    .shoutbox-list-time {
      color: #8DA2B4;
	  width: 42px;
	  
    }
    .shoutbox-list-nick {
      margin-left: 5px;
      font-weight: bold;
	  color:white;
    }
    .shoutbox-list-message {
      margin-left: 5px;
    }
    .shoutbox-list-message iframe {
		width:270px !important;
		height: 180px !important;
	}
	.button {  
		-webkit-border-radius: 5px; 
		-moz-border-radius: 5px; 
		border-radius: 5px; 
		background:#3F3F3F; 
		color:#fff; 
		border:1px 
		solid #262626; 
		padding:5px; 
	}
	.button:hover {  
		-webkit-border-radius: 5px; 
		-moz-border-radius: 5px; 
		border-radius: 5px; 
		background:#262626; 
		color:#fff; 
		border:1px solid #3F3F3F; 
		padding:5px; 
		cursor:pointer; 
	}
	input { 
		background:#666; 
		border:1px solid #3F3F3F; 
		color:#fff; 
		padding:3px; 
	}
	table {
		padding:2px;
	}
      select.nickname_select { width: 20px; }
  </style>
  <script type="text/javascript" src="js/jquery-pack.js"></script>
  <script type="text/javascript" src="javascript/jquery.js"></script>
  <script type="text/javascript" src="javascript/jquery.form.js"></script>
</head>
  <body>

  <center>
  <div id="daddy-shoutbox">
  <div style="max-height:223px; overflov:auto; top:0;">
	<div class="last_message">

	</div>
    <div id="daddy-shoutbox-list"></div>
	</div>
	<div style="position:fixed; bottom:0; ">
    <form id="daddy-shoutbox-form" action="daddy-shoutbox.php?action=add" method="post"> 
    <table>
    <tr><td>Nick:</td><td><input id="nickname" type="text" name="nickname" autocomplete="off" <?php if (isset($_SESSION['login'])) { ?> readonly value="<?php echo $_SESSION['login']; ?>"<?php } ?>/>
    <?php
    if ((isset($_SESSION['user_id'])) && (isset($_SESSION['login']))){
    $zapytanie_uzytkownik = mysql_query("SELECT login, name, surname, email, admin FROM user WHERE id_user = '".$_SESSION['user_id']."'") or die (mysql_error());
    $wynik_uzytkownik = mysql_fetch_assoc($zapytanie_uzytkownik);
    ?>
            <script type="text/javascript">

                function changeFunc() {
                    var inputBox = document.getElementById("nickname");
                    var selectBox = document.getElementById("selectBox");
                    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
                    inputBox.value = selectedValue;
                }
            </script>
            <select id="selectBox" onchange="changeFunc();" class="nickname_select">
                <option value="<?php echo $wynik_uzytkownik['login']; ?>"><?php echo $wynik_uzytkownik['login']; ?></option>
                <option value="<?php echo $wynik_uzytkownik['name'].' '.$wynik_uzytkownik['surname']; ?>"><?php echo $wynik_uzytkownik['name'].' '.$wynik_uzytkownik['surname']; ?></option>
        </select>
    <?php } ?>
        </td></tr>
    <tr><td>Treść:</td><td><input type="text" name="message" autocomplete="off" /><input type="submit" value="Wyślij" class="button"/>
    <span id="daddy-shoutbox-response"></span></td></tr>

    </form>
	</div>
  </div>
  </center>
  <script type="text/javascript">
        var count = 0;
        var files = '';
        var lastTime = 0;
        
        function prepare(response) {
          var d = new Date();
          count++;
          d.setTime(response.time*1000);
          var mytime = d.getHours()+':'+d.getMinutes()+':'+d.getSeconds();
          var string = '<div class="shoutbox-list" id="list-'+count+'">'
              + '<span class="shoutbox-list-time">'+mytime+'</span>'
              + '<span class="shoutbox-list-nick">'+response.nickname+':</span>'
              + '<span class="shoutbox-list-message">'+response.message+'</span>'
              +'</div>';
          var objDiv = document.getElementById("daddy-shoutbox-list");
			objDiv.scrollTop = objDiv.scrollHeight;
          return string;
        }
        
        function success(response, status)  {
          if(status == 'success') {
            lastTime = response.time;
            $('#daddy-shoutbox-response').html('<img src="'+files+'images/accept.png" />');
            $('#daddy-shoutbox-list').append(prepare(response));
            $('input[@name=message]').attr('value', '').focus();
            $('#list-'+count).fadeIn('slow');
            timeoutID = setTimeout(refresh, 3000);
			var objDiv = document.getElementById("daddy-shoutbox-list");
objDiv.scrollTop = objDiv.scrollHeight;
          }
        }
        
        function validate(formData, jqForm, options) {

          for (var i=0; i < formData.length; i++) { 
              if (!formData[i].value) {
                  alert('Please fill in all the fields'); 
                  $('input[@name='+formData[i].name+']').css('background', 'red');
                  return false; 
				  var objDiv = document.getElementById("daddy-shoutbox-list");
objDiv.scrollTop = objDiv.scrollHeight;
              }
          }
          $('#daddy-shoutbox-response').html('<img src="'+files+'images/loader.gif" />');
          clearTimeout(timeoutID);
		  				  var objDiv = document.getElementById("daddy-shoutbox-list");
objDiv.scrollTop = objDiv.scrollHeight;
        }

        function refresh() {
          $.getJSON(files+"daddy-shoutbox.php?action=view&time="+lastTime, function(json) {
            if(json.length) {
              for(i=0; i < json.length; i++) {
                $('#daddy-shoutbox-list').append(prepare(json[i]));
                $('#list-' + count).fadeIn('slow');
				var objDiv = document.getElementById("daddy-shoutbox-list");
objDiv.scrollTop = objDiv.scrollHeight;
              }
             var j = i-1;
              lastTime = json[j].time;
            }
            //alert(lastTime);
          });
          timeoutID = setTimeout(refresh, 3000);
			var objDiv = document.getElementById("daddy-shoutbox-list");
objDiv.scrollTop = objDiv.scrollHeight;
        }
        
        // wait for the DOM to be loaded 
        $(document).ready(function() { 
            var options = { 
              dataType:       'json',
              beforeSubmit:   validate,
              success:        success
            }; 
            $('#daddy-shoutbox-form').ajaxForm(options);
            timeoutID = setTimeout(refresh, 10);
			var objDiv = document.getElementById("daddy-shoutbox-list");
objDiv.scrollTop = objDiv.scrollHeight;
        });
  </script>

  </td></tr>

</table>
</body>
</html>