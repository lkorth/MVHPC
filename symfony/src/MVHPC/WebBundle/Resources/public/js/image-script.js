var featured = $('.featured');
var total = featured.length;
var count = 1;
var timeout = null;

$().ready(function(){
    $('#tagcloud').append("<img id='loading' src='/images/loading-icon.gif' alt='Loading Image' />");
    $.get('/ajax-endpoints/tag-cloud.php', function(result){
        $('#tagcloud').empty();
        tags = $.parseJSON(result);
        $('#tagcloud').append('<ul></ul>');
        ul = $('#tagcloud').find('ul');
        $.each(tags, function(i, item){
            li = $("<li>");
            $("<a>").text(item.tag).attr({title:"See all pages tagged with " + item.tag, href:"archives/images/" + item.tag }).appendTo(li);
            li.children().css("fontSize", (item.count / 50 < 1) ? item.count / 50 + 15 + "px": (item.count / 50 > 2) ? "25px" : item.count / 50 + 10 + "px");
            li.appendTo(ul);
        });
    });

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
