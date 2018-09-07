<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CSV converter</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
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
// Open table.
print  "<table border=1>";
$teller = 0;
while ($row = fgetcsv($csv, 0, ';')) {
  // Open table row.
  echo "<tr>";
  // Add first row th.
  if ($teller == 0) {
    // Loop rows.
    $i = 0;
    foreach ($row as &$value) {
      print "<th><span class=\"red\">$i</span> <strong>$value</strong></th>";
      $i++;
    }
  }
  else {
    // Loop rows.
    foreach ($row as $key => &$value) {
      switch ($key) {
        default:
          print "<td>$value</td>";
      }
    }
  }
  // Close table row.
  print "</tr>";
  // Next.
  $teller++;
}
// Close table.
print "<table>";
?>
</body>
</html>
