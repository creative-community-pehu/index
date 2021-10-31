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
    top:4.5vw;
    right:2.5vw;
    font-family: "SimSong", "MS Mincho", serif;
    transition:.5s all;
}
#bg_link b {
    font-weight:500;
    font-size:1rem;
    background:#fff;
    padding:0.5rem 0.25rem;
}
#bg_link i {
    font-size:2rem;
    display:block;
    padding:0.5rem 1.5rem;
    margin-right:1rem;
}

.none {
    width: 100%;
    height: 0vh;
    opacity: 0;
    overflow-y: auto;
    transition: all 1500ms ease;
    position: fixed; z-index:2;
}
.open {
    width: 100%;
    height: 100vh;
    opacity: 1;
    overflow-y: auto;
    transition: all 2500ms ease;
    position: fixed;
}

@media print {
#bg_link {display: none;}
}
</style>
</head>
<body>

<span id="bg_link">
<b>令和三年 十月 十日 - 三十日</b><br/>
<i>新しい生活を集める</i>
</span>

<div id="open" class="none"></div>

<ul id="symbol_color">
<li class="bg_gradient">
</li>
</ul>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>
    $(function(){
    $("#open").load("log.html");
    })

    let btn = document.querySelector('#bg_link');
    let log = document.querySelector('#open');
     
    let btnToggleclass = function(el) {
      el.classList.toggle('open');
    }
     
    btn.addEventListener('click', function() {
      btnToggleclass(log);
    }, false);
</script>
</body>
</html>
