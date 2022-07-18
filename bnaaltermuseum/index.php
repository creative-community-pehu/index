<?php

date_default_timezone_set('Asia/Tokyo');

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$today = date("Ymd");
$source_file = $today . ".csv";

$symbol = (string)filter_input(INPUT_POST, 'symbol');
$color = (string)filter_input(INPUT_POST, 'color');
$timestamp = date("j.M.y.D g:i:s A");

$forwardedFor = $_SERVER["REMOTE_ADDR"];
$ips = explode(",", $forwardedFor);
$ip = $ips[0];

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
    <title>𝕿𝖍𝖊 𝕭𝖓𝕬 𝕿𝖎𝖒𝖊𝖘</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="refresh" content="60; URL=">
    <style>
        body,
        #sign {
            padding: 0;
            margin: 0;
        }
        
        #mod {
            position: relative;
            top: 0;
            width: 100%;
            height: auto;
            background-color: #fff;
            border-bottom: solid 1px #000;
            padding: 1rem 0 0;
            margin: 0;
            color: #000;
            font-family: 'Times New Roman', serif;
            text-align: center;
        }
        
        #mod b {
            display: block;
            margin: 0;
            padding: 0;
        }
        
        #mod #ed {
            padding: 0 0.25rem;
            font-size: 3.33rem;
            transform: scale(1, 1.5);
        }
        
        #mod #credit,
        #mod #today {
            position: absolute;
            display: block;
        }
        
        #mod #today {
            top: 0;
            left: 0;
            width: 15rem;
            height: 5rem;
            margin: 1rem 2rem;
            padding: 0;
            border: solid 1px #000;
            font-weight: 500;
            font-stretch: condensed;
            font-variant: common-ligatures tabular-nums;
            display: inline-block;
            transform: scale(1, 1.1);
            word-spacing: -.25ch;
        }
        
        #mod sup {
            font-size: 0.75rem;
            line-height: 200%;
            width: 90%;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }
        
        #mod #credit {
            font-size: 0.55rem;
            text-align: right;
            height: 5rem;
            top: 0;
            right: 0;
            margin: 1rem 2rem;
            width: 15rem;
            text-align: justify;
            word-wrap: break-word;
            letter-spacing: 0.05em;
        }
        
        #mod #credit b {
            display: block;
            text-align: center;
            font-size: 150%;
            padding-bottom: 0.25rem;
            font-family: Arial, sans-serif;
        }
        
        #collection {
            position: relative;
            font-size: 0.75rem;
            letter-spacing: .5rem;
            padding: 0.125rem 0;
            margin: 1rem 0 0;
            border-top: 1px solid #000;
        }
        
        #collection marquee {
            display: block;
        }
        
        #collection ul {
            padding: 0;
            margin: 0;
            display: -webkit-flex;
            display: flex;
            -webkit-justify-content: space-between;
            justify-content: space-between;
            -webkit-flex-direction: row-reverse;
            flex-direction: row-reverse;
        }
        
        #collection li {
            display: block;
            list-style: none;
            position: relative;
            padding: 0;
            margin: 0.25rem 0.5rem;
            font-size:1.5rem;
            width: 2rem;
            height: 2rem;
        }
        
        #collection li b {
            position: absolute;
            display: block;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }
        
        #sign {
            position: fixed;
            bottom: 0;
            right: 0;
            z-index: -1;
            width: 100%;
            height: 95vh;
            overflow: hidden;
            pointer-events: none;
            user-select: none;
        }
        
        #sign iframe {
            border: none;
            width: 100%;
            height: 100%;
        }
        
        #weather {
            position: fixed;
            bottom: 0;
            width:100%;
            display: block;
            font-size: 0.75rem;
            letter-spacing: .5rem;
            padding: 0.25rem 0;
            margin: 1rem 0 0;
        }
        
        #weather span {
            font-family: 'Times New Roman', serif;
            font-weight: 500;
            font-stretch: condensed;
            font-variant: common-ligatures tabular-nums;
            display: inline-block;
            transform: scale(1, 1.1);
            word-spacing: -.25ch;
        }
        
    </style>
</head>
  <script>
  if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
    redirect:window.location.replace("mobile.php");
  }
  </script>

<body>
    <div id="mod">
        <b id="ed">𝕿𝖍𝖊 𝕭𝖓𝕬 𝕿𝖎𝖒𝖊𝖘</b>
        <p id="today">
            <sup style="text-transform: uppercase;">
            <?php
            date_default_timezone_set('Asia/Tokyo');
            $w = date("w");
            $week_name = array("日", "月", "火", "水", "木", "金", "土");
            print(date('Y 年 n 月 j 日'). " ($week_name[$w])")
            ?>
            <br/>今日の気持ちを表す色と記号</sup>
        </p>

        <div id="credit">
            <b>宿泊者限定</b>
            <span>35 の 記号 と 18 の 色 から 今の気持ちに合う色と記号を集め、みんなの気持ちを集めたオンライン作品を毎日制作しています。</span>
        </div>
        <div id="collection">
                <ul class="flash">
                    <?php if (!empty($rows)): ?>
                    <?php foreach ($rows as $row): ?>
                    <li style="background:#<?=h($row[1])?>;">
                        <b class="symbol" style="color:#<?=h($row[1])?>; filter: invert();"><?=h($row[0])?></b>
                    </li>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <li style="background:#000;">
                    <b class="symbol" style="color:#fff;">?</b>
                    </li>
                    <?php endif; ?>
                </ul>
        </div>
    </div>

    <div id="sign">
        <iframe src="background.php"></iframe>
    </div>
    
    <div id="weather">
        <marquee></marquee>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        var messageList = $('#weather marquee');

        //openweathermap（天気予報API）に接続
        var request = new XMLHttpRequest();
        var targetCityName = "kyoto";
        var appId = "557b466129cf7d7427b03e5b7886a4bb";
        var owmURL = "https://api.openweathermap.org/data/2.5/weather?APPID=" + appId + "&lang=ja&units=metric&q=" + targetCityName + ",jp;";


        request.open('GET', owmURL, true);
        //結果をjson型で受け取る
        request.responseType = 'json';

        request.onload = function() {
            var data = this.response;
            console.log(data);
            var messageElement = $(
                "<span>" +
                data["name"] +
                " - " +
                data["weather"][0]["description"] +
                " | " +
                data["weather"][0]["main"] +
                " | 気温 " +
                data["main"]["temp"] +
                " ℃ | 最高気温 " +
                data["main"]["temp_max"] +
                "℃ | 最低気温 " +
                data["main"]["temp_min"] +
                "℃ | 風速 " +
                data["wind"]["speed"] +
                " ㎞ | 雲量 " +
                data["clouds"]["all"] +
                " % </span>"
            );
            //HTMLに取得したデータを追加する
            messageList.append(messageElement);
        };

        request.send();
    </script>
</body>

</html>