<?php
	include_once('connection.php');

	function registerUser($email,$password,$first_name,$last_name)
	{
		global $db;
		$options = ['cost' => 12];
		$stmt = $db->prepare('INSERT INTO users(email,password,first_name,last_name) VALUES (?, ?, ?, ?)');
		if (!$stmt->execute(array(
			$email, 
			password_hash($password, PASSWORD_DEFAULT, $options),
			htmlspecialchars($first_name),
			htmlspecialchars($last_name))
		)) return FALSE;
		return login($email, $password);
	}

	function login($email, $password)
	{
		global $db;
		$stmt = $db->prepare('SELECT id, password FROM users WHERE lower(email) = lower(?)');
		$stmt->execute(array($email));
		$user = $stmt->fetch();
		if ($user !== false && password_verify($password, $user['password'])) {
			return $user['id'];
		}
		return false;
	}

	function validSession($user_id)
	{
		global $db;
		$stmt = $db->prepare('SELECT * FROM users WHERE id = ?');
		$stmt->execute(array($user_id));
		$user = $stmt->fetch();
		return ($user !== false);
	}

	function getFullName($user_id)
	{
		global $db;
		$stmt = $db->prepare("SELECT (first_name || ' ' || last_name) full_name FROM users WHERE id = ?");
		$stmt->execute(array($user_id));
		$user = $stmt->fetch();
		if ($user !== false)
			return $user['full_name'];
		return null;
	}

	function userExists($email)
	{
		global $db;
		$stmt = $db->prepare('SELECT * FROM users WHERE lower(email) = lower(?)');
		$stmt->execute(array($email));
		$user = $stmt->fetch();
		return ($user !== false);
	}
?>