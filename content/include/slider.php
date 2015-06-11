<div class="announce">
<div class="flexslider">
  <ul class="slides">
  <?php
  $result = $mysqli -> query("SELECT media FROM news order by id desc limit 10");
 if (!$result)
{
	echo "<div class=\"fail\">{$lang['no_articles']}</div>";
}
else {
 while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
    echo "<li>
      <img src=\"{$row['media']}\">
    </li>";
	}
}
?>
  </ul>
</div>
</div>