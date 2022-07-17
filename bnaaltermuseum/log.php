<?php

date_default_timezone_set('Asia/Tokyo');

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$w = date("w");
$week_name = array("日", "月", "火", "水", "木", "金", "土");

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
            
            #mod {
                position: fixed;
                top: 0;
                width: 100%;
                height: 100%;
                font-family: 'Times New Roman', serif;
                color: #fff;
                text-align: center;
                margin: 0;
                padding: 0;
            }
            
            #mod b {
                padding: 0rem 1.25% 0.25rem;
                font-size: 5.5vw;
                transform: scale(1, 1.5);
            }
            
            #mod #today {
                position: absolute;
                top: 0;
                width: 97.5%;
                margin: 0;
                padding: 0.5rem 1.25% 0.25rem;
                font-size: 2vw;
                font-weight: 500;
                font-stretch: condensed;
                font-variant: common-ligatures tabular-nums;
                display: inline-block;
                transform: scale(1, 1.1);
                word-spacing: -.25ch;
                display: flex;
                justify-content: space-between;
                flex-wrap: wrap;
            }
            
            #mod #credit,
            #mod #ed {
                display: none;
            }
            
            #mod sup {
                display: inline-flex;
            }
            
            li {
                list-style: none;
            }
            
            #log {
                font-size: 2.5vw;
                width: 45%;
                height: 70vh;
                margin: 12.5vh 25% 0;
                z-index: 1000;
                overflow-y: auto;
                font-family: "MS Mincho", "SimSong", serif;
                font-weight: 500;
            }
            
            #log_items {
                padding: 0 2.5vw;
                list-style: none;
                display: -webkit-flex;
                display: flex;
                -webkit-align-items: flex-start;
                align-items: flex-start;
                -webkit-flex-direction: column-reverse;
                flex-direction: column-reverse;
            }
            
            #log_items li {
                width: 100%;
                position: relative;
                margin: 0;
                padding: 2.5vw 0 0;
                word-break: break-word;
            }
            
            #log_items p {
                margin: 0;
                font-size: 75%;
                line-height: 150%;
            }
            
            #log_items u {
                display: inline-block;
                width: 5vw;
                height: 5vw;
                position: relative;
                float: left;
                margin-top: 0.45vw;
                margin-right: 2.5vw;
            }
            
            #log_items span {
                position: absolute;
                padding: 0;
                margin: 0;
                font-size: 150%;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                -webkit-transform: translate(-50%, -50%);
            }
            
            #log_items b {
                font-size: 150%;
            }
            
            #log_items i {
                font-size: 125%;
            }
            
            #log_items hr {
                border: none;
                padding: 0;
            }
            
            @media screen and (max-width: 550px) {
                #mod b {
                    font-size: 7.5vw;
                }
                #mod #today {
                    font-size: 4.5vw;
                }
                #log {
                    font-size: 4vw;
                    width: 70%;
                    height: 55vh;
                    margin: 12.5vh 15% 0;
                }
                #log_items {
                    padding: 0 5vw;
                }
                #log_items u {
                    width: 7.5vw;
                    height: 7.5vw;
                }
            }
            
            @media print {
                #mod {
                    padding: 1vw 0;
                    position: relative;
                    height: auto;
                    color: #000;
                    background-color: #fff;
                }
                #mod #credit,
                #mod #today {
                    position: absolute;
                    width: 15%;
                    display: block;
                }
                #mod #today {
                    top: 1vw;
                    left: 0;
                    width: 15%;
                    margin: 0.5vw 1.25vw 2vw;
                    padding: 1vw 0;
                    border: solid 1px #000;
                }
                #mod #credit {
                    text-align: right;
                    top: 0;
                    right: 0;
                    width: 10%;
                    margin: 0vw;
                    padding: 0;
                }
                #mod #ed {
                    display: inline-block;
                }
                #mod sup {
                    display: block;
                }
                #mod sup#time {
                    display: none;
                }
                #log {
                    position: relative;
                    top: 0;
                    left: 0;
                    font-size: 2.5vw;
                    width: 100%;
                    height: auto;
                    margin: 0;
                    padding: 0 0 2.5vw;
                    background-color: #fff;
                    z-index: 0;
                }
                #log_items {
                    padding: 0 0 0.25vw;
                    margin: 0;
                    border-top: 1px solid #000;
                    border-bottom: 1px solid #000;
                    display: -webkit-flex;
                    display: flex;
                    -webkit-align-items: start;
                    align-items: start;
                    flex-flow: row-reverse nowrap;
                }
                #log_items li {
                    display: inline-flex;
                    padding: 0.25vw;
                    margin: 0;
                }
                #log_items p {
                    margin: 0;
                    padding: 0;
                    font-size: 100%;
                    line-height: 150%;
                }
                #log_items u {
                    margin: 0.5vw 1vw 0;
                    width: 2.5vw;
                    height: 2.5vw;
                    font-size: 1.25vw;
                    clear: both;
                }
                #log_items .post,
                #log_items b,
                #log_items i {
                    display: none;
                }
            }
        </style>
    </head>

    <body>

        <div id="mod">
            <b id="ed">𝕿𝖍𝖊 𝕭𝖓𝕬 𝕿𝖎𝖒𝖊𝖘</b>
            <p id="today">
                <sup id="no" style="text-transform: uppercase;">
                    #
                    <?php
                    $mod = filemtime($source_file);
                    date_default_timezone_set('Asia/Tokyo');
                    print "".date("jMyD",$mod);
                    ?>
            </sup>
                <sup id="time" style="text-transform: uppercase;">
                    Last Modified 
                    <?php
                    $mod = filemtime($source_file);
                    date_default_timezone_set('Asia/Tokyo');
                    print "".date("g:i:s A T",$mod);
                    ?>
            </sup>
                <sup id="post" style="text-transform: uppercase;">
                    <?php
                    echo sizeof(file($source_file));
                    ?>
                    Posts
        </sup>
            </p>
            <p id="credit"><img src="/sign/qr.png" width="100%"></p>
        </div>

        <div id="log">
            <ul id="log_items">
                <?php if (!empty($rows)): ?>
                <?php foreach ($rows as $row): ?>
                <li>
                    <p>
                        <u style="background:#<?=h($row[1])?>;"><span><?=h($row[0])?></span></u>
                        <b class="post" style="color:#<?=h($row[1])?>; user-select:none; pointer-events:none; filter: invert();"><?=h($row[3])?></b>
                    </p>
                    <p class="post" style="user-select:none; pointer-events:none; text-transform: uppercase;">
                        <?=h($row[2])?>
                    </p>
                </li>
                <?php endforeach; ?>
                <?php else: ?>
                <li>
                    <p>
                        <u style="background:#000;"><span style="color:#fff;">?</span></u>
                        <b class="post" style="color:#000; user-select:none; pointer-events:none;">Under Construction</b>
                    </p>
                    <p class="post" style="user-select:none; pointer-events:none; text-transform: uppercase;">IP <i><?php echo $_SERVER['REMOTE_ADDR']; ?></i></p>
                </li>
                <?php endif; ?>
            </ul>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript">
            function set2(num) {
                let ret;
                if (num < 10) {
                    ret = "0" + num;
                } else {
                    ret = num;
                }
                return ret;
            }

            function showClock() {
                const nowTime = new Date();
                const nowHour = set2(nowTime.getHours());
                const nowMin = set2(nowTime.getMinutes());
                const nowSec = set2(nowTime.getSeconds());
                const msg = "" + nowHour + ":" + nowMin + ":" + nowSec + "";
                document.getElementById("showTime").innerHTML = msg;
            }
            setInterval('showClock()', 1000);
        </script>

    </body>

    </html>