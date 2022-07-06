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
        
        #mod {
            position: fixed;
            top: 0;
            width: 100%;
            height: 100%;
            font-family: 'Times New Roman', serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        
        #mod b {
            font-size: 7.5vw;
        }
        
        #mod p {
            position: absolute;
            bottom: 0;
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
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        
        #mod sup#ed {
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
                height: auto;
                background-color: #fff;
            }
            #mod p {
                position: relative;
                top: 0;
            }
            #mod sup#time {
                display: none;
            }
            #mod sup#ed {
                display: inline-flex;
            }
        }
    </style>
</head>

<body>

    <div id="mod">
        <b>𝕷𝖆𝖘𝖙 𝕸𝖔𝖉𝖎𝖋𝖎𝖊𝖉</b>
        <p>
            <sup id="no" style="text-transform: uppercase;">
            #
            <?php
            $mod = filemtime($source_file);
            date_default_timezone_set('Asia/Tokyo');
            print "".date("jMyD",$mod);
            ?>
        </sup>
            <sup id="time" style="text-transform: uppercase;">
            <?php
            $mod = filemtime($source_file);
            date_default_timezone_set('Asia/Tokyo');
            print "".date("g:i:s A T",$mod);
            ?>
        </sup>
            <sup id="ed" style="text-transform: uppercase;">Members Only</sup>
            <sup id="post" style="text-transform: uppercase;">
            <?php
            echo sizeof(file($source_file));
            ?>
            Posts
        </sup>
        </p>
    </div>

    <div id="log">
        <ul id="log_items">
            <?php if (!empty($rows)): ?>
            <?php foreach ($rows as $row): ?>
            <li>
                <p>
                    <u style="background:#<?=h($row[1])?>;"><span><?=h($row[0])?></span></u>
                    <b style="color:#<?=h($row[1])?>; user-select:none; pointer-events:none; filter: invert();"><?=h($row[3])?></b>
                </p>
                <p style="user-select:none; pointer-events:none; text-transform: uppercase;">
                    <?=h($row[2])?>
                </p>
            </li>
            <?php endforeach; ?>
            <?php else: ?>
            <li>
                <p>
                    <u style="background:#000;"><span style="color:#fff;">?</span></u>
                    <b style="color:#000; user-select:none; pointer-events:none;">Under Construction</b>
                </p>
                <p style="user-select:none; pointer-events:none; text-transform: uppercase;">IP <i><?php echo $_SERVER['REMOTE_ADDR']; ?></i></p>
            </li>
            <?php endif; ?>
        </ul>
    </div>

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