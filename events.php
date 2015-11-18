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
	if (isset($_POST["submit"]))
	{
		if (validateDate($_POST['date']) && getimagesize($_FILES['image']['tmp_name']) && $_FILES['image']['size'] < 5000000) // 5Mb
		{
			$allowed =  array('gif','png','jpg');
			$filename = $_FILES['image']['name'];
			$extension = pathinfo($filename, PATHINFO_EXTENSION);
			if(!in_array($extension,$allowed) ) {
				include('templates/events_new.php');
				var_dump($extension);
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
				echo 'Event added';
				return;
			}
		}
		echo 'Invalid event';
	}
	else include('templates/events_new.php');
}
?>