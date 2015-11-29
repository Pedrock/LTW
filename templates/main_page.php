<?php
include_once('core/common.php');
include_once('core/require_session.php'); 
include_once('database/events.php');

function print_event($row)
{ 
	global $lang; 
	$class = "";
	if ($row['owns']) $class = "owned-event";
	else if ($row['invited']) $class = "invite";
	?>
	<li class="event box <?php echo $class ?>">
		<a href="events/<?php echo $row['id'] ?>" >
			<h3><?php echo $row['name'] ?></h3>
			<div class="div-event-image" style="background-image:url(<?php echo $row['image'] ?>)"></div>
			<p class="event-date"><?php echo $row['date'] ?></p>
			<p><?php echo ($row['subscribed'])?$lang['SUBSCRIBED']:'&nbsp;' ?></p>
		</a>
	</li>
	<?php
} 
?>
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
				<li><a href="#next"><?php echo $lang['NEXT'] ?></a></li>
				<li><a href="#previous"><?php echo $lang['PREVIOUS'] ?></a></li>
				<li class="tab-right button"><a href="events/new"><?php echo $lang['CREATE'] ?></a></li>
			</ul>
			<div class="tabs-panel">
				<div id="next">
					<ul class="events-list">
						<?php
						$events = getNextEvents($_SESSION['user_id']);
						foreach ($events as $row) print_event($row);
						?>
					</ul>
				</div>
				<div id="previous">
					<ul class="events-list">
						<?php
						$events = getPreviousEvents($_SESSION['user_id']);
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