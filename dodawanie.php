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

}

public function wyswietlNazwe(){
        $login = $_SESSION['login'];
        $nazwaListy = @mysql_query("SELECT nameList FROM lists WHERE dateList=(SELECT max(dateList) FROM lists) AND
        idList=(SELECT max(idList) FROM lists) AND 
        idUser=(SELECT idUser FROM users WHERE login='$login') or idList IN
        (SELECT idList FROM grouplists WHERE idGroup IN (SELECT idGroup FROM groupmembers WHERE userLogin='$login'))")
        

        or die("nie udało się :( "); 
        $r = mysql_fetch_assoc($nazwaListy);
        echo '<h2><center><b>'.$r['nameList'].'</b></center></h2>';
}

public function zmienNazwe(){
    if (isset($_POST['zapiszNazwe'])) {
      $login = $_SESSION['login'];
      $nameList = $_POST['nowaNazwaListy'];
      $sql = mysql_query("UPDATE lists SET nameList='$nameList' WHERE dateList=(SELECT max(dateList) FROM (SELECT * FROM lists) AS sth) AND idList=(SELECT max(idList) FROM (SELECT * FROM lists) AS sth) AND
         idUser=(SELECT idUser FROM users WHERE login='$login')") or die(mysql_error());
      if($sql){
        echo '<meta http-equiv="refresh" content="1" />';
      }
    }
}

public function dodajListe(){
    if (isset($_POST['dodajListe'])) {
        $login = $_SESSION['login'];
        $name = $_POST['nameList'];
        $data=date(DATE_ATOM);
        $id = mysql_query("SELECT idUser FROM users WHERE login='$login'");

        $sql = mysql_query("INSERT INTO lists SET nameList='$name',dateList='$data', idUser=(SELECT idUser FROM users WHERE login='$login')");   
        if($sql){
        echo '<meta http-equiv="refresh" content="1" />';
      }
        self::close();
        }
    }

    public function dodajProdukt(){
        if (isset($_POST['dodaj'])) {
        $login = $_SESSION['login'];
        $name = $_POST['nazwa'];
        $price = $_POST['cena'];
        $quantity = $_POST['ilosc'];
        $note = $_POST['notatka'];
        $priority = $_POST['priorytet'];
        $data=date(DATE_ATOM);
        $sqlLista = mysql_query("SELECT idList FROM lists WHERE idUser=(SELECT idUser FROM users WHERE login='$login')");
        if(mysql_num_rows($sqlLista)<1){
           mysql_query("INSERT INTO lists SET nameList='LISTA',dateList='$data', idUser=(SELECT idUser FROM users WHERE login='$login')"); 
        }
        // dodajemy rekord do bazy 
        $sql = @mysql_query("INSERT INTO items SET name='$name', price='$price',quantity='$quantity',note='$note', priority='$priority', 
          idList=(SELECT idList FROM lists WHERE dateList=(SELECT max(dateList) FROM lists) AND idList=(SELECT max(idList) FROM lists) AND idUser=(SELECT idUser FROM users WHERE login='$login')) ");
       // var_dump($sql);
        if($sql){
        echo '<meta http-equiv="refresh" content="1" />';
      }
               
        self::close();
        }
    }

    public function sortuj(){
       if (isset($_POST['sortuj'])) {
        $login = $_SESSION['login'];
        $ins = mysql_query("SELECT * FROM items  ORDER BY priority DESC") or die(mysql_error());
     
        
        self::close();
      }
    } 

public function usun(){
   if (isset($_POST['usunTak'])) {
    $login = $_SESSION['login'];
    $ins = @mysql_query("DELETE FROM items WHERE 
          idList=(SELECT idList FROM lists WHERE dateList=(SELECT max(dateList) FROM lists)
           AND idList=(SELECT max(idList) FROM lists) AND idUser=(SELECT idUser FROM users WHERE login='$login'))") or die("NIE UDAŁO SIĘ");

    $usuwanieListy = mysql_query("DELETE FROM lists WHERE idUser=(SELECT idUser FROM users WHERE login='$login')") or die("NOOO KICHA");
    //$usuwanieListy = mysql_query("DELETE TOP 1 FROM lists WHERE idUser=(SELECT idUser FROM users WHERE login='$login') ORDER BY idList,dateList DESC ") or die("NOOO KICHA");

    if($ins){
        echo '<meta http-equiv="refresh" content="1" />';
      }
    
    }
  }


}