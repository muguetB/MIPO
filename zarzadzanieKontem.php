<?php
include('zbior.php');
    $zbior = new Zbior();
    $zbior -> wyloguj();
    $zbior -> zmienLogin();
    $zbior -> zmienHaslo();
    $zbior -> usun();
    $zbior -> zmienEmail();
    ?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Mydło i Powidło</title>
        <link href="style2.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
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
                    <li><a class="link1" href="mojeGrupy.html">Moje grupy</a></li>
                </ul>
            </div>
        </div>
        <div id="headerPan">
            <div id="headerPanleft2">

                <img src="images/head.png" height="150" width="150" alt = "glowa"/>
            </div>

            <div id="bodyPan">
                <div id="leftPan2">
                    <h2> Moje konto</h2>
                    <br/>
                     <form class="menu" method="post">
                         <input id="zmienZdjecie" type="submit" name="zmienZdjecie" value="Zmień zdjęcie">
                    </form> 
                    <form class="menu" method="post">
                         <input id="usun" type="submit" name="usunGo" value="Usuń konto" onClick="confirm('Czy na pewno chcesz usunąć konto?')">
                    </form> 
                </div>
            </div>
            <div id="rightPan2">
                <div id="rightbodyPan2">
                    <h2><b><?php $zbior->login()?></b></h2>
                    <div id="zmienDane">
                        <form name="login" id="zmiana_formularz" action="#" method="post" onsubmit="return checkForm(this);">
                            <label>Login</label>
                            <label><?php $zbior->login()?></label><br/><br/>
                            <label>Zmień login</label>
                            <input type="text" name="changeLogin" class="inputs"/><br/>
                            <label id="naglowek">Zmiana hasła</label><br/><br/>
                            <label>Hasło</label>
                            <input type="password" name="hasloo" class="inputs"/>
                            <label>Nowe hasło</label>
                            <input type="password" name="pwd1" class="inputs"/>
                            <label>Potwierdź hasło</label>
                            <input type="password" name="pwd2" class="inputs"/> <br/>
                            <label id="naglowek">Zmiana maila</label><br/><br/>
                            <label>Adres email</label>
                            <label><?php $zbior->email()?></label><br/><br/>
                            <label>Nowy adres email</label>
                            <input type="email" name="emailNowy" placeholder="nazwa@domena.com" class="inputs"/> <br/>
                            <input id="zapisz_zmiany_btn" type="submit" value="Zapisz zmiany" name="zmien"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </body>
    <script type="text/javascript">

        function checkForm(form)
        {
            re = /^\w+$/;
            if (!re.test(form.username.value)) {
                alert("Błąd: Login może zawierać jedynie litery i liczby!");
                form.username.focus();
                return false;
            }

            if (form.pwd1.value === form.pwd2.value) {
                if (form.pwd1.value.length < 6) {
                    alert("Błąd: Hasło musi składać się co najmniej 6 znaków!");
                    form.pwd1.focus();
                    return false;
                }
                if (form.pwd1.value === form.username.value) {
                    alert("Błąd: Hasło musi być różne od loginu!");
                    form.pwd1.focus();
                    return false;
                }
                re = /[0-9]/;
                if (!re.test(form.pwd1.value)) {
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

