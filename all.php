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
<link rel="stylesheet" type="text/css" href="https://creative-community.space/sign/stylesheet.css" />
<title>令和三年三月 | 自分の気持ちを知る・表す</title>
<style type="text/css">
</style>
</head>
<body>
  
<ul id="symbol_color">
<?php if (!empty($rows)): ?>
<?php foreach ($rows as $row): ?>
<li class="bg_color" style="background:#<?=h($row[1])?>;">
<span class="bg_symbol" style="color:#<?=h($row[1])?>; filter: invert();"><?=h($row[0])?></span>
</li>
<?php endforeach; ?>
<?php else: ?>
<li class="bg_color" style="background:#fff;">
<span class="bg_symbol">✔</span>
</li>
<?php endif; ?>
</ul>
</body>
</html>
