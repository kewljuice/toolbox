<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CSV converter</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<h1>CSV converter</h1>
<h2>Select script</h2>
<div class="blok">
    <ul>
      <?php
      $dir = scandir('.');
      foreach ($dir as $value) {
        if (!in_array($value, ['.', '..', '.DS_Store'])) {
          if (!is_dir('.' . DIRECTORY_SEPARATOR . $value)) {
            print "<li><a href='$value'>$value</a></li>";
          }
        }
      }
      ?>
    </ul>
</div>
</body>
</html>
