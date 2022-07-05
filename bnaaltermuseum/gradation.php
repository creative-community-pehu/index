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
<link rel="stylesheet" type="text/css" href="stylesheet.css" />
<title>自分の気持ちを知る・表す</title>
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
  font-size:125%;
  background:#fff;
  padding:0.5rem 0.25rem;
  text-orientation: upright;
}
#bg_link i {padding:0.5rem 0.125rem;}

.bg_gradient {
  position:relative;
  top:0; left:0;
  display:block;
  padding:0;
  margin:0;
  width:100%;
  height:100vh;
  background-size: 500% 500%;
  animation: gradient 50s ease infinite;
}
.none {
    z-index: 0;
    width: 100%;
    height: 100vh;
    opacity: 0;
    overflow-y: auto;
    transition: all 1500ms ease;
    position: fixed;
}
.open {
    z-index: 1;
    width: 100%;
    opacity: 1;
    overflow-y: auto;
    transition: all 2500ms ease;
    position: fixed;
}
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
<b>
<?php
date_default_timezone_set('Asia/Tokyo');
print(date('Y年n月j日'))
?>
</b>
<br/>
<i>
<?php
date_default_timezone_set('Asia/Tokyo');
print(date('l jS \o\f F Y'))
?>
</i>
</span>

<div id="log" class="none">
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
<sup>
<?php
date_default_timezone_set('Asia/Tokyo');
print(date('Y年n月j日'))
?>
の
</sup>
<br/>
気持ちを表す <b>色と記号</b>
<p><br/>This is The Colors and Symbols That expresses 
<i>
<?php
date_default_timezone_set('Asia/Tokyo');
print(date('l jS \o\f F Y'))
?>
</i>
<br/></p>
<hr/>
</li>
</ul>
</div>

<ul id="symbol_color">
<li class="bg_gradient" style="background-image: linear-gradient(0deg,
<?php if (!empty($rows)): ?>
<?php foreach ($rows as $row): ?>
#<?=h($row[1])?>,
<?php endforeach; ?>
<?php else: ?>
<?php endif; ?>
#fff);">
</li>
</ul>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>

    let btn = document.querySelector('#bg_link');
    let log = document.querySelector('#log');
     
    let btnToggleclass = function(el) {
      el.classList.toggle('open');
    }
     
    btn.addEventListener('click', function() {
      btnToggleclass(log);
    }, false);
</script>
</body>
</html>
