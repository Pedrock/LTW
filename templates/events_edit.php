<?php 
include_once("core/event_edit_permission.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $lang['SITE_NAME'] ?></title>
	<link rel="stylesheet" href="../../styles.css">
	<script src="../../<?php echo $_GLOBALS['jquery'] ?>"></script>
	<script type="text/javascript" src="../../js/new_event.js"></script>

</head>
<body>
	<div id="wrapper">
		<?php include('templates/header.php'); ?>
		<div id="content">
			<div class="box center default-width">
				<form id="edit-event" action="edit" method="POST" enctype="multipart/form-data">
					<h3><?php echo $lang['NAME'] ?></h3>

					<input type="text" id="name" name="name" value="<?php  echo $row['name'] ?>">
					
					<div id="error-event-name" class="event-error" <?php if (!empty($_GLOBALS['EDIT']['name'])) echo 'style="display:initial"' ?>
					><?php echo $lang['INVALID_NAME'] ?></div>
					
					<div id="privacy">
						<input type="radio" name="privacy" value="public" <?php echo ($row['public']?'checked="checked">':'>').$lang['PUBLIC'] ?></input>
						<input type="radio" name="privacy" value="private" <?php echo (!$row['public']?'checked="checked">':'>').$lang['PRIVATE']; ?></input>
					</div>
					
					<h3><?php echo $lang['DESCRIPTION'] ?></h3>
					<input type="text" name="desc" value="<?php  echo $row['description'] ?>">
					<div id="error-event-desc" class="event-error" <?php if (!empty($_GLOBALS['EDIT']['desc'])) echo 'style="display:initial"' ?>>
							<?php echo $lang['INVALID_DESCRIPTION'] ?>
					</div>

					<h3><?php echo $lang['DATE'] ?></h3>
					<input type="date" name="date" value="<?php  echo $row['date'] ?>">
					<div id="error-event-date" class="event-error" <?php if (!empty($_GLOBALS['EDIT']['date'])) echo 'style="display:initial"' ?>>
							<?php echo $lang['INVALID_DATE'] ?>
					</div>

					<h3><?php echo $lang['TYPE'] ?></h3>
					<select name="type">
					<?php
						$types = getEventTypes();
						foreach ($types as $type)
						{ ?>
							<option value="<?php echo $type['id'] ?>" 
								<?php if($row['type'] === $type['id']) echo 'selected="selected"';?> >
								<?php echo $lang[$type['type']] ?></option>
						<?php
						} ?>
					</select>
					<h3><?php echo $lang['IMAGE'] ?></h3>
					<input type="file" name="image">

					<div id="error-event-image" class="event-error" 
					<?php if (!empty($_GLOBALS['EDIT']['image'])) echo 'style="display:initial"' ?>>
							<?php echo $lang['INVALID_IMAGE'] ?>
					</div>
					<div id="error-event-image-size" class="event-error" <?php if (!empty($_GLOBALS['EDIT']['size'])) echo 'style="display:initial"' ?>>
							<?php echo $lang['IMAGE_SIZE_ERROR'] ?>
					</div>
					<div id="error-event-image-ext" class="event-error" <?php if (!empty($_GLOBALS['EDIT']['ext'])) echo 'style="display:initial"' ?>>
							<?php echo $lang['IMAGE_EXT_ERROR'] ?>
					</div>
					<input type="hidden" id="id" name="id" value="<?php echo $row['id'] ?>">

					<input id="event-edit-submit" type="submit" class="button" value="<?php echo $lang['SAVE'] ?>" name="submit">
				</form>
			</div>
		</div>
		<?php include('templates/footer.php'); ?>
	</div>
</body>
</html>