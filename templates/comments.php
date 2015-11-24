<div class="box" style="width:75%">
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
		<label><?php echo $lang['COMMENT']?></label>
		<textarea style= "display:block;resize:none" name="comment" rows='4' cols='50'></textarea>				
		<button style= "display:block;margin:1px" class="button" type="submit" value="Send">TTT</button>
	</form>
</div>