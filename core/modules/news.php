<?php
//Refuses direct access
if (!defined("ArticleCMS")){ exit; }

include_once "language/".$_SESSION['lang']."/news.php";

$mysqli -> select_db($database);
$result = $mysqli -> query("SELECT * FROM news ORDER BY id DESC LIMIT 10");
 if (!$result)
{
	echo "<div class=\"fail\">{$lang['no_articles']}</div>";
}
else {
while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
	$result2 = $mysqli -> query("SELECT * FROM accounts where id='{$row['user']}'");
	while ($row2 = $result2 -> fetch_array(MYSQLI_ASSOC)) {
	echo "<div class='announce'>
	<h3><a class=\"title\" href=\"index.php?page=article&aid={$row['id']}\">".$row['title']."</a></h3>";
	echo "<p>Posted by: <a class='user'>".$row2['displayname']."</a>, on ".$row['posttime']."</p>
	<center><img src='{$row['media']}' height='300' width='700'></center>
	<p>".ttruncat($row['content'], 1500)."(<a class=\"title\" href=\"index.php?page=article&aid={$row['id']}\">Read whole article.</a>)</p>
	<div class='news_div'></div>
	</div>";
}
}
}
?>