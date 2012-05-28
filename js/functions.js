function updatefunction(id)
{
    if (confirm ('Are you sure you want to update this picture? Changes cannot be undone.'))
    {
        var info = 'info' + id;
        var tags = 'tags' + id;
        var i = document.getElementsByName(info);
        var t = document.getElementsByName(tags);
        var link = 'http://www.mvhpc.org/finalize_tag.php?id=' + id + '&tags=' + t[0].value + '&info=' + i[0].value;
        window.location = link;
    }
}

function deletefunction(id)
{
    if (confirm ('Are you sure you want to delete this picture?  This action cannot be undone.'))
    {
        var redir = 'http://www.mvhpc.org/delete.php?id=' + id
        window.location = redir
    }
}

function editfunction(id)
{
    var value = '';
    $.ajax({    //create an ajax request to check_use.php
        type: "GET",
        url: "/mvhpc/ajax-endpoints/check_use.php",
        data: 'id='+id,  //with the id as a parameter
        dataType: 'text',
        success: function(msg){
            if(parseInt(msg)==1){  //if no errors make text areas editable
                alert('You may now begin editing this item. You have 1 hour to edit it before your changes are discarded');
                var info = 'info' + id;
                var tags = 'tags' + id;
                $('#' + info).attr('readonly', false);
                $('#' + tags).attr('readonly', false);
                $('#button' + id).css('visibility', 'visible');
                $('#update' + id).css('visibility', 'visible');
                $('#' + tags + '_tagsinput').remove();
                $('#' + tags).tagsInput({
                    'autocomplete_url':'/mvhpc/ajax-endpoints/suggest.php',
                    'autocomplete':{
                        selectFirst: false,
                        width:'250px',
                        autoFill: false
                    },
                    'removeWithBackspace': false
                });
            }
            else if(parseInt(msg)==0){
                alert('Someone else is editing this item at this time.  Please come back later.  This item will be available in 1 hour or less.');
            }
        }
    });
}