<?php 
if (isSet($_SESSION['user_id']))
	$row = getEventAndSubscription($_GET['id'],$_SESSION['user_id']);
else $row = getEvent($_GET['id']);
if ($row === false)
{
	header("HTTP/1.0 404 Not Found");
	include('404.php');
	die();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $lang['SITE_NAME'] ?></title>
	<link rel="stylesheet" href="../styles.css">
	<script src="../<?php echo $_GLOBALS['jquery'] ?>"></script>
	<script type="text/javascript" src="../js/event.js"></script>
</head>
<body>
	<div id="wrapper">
		<?php include('templates/header.php'); ?>
		<div id="content" >
			<div class="box center default-width">
				
				<p><?php echo $row['name'] ?></p>
				<div class="div-event-image-big" style="background-image:url(<?php echo '../'.$row['image'] ?>)"></div>
				<p><?php echo $row['description'] ?></p>
				<p><?php echo $row['date'] ?></p>
				<p><?php echo $lang[$row['type']] ?></p>
				<div id="delete_msg" style="display:none"><?php echo $lang['DELETE_MSG'] ?></div>
				<?php
				if (isSet($_SESSION['user_id']))
				{
					$subscribed = $row['subscribed'];
					$owner = ($_SESSION['user_id'] === $row['user_id']);
					echo '<div id="event-id" style="display:none">'.$_GET['id'].'</div>';

					echo '<button id="unsubscribe" style="'.($subscribed?'':'display:none').'" class="subscription button">'.$lang['UNSUBSCRIBE'].'</button>';
					echo '<button id="subscribe" style="'.($subscribed?'display:none':'').'" class="subscription button">'.$lang['SUBSCRIBE'].'</button>';

					if ($owner)
					{ ?>
						<div id="del-edit-div">
							<button id="edit-button" name='edit' class='button'><?php echo $lang['EDIT'] ?></button>
							<button id="delete-button" name='delete' class='button'><?php echo $lang['DELETE'] ?></button>
						</div>
					<?php
					}
					include('templates/comments.php');
				}
				include('templates/footer.php'); 
				?>
			</div>
		</div>
	</div>
</body>
</html>