<?php
$title = "Mount Vernon Historic Preservation Commision";
include'header.php';
?>
<div style="width:100px; float:left; padding: 8px">
    <img src="images/MVHPC-Logo.png"/>
</div>
<div style="width:645px; float:right;">
    <?php
    $query = "SELECT * FROM pages WHERE id = '1'";
    $result = mysql_query($query);
    $data = mysql_result($result, 0, "data");
    echo $data;
    echo "</div>";

    include'footer.php';
    ?>