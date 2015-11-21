$( document ).ready(function() {
	$("#search").keyup(function() {
		console.log("key");
		var keyword = $("#search").val();
		if (keyword.length >= 1) {

			$.get( "api/events.php", { 'search': keyword } )
			.done(function( data ) {
				$('#suggestions').html('');
				var results = jQuery.parseJSON(data);
				$(results).each(function(i, result) {
					$('#suggestions').append('<div data-id="' + result['id'] + '" class="suggestion">' + result['name'] + '</div>');
				})

			    $('.suggestion').click(function() {
			    	location.href = $('#webroot').attr('href')+'events/'+$(this).attr('data-id');
			    })
			    if ($("#suggestions").children().length > 0)
			    	$("#suggestions").show();
			    else $("#suggestions").hide();
			});
		} else {
			$('#suggestions').html('');
			$("#suggestions").hide();
		}
	});

    $("#search").blur(function(){
    		$("#suggestions").fadeOut(500);
    	})
        .focus(function() {
    	    $("#suggestions").has('.suggestion').show();
    	});

});