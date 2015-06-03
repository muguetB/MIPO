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
  <div id="leftPan">
    <div id="leftmemberPan">
      <h2>Masz już konto?</h2>
      <form id="login" method="post">
        <label>Login</label>
        <input type="text" name="login" />
          <label>Hasło</label>
        <input class="password" type="password" name="password" />
          <br/>
                 <?php
    include('zbior.php');
    $zbior = new Zbior();
    $zbior -> zaloguj();
  ?>
      <input id="zaloguj_btn" type="submit"  value="Zaloguj" name="wyslij"/>
      </form>
      <p class="linki"> <a href="zapomnialemHasla.php">Zapomniałem hasła</a></p>
    </div>
  </div>
    
    <div id="joinUs">
      <form action="rejestracja.php" method="post">
      <h2>Dołącz do nas!</h2>
      <p > Robienie zakupów jeszcze nigdy nie było tak <b>PROSTE!</b> </br>
         Dołącz i sprawdź</p>
           <input id="nowe_konto_btn" type="submit" value="Utwórz nowe konto"/>
       </form>
  </div>
  
</div>
<footer id="footerPan">
    <p>Copyright © 2015 MIPO. © MIPO. All right reserved</p>
  </footer>
</body>
</html>
