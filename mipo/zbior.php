<?php
	class Zbior

	{
		public function __construct()
		{
			session_start();
		}
		
		public function connect()
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


		function zapomnialem()
		{

				if(isset($_POST['submit']))
				{
					 
					$login = $_POST['login'];
					$email  = $_POST['email'];
					
					$danekonta = mysql_query("SELECT password, email, login FROM users WHERE login= '$login' AND email='$email'") or die(mysql_error());
					$pdanekonta = mysql_fetch_array($danekonta);

					if (strlen($_POST['email']) < 1) 
					{
						echo 'Nie wpisałeś adresu e-mail!<br>';
						exit(0);
					}

					if (strlen($_POST['login']) < 1) 
					{
						echo 'Nie wpisałeś loginu!<br>';
						exit(0);
					}

					if ($pdanekonta['login'] == NULL) 
					{
						echo 'Nie ma takiego konta!<br>';
						exit(0);
					}

					if ($pdanekonta['email'] != $email) 
					{
						echo 'Zły adres e-mail!<br>';
						exit(0);
					}

					    
					$haslo = rand(1000,9999);
					$haslomd5 = md5($haslo);
					mysql_query("UPDATE users SET password = '$haslomd5' WHERE login= '$login'") or die(mysql_error());

						$to      = $email;
						$subject = 'New password';
						$message = "Hi, your new password is: $haslomd5 ";
						mail($to, $subject, $message);

					    echo "<p> Hasło zostało wysłane na e-mail: $email</p>";        
					  
				}       
		}

		public function clear($text) {
		    // jeśli serwer automatycznie dodaje slashe to je usuwamy
		    if(get_magic_quotes_gpc()) 
		    {
		        $text = stripslashes($text);
		    }
		    $text = trim($text); // usuwamy białe znaki na początku i na końcu
		    $text = mysql_real_escape_string($text); // filtrujemy tekst aby zabezpieczyć się przed sql injection
		    $text = htmlspecialchars($text); // dezaktywujemy kod html
		 return $text;
}

		public function zaloguj()
		{
			self::connect();
			

			if(isset($_POST['wyslij']))
			{
				if(isset($_SESSION['zalogowany']))
				{
					echo 'jestes juz zalogowany';
					//exit(0);
					header('Location: glowna.php');
				}
					if(isset($_POST['login']) && isset($_POST['password']))
					{

						$login = self::clear($_POST['login']);
						$password = self::clear($_POST['password']);
						$zapytanie = mysql_query("SELECT idUser FROM users WHERE login= '$login' AND password = '$password'");
						$email = mysql_query("SELECT `email` FROM users WHERE login= '$login' AND password = '$password'");
						$row = mysql_fetch_array($email);

						if(mysql_num_rows($zapytanie) ==0 )
						{
							echo 'Nieprawidłowe dane logowania';
							exit(0);
						}
						else
						{
								$_SESSION['zalogowany'] = true;
								$_SESSION['login'] = $login;
								$_SESSION['password'] = $password;
								$_SESSION['email'] = $row[0];

								echo 'Jesteś zalogowany';
								header('Location: glowna.php');
						}		
					}
						
			}
				
		}

		public function wyloguj()
		{
			if(isset($_POST['wyloguj']))
				{
					if(!isset($_SESSION['zalogowany']))
					{
						echo 'nie byłeś zalogowany';
						exit(0);
					}
					else
					{
					session_destroy();
					echo 'Jesteś wylogowany';
					header('Location: index.php');
					}
				}
		}

		public function login()

		{

			echo $_SESSION['login'];
		}

		public function email()

		{

			echo $_SESSION['email'];
		}
		
		
	}			
	?>
					