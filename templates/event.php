<!DOCTYPE html>
<html>
<head>
	<title><?php echo $lang['SITE_NAME'] ?></title>
	<link rel="stylesheet" href="../styles.css">
</head>
<body>
	<div id="wrapper">
		<?php include('templates/header.php'); ?>
		<div class="box center default-width">
			<?php $row = getEvent($_GET['id']); ?>
			<p><?php echo $row['name'] ?></p>
			<div class="div-event-image-big" style="background-image:url(<?php echo '../'.$row['image'] ?>)"></div>
			<p><?php echo $row['description'] ?></p>
			<p><?php echo $row['date'] ?></p>
			<p><?php echo $lang[$row['type']] ?></p>
			<?php include('templates/footer.php'); ?>
		</div>
	</div>
</body>
</html>