<!DOCTYPE html>
<html>
<head>
	<title><?php echo $lang['SITE_NAME'] ?></title>
	<link rel="stylesheet" href="../styles.css">
	<script src="../<?php echo $_GLOBALS['jquery'] ?>"></script>
	<script type="text/javascript" src="../js/new_event.js"></script>
</head>
<body>
	<div id="wrapper">
		<?php include('templates/header.php'); ?>
		<div id="content">
			<div class="box center default-width">
				<form id="new-event" action="new" method="POST" enctype="multipart/form-data">
					<h3><?php echo $lang['NAME'] ?></h3>
					<input type="text" id="name" name="name" value="<?php if(isSet($_POST['name'])) echo $_POST['name'] ?>">
					<div id="error-event-name" class="event-error" <?php if (!empty($_GLOBALS['NEW']['name'])) echo 'style="display:initial"' ?>>
							<?php echo $lang['INVALID_NAME'] ?>
					</div>

					<div id="privacy">
						<input type="radio" name="privacy" value="public" checked="checked"><?php echo $lang['PUBLIC'] ?>
						<input type="radio" name="privacy" value="private"><?php echo $lang['PRIVATE'] ?>
					</div>

					<h3><?php echo $lang['DESCRIPTION'] ?></h3>
					<input type="text" name="desc" value="<?php if(isSet($_POST['desc'])) echo $_POST['desc'] ?>">
					<div id="error-event-desc" class="event-error" <?php if (!empty($_GLOBALS['NEW']['desc'])) echo 'style="display:initial"' ?>>
							<?php echo $lang['INVALID_DESCRIPTION'] ?>
					</div>

					<h3><?php echo $lang['DATE'] ?></h3>
					<input type="date" name="date" value="<?php if(isSet($_POST['date'])) echo $_POST['date'] ?>">
					<div id="error-event-date" class="event-error" <?php if (!empty($_GLOBALS['NEW']['date'])) echo 'style="display:initial"' ?>>
							<?php echo $lang['INVALID_DATE'] ?>
					</div>

					<h3><?php echo $lang['TYPE'] ?></h3>
					<select name="type">
					<?php
						$types = getEventTypes();
						foreach ($types as $type)
						{ ?>
							<option value="<?php echo $type['id'] ?>" 
								<?php if(isset($_POST['type']) && $_POST['type'] === $type['id']) echo 'selected="selected"';?> >
								<?php echo $lang[$type['type']] ?></option>
						<?php
						} ?>
					</select>
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
					<input id="event-submit" type="submit" class="button" value="<?php echo $lang['CREATE'] ?>" name="submit">
				</form>
			</div>
		</div>
		<?php include('templates/footer.php'); ?>
	</div>
</body>
</html>