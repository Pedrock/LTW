<?php
header('Content-Type: application/json');
set_include_path('..');
if (!empty($_FILES) && isSet($_POST['id']))
{
	include_once("core/require_session.php");
	include_once("core/event_permission.php");
	include_once("database/events.php");

	for ($i = 0; $i < count($_FILES['images']['name']); $i++)
	{
		$tmp_file = $_FILES['images']['tmp_name'][$i];
		$valid_image = (!empty($tmp_file) && ($image_info = getimagesize($tmp_file)));
		if ($valid_image)
		{
			$extension = image_type_to_extension($image_info[2]);
			$filepath = $_CONFIG['uploads_path'].sha1_file($tmp_file).$extension;
			if (!file_exists('../'.$filepath))
				move_uploaded_file($tmp_file, '../'.$filepath);
			newPhoto($_POST['id'], $filepath, $_SESSION['user_id']);
		}
	}
	echo json_encode(getEventPhotos($_POST['id'], $_SESSION['user_id']));
}
else echo json_encode(false);
?>