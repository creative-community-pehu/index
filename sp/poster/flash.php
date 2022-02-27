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
html, body {
  font-family: "YuGothic","Yu Gothic","游ゴシック体";
  font-weight: 500;
  padding:0; margin:0;
}
.flash {
  position:fixed;
  z-index: 50;
  top:0; left:0;
  padding:0; margin:0;
  width:100%; height:100vh;
  display: flex;
}
.flash li {
  opacity:0;
  width:100%;
  height:100%;
  display:block;
  top:0; left:0;
  padding:0; margin:0;
  list-style: none;
  position: absolute;
  transition:all 0s ease-in-out;
}

.flash .color {
  width:100%;
  height:100%;
  display:block;
  top:0; left:0;
  padding:0; margin:0;
}
.flash .symbol {
  z-index:10;
  position:absolute;
  padding:0; margin:0;
  font-size:15vw;
  top:50%; left:50%;
  filter: invert();
  transform:translate(-50%,-50%);
  -webkit-transform:translate(-50%,-50%);
}
#flash_speed {transform:rotateY(180deg);}

#post {
  z-index:100;
  position:fixed;
  top:0; left:0;
  padding:0; margin:0;
  width:100%;
}
#post input[type="range"] {
  width:75%;
  position:absolute;
  top:0; left:0;
  -webkit-appearance: none;
  appearance: none;
  cursor: pointer;
  outline: none;
  background-color:rgba(255,255,255,0.25);
  border-radius: 5rem;
  padding:0; margin:2.5rem 12.5%;
}

@media screen and (max-width: 550px){
  .flash .symbol {font-size:20vw;}
}
</style>
</head>
<body>
<ul id="random" class="flash">
<?php if (!empty($rows)): ?>
<?php foreach ($rows as $row): ?>
<li>
<span class="color" style="background:#<?=h($row[1])?>;">
<span class="symbol" style="color:#<?=h($row[1])?>;"><?=h($row[0])?></span>
</span>
</li>
<?php endforeach; ?>
<?php else: ?>
<li>
<span class="color" style="background:#<?=h($row[1])?>;">
<span class="symbol" style="color:#<?=h($row[1])?>;"><?=h($row[0])?></span>
</span>
</li>
<?php endif; ?>
</ul>
<section id="post">
<input type="range" id="flash_speed" value="7500" min="5000" max="10000">
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="http://creative-community.space/coding/js/random.js"></script>
<script>
window.addEventListener('load', function () {
	viewSlide('.flash li');
});
function viewSlide(className, flashNo = -1)
{
	let imgArray = document.querySelectorAll(className);
	if (flashNo >= 0) {
		imgArray[flashNo].style.opacity = 0;
	}
	flashNo++;
	if (flashNo >= imgArray.length) {
		flashNo = 0;
	}
	imgArray[flashNo].style.opacity = 1;
	let msec = document.getElementById('flash_speed').max - document.getElementById('flash_speed').value;
	setTimeout(function(){viewSlide(className, flashNo);}, msec);
}
</script>
</body>
</html>
