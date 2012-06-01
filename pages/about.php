<?php

// set up template title & style
$template->setTitle('MVHPC :: About Us');
$template->setCurrentPage('about');
$template->setStyle('twoColumn');

// page, (left-column)
ob_start();
?>

<h1 class='ribbon'>Members</h1>
<ul class='fill_list body_text'>
    <li><span class="fill_list_content">Kay Johansen, Chair</span><span class="bullet">&bull;</span></li>
    <li><span class="fill_list_content">Richard H. Thomas, Vice Chair</span><span class="bullet">&bull;</span></li>
    <li><span class="fill_list_content">Edward Sauter</span><span class="bullet">&bull;</span></li>
    <li><span class="fill_list_content">Guy Booth</span><span class="bullet">&bull;</span></li>
    <li><span class="fill_list_content">Hugh Lifson</span><span class="bullet">&bull;</span></li>
    <li><span class="fill_list_content">Leah Rogers</span><span class="bullet">&bull;</span></li>
    <li><span class="fill_list_content">Pat Westercamp</span><span class="bullet">&bull;</span></li>
    <li><span class="fill_list_content">Carine Klein</span><span class="bullet">&bull;</span></li>
    <li><span class="fill_list_content">Paul Robinson</span><span class="bullet">&bull;</span></li>
    <li><span class="fill_list_content">Pat Westercamp</span><span class="bullet">&bull;</span></li>
    <li><span class="fill_list_content">Susan Hargus</span><span class="bullet">&bull;</span></li>
    <li><span class="fill_list_content">Imran Farooqi</span><span class="bullet">&bull;</span></li>
    <li><span class="fill_list_content">Lawson (Skip) Clark</span></li>
</ul>

<h1 class='ribbon'>Current Projects</h1>
<ul class='fill_list body_text'>
    <li><span class="fill_list_content">Walking Tours</span><span class="bullet">&bull;</span></li>
    <li><span class="fill_list_content">Educational Workshop – Preservation Issues</span><span class="bullet">&bull;</span></li>
    <li><span class="fill_list_content">Survey of older barns and early garages</span><span class="bullet">&bull;</span></li>
    <li><span class="fill_list_content">Preservation of Local Mural</span><span class="bullet">&bull;</span></li>
    <li><span class="fill_list_content">City Records Preservation</span><span class="bullet">&bull;</span></li>
    <li><span class="fill_list_content">City Heritage Days (history program)</span><span class="bullet">&bull;</span></li>
    <li><span class="fill_list_content">Cemetery Records Preservation</span><span class="bullet">&bull;</span></li>
    <li><span class="fill_list_content">Opportunities for Volunteers</span><span class="bullet">&bull;</span></li>
    <li><span class="fill_list_content">Summer student Internship</span></li>
</ul>

<h1 class='ribbon'>Resources</h1>
<ul class='fill_list body_text'>
    <li><span><a href="http://www.cr.nps.gov/nr/index.htm">National Register of Historic Places</a></span><span class="bullet">&bull;</span></li>
    <li><span><a href="http://www.cornellcollege.edu/library/archives/">Cornell College Archives</a></span><span class="bullet">&bull;</span></li>
    <li><span><a href="http://www.iowahistory.org/">State Historical Society of Iowa</a></span><span class="bullet">&bull;</span></li>
    <li><span><a href="http://www.preservationnation.org/">Preservation Nation</a></span><span class="bullet">&bull;</span></li>
    <li><span><a href="http://www.preservationiowa.org">Preservation Iowa</a></span><span class="bullet">&bull;</span></li>
    <li><span><a href="http://www.oldhousejournal.com/">Restoring Old Houses</a></span><span class="bullet">&bull;</span></li>
    <li><span><a href="<?php WEBROOT(); ?>about/design-review/">Design Review Information</a></span></li>
</ul>

<?php
$left_col = ob_get_clean();

// page content (right column)
ob_start();
?>

<h1 class="ribbon">Duties</h1>
<p class="body_text">To identify, interpret and protect the historic and archaeological resources of our community and encourage historic tourism.
</p>
<h1 class="ribbon">Meetings</h1>
<div class="line_content body_text">
    <span>Open to the public</span>
    <span>First Saturday of each month at 9:15a.m.</span>
    <span>Visitors Center</span>
</div>

<h1 class="ribbon">Contact Us</h1>

<div class="line_content body_text">
    <span><strong>Mount Vernon City Hall</strong></span>

    <span>213 1st St. SW.</span>

    <span>Mount Vernon, IA  52314</span>

    <span>Chair: Kay Johansen</span>
</div>

<div class="line_content body_text">
    <span><strong>Main Street Iowa – Joe Jennison</strong></span>

    <span>Visitors Center</span>

    <span>311 1st Street  NW</span>

    <span>Mt Vernon, IA  52314</span>
</div>

<div class="line_content body_text">
    <span><strong><a href="/pages/contact-form.php">Email</a></strong></span>
</div>




<?php
$right_col = ob_get_clean();

// add JavaScript to header
array_push($headerJS, 'image-script.js');

// set content on template
$template->setLeftCol($left_col);
$template->setRightCol($right_col);

?>
