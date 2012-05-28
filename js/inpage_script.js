$().ready(function() {
    $("#global").autocomplete("/mvhpc/ajax-endpoints/suggest.php", {
        width: 200,
        max: 8,
        scroll: false,
        selectFirst: false,
        delay: 150,
        scrollHeight: 500
    });

    $("#change").autocomplete("/mvhpc/ajax-endpoints/suggest.php", {
        width: 200,
        max: 8,
        scroll: false,
        selectFirst: false,
        delay: 150,
        scrollHeight: 500
    });

    $("#search").click(function(){
       window.location = '/mvhpc/archives/images/' + $("#global").val();
    });
});