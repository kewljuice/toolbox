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

print  "<table border=1>";
$teller = 0;

while ($row = fgetcsv($csv, 0, ';')) {

  // open table row
  echo "<tr>";

  // first row th
  if ($teller == 0) {

    // loop rows
    $lines = "";
    foreach ($row as &$value) {
      print "<th><strong>$value</strong></th>";
      $lines .= $value . ';';
    }

    // Append source
    $source = "Source";
    print "<th><strong>$source</strong></th>";
    $lines .= $source . ';';

    // export 2 file
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

    // loop rows
    $lines = "";
    foreach ($row as $key => &$value) {
      switch ($key) {

        case 0:
          // uppercase first char.
          $line = $text->uppercasefirst($value);
          break;
        case 1:
          // uppercase first char.
          $line = $text->uppercasefirst($value);
          break;
        case 2:
          // lowercase.
          $line = $text->lowercase($value);
          break;
        case 3:
          // add http.
          $line = $http->clean_url($value);
          break;
        case 5:
          // uppercase first char.
          $line = $text->uppercasefirst($value);
          break;
        case 7:
          // clean telephone.
          $line = $province->fetch($value);
          break;
        case 8:
          // clean telephone.
          $line = $phone->clean_be($value);
          break;
        case 9:
          // clean telephone.
          $line = $phone->clean_be($value);
          break;
        case 10:
          // convert ja/nee.
          $line = $boolean->convert($value);
          break;
        case 11:
          // mapping (lowercase).
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
      // screen output.
      print "<td>$line</td>";
      // file output.
      $lines .= $line . ';';
    }

    // Append source
    $source = "Source Identifier here";
    print "<td>$source</td>";
    $lines .= $source . ';';

    // export 2 file
    fwrite($new, $lines . PHP_EOL);
  }

  // close table row
  print "</tr>";

  // next
  $teller++;
}

/* close table */
print "<table>";

