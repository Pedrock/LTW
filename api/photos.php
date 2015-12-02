<?php
header('Content-Type: application/json');
set_include_path('..');
if (!empty($_FILES) && isSet($_POST['id']))
{
	include_once("core/require_session.php");
	include_once("core/event_permission.php");
	include_once("core/jpeg.php");
	include_once("database/events.php");

	for ($i = 0; $i < count($_FILES['images']['name']); $i++)
	{
		$tmp_file = $_FILES['images']['tmp_name'][$i];
		$filepath = $_CONFIG['uploads_path'].sha1_file($tmp_file).'.jpg';
		if (!file_exists('../'.$filepath))
		{
			if (!createjpeg($tmp_file,'../'.$filepath)) return;
		}
		newPhoto($_POST['id'], $filepath, $_SESSION['user_id']);
	}
	echo json_encode(getEventPhotos($_POST['id'], $_SESSION['user_id']));
}
else if (isSet($_POST['id']) && isSet($_POST['delete']))
{
	include_once("core/require_session.php");
	include_once("core/event_permission.php");
	include_once("database/events.php");

	echo json_encode(deletePhoto($_POST['id'], $_POST['delete'], $_SESSION['user_id']));
}
else echo json_encode(false);
?>