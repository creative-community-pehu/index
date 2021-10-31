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
#log {
  font-size:4vw;
  width:45%;
  height:75vh;
  margin:12.5vh auto 25vh;
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
  width:4vw;
  height:4vw;
  position:relative;
}
#log_items span {
  position:absolute;
  padding:0;
  margin:0;
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
#marquee {
	position:relative;
	z-index:10;
	width:100%;
	top:0; left:0;
	padding:0; margin:0;
	transition:.5s all;
}
#marquee div {padding:2.5% 10%;}
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
</style>
</head>
<body>

<ul id="symbol_color">
<li style="background:#fff;">
<script type="text/javascript">
var day = '<div id="day"></div>';
var night = '<div id="night"></div>';
var close = '<div id="close"></div>';

var now = new Date();
var hour = now.getHours();

if(hour >= 0 && hour <= 4){
	document.write(night);
}
else if(hour >= 5 && hour <= 16){
	document.write(day);
}
else if(hour >= 17 && hour <= 23){
	document.write(night);
}
</script>
</li>
<li style="background:#fff;">
<div id="log">
<ul id="log_items">
<?php if (!empty($rows)): ?>
<?php foreach ($rows as $row): ?>
<li>
<p><u style="background:#<?=h($row[1])?>;"><span><?=h($row[0])?></span></u> IP <b style="color:#<?=h($row[1])?>; filter: invert();"><?=h($row[3])?></b><br/>
Posted on <i style="color:#<?=h($row[1])?>;"><?=h($row[2])?></i></p>
</li>
<?php endforeach; ?>
<?php else: ?>
<li>
<p>IP <b>000.00.00.00</b><br/>
Posted on <i>00.00.00 00:00</i></p>
</li>
<?php endif; ?>
</ul>
</div>
</li>
<li class="bg_color">
<span class="bg_symbol"><blockquote class="twitter-tweet"><p lang="und" dir="ltr"><a href="https://t.co/NFazh3ELdY">pic.twitter.com/NFazh3ELdY</a></p>&mdash; ∧° ┐ | creative, community space (@pe_hu_) <a href="https://twitter.com/pe_hu_/status/1454636771921125385?ref_src=twsrc%5Etfw">October 31, 2021</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script></span>
</li>
<li style="background:#fff;">
<div id="marquee">
<div class="outside org_list">
<ul>
<li class="">このページに表示される</li>
<li class="must positive">色</li>
<li class="neither">と</li>
<li class="must positive">記号</li>
<li class="">は、</li>
<li class="unknown can">展覧会「新しい生活を集める」</li>
<li class="">にご来場くださいました</li>
<li class="neither">皆様が投稿</li>
<li class="">した</li>
<li class="must unknown">自分の気持ちを知る・表す</li>
<li class="must positive">色</li>
<li class="neither">と</li>
<li class="must positive">記号</li>
<li class="">です。</li>
</ul>
</div>
</div>
</li>
</ul>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
$("#day").load("night/sign/");
$("#night").load("night/sign/");
})
</script>
</body>
</html>
