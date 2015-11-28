<div id="header">
	<script type="text/javascript" src="js/search.js"></script>
	<a id="webroot" href="<?php echo $_CONFIG['web_root'] ?>"><h1><?php echo $lang['SITE_NAME'] ?></h1></a>
	<input id="search" type="text" autocomplete="off">
	<div id="suggestions">
	</div>
	<div id="logout">
		<?php if (isSet($_SESSION['user_id'])) { ?>
			<h3 id="user_name"> <?php echo getFullName($_SESSION['user_id']) ?></h3>
			<a href="<?php echo $_CONFIG['web_root'] ?>logout"><?php echo $lang['LOGOUT'] ?></a>
		<?php } ?>
	</div>
</div>