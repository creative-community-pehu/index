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
    <title>Everyones Drawings are Seems So Beautiful</title>
    <style type="text/css">
.library li:first-child {
  width:75vw;
  max-width:75vw;
  overflow:auto;
}
.library li{
  width:67vh;
  max-width:90vw;
  height: 94vh;
  overflow:hidden;
}

#submit {
  white-space: normal;
}
#submit h1 {
    padding:12.5% 7.5% 25%;
    line-height:150%;
    font-size:4.5vw;
    font-family: "ipag", monospace;
}
#submit p {
    top:0; left:0;
    padding:12.5% 7.5%;
    line-height:150%;
    font-size:2.5vw;
    font-family: "ipag", monospace;
}
#submit h1,
#submit p {
    display: inline-block;
    transform:scale(1, 2);
}
    </style>
    
    <!-- Import the webpage's stylesheet -->
    <link rel="stylesheet" href="index.css" />
  
  </head>
  <body>
    <ul class="mousedragscrollable library">
    <li>

<div id="submit">
<h1>OMG!<br />
Everyones Drawings are Seems So Beautiful<3<br />
Thank You for Send it to us !!<br />
</h1>
<p>
This is the Collection of drawings by Visiters of this website.<br />
Thank You,<br />
<br />
creative-community.space
</p>
</div>

        </li>
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
