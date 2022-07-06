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
        <style type="text/css">
            body {
                padding: 0;
                margin: 0;
            }
            
            li {
                list-style: none;
            }
            
            #log {
                font-size: 2.5vw;
                width: 45%;
                height: 75vh;
                margin: 10vh 25% 0;
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
                user-select:none;
                pointer-events:none;
            }
            
            #log_items i {
                font-size: 125%;
            }
            
            #log_items hr {
                border: none;
                padding: 0;
            }

            @media screen and (max-width: 550px) {
                #log {
                    font-size: 4vw;
                    width: 70%;
                    height: 55vh;
                    margin: 10vh 15% 0;
                }
                #log_items {
                    padding: 0 5vw;
                }
                #log_items u {
                    width: 7.5vw;
                    height: 7.5vw;
                }
            }
        </style>
    </head>

    <body>

        <div id="log">
            <ul id="log_items">
                <li>
                    <hr/>
                    <p>
                        <b>
                        <?php
                        echo sizeof(file($source_file));
                        ?>
                        </b>
                        Posts<br/>
                    </p>
                    <hr/>
                    <p>
                    Last Modified on 
                        <?php
                        $mod = filemtime($source_file);
                        date_default_timezone_set('Asia/Tokyo');
                        print "".date("G:i:s T",$mod);
                        ?>
                    </p>
                </li>
                <?php if (!empty($rows)): ?>
                <?php foreach ($rows as $row): ?>
                <li>
                    <p><u style="background:#<?=h($row[1])?>;"><span><?=h($row[0])?></span></u>
                        <b style="color:#<?=h($row[1])?>; filter: invert();"><?=h($row[3])?></b></p>
                    <p style="user-select:none; pointer-events:none;">Posted on <i><?=h($row[2])?></i></p>
                </li>
                <?php endforeach; ?>
                <?php else: ?>
                <li>
                    <p>
                        <u style="background:#000;"><span style="color:#fff;">?</span></u>
                        <b style="color:#000;">Under Construction</b>
                    </p>
                    <p id="showTime"></p>
                </li>
                <?php endif; ?>
                <li>
                    <p>
                        Colors and Symbols That expresses<br/>
                        <i>
                          <?php
                          date_default_timezone_set('Asia/Tokyo');
                          print(date('l jS \o\f F Y'))
                          ?>
                        </i>
                        <br/>
                    </p>
                    <hr/>
                </li>
            </ul>
        </div>

<script type="text/javascript">
function set2(num) {
  let ret;
  if (num < 10) { ret = "0" + num; }
  else { ret = num; }
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