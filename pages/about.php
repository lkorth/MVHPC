<?php 
include('../includes/master.inc.php');
include('../includes/class.template.php');

$template = new Template();

$headerExtras['js'] = array('jquery-172.js', 'image-script.js');
ob_start(); 
?>

<h1 class='ribbon'>Members</h1>
<ul class='fill_list body_text'>
    <li>Kay Johansen, Chair</li>
    <li>Richard H. Thomas, Vice Chair</li>
    <li>Edward Sauter</li>
    <li>Guy Booth</li>
    <li>Hugh Lifson</li>
    <li>Leah Rogers</li>
    <li>Pat Westercamp</li>
    <li>Carine Klein</li>
    <li>Paul Robinson </li>
    <li>Pat Westercamp</li>
    <li>Susan Hargus </li>
    <li>Imran Farooqi</li>
    <li>Lawson (Skip) Clark</li>
</ul>

<h1 class='ribbon'>Current Projects</h1>
<ul class='fill_list body_text'>
    <li>Walking Tours</li>
    <li>Educational Workshop – Preservation Issues</li>
    <li>Survey of older barns and early garages</li>
    <li>Preservation of Local Mural</li>
    <li>City Records Preservation</li>
    <li>City Heritage Days (history program)</li>
    <li>Cemetery Records Preservation</li>
    <li>Opportunities for Volunteers</li>
    <li>Summer student Internship</li>
</ul>

<h1 class="ribbon">Contact Us</h1>

 Mount Vernon City Hall

 213 1st St. SW.

 Mount Vernon, IA  52314

 Chair: Kay Johansen

 

 Main Street Iowa – Joe Jennison

 Visitors Center

 311 1st Street  NW

 Mt Vernon, IA  52314
 
<?php 
$left_col = ob_get_clean(); 
ob_start();
?>

<p>Duties: identify, interpret and protect the historic and archaeological resources of our community and encourage historic tourism.</p>
<p><strong>Meetings:</strong> 
    Open to the public
    First Saturday of each month at 9:15a.m.
    Visitors Center
</p>

<?php 
    
    $right_col = ob_get_clean();
    $template->setStyle('twoColumn');
    $template->setTitle('MVHPC: About Us');
    $template->setHeaderExtras($headerExtras);
    $template->setLeftCol($left_col);
    $template->setRightCol($right_col);

    $template->output();
?>
