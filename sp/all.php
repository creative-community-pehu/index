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
<title>自分の気持ちを知る・表す</title>
<style type="text/css">
#marquee {
	position:relative;
	z-index:10;
	width:100%;
	min-height:100vh;
	top:0; left:0;
	padding:0; margin:0;
	transition:.5s all;
}
#marquee div {padding:2.5%;}
#marquee ul {
	display:inline-block;
	padding:0 0 2rem; margin:0;
}
#marquee li {
	display:inline-block;
	margin: 0 0.25rem;
}
#marquee .must {font-weight:900;}
#marquee .should {font-weight:700;}
#marquee .can {font-weight:500;}
#marquee .may {font-weight:300;}
#marquee .could {font-weight:200;}
#marquee .cant {font-weight:100;}

#marquee .positive {font-size:250%;}
#marquee .negative {font-size:50%;}
#marquee .both {font-size:100%;}
#marquee .neither {font-size:150%;}
#marquee .unknown {font-size:200%;}

@media screen and (max-width: 550px){
  #marquee {bottom:1.5rem;}
}
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
<li class="">
<div id="marquee">
<div class="outside org_list">
<ul>
<li class="">ここに表示する</li>
<li class="must positive">色</li>
<li class="neither">と</li>
<li class="must positive">記号</li>
<li class="">は、</li>
<li class="unknown can">2021年9月9日から10月9日</li>
<li class="">の間に</li>
<li class="neither">このウェブサイトを訪れた方々</li>
<li class="">が投稿した</li>
<li class="must unknown">自分の気持ちを知る・表す</li>
<li class="must positive">色</li>
<li class="neither">と</li>
<li class="must positive">記号</li>
<li class="">です。</li>
</ul>
<ul>
<li class="neither">展覧会</li>
<li class="must positive">新しい生活を集める</li>
<li class="">に興味をいだいて、ここを訪れてくださった皆様が投稿した</li>
<li class="must positive">色</li>
<li class="neither">と</li>
<li class="must positive">記号</li>
<li class="">が、この展覧会の</li>
<li class="neither">メインビジュアル</li>
<li class="">になる仕様です。</li>
</ul>
</div>
</div>
</li>
</ul>
</body>
</html>
