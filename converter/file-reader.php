<?php
/**
 *  PHP
 */

ini_set('max_execution_time', 5000); //300 seconds = 5 minutes
ini_set('memory_limit', '1000M');

/*
 * LOOP
 */
$csv = fopen('input/demo.csv', 'r');

print  "<table border=1>";
$teller = 0;

while ($row = fgetcsv($csv, 0, ';')) {
  // open table row
  echo "<tr>";
  // first row th
  if ($teller == 0) {
    // loop rows
    $i = 0;
    foreach ($row as &$value) {
      print "<th><span style=\"color:red\">$i</span> <strong>$value</strong></th>";
      $i++;
    }
  }
  else {
    // loop rows
    foreach ($row as $key => &$value) {
      switch ($key) {
        default:
          print "<td>$value</td>";
      }
    }
  }
  // close table row
  print "</tr>";
  // next
  $teller++;
}
/* close table */
print "<table>";

