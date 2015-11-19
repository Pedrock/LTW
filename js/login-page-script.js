/*var email,email2;
$( document ).ready(function() {
	var select = $("#register input");
	select.change(function()
	{
		//console.log($(this)[0].value);
		
		if($(this)[0].name == 'email' && $(this)[0].value !="")
			email = $(this)[0].value;

		if($(this)[0].name == 'email2' && $(this)[0].value !="")
			email2 = $(this)[0].value;
		console.log(email+' '+email2);
		if(email2!=email && email!=undefined && email2!=undefined)
		{
			console.log("OI")
		}
	});
}); */

$( document ).ready(function() 
{	
	$("#register input").change(function()
	{
		var email1 = $('#register [name="email"]').val();
		console.log(email1);
		
		/*
		$.ajax({                                      
	      url: 'api/users.php',                        
	      data: {'exists' : email1},                       
	      type: 'GET',
	      dataType: 'json',                 
	      success: function(data)     
	      {
	        console.log(data);
	      } 
	    });*/



		var password = $('#register [name="password"]').val();
		var password2 = $('#register [name="password2"]').val();

		if ((password.length<8 || password2.length<8) && password!="" && password2!="")
		{
			$('.error-reg-pass').text("Password têm de ter tamanho mínimo de 8");
			$('.error-reg-pass').show();

			//setTimeout(function() { $('.error-reg-pass').hide(); }, 3000);
		}
		else if(password!=password2 && password!="" && password2!="")
		{
			$('.error-reg-pass').text("Passwords não são iguais.");
			$('.error-reg-pass').show();

			//setTimeout(function() { $('.error-reg-pass').hide(); }, 3000);
		}
		else
			$('.error-reg-pass').hide();
	});
	

});