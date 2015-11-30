<?php 
include_once("core/event_permission.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $lang['SITE_NAME'] ?></title>
	<link rel="stylesheet" href="../styles.css">
	<script src="../<?php echo $_CONFIG['jquery'] ?>"></script>
	<script type="text/javascript" src="../js/event.js"></script>
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56557f93aab8dc78" async="async"></script>
</head>
<body>
	<div id="wrapper">
		<?php include('templates/header.php'); ?>

		<div id="content" class="center default-width-with-sidebar">
			<div class="box default-width">

				<span style="float:right;position:relative"><a id="photos-button" class="button" href="<?php echo $_GET['id'].'/photos' ?>"><?php echo $lang['PHOTOS'] ?></a></span>

				<h3><?php echo $row['name'] ?></h3>
				<div class="div-event-image-big" style="background-image:url(<?php echo '../'.$row['image'] ?>)"></div>
				<h4 id="event-type"><?php echo $lang[$row['type']] ?></h4>
				<?php 
				echo '<p id="event-privacy">'.($row['public']?$lang['PUBLIC_EVENT']:$lang['PRIVATE_EVENT']).'</p>';

				$dateParts = explode("-", $row['date']);
				$date = $dateParts[2]." ".$lang[$dateParts[1]]." ".$dateParts[0];

				echo '<p id="date">'.$date.'</p>' ?>
				<p><?php echo $row['description'] ?></p>

				<div id="delete_msg" style="display:none"><?php echo $lang['DELETE_MSG'] ?></div>
				<?php
				if (isSet($_SESSION['user_id']))
				{
					echo '<div id="event-id" style="display:none">'.$_GET['id'].'</div>';
					
					echo '<button id="unsubscribe" style="'.($subscribed?'':'display:none').'" class="subscription button">'.$lang['UNSUBSCRIBE'].'</button>';
					echo '<button id="subscribe" style="'.($subscribed?'display:none':'').'" class="subscription button">'.$lang['SUBSCRIBE'].'</button>';

					if ($owner)
						{ ?>
					<div id="del-edit-div">
						<a id="edit-button" class='button' href='<?php echo $_GET['id']."/edit"; ?>'><?php echo $lang['EDIT'] ?></a>
						<a id="delete-button" class='button'><?php echo $lang['DELETE'] ?></a>
					</div>
					<?php
				}	
				if ($row['public'])
				{
					echo '<div class="addthis_sharing_toolbox share"></div>';
				}
				include('templates/comments.php');
				}
				?>
			</div>
			<div id="sidebar" class="subscriptions box">
					<?php if ($owner) { ?>
						<h3><?php echo $lang['INVITED'] ?></h3>
						<input id="invite-email" type="text" placeholder="Email"></input>
						<button id="invite-button" class="button">+</button>
						<div id="invite-error"></div>
						<ul id="invites">
							<?php $invites = getInvites($_GET['id']);
							if($invites)
								foreach ($invites as $user) echo '<li>'.$user['user_name'].'</li>';
							?>
						</ul>
						<p id="zero-invites" <?php if ($invites) echo 'style="display:none"'?>><?php echo $lang['ZERO_INVITED'] ?></p>
					<?php } ?>

					<h3><?php echo $lang['SUBSCRIBERS'] ?></h3>
					<ul id="subs">
						<?php $subs = getEventSubscribers($_GET['id']);
						if($subs)
							foreach ($subs as $sub) echo '<li>'.$sub['user_name'].'</li>';
						?>
					</ul>
					<p id="zero-subs" <?php if ($subs) echo 'style="display:none"'?>><?php echo $lang['ZERO_SUBS']?></p>
			</div>	
			<div class="clear"></div>
		</div>
		<?php include('templates/footer.php'); ?>
	</div>
</body>
</html>