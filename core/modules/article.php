<?php
//Refuses direct access
if (!defined("ArticleCMS")){ exit; }
$aid = $mysqli->real_escape_string($_GET['aid']);
$mysqli -> select_db($database);
$aid = escape($_GET['aid']);
$result = $mysqli -> query("SELECT * FROM news where id=$aid");
if (!$result)
{
	echo "<div class=\"fail\">{$lang['post_notfound']}</div>";
}
else {
while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
	$result2 = $mysqli -> query("SELECT * FROM accounts where id='{$row['user']}'");
	while ($row2 = $result2 -> fetch_array(MYSQLI_ASSOC)) {
	echo "<div class='announce'>
	<h3><a class=\"title\" href=\"index.php?page=article&aid={$row['id']}\">".$row['title']."</a></h3>";
	echo "<p>Posted by: <a class='user'>".$row2['displayname']."</a>, on ".$row['posttime']."</p>
	<center><img src='{$row['media']}' height='300' width='700'></center>
	<p>
	<div align='left'>{$row['content']}</div>
	</div><p>";
}
}
$comments = $mysqli -> query("SELECT * FROM comments where id_post=$aid");
if ($comments){
	while ($row = $comments -> fetch_array(MYSQLI_ASSOC)) {
	$userinfo = $mysqli -> query("SELECT * FROM accounts where id={$row['userid']}");
		while ($row2 = $userinfo -> fetch_array(MYSQLI_ASSOC)) {
        // Get gravatar Image
        $default = "mm";
        $size = 35;
        $grav_url = "http://www.gravatar.com/avatar/".md5(strtolower(trim($row2['email'])))."?d=".$default."&s=".$size;
echo "<div class=\"cmt-cnt\">
        <img src='$grav_url'>
        <div class='thecom'>
            <h5>{$row2['displayname']}</h5><span data-utime=\"1371248446\" class=\"com-dt\">{$row['date']}</span>
            <br/>
            <div align='left'><p>
			{$row['comment']}
            </p></div>
        </div>
		
    </div>";
		}
}
}
       echo"<form method='post' action=''><textarea class=\"the-new-com\" name='commenttext' placeholder='{$lang['write_comment']}'></textarea>
	   <div align='left'><input type='submit' value='{$lang['post_comment']}'></div></form>";
}
if (isset($_POST['commenttext'])){
	$commenttext = escape($_POST['commenttext']);
	$acc_id=$mysqli -> query("SELECT id FROM accounts where username='{$_SESSION['username']}'");
	while ($row = $acc_id -> fetch_array(MYSQLI_ASSOC)) {
		$accid = $row['id'];
	}
$mysqli -> query("INSERT INTO comments (userid, comment, id_post) VALUES ('{$accid}', '{$commenttext}', '{$aid}')");
}
?>