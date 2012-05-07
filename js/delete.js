function deletefunction(id)
{
if (confirm ('Are you sure you want to delete this picture?  This action cannot be undone.'))
{
var redir = 'http://www.mvhpc.org/delete.php?id=' + id
window.location = redir
}
}