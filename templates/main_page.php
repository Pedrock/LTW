<?php
include_once('core/common.php');
include_once('core/session.php'); 
include_once('database/events.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $lang['SITE_NAME'] ?></title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<div id="wrapper">
		<?php include('templates/header.php'); ?>
		<ul>
			<li><a href="#mine"><?php echo $lang['MY_EVENTS'] ?></a></li>
			<li><a href="#subscribed"><?php echo $lang['SUBSCRIBED_EVENTS'] ?></a></li>
			<li><a href="events/new"><?php echo $lang['CREATE'] ?></a></li>
		</ul>
		<div id="mine">
			<ul>
				<?php
					$events = getUserEvents($_SESSION['user_id']);
					foreach ($events as $row)
					{ ?>
						<li>
							<a href="events/<?php echo $row['id'] ?>" >
								<div id="div-event-image" style="background-image:url(<?php echo $row['image'] ?>)"></div>
								<p><?php echo $row['date'] ?></p>
								<p><?php echo $row['description'] ?></p>
								<p><?php echo $row['type'] ?></p>
							</a>
						</li>
					<?php
					}
				?>
			</ul>
		</div>
		<div id="subscribed">
			<p></p>
		</div>
		<?php include('templates/footer.php'); ?>
	</div>
</body>
</html>