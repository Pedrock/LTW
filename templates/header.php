<?php 
include_once('templates/common.php');
include_once('templates/session.php'); 
?>
<div id="header">
	<p id="username"><?php echo getFullName($_SESSION['user_id']) ?></p>
	<a href="logout"><?php echo $lang['LOGOUT'] ?></a>
</div>