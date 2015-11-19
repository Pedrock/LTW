$( document ).ready(function() 
{	
	$("#register input").change(function()
	{
		var email1 = $('#register [name="email"]').val();
		console.log(email1);
		
		
		$.ajax({                                      
	    	url: 'api/users.php',                        
	      	data: {exists : email1},                       
	      	type: 'GET',
	      	dataType: 'json',                 
	      	success: function(data)     
	      	{
				if(data)
				{
					console.log(data);
					$('#error-reg-email-used').text("Email já usado.");
					$('#error-reg-email-used').show();
				}
				else $('#error-reg-email-used').hide();	

	      	} 
	    });



		var password = $('#register [name="password"]').val();
		var password2 = $('#register [name="password2"]').val();

		if (password.length<8 && password.length>0)
		{
			$('#error-reg-pass-leng').text("Password têm de ter tamanho mínimo de 8.");
			$('#error-reg-pass-leng').show();

		}else $('#error-reg-pass-leng').hide();

		if( password.length>=8 &&  password!=password2 && password2!="")
		{
			$('#error-reg-pass-dif').text("Passwords não são iguais.");
			$('#error-reg-pass-dif').show();

		}
		else
			$('#error-reg-pass-dif').hide();
	});
	

});