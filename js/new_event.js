$( document ).ready(function() 
{	
	$('#content [name="name"]').change(function(){
		var name = $(this).val();
		
		if(name == "") $('#error-event-name').fadeIn().css("display","inline");
		else $('#error-event-name').fadeOut();
	});

	$('#content [name="desc"]').change(function(){
		var desc = $(this).val();
		
		if(desc == "")$('#error-event-desc').fadeIn().css("display","inline");
		else $('#error-event-desc').fadeOut();
	});

	$('#content [name="date"]').change(function(){
		var splitDate = $(this).val().split("-");
		if(splitDate.length == 3)
			$('#error-event-date').fadeOut();
		else
			$('#error-event-date').fadeIn().css("display","inline");
	});

	$('#content [name="image"]').change(function(){
		
		if(this.files[0].size > $("#max-upload-size").text())
		{
			$('#error-event-image-ext').hide();
			$('#error-event-image').hide();
			$('#error-event-image-size').fadeIn().css("display","inline");
		}
		else 
		{
			$('#error-event-image-ext').hide();
			$('#error-event-image-size').hide();
			$('#error-event-image').hide();
		}
	});
});