$( document ).ready(function() 
{	
	$("#add-photos").click(function (e) 
	{
		e.preventDefault();

		$form = $('<form><input type="file" name="files[]" multiple="multiple"></form>');
		$input = $form.find('input');
		$input.click();
		$input.change(function() {
			var formData = new FormData($form);
			$.ajax({
		        url: 'upload.php',  //Server script to process data
		        type: 'POST',
		        xhr: function() {  // Custom XMLHttpRequest
		            var myXhr = $.ajaxSettings.xhr();
		            if(myXhr.upload){ // Check if upload property exists
		                myXhr.upload.addEventListener('progress',progressHandlingFunction, false); // For handling the progress of the upload
		            }
		            return myXhr;
		        },
		        //Ajax events
		        beforeSend: beforeSendHandler,
		        success: completeHandler,
		        error: errorHandler,
		        // Form data
		        data: formData,
		        //Options to tell jQuery not to process data or worry about content-type.
		        cache: false,
		        contentType: false,
		        processData: false
	   		});
		});
    });
});

function progressHandlingFunction()
{

}

function beforeSendHandler()
{

}

function completeHandler()
{

}

function errorHandler()
{

}