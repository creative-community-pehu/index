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
            body {
                padding: 0;
                margin: 0;
            }
            
            li {
                list-style: none;
            }
            
            #symbol_color {
                top: 0;
                left: 0;
                padding: 0;
                margin: 0;
                width: 100%;
                position: relative;
                z-index: 0;
                overflow-y: auto;
                overflow-x: hidden;
                display: flex;
                flex-direction: column-reverse;
            }
            
            #symbol_color .bg_color {
                position: relative;
                top: 0;
                left: 0;
                padding: 0;
                margin: 0;
                width: 100%;
                height: 100vh;
                display: block;
            }
            
            #symbol_color .bg_symbol {
                font-size: 15vw;
                position: absolute;
                padding: 0;
                margin: 0;
                top: 50%;
                left: 50%;
                z-index: 10;
                display: flex;
                flex-wrap: wrap;
                transform: translate(-50%, -50%);
                -webkit-transform: translate(-50%, -50%);
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
        </ul>
    </body>

    </html>