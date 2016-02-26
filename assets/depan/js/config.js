$(function()
{
	$('.scroll-pane').jScrollPane();
});


$(document).ready(function() {
	$('#headline_urp').before('<div id="nav">').cycle({
		fx: 'fade',
		prev:'#prev', 
		next: '#next',
		timeout:  4000,
		pause:   1,
		pager:  '#nav' 
	});
});


$(document).ready(function() {
	$('#galleryphoto').before('<div id="nav_gal">').cycle({
		fx: 'fade',
		prev:'#prev_gal', 
		next: '#next_gal',
		timeout:  1000,
		pause:   1,
		pager:  '#nav_gal' 
	});
	
	$("a#play").hide();	
	
	$("a#pause").click(function(){
		 $("a#pause").hide();
		 $("a#play").show();
	});
	
	$("a#play").click(function(){
		 $("a#play").hide();
		 $("a#pause").show();
	});
	
	$('a#pause').click(function() { 
		$('#galleryphoto').cycle('pause'); 
	});

	$('a#play').click(function() { 
		$('#galleryphoto').cycle('resume'); 
	});																		
});