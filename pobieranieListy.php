<?php
class Lista{

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
        $wynik = mysql_query("SELECT idList, nameList,udostepnione FROM lists WHERE idUser=(SELECT idUser FROM users WHERE login='$login') ")
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
                <input class="edytowanie" id="'.$r['idList'].'" src="images/icon2.gif" type="image" />    
                </td>
                </tr>
                ';
            }
            echo $loopResult;
            echo '</table>';
        }
    }

    public function usunListe(){
          if(isset($_POST['usunTo'])){
              if(isset($_POST['idListy'])){
                $idListy = $_POST['idListy'];
                //echo $idListy;
                $sqlUpdate = "DELETE FROM lists WHERE idList='$idListy'"; 
                if (mysql_query($sqlUpdate)) {
                  // echo "usunieto";
               } 
               else {
                   echo "Error updating record: " . $conn->error;
               }
           }
       }
    }

    public function edytujNazwe(){
        if(isset($_POST['zapisz'])){
         $idListy = $_POST['idListy'];
         $nameG = $_POST['nowaNazwa'];
         $sqlUpdate = "UPDATE lists SET nameList='$nameG' WHERE idList='$idListy'";
         
         if (mysql_query($sqlUpdate)) {
            echo '<meta http-equiv="refresh" content="1" />';
         }
          else {
         echo "Error updating record: " . $conn->error;
         }
         }
    }

    public function zmianaListy(){

        if(isset($_POST['edytujProdukty'])){
            if(isset($_POST['idListy'])){
                $idListy = $_POST['idListy'];
                $temp = mysql_query("SELECT MAX(idList) FROM lists");
                $temp2 = mysql_result( $temp, 0) ;

                 $date = mysql_query("SELECT MAX(dateList) FROM lists");
                $date2 = mysql_result( $date,0) ;
                
                $sql = mysql_query("UPDATE lists SET idList=$temp2+1, dateList='$date2' WHERE idList='$idListy'");
                $sql2 = mysql_query("UPDATE items SET idList=$temp2+1, dateList='$date2' WHERE idList='$idListy'");
              
            }
        }
    }

}
?>