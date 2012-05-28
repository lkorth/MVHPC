$(function() {
    $('[rel=lightbox]').lightBox();

    $('.tagArea').tagsInput({
        'autocomplete_url':'/mvhpc/ajax-endpoints/suggest.php',
        'autocomplete':{
            selectFirst: false,
            width:'250px',
            autoFill: false
        },
        'removeWithBackspace': false
    });

    $("textarea").spellchecker({
        url: "/mvhpc/ajax-endpoints/checkspelling.php",
        lang: "en",                     // default language
        engine: "google",               // pspell or google
        addToDictionary: false,         // display option to add word to dictionary (pspell only)
        wordlist: {
            action: "after",               // which jquery dom insert action
            element: $("#text-content")    // which object to apply above method
        },
        suggestBoxPosition: "below",    // position of suggest box; above or below the highlighted word
        innerDocument: false            // if you want the badwords highlighted in the html then set to true
    });


});

function rotate(id, angle){
    $('#thumb' + id).html('<img src="/mvhpc/images/pdf-js/loading-icon.gif" />');

    $.ajax({
        type: "GET",
        url: "/mvhpc/ajax-endpoints/rotateImage.php",
        data: 'id='+id+'&angle='+angle,
        dataType: 'text',
        success: function(msg){
            var tmp = msg.split("|");
            if(parseInt(tmp[0])==0){
                alert('There was an error rotating the image, please try again later.');
            }
            $('#thumb' + id).html('<img src="/mvhpc/' + tmp[1] + '?' + new Date().getTime() + '" />');
            var link = $('#thumb' + id).attr('href');
            $('#thumb' + id).attr('href', link + '?' + new Date().getTime());
        }
    });
}