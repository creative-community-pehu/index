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
    <meta http-equiv="refresh" content="60; URL=#">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="menu.css" />
    <title>自分の気持ちを知る・表す</title>
    <style type="text/css">
        .nlc {
            font-family: 'Times New Roman', serif;
            font-weight: 500;
            line-height: 200%;
            font-stretch: condensed;
            font-variant: common-ligatures tabular-nums;
            display: inline-block;
            transform: scale(1, 1.1);
            word-spacing: -.25ch;
        }
        
        #update {
            position: fixed;
            top: 1rem;
            right: 1rem;
            color: #000;
            line-height: 1.5rem;
            letter-spacing: .1rem;
            font-family: "SimSong", "MS Mincho", serif;
            font-size: 0.9rem;
            text-decoration: none;
            text-orientation: upright;
            display: inline-block;
            -ms-writing-mode: tb-rl;
            writing-mode: vertical-rl;
            transition: .5s all;
        }
        #update:hover {
            cursor:pointer;
            background:#eee;
            transition:.5s all;
        }
        
        #update b {
            font-weight: 500;
            background: #fff;
            padding: 0.5rem 0.25rem;
        }
        
        #update i {
            padding: 0.5rem 0.125rem 0.25rem;
        }
        
        #menu {
            position: fixed;
            z-index: 1000;
            bottom: 0;
            left: 0;
            width: 95%;
            padding: 0.25rem 2.5%;
            font-size: 1rem;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        
        #menu .tab {
            color: #000;
            text-decoration: none;
            transition: all 500ms ease;
        }
        
        #menu .tab:hover,
        #menu .check b {
            cursor: pointer;
            color: #fff;
            transition: all 500ms ease;
        }
        
        #menu .check {
            float: left;
            display: inline-block;
            width: 2.5rem;
            margin-right: 0rem;
            text-align: center;
        }
        
        #menu .check:before {
            content: '[';
            opacity: 1;
        }
        
        #menu .check:after {
            content: ']';
            opacity: 1;
        }
        
        .check b {
            opacity: 0;
            transition: all 1000ms ease;
        }
        
        .tab:hover+.check b {
            opacity: 1;
            transition: all 1000ms ease;
        }
        
        #background,
        #flash,
        #sign {
            position: fixed;
            width: 100%;
            height: 100vh;
            top: 0;
            left: 0;
        }
        
        #background {
            z-index: -1;
        }
        
        #flash iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
</head>

<body>
<a id="update" href="submit.html" target="_parent">
      <b>自分の気持ちを知る・表す</b>
    </a>

    <div id="menu" class="nlc">
        <div><a class="tab" href="#sign">
        <?php
        date_default_timezone_set('Asia/Tokyo');
        print(date('Y 年 n 月 j 日'). " ($week_name[$w])")
        ?></a>
        <span class="check"><b>✔</b></span>
        </div>
        <div><a id="showTime" class="tab" href="#flash"></a><span class="check"><b>✔</b></span>
        </div>
    </div>

    <div id="background"></div>
    <div id="sign" class="change"></div>
    <div id="flash" class="change"><iframe src="flash.php"></iframe></div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $("#background").load("background.php");
            $("#sign").load("log.php");
        })

        $(function() {
            $('.change').hide();

            $('.tab').on('click', function() {
                $('.change').not($($(this).attr('href'))).hide();
                $($(this).attr('href')).fadeToggle(1000);
            });
        });

        $('a[href^="#"]').click(function() {
            var href = $(this).attr("href");
            var target = $(href == "#" || href == "" ? 'html' : href);
            return false;
        });
    </script>
</body>

</html>