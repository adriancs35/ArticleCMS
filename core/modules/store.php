<?php
//Refuses direct access
if (!defined("ArticleCMS")){ exit; }
include_once "language/".$_SESSION['lang']."/store.php";

include_once "db.php";
if (isset($_SESSION['username'])) {
	
	$mysqli -> select_db($acc_db);
	$getuserid = $mysqli -> query("SELECT id FROM account where username='{$_SESSION['username']}' LIMIT 1");
	while ($row = $getuserid -> fetch_array(MYSQLI_ASSOC)) {
		$userid = $row['id'];
	}
    $mysqli -> select_db("wowcms");
	$getrealms = $mysqli -> query("SELECT * FROM realms");
	while ($row = $getrealms -> fetch_array(MYSQLI_ASSOC)) {
    $realmname=$row['name'];
	$charactersdb=$row['characters'];
	$expansion=$row['expansion'];
	echo "<b><p>$realmname</p><p><img src='content/images/expansion/$expansion.png'></p></b><center><table><tr>
			<th>Race</th>
			<th>Character Name</th>
			<th>Level</th>
			<th>Action</th>
			      </tr>";
		$mysqli -> select_db($charactersdb);
	    $getcharacters = $mysqli -> query("SELECT * FROM characters where account='{$userid}'") or die($mysqli->error);
	    while ($row = $getcharacters -> fetch_array(MYSQLI_ASSOC)) {
			$charname=$row['name'];
			$race=$row['race'];
			$gender=$row['gender'];
			$level=$row['level'];
			echo "
			      <tr>
			<td><img src='content/images/races/$race-$gender.gif'></td>
			<td>$charname</td>
			<td>$level</td>
			<td><a class='user'>SELECT</a></td>
			      </tr>";
		}
	echo "</table></center>";
	}
}
else {
	header("Location: ../../?page=notlogged");
}
?>