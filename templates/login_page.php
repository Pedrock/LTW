<?php
include_once('core/common.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $lang['SITE_NAME'] ?></title>
	<script src="<?php echo $_GLOBALS['jquery'] ?>"></script>
	<script type="text/javascript" src="js/login-page-script.js"></script>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<div id="wrapper">
		<div id="content" class="login" >
			<div class="spacing"> </div>
			<div id="login" class="box">
				<form action="login.php" method="POST">
					<h2> <?php echo $lang['LOGIN'] ?> </h2>
					<input type="email" name="email" placeholder="<?php echo $lang['EMAIL'] ?>">
					<input type="password" name="password" placeholder="<?php echo $lang['PASSWORD'] ?>">
					<input type="submit" class="button" value="<?php echo $lang['LOGIN'] ?>">
				</form>
			</div>
			<div id="register" class="box">
				<form action="register.php" method="POST">
					<h2> <?php echo $lang['REGISTER'] ?> </h2>
					<input type="text" name="fname" placeholder="<?php echo $lang['FIRST_NAME'] ?>">
					<input type="text" name="lname" placeholder="<?php echo $lang['LAST_NAME'] ?>">
					<input type="email" name="email" placeholder="<?php echo $lang['EMAIL'] ?>">
					<div id="error-reg-email-used" class="error-reg"></div>
					<input type="password" name="password" placeholder="<?php echo $lang['PASSWORD'] ?>">
					<div id="error-reg-pass-leng" class="error-reg"></div>
					<input type="password" name="password2" placeholder="<?php echo $lang['CONFIRM_PASSWORD'] ?>">
					<div id="error-reg-pass-dif" class="error-reg"></div>
					<input type="submit" class="button" value="<?php echo $lang['REGISTER'] ?>">
				</form>
			</div>
		</div>
		<?php include('templates/footer.php'); ?>
	</div>
</body>
</html>