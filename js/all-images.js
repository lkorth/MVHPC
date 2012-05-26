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