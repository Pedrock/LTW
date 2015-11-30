<?php
	include_once('connection.php');

	class InviteYourselfException extends Exception {};
	class EmailException extends Exception {};
	class SubscribedException extends Exception {};
	class InvitedException extends Exception {};

	function _getEvents($previous, $user_id)
	{
		global $db;
		$stmt = $db->prepare("SELECT id,name,image,date, MAX(owns) owns,MIN(invited) invited, MAX(subscribed) subscribed FROM 
			(SELECT id,name,image,date,1 owns,0 invited, 0 subscribed FROM events WHERE user_id = :user AND deleted = 0
			UNION
				SELECT events.id id,name,image,date,0 owns,0 invited, 1 subscribed FROM event_subscriptions
					LEFT JOIN events ON events.id = event_id
					WHERE deleted = 0 AND event_subscriptions.user_id = :user
			UNION
				SELECT events.id id,name,image,date,0 owns,1 invited, 0 subscribed FROM invites
					LEFT JOIN events ON events.id = event_id
					WHERE deleted = 0 AND invites.user_id = :user
			)
			WHERE date".
			($previous?"<":">=")
			."DATE('now')
			GROUP BY id
			ORDER BY date ASC");
		$stmt->execute(array(':user' => $user_id));
		return $stmt->fetchAll();
	}

	function getNextEvents($user_id)
	{
		return _getEvents(false,$user_id);
	}

	function getPreviousEvents($user_id)
	{
		return _getEvents(true,$user_id);
	}

	function updateEvent($event_id,$user_id,$name,$description,$date,$type,$image,$public,$same_date)
	{
		global $db;
		$query = 'UPDATE events SET name=?,description=?,date=?,type_id=?,public=?'.($image?',image=?':'').' WHERE id=? AND user_id=?';
		if($image) $args = array(htmlspecialchars($name),htmlspecialchars($description),$date,$type,$public,$image,$event_id,$user_id);
		else $args = array(htmlspecialchars($name),htmlspecialchars($description),$date,$type,$public,$event_id,$user_id);
		if ($same_date)
		{
			$query .= ' AND date=?';
			array_push($args,$date);
		}
		$stmt = $db->prepare($query);
		$stmt->execute($args);
		$count = $stmt->rowCount();
		return $count > 0;
	}

	function deleteEvent($user_id, $event_id)
	{
		global $db;
		$stmt = $db->prepare('UPDATE events SET deleted = 1 WHERE id = ? AND user_id = ?');
		$stmt->execute(array($event_id, $user_id));
		$event = $stmt->fetch();
		return ($event!==false);
	}
	
	function newEvent($name, $description, $date, $type, $image, $user_id, $public)
	{
		global $db;
		$stmt = $db->prepare('INSERT INTO events(name,description,date,type_id,image,user_id,public) VALUES (?, ?, ?, ?, ?, ?, ?)');
		if (!$stmt->execute(array(
			htmlspecialchars($name), 
			htmlspecialchars($description), 
			$date,
			$type,
			$image,
			$user_id,
			$public
		))) return FALSE;
		$event_id = $db->lastInsertId();
		subscribeEvent($event_id,$user_id);
		return $event_id;
	}

	function newPhoto($event_id, $image)
	{
		global $db;
		$stmt = $db->prepare('INSERT INTO event_photos(event_id,image) VALUES (?, ?)');
		if (!$stmt->execute(array(
			$event_id,
			$image
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
		$stmt = $db->prepare('SELECT events.id id,name,image,date,description,type,user_id,public,type_id FROM events 
			LEFT JOIN event_types ON type_id = event_types.id 
			WHERE events.id=? AND deleted = 0');
		$stmt->execute(array($event_id));
		return $stmt->fetch();
	}

	function getEventAndSubscription($event_id, $user_id)
	{
		global $db;
		$stmt = $db->prepare('SELECT events.id id,name,image,date,description,type,events.user_id user_id,public,type_id, 
				COUNT(event_subscriptions.event_id) subscribed, COUNT(invites.event_id) invited FROM events 
			LEFT JOIN event_types ON type_id = event_types.id 
			LEFT JOIN event_subscriptions ON event_subscriptions.event_id = events.id AND event_subscriptions.user_id = ?
			LEFT JOIN invites ON invites.event_id = events.id AND invites.user_id = ?
			WHERE events.id = ? AND deleted = 0
			GROUP BY events.id');
		$stmt->execute(array($user_id,$user_id,$event_id));
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
		$stmt = $db->prepare('INSERT OR FAIL INTO event_subscriptions(event_id,user_id) VALUES (?,?)');
		return ($stmt->execute(array($event_id, $user_id)));
	}

	function unsubscribeEvent($event_id, $user_id)
	{
		global $db;
		$stmt = $db->prepare('DELETE FROM event_subscriptions WHERE event_id = ? AND user_id = ?');
		return ($stmt->execute(array($event_id, $user_id)));
	}

	function isEventSubscribed($event_id, $user_id)
	{
		global $db;
		$stmt = $db->prepare('SELECT * FROM event_subscriptions WHERE event_id = ? AND user_id = ?');
		$stmt->execute(array($event_id, $user_id));
		$subscription = $stmt->fetch();
		return ($subscription !== false);
	}

	function searchEvents($string, $user_id)
	{
		global $db;
		if ($user_id === false)
		{
			$stmt = $db->prepare('SELECT id, name FROM events 
			WHERE name LIKE ? AND deleted = 0 AND public = 1
			LIMIT 10');
			$stmt->execute(array('%'.htmlspecialchars($string).'%'));
		}
		else 
		{
			$stmt = $db->prepare('SELECT id, name FROM events 
			WHERE name LIKE :string AND deleted = 0
				AND (public = 1 OR user_id = :user
					OR EXISTS (SELECT * FROM event_subscriptions WHERE event_id = events.id AND event_subscriptions.user_id = :user)
					OR EXISTS (SELECT * FROM invites WHERE event_id = events.id AND invites.user_id = :user)
					)
			LIMIT 10');
			$stmt->execute(array('string' => '%'.htmlspecialchars($string).'%',':user' => $user_id));
		}
		return $stmt->fetchAll();
	}

	function getEventSubscribers($event_id)
	{
		global $db;
		$stmt = $db->prepare('SELECT (first_name || " " || last_name) user_name FROM event_subscriptions 
			LEFT JOIN users ON users.id = event_subscriptions.user_id 
			WHERE event_id = ?');
		$stmt->execute(array($event_id));
		return $stmt->fetchAll();
	}

	function createComment($event_id, $user_id, $comment)
	{
		global $db;
		$stmt = $db->prepare('INSERT INTO event_comments(user_id,event_id,text) VALUES (?,?,?)');
		$stmt->execute(array($user_id, $event_id, nl2br(htmlspecialchars($comment))));
		return true;
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
			return $stmt->fetchAll();
		}
	}

	function getEventPhotos($event_id, $user_id)
	{
		global $db;
		if ($user_id === false)
		{
			$stmt = $db->prepare('SELECT events.name events_name, event_photos.id id, event_photos.image image, event_photos.date date
				FROM event_photos 
				LEFT JOIN events ON event_id = events.id
				WHERE events.id = ? AND deleted = 0 AND public = 1
				ORDER BY date DESC');
			$stmt->execute(array($event_id));
		}
		else
		{
			$stmt = $db->prepare('SELECT events.name events_name, event_photos.id id, event_photos.image image, event_photos.date date
				FROM event_photos
				LEFT JOIN events ON event_id = events.id
				WHERE events.id = :event AND deleted = 0
				AND (public = 1 OR user_id = :user
					OR EXISTS (SELECT * FROM event_subscriptions WHERE event_id = events.id AND event_subscriptions.user_id = :user))
				ORDER BY date DESC');
			$stmt->execute(array(':user' => $user_id, ':event' => $event_id));
		}
		return $stmt->fetchAll();
	}

	function inviteToEvent($user_email, $event_id, $owner_id)
	{
		global $db;
		$stmt = $db->prepare("SELECT id, (first_name || ' ' || last_name) full_name FROM users WHERE email = ?");
		$stmt->execute(array($user_email));
		$user = $stmt->fetch();
		if ($user === false) throw new EmailException();
		if ($user['id'] === $owner_id) throw new InviteYourselfException();

		$stmt2 = $db->prepare("SELECT * FROM event_subscriptions WHERE event_id = ? AND user_id = ?");
		$stmt2->execute(array($event_id,$user['id']));
		if ($stmt2->fetch() !== false) throw new SubscribedException();

		$stmt3 = $db->prepare('INSERT OR FAIL INTO invites(user_id,event_id) VALUES (?,?)');
		if ($stmt3->execute(array($user['id'], $event_id))) return $user['full_name'];
		throw new InvitedException();
	}

	function getInvites($event_id)
	{
		global $db;
		$stmt = $db->prepare('SELECT (first_name || " " || last_name) user_name FROM invites 
			LEFT JOIN users ON users.id = invites.user_id 
			WHERE event_id = ? 
			AND NOT EXISTS 
				(SELECT * FROM event_subscriptions WHERE event_subscriptions.event_id = invites.event_id AND event_subscriptions.user_id = users.id)');
		$stmt->execute(array($event_id));
		return $stmt->fetchAll();
	}
?>