<?php
/**
 * Created by PhpStorm.
 * User: aso@ccp
 * Date: 22.10.14
 * Time: 13:10
 */
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