$( document ).ready(function() 
{	
	var regEmail = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
	var regName = /^[A-zÀ-ÿ]+$/;

	$('#register [name="fname"]').change(function(){
		var fname = $(this).val();
		if (regName.test(fname)) $('#error-reg-fname').fadeOut();
		else $('#error-reg-fname').fadeIn();
	});

	$('#register [name="lname"]').change(function(){
		var lname = $(this).val();
		if (regName.test(lname)) $('#error-reg-lname').fadeOut();
		else $('#error-reg-lname').fadeIn();
	});

	$('#register [name="email"]').change(function(){
		var email = $(this).val();
		if(regEmail.test(email))
		{
			$('#error-reg-email').fadeOut();
			$('#reg-email-in-use').fadeOut();
			$.ajax({                                      
		    	url: 'api/users.php',                        
		      	data: {exists : email},                       
		      	type: 'GET',
		      	dataType: 'json',                 
		      	success: function(data)     
		      	{
					if(data) $('#reg-email-in-use').fadeIn();
					else $('#reg-email-in-use').fadeOut();	
		      	} 
		    });
		}	
		else
		{
			$('#reg-email-in-use').hide();
			$('#error-reg-email').fadeIn();
		}
	});

	$('#register [name="password"]').change(function(){
		var password = $(this).val();
		if (password.length > 0 && password.length < 8)
		{
			$('#error-reg-pass2').fadeOut();
			$('#error-reg-pass').fadeIn();
		}
		else $('#error-reg-pass').fadeOut();
	});

	$('#register [name="password2"]').change(function(){
		var password = $('#register [name="password"]').val();
		if (password.length >= 8)
		{
			if (password == $(this).val())
				$('#error-reg-pass2').fadeOut();
			else $('#error-reg-pass2').fadeIn();
		}
	});
});