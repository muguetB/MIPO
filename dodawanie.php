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

public function dodajListe(){
    if (isset($_POST['dodaj'])) {

        $name = $_POST['nameList'];
        $data=date(DATE_ATOM);

        // dodajemy rekord do bazy z bieżącą datą
        $sql = @mysql_query("INSERT INTO lists VALUES(nameList='$name',dateList='$data')");
           
        if($sql) 
            header('Location: mojelisty.php');
            else
                echo "Błąd";

          //  mysql_close(mysql_connect($adres_ip_serwera_mysql, $login_bazy_danych,$haslo_bazy_danych));
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
        $sql = @mysql_query("INSERT INTO items SET name='$name', price='$price',quantity='$quantity',note='$note', priority='$priority'");
               
        /*  if($sql)
            header('Location: glowna.php');
               else
                echo "błąd";
        */
           // mysql_close(mysql_connect($adres_ip_serwera_mysql, $login_bazy_danych,$haslo_bazy_danych));
        }
    }

    public function sortuj(){
       if (isset($_POST['sortuj'])) {
       
        $ins = @mysql_query("SELECT * FROM items ORDER BY priority");
    }
}

public function usun(){
   if (isset($_POST['usunListe'])) {

    $ins = @mysql_query("DELETE FROM items");
}
}
}