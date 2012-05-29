$().ready(function(){
    setHeights();
});

function setHeights(){
    left_height = $('.left_col').height();
    right_height = $('.right_col').height();

    if(left_height > right_height){
        $('.right_col').css('height', left_height + "px");
    }else{
        $('.left_col').css('height', right_height + "px");
    }
}