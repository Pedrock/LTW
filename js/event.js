function updateComments(array)
{
	if (array.length)
	{
		$('#last-comment-id').text(array[0]['id']);
		for (i in array) {
			$('#comments-list').prepend(
				$('<li style="display:none" class="comment">'+
					'<div class="author">'+array[i]['user_name']+'</div>'+
					'<div class="comment-text">'+array[i]['text']+'</div></li>'));
			$('#comments-list li:first-child').fadeIn();
		}
	}
}

$(document).ready(function() 
{	
	$event_id = $("#event-id").text();
	$is_owner = $('#del-edit-div').length > 0;
	$(".subscription.button").click(function()
	{
		$button = $(this);
		$button.attr("disabled", true);
		$subscribe = ($button.attr('id') == 'subscribe');
		$.ajax({                                      
			url: '../api/events.php',                        
			data: {'id' : $event_id, 'subscribe': $subscribe},                       
			type: 'POST',
			dataType: 'json',                 
			success: function(ok)     
			{
				$button.attr("disabled", false);
				if(ok)
				{
					$button.hide();
					$(".subscription.button").not($button).show();
					$("#comments-box").toggle($subscribe || $is_owner);
				}
			},
			error: function(err)     
			{
				$button.attr("disabled", false);
			} 
		});
		
	});

	$delete_msg = $("#delete_msg").text();
	$("#delete-button").click(function()
	{	
		
		if(confirm($delete_msg))
			$('<form method="POST" action="../events"><input type="hidden" name="delete" value="'+$event_id+'"></form>').submit();	
	});

	setInterval(function(){
  		$.ajax({                                      
				url: '../api/events.php',                        
				data: {'id' : $event_id, 'last-comment': $('#last-comment-id').text()},                       
				type: 'GET',
				dataType: 'json',                 
				success: function(array)     
				{
					updateComments(array);
				},
				error: function(err)     
				{
					$button.attr("disabled", false);
				} 
			});
	}, 5000);

	$("#comment-button").click(function()
	{	
		$comment = $('#comment-area').val();
		if ($comment.length)
		{
			$('#comment-area').val("");
			$button = $(this);
			$.ajax({                                      
				url: '../api/events.php',                        
				data: {'id' : $event_id, 'last-comment': $('#last-comment-id').text(), 'comment': $comment},                       
				type: 'POST',
				dataType: 'json',                 
				success: function(array)
				{
					updateComments(array);
				},
				error: function(err)     
				{
					$button.attr("disabled", false);
				} 
			});
		}
	});
});