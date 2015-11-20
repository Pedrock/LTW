$( document ).ready(function() 
{	
	$event_id = $("#event-id").text();
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
				}
			},
			error: function(err)     
			{
				$button.attr("disabled", false);
			} 
		});
		
	});
});