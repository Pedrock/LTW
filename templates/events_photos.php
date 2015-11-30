<?php 
include_once('core/common.php');
include_once("core/event_permission.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $lang['SITE_NAME'] ?></title>
	<link rel="stylesheet" href="../../styles.css">
	<script src="../../<?php echo $_CONFIG['jquery'] ?>"></script>
	<script type="text/javascript" src="../../js/event_photos.js"></script>
</head>
<body>
	<div id="wrapper">
		<?php include('templates/header.php'); ?>
		<div id="content" class="center default-width">
			<ul class="tabs">
			<li><a><?php echo $row['name'] ?></a></li>
				<li class="tab-right button"><a id="add-photos" href='<?php echo "photos/new"; ?>'><?php echo $lang['ADD_PHOTOS'] ?></a></li>
			</ul>
			<div class="tabs-panel">
				<ul class="events-list">
					<?php
					echo '<div id="event-id" style="display:none">'.$_GET['id'].'</div>';
					$photos = getEventPhotos($_GET['id'],$_SESSION['user_id']);
					if (empty($photos)) {
						echo '<p id="no-photos-yet">'.$lang['NO_PHOTOS_YET'].'</p>';
					}
					else
					{ 
						foreach ($photos as $row)
						{
						?>	
							<li class="photo">
								<a href="photos" class="photo-link">
									<div class="div-event-photo-image" style="background-image:url(<?php echo $_CONFIG['web_root'].$row['image'] ?>)"></div>
								</a>
							</li>
						<?php
						}
					}
					?>
				</ul>
			</div>
		</div>
		<?php include('templates/footer.php'); ?>
	</div>
</body>
</html>