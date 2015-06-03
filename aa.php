public function getFriendsLocations($userID,$groupName){
		$friends = mysql_query("SELECT l.IdLokalizacji,u.Login, l.Szerokosc,l.Dlugosc FROM paczki p INNER JOIN przynaleznosci pr ON p.IdPaczki = pr.IdPaczki JOIN lokalizacje l ON l.IdLokalizacji = pr.IdCzlonka JOIN uzytkownicy u ON l.IdLokalizacji = u.IdUzytkownika WHERE p.IdUzytkownika = '$userID' AND p.NazwaPaczki = '$groupName' AND u.Aktywny='1'");
		$notactive = $this->setNotActive();
		$count = 0;
		$users=null;
		while($row = mysql_fetch_array($friends)){
			$users['users'][$count]['location'] = $row['IdLokalizacji'];
			$users['users'][$count]['login'] = $row['Login'];
			$users['users'][$count]['lat'] = $row['Szerokosc'];
			$users['users'][$count]['lng'] = $row['Dlugosc'];
		
			$count++;
			//print_r($row);
		}
		if($users !=null)
		{
			return $users;
		}else{
			return false;
		}
	}

	else if ($tag =='getFriendsLocations'){
		$userID = $_POST['userID'];
		$groupName = $_POST['groupName'];
		$user = $db->getFriendsLocations($userID,$groupName);
			if ($user) {
				// user updated successfully
				$user["error"] = FALSE;
				//echo json_encode($response);
				echo json_encode($user);
				
			} 
			else {
				// user failed to update
				$response["error"] = TRUE;
				$response["error_msg"] = "Brak użytkowników do wyświetlenia.";
				echo json_encode($response);
			}
	}