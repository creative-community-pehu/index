<?php

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$symbol = (string)filter_input(INPUT_POST, 'symbol'); // $_POST['symbol']
$color = (string)filter_input(INPUT_POST, 'color'); // $_POST['color']
$timestamp = time() ;

$forwardedFor = $_SERVER["HTTP_X_FORWARDED_FOR"];
$ips = explode(",", $forwardedFor);
$ip = $ips[0];

$fp = fopen('symbol_color.csv', 'a+b');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    flock($fp, LOCK_EX);
    fputcsv($fp, [$symbol, $color, $timestamp, $ip]);
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
<link rel="stylesheet" type="text/css" href="/sign/stylesheet.css" />
<title>新しい生活を集める</title>
<style type="text/css">
body  {overflow-x:hidden;}
#bg_link {
    position:absolute;
    z-index:100;
    top:1rem;
    right:1rem;
    font-family: "SimSong", "MS Mincho", serif;
    transition:.5s all;
}
#bg_link b {
    font-weight:500;
    background:#fff;
    padding:0.5rem 0.25rem;
}
#bg_link i {
    font-size:1.75rem;
    display:block;
    padding:0.5rem 1rem;
    margin-right:1rem;
}

.bg_gradient {
    position:fixed;
    top:0; left:0;
    display:block;
    padding:0;
    margin:0;
    width:100%;
    height:100vh;
    background-size: 500% 500%;
    animation: gradient 50s ease infinite;
}
#flash {
    z-index: 10;
    width: 75vw;
    max-width:35rem;
    height: 75vw;
    max-height:35rem;
    position: relative;
    top:4.5vw; left:4.5vw;
}
#flash iframe {
    width: 100%;
    height: 100%;
    border: none;
}

@keyframes gradient {
  0% {
    background-position: 100% 0%;
  }
  50% {
    background-position: 100% 100%;
  }
  100% {
    background-position: 100% 0%;
  }
}

@media print {
#bg_link {display: none;}
.bg_gradient {
  background-size: 100% 100%;
  animation: gradient none;
}
}
</style>
</head>
<body>

<span id="bg_link">
<b>令和三年 十月 十日 - 三十日</b><br/>
<i>新しい生活を集める</i>
</span>

<div id="flash"><iframe src="flash.php"></iframe></div>

<ul id="symbol_color">
<li class="bg_gradient" style="background-image: linear-gradient(180deg,
<?php if (!empty($rows)): ?>
<?php foreach ($rows as $row): ?>
#<?=h($row[1])?>,
<?php endforeach; ?>
<?php else: ?>
<?php endif; ?>
#fff);">
</li>
</ul>

</body>
</html>
