<?php
set_include_path('..');
include_once('database/users.php');
if (isset($_GET['exists'])) 
	echo json_encode(userExists($_GET['exists']));
?>