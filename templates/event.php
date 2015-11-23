<!DOCTYPE html>
<html>
<head>
	<title><?php echo $lang['SITE_NAME'] ?></title>
	<link rel="stylesheet" href="../styles.css">
	<script src="../<?php echo $_GLOBALS['jquery'] ?>"></script>
	<script type="text/javascript" src="../js/event-subscription.js"></script>
</head>
<body>
	<div id="wrapper">
		<?php include('templates/header.php'); ?>
		<div id="content" >
			<div class="box center default-width">
				<?php $row = getEvent($_GET['id']); ?>
				<p><?php echo $row['name'] ?></p>
				<div class="div-event-image-big" style="background-image:url(<?php echo '../'.$row['image'] ?>)"></div>
				<p><?php echo $row['description'] ?></p>
				<p><?php echo $row['date'] ?></p>
				<p><?php echo $lang[$row['type']] ?></p>
				<?php
				if (isSet($_SESSION['user_id']))
				{
					$sub = isEventSubscribed($_GET['id'], $_SESSION['user_id']);
					echo '<div id="event-id" style="display:none">'.$_GET['id'].'</div>';
					echo '<button id="unsubscribe" style="'.($sub?'':'display:none').'" class="subscription button">'.$lang['UNSUBSCRIBE'].'</button>';
					echo '<button id="subscribe" style="'.($sub?'display:none':'').'" class="subscription button">'.$lang['SUBSCRIBE'].'</button>';
					
					$path = "delete/".$_GET['id'];
					if(isUserEvent($_SESSION['user_id'],$_GET['id']))
						echo "<a href='$path'>Delete</a>";
				}
				include('templates/footer.php'); 
				?>
			</div>
		</div>
	</div>
</body>
</html>