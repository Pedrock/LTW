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
				<form action="login" method="POST">
					<h2> <?php echo $lang['LOGIN'] ?> </h2>
					<input type="email" name="email" placeholder="<?php echo $lang['EMAIL'] ?>">
					<input type="password" name="password" placeholder="<?php echo $lang['PASSWORD'] ?>">
					<input type="submit" class="button" value="<?php echo $lang['LOGIN'] ?>">
				</form>
			</div>
			<div id="register" class="box">
				<form action="register" method="POST">
					<h2> <?php echo $lang['REGISTER'] ?> </h2>
					<input type="text" id="fname" name="fname" placeholder="<?php echo $lang['FIRST_NAME'] ?>"
					value="<?php if(isSet($_POST['fname'])) echo $_POST['fname'] ?>">	
					<div id="error-reg-fname" class="error-reg" <?php if (!empty($_GLOBALS['LOGIN']['fname'])) echo 'style="display:initial"' ?>>
						<?php echo $lang['FIRST_NAME_ERROR'] ?>
					</div>
				
					<input type="text" id="lname" name="lname" placeholder="<?php echo $lang['LAST_NAME'] ?>"
					value="<?php if(isSet($_POST['lname'])) echo $_POST['lname'] ?>">
					<div id="error-reg-lname" class= "error-reg" <?php if (!empty($_GLOBALS['LOGIN']['lname'])) echo 'style="display:initial"' ?>>
						<?php echo $lang['LAST_NAME_ERROR'] ?>
					</div>
					
					<input type="text" name="email" placeholder="<?php echo $lang['EMAIL'] ?>"
					value="<?php if(isSet($_POST['email'])) echo $_POST['email'] ?>">
					<div id="error-reg-email" class= "error-reg" <?php if (!empty($_GLOBALS['LOGIN']['email'])) echo 'style="display:initial"' ?>>
						<?php echo $lang['EMAIL_ERROR'] ?>
					</div>
					<div id="reg-email-in-use" class= "error-reg" <?php if (!empty($_GLOBALS['LOGIN']['email-in-use'])) echo 'style="display:initial"' ?>>
						<?php echo $lang['EMAIL_IN_USE'] ?>
					</div>

					<input type="password" name="password" placeholder="<?php echo $lang['PASSWORD'] ?>">
					<div id="error-reg-pass" class= "error-reg" <?php if (!empty($_GLOBALS['LOGIN']['password'])) echo 'style="display:initial"' ?>>
						<?php echo $lang['PASSWORD_LENGTH'] ?>
					</div>
					
					<input type="password" name="password2" placeholder="<?php echo $lang['CONFIRM_PASSWORD'] ?>">
					<div id="error-reg-pass2" class= "error-reg" <?php if (!empty($_GLOBALS['LOGIN']['password2'])) echo 'style="display:initial"' ?>>
						<?php echo $lang['PASSWORD_DIFF'] ?>
					</div>

					<input type="submit" class="button" value="<?php echo $lang['REGISTER'] ?>">
				</form>
			</div>
		</div>
		<?php include('templates/footer.php'); ?>
	</div>
</body>
</html>