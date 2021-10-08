<?php

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
$link = (string)filter_input(INPUT_POST, 'link'); // $_POST['link']

$fp = fopen('all.csv', 'a+b');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    flock($fp, LOCK_EX);
    fputcsv($fp, [$link]);
    rewind($fp);
}
flock($fp, LOCK_SH);
while ($row = fgetcsv($fp)) {
    $rows[] = $row;
}
flock($fp, LOCK_UN);
fclose($fp);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Everyones Drawings are So Beautiful</title>
    <style type="text/css">

.library {
    position:relative;
    top:0; left:0;
    z-index:0;
}
.library li{
    width:67vh;
    max-width:90vw;
    height: 94vh;
    overflow:hidden;
}
    </style>
    
    <!-- Import the webpage's stylesheet -->
    <link rel="stylesheet" href="style.css" />
  
  </head>
  <body>
    <ul class="mousedragscrollable library">
    <li><div id="p5"></div></li>
      <?php if (!empty($rows)): ?>
        <?php foreach ($rows as $row): ?>
          <li><iframe src="<?=h($row[0])?>"></iframe></li>
          <?php endforeach; ?>
        <?php else: ?>
      <?php endif; ?>
    </ul>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="/coding/js/mousedragscrollable/scrollable.js"></script>
  </body>
</html>
