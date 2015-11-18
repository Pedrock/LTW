<?php
	include_once('connection.php');

	function getUserEvents($user_id)
	{
		global $db;
		$stmt = $db->prepare('SELECT events.id id,image,date,description,type FROM events LEFT JOIN event_types ON type_id = event_types.id WHERE user_id = ?');
		$stmt->execute(array($user_id));
		return $stmt->fetchAll();
	}

	function newEvent($name, $description, $date, $type, $image, $user_id)
	{
		global $db;
		$stmt = $db->prepare('INSERT INTO events(name,description,date,type_id,image,user_id) VALUES (?, ?, ?, ?, ?, ?)');
		if (!$stmt->execute(array(
			htmlspecialchars($name), 
			htmlspecialchars($description), 
			$date,
			$type,
			$image,
			$user_id
		))) return FALSE;
		return TRUE;
	}
?>