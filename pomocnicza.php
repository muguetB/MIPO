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

public function close(){

       $adres_ip_serwera_mysql = '127.0.0.1';
       $nazwa_bazy_danych = 'app';
       $login_bazy_danych = 'root';
       $haslo_bazy_danych = '';   

        mysql_close(mysql_connect($adres_ip_serwera_mysql, $login_bazy_danych,$haslo_bazy_danych)); 
}

    public function filldiv() {   
        $login = $_SESSION['login']; 
        $loopResult = '';
        $wynik = mysql_query("SELECT idItem,name,price,quantity,priority FROM items
         WHERE idList=(SELECT idList FROM lists WHERE dateList=(SELECT max(dateList) FROM lists) AND idList=(SELECT max(idList) FROM lists)
          AND idUser=(SELECT idUser FROM users WHERE login='$login') )")
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
                            
                        </tr>
                         <tr class="column6">
                            <td>
                             <input id="'.$r['idItem'].'" type="image" class="img2"  src="images/icon2.gif"/>  
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

   public function utworzFormularz(){
    $numer = $_POST['idUsuwanego'];
    //echo $numer;
    $wynik = mysql_query("SELECT name,price,quantity,priority,note FROM items WHERE idItem='$numer'");
    $r = mysql_fetch_array($wynik);
            echo '
            <input class="inputs" type="text" placeholder="nazwa" name="nazwa" value="'.$r['name'].'"/>
            <input class="inputs" type="text" required=required placeholder="ilosc" name="ilosc" value="'.$r['quantity'].'"/>
            <input class="inputs" type="text" placeholder="cena" name="cena" value="'.$r['price'].'"/>
            <p class="inputs">Priorytet</p>
            <input type="radio" name="priorytet" value="tak" checked>Tak<input type="radio" name="priorytet" value="'.$r['priority'].'">Nie
            <input id="notatka" type="text" placeholder="notatka" name="notatka"note value="'.$r['note'].'"/>                
            ';
   }

   public function usun(){
        if(isset($_POST['usunTo'])){
              if(isset($_POST['idUsuwanego'])){
                $idItem = $_POST['idUsuwanego'];
                $sqlUpdate = "DELETE FROM items WHERE idItem='$idItem'"; 
                if (mysql_query($sqlUpdate)) {
                  // echo "czyżby się udało?";
               } 
               else {
                   echo "Error updating record: " . $conn->error;
               }
           }
       }
       self::close();
   }

   public function edytuj(){ 
    if(isset($_POST['zapisz'])){
     if(isset($_POST['idUsuwanego'])){
         $numer = $_POST['idUsuwanego'];
         $name = $_POST['nazwa'];
         $price = $_POST['cena'];
         $quantity = $_POST['ilosc'];
         $note = $_POST['notatka'];
         $priority = $_POST['priorytet'];

         $sqlUpdate = "UPDATE items SET name='$name', price='$price',quantity='$quantity',note='$note',
                priority='$priority' WHERE idItem='$numer'";      
      }
    }
    self::close();
}


public function wyswietlGrupy(){
    $nazwa;
    $login = $_SESSION['login'];

    $sql = mysql_query("SELECT groupName FROM groups");
   
   // $sql = mysql_query("SELECT groupName FROM groups WHERE idGroup=(SELECT idGroup FROM groupmembers WHERE userLogin='$login')");
        if (mysql_num_rows($sql) > 0) {
         while ($r = mysql_fetch_assoc($sql)) {
             echo ' <input type="checkbox" name="groupName[]" value="'.$r['groupName'].'">'.$r['groupName']. '<br>';
             }
        }

    if(isset($_POST['share'])){
         $aDoor = $_POST['groupName'];
    if(empty($aDoor)){
        //echo("You didn't select any buildings.");
    }     
    else{
    $N = count($aDoor);
    //echo("You selected $N door(s): ");
        for($i=0; $i < $N; $i++)
        {
      //echo($aDoor[$i] . " ");
        $nazwa = $aDoor[$i];
         $sql = @mysql_query("INSERT INTO groupmembers SET idGroup=(SELECT idGroup FROM groups WHERE groupName='$nazwa'), userLogin='$login'");

        if($sql){
           echo '<meta http-equiv="refresh" content="1" />';
        }

        $sql2 = @mysql_query("INSERT INTO grouplists SET idGroup=(SELECT idGroup FROM groups WHERE groupName='$nazwa'), 
            idList=(SELECT idList FROM lists WHERE dateList=(SELECT max(dateList) FROM lists) AND idList=(SELECT max(idList) FROM lists)) ");
        if($sql2){
           echo '<meta http-equiv="refresh" content="1" />';
        }
        }
    }

       
    }
    self::close();
    }
}
?>


               
                