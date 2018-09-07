<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>CSV splitter</title>
    <style type="text/css">
        body {
            background: #f0f0f0;
            padding: 20px 50px 20px 135px;
            font-family: Tahoma, Geneva, Arial, Helvetica, sans-serif;
            font-size: 0.813em;
            line-height: 1.5em;
            color: #333;
        }
        h1 {
            font-family: Georgia, "Times New Roman", Times, serif;
            font-size: 2em;
            line-height: 1.2em;
            color: #00467F;
        }
        a {
            color: #4E90CD;
            text-decoration: underline;
        }
        a:hover {
            color: #00467F;
        }
        ul {
            margin: 0 0 0 15px;
            padding: 0;
        }
        ul li {
            margin: 0 0 3px 0;
            padding: 0;
        }
        .blok, #blok_todo {
            background: #fff;
            border: 1px solid #e0e0e0;
            padding: 25px 25px 25px 25px;
        }
        @media only screen and (max-width: 480px) {
            body {
                padding: 15px;
            }
            #blok_toc {
                position: relative;
                width: auto;
                margin: 15px 0;
                padding: 15px;
                border: 1px solid #e0e0e0;
            }
        }
    </style>
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
    $i = 0;
    $j = 0;
    $k = 0;
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
