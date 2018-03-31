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

	//enable fill buttons in raw data view_alerts
	$('#fill_end_now').click(function(e){
		e.preventDefault();
		//fill end with now
		$('input[name=raw_fetch_end_time]').val( moment().format().slice(0,19) );

	});
	$('#fill_start_now').click(function(e){
		e.preventDefault();
		//fill start with now
		$('input[name=raw_fetch_start_time]').val( moment().format().slice(0,19) );

	});

	$('#fill_end_hour_ago').click(function(e){
		e.preventDefault();
		//fill end with hour ago
		$('input[name=raw_fetch_end_time]').val( moment().subtract(1, 'hours').format().slice(0,19) );

	});
	$('#fill_start_hour_ago').click(function(e){
		e.preventDefault();
		//fill start with hour ago
		$('input[name=raw_fetch_start_time]').val( moment().subtract(1, 'hours').format().slice(0,19) );

	});

	$('#fill_end_day_ago').click(function(e){
		e.preventDefault();
		//fill end with day ago
		$('input[name=raw_fetch_end_time]').val( moment().subtract(1, 'days').format().slice(0,19) );

	});
	$('#fill_start_day_ago').click(function(e){
		e.preventDefault();
		//fill start with day ago
		$('input[name=raw_fetch_start_time]').val( moment().subtract(1, 'days').format().slice(0,19) );

	});
});
