$().ready(function() {
	$("#global").autocomplete("shared/suggest.php", {
		width: 200,		
		max: 8,		
		scroll: false,		
		selectFirst: false,
		delay: 150,
		scrollHeight: 500,		
		});
		
	$("#change").autocomplete("shared/suggest.php", {
		width: 200,		
		max: 8,		
		scroll: false,		
		selectFirst: false,
		delay: 150,
		scrollHeight: 500,		
		});	
		
		
		});