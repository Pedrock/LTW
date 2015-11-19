<?php
include_once('../database/users.php');
if (isset($_GET['exists'])) 
	echo json_encode(userExists($_GET['exists']));
?>