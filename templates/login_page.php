<?php
include_once('core/common.php');

?>

<!DOCTYPE html>
<html>
<head>

	<title><?php echo $lang['SITE_NAME'] ?></title>
	<script src="<?php echo $_GLOBALS['jquery'] ?>"></script>
	<script type="text/javascript" src="js/login.js"></script>
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
					<input type="text" id="fname" name="fname" placeholder="<?php echo $lang['FIRST_NAME'] ?>"
					value="<?php if(isSet($_POST['fname'])) echo $_POST['fname'] ?>">	
					<div class="error-php-reg">
						<?php if(isset($fname))echo $lang['FIRST_NAME_WRONG'] ?>
					</div>

					<div id="error-reg-fname" class= "error-reg">
						<?php echo $lang['FIRST_NAME_WRONG'] ?>
					</div>

					

					<input type="text" id="lname" name="lname" placeholder="<?php echo $lang['LAST_NAME'] ?>"
					value="<?php if(isSet($_POST['lname'])) echo $_POST['lname'] ?>">
					<div class="error-php-reg">
						<?php if(isset($lname))echo $lang['LAST_NAME_WRONG'] ?>
					</div>
					<div id="error-reg-lname" class= "error-reg">
						<?php echo $lang['LAST_NAME_WRONG'] ?>
					</div>
					
					<input type="text" name="email" placeholder="<?php echo $lang['EMAIL'] ?>"
					value="<?php if(isSet($_POST['email'])) echo $_POST['email'] ?>">

					<!-- Emails Usados-->
					<div id="error-reg-email" class= "error-reg">
						<?php echo $lang['EMAIL_USED'] ?>
					</div>

					<div class="error-php-reg">
						<?php if(isset($email2))echo $lang['EMAIL_USED'] ?>
					</div>
					<!-- Emails Errados-->

					<div id="error-reg-emailnV" class= "error-reg">
						<?php echo $lang['EMAIL_WRONG'] ?>
					</div>

					<div class="error-php-reg">
						<?php if(isset($email))echo $lang['EMAIL_WRONG'] ?>
					</div>

					<input type="password" name="password" placeholder="<?php echo $lang['PASSWORD'] ?>">
					<div id="error-reg-pass" class= "error-reg">
						<?php echo $lang['PASSWORD_LENGTH'] ?>
					</div>

					<div class="error-php-reg">
						<?php if(isset($password))echo $lang['PASSWORD_LENGTH'] ?>
					</div>
					
					<input type="password" name="password2" placeholder="<?php echo $lang['CONFIRM_PASSWORD'] ?>">
					<div id="error-reg-pass2" class= "error-reg">
						<?php echo $lang['PASSWORD_DIFF'] ?>
					</div>

					<div class="error-php-reg">
						<?php if(isset($password2))echo $lang['PASSWORD_DIFF'] ?>
					</div>

					<input type="submit" class="button" value="<?php echo $lang['REGISTER'] ?>">
					<div id="error-reg" class= "error-reg">
						<?php echo $lang['REGISTER_ERROR'] ?>
					</div>
				</form>
			</div>
		</div>
		<?php include('templates/footer.php'); ?>
	</div>
</body>
</html>