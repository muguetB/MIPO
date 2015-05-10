<?php
    class Jakas{
    
    static $suma=0;

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
        $wynik = mysql_query("SELECT name,price,quantity,priority FROM items")
                or die('Błąd zapytania');

        if (mysql_num_rows($wynik) > 0) {
            echo '<table id="table">';
            echo '<tr>
                    <th class="th1">Nazwa</th>
                    <th class="th2">Ilosc</th> 
                    <th class="th3">Cena</th>
                    <th class="th4">Piorytet</th>
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
                            <td>
                             <form name="usunProdukt" action="#" method="post">
                             <img class="img1" src="images/icon1.gif" type="submit" name="usuwanie"/>
                             </form>   
                             </td>
                        </tr>
                    ';
                self::$suma+=$r['price'];
            }
             echo $loopResult;
             echo '</table>';
        }
    }

        public function wypiszSume(){
            echo '<h2 class="s2">' .self::$suma. '</h2>';
        }

       public function usun($id){
        $usun=$_POST['usuwanie'];
             if (isset($usun)){
                $sql = @mysql_query("DELETE FROM items WHERE name==$id");
            }

        }
        
    }
    ?>