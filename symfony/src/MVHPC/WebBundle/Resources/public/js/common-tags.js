$(function() {
    $('#tagArea').tagsInput({
        'autocomplete_url':'/ajax-endpoints/suggest.php',
        'autocomplete':{
            selectFirst: false,
            width:'250px',
            autoFill: false
        },
        'removeWithBackspace': false
    });
});