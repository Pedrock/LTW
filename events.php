<?php 
include_once('core/common.php');
include_once('core/session.php'); 
include_once('database/events.php');
include_once('core/jpeg.php');

function validateDate($date)
{
    $d = DateTime::createFromFormat('Y-m-d', $date);
    $today = new DateTime('now');
    return $d && $d->format('Y-m-d') == $date && $d >= $today;
}

function checkPOST()
{
	global $_CONFIG;
	$image_info = null;
	$valid_name = !empty($_POST['name']);
	$valid_desc = !empty($_POST['desc']);
	$valid_date = validateDate($_POST['date']);
	$valid_image = (!empty($_FILES['image']['tmp_name']) && ($image_info = getimagesize($_FILES['image']['tmp_name'])));
	$valid_image_size = !$valid_image || $_FILES['image']['size'] <= $_CONFIG['max_image_upload'];
	$valid_extension = !$valid_image || $valid_image_size || in_array($image_info[2], $_CONFIG['allowed_image_types']);
	$valid_privacy = !empty($_POST['privacy']) && ($_POST['privacy'] === "public" || $_POST['privacy'] === "private");

	return array($valid_name,$valid_desc,$valid_date,$valid_image,$valid_image_size,$valid_extension,$valid_privacy,$image_info);
}

if(isSet($_GET['action']) && $_GET['action'] == 'new')
{
	include_once('core/require_session.php');
	if (isset($_POST["submit"]))
	{
		$checks = checkPOST();
		list($valid_name,$valid_desc,$valid_date,$valid_image,$valid_image_size,$valid_extension,$valid_privacy,$image_info) = $checks;

		if ($valid_name && $valid_desc && $valid_date && $valid_image && $valid_image_size && $valid_extension && $valid_privacy)
		{
			$public = $_POST['privacy'] === "public";
			$tmp_file = $_FILES['image']['tmp_name'];
			$filepath = $_CONFIG['uploads_path'].sha1_file($tmp_file).'.jpg';
			
			if ($id = newEvent($_POST['name'], $_POST['desc'], $_POST['date'], $_POST['type'], $filepath, $_SESSION['user_id'], $public))
			{
				if (!file_exists($filepath))
				{
					createjpeg($tmp_file,$filepath);
				}
				header('Location: '.$id);
				return;
			}
		}
		$_NEW = array("name" => !$valid_name, "desc" => !$valid_desc, "date" => !$valid_date, 
									"image" => !$valid_image, "size" => !$valid_image_size, "ext" => !$valid_extension);
	}
	include('templates/events_new.php');
}
else if(isSet($_POST['delete']))
{
	include_once('core/require_session.php');
	deleteEvent($_SESSION['user_id'],$_POST['delete']);
	header('Location: '.$_CONFIG['web_root']);
	die();
}
else if(isSet($_GET['action']) && $_GET['action'] == 'edit')
{
	include_once('core/require_session.php');
	if(isset($_POST['submit']))
	{
		list($valid_name,$valid_desc,$valid_date,$valid_image,$valid_image_size,$valid_extension,$valid_privacy,$image_info) = checkPOST();

		$use_previous_image = true;

		if ($valid_name && $valid_desc && $valid_image_size && $valid_extension && $valid_privacy) {

			$public = $_POST['privacy'] === "public";
			$use_previous_image = empty($_FILES['image']['tmp_name']);

			if ($valid_image)
			{
				$tmp_file = $_FILES['image']['tmp_name'];
				$filepath = $_CONFIG['uploads_path'].sha1_file($_FILES['image']['tmp_name']).'.jpg';
				
				if (updateEvent($_POST['id'],$_SESSION['user_id'],$_POST['name'],$_POST['desc'],$_POST['date'],$_POST['type'],$filepath,$public,!$valid_date))
				{
					if (!file_exists($filepath))
					{
						createjpeg($tmp_file,$filepath);
					}
					header('Location: ../'.$_POST['id']);
					die();
				}
			}
			else if ($use_previous_image)
			{
				if (updateEvent($_POST['id'],$_SESSION['user_id'],$_POST['name'],$_POST['desc'],$_POST['date'],$_POST['type'],false,$public,!$valid_date))
				{
					header('Location: ../'.$_POST['id']);
					die();
				}
			}
		}
		$same_date = false;
		if (!$valid_date)
		{
			include_once("core/event_edit_permission.php");
			$same_date = isSet($_POST['date']) && $row['date'] === $_POST['date'];
		}

		$_EDIT = array("name" => !$valid_name, "desc" => !$valid_desc, "date" => !($valid_date || $same_date), 
								"image" => !($valid_image || $use_previous_image), "size" => !$valid_image_size, "ext" => !$valid_extension);
	}
	include('templates/events_edit.php');
}
else if(isSet($_GET['action']) && $_GET['action'] == 'photos')
{
	include('templates/events_photos.php');
}
else if(isSet($_GET['action']) && $_GET['action'] == 'redirect')
{
	header('Location: '.$_CONFIG['web_root']);
	die();
}
else if(!isSet($_GET['action']) && isSet($_GET['id']))
{
	include('templates/event.php');
}
else
{
	include('templates/404.php');
}
?>