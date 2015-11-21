var regEmail = /^\w+[@]\w+[.]\w+/g;
var regName = /(^[A-z]+$)/g;

$( document ).ready(function() 
{	
	var url = $(location)[0].href;
	if (url.toLowerCase().indexOf("failed") >= 0)
	{
	console.log(url);
		$('#error-reg').fadeIn();
	}

	$('#register [name="fname"]').focusout(function(){
		var fname = $('#register [name="fname"]').val();
		console.log(fname);
		if(regName.test(fname))$('#error-reg-fname').fadeOut();
		else if(fname=="" || !regName.test(fname)){
			$('#error-reg-fname').fadeIn();
		}else $('#error-reg-lname').fadeOut();
	});

	$('#register [name="lname"]').focusout(function(){
		var lname = $('#register [name="lname"]').val();
		console.log(lname);
		if(regName.test(lname))$('#error-reg-lname').fadeOut();
		else if(lname=="" || !regName.test(lname)){
			$('#error-reg-lname').fadeIn();
		}
		else $('#error-reg-lname').fadeOut();
	});

	$('#register [name="email"]').focusout(function(){
		var email1 = $('#register [name="email"]').val();
		if(regEmail.test(email1))
		{
			$('#error-reg-emailnV').fadeOut();
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
		}	
		else if(regEmail.test(email1))$('#error-reg-emailnV').fadeOut();
		else $('#error-reg-emailnV').fadeIn();
	});

	$('#register [name="password"]').focusout(function(){
		var password = $('#register [name="password"]').val();

		if (password.length<8 && password.length>0)
			$('#error-reg-pass').fadeIn();
		else $('#error-reg-pass').fadeOut();

	});

	$('#register [name="password2"]').mouseout(function(){
		
		var password = $('#register [name="password"]').val();
		var password2 = $('#register [name="password2"]').val();

		if (password == password2 )
			$('#error-reg-pass2').fadeOut();
		else $('#error-reg-pass2').fadeIn();

	});

	$("#register input").change(function()
	{	
		$('#error-reg').hide();

		
	});
	

});