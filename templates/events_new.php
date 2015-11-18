<!DOCTYPE html>
<html>
<head>
	<title><?php echo $lang['SITE_NAME'] ?></title>
</head>
<body>
	<div id="wrapper">
		<?php include('templates/header.php'); ?>
		<div>
			<form action="new" method="POST" enctype="multipart/form-data">
				<h3>Name</h3>
				<input type="text" name="name">
				<h3>Description</h3>
				<input type="text" name="desc">
				<h3>Date</h3>
				<input type="text" name="date">
				<h3>Type</h3>
				<input type="text" name="type">
				<h3>Image</h3>
				<input type="file" name="image">
				<input type="submit" value="<?php echo $lang['CREATE'] ?>" name="submit">
			</form>
		</div>
	</div>
</body>
</html>