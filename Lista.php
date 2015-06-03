 <?php

 class Wyswietlanie{

 public function filldiv() {
        $login = $_SESSION['login']; 
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "app";
        $connection = @mysql_connect($servername, $username, $password)
        or die('Brak połączenia z serwerem MySQL');
        $db = @mysql_select_db($dbname, $connection)
        or die('Nie mogę połączyć się z bazą danych');

        $loopResult = '';
        $wynik = mysql_query("SELECT idList, nameList,udostepnione FROM lists WHERE idUser=(SELECT idUser FROM users WHERE login='$login') or idList IN
        (SELECT idList FROM grouplists WHERE idGroup IN (SELECT idGroup FROM groupmembers WHERE userLogin='$login') )")
        or die(mysql_error());

        


        if (mysql_num_rows($wynik) > 0) {
            echo '<table id="table2">';
            echo '<tr>
            <th class="th1">Nazwa</th>
            </tr>';
            
            while ($r = mysql_fetch_assoc($wynik)) {
                $loopResult .= ' 
                <tr class="column1">
                <td>
                <input class="edytowanie" id="'.$r['idList'].'" type="button" value="'.$r['nameList'].'"/> 
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