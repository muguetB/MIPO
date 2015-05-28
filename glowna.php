<?php
include('zbior.php');
$zbior = new Zbior();
$zbior->wyloguj();
if (!isset($_SESSION['zalogowany'])) {
    $_SESSION['komunikat'] = "Nie jestes zalogowany!";
    include('zbior.php');
    exit();
}
include('dodawanie.php');
$dodawanie = new Dodawanie();
$dodawanie -> dodajProdukt();
$dodawanie -> sortuj();
$dodawanie -> usun();
$dodawanie -> dodajListe();
//$dodawanie -> zmienNazwe();
include("pomocnicza.php");
$j = new Jakas(); 
$j -> edytuj();
$j -> usun();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta charset="utf-8">
    <title>Mydło i Powidło</title>
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
        $("#zmienNazwe").dialog({
            autoOpen: false
        });
        $("#openerZmiana").on("click", function() {
            $("#zmienNazwe").dialog("open");
        });
    });
          $("#submit").click(function(e) {
                alert("Zmieniono nazwę!");
            });    
        });
</script> 

<script>
$(document).ready(function() {
    $(function() {
        $("#grupy").dialog({
            autoOpen: false
        });
        $("#openerUdostepnij").on("click", function() {
            $("#grupy").dialog("open");
        });
         $( "#grupy" ).dialog({
            width: 200
        });
    });
          $("#submit").click(function(e) {

                alert("Dodano grupę!");
            });    
        });
</script> 

<script>
$(document).ready(function() {
    $(function() {
        $("#dodawanieProduktu").dialog({
            autoOpen: false
        });

        $("#dodajP").on("click", function() {
            $("#dodawanieProduktu").dialog("open");
        });
        $( "#dodawanieProduktu" ).dialog({
            height: 330
        });
        $( "#dodawanieProduktu" ).dialog({
            width: 360
        });
    });
            // Validating Form Fields.....
            $("#submit").click(function(e) {

                alert("Dodano produkt!");
            });
        });
</script> 

<script>
$(document).ready(function() {
    $(function() {
        $("#dialog2").dialog({
            autoOpen: false
        });
        $(".img2").on("click", function() {
         $("#dialog2").dialog("open");
         var id = $(this).attr('id');
         var elem  = document.getElementById("hiddenId");
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

<script>
function closeDialog() { 
   document.getElementById("dodajProdukt").reset();

   $("#dodawanieProduktu").dialog("close");
} 
</script>


<body>
    <div class="container">
        <div class="main">
            <div id="dialog" title="Nowa lista">
                <form action="#" method="post">
                    <input class="grupa_class" id="nazwa_listy" placeholder="Nazwa listy" name="nameList" type="text" required>
                    <button id="button" type="submit" name="dodajListe">Dodaj</button>
                </form>
            </div>

            <div id="zmienNazwe" title="Zmiana nazwy listy">
                <form action="#" method="post">
                    <input class="inputs" id="zmianaNazwe" name="nowaNazwaListy" placeholder="Nazwa listy" type="text" required>
                    <button id="button" type="submit" name="zapisz">Zmien</button>
                </form>
            </div>

            <div id="grupy" title="Udostępnij">
                <form action="#" method="post">
                    <?php
                    $j -> wyswietlGrupy();
                    ?>
                    <br>
                    <button id="button" type="submit" name="share">Udostępnij!</button>
                </form>
            </div>

        <div id="dialog2" title="Edytuj">
            <form id="formEdycja" action="#" method="post">
             <input name = "idUsuwanego" id="hiddenId" type="hidden" />
             <?php
                $j -> utworzFormularz();
             ?>
             <input class="buttons" id="usun_btn" type="submit" name="zapisz" value="Zapisz zmiany"/> 
             <input class="buttons" id="usun_btn" type="submit" name="usunTo" value="Usun"/> 
             </form>
        </div>

            <div id="dodawanieProduktu" title="Dodaj produkt">
                <form name="dodajProdukt" id="dodajProdukt" action="#" method="post">
                    <input class="inputs" type="text" placeholder="nazwa" name="nazwa" />
                    <input class="inputs" type="text" required=required placeholder="ilosc" name="ilosc"/>
                    <input class="inputs" type="text" placeholder="cena" name="cena"/>
                    <p class="inputs">Priorytet</p>
                    <input type="radio" name="priorytet" value="tak" checked>Tak<input type="radio" name="priorytet" value="nie">Nie
                    <input id="notatka" type="text" placeholder="notatka" name="notatka"/>
                    <button id="button" type="submit" name="dodaj">Dodaj</button>
                    <button id="zakoncz" type="submit" name="zakoncz">Zakończ</button>
                   
                </form>
            </div>

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
                                

                                <h2> Lista zakupów</h2>
                                
                                <div id="udostepnij">
                                <h2><center>Udostępnij</center></h2>
                                <a id="openerUdostepnij" href="#"></a> </div>

                                <div id="zmien">
                                <h2><center>Zmień nazwę</center></h2>
                                <a id="openerZmiana" href="#"></a> </div>
                                 
                                <form class="menu" method="post">
                                    <input id="usun" type="submit" name="usunListe" value="Usuń listę" onClick="confirm('Czy na pewno usunąć listę?')">
                                </form>    
                                <form class="menu" method="post">
                                    <input id="sortuj" type="submit" name="sortuj" value="Sortuj">
                                </form> 
                                </div>
                            </div>
                                        <div id="rightPan">
                                            <div id="rightbodyPan">
                                                <?php   
                                                    $dodawanie -> wyswietlNazwe();
                                                ?>
                                                <h4>
                                                    <div class="b1">
                                                        <h2 id="dodajP"> Nowy produkt</h2>

                                                    </div>

                                                </h4>
                                                <?php 
                                                $lista = new Jakas();
                                                $lista->filldiv() 
                                                ?>
                                                <div class="sum">
                                                    <h2 class="s1"> Suma: </h2>
                                                    <?php $j->wypiszSume() ?>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </body>
                    </html>
