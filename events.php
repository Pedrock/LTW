<?php 
include_once('core/common.php');
include_once('core/session.php'); 
include_once('database/events.php');

function validateDate($date)
{
    $d = DateTime::createFromFormat('Y-m-d', $date);
    return $d && $d->format('Y-m-d') == $date;
}

if(isSet($_GET['action']) && $_GET['action'] == 'new')
{
	include_once('core/require_session.php');
	if (isset($_POST["submit"]))
	{
		if (!validateDate($_POST['date'])) echo 'data invalida';
		else if (!getimagesize($_FILES['image']['tmp_name'])) echo 'imagem invalida';
		else if ($_FILES['image']['size'] > 5000000) echo 'imagem demasiado grande (>5Mb)';
		else
		{
			$allowed =  array('gif','png','jpg');
			$filename = $_FILES['image']['name'];
			$extension = pathinfo($filename, PATHINFO_EXTENSION);
			if(!in_array(strtolower($extension),$allowed) ) {
				include('templates/events_new.php');
				return;
			}
			$path = 'uploads/';
			do {
			    $filename = uniqid().'.'.$extension;
			} while( file_exists($path.$filename));
			$newfile = $path.$filename;
			if (newEvent($_POST['name'], $_POST['name'], $_POST['date'], $_POST['type'], $newfile, $_SESSION['user_id']))
			{
				move_uploaded_file($_FILES['image']['tmp_name'], $newfile);
				$id = latestUserEvent($_SESSION['user_id']);
				header('Location: '.$id);
				return;
			}
			echo 'Invalid event';
			die();
		}
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