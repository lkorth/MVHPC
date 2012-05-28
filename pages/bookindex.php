<?php

$viewingLetter = false;
if (isset($subpage3)) {
  $letter = strtolower($subpage3);
  $viewingLetter = true;
  $upperLetter = strtoupper($letter);
}

$ct = 0;
foreach (range('A', 'Z') as $l) {
  echo '<a href="' . WEB_ROOT . 'archives/documents/Centennial-Book-Index/' . $l . '">[' . $l . ']</a>&nbsp;&nbsp;';
  $ct++;
}

if ($viewingLetter) {
  echo '<div id="index-terms"> <p>';
  $strings = returnCentennialIndex($upperLetter);
  $strings = $strings['data'];
  $strings = explode("\n", $strings);
  foreach ($strings as $string) {
    echo '<p>';
    $string = trim($string);
    $pattern = '/[0-9]{1,3}/';
    preg_match_all($pattern, $string, $matches, PREG_OFFSET_CAPTURE);
    
    $linking = array();
    $i = 0;
    
    foreach ($matches[0] as $pg) {
      $length = strlen($pg[0]);		

      // page number
      $linking[$i][0] = $pg[0];

      // position of the number in the line
      $linking[$i][1] = $pg[1];

      // length of the number
      $linking[$i][2] = $length;
      $i++;
    }
    
    $offset = 0;
    for ($j = $i - 1; $j >= 0; $j--) {
      $next = $linking[$j][1] + $linking[$j][2];
      $nextOne = $linking[$j][1] + $linking[$j][2] + 1;
      $str = substr($string, $next, 2);
      $strOne = substr($string, $nextOne, 2);

// THIS SECTION OF CODE IS BROKEN?
      if (isset($linking[$j+1]) && $next == $linking[$j+1][1]) {
        $j++;
      }
      else if ($linking[$j][0] > 294) {}
//      if ($linking[$j][0] > 294) {}
      else if ($str == 'st' ||
               $str == 'nd' ||
               $str == 'rd' ||
               $str == 'th' ||
               $strOne == 'st' ||
               $strOne == 'nd' ||
               $strOne == 'rd' ||
               $strOne == 'th') {}
      else if ($linking[$j][1] < 5) {}
      else if (substr($string, ($linking[$j][1] - 1), 1) == '(') {}
      else {
        $start = $linking[$j][1] + $offset;
	$replace = '<a href="' . WEB_ROOT;
        $replace .= 'archives/documents/Centennial-Book/';
        $replace .= $linking[$j][0] . '">' . $linking[$j][0] . '</a>';
        $string = substr_replace($string, $replace, $start, $linking[$j][2]);
        $offset += 29 + $linking[$j][2];
      }
    }

    echo $string . '</p>';
  }

  echo '</div>';
}

//require '../shared/footer.php';
?>
