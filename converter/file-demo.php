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
/**
 *  Plugins
 */
require "Plugins/Text.php";
require "Plugins/Phone.php";
require "Plugins/Http.php";
require "Plugins/Boolean.php";
require "Plugins/Province.php";
require "Plugins/CustomFields.php";
/*
 * LOOP
 */
$csv = fopen('input/demo.csv', 'r');
$new = fopen('output/demo.csv', 'w');
// Open table.
print  "<table border=1>";
$teller = 0;
while ($row = fgetcsv($csv, 0, ';')) {
  // Open table row.
  echo "<tr>";
  // Add first row th.
  if ($teller == 0) {
    // Loop rows.
    $lines = "";
    foreach ($row as &$value) {
      print "<th><strong>$value</strong></th>";
      $lines .= $value . ';';
    }
    // Append source.
    $source = "Source";
    print "<th><strong>$source</strong></th>";
    $lines .= $source . ';';
    // Export 2 file.
    fwrite($new, $lines . PHP_EOL);
  }
  else {
    // Plugins.
    $text = new Plugins\Text();
    $phone = new Plugins\Phone();
    $http = new Plugins\Http();
    $boolean = new Plugins\Boolean();
    $custom = new Plugins\CustomFields();
    $province = new Plugins\Province();
    // Loop rows.
    $lines = "";
    foreach ($row as $key => &$value) {
      switch ($key) {
        case 0:
          // Uppercase first char.
          $line = $text->uppercasefirst($value);
          break;
        case 1:
          // Uppercase first char.
          $line = $text->uppercasefirst($value);
          break;
        case 2:
          // Lowercase.
          $line = $text->lowercase($value);
          break;
        case 3:
          // Add http to url.
          $line = $http->clean_url($value);
          break;
        case 5:
          // Uppercase first char.
          $line = $text->uppercasefirst($value);
          break;
        case 7:
          // Fetch province by postal code.
          $line = $province->fetch($value);
          break;
        case 8:
          // Clean telephone.
          $line = $phone->clean_be($value);
          break;
        case 9:
          // Clean telephone.
          $line = $phone->clean_be($value);
          break;
        case 10:
          // Convert ja/nee.
          $line = $boolean->convert($value);
          break;
        case 11:
          // Mapping (lowercase).
          $mapping = [
            'optie1' => '1',
            'optie2' => '2',
            'optie3' => '3',
            'optie4' => '4',
          ];
          $line = $custom->convert($value, $mapping);
          break;
        default:
          $line = $value;
      }
      // Screen output.
      print "<td>$line</td>";
      // Output.
      $lines .= $line . ';';
    }
    // Append source.
    $source = "Source Identifier here";
    print "<td>$source</td>";
    $lines .= $source . ';';
    // Export 2 file.
    fwrite($new, $lines . PHP_EOL);
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
