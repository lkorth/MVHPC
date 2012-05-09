$().ready(function() {
	$("#global").autocomplete("suggest.php", {
		width: 200,		
		max: 8,		
		scroll: false,		
		selectFirst: false,
		delay: 150,
		scrollHeight: 500,		
		});});