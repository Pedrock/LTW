<?php
	$db = new PDO(file_exists("database/db.db") ? 'sqlite:database/db.db' : 'sqlite:../database/db.db');
?>