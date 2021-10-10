<?php
function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
$word = (string)filter_input(INPUT_POST, 'word');
$weight = (string)filter_input(INPUT_POST, 'weight');
$size = (string)filter_input(INPUT_POST, 'size');
$feel = (string)filter_input(INPUT_POST, 'feel');

$fp = fopen('org.csv', 'a+b');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    flock($fp, LOCK_EX);
    fputcsv($fp, [$word, $weight, $size, $feel,]);
    rewind($fp);
}

flock($fp, LOCK_SH);
while ($row = fgetcsv($fp)) {
    $rows[] = $row;
}
flock($fp, LOCK_UN);
fclose($fp);

?>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="refresh" content="3;URL=/members/">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title> Complete | 思考や感情を集積し、整理する </title>
<link rel="stylesheet" href="/coding/fontbook/css/font-family.css"/>
<style type="text/css">
.inside h1 {
  width:50vw;
  position:absolute;
  top:47.5%; left:50%;
  padding:0; margin:0;
  font-size: 10vw; font-weight:500;
  transform: translate(-50%, -50%);
  font-family: "ipag", monospace;
}
.inside p {
  font-size:1.5vw;
  width:100%;
  text-align:center;
  position:absolute;
  top:85%; left:50%;
  transform: translate(-50%, -50%);
  font-family: "ipag", monospace;
}
.inside b {
  border:0.25vw solid #000;
  background:#fff;
  padding:0.5vw 2.5vw;
  font-weight:500;
}
</style>
</head>
<body>
<div class="inside">
<h1><span id="rename"></span></h1>
<p class="notice"><b>思考や感情を集積し、整理する</b></p>
</div>
</div>
<script>
var text = ["Thank You","for","Submit" ];
var counter = 0;
var elem = document.getElementById("rename");
var inst = setInterval(change, 550);

elem.innerHTML = text[counter];

function change() {
  elem.innerHTML = text[counter];
  counter++;
  if (counter >= text.length) {
    counter = 0;
  }
};
</script>
</body>
</html>