<?php
$title = "Mount Vernon Historic Preservation Commision";
$level = '';
include 'shared/header.php';
?>
<div style="width:100px; float:left; padding: 8px">
    <img src="images/MVHPC-Logo.png"/>
</div>
<div style="width:645px; float:right;">
    <?php
    $result = mysql_query("SELECT * FROM pages WHERE id = '1'");
    echo mysql_result($result, 0, "data");
    echo "</div>";

    include 'shared/footer.php';
    ?>