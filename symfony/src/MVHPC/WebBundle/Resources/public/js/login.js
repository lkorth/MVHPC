$().ready(function() {
    $('#loginForm').submit(function(){
        $('#password').val(base64encode($('#pass').val()));
        $('#pass').val('');
        return true;
    });
});