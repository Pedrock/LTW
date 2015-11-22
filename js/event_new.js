var regEmail = /^\w+[@]\w+[.]\w+/g;
var regName = /(^[A-Z]+$)/g;

$( document ).ready(function() 
{	
	$('#content [name="name"]').focusout(function(){
		var name = $('#content [name="name"]').val();

		if(regName.test(name))$('#error-eve-name').fadeOut();
		else if(name=="" || !regName.test(name)){
			$('#error-eve-name').fadeIn();
		}else $('#error-eve-name').fadeOut();
	});

	$('#content [name="desc"]').focusout(function(){
		var desc = $('#content [name="desc"]').val();
		
		if(regName.test(desc))$('#error-eve-desc').fadeOut();
		else if(desc=="" || !regName.test(desc)){
			$('#error-eve-desc').fadeIn();
		}else $('#error-eve-desc').fadeOut();
	});

	$('#content [name="date"]').focusout(function(){
		var inputDate = $('#content [name="date"]').val();
		var splitDate = inputDate.split("-");
		var date = new Date(splitDate[0],splitDate[1],splitDate[2]);
		var curr = new Date();
		if(date>=curr)
			$('#error-eve-date').fadeOut();
		else
			$('#error-eve-date').fadeIn();

	});

	$('#content [name="image"]').mouseout(function(){
		
		if(this.files[0] == undefined)
		{
			$('#error-eve-image-ext').hide();
			$('#error-eve-image-length').hide();
			$('#error-eve-image').fadeIn();
		}
		else if(this.files[0].size > 5000000)
		{
			$('#error-eve-image-ext').hide();
			$('#error-eve-image').hide();
			$('#error-eve-image-length').fadeIn();
		}
		else 
		{
			$('#error-eve-image-length').hide();
			$('#error-eve-image').hide();
			
			var extension = this.files[0].name.split('.').pop();
			if(jQuery.inArray(extension.toLowerCase(),["gif","jpg","png"]))
				$('#error-eve-image-ext').fadeIn();
		}



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
});