<?php
//Refuse direct access
if(!defined("ArticleCMS")){ exit; }

if (isset($_POST['rusername']) and isset($_POST['rpassword'])){
	if ($_POST['rpassword'] == $_POST['vpassword']){
		$username = $mysqli->real_escape_string($_POST['rusername']);
		$password = md5(strtoupper($username.':'.$_POST['rpassword']));
		$mail = $mysqli->real_escape_string($_POST['email']);
		$displayname = $mysqli->real_escape_string($_POST['displayname']);
		
		$mysqli -> select_db($database);
		$check = $mysqli -> query("SELECT id FROM `accounts` WHERE username='$username'") or die($mysqli -> error); 
		$count = $check -> num_rows;
		
		if ($count > 0){
			echo "<p class='fail'>Username already exists.</p>";
		}
		else{ 
			$mysqli -> query("INSERT INTO `accounts` (username, password, email, displayname) VALUES ('$username', '$password', '$mail', '$displayname')") or die($mysqli -> error);
			header("Location: ?page=register_success");
		}
	}
	else{
		echo "<p class='fail'>Password missmatch.</p>";
	}
}