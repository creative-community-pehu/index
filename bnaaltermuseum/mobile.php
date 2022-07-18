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
        
        #btn {
            position: fixed;
            top: 2.5vw;
            right: 2.5vw;
            z-index: 100;
            color: #000;
            border-radius: 50%;
            text-decoration: none;
            transition: .5s all;
            width: 3vw;
            height: 3vw;
        }
        
        #btn:hover {
            cursor: pointer;
            color: #fff;
            transition: 1s all;
        }
        
        #btn b {
            position: absolute;
            padding: 0;
            margin: 0;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -webkit-transform: translate(-50%, -50%);
            font-weight: 500;
            letter-spacing: .1vw;
            font-family: "SimSong", "MS Mincho", serif;
            font-size: 2.5vw;
        }
        
        #menu {
            position: fixed;
            z-index: 100;
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
        #sign,
        #submit {
            position: fixed;
            width: 100vw;
            height: 100vh;
            top: 0;
            left: 0;
        }
        
        #background {
            z-index: -1;
        }
        
        #background iframe,
        #submit iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
        #submit,
        .open #menu {
            display: none;
        }

        .open #submit {
            z-index: 99;
            background-color: #fff;
            display: block;
        }
        
        @media screen and (max-width: 550px) {
            #btn {
                width: 2rem;
                height: 2rem;
            }
            #btn b {
                letter-spacing: .1rem;
                font-size: 1.5rem;
            }
        }
        
        @media print {
            #menu,
            #btn,
            #index {
                display: none;
            }
        }
    </style>
</head>

<body id="open">
<a id="btn"><b>⎷</b></a>

<div id="menu" class="nlc">
    <div>
        <a class="tab" href="#sign">
            <?php
            date_default_timezone_set('Asia/Tokyo');
            print(date('Y 年 n 月 j 日'). " ($week_name[$w])")
            ?>
        </a>
        <span class="check"><b>✔</b></span>
    </div>
    <div>
        <a id="showTime" class="tab" href="#flash"></a><span class="check"><b>✔</b></span>
    </div>
</div>

<div id="background"><iframe src="background.php"></iframe></div>
<div id="sign" class="change"></div>
<div id="flash" class="change"></div>
<div id="submit"><iframe src="submit/"></iframe></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">
    let btn = document.querySelector('#btn');
    let box = document.querySelector('#open');

    let btnToggleclass = function(el) {
        el.classList.toggle('open');
    }

    btn.addEventListener('click', function() {
        btnToggleclass(box);
    }, false);

    $(function() {
        $("#flash").load("flash.php");
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