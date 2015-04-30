<?php
include('zbior.php');
    $zbior = new Zbior();
    $zbior->wyloguj();
if(!isset($_SESSION['zalogowany'])){
  $_SESSION['komunikat'] = "Nie jestes zalogowany!";
  include('zbior.php');
  exit();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta charset="utf-8">
            <title>Dokument bez tytuÅ‚u</title>
            <link href="style2.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
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
                    <li><a class="link1" href="mojeGrupy.html">Moje grupy</a></li>
                </ul>
            </div>
        </div>
        <div id="headerPan">
            <div id="headerPanleft">
                <div id="ourblog">
                    <h2><center>Nowa lista</center></h2>
                    <a href="#">&nbsp;</a> </div>
                <div id="listy">
                    <h2><center>Moje listy</center></h2>
                    <a href="mojelisty.html">&nbsp;</a> </div>
            </div>
            <div id="bodyPan">
                <div id="leftPan">
                    <div id="leftmemberPan">

                    </div>
                    <h2> Lista zakupów</h2>
                    <div class="podziel">
                        <ol>
                            <li><a href="#">PODZIEL SIĘ LISTĄ</a>
                                <ul>
                                    <li><a href="#" name="info"> <img src="images/icon3.gif"/>Dom</a></li>
                                    <li><a href="#" name="info"> <img src="images/icon3.gif"/>Biuro</a></li>
                                    <li><a href="#"> <img src="images/icon4.gif"/>Gosia L</a></li>
                                    <li><a href="#"> <img src="images/icon4.gif"/>Ewelina B</a></li>
                                    <li><a href="#"> <img src="images/icon4.gif"/>Aleksander T</a></li>
                                </ul>
                            </li>
                        </ol>
                    </div>
                    <div id="zmien">
                        <h2><center>Zmień nazwę</center></h2>
                        <a href="#">&nbsp;</a> </div>
                    <div id="usun">
                        <h2><center>Usuń listę</center></h2>
                        <a href="#">&nbsp;</a> </div>
                    <div id="kopiuj">
                        <h2><center>Kopiuj listę</center></h2>
                        <a href="#">&nbsp;</a> </div>
                    <div id="sortuj">
                        <h2><center>Sortuj</center></h2>
                        <a href="#">&nbsp;</a> </div>
                </div>
            </div>
            <div id="rightPan">
                <div id="rightbodyPan">
                    <h2><center><b>Nazwa listy</b></center></h2>
                    <h4>
                        <div class="b1">
                            <h2> Nowy produkt</h2
                            <a href="nowyprodukt.php">&nbsp;</a>
                        </div>
                      
                    </h4>
                    <?php filldiv() ?>
                    <div class="sum">
                        <h2 class="s1"> Suma: </h2>
                        <h2 class="s2">2,89 zł‚</h2>
                    </div>
                </div>
                <div id="noweokno">
                    <form name="dodajProdukt" id="dodajProdukt" action="#" method="post">
                        <h2>Dodaj produkt: </h2>
                        <input class="inputs" type="text" placeholder="nazwa" name="nazwa" />
                        <input class="inputs" type="text" required=required placeholder="ilosc" name="ilosc"/>
                        <input class="inputs" type="text" required=required placeholder="cena" name="cena"/>
                        <input class="inputs" type="text" required=required placeholder="priorytet" name="priorytet"/>
                        <input id="notatka" type="text" required=required placeholder="notatka" name="notatka"/>
                        <button id="button" type="submit" name="dodaj">Dodaj</button>
                        <button id="zakoncz" type="submit" name="zakoncz" onClick="location.href='glowna.php'">Zakończ</button>
                    </form>
                </div>
            </div>
        </div>

    </body>
    <?php
    $name = $_POST['nazwa'];
    $price = $_POST['cena'];
    $quantity = $_POST['ilosc'];
    $note = $_POST['notatka'];
    $priority = $_POST['priorytet'];
    $dodaj = $_POST['dodaj'];
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "app";

    if (isset($dodaj)) {
        $connection = @mysql_connect($servername, $username, $password)
                or die('Brak po³¹czenia z serwerem MySQL');
        $db = @mysql_select_db($dbname, $connection)
                or die('Nie mogê po³¹czyæ siê z baz¹ danych');

        // dodajemy rekord do bazy 
        $ins = @mysql_query("INSERT INTO items SET name='$name', price='$price',quantity='$quantity',note='$note', priority='$priority'");

        if ($ins)
            header("Location: nowyprodukt.html");
        else
            echo "B³¹d nie uda³o siê dodaæ nowego rekordu";
        mysql_close($connection);
    }

    function filldiv() {
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "app";
        $connection = @mysql_connect($servername, $username, $password)
                or die('Brak po³¹czenia z serwerem MySQL');
        $db = @mysql_select_db($dbname, $connection)
                or die('Nie mogê po³¹czyæ siê z baz¹ danych');

        $loopResult = '';
        $wynik = mysql_query("SELECT name,price,quantity,priority FROM items")
                or die('B³¹d zapytania');

        if (mysql_num_rows($wynik) > 0) {
            echo '<table id="table">';
            echo '<tr>
                            <th class="th1">Nazwa</th>
                            <th class="th2">Ilosc</th> 
                            <th class="th3">Cena</th>
                            <th class="th4">Priorytet</th>
                            <th class="th5"></th>
                        </tr>';
            
            while ($r = mysql_fetch_assoc($wynik)) {
                $loopResult .= ' 
                        <tr class="column1">
                            <td>' . $r['name'] . '</td>
                        </tr>
                        <tr class="column2">
                            <td>' . $r['quantity'] . '</td>
                        </tr>
                        <tr class="column3">
                            <td>' . $r['price'] . '</td>
                        </tr>
                        <tr class="column4">
                            <td>' . $r['priority'] . '</td>
                        </tr>
                        <tr class="column5">
                            <td><img class="img1" src="images/icon1.gif" type="button" name="usuwanie"/></td>
                        </tr>
                    ';
            }
             echo $loopResult;
             echo '</table>';
        }
       
    }
    ?>
</html>
