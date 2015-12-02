<?php 
header("HTTP/1.0 404 Not Found"); 
include_once('core/common.php');
include_once('core/session.php');
?>
<html>
<head>
	<title>404</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<div id="wrapper">
		<?php include('templates/header.php'); ?>

		<div id="content" class="center default-width">
			<div class="error-box">
			<h1><?php echo $lang['WHOOPS'] ?></h1>
			<div id="image-404">
				<img src="images/not_found.jpg" width="200px" alt="300x200">
			</div>
			<h1><?php echo $lang['ERROR_404'] ?></h1>
			<p id="a"><?php echo $lang['PAGE_NOT_FOUND'] ?></p>
			<button class="button error-button" onclick="window.history.back();"><?php echo $lang['GO_BACK'] ?></button>
			</div>
		</div>
		<?php include('templates/footer.php'); ?>
	</div>
</body>
</html>
<?php die() ?>

