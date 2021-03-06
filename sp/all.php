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
<title>自分の気持ちを知る・表す</title>
<style type="text/css">
body {margin:0; padding:0;}
#flash {
    z-index: 1;
    width: 75vw;
    max-width:35rem;
    height: 75vw;
    max-height:35rem;
    margin:auto;
    padding-bottom:25vh;
    text-align:center;
}
#flash iframe {
    width: 100%;
    height: 100%;
    border: none;
}
#symbol_color {
  position:relative;
  top:0; left:0;
  padding:0; margin:0;
  width:100%;
  overflow-y:auto;
  overflow-x:hidden;
  display: flex;
  flex-direction:column-reverse;
  font-family: "SimSong", "MS Mincho", serif;
}
#symbol_color li {
  list-style: none;
}

#log {
  font-size:4vw;
  width:45%;
  height:75vh;
  margin:25vh auto;
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

hr {padding:0.5rem; border:none;}
#marquee a {
  display:inline-block;
  text-decoration: none;
  color:#000;
  padding:0.25rem 0.75rem;
  border:1px solid;
  border-radius: 5rem;
  background-color: #fff;
}
#marquee a:hover {color:#fff;}

#marquee a:hover,
#symbol_color {
background: linear-gradient(0deg,
#b0c4de,
#ffdab9,
#fffafa,
#808080,
#b8860b,
#0000cd,
#483d8b,
#90ee90,
#ff0000,
#ffdab9,
#d2b48c,
#ffdab9,
#ff8c00,
#fff000,
#008080,
#ff0000,
#ff8c00,
#ba55d3,
#800000,
#483d8b,
#800000,
#fff000,
#800000,
#ba55d3,
#ffdab9,
#fff000,
#d2b48c,
#808080,
#556b2f,
#ffb6c1,
#556b2f,
#483d8b,
#fff000,
#ffb6c1,
#483d8b,
#b0c4de,
#800000,
#008080,
#fffafa,
#ba55d3,
#b0c4de,
#ba55d3,
#b0c4de,
#ff8c00,
#ffdab9,
#0000cd,
#008080,
#808080,
#0000cd,
#90ee90,
#483d8b,
#808080,
#fff000,
#800000,
#0000cd,
#ff0000,
#fff000,
#f0ffff,
#b0c4de,
#ff8c00,
#fff000,
#ff0000,
#483d8b,
#ffb6c1,
#90ee90,
#ffb6c1,
#fff000,
#ff8c00,
#90ee90,
#ff0000,
#90ee90,
#fff000,
#90ee90,
#0000cd,
#b0c4de,
#ff8c00,
#b0c4de,
#90ee90,
#90ee90,
#d2b48c,
#fff);
  background-size: 400% 400%;
  animation: gradientBG 75s ease infinite;
}
@keyframes gradientBG {
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
<li>
<script type="text/javascript">
var day = '<div id="day"></div>';
var night = '<div id="night"></div>';
var close = '<div id="close"></div>';

var now = new Date();
var hour = now.getHours();

if(hour >= 0 && hour <= 10){
	document.write(close);
}
else if(hour >= 11 && hour <= 15){
	document.write(day);
}
else if(hour >= 16 && hour <= 20){
	document.write(night);
}
else if(hour >= 21 && hour <= 23){
	document.write(close);
}
</script>
</li>
<li>
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
<hr/>
<ul>
<li class="can neither"><a href="/sign/" target="_blank" rel="noopener noreferrer">もっと詳しく</a></li>
</ul>
</div>
</div>
<hr/>
<div id="flash"><iframe src="/sp/flash.php"></iframe></div>
</li>
</ul>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
$("#day").load("day/sign/");
$("#night").load("night/sign/");
$("#close").load("close/sign/");
})
</script>
</body>
</html>
