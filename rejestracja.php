<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Mydło i Powidło</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>

<div id="headerPan">
      <img src = "images/logo.png" height = "400"  alt = "logo" class="center"/>
</div>
    
<div id="bodyPan">
  <div id="rejestrujPanel">
    <h2>Zarejestruj się i korzystaj w pełni</h2>
    <form name="login" id="rejestracja_formularz" action="" method="post" onsubmit="return checkForm(this);">
        <label class="labels">Login</label>
       
        <input class="inputs" type="text" name="login" required=required />
        <label class="labels" id="mail">Adres email</label>
        <input class="inputs" type="email" placeholder="nazwa@domena.com" name="email" required=required/>
        
         <label id="komunikat_label">
            <?php
     $servername = "127.0.0.1";
     $username = "root";
     $password = "";
     $dbname = "app";
      mysql_connect($servername, $username, $password);
      mysql_select_db($dbname);

 if(isset($_POST['utworz_konto_bt']))
 {
     $login = $_POST['login'];
     $haslo = $_POST['haslo'];
     $email = $_POST['email'];

$sql = "INSERT INTO users (login, password, email)
VALUES ('$login', '$haslo', '$email')";

$query = mysql_query("SELECT login FROM users WHERE login = '". $login."'");

  if (mysql_num_rows($query) != 0)
  {
      echo "Uzytkownik istnieje, sprobuj inna nazwe";
  }
  else{
if (mysql_query($sql)) 
{
    header('Location: poRejestracji.html');
    
} 
 }
 }
?>
   
            
         </label> 
        <label id="haslo_label">Hasło (min 6 znaków, w tym cyfra)</label>
        <input class="inputs" type="password" name="haslo" required=required />
        <label class="labels">Potwierdź hasło</label>
        <input class="inputs" type="password" name="pwd2"required=required />
       
        
    <div id="regulamin">
        <input type="checkbox"  required=required name="reg" value="Yes">Przeczytałem/am i akceptuję</input>
        <a href="regulamin.html">regulamin</a>
    </div> 
        <input id="utworz_konto_btn" type="submit" value="Utwórz konto" name="utworz_konto_bt"/>
   </form>
    
   <div id="powroty">
      <img id="strzalka" src = "images/strzalka.jpg" height="30" width="40" alt = "strzalka"/> 
      <a id="powrot" href="index.php">Powrót</a> 
    </div>
</div>
     
</div>
<footer id="footerPan">
    <p>Copyright © 2015 MIPO. © MIPO. All right reserved</p>
  </footer>
</body>
    
    <script type="text/javascript">

  function checkForm(form)
  {
    re = /^\w+$/;
    if(!re.test(form.username.value)) {
      alert("Błąd: Login może zawierać jedynie litery i liczby!");
      form.username.focus();
      return false;
    }

    if(form.pwd1.value === form.pwd2.value) {
      if(form.pwd1.value.length < 6) {
        alert("Błąd: Hasło musi składać się co najmniej 6 znaków!");
        form.pwd1.focus();
        return false;
      }
      if(form.pwd1.value === form.username.value) {
        alert("Błąd: Hasło musi być różne od loginu!");
        form.pwd1.focus();
        return false;
      }
      re = /[0-9]/;
      if(!re.test(form.pwd1.value)) {
        alert("Błąd: hasło musi zawierać co najmniej jedną cyfrę!");
        form.pwd1.focus();
        return false;
      }

        }
        else {
      alert("Błąd: Hasła są różne!");
      form.pwd1.focus();
      return false;
    }
    return true;
  }

</script>


    
</html>