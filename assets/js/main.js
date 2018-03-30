$(function(){
	$('#alerts').click(function(){
		$('#alerts-list').slideToggle();
	});

	$('.pure-menu-has-children').hover(function(){
		$(this).children('.pure-menu-item-children').slideDown(300);

	}, function(){
		$(this).children('.pure-menu-item-children').slideUp(300);

	});

	//confirm stream delete action
	$('.delete-stream').click(function(e){
		return confirm("Are you sure you want to delete the stream AND ITS DATA?");
	});

	//enable 'now' button in raw data view_alerts
	$('#fillnow').click(function(){
		$('["name"]=raw_fetch_end_time').val( new Date().toJASON().slice(0,19) );
	});
});
