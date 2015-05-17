<?php
    class Jakas{
    
    static $suma=0;
    static $id;

     public function __construct()
    {
       $adres_ip_serwera_mysql = '127.0.0.1';
       $nazwa_bazy_danych = 'app';
       $login_bazy_danych = 'root';
       $haslo_bazy_danych = '';

       if (!mysql_connect($adres_ip_serwera_mysql, $login_bazy_danych,$haslo_bazy_danych)) 
       {
          echo 'Nie moge polaczyc sie z baza danych';
          exit (0);
      }                   

      if (!mysql_select_db($nazwa_bazy_danych)) 
      {
        echo 'Blad otwarcia bazy danych';
        exit (0);
    }
}

    public function filldiv() {    
        $loopResult = '';
        $wynik = mysql_query("SELECT idItem,name,price,quantity,priority FROM items
         WHERE idList=(SELECT idList FROM lists WHERE dateList=(SELECT max(dateList) FROM lists) AND idList=(SELECT max(idList) FROM lists) ) ")
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
                             <input class="img1" src="images/icon1.gif" type="submit" name="usuwanie"  '.self::$id=$r['idItem'].' />
                             </form>   
                             </td>
                        </tr>
                         <tr class="column6">
                            <td>
                             <form name="edytowaieProduktu" action="#" method="post">
                             <input class="img1" src="images/icon2.gif" type="submit" name="edytowanie" '.self::$id=$r['idItem'].' />
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

       public function usunPozycje(){
        $usun=$_POST['usuwanie'];
             if (isset($usun)){
                $numer = (int) self::$id;
                $sql = @mysql_query("DELETE FROM items WHERE idItem=$numer");
                 if($sql){
                echo '<meta http-equiv="refresh" content="1" />';
                }
            }

        }

        public function edytujPozycje(){
            if(isset($_POST['edytowanie'])){

            }
        }
        
    }
    ?>