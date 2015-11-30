<?php
	$db = new PDO(file_exists("database/db.db") ? 'sqlite:database/db.db' : 'sqlite:../database/db.db');
	$db->exec('PRAGMA foreign_keys = ON;');
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
?>