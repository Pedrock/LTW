<?php
	include_once('connection.php');

	function getUserEvents($user_id)
	{
		global $db;
		$stmt = $db->prepare('SELECT events.id id,name,image,date,description,type FROM events LEFT JOIN event_types ON type_id = event_types.id WHERE user_id = ? AND deleted = 0');
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
		$stmt = $db->prepare('SELECT events.id id,name,image,date,description,type FROM events LEFT JOIN event_types ON type_id = event_types.id WHERE events.id=? AND deleted = 0');
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

	function subscribeEvent($event_id, $user_id)
	{
		global $db;
		$stmt = $db->prepare('INSERT OR IGNORE INTO event_subscriptions(event_id,user_id) VALUES (?,?)');
		return ($stmt->execute(array($event_id, $user_id)));
	}

	function unsubscribeEvent($event_id, $user_id)
	{
		global $db;
		$stmt = $db->prepare('DELETE FROM event_subscriptions WHERE event_id = ? AND user_id = ?');
		return ($stmt->execute(array($event_id, $user_id)));
	}

	function getSubscribedEvents($user_id)
	{
		global $db;
		$stmt = $db->prepare('SELECT events.id id,name,image,date,description,type FROM event_subscriptions 
			LEFT JOIN events ON events.id = event_id
			LEFT JOIN event_types ON type_id = event_types.id 
			WHERE event_subscriptions.user_id = ? AND deleted = 0');
		$stmt->execute(array($user_id));
		return $stmt->fetchAll();
	}

	function isEventSubscribed($event_id, $user_id)
	{
		global $db;
		$stmt = $db->prepare('SELECT * FROM event_subscriptions WHERE event_id = ? AND user_id = ?');
		$stmt->execute(array($event_id, $user_id));
		$subscription = $stmt->fetch();
		return ($subscription !== false);
	}

	function searchEvents($string)
	{
		global $db;
		$stmt = $db->prepare('SELECT id,name,image,date,description FROM events WHERE deleted = 0 AND name LIKE ?');
		$stmt->execute(array(htmlspecialchars($string).'%'));
		return $stmt->fetchAll(PDO::FETCH_CLASS);
	}
?>