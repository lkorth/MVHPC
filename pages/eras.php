<?php

// set up template title & style
$template->setTitle('MVHPC :: Eras');
$template->setStyle('oneColumn');

// display the page with intro and Google Map
ob_start();
  ?>

<h1 class="ribbon"> Military Road Era </h1>
<p class="body_text">
  Lyman Dillin in 1840 plowed a furrow from Dubuque to Iowa City, marking a trail for military use. Now called Highway 1, this military road became the avenue of commerce. By 1847, a commercial area running along the ridgeline of the hill (First Street) saw general stores and a blacksmith shop open. Blocks were laid out north and south on either side of the military road.
</p>
<p class="body_text">
  Within a few years, construction began to change, from logs to wood frame and brick buildings. Many existing buildings were influenced by this era.
</p>

<h1 class="ribbon"> Railroad Era </h1>
<p class="body_text">
  When the railroad pushed through to the north edge of town in 1859, every aspect of life soon changed. It proved beneficial to the college because more students could reach the school from greater distances. Merchants could order new merchandise. Easy rail access stimulated town residential development.
</p>
<p class="body_text">
  A boom of varied construction was touched off. Contractors utilized new building materials and &quot;plan book&quot; designs. The 1890's were notable for new housing, with as many as 30 homes built in a year. In fact, new construction reflected a steady increase in Mount Vernon's population through 1905.
</p>

<h1 class="ribbon"> Cornell College Era </h1>
<p class="body_text">
  Merchant and hotelier Allison Willits first conceived the idea of a private school to improve local commerce. With the aid of Methodist minister George B. Bowman, he obtained 20 acres of land atop the hill for the campus. In 1853, the Iowa Conference Seminary opened for classes with 161 students.
</p>
<p class="body_text">
  The name was later changed to Cornell College, in the hopes of attracting New York businessman William W. Cornell as benefactor. By 1857, the school had built two brick buildings: Old Sem and Old Main (College Hall). Enrollment was nearly 300.
</p>
<p class="body_text">
  The college prospered. Extensive use of locally produced brick and limestone can be seen both on and off campus. It is interesting to note the use of native limestone in the town's most prominent ecclesiastical buildings - the landmark King Chapel (1876), First Presbyterian Church (1895), and First Methodist Church (1899), which remain largely unchanged today.
</p>
<p class="body_text">
  On campus, Old Sem and College Hall are used daily. Other structures to note include the Eastlake Victorian Bowman Hall (1855), and the Beaux Arts style of Norton Geology Center (1904) as well as McWethy Hall (formerly Alumni Gymnasium - 1909).
</p>

<h1 class="ribbon"> Lincoln Highway Era </h1>
<p class="body_text">
  The roadway again became a major means of transportation in the early 20th century with the establishment of the first transcontinental route: Highway 30, the Lincoln Highway. With automobiles growing popularity, tourist camps, small hotels, billboards, garages, and filling stations were built along the Lincoln Highway, both in and around Mount Vernon.
</p>
<p class="body_text">
  An electric interurban railway from Cedar Rapids to Lisbon (completed 1914; abandoned 1928) provided timely, inexpensive transportation to both Cedar Rapids and the Palisades resort area four miles west. Now only the rails buried under First Street and the remnants of the elevated right-of-way east of the Middle School bear witness to its existence.
</p>
<p class="body_text">
  The existing Highway 30 route was completed in the 1950's, putting an end to downtown Mount Vernon's contribution to coast-to-coast travel. You can still see what remains: wooden bridge at the west end over-looking the railroad tracks, an original concrete Lincoln Highway marker moved to Memorial Park, and the Floyd Mersh house (210 First Street East) which was the site of one of Mount Vernon's first motor tourist hotels. Also note placement of existing businesses in the thriving downtown shopping area: merchant shops west of Highway 1, service shops east. All these landmarks point to this last influencing factor in Mount Vernon's history.
</p>
  
  <?php
$content = ob_get_clean();

// send content to template
$template->setSingleCol($content);

?>
