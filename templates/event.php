<?php 
include_once("core/event_permission.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $lang['SITE_NAME'] ?></title>
	<link rel="stylesheet" href="../styles.css">
	<script src="../<?php echo $_GLOBALS['jquery'] ?>"></script>
	<script type="text/javascript" src="../js/event.js"></script>
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56557f93aab8dc78" async="async"></script>
</head>
<body>
	<div id="wrapper">
		<?php include('templates/header.php'); ?>
		<div id="content" style="text-align:center;">
			<div class="box center default-width" style="text-align:left;position: relative;display:inline-block;vertical-align:top;">
				
				<h3><?php echo $row['name'] ?></h3>
				<div class="div-event-image-big" style="background-image:url(<?php echo '../'.$row['image'] ?>)"></div>
				<h4><?php echo $lang[$row['type']] ?></h4>
				<p id="date"><?php 
				
				$dateParts = explode("-", $row['date']);
				$date = $dateParts[2]." ".$lang[$dateParts[1]]." ".$dateParts[0];
				echo $date ?></p>
				<p><?php echo $row['description'] ?></p>

				<div id="delete_msg" style="display:none"><?php echo $lang['DELETE_MSG'] ?></div>
				<?php
				if (isSet($_SESSION['user_id']))
				{
					echo '<div id="event-id" style="display:none">'.$_GET['id'].'</div>';
					echo '<div><a id="albums-button" class="button" href="'.$_GET['id'].'/albums">'.$lang['ALBUMS'].'</a></div>';
					echo '<button id="unsubscribe" style="'.($subscribed?'':'display:none').'" class="subscription button">'.$lang['UNSUBSCRIBE'].'</button>';
					echo '<button id="subscribe" style="'.($subscribed?'display:none':'').'" class="subscription button">'.$lang['SUBSCRIBE'].'</button>';
					
					if ($owner)
					{ ?>
						<div id="del-edit-div">
							<a id="edit-button" class='button' href='<?php echo $_GET['id']."/edit"; ?>'><?php echo $lang['EDIT'] ?></a>
							<button id="delete-button" class='button'><?php echo $lang['DELETE'] ?></button>
						</div>
					<?php
					}	
					if ($owner || $row['public'])
					{
						echo '<div class="addthis_sharing_toolbox share"></div>';
					}
					include('templates/comments.php');
				}
				?>
			</div>
			<div style="position: relative;display:inline-block;vertical-align:top;top:20px;">

				<div class="subscriptions box" style="position: relative;display:inline-block;">
					<h3 style="border-bottom:1px solid #3b5998;"> <?php echo $lang['SUBSCRIBERS'] ?> </h3>
					<?php $subscriptionsEvents = getEventSubscriptions($_GET['id']);
					if($subscriptionsEvents)
						foreach ($subscriptionsEvents as $teste) 
							echo '<p>'.$teste['user_name'].'</p>';
					else echo $lang['ZERO_SUBS'];
					?>
				</div>	
			</div>
		</div>
		<?php include('templates/footer.php'); ?>
	</div>
</body>
</html>