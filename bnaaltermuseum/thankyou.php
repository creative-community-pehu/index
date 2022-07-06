<?php

date_default_timezone_set('Asia/Tokyo');

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$today = date("Ymd");
$source_file =  $today . ".csv";

$symbol = (string)filter_input(INPUT_POST, 'symbol');
$color = (string)filter_input(INPUT_POST, 'color');
$timestamp = date("g:i:s A T");

$forwardedFor = $_SERVER["REMOTE_ADDR"];
$ips = explode(",", $forwardedFor);
$ip = $ips[0];

$fp = fopen($source_file, 'a+b');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    flock($fp, LOCK_EX);
    fputcsv($fp, [$symbol, $color, $timestamp, $ip,]);
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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta http-equiv="refresh" content="3;URL=index.php">
<title> 完了 | 自分の気持ちを知る・表す </title>
<style type="text/css">
.inside h1 {
  width:50vw;
  position:absolute;
  top:47.5%; left:50%;
  padding:0; margin:0;
  transform: translate(-50%, -50%) scale(1,1.1);
  text-align:center;
  font-size: 10vw; font-weight:500;
  font-family: 'Times New Roman', serif;
  line-height:200%;
  font-stretch: condensed;
  font-variant: common-ligatures tabular-nums;
  display:inline-block;
  word-spacing: -.25ch;
}
.inside p {
  font-size:1.5vw;
  width:100%;
  text-align:center;
  position:absolute;
  top:85%; left:50%;
  transform: translate(-50%, -50%);
  font-family: "SimSong", "MS Mincho", serif;
}
.inside b {
  border:0.25vw solid #000;
  background:#fff;
  padding:0.5vw 2.5vw;
  border-radius:2rem;
  font-weight:500;
}
</style>
</head>
<body>
<div class="inside">
<h1><span id="thankyou"></span></h1>
<p class="notice"><b>自分の気持ちを知る・表す</b></p>
</div>
</div>
<script>
var text = ["Thank You","for","Submit" ];
var counter = 0;
var elem = document.getElementById("thankyou");
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
