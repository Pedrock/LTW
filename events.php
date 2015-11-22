<?php 
include_once('core/common.php');
include_once('core/session.php'); 
include_once('database/events.php');

function validateDate($date)
{
    $d = DateTime::createFromFormat('Y-m-d', $date);
    $today = new DateTime('now');
    return $d && $d->format('Y-m-d') == $date && $today<=$d;
}

if(isSet($_GET['action']) && $_GET['action'] == 'new')
{
	include_once('core/require_session.php');
	if (isset($_POST["submit"]))
	{
		if(!preg_match("/^[A-z]+/", $_POST['name']))
			$name = true;
		if(!preg_match("/^[A-z]+/", $_POST['desc']))
			$desc = true;
		if (!validateDate($_POST['date'])) $date = true;
		if (empty($_FILES['image']['tmp_name']) || !getimagesize($_FILES['image']['tmp_name'])) $image=true;
		else if (getimagesize($_FILES['image']['tmp_name']) && $_FILES['image']['size'] > 5000000) 
		{
			$image_length=dio_truncate(fd, offset);
			$image_length_error = true;
		}
		else if(!$name && !$desc && !$date && !$image && !$image_length_error)
		{
			$allowed =  array('gif','png','jpg');
			$filename = $_FILES['image']['name'];
			$extension = pathinfo($filename, PATHINFO_EXTENSION);
			if(!in_array(strtolower($extension),$allowed) ) {
				$extension_error = true;
				include('templates/events_new.php');
				return;
			}
			$path = 'uploads/';
			do {
			    $filename = uniqid().'.'.$extension;
			} while( file_exists($path.$filename));
			$newfile = $path.$filename;
			if (newEvent($_POST['name'], $_POST['desc'], $_POST['date'], $_POST['type'], $newfile, $_SESSION['user_id']))
			{
				move_uploaded_file($_FILES['image']['tmp_name'], $newfile);
				$id = latestUserEvent($_SESSION['user_id']);
				header('Location: '.$id);
				return;
			}
			$invalid = true;
			
		}
		include('templates/events_new.php');
		return;
	}
	else include('templates/events_new.php');
}
else if(isSet($_GET['id']))
{
	include('templates/event.php');
}
else
{
	if (isSet($_GET['action'])) header('Location: ..');
	else header('Location: .');
	die();
}
?>