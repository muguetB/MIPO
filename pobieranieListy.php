<?php
class Lista{

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

                
                $sql = mysql_query("UPDATE lists SET idList='$temp2'+1, dateList='$date2' WHERE idList='$idListy'");
                $sql2 = mysql_query("UPDATE items SET idList='$temp2'+1  WHERE idList='$idListy'");
                echo "<script> document.location.href='glowna.php';</script>";
                

              
            }
        }   
    }

}
?>
<script type="text/javascript">
    $(document).ready(function() {
        $("#idListy").click(function() {
            alert("hej");
        });
    });
</script>
<script type="text/javascript">
      $(function () {
          $.each($('#tr td'), function (key, value) {

              var el = $(value);
              var link = el.find('a').attr('href');
              var dif = link.localeCompare(window.location.pathname);
              var dif2 = ("/" + link).localeCompare(window.location.pathname);

              if (dif == 0 || dif2 == 0) {
                  el.addId('current');
              }

          });
      });
      </script>