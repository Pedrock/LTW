<div id="header">
	<a href="<?php echo $_GLOBALS['web_root'] ?>"><h1><?php echo $lang['SITE_NAME'] ?></h1></a>
	<h3 id="username"><?php echo getFullName($_SESSION['user_id']) ?></h3>
	<a href="logout"><?php echo $lang['LOGOUT'] ?></a>
</div>