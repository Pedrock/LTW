$( document ).ready(function() 
{	
	$("#register input").change(function()
	{
		var email1 = $('#register [name="email"]').val();
		
		$.ajax({                                      
	    	url: 'api/users.php',                        
	      	data: {exists : email1},                       
	      	type: 'GET',
	      	dataType: 'json',                 
	      	success: function(data)     
	      	{
				if(data)
				{
					$('#error-reg-email').fadeIn();
				}
				else $('#error-reg-email').fadeOut();	

	      	} 
	    });

		var password = $('#register [name="password"]').val();
		var password2 = $('#register [name="password2"]').val();

		if (password.length<8 && password.length>0)
			$('#error-reg-pass').fadeIn();
		else $('#error-reg-pass').fadeOut();

		if( password.length>=8 &&  password!=password2 && password2!="")
			$('#error-reg-pass2').fadeIn();
		else $('#error-reg-pass2').fadeOut();
	});
	

});