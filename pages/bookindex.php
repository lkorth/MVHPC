<?php


//$title="MVHPC :: Centennial Book Index";

if(isset($subpage3)){
	$letter = strtolower($subpage3);
	$list = 1;
$upperLetter = strtoupper($letter);
}
else {
	$list = 0;
}


//require 'shared/header.php';
//require 'header.php';

//echo '<div align="center">';
$ct = 0;
foreach(range('A', 'Z') as $l){
//	if($l == $upperLetter){
//		$color = 'style="color: white;"';
//	}
//	else {
//		$color = '';
//	}
	if($ct == 15){
		echo '<br>';
		echo '<a href="' . WEB_ROOT . 'archives/documents/Centennial-Book-Index/' . $l . '">[' . $l . ']</a>&nbsp;&nbsp;';
	}
	else {
		echo '<a href="' . WEB_ROOT . 'archives/documents/Centennial-Book-Index/' . $l . '">[' . $l . ']</a>&nbsp;&nbsp;';
	}
	$ct++;
}
echo '</div><br><br><br>';

if($list == 1){
	echo '<div align="left" style="padding-left: 50px;"><p style="font-size: 16px;">';
	//$letter = 'book/index/' . $letter . '.txt';
	//$strings = file($letter);
$db = Database::getDatabase();
$strings = ($db->getRows("select data from centennial_book_index where letter = '$upperLetter'"));
//	$strings = mysql_fetch_assoc(mysql_query("select data from centennial_book_index where letter = '$upperLetter'"));
//  $strings = returnCentennialIndex($upperLetter);
	$strings = $strings[0]['data'];
	$strings = explode("\n", $strings);
	foreach($strings as $string){
		$string = trim($string);
		$pattern = '/[0-9]{1,3}/';
		preg_match_all($pattern, $string, $matches, PREG_OFFSET_CAPTURE);

		$linking = array();
		$i = 0;
		foreach($matches[0] as $pg){
			$length = strlen($pg[0]);
		
			$linking[$i][0] = $pg[0]; //page number
			$linking[$i][1] = $pg[1]; //position of the number in the line
			$linking[$i][2] = $length; //length of the number
			$i++;
		}
		
		$offset = 0;
		for($j = 0; $j < $i; $j++){
			$next = $linking[$j][1] + $linking[$j][2];
			$nextOne = $linking[$j][1] + $linking[$j][2] + 1;
			$str = substr($string, $next, 2);
			$strOne = substr($string, $nextOne, 2);

			if(($linking[$j][1] + $linking[$j][2]) == $linking[$j+1][1]){
				$j++;
			}
			else if($linking[$j][0] > 294){
			}
			else if($str == 'st' || $str == 'nd' || $str == 'rd' || $str == 'th' || $strOne == 'st' || $strOne == 'nd' || $strOne == 'rd' || $strOne == 'th'){
			}
			else if($linking[$j][1] < 5){
			}
			else if(substr($string, ($linking[$j][1] - 1), 1) == '('){
			}
			else {
				$start = $linking[$j][1] + $offset;
				$replace = '<a href="' . WEB_ROOT . 'archives/documents/Centennial-Book/' . '"' . $linking[$j][0] . '">' . $linking[$j][0] . "</a>";
				$string = substr_replace($string, $replace, $start, $linking[$j][2]);
				$offset += 29 + $linking[$j][2];
			}
		}
		echo $string . '<br>';
	}
	echo '</p></div>';
}

//require '../shared/footer.php';
?>
