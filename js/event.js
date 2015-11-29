function updateComments(array)
{
	if (array.length)
	{
		$('#no-comments-yet').hide();
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

function sendInvite()
{
	$email = $("#invite-email").val();
	if ($email.length)
	{
		$("#invite-email").val("");
		$button = $('#invite-button');
		$button.attr("disabled", true);
		$('#invite-error').fadeOut();
		$.ajax({                                      
			url: '../api/events.php',                        
			data: {'id' : $event_id, 'invite': $email},                       
			type: 'POST',
			dataType: 'json',                 
			success: function(result)
			{
				$button.attr("disabled", false);
				if (result['error'])
				{
					$('#invite-error').text(result['error']);
					$('#invite-error').finish();
					$('#invite-error').fadeIn();
				}
				else
				{
					$('#zero-invites').fadeOut();
					$('#invites').append($('<li style="display:none">'+result['user']+'</li>'));
					$('#invites li:last-child').fadeIn();
				}
			},
			error: function(err)     
			{
				$button.attr("disabled", false);
			}
		});
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
			success: function(subscribers)     
			{
				$button.attr("disabled", false);
				if(subscribers)
				{
					if (subscribers.length) $("#zero-subs").fadeOut();
					else $("#zero-subs").fadeIn();
					$button.hide();
					$(".subscription.button").not($button).show();
					$("#comments-box").toggle($subscribe || $is_owner);
					$('#subs').children().fadeOut(100).promise().then(function() {
						for (i in subscribers) {
							$('#subs').append(
								$('<li style="display:none">'+subscribers[i]['user_name']+'</li>'));
							$('#subs li:last-child').fadeIn();
						}
					});
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
			$button.attr("disabled", true);
			$.ajax({                                      
				url: '../api/events.php',                        
				data: {'id' : $event_id, 'last-comment': $('#last-comment-id').text(), 'comment': $comment},                       
				type: 'POST',
				dataType: 'json',                 
				success: function(array)
				{
					$button.attr("disabled", false);
					updateComments(array);
				},
				error: function(err)     
				{
					$button.attr("disabled", false);
				}
			});
		}
	});

	$("#invite-button").click(sendInvite);

	$('#invite-email').keypress(function(e) {
        if(e.which == 13) sendInvite();
    });

});