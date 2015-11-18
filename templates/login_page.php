<?php
include_once('templates/common.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $lang['SITE_NAME'] ?></title>
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
					<h3><?php echo $lang['CONFIRM_EMAIL'] ?></h3>
					<input type="email" name="email2">
					<h3><?php echo $lang['PASSWORD'] ?></h3>
					<input type="password" name="password">
					<h3><?php echo $lang['BIRTHDATE'] ?></h3>
					<input type="date" name="birthdate">
					<div id="gender-choice">
						<input type="radio" name="gender" value="male"><?php echo $lang['MALE'] ?>
						<input type="radio" name="gender" value="female"><?php echo $lang['FEMALE'] ?>
					</div>
					<input type="submit" value="<?php echo $lang['REGISTER'] ?>">
				</form>
			</div>
		</div>
	</div>
</body>
</html>