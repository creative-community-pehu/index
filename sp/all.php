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
	position:fixed;
	z-index:1;
	height:4rem;
	width:100%;
	bottom:0; left:0;
	padding:0; margin:0;
	overflow:hidden;
	transition:.5s all;
}
#marquee div {
	position:absolute;
	padding:0.25rem 0;
	margin:0;
}
#marquee ul {
	width:100%;
	display:inline-block;
	padding:0; margin:0;
}
#marquee li {
	display:inline-block;
	margin: 0 0.25rem;
}
#marquee #bottom {
	width:100vw; bottom:0;
	text-align:center;
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
  #topic {top: 45%;}
}
</style>
</head>
<body>

<div id="marquee">
<div id="bottom" class="outside org_list">
<ul id="s1" class="es">
<li class="must unknown">クリエイティブ・コミュニティスペース</li>
<li class="must unknown">ペフ</li>
<li class="">が</li>
<li class="unknown can">実現したいこと</li>
<li class=""></li>
<li class="unknown">誰にでもできること</li>
<li class="neither">を</li>
<li class="unknown">自分らしく行うこと</li>
<li class="neither">の</li>
<li class="unknown">美しさ</li>
<li class="">を</li>
<li class="neither">形にする</li>
<li class="must positive">展覧会</li>
<li class="must positive">新しい生活を集める</li>
<li class="">を開催します。</li>
<li class=""></li>
<li class="neither">会員制コミュニティサイト</li>
<li class="unknown should"><i>creative-community.space</i></li>
<li class="">の</li>
<li class="neither may">活動</li>
<li class="">を</li>
<li class="unknown must">美術作品</li>
<li class="">として</li>
<li class="neither">この展覧会で発表します。</li>
<li class="must positive">　</li>
</ul>
</div>
</div>

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

<script src="http://creative-community.space/coding/js/marquee/endless_scroll_min.js" type="text/javascript"></script>
<script type="text/javascript">
$(window).load(function () {
    $("#s1").endlessScroll({ width: '100vw', height: '4rem', steps: -1, speed:10, mousestop: true });
});
</script>
</body>
</html>
