<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CSV splitter</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<?php
if (isset($_REQUEST["action"]) && $_REQUEST["action"] == "split") {
  if ($_FILES["file"]["error"] > 0) {
    echo "<span style=\"color:red\">error: " . $_FILES["file"]["error"] . "</span><br>";
    //setForm()
    setForm();
  }
  else {
    // SPLIT
    $source = $_FILES["file"]["tmp_name"];
    $lines = $_REQUEST["count"];
    $i = $j = $k = 0;
    $buffer = "";
    // LOOP
    $handle = @fopen($source, "r");
    while (!feof($handle)) {
      $string = "";
      if ($j == 0 && $i == 0 && isset($_REQUEST["header"]) && $k == 0) {
        // header !!
        $row = fgetcsv($handle, 0, ";", "\"");
        $numItems = count($row);
        $numCount = 0;
        foreach ($row as $sub) {
          if (++$numCount === $numItems) {
            $string .= $sub;
          }
          else {
            $string .= $sub . ";";
          }
        }
        $header = $string . PHP_EOL;
        $k = 1;
      }
      else {
        // regular line !!
        $row = fgetcsv($handle, 0, ";", "\"");
        $numItems = count($row);
        $numCount = 0;
        foreach ($row as $sub) {
          if (++$numCount === $numItems) {
            $string .= $sub;
          }
          else {
            $string .= $sub . ";";
          }
        }
        $buffer .= $string . PHP_EOL;
        $i++;
      }
      if ($i >= $lines || feof($handle)) {
        $fname = "output/chunk_" . $j . ".csv";
        $fileHandle = @fopen($fname, 'w') or die("can't open file");
        if (isset($_REQUEST["header"])) {
          @fwrite($fileHandle, $header . $buffer);
        }
        else {
          @fwrite($fileHandle, $buffer);
        }
        fclose($fileHandle);
        echo "<a href=\"" . $fname . "\" alt=\"file\" style=\"color:green\">" . $fname . " (" . $i . ")</a><br>";
        $j++;
        $buffer = "";
        $i = 0;
      }
    }
    fclose($handle);
    setForm();
  }
}
else {
  //setForm()
  setForm();
}
function setForm() {
  // FORM
  echo "<h1>CSV splitter</h1>";
  echo "<h2>Select CSV file</h2>";
  echo "<div class=\"blok\">";
  echo "<form action=" . $_SERVER['PHP_SELF'] . " enctype=\"multipart/form-data\" method=\"post\">";
  echo "<label for=\"file\">Bestand:</label>";
  echo "<input type=\"file\" name=\"file\" id=\"file\">";
  echo "<br><label for=\"count\">Aantal:</label>";
  echo "<input type=\"text\" name=\"count\" value=\"500\">";
  echo "<br><label for=\"count\" style=\"display:inline\">Header:</label>";
  echo "<input type=\"checkbox\" name=\"header\" checked=\"checked\">";
  echo "<input type=\"hidden\" name=\"action\" value=\"split\">";
  echo "<br><br><input type=\"submit\" value=\"GO\">";
  echo "</div>";
  echo "</form>";
}

?>
<body>
</body>
</html>
