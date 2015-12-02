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
			<div id="event-id" style="display:none"><?php echo $_GET['id'] ?></div>
			<ul class="tabs">
				<li id="photos-event-name"><a><?php echo $row['name'] ?></a></li>
					<?php if (isSet($_SESSION['user_id'])) 
					{ ?>
						<li class="tab-right button"><a id="add-photos" href='<?php echo "photos/new"; ?>'><?php echo $lang['ADD_PHOTOS'] ?></a></li>
						<li id="delete-flip-button" class='tab-right tg-list-item'>
		    				<input id="delete-mode-input" class='tgl tgl-flip' type='checkbox'>
		    				<label class='tgl-btn' data-tg-off='<?php echo $lang['DELETE_DISABLED'] ?>' data-tg-on='<?php echo $lang['DELETE_ACTIVE'] ?>' for='delete-mode-input'></label>
		  				</li>
		  			<?php
		  			} ?>
				</ul>
			<li class="dummy-photo" style="display:none" data.id="" data-delete-permission="">
				<div class="div-event-photo-image photo-link" style=""></div>
			</li>
			<div class="tabs-panel">
				<ul class="photos-list">
					<?php
					$photos = getEventPhotos($_GET['id'],isSet($_SESSION['user_id'])?$_SESSION['user_id']:false);
					if (empty($photos)) {
						echo '<p id="no-photos-yet">'.$lang['NO_PHOTOS_YET'].'</p>';
					}
					else
					{ 
						foreach ($photos as $row)
						{
						?>	
							<li class="photo" data-id="<?php echo $row['id'] ?>" data-delete-permission="<?php echo $row['delete_permission'] ?>">
								<div class="div-event-photo-image photo-link" 
									style="background-image:url(<?php echo $_CONFIG['web_root'].$row['image'] ?>)">
								</div>
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