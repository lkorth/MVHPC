var featured = $('.featured');
var total = featured.length;
var count = 1;

//var tags = [{tag: "computers", count: 56}, {tag: "mobile" , count: 12}, 
//    {tag: "fire" , count: 23}, {tag: "buildings" , count: 2}, {tag: "Mt Vernon" , count: 32}, 
//    {tag: "Scorz" , count: 2}, {tag: "Cornell College" , count: 10}, 
//    {tag: "Brick District" , count: 14}];

$().ready(function(){
    
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