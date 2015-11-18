<?php
	$langs = array("pt"=>"Português","en"=>"English");
?>
	
<div id="footer">
	<?php
		foreach($langs as $lang => $name) {
			echo '<form action=""><input name="lang" type="hidden" value="'.$lang.'"><input id="language" type="submit" value="'.$name.'"></form>';
		}
	?>
</div>