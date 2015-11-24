<div id="comments-box" class="box" <?php if (!$subscribed && !$owner) echo 'style="display:none"' ?> >
	<div>
		<h2><?php echo $lang['LEAVE_A_COMMENT']?></h2>
		<textarea id="comment-area" name="comment" rows='4'></textarea>				
		<button id="comment-button" class="button"><?php echo $lang['MAKE_COMMENT']?></button>
	</form>
	<div>
		<h3><?php echo $lang['COMMENTS']?></h3>
		<ul id="comments-list">
			<?php 
			$comments = getEventComments($_GET['id']);
			if (empty($comments)) {
				echo '<div id="last-comment-id" style="display:none">0</div>';
				echo '<p id="no-comments-yet">'.$lang['NO_COMMENTS_YET'].'</p>';
			}
			else
			{ 
				echo '<div id="last-comment-id" style="display:none">'.$comments[0]['id'].'</div>';
				foreach ($comments as $row)
				{
					echo '<li class="comment">';
					echo '<div class="author">'.$row['user_name'].'</div>';
					echo '<div class="comment-text">'.$row['text'].'</div></li>';
				}
			}
			?>
		</ul>
	</div>
</div>