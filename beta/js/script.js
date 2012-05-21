featured = $('.featured');
total = featured.length;
count = 1;

$().ready(function(){

    $('#prevImg').live('click', function(){
        fadeImg(0);
    });

    $('#nextImg').live('click', function(){
        fadeImg(1);
    });
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

    current.fadeOut(500);
    next.fadeIn(500);
    
    current.removeClass('current');
    next.addClass('current');
}