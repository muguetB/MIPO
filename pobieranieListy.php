<?php
class Lista{

    public function filldiv() {
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "app";
        $connection = @mysql_connect($servername, $username, $password)
        or die('Brak połączenia z serwerem MySQL');
        $db = @mysql_select_db($dbname, $connection)
        or die('Nie mogę połączyć się z bazą danych');

        $loopResult = '';
        $wynik = mysql_query("SELECT nameList,udostepnione FROM lists")
        or die('Błąd zapytania');

        if (mysql_num_rows($wynik) > 0) {
            echo '<table id="table2">';
            echo '<tr>
            <th class="th1">Nazwa</th>
            <th class="th2">Udostępnione dla:</th>
            <th class="th3"></th>
            <th class="th4"></th>
            </tr>';
            
            while ($r = mysql_fetch_assoc($wynik)) {
                $loopResult .= ' 
                <tr class="column1">
                <td>' . $r['nameList'] . '</td>
                </tr>
                <tr class="column2">
                <td>' . $r['udostepnione'] . '</td>
                </tr>
                <tr class="column3">
                <td>
                <form name="edytujListe" action="#" method="post">
                <img class="img2" src="images/icon2.gif" type="submit" name="edytowanie"/>
                </form>     
                </td>
                </tr>
                <tr class="column4">
                <td>
                <form name="usunListe" action="#" method="post">
                <img class="img1" src="images/icon1.gif" type="submit" name="usuwanie"/>
                </form>   
                </td>
                </tr>
                ';
            }
            echo $loopResult;
            echo '</table>';
        }
    }

}
?>