function editfunction(id)
{
var value = '';
 $.ajax({    //create an ajax request to check_use.php
        type: "GET",
        url: "check_use.php",
        data: 'id='+id,  //with the id as a parameter
        dataType: value,
        success: function(msg){
            if(parseInt(msg)==1){  //if no errors make text areas editable 
               alert('You may now begin editing this item. You have 1 hour to edit it before your changes are discarded');
               var info = 'info' + id;
	       var tags = 'tags' + id; 
	       document.form[info].readOnly = false;
               document.form[tags].readOnly = false;
               }
               else if(parseInt(msg)==0){
               alert('Someone else is editing this item at this time.  Please come back later.  This item will be available in 1 hour or less.'); 
               }
        }
    });
}