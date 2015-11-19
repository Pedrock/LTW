$( document ).ready(function() 
{	
	$('ul.tabs').each(function(){
    var $links = $(this).find('a').filter('[href^="#"]');

    var $active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
    $active.parent().addClass('active');

    var $content = $($active[0].hash);

    $links.not($active).each(function () {
      $(this.hash).hide();
    });

    $links.on('click', function(event){
      event.preventDefault();
      if ($active[0].hash !== this.hash)
      {
        $active.parent().removeClass('active');
        $content.hide();

        $active = $(this);
        $content = $(this.hash);

        $active.parent().addClass('active');
        $content.fadeIn();
      }

     
    });
  });
});