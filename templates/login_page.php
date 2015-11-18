<?php
include_once('core/common.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $lang['SITE_NAME'] ?></title>
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="templates/js/script.js"></script>
</head>
<body>
	<div id="wrapper">
		<div id="main" >
			<div id="login">
				<form action="login.php" method="POST">
					<h2> <?php echo $lang['LOGIN'] ?> </h2>
					<h3><?php echo $lang['EMAIL'] ?></h3>
					<input type="email" name="email">
					<h3><?php echo $lang['PASSWORD'] ?></h3>
					<input type="password" name="password">
					<input type="submit" value="<?php echo $lang['LOGIN'] ?>">
				</form>
			</div>
			<div id="register">
				<form action="register.php" method="POST">
					<h2> <?php echo $lang['REGISTER'] ?> </h2>
					<h3><?php echo $lang['FIRST_NAME'] ?></h3>
					<input type="text" name="fname">
					<h3><?php echo $lang['LAST_NAME'] ?></h3>
					<input type="text" name="lname">
					<h3><?php echo $lang['EMAIL'] ?></h3>
					<input type="email" name="email">
					<h3><?php echo $lang['PASSWORD'] ?></h3>
					<input type="password" name="password">
					<h3><?php echo $lang['CONFIRM_PASSWORD'] ?></h3>
					<input type="password" name="password2">
					<br><div class="error-reg-pass" style="width: 50%; background-color: red; border-color: 1px solid black; border-radius: 4px; text-align: center; padding: 10px; display: none;"></div>
					<input type="submit" value="<?php echo $lang['REGISTER'] ?>">
				</form>
			</div>
		</div>
		<?php include('templates/footer.php'); ?>
	</div>
</body>
</html>