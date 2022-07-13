<?php

date_default_timezone_set('Asia/Tokyo');

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$today = date("Ymd");
$source_file =  $today . ".csv";

$fp = fopen($source_file, 'a+b');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    flock($fp, LOCK_EX);
    fputcsv($fp, [$symbol, $color, $timestamp, $ip,]);
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
        <script src="https://creative-community.space/coding/js/tone/jquery.min.js"></script>
        <script src="https://creative-community.space/coding/js/tone/jquery-ui.min.js"></script>
        <script src="https://creative-community.space/coding/js/tone/Tone.min.js"></script>
        <script src="https://creative-community.space/coding/js/tone/StartAudioContext.js"></script>
        <style type="text/css">
            body {
                padding: 0;
                margin: 0;
            }
            
            #random {
                position: fixed;
                z-index: 500;
                top: 0;
                left: 0;
                padding: 0;
                margin: 0;
                width: 100%;
                height: 100vh;
                display: flex;
            }
            
            .flash li {
                opacity: 0;
                width: 100%;
                height: 100%;
                display: block;
                top: 0;
                left: 0;
                padding: 0;
                margin: 0;
                list-style: none;
                position: absolute;
                transition: all 0s ease-in-out;
            }
            
            .flash .color {
                width: 100%;
                height: 100%;
                display: block;
                top: 0;
                left: 0;
                padding: 0;
                margin: 0;
            }
            
            .flash .symbol {
                z-index: 10;
                position: absolute;
                padding: 0;
                margin: 0;
                font-size: 15vw;
                font-family: "YuGothic", "Yu Gothic", "游ゴシック体";
                font-weight: 500;
                top: 50%;
                left: 50%;
                filter: invert();
                transform: translate(-50%, -50%);
                -webkit-transform: translate(-50%, -50%);
            }
            
            #flash_speed {
                transform: rotateY(180deg);
            }
            
            #speed {
                z-index: 1000;
                position: fixed;
                top: 0;
                left: 0;
                padding: 0;
                margin: 0;
                width: 100%;
            }
            
            #speed input[type="range"] {
                width: 75%;
                position: absolute;
                top: 0;
                left: 0;
                -webkit-appearance: none;
                appearance: none;
                cursor: pointer;
                outline: none;
                background-color: rgba(255, 255, 255, 0.25);
                border-radius: 5rem;
                padding: 0;
                margin: 2.5rem 12.5%;
            }
            
            @media screen and (max-width: 550px) {
                .flash .symbol {
                    font-size: 20vw;
                }
            }
        </style>
    </head>

    <body>
        <ul id="random" class="flash">
            <?php if (!empty($rows)): ?>
            <?php foreach ($rows as $row): ?>
            <li>
                <span class="color" style="background:#<?=h($row[1])?>;">
                  <b class="symbol" style="color:#<?=h($row[1])?>;"><?=h($row[0])?></b>
                </span>
            </li>
            <?php endforeach; ?>
            <?php else: ?>
            <li>
                <span class="color" style="background:#fff;">
                  <b class="symbol" style="color:#fff;">?</b>
                </span>
            </li>
            <?php endif; ?>
        </ul>
        <section id="speed">
            <input type="range" id="flash_speed" value="" min="0" max="5000">
        </section>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="/sign/flash.js"></script>
    </body>

    </html>