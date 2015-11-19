<!DOCTYPE html>
<html>
<head>
	<title><?php echo $lang['SITE_NAME'] ?></title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<div id="wrapper">
		<?php include('templates/header.php'); ?>
		<div>
			<form action="new" method="POST" enctype="multipart/form-data">
				<h3><?php echo $lang['NAME'] ?></h3>
				<input type="text" name="name">
				<h3><?php echo $lang['DESCRIPTION'] ?></h3>
				<input type="text" name="desc">
				<h3><?php echo $lang['DATE'] ?></h3>
				<input type="text" name="date">
				<h3><?php echo $lang['TYPE'] ?></h3>
				<input type="text" name="type">
				<h3><?php echo $lang['IMAGE'] ?></h3>
				<input type="file" name="image">
				<input type="submit" value="<?php echo $lang['CREATE'] ?>" name="submit">
			</form>
			<?php include('templates/footer.php'); ?>
		</div>
	</div>
</body>
</html>