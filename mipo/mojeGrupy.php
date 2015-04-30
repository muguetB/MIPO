<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Mydło i Powidło</title>
<link href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
<script src="js/dialog.js" type="text/javascript"></script>
<link href="style2.css" rel="stylesheet" type="text/css"/>
</head>

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
// Validating Form Fields.....
$("#submit").click(function(e) {
alert("Dodano grupę!");
});
});
</script> 

 <script>
 $(document).ready(function() {
$(function() {
$("#dialog2").dialog({
autoOpen: false
});
$("#opener2").on("click", function() {
$("#dialog2").dialog("open");
});
});
// Validating Form Fields.....
$("#submit").click(function(e) {
alert("Dodano osobę!");
});
});
</script> 


<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.scr = null;
    output.src = URL.createObjectURL(event.target.files[0]);
  };
  
 function dodaj()
{
    var objTo = document.getElementById('new_input')
    var divtest = document.createElement("div");
    divtest.innerHTML = '<input class="grupa_class" id="dodaj_czlonkow_grupy" placeholder="Dodaj członków" name="czlonkowie" type="text">\n\
<button id="usun_czlonkow" onClick="usun()" type="button">Usun</button>';
    objTo.appendChild(divtest);
}

function usun(){
 var elem = document.getElementById('dodaj_czlonkow_grupy');
 var elem2 = document.getElementById('usun_czlonkow');
    elem.parentNode.removeChild(elem);
    elem2.parentNode.removeChild(elem2)
   
}

</script>
<body>
    <div class="container">
       <div class="main">
       <div id="dialog" title="Nowa grupa">
       <form action="mojeGrupy.php" method="post">
       <input class="grupa_class" id="nazwa_grupy" placeholder="Nazwa grupy" name="nazwa_grupy" type="text" required>
       <div id="new_input">
       <input class="grupa_class" id="dodaj_czlonkow_grupy" placeholder="Dodaj członków" name="czlonkowie" type="text">
       </div>
       <button id="dodaj_czlonkow" onClick="dodaj()" type="button">Dodaj</button> 
       <img id="output" src="images/grupafoto.png" height="80px" width="80px"/>
       <input type="file" id="chosen_pic" accept="image/*" onchange="loadFile(event)" background-color="#a0b7b0">
       <input class="buttons" id="submit_nowa_grupa" name="submit_nowa_grupa" type="submit" value="Dodaj">
       <button class="buttons" id="anuluj_btn" type="button">Anuluj</button> 
       </form>
    </div>
       </div></div>
        
       
            <div class="containerFriends">
       <div class="main">
       <div id="dialog2" title="Nowy kontakt do ulubionych">
       <form action="mojeGrupy.php" method="post">
       <input class="grupa_class" id="nazwa_kontaktu" placeholder="Nazwa kontaktu" name="name_contact" type="text" required>
       <input class="grupa_class" id="email_kontakt" placeholder="Dodaj maila" name="name" type="text">
       <img id="output" src="images/grupafoto.png" height="80px" width="80px"/>
       <input type="file" id="chosen_pic_contact" accept="image/*" onchange="loadFile(event)" background-color="#a0b7b0">
       <input class="buttons" id="submit_nowy_kontakt" type="submit" value="Dodaj">
       <button class="buttons" id="anuluj_btn" type="button">Anuluj</button> 
       </form>
    </div>
       </div></div>
    

 
<div id="topPan"><a href="#"><img src="images/logo.gif" title="Green Solutions" alt="Green Solutions" /></a>
  <div id="topPanMenu">
      <img src="images/photo.gif"/>
      <p><a class="link2" href="#">Moje konto</a>    <a class="link2" href="#">Wyloguj</a></p>
    <ul>
        <li><a class="link1" href="glowna.php">Lista zakupów</a></li>
        <li><a class="link1" href="#">Moje grupy</a></li>
    </ul>
  </div>
</div>
<div id="headerPan">
  <div id="headerPanleft">
    <div id="nowaLista">
        <h2>Nowa grupa</h2>
        <a id="opener" href="#">&nbsp;</a> </div>
    <div id="mojeListy">
        <h2>Dodaj do ulubionych</h2>
      <a id="opener2" href="#">&nbsp;</a> </div>
</div>
</div>

    <div id="rightPan">
    <div id="rightbodyPan">
        <img id="grupy_img" src = "images/grupy.png" height="40" alt = "grupy"/> 
        <img id="grupa" src = "images/dom.png" height="40" width="40" alt = "grupa_dom"/> 
        <img id="grupa" src = "images/biuro.png" height="40" width="40" alt = "grupa_biuro"/>
        <img id="ulubione_img" src = "images/ulubione.png" height="40" alt = "ulubione"/> 
      <!--  <button id="edytuj_btn" type="button"></button> -->
    </div>
    </div>
 </body>
 

 <?php
     $servername = "127.0.0.1";
     $username = "root";
     $password = "";
     $dbname = "app";
     
      mysql_connect($servername, $username, $password);
      mysql_select_db($dbname);

 if(isset($_POST['submit_nowa_grupa']))
 {
     $name = $_POST['nazwa_grupy'];

$sql = "INSERT INTO groups (groupName)
VALUES ('$name')";

if (mysql_query($sql)){

$message = "dodano";
echo "<script type='text/javascript'>window.alert('$message');</script>";
} 
 }
 
?>
 
</html>
