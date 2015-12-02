<?php header("HTTP/1.0 401 Unauthorized");  
include_once('core/common.php');
include_once('core/session.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $lang['PERMISSION_DENIED'] ?></title>
	<link rel="stylesheet" href="../styles.css">
	<script src="<?php echo $_CONFIG['web_root'].$_CONFIG['jquery'] ?>"></script>
</head>
<body>
	<div id="wrapper">
		<?php include('templates/header.php'); ?>

		<div id="content" class="center default-width">
			<div class="error-box">
				<h1><?php echo $lang['WHOOPS'] ?></h1>
				<div id="image-401">
					<img src="../images/permission-denied.jpg" width="200" alt="Permission denied">
				</div>
				<p id="a"><?php echo $lang['PERMISSION_DENIED'] ?></p>
				<?php
				if (!isSet($_SESSION['user_id']))
					{
						echo '<p>'.$lang['LOGIN_MESSAGE'].'</p>';
					}
					?>
				<button class="button error-button" onclick="window.history.back();"><?php echo $lang['GO_BACK'] ?></button>
				<?php
				if (!isSet($_SESSION['user_id']))
					{
						echo '<a class="button error-button" href="'.$_CONFIG['web_root'].'">'.$lang['GO_TO_MAIN_PAGE'].'</a>';
					}
					?>
			</div>
		</div>
		<?php include('templates/footer.php'); ?>
	</div>
</body>
</html>
<?php die() ?>

