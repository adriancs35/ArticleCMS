<?php
//Refuses direct access
if (!defined("ArticleCMS")){ exit; }
			
$host="localhost"; 
$user="root"; 
$password=""; 
$database="cms";

$mysqli = new mysqli($host, $user, $password, $database);
			
if (!$mysqli){
	echo "Error in DB Connection";
}
$infoquery = $mysqli -> query("SELECT * FROM info LIMIT 1");
				
while($row = $infoquery -> fetch_array(MYSQLI_ASSOC)){
	$title = $row["title"];
	$slogan = $row["slogan"];
	$core = $row["core"];
	$expansion = $row["expansion"];
	$acc_db = $row["acc_db"];
	$style = $row["style"];
	$slider = $row["slider"];
}
			
$cms_version = "0.5";
			

?>