 <?php
 class Dodawanie{


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

public function wyswietlNazwe(){
        $nazwaListy = mysql_query("SELECT nameList FROM lists WHERE dateList=(SELECT max(dateList) FROM lists) AND idList=(SELECT max(idList) FROM lists)");
        $r = mysql_fetch_assoc($nazwaListy);
        echo '<h2><center><b>'.$r['nameList'].'</b></center></h2>';
        self::close();
}

public function zmienNazwe(){
    if (isset($_POST['zmiana'])) {
      $nameList = $_POST['nowaNazwaListy'];

      $sql = @mysql_query("UPDATE lists SET nameList='$nameList' WHERE dateList=(SELECT max(dateList) FROM lists) AND idList=(SELECT max(idList) FROM lists)");

      if($sql){
        echo '<meta http-equiv="refresh" content="1" />';
      }
      self::close();
    }
}


public function dodajListe(){
    if (isset($_POST['dodajListe'])) {

        $name = $_POST['nameList'];
        $data=date(DATE_ATOM);
        
        // dodajemy rekord do bazy z bieżącą datą
        $sql = @mysql_query("INSERT INTO lists SET nameList='$name',dateList='$data'");
           
        if($sql){
        echo '<meta http-equiv="refresh" content="1" />';
      }
        self::close();
        }
    }

    public function dodajProdukt(){
        if (isset($_POST['dodaj'])) {
        $name = $_POST['nazwa'];
        $price = $_POST['cena'];
        $quantity = $_POST['ilosc'];
        $note = $_POST['notatka'];
        $priority = $_POST['priorytet'];

        // dodajemy rekord do bazy 
        $sql = @mysql_query("INSERT INTO items SET name='$name', price='$price',quantity='$quantity',note='$note',
         priority='$priority', idList=(SELECT idList FROM lists WHERE dateList=(SELECT max(dateList) FROM lists) AND idList=(SELECT max(idList) FROM lists)) ");

        if($sql){
        echo '<meta http-equiv="refresh" content="1" />';
      }
               
        self::close();
        }
    }

    public function sortuj(){
       if (isset($_POST['sortuj'])) {
       
        $ins = @mysql_query("SELECT * FROM items ORDER BY priority");

        if($ins){
        echo '<meta http-equiv="refresh" content="1" />';
      }
        
        self::close();
      }
    } 

public function usun(){
   if (isset($_POST['usunListe'])) {

    $ins = @mysql_query("DELETE FROM items");

    if($ins){
        echo '<meta http-equiv="refresh" content="1" />';
      }
    
    self::close();
    }
  }


}