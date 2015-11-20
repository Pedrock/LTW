<?php
	include_once('connection.php');

	function getUserEvents($user_id)
	{
		global $db;
		$stmt = $db->prepare('SELECT events.id id,name,image,date,description,type FROM events LEFT JOIN event_types ON type_id = event_types.id WHERE user_id = ?');
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

	function latestUserEvent($user_id)
	{
		global $db;
		$stmt = $db->prepare('SELECT id FROM events WHERE user_id = ? ORDER BY creation_date DESC LIMIT 1');
		$stmt->execute(array($user_id));
		$row = $stmt->fetch();
		if ($row === false) return false;
		return $row['id'];
	}

	function getEvent($event_id)
	{
		global $db;
		$stmt = $db->prepare('SELECT events.id id,name,image,date,description,type FROM events LEFT JOIN event_types ON type_id = event_types.id WHERE events.id=?');
		$stmt->execute(array($event_id));
		return $stmt->fetch();
	}

	function getEventTypes()
	{
		global $db;
		$stmt = $db->prepare('SELECT id, type FROM event_types');
		$stmt->execute();
		return $stmt->fetchAll();
	}
?>