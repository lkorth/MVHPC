var featured = $('.featured');
var total = featured.length;
var count = 1;
var timeout = null;

$().ready(function(){
    $('#prevImg').live('click', function(){
        fadeImg(0);
    });

    $('#nextImg').live('click', function(){
        fadeImg(1);
    });

     timeout = setTimeout("fadeImg(1)", 5000);
});

function fadeImg(direction){
    current = $('.featured.current');

    if(direction == 0){
        next = current.prev('.featured');
        if(next.length == 0){
            next = $('.featured:last-child')
        }
    }else{
        next = current.next('.featured');
        if(next.length == 0){
            next = $('.featured:first-child');
        }
    }

    clearTimeout(timeout);
    timeout = setTimeout("fadeImg(1)", 8000);

    current.fadeOut(500);
    next.fadeIn(500);

    current.removeClass('current');
    next.addClass('current');
}
