$(function() {
    $('[rel=lightbox]').lightBox();

    // tweak: http://xoxco.com/projects/code/tagsinput/
    $('.tagArea').tagsInput({
        'autocomplete_url':'/mvhpc/ajax-endpoints/suggest.php',
        'autocomplete':{
            selectFirst:true,
            width:'250px',
            autoFill:true
        },
        'removeWithBackspace': false
    });

    //spell checker implementation
    //http://code.google.com/p/jquery-spellchecker/wiki/Documentation
});