<?php
//Refuses direct access
if (!defined("ArticleCMS")){ exit; }

$username = escape($_POST['username']);
$password = md5(strtoupper($username.':'.$_POST['password']));
$mysqli -> select_db($database);

$check_account = $mysqli -> query("SELECT * FROM `accounts` WHERE username='$username' and password='$password'") or die( $mysqli -> error );
$count = $check_account -> num_rows;
 
if ($count > 0){
	$_SESSION['username'] = $username;
	header("Location: index.php");
}
else{
	echo "<div class='fail'>Wrong User/Password</div>";
}
?>