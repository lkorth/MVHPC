var featured = $('.featured');
var total = featured.length;
var count = 1;

$().ready(function(){
    
    setTimeout("setHeights()", 500);
    
    $.get('/mvhpc/ajax-endpoints/tag-cloud.php', function(result){
        
        tags = $.parseJSON(result);
        $('#tagcloud').append('<ul></ul>');
        ul = $('#tagcloud').find('ul');
        $.each(tags, function(i, item){
            li = $("<li>");
            $("<a>").text(item.tag).attr({title:"See all pages tagged with " + item.tag, href:"" + item.tag + ".html"}).appendTo(li);  
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

function setHeights(){
    news_height = $('.newsfeed').height();
    left_height = $('.left_box').height();
    
    if(news_height > left_height){
        $('.left_box').css('height', news_height + "px");
    }else{
        $('.newsfeed').css('height', left_height + "px");
    }
}