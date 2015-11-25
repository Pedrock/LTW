<?php
	include_once('connection.php');

	function getUserEvents($user_id)
	{
		global $db;
		$stmt = $db->prepare('SELECT events.id id,name,image,date,description,type FROM events LEFT JOIN event_types ON type_id = event_types.id WHERE user_id = ? AND deleted = 0');
		$stmt->execute(array($user_id));
		return $stmt->fetchAll();
	}

	function updateEvent($name,$description,$date,$type,$image,$event_id, $user_id)
	{
		global $db;
		if(!$image)
		{
			$stmt = $db->prepare('UPDATE events SET name = ?,description = ?,date = ?,type_id = ? WHERE id = ? AND user_id = ?');
			$stmt->execute(array($name,$description,$date,$type,$event_id, $user_id));
		}
		else
		{
			$stmt = $db->prepare('UPDATE events SET name = ?,description = ?,date = ?,type_id = ?,image = ? WHERE id = ? AND user_id = ?');
			$stmt->execute(array($name,$description,$date,$type,$image,$event_id, $user_id));
		}
		$event = $stmt->rowCount();
		return $event;
	}

	function isUserEvent($user_id,$event_id)
	{
		global $db;
		$stmt = $db->prepare('SELECT id FROM events WHERE user_id = ? AND id = ? AND deleted = 0');
		$stmt->execute(array($user_id,$event_id));
		$row = $stmt->fetch();
		if ($row === false) return false;
		return $row['id'];
	}

	function deleteEvent($user_id, $event_id)
	{
		global $db;
		$stmt = $db->prepare('UPDATE events SET deleted = 1 WHERE id = ? AND user_id = ?');
		$stmt->execute(array($event_id, $user_id));
		$event = $stmt->fetch();
		return ($event!==false);
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
		$stmt = $db->prepare('SELECT events.id id,name,image,date,description,type,user_id FROM events LEFT JOIN event_types ON type_id = event_types.id WHERE events.id=? AND deleted = 0');
		$stmt->execute(array($event_id));
		return $stmt->fetch();
	}

	function getEventAndSubscription($event_id, $user_id)
	{
		global $db;
		$stmt = $db->prepare('SELECT events.id id,name,image,date,description,type,events.user_id user_id, COUNT(event_id) subscribed FROM events 
			LEFT JOIN event_types ON type_id = event_types.id 
			LEFT JOIN event_subscriptions ON event_id = events.id AND event_subscriptions.user_id = ?
			WHERE events.id=? AND deleted = 0');
		$stmt->execute(array($user_id,$event_id));
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

	function createComment($event_id, $user_id, $comment)
	{
		global $db;
		$stmt = $db->prepare('INSERT INTO event_comments(user_id,event_id,text) VALUES (?,?,?)');
		$stmt->execute(array($user_id, $event_id, htmlspecialchars($comment)));
		return $db->lastInsertId();
	}

	function getEventComments($event_id, $last_id = false)
	{
		global $db;
		if ($last_id === false)
		{
			$stmt = $db->prepare('SELECT event_comments.id id, (first_name || " " || last_name) user_name, date, text FROM event_comments 
				LEFT JOIN users ON user_id = users.id WHERE event_id = ? ORDER BY id DESC');
			$stmt->execute(array($event_id));
			return $stmt->fetchAll();
		}
		else
		{
			$stmt = $db->prepare('SELECT event_comments.id id, (first_name || " " || last_name) user_name, date, text FROM event_comments 
				LEFT JOIN users ON user_id = users.id WHERE event_id = ? AND event_comments.id > ? ORDER BY id DESC');
			$stmt->execute(array($event_id,$last_id));
			return $stmt->fetchAll(PDO::FETCH_CLASS);
		}
		
	}
?>