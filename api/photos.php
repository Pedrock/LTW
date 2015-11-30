<?php
set_include_path('..');
if (!empty($_FILES))
{
	include_once("core/require_session.php");
	include_once("core/event_permission.php");
	echo var_dump($_FILES);

	for ($i = 0; $i < count($_FILES['images']['name']); $i++)
	{
		move_uploaded_file($_FILES['images']['tmp_name'][$i], '../testes/'.uniqid());
	}
}
else echo 'No files';
?>