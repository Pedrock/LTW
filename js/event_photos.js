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
			$('#delete-mode-input').prop('checked',false);
			updateDeleteButtons();
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

	addPhotoClickHandler();

  	$("#delete-mode-input").change(function (e) 
	{
		updateDeleteButtons();
	});

});

var deleteActive = false;

function updateDeleteButtons(){
	if ($('#delete-mode-input').prop('checked'))
	{
		if (!deleteActive)
		{
			deleteActive = true;
			$('.photo').each(function() {
			if ($(this).attr('data-delete-permission') == "1")
			{
				$button = $('<div class="button delete-photo-button"></div>');
				$button.hide();
				$(this).append($button);
				$button.animate({ width:"show", height:"show", padding:"show"});
			}
			});
			$(".delete-photo-button").click(function (e) 
			{
				$button = $(this);
				$button.attr("disabled", false);
				$.ajax({                                      
					url: 'api/photos.php',                        
					data: {'id' : $('#event-id').text(), 'delete': $button.parent().attr('data-id')},                       
					type: 'POST',
					dataType: 'json',                 
					success: function(result)
					{
						$button.parent().fadeOut(null, function() {$(this).remove();});
					},
					error: function(err)     
					{
						$button.attr("disabled", false);
					}
				});
		    });
		}
	}
	else
	{
		deleteActive = false;
		$('.delete-photo-button').animate({ width:"hide", height:"hide", padding:"hide"},null,"swing",
					function() { $(this).remove()});
	}
}

function progressHandlingFunction(e)
{
	if(e.lengthComputable){
        $('progress').attr({value:e.loaded,max:e.total});
        $('#progress').text(Math.floor(e.loaded/e.total*100)+"%");
    }
}

function beforeSendHandler()
{
	$('<table id="overlay"><tbody><tr><td id="overlay-text"><progress value="0" max="100"></progress><p id="progress"></p></td></tr></tbody></table>')
		.css({"cursor": "wait"}).appendTo("body");
}

function completeHandler(photos)
{
	$('#progress').text("100%");
	if (photos && photos.length)
	{
		$root = $('#webroot').attr('href');
		$('.photos-list').empty();
		for (var i in photos)
		{
			$photo = $('.dummy-photo').clone()
				.attr('class','photo').attr('data-delete-permission',photos[i]['delete_permission']).attr('data-id',photos[i]['id']);
			$photo.find('div').attr('style','background-image:url('+$root+photos[i]['image']+')');
			$('.photos-list').append($photo);
			$photo.delay(500).fadeIn(1000);
		}
	}
	$("#overlay").delay(500).fadeOut(1000, function() { $(this).remove(); });
	addPhotoClickHandler();
}

function errorHandler()
{
	 $("#overlay-text").html("<h1>Ocorreu um erro</h1>");
	 $("#overlay").delay(3000).fadeOut(1000, function() { $(this).remove(); });
}

function addPhotoClickHandler()
{
	$(".photo-link").click(function (e) 
	{
		e.preventDefault();
		var style = $(this).attr('style');
		$('<table id="overlay"><tbody><tr><td id="overlay-text" class="fullscreen-image" style="'+style+'"></td></tr></tbody></table>')
			.css({'padding': '20px'})
			.appendTo("body");
		$("#overlay").click(function() {
			$("#overlay").remove();
		});
    });
}