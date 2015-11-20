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
	<script src="<?php echo $_GLOBALS['jquery'] ?>"></script>
	<script type="text/javascript" src="js/tabs.js"></script>
</head>
<body>
	<div id="wrapper">
		<?php include('templates/header.php'); ?>
		<div class="center default-width">
			<ul class="tabs">
				<li><a href="#mine"><?php echo $lang['MY_EVENTS'] ?></a></li>
				<li><a href="#subscribed"><?php echo $lang['SUBSCRIBED'] ?></a></li>
				<li class="tab-right button"><a href="events/new"><?php echo $lang['CREATE'] ?></a></li>
			</ul>
			<div class="tabs-panel">
				<div id="mine">
					<ul class="events-list">
						<?php
						$events = getUserEvents($_SESSION['user_id']);
						foreach ($events as $row)
						{ ?>
							<li class="event box">
								<a href="events/<?php echo $row['id'] ?>" >
									<p><?php echo $row['name'] ?></p>
									<div class="div-event-image" style="background-image:url(<?php echo $row['image'] ?>)"></div>
									<p><?php echo $row['description'] ?></p>
									<p><?php echo $row['date'] ?></p>
									<p><?php echo $lang[$row['type']] ?></p>
								</a>
							</li>
						<?php
						} ?>
					</ul>
				</div>
				<div id="subscribed">
					
				</div>
			</div>
		</div>
		<?php include('templates/footer.php'); ?>
	</div>
</body>
</html>