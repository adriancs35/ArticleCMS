<?php
//Refuses direct access
if (!defined("ArticleCMS")){ exit; }

include_once "language/".$_SESSION['lang']."/armory.php";
?>
<div class="fail">
	You are not logged in!
</div>