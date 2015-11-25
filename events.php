<?php 
include_once('core/common.php');
include_once('core/session.php'); 
include_once('database/events.php');

function validateDate($date)
{
    $d = DateTime::createFromFormat('Y-m-d', $date);
    $today = new DateTime('now');
    return $d && $d->format('Y-m-d') == $date && $d >= $today;
}
if(isSet($_GET['action']) && $_GET['action'] == 'new')
{
	include_once('core/require_session.php');
	if (isset($_POST["submit"]))
	{
		$valid_name = !empty($_POST['name']);
		$valid_desc = !empty($_POST['desc']);
		$valid_date = validateDate($_POST['date']);
		$valid_image = (!empty($_FILES['image']['tmp_name']) && ($image_info = getimagesize($_FILES['image']['tmp_name'])));
		$valid_image_size = $valid_image ? $_FILES['image']['size'] <= $_GLOBALS['max_image_upload'] : true;
		$valid_extension = ($valid_image && $valid_image_size) ? in_array($image_info[2],$_GLOBALS['allowed_image_types']) : true;

		if($valid_name && $valid_desc && $valid_date && $valid_image && $valid_extension)
		{
			$filename = $_FILES['image']['name'];
			$extension = image_type_to_extension($image_info[2]);
			do {
			    $filename = uniqid().$extension;
			} while( file_exists($_GLOBALS['uploads_path'].$filename));
			$newfile = $_GLOBALS['uploads_path'].$filename;
			if (newEvent($_POST['name'], $_POST['desc'], $_POST['date'], $_POST['type'], $newfile, $_SESSION['user_id']))
			{
				move_uploaded_file($_FILES['image']['tmp_name'], $newfile);
				$id = latestUserEvent($_SESSION['user_id']);
				header('Location: '.$id);
				return;
			}
		}
		$_GLOBALS['NEW'] = array("name" => !$valid_name, "desc" => !$valid_desc, "date" => !$valid_date, 
									"image" => !$valid_image, "size" => !$valid_image_size, "ext" => !$valid_extension);
	}
	include('templates/events_new.php');
}
else if(isSet($_POST['delete']))
{
	deleteEvent($_SESSION['user_id'],$_POST['delete']);
	header('Location: '.$_GLOBALS['web_root']);
	die;
}
else if(isSet($_GET['action']) && $_GET['action'] == 'edit')
{
	include_once('core/require_session.php');
	if(isset($_POST['submit']))
	{
		$valid_name = !empty($_POST['name']);
		$valid_desc = !empty($_POST['desc']);
		$valid_date = validateDate($_POST['date']);
		$use_previous_image = empty($_FILES['image']['tmp_name']);
		$valid_image = (!empty($_FILES['image']['tmp_name']) && ($image_info = getimagesize($_FILES['image']['tmp_name'])));
		$valid_image_size = $valid_image ? $_FILES['image']['size'] <= $_GLOBALS['max_image_upload'] : true;
		$valid_extension = ($valid_image && $valid_image_size) ? in_array($image_info[2],$_GLOBALS['allowed_image_types']) : true;

		if($valid_name && $valid_desc && $valid_date && $valid_image_size && $valid_extension) {
			if($valid_image)
			{
				$filename = $_FILES['image']['name'];
				$extension = image_type_to_extension($image_info[2]);
				do {
				    $filename = uniqid().$extension;
				} while( file_exists($_GLOBALS['uploads_path'].$filename));
				$newfile = $_GLOBALS['uploads_path'].$filename;
				move_uploaded_file($_FILES['image']['tmp_name'], $newfile);

				updateEvent($_POST['name'],$_POST['desc'],$_POST['date'],$_POST['type'],$newfile, $_POST['id'],$_SESSION['user_id']);
				header('Location: ../'.$_POST['id']);
			}
			else if($use_previous_image)
			{
				updateEvent($_POST['name'],$_POST['desc'],$_POST['date'],$_POST['type'],false, $_POST['id'],$_SESSION['user_id']);
				header('Location: ../'.$_POST['id']);
			}
		} 

		$_GLOBALS['EDIT'] = array("name" => !$valid_name, "desc" => !$valid_desc, "date" => !$valid_date, 
								"image" => !$valid_image,"use_previous" => $use_previous_image, "size" => !$valid_image_size, "ext" => !$valid_extension);
	}
	include('templates/events_edit.php');
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