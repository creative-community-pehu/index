<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="このウェブサイトは、誰にでもできることを自分らしく行うことの美しさを形にするコミュニティサイトです。
やりたいことをみんなで実現するクリエイティブ・コミュニティを作りましょう。">
    <title>Mobile | creative-community.space</title>
    <link rel="icon" href="logo.png">
    <link rel="stylesheet" href="/coding/fontbook/css/font-family.css" />
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
        }
        
        .pehu {
            font-family: "SimSong", "MS Mincho", serif;
        }
        
        #greeting {
            position: relative;
            z-index: 10;
            width: 80%;
            margin: 12.5vw 10% 10vw;
        }
        
        iframe {
            width: 100%;
            height: 100%;
            border: none;
            border-radius: 5vw;
        }
        
        #sign a,
        #map a {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 100;
            text-decoration:none;
        }
        
        #sign {
            position: relative;
            width: 85%;
            height: 60vw;
            margin: 5vw 10% 10vw 5%;
        }

        #sign::before {
            font-family: 'Times New Roman', serif;
            font-weight: 500;
            font-stretch: condensed;
            font-variant: common-ligatures tabular-nums;
            transform: scale(1, 1.1);
            word-spacing: -0.125ch;
        }
        
        #sign::before {
            content: '色と記号で、自分の気持ちを知る・表す';
            display: block;
            position: absolute;
            top: 2.5vw;
            right: -6.5vw;
            margin: 0;
            width: 100%;
            font-size: 2.5vw;
            -ms-writing-mode: tb-rl;
            writing-mode: vertical-rl;
        }
        
        #map {
            position: relative;
            width: 90%;
            height: 55vw;
            margin: 5vw auto 10vw;
            clear: both;
        }
        
        #map::before {
            content: 'Go Out';
            display: block;
            position: absolute;
            z-index: 10;
            color: lightskyblue;
            font-size: 15vw;
            font-family: "Kristina";
            margin: 0;
            left: 50%;
            top: 45%;
            font-weight: 900;
            text-align: center;
            width: 100%;
            transition: 1s all;
            transform: translate(-50%, -50%);
            -webkit-transform: translate(-50%, -50%);
        }
        
        #map::after {
            content: '行ったことのない場所へ行く';
            display: inline-block;
            position: absolute;
            z-index: 10;
            color: #000;
            background: #fff;
            border: 1px solid #000;
            border-radius: 50%;
            padding: 0.5vw 4.5vw;
            font-size: 2.5vw;
            font-family: "DiaPro";
            margin: 0;
            left: 50%;
            top: 70%;
            transform: translate(-50%, -50%);
            -webkit-transform: translate(-50%, -50%);
        }
        
        #full {
            position: relative;
            width: 90%;
            margin: 5vw auto 10vw;
            border-radius: 5vw;
            clear: both;
        }
        
        #p5 {
            position: relative;
            width: 45%;
            height: 40vw;
            float: left;
            margin-right: 2.5vw;
            margin-bottom: 5vw;
        }
        
        h2,
        h3 {
            font-size: 4.5vw;
            text-align: center;
            font-family: "ipag", monospace;
        }
        
        h2 {
            width: 90%;
            margin: 5vw auto;
        }
        
        h3 {
            width: 45%;
            float: left;
            display: inline-block;
            margin: 1.25% 2.5% 2.5%;
        }
        
        h2 a,
        h3 a {
            display: inline-block;
            width: 90%;
            padding: 2.5% 5%;
            font-size: 55%;
            text-decoration: none;
            color: #000;
            border: #000 solid 0.45vw;
            border-radius: 5vw;
        }
        
        #now {
            position: fixed;
            top: 0;
            line-height: 200%;
            font-family: "ipag", monospace;
            transform: scale(1, 1.25);
            color: #000;
            font-size: 3vw;
            padding: 0;
            margin: 0 2.5%;
            width: 95%;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }
        hr {
            border: none;
            padding: 1.25vw;
            clear: both;
        }
    </style>
</head>

<body>
    <div id="greeting"></div>
    <div id="sign">
        <a href="/sign/"></a>
        <iframe src="/sign/flash.php"></iframe>
    </div>
    <div id="full">
        <div id="p5">
            <iframe src="/org/post/sample.html"></iframe>
        </div>
        <h3>Members Only</h3>
        <h3><a href="/org/post/">言葉の強さと方向と感情</a></h3>
    </div>
    <hr/>
    <div id="map">
        <a href="/map/"></a>
        <iframe src="/map/mov.html"></iframe>
    </div>
    <div id="full">
        <h3>Instagram</h3>
        <h3 class="rambom"><a href="https://www.instagram.com/c_c.mobile/">@c_c.mobile</a></h3>
    </div>
    <div id="now">
        <span>
            <?php
            $date = new DateTime();
            date_default_timezone_set('Asia/Tokyo');
            echo $date->format('F d, Y');
            ?>
        </span>
        <span id="showTime"></span>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="../now.js"></script>
    <script type="text/javascript">
        $(function() {
            $("#greeting").load("hello.php");
        })

        function getRumRgba() {
            var clr = 'rgba(';
            for (i = 0; i < 3; i++) {
                clr = clr + Math.floor(Math.random() * 255) + ',';
            }
            clr = clr + Math.floor(Math.random() * 10) / 10 + ')';
            return clr;
        }
        $(function() {
            jQuery('h2 a').css({
                'background': getRumRgba()
            });
            jQuery('h3 a').css({
                'background': getRumRgba()
            });
            jQuery('.rambom a').css({
                'background': getRumRgba()
            });
        })
    </script>

</body>

</html>