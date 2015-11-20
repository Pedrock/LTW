var regEmail = /^\w+[@]\w+[.]\w+/g;
var regName = /(^[a-zA-Z]+$)/g;

$( document ).ready(function() 
{	
	var url = $(location)[0].href;
	if (url.toLowerCase().indexOf("failed") >= 0)
	{
	console.log(url);
		$('#error-reg').fadeIn();

	}

	$("#register input").change(function()
	{	
		$('#error-reg').hide();

		var fname = $('#register [name="fname"]').val();
		if(regName.test(fname) || fname=="") $('#error-reg-fname').fadeOut();
		else if(!regName.test(fname) && fname!="")$('#error-reg-fname').fadeIn();


		var lname = $('#register [name="lname"]').val();
		console.log(lname);
		if(regName.test(lname) || lname=="") $('#error-reg-lname').fadeOut();
		else if(!regName.test(lname) &&lname !="")$('#error-reg-lname').fadeIn();

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
		else if(!regEmail.test(email1) && email1!="")$('#error-reg-emailnV').fadeIn();
		else $('#error-reg-emailnV').fadeOut();
		
		var password = $('#register [name="password"]').val();
		var password2 = $('#register [name="password2"]').val();

		if (password.length<8 && password.length>0)
			$('#error-reg-pass').fadeIn();
		else $('#error-reg-pass').fadeOut();

		if( password.length>=8 &&  password!=password2 && password2!="")
			$('#error-reg-pass2').fadeIn();
		else $('#error-reg-pass2').fadeOut();

		console.log(url);
		


	});
	

});