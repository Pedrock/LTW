<!DOCTYPE html>
<html>
<head>
	<title><?php echo $lang['SITE_NAME'] ?></title>
	<link rel="stylesheet" href="../styles.css">
</head>
<body>
	<div id="wrapper">
		<?php include('templates/header.php'); ?>
		<div>
			<?php $row = getEvent($_GET['id']); ?>
			<p><?php echo $row['name'] ?></p>
			<div id="div-event-image" style="background-image:url(<?php echo '../'.$row['image'] ?>)"></div>
			<p><?php echo $row['description'] ?></p>
			<p><?php echo $row['date'] ?></p>
			<p><?php echo $row['type'] ?></p>
			<?php include('templates/footer.php'); ?>
		</div>
	</div>
</body>
</html>