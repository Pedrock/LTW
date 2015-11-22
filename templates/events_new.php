<!DOCTYPE html>
<html>
<head>
	<title><?php echo $lang['SITE_NAME'] ?></title>
	<link rel="stylesheet" href="../styles.css">
	<script src="../<?php echo $_GLOBALS['jquery'] ?>"></script>
	<script type="text/javascript" src="../js/event-subscription.js"></script>
	<script type="text/javascript" src="../js/event_new.js"></script>
</head>
<body>
	<div id="wrapper">
		<?php include('templates/header.php'); ?>
		<div id="content" class="box center default-width">
			<form action="new" method="POST" enctype="multipart/form-data">
				<h3><?php echo $lang['NAME'] ?></h3>
				<input type="text" id="name" name="name" value="<?php if(isSet($_POST['name'])) echo $_POST['name'] ?>">
				
				<div id="error-eve-name" class= "error-eve">
						<?php echo $lang['NAME_ERROR'] ?>
				</div>
				<div class="error-eve-new">
					<?php if(isset($name))echo $lang['NAME_ERROR'] ?>
				</div>
				
				<h3><?php echo $lang['DESCRIPTION'] ?></h3>
				<input type="text" name="desc" value="<?php if(isSet($_POST['desc'])) echo $_POST['desc'] ?>">
				<div id="error-eve-desc" class= "error-eve">
						<?php echo $lang['DESCRIPTION_ERROR'] ?>
				</div>
				<div class="error-eve-new">
					<?php if(isset($desc))echo $lang['DESCRIPTION_ERROR'] ?>
				</div>

				<h3><?php echo $lang['DATE'] ?></h3>
				<input type="date" name="date" value="<?php if(isSet($_POST['date'])) echo $_POST['date'] ?>">
				<div id="error-eve-date" class= "error-eve">
						<?php echo $lang['DATE_ERROR'] ?>
				</div>
				<div class="error-eve-new">
					<?php if(isset($date))echo $lang['DATE_ERROR'] ?>
				</div>

				<h3><?php echo $lang['TYPE'] ?></h3>
				<select name="type">
				<?php
					$types = getEventTypes();
					foreach ($types as $type)
					{ ?>
						<option value="<?php echo $type['id'] ?>" 
						<?php if(isset($_POST['type']) && $_POST['type'] == $type['id']) 
				         echo 'selected= "selected"';?> > <?php echo $lang[$type['type']] ?></option>
					<?php
					} ?>
				</select>
				<h3><?php echo $lang['IMAGE'] ?></h3>
				<input type="file" name="image">
				<div id="error-eve-image" class= "error-eve">
						<?php echo $lang['IMAGE_ERROR'] ?>
				</div>
				<div id="error-eve-image-length" class= "error-eve">
						<?php echo $lang['IMAGE_LENGTH_ERROR'] ?>
				</div>
				<div id="error-eve-image-ext" class= "error-eve">
						<?php echo $lang['IMAGE_LENGTH_EXT'] ?>
				</div>

				<div class="error-eve-new">
					<?php if(isset($image))echo $lang['IMAGE_ERROR'] ?>
				</div>
				<div class="error-eve-new">
					<?php if(isset($image_length_error))echo "ooooi" ?>
				</div>

				<input id="eve-submit" type="submit" value="<?php echo $lang['CREATE'] ?>" name="submit">
			</form>
			<?php include('templates/footer.php'); ?>
		</div>
	</div>
</body>
</html>