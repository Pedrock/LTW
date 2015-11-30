<?php 
include_once("core/event_permission.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $lang['SITE_NAME'] ?></title>
	<link rel="stylesheet" href="../../styles.css">
	<script src="../<?php echo $_GLOBALS['jquery'] ?>"></script>
	<script type="text/javascript" src="../js/event.js"></script>
</head>
<body>
	<div id="wrapper">
		<?php include('templates/header.php'); ?>
		<div id="content" class="center default-width">
			<ul class="tabs">
			<li><a><?php echo $row['name'] ?></a></li>
				<li class="tab-right button"><a href='<?php echo "../".$_GET['id']."/photos/new"; ?>'><?php echo $lang['ADD'] ?></a></li>
			</ul>
			<div class="tabs-panel">
			<!--	<div id="subscribed">-->
					<ul class="events-list">
						<?php
						$photos = getEventPhotos($_GET['id'],$_SESSION['user_id']);
						
						if (empty($photos)) {
							echo '<p id="no-comments-yet">'.$lang['NO_PHOTOS_YET'].'</p>';
						}
						else
						{ 
							foreach ($photos as $row)
							{
							?>	<li class="event box">
									<!--<a href="photos/<?php echo $row['id'] ?>/" >
										<div class="div-event-image" style="background-image:url(<?php echo $row['image'] ?>)"></div>
										<p id="date"><?php echo $row['date'] ?></p>-->
									<!--</a>-->
									<!--<?php echo '<div >'.$row['date'].'</div>'; ?>-->
								</li>
							<?php
							}
						}
						?>
					</ul>
			<!--	</div>-->
			</div>
		</div>
		<?php include('templates/footer.php'); ?>
	</div>
</body>
</html>