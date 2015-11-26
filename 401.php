<?php header("HTTP/1.0 401 Unauthorized"); ?>
<html>
<head>
	<title>401</title>
</head>
<body>
	<h1>401!</h1>
	<button onclick="window.history.back();">Go Back</button>
</body>
</html>
<?php die() ?>