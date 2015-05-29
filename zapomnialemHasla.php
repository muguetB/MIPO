 <?php
    include('zbior.php');
    $zbior = new Zbior();
    $zbior -> connect();
    ?>

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
  <div id="resetujPanel">
    <h2>RESETOWANIE HASŁA</h2>
    <form name="resetowanie" id="resetuj_formularz"  method="post">
        <label id="login_resetowanie" >Login</label>
        <input id="input_login_resetowanie"  type="text" required=required name="login" />  
        <label id="mail_resetowanie" >Adres email</label>
        <input id="input_mail_resetowanie"  type="email" placeholder="nazwa@domena.com" required=required name="email" />  
        <div id="komunikat"> <?php $zbior -> zapomnialem(); ?>
        </div>
        <input id="resetuj_haslo_btn" type="submit" name="submit" value="Resetuj hasło"/>
    </form>
   <div id="powroty3">
      <p>lub</p>
     <a href="index.php">Powróć do logowania</a>

   </div>
  </div>
</div>
<footer id="footerPan">
    <p>Copyright © 2015 MIPO. © MIPO. All right reserved</p>
  </footer>
</body>
</html>
