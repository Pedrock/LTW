<?php
include_once('core/common.php');
include_once('core/require_session.php'); 
include_once('database/events.php');

function print_event($row)
{ 
	global $lang; ?>
	<li class="event box">
		<a href="events/<?php echo $row['id'] ?>" >
			<h3 id="title"><?php echo $row['name'] ?></h3>
			<div class="div-event-image" style="background-image:url(<?php echo $row['image'] ?>)"></div>
			<p id="date"><?php echo $row['date'] ?></p>
		</a>
	</li>
	<?php
} ?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $lang['SITE_NAME'] ?></title>
	<link rel="stylesheet" href="styles.css">
	<script src="<?php echo $_CONFIG['jquery'] ?>"></script>
	<script type="text/javascript" src="js/tabs.js"></script>
</head>
<body>
	<div id="wrapper">
		<?php include('templates/header.php'); ?>
		<div id="content" class="center default-width">
			<ul class="tabs">
				<li><a href="#subscribed"><?php echo $lang['SUBSCRIBED'] ?></a></li>
				<li><a href="#mine"><?php echo $lang['MY_EVENTS'] ?></a></li>
				<li class="tab-right button"><a href="events/new"><?php echo $lang['CREATE'] ?></a></li>
			</ul>
			<div class="tabs-panel">
				<div id="subscribed">
					<ul class="events-list">
						<?php
						$events = getSubscribedEvents($_SESSION['user_id']);
						foreach ($events as $row) print_event($row);
						?>
					</ul>
				</div>
				<div id="mine">
					<ul class="events-list">
						<?php
						$events = getUserEvents($_SESSION['user_id']);
						foreach ($events as $row) print_event($row);
						?>
					</ul>
				</div>
			</div>
		</div>
		
		<?php include('templates/footer.php'); ?>
	</div>
</body>
</html>