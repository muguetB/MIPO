<?php
include('zbior.php');
$zbior = new Zbior();
$zbior->wyloguj();
if (!isset($_SESSION['zalogowany'])) {
    $_SESSION['komunikat'] = "Nie jestes zalogowany!";
    include('zbior.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Mydło i powidło</title>
<link href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
<script src="js/dialog.js" type="text/javascript"></script>
<link href="style2.css" rel="stylesheet" type="text/css"/>
</head>


<script> 
jQuery(document).ready(function(){
    $( "#dodaj_czlonkow_grupy" ).autocomplete({
      source: "suggestions.php"
    });
  });
	</script> 


 <script>
 $(document).ready(function() {
$(function() {
$("#dialog").dialog({
autoOpen: false
});
$("#opener").on("click", function() {
$("#dialog").dialog("open");
});
});

$("#submit").click(function(e) {
alert("Dodano grupę!");
});
});

/*Po naciœniêciu przycisku odpalane jest okno dialogowe i pobierane id tego zdjêcia.
 * Potem przekazywane jest do php */
 $(document).ready(function() {
$(function() {
$("#dialog2").dialog({
autoOpen: false
});
$(".editable").on("click", function() {
   $("#dialog2").dialog("open");
   var id = $(this).attr('id');
   var elem  = document.getElementById("hiddenId");
   var elem2 = document.getElementById("hiddenId2");
   elem.value = id;
   elem2.value = id;
});
});

// Validating Form Fields.....
$("#submit").click(function(e) {
alert("Zapisano zmiany!");
});
});


 $(document).ready(function() {
$(function() {
$("#dialog3").dialog({
autoOpen: false
});
$("#dodaj_czlonkow_btn").on("click", function() {
  closeEdit();
$("#dialog3").dialog("open");
});
});

$("#submit").click(function(e) {
alert("Dodano grupę!");
});
});

</script> 



<script>
  var loadFile = function(event) {
    var  input = document.getElementById('chosen_pic');
    var file = input.files[0];
    if(file.size > 100000) {  
       alert("Rozmiar pliku jest za duży! Wybierz inny");
    }
    else{
    var output = document.getElementById('output');
    output.scr = null;
    output.src = URL.createObjectURL(event.target.files[0]);

    }
    
  };
  
 function dodaj()
{
    var objTo = document.getElementById('new_input');
    var divtest = document.createElement("div");
    divtest.innerHTML = '<input class="grupa_class" id="dodaj_czlonkow_grupy" placeholder="Dodaj członków" name="czlonkowie[]" type="text">\n\
<button id="usun_czlonkow" onClick="usun()" type="button">Usun</button>';
    objTo.appendChild(divtest);

      $("input:text[id^='dodaj_czlonkow_grupy']").autocomplete({
      source: "suggestions.php"
    });          
 }

 function dodaj2()
{
    var objTo = document.getElementById('new_input2');
    var divtest = document.createElement("div");
    divtest.innerHTML = '<input class="grupa_class" id="dodaj_czlonkow_grupy" placeholder="Dodaj członków" name="czlonkowie[]" type="text">\n\
<button id="usun_czlonkow" onClick="usun2()" type="button">Usun</button>';
    objTo.appendChild(divtest);

      $("input:text[id^='dodaj_czlonkow_grupy']").autocomplete({
      source: "suggestions.php"
    });          
 }

function usun(){
 var elem = document.getElementById("new_input").lastChild;
 elem.remove();
}

function usun2(){
 var elem = document.getElementById("new_input2").lastChild;
 elem.remove();
}

function closeDialog() { 
 document.getElementById("formGrupa").reset();
 var img = document.getElementById('output');
 img.src = 'images/grupafoto.png';
 
 var elem = document.getElementById("new_input");
 elem.remove(elem.childNodes);

  var elem2 = document.getElementById("new_input2");
 elem2.remove(elem2.childNodes);

    $("#dialog").dialog("close");
    $("#dialog3").dialog("close");
    
} 


function closeEdit() { 
 document.getElementById("formEdycja").reset();
    $("#dialog2").dialog("close");
    
} 

 $(document).ready(function() {
    if ($('div.message').length > 0) {
        $('div.message').css('position', 'absolute')
                                .css('top', '25%')
                                .css('margin', '5% 45%');
        setTimeout(function() {
            $('div.message').fadeOut(1600);
        }, 1800);
    }
});

 

</script>

<body>
    <div class="container">
       <div class="main">

       <div id="dialog" title="Nowa grupa">
         <form id="formGrupa"  method="post" enctype="multipart/form-data">
         
         <input class="grupa_class" id="nazwa_grupy" placeholder="Nazwa grupy" name="nazwa_grupy" type="text" required>
           
             <label id="komunikat_label">  
             </label>
         <div id="new_input">
           <input class="grupa_class" id="dodaj_czlonkow_grupy" placeholder="Dodaj członków" name="czlonkowie[]" type="text">
           </div>
        <button id="dodaj_czlonkow" onClick="dodaj()" type="button">Dodaj</button> 
        <img id="output" src="images/grupafoto.png" height="80px" width="80px"/>
        <input type="file" name="image" accept=".jpeg,.jpg" id="chosen_pic" accept="image/*" onchange="loadFile(event)" background-color="#a0b7b0">
        <label id="formatPliku">Wymagany format pliku- jpg</label>
        <input class="buttons" id="submit_nowa_grupa" name="submit_nowa_grupa" type="submit" value="Dodaj">
        <button class="buttons" id="anuluj_btn" type="button" onclick="closeDialog()">Anuluj</button> 
       </form>
    </div>
           
           <div id="dialog2" title="Edytuj">
         <form id="formEdycja" action="mojeGrupy.php" method="post">
             <input name = "hiddenId" id="hiddenId" type="hidden" />
             <input  id="new_nazwa_grupy" placeholder="Nowa nazwa grupy" name="new_nazwa_grupy" type="text">
             <input class="buttons" id="anuluj_btn2"  onclick="closeEdit()" type="submit" value="Anuluj"/>
             <input class="buttons" id="zapisz_btn" name="saveGroup"  type="submit" value="Zapisz"/>
             <input class="buttons" id="usun_btn"  type="submit" name="deleteGroup" value="Usun grupe"/> 
             <input class="buttons" id="dodaj_czlonkow_btn" name="dodaj_czlonkow_btn" value="Dodaj członków grupy"/> 
       </form>
</div>

       <div id="dialog3" title="Dodaj członków grupy">
         <form id="formGrupa"  method="post">
          <input name = "hiddenId2" id="hiddenId2" type="hidden" />
         <div id="new_input2">
           <input class="grupa_class" id="dodaj_czlonkow_grupy" placeholder="Dodaj członków" name="czlonkowie2[]" type="text">
           </div>
        <button id="dodaj_czlonkow" onClick="dodaj2()" type="button">Dodaj</button> 
        <input class="buttons"  name="submit_nowi_czlonkowie" type="submit" value="Dodaj">
        <button class="buttons" id="anuluj_btn" type="button" onclick="closeDialog()">Anuluj</button> 
       </form>
    </div>

    </div>
       </div>
       

 
<div id="topPan"><a href="#"><img src="images/logo.gif" title="Green Solutions" alt="Green Solutions" /></a>
  <div id="topPanMenu">
      <img src="images/photo.gif"/>
        <div class="konto">
                        <form method="post">
                            <a class="link2" href="zarzadzanieKontem.php">Moje konto</a>  
                            <input class="link2" id="wyloguj_btn" type="submit"  value="Wyloguj" name="wyloguj"/>

                        </form>
                    </div>
    <ul>
        <li><a class="link1" href="glowna.php">Lista zakupów</a></li>
        <li><a class="link1" href="#">Moje grupy</a></li>
    </ul>
  </div>
</div>
<div id="headerPan">
  <div id="headerPanleft">
    <div id="nowaGrupa">
        <h2>Nowa grupa</h2>
        <a id="opener" href="#">&nbsp;</a> </div>
</div>

    <div id="rightPan">
    <div id="rightbodyPan">
        <img id="grupy_img" src = "images/grupy.png" height="40" alt = "grupy"/> 
          <?php
                  $j = new Jakas();
                   $j->filldiv()
                    ?>
   
    </div>
    </div>
 </body>
 
   <?php
     $servername = "127.0.0.1";
     $username = "root";
     $password = "";
     $dbname = "app";
     $sql="";
     //$message = "";
     $login = $_SESSION['login'];
     $groupIDglobal;
     
      mysql_connect($servername, $username, $password);
      mysql_select_db($dbname);
      
 /*Obs³uga edytowania - po klikniêciu jest uruchamiania odpowiednia funkcja */
    if(isset($_POST['saveGroup'])){
        editGroup();
    }elseif(isset($_POST['deleteGroup'])){
        deleteGroup();
    }
    elseif(isset($_POST['submit_nowi_czlonkowie'])){
        addNewUsers();
    }


    function editGroup()
        { 
         if(isset($_POST['hiddenId'])){
          $message = "";
         $groupId = $_POST['hiddenId'];
        
         $nameG = $_POST['new_nazwa_grupy'];
         $sqlUpdate = "UPDATE groups SET groupName='$nameG' WHERE idGroup='$groupId'";
         
         if (mysql_query($sqlUpdate)) {
          $message .= ' <div class="message">
           <p>
           Zmieniono nazwę!
            </p>
           </div>';
           echo $message;
         } else {
         echo "Error updating record: " . $conn->error;
         }

        
         echo '<meta http-equiv="refresh" content="1" />';
    }
  }
    function deleteGroup()
    {
       if(isset($_POST['hiddenId'])){
         $message = "";
         $groupId = $_POST['hiddenId'];
         $sqlUpdate = "DELETE FROM groups WHERE idGroup='$groupId'";
         $sqlDeleteUsers = "DELETE FROM groupmembers WHERE idGroup='$groupId'";
         
         if (mysql_query($sqlUpdate)&&mysql_query($sqlDeleteUsers)) {
          $message .= ' <div class="message">
           <p>
           Usunięto grupe!
            </p>
          </div>';
   echo $message;
         } else {
         echo "Error updating record: " . $conn->error;
         }

        
          echo '<meta http-equiv="refresh" content="1" />';
 
       
         }
    }

       function addNewUsers()
    {
        if(isset($_POST['hiddenId2'])){
          $message = "";
          $czlonkowie2 = $_POST['czlonkowie2'];
          $groupId =  $_POST['hiddenId2'];
         foreach($czlonkowie2 as $czlonkowie){
             $sqlAddUser = "INSERT INTO groupmembers(idGroup, userLogin) VALUES ('$groupId','$czlonkowie' )";
             mysql_query($sqlAddUser);
           }
          
         if (mysql_query($sqlAddUser)) {
          $message .= ' <div class="message">
           <p>
           Dodano członków!
            </p>
          </div>';
   echo $message;
         } else {
         echo "Error updating record: " . $conn->error;
         }

        
          echo '<meta http-equiv="refresh" content="1" />';
 
       
         }
    }

    
   //// 
     if(isset($_POST['submit_nowa_grupa'])){

      $name = $_POST['nazwa_grupy'];
      $czlonkowie = $_POST['czlonkowie'];
      
     
      $query = mysql_query("SELECT groupName FROM groups WHERE groupName = '". $name."'");

      if (mysql_num_rows($query) != 0){
           
       echo " Grupa o podanej nazwie istnieje, sprobuj inna nazwe!";
      }
      else{
      
       if(isset($_FILES['image']) && $_FILES['image']['size'] > 0){

        $tmpName = $_FILES['image']['tmp_name'];
        $fp = fopen($tmpName, 'r');
        $data = fread($fp, filesize($tmpName));
        $data = addslashes($data);
        fclose($fp);
        $sql = "INSERT INTO groups (groupName, groupPhoto)
        VALUES ('$name','$data')";
       
      }
    else{
        $sql = "INSERT INTO groups (groupName)
        VALUES ('$name')";
    }
    
       if (mysql_query($sql)){
          $message = "";
          $sql2 = "SELECT idGroup from groups WHERE groupName='$name'";
          $result= mysql_query($sql2);
          $groupId = mysql_result($result, 0);

          //dodaje kazdego czlonka grupy do tabeli groupmembers
          foreach($czlonkowie as $czlonkowie2){
             $sqlAddUser = "INSERT INTO groupmembers(idGroup, userLogin) VALUES ('$groupId','$czlonkowie2' )";
           
             mysql_query($sqlAddUser);
           }
             $sqlAddMainUser = "INSERT INTO groupmembers(idGroup, userLogin) VALUES ('$groupId','$login')";
              mysql_query($sqlAddMainUser);
           

   $message .= ' <div class="message">
           <p>
            Dodano grupe!
            </p>
          </div>';
   echo $message;
          echo '<meta http-equiv="refresh" content="1" />';
 
       }       
 }
}
  
  class Jakas{
 public function filldiv() {
       
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "app";
        $connection = @mysql_connect($servername, $username, $password)
                or die('Brak poÅ‚Ä…czenia z serwerem MySQL');
        $db = @mysql_select_db($dbname, $connection)
                or die('Nie można połączyć się z bazą danych');
       
       $login = $_SESSION['login'];
        
        $loopResult = '';
       $wynik = mysql_query("SELECT idGroup, groupName,groupPhoto FROM groups WHERE idGroup IN (SELECT idGroup from groupmembers where userLogin = '$login')")
               or mysql_error();

    

        
        if (mysql_num_rows($wynik) > 0) 
        {
       //     echo '<table id="tableGroup">';
            while ($r = mysql_fetch_assoc($wynik)) {
                if($r['groupPhoto'] != NULL){
                $loopResult .= ' 
                    <div class="divGroup">
                          <label id="addedName">'. $r['groupName'] . '</label>
                          <input id="'.$r['idGroup'].'" type="image" class="editable" height="70" width="70" src="data:image/jpeg;base64,'.base64_encode( $r['groupPhoto'] ). '"/> 
                
</div>   ';
                }
                else{
                  $loopResult .= ' 
                      <div class="divGroup">
                          <label id="addedName">'. $r['groupName'] . '</label>
                         <input id="'.$r['idGroup'].'" class="editable" type="image" height="70" width="70" src="images/grupafoto.jpg"/> 
                           </div> 
        ';   
                }
            }
             echo $loopResult;
        }
    }
  }
?>

 
 
</html>
