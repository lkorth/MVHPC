<?php

require_once '../includes/master.inc.php';

$db = Database::getDatabase();

$log = file('cem.csv');

foreach ($log as $line) {
    $line = trim($line);

    $f = str_getcsv($line);

    $ext = $f[3] . ' ' . $f[4] . ' ' . $f[5];

    $query = "insert into cemetery_records set name = :f0:, location = :f1:, plot = :f2:, extra = :ext:";
    $db->query($query, array('f0' => $f[0], 'f1' => $f[1], 'f2' => $f[2], 'ext' => $ext));

}
?>
