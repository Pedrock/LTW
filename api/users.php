<?php
include_once('../database/users.php');
echo "oi";
if (isset($_GET['exists'])) 
	echo json_encode(userExist($_GET['exists']));
?>