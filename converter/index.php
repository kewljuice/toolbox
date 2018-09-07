<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo "localhost: $ip"; ?></title>
  <meta name="description" content="Apache Web Root">
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
    h2 {
      font-family: Georgia, "Times New Roman", Times, serif;
      font-size: 1.692em;
      line-height: 1.2em;
      color: #000;
    }
    h3 {
      font-family: Tahoma, Geneva, Arial, Helvetica, sans-serif;
      font-size: 1.385em;
      line-height: 1.2em;
      color: #000;
      border-bottom: 1px dotted #c0c0c0;
      padding-bottom: 5px;
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
    #blok_toc {
      position: fixed;
      top: 0;
      left: 0;
      width: 85px;
      background: #fafafa;
      border-right: 1px solid #e0e0e0;
      border-bottom: 1px solid #e0e0e0;
      padding: 50px 15px 15px 15px;
    }
    #blok_toc ul {
      margin: 0;
      padding: 0;
      list-style: none;
    }
    #blok_toc a {
      color: #333;
    }
    #blok_todo {
      border: 3px solid #00467F;
    }
    .old, .old a {
      text-decoration: line-through;
      color: #F00;
    }
    .old a {
      text-decoration: line-through underline;
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

<body>

<h1>Converter:</h1>

<h2 id="dir">Executables</h2>
<div class="blok">
  <ul>
    <?php
    $dir = scandir('.');
    foreach ($dir as $value) {
      if (!in_array($value, array('.', '..','.DS_Store'))) {
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