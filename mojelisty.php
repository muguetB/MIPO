<?php
include('zbior.php');
$zbior = new Zbior();
$zbior->wyloguj();
if (!isset($_SESSION['zalogowany'])) {
    $_SESSION['komunikat'] = "Nie jestes zalogowany!";
    include('zbior.php');
    exit();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta charset="utf-8">
    <title>Mydło i Powidło</title>
    <link href="styleML.css" rel="stylesheet" type="text/css"/>
    <link href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
    <script src="js/dialog.js" type="text/javascript"></script>
    <link href="style2.css" rel="stylesheet" type="text/css"/>
</head>
<script>
$(document).ready(function() {
    $(function() {
        $("#dialog").dialog({
            autoOpen: false
        });
        $("#opener").on("click", function() {
            $("#dialog").dialog("open");
        });
    });
            // Validating Form Fields.....
            $("#submit").click(function(e) {

                alert("Dodano listę");
            });
        });
</script> 


<script>
$(document).ready(function() {
    $(function() {
        $("#dialog2").dialog({
            autoOpen: false
        });
        $(".edytowanie").on("click", function() {
         $("#dialog2").dialog("open");
         var id = $(this).attr('id');
         var elem  = document.getElementById("idListy");
         elem.value = id;
    //$.post('ajax/delete.php', { id: id } function(data) {
    });
    });
// Validating Form Fields.....
$("#submit").click(function(e) {
    alert("Zapisano zmiany!");
});
});
</script> 

<script>
var loadFile = function(event) {
    var output = document.getElementById('output');
    output.scr = null;
    output.src = URL.createObjectURL(event.target.files[0]);
};
</script>

<body>
 <div class="container">
    <div class="main">
        <div id="dialog" title="Nowa lista">
            <form action="" method="post">
                <input class="grupa_class" id="nazwa_listy" placeholder="Nazwa listy" name="nameList" type="text" required>
                <button id="button" type="submit" name="dodajListe">Dodaj</button>
            </form>
        </div>

        <div id="dialog2" title="Edytuj">
            <form id="formEdycja" action="#" method="post">
             <input name = "idListy" id="idListy" type="hidden" />
             <input id="new_nazwa_listy" placeholder="Nowa nazwa listy" name="nowaNazwa" type="text">
             <input class="buttonsListy" id="usun_btn" type="submit" name="zapisz" value="Zapisz zmiany"/> 
             <input class="buttonsListy" id="usun_btn" type="submit" name="usunTo" value="Usun"/> 
             <input class="buttonsListy" id="usun_btn" type="submit" name="edytujProdukty" value="Wyświetl listę" onClick="gotoGlowna()"/>
             <input class="buttonsListy" id="usun_btn" type="submit" name="share" value="Podziel się listą"/>
             </form>
        </div>

        <script>
        function gotoGlowna(){
            window.location="glowna.php"
        }
        </script>

        <div id="topPan"><a href="#"><img src="images/logo.gif" title="Green Solutions" alt="Green Solutions" /></a>
            <div id="topPanMenu">
                <img src="images/photo.gif"/>
                  <div class="konto">
                        <form method="post">
                            <a class="link2" href="zarzadzanieKontem.php">Moje konto</a>  
                            <input class="link2" id="wyloguj_btn" type="submit"  value="Wyloguj" name="wyloguj"/>

                        </form>
                    </div>
                <ul>
                    <li><a class="link1" href="glowna.php">Lista zakupów</a></li>
                    <li><a class="link1" href="mojeGrupy.php">Moje grupy</a></li>
                </ul>
            </div>
        </div>
        <div id="headerPan">
            <div id="bodyPan">
                <div id="leftPan">
                    <div id="nowaLista">
                        <h2><center>Nowa lista</center></h2>
                        <a id="opener" href="#"></a> </div>
                        <div id="mojeListy">
                            <h2><center>Moje listy</center></h2>
                            <a href="mojelisty.php"></a> </div>
                        </div>
                    </div>
                    <div id="rightPan">
                        <div id="rightbodyPan">
                        <?php
                           require("Lista.php");
                           $lista = new Wyswietlanie();
                           $lista -> filldiv();
                           require("pobieranieListy.php");
                           $j = new Lista();
                           $j->usunListe();
                           $j->edytujNazwe();
                           $j->zmianaListy();
                           ?>
                    </div>

                </div>
            </div>

        </body>
<?php
    include('dodawanie.php');
    $dodawaj = new Dodawanie();
    $dodawaj -> dodajListe();
  ?>
</html>
