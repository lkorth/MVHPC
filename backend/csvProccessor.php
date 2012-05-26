<?php

require_once '../includes/master.inc.php';

$db = Database::getDatabase();

$log = file('cem.csv');

foreach ($log as $line) {
    $line = trim($line);

    $fields = str_getcsv($line);

    $query = "insert into cemetery_records set name = '" . $fields[0] . "', location = '" . $fields[1] . "', plot = '" . $fields[2] . "', extra = '" . $fields[3] . ' ' . $fields[4] . ' ' . $fields[5] . "'";
    $db->query($query);

}
?>
