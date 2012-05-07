<?php
//Database credentials
include 'db.php';

$title="MVHPC :: Centennial Book";

if(isset($_GET['page'])){
	$page = $_GET['page'];
	$pgNum = $page;
	if($page < 100 && $page > 9){
		$page = '0' . $page;
	}
	else if($page < 10){
		$page = '00' . $page;
	}
}
else {
	$page = '001';
	$pgNum = 1;
}
$path = 'book/pages/' . $page . '.jpg';

include 'header.php';
?>
<script>
	var curPage = <?php echo $pgNum ?>;
	function next(){
		curPage = curPage + 1;
		if(curPage < 1){
			alert('Already at the begining of the book');
			curPage = 1;
		}
		else if(curPage > 293){
			alert('Already at the end of the book');
			curPage = 293;
		}
		else {
			var url = 'http://www.mvhpc.org/book/pages/';
			if(curPage < 100 && curPage > 9){
				url = url + '0' + curPage + '.jpg';
			}
			else if(curPage < 10){
				url = url + '00' + curPage + '.jpg';
			}
			else {
				url = url + curPage + '.jpg';
			}
			document.getElementById('dl').href = url;
			document.getElementById('innerPage').src = url;
			document.getElementById("pageSelect").value = curPage;
		}
	}
	function prev(){
		curPage = curPage - 1;
		if(curPage < 1){
			alert('Already at the begining of the book');
			curPage = 1;
		}
		else if(curPage > 293){
			alert('Already at the end of the book');
			curPage = 293;
		}
		else {
			var url = 'http://www.mvhpc.org/book/pages/';
			if(curPage < 100 && curPage > 9){
				url = url + '0' + curPage + '.jpg';
			}
			else if(curPage < 10){
				url = url + '00' + curPage + '.jpg';
			}
			else {
				url = url + curPage + '.jpg';
			}
			document.getElementById('dl').href = url;
			document.getElementById('innerPage').src = url;
			document.getElementById("pageSelect").value = curPage;
		}
	}
	function changePage(){
		curPage = parseInt(document.getElementById("pageSelect").value);
		if(curPage < 1){
			alert('Already at the begining of the book');
			curPage = 1;
		}
		else if(curPage > 293){
			alert('Already at the end of the book');
			curPage = 293;
		}
		else {
			var url = 'http://www.mvhpc.org/book/pages/';
			if(curPage < 100 && curPage > 9){
				url = url + '0' + curPage + '.jpg';
			}
			else if(curPage < 10){
				url = url + '00' + curPage + '.jpg';
			}
			else {
				url = url + curPage + '.jpg';
			}
			document.getElementById('dl').href = url;
			document.getElementById('innerPage').src = url;
			document.getElementById("pageSelect").value = curPage;
		}
	}
</script>
<?php
echo "<br>";
//echo "<a href=\"$path\" id=\"outerPage\" class=\"MagicZoom\" rel=\"click-to-initialize:true;zoom-position:inner;zoom-fade:true;\">"
echo "<div id=\"loadPage\" class=\"loadingPage\"><img src=\"$path\" id=\"innerPage\" width=\"762px\" height=\"930px\"/></div>";
//echo "</a>";
//echo "<p>Click the picture to turn on zooming</p>";
echo "<br />";
echo '<a href="#prev" onClick="prev()"><=Previous Page==</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
echo '<select id="pageSelect" onChange="changePage()">';
for($p = 1; $p < 294; $p++){
	echo "<option value=\"$p\">$p</option>\n";
}
echo '</select>';
echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#next" onClick="next()">==Next Page=></a>';
echo "<br><br>";
echo '<a href="bookindex.php">Back to Index</a><br><br>';
echo "<a id=\"dl\" href=\"$path\">Click here to download this page</a><br>";
?>
<script>document.getElementById("pageSelect").value = curPage;</script>
<?php
include 'footer.php';
?>