$(document).ready(function() 
{	
	$("#add-photos").click(function (e) 
	{
		e.preventDefault();

		$form = $('<form enctype="multipart/form-data" action="api/photos.php" method="post">'
			+'<input type="file" name="images[]" multiple="multiple"/>'
			+'<input type="hidden" name="id" value="'+$('#event-id').text()+'" />'
			+'</form>');
		$input = $form.find('input');
		$input.click();
		$input.change(function() {
			var formData = new FormData($form[0]);
			$.ajax({
		        url: 'api/photos.php',  //Server script to process data
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

	$(".photo-link").click(function (e) 
	{
		e.preventDefault();
		$('html, body').css({
		    'overflow': 'hidden',
		    'height': '100%'
		});
		var style = $(this).children('.div-event-photo-image').attr('style');
		$('<table id="overlay"><tbody><tr><td id="overlay-text" class="fullscreen-image" style="'+style+'"></td></tr></tbody></table>')
			.css({'padding': '20px'})
			.appendTo("body");
		$("#overlay").click(function() {
			$("#overlay").remove();
			$('html, body').css({
			    'overflow': 'auto',
			    'height': 'auto'
			});
		});
    });


});

function progressHandlingFunction(e)
{
	if(e.lengthComputable){
        $('progress').attr({value:e.loaded,max:e.total});
        $('#progress').text(Math.floor(e.loaded/e.total*100)+"%");
    }
}

function addOverlay(content, element_class, css)
{
	var c = element_class === undefined ? "" : element_class;
	
}

function beforeSendHandler()
{
	$('<table id="overlay"><tbody><tr><td id="overlay-text"><progress value="0" max="100"></progress><p id="progress"></p></td></tr></tbody></table>')
		.css({"cursor": "wait"}).appendTo("body");
}

function completeHandler()
{
	$('#progress').text("100%");
	$("#overlay").delay(1000).fadeOut(1000, function() { $(this).remove(); });
}

function errorHandler()
{
	 $("#overlay-text").text("Ocorreu um erro");
	 $("#overlay").delay(3000).fadeOut();
}