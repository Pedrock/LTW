<?php 
include_once("core/event_permission.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $lang['SITE_NAME'] ?></title>
	<link rel="stylesheet" href="../styles.css">
	<script src="../<?php echo $_CONFIG['jquery'] ?>"></script>
	<script type="text/javascript" src="../js/event.js"></script>
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56557f93aab8dc78" async="async"></script>
</head>
<body>
	<div id="wrapper">
		<?php include('templates/header.php'); ?>
		<div id="content" >
			<div class="box center default-width">
				
				<h3><?php echo $row['name'] ?></h3>
				<div class="div-event-image-big" style="background-image:url(<?php echo '../'.$row['image'] ?>)"></div>
				<h4><?php echo $lang[$row['type']] ?></h4>
				<?php 
				
				$dateParts = explode("-", $row['date']);
				$date = $dateParts[2]." ".$lang[$dateParts[1]]." ".$dateParts[0];
				
				echo '<p id="date">'.$date.'</p>' ?>
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
		</div>
		<?php include('templates/footer.php'); ?>
	</div>
</body>
</html>