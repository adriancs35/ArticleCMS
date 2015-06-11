<?php
//Refuses Direct Access
if(!defined("ArticleCMS")){ exit; };

include_once "content/include/db.php";
include_once "content/include/functions.php";
include_once "language/".$_SESSION['lang']."/general.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset='UTF-8' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $title; ?></title>
		<link rel="stylesheet" type="text/css" href="content/styles/<?php echo $style; ?>/main.css" />
		<link rel="stylesheet" type="text/css" href="content/styles/flexslider.css" />	
		<link rel="shortcut icon" type="icon/ico" href="content/images/fav.png" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script src="content/scripts/jquery.flexslider.js"></script>
		<script language="javascript" src="content/scripts/jquery-1.2.6.min.js"></script>
		<script language="javascript" src="content/scripts/jquery.timers-1.0.0.js"></script>
		<script language="javascript" src="content/scripts/main.js"></script>
	</head>
	<body>

		<div id="nav">
			<?php
			if (!isset($_SESSION['username']) OR empty($_SESSION['username'])){
				echo "<div class='align_nav_l'>";
					$menu_left = $mysqli -> query("SELECT * FROM menu WHERE position = 'left' AND logged = '0' ORDER BY link_order ASC");
					while ($row = $menu_left -> fetch_array(MYSQLI_ASSOC)){
						echo "<a href='".$row['link']."'><button>".$row['name']."</button></a>";
					}
				echo "</div>";
				echo "<img src='content/images/logo.png'/>";
				echo "<div class='align_nav_r'>";
					$menu_right = $mysqli -> query("SELECT * FROM menu WHERE position = 'right' AND logged = '0' ORDER BY link_order ASC");
					while ($row = $menu_right -> fetch_array(MYSQLI_ASSOC)){
						echo "<a href='".$row['link']."'><button>".$row['name']."</button></a>";
					}
				echo "</div>";
			}
			else{
				echo "<div class='align_nav_l'>";
					$menu_left = $mysqli -> query("SELECT * FROM menu WHERE position = 'left' ORDER BY link_order ASC");
					while ($row = $menu_left -> fetch_array(MYSQLI_ASSOC)){
						if($row['name'] == "Register" OR $row['name'] == "Login"){}
						else{
							echo "<a href='".$row['link']."'><button>".$row['name']."</button></a>";
						}
					}
				echo "</div>";
				echo "<img src='content/images/logo.png'/>";
				echo "<div class='align_nav_r'>";
					$menu_right = $mysqli -> query("SELECT * FROM menu WHERE position = 'right' ORDER BY link_order ASC");
					while ($row = $menu_right -> fetch_array(MYSQLI_ASSOC)){
						if($row['name'] == "Register" || $row['name'] == "Login"){}
						else{
							echo "<a href='".$row['link']."'><button>".$row['name']."</button></a>";
						}
					}
				echo "</div>";
			}
			?>
		</div>
		<div id="sname">
			<b><?php echo $title;  ?></b>
			<p><i><?php echo $slogan; ?></i></p>
		</div>
		<div id='social'>
			
		</div>
		<div id="main">
			<div id="news">
				<?php
				//Modules
				if (!isset($_GET['page']) OR empty($_GET['page'])){
					if ($slider == "on"){
						include_once "content/include/slider.php";
					}
					include_once "core/modules/news.php";
				}
				else{
					switch ($_GET['page']) {
						case 'login':
							include_once "core/modules/login.php";
							break;
						case 'article':
							include_once "core/modules/article.php";
							break;
						case 'register':
							include_once "core/modules/register.php";
							break;
						case 'register_success':
							include_once "core/modules/register_success.php";
							break;
						case 'account':
							include_once "core/modules/account.php";
							break;
						case 'vote':
							include_once "core/modules/vote.php";
							break;
						case 'donate':
							include_once "core/modules/donate.php";
							break;
						case 'store':
							include_once "core/modules/store.php";
							break;
						case 'armory':
							include_once "core/modules/armory.php";
							break;
						case 'forum':
							include_once "core/modules/forum.php";
							break;
						case 'fail_vote':
							include_once "core/modules/fail_vote.php";
							break;
						case 'notlogged':
							include_once "core/modules/notlogged.php";
							break;
						case 'changef':
							include_once "core/modules/changef.php";
							break;
						case 'success':
							include_once "core/modules/success.php";
							break;
						case 'changen':
							include_once "core/modules/changen.php";
							break;
						case 'revive';
							include_once "core/modules/revive.php";
							break;
						case 'unstuck';
							include_once "core/modules/unstuck.php";
							break;
						case 'teleport';
							include_once "core/modules/teleport.php";
							break;
						case 'media':
							include_once "core/modules/media.php";
							break;
						default:
							if ($slider == "on"){
								include_once "content/include/slider.php";
							}
							include_once "core/modules/news.php";
							break;
					}
				}
				?>
			</div>
			<div id="sidebox">
				<?php
				//Plugins
				include_once "core/plugins/login.php";
				?>
			</div>
			<div class="clear"></div>
		</div>
		<div id="footer">
			<b><a class="user">ArticleCMS</a></b> @ <?php echo date("Y"); ?>, Adrian Oneasca, thanks Phentom for the original template!
		</div>
		<script type="text/javascript">
	    $(function(){
	      SyntaxHighlighter.all();
	    });
	    $(window).load(function(){
	      $('.flexslider').flexslider({
	        animation: "slide",
	        start: function(slider){
	          $('body').removeClass('loading');
	        }
	      });
	    });
	  	</script>
	</body>
</html>
<?php
$mysqli -> close();
?>