<!DOCTYPE html>
<html>
<head>
	<title><?php echo $lang['SITE_NAME'] ?></title>
	<link rel="stylesheet" href="../../../styles.css">
	<script src="../<?php echo $_GLOBALS['jquery'] ?>"></script>
	<script type="text/javascript" src="../js/new_event.js"></script>
</head>
<body>
	<div id="wrapper">
		<?php include('templates/header.php'); ?>
		<div id="content">
			<div class="box center default-width">
				<form id="new-event" action="new" method="POST" enctype="multipart/form-data">
					
					<h3><?php echo $lang['IMAGE'] ?></h3>
					<input type="file" name="image" >
					<div id="error-event-image" class="event-error" <?php if (!empty($_GLOBALS['NEW']['image'])) echo 'style="display:initial"' ?>>
							<?php echo $lang['INVALID_IMAGE'] ?>
					</div>
					<div id="error-event-image-size" class="event-error" <?php if (!empty($_GLOBALS['NEW']['size'])) echo 'style="display:initial"' ?>>
							<?php echo $lang['IMAGE_SIZE_ERROR'] ?>
					</div>
					<div id="error-event-image-ext" class="event-error" <?php if (!empty($_GLOBALS['NEW']['ext'])) echo 'style="display:initial"' ?>>
							<?php echo $lang['IMAGE_EXT_ERROR'] ?>
					</div>
					<input id="event-submit" type="submit" class="button" value="<?php echo $lang['ADD'] ?>" name="submit">
				</form>
			</div>
		</div>
		<?php include('templates/footer.php'); ?>
	</div>
</body>
</html>