$().ready(function() {
    $("#global").autocomplete("ajax-endpoints/suggest.php", {
        width: 200,		
        max: 8,		
        scroll: false,		
        selectFirst: false,
        delay: 150,
        scrollHeight: 500		
    });
		
    $("#change").autocomplete("ajax-endpoints/suggest.php", {
        width: 200,		
        max: 8,		
        scroll: false,		
        selectFirst: false,
        delay: 150,
        scrollHeight: 500		
    });			
});