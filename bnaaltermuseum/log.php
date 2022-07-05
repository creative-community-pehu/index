<?php

date_default_timezone_set('Asia/Tokyo');

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$today = date("Ymd");
$symbol = (string)filter_input(INPUT_POST, 'symbol'); // $_POST['symbol']
$color = (string)filter_input(INPUT_POST, 'color'); // $_POST['color']
$timestamp = date("g:i:s A \J\S\T");
$filename =  $today . ".csv"; 

$forwardedFor = $_SERVER["REMOTE_ADDR"];
$ips = explode(",", $forwardedFor);
$ip = $ips[0];

$fp = fopen($filename, 'a+b');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    flock($fp, LOCK_EX);
    fputcsv($fp, [$symbol, $color, $timestamp, $today, $ip,]);
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
<html lang="ja">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>自分の気持ちを知る・表す</title>
<style type="text/css">
#log {
  font-size:2.5vw;
  width:45%;
  height:75vh;
  margin:12.5vh auto;
  background:rgba(255,255,255,0.75);
  overflow-y:auto;
}
#log_items {
  padding:0 2.5vw;
  list-style: none;
  display: -webkit-flex;
  display: flex;
  -webkit-align-items: flex-start;
  align-items: flex-start;
  -webkit-flex-direction: column-reverse;
  flex-direction: column-reverse;
}
#log_items li {
  width:100%;
  position:relative;
  margin:0;
  padding:2.5vw 0 0;
  word-break: break-word;
}
#log_items p {
  margin:0;
  font-size:75%;
  line-height:150%;
}
#log_items u {
  display:inline-block;
  width:5vw;
  height:5vw;
  position:relative;
  float:left;
  margin-top: 0.45vw;
  margin-right: 2.5vw;
}
#log_items span {
  position:absolute;
  padding:0;
  margin:0;
  font-size:150%;
  top:50%; left:50%;
  transform:translate(-50%,-50%);
  -webkit-transform:translate(-50%,-50%);
}
#log_items b {
  font-size:150%;
}
#log_items i {
  font-size:125%;
}
#log_items hr {
  border:none;
  padding:0;
}
</style>
</head>
<body>
<div id="log">
<ul id="log_items">
<?php if (!empty($rows)): ?>
<?php foreach ($rows as $row): ?>
<li>
<p><u style="background:#<?=h($row[1])?>;"><span><?=h($row[0])?></span></u>
<b style="color:#<?=h($row[1])?>; filter: invert();"><?=h($row[4])?></b></p>
<p>Posted on <i><?=h($row[2])?></i></p>
</li>
<?php endforeach; ?>
<?php else: ?>
<li>
<p>
<i><?php echo $_SERVER['REMOTE_ADDR']; ?></i>
</p>
</li>
<?php endif; ?>
<li>
<b>自分の気持ちを知る・表す</b>
<hr/>
</li>
</ul>
</div>
</body>
</html>
