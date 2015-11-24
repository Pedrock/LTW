	<div class="box" >
		<div name="comments" >
			<label style= "display:block"><?php echo $lang['COMMENTS']?></label>
			<ul>
				<li>
					<?php echo "Nome"?>
					<?php echo "comm"?>
				</li>
				<li>
					<?php echo "Nome"?>
					<?php echo "comm"?>
				</li>
			</ul>
			
		</div>
			<form action="comment" method="post" id = "commentEvent">
			<!--input type="hidden" value="<?php echo $_SESSION['user_id']; ?>" name="user_id"-->
			<label><?php echo $lang['COMMENT']?>:
				<textarea style= "display:block;resize:none" name ="comment" rows='4' cols='50'></textarea>				
			</label>
			<button style= "display:block;margin:1px" class="button" type="submit" value="Send">TTT</button>
	</form>
	</div>