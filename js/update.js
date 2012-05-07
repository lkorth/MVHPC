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