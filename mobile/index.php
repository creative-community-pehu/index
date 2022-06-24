<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="このウェブサイトは、誰にでもできることを自分らしく行うことの美しさを形にするコミュニティサイトです。
やりたいことをみんなで実現するクリエイティブ・コミュニティを作りましょう。">
    <title>Mobile | creative-community.space</title>
    <link rel="icon" href="../logo.png">
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
        
        #sign {
            position: relative;
            width: 85%;
            height: 55vw;
            margin: 5vw 10% 5vw 5%;
            background: #000;
            border-radius: 5vw;
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
            font-family: 'Times New Roman', serif;
            font-weight: 500;
            font-stretch: condensed;
            font-variant: common-ligatures tabular-nums;
            display: inline-block;
            transform: scale(1, 1.1);
            word-spacing: -0.125ch;
            -ms-writing-mode: tb-rl;
            writing-mode: vertical-rl;
        }
        
        #full {
            position: relative;
            width: 90%;
            margin: 5vw auto;
            border-radius: 5vw;
            clear: both;
        }
        
        #p5 {
            position: relative;
            width: 45%;
            height: 40vw;
            float: left;
            background: #000;
            border-radius: 5vw;
            margin-right: 2.5vw;
            margin-bottom: 5vw;
        }
        
        h2 {
            font-family: 'Arial Narrow', sans-serif;
            width: 90%;
            margin: 5vw auto;
            text-align: center;
            font-size: 4.5vw;
        }
        
        h3 {
            font-family: 'Arial Narrow', sans-serif;
            width: 45%;
            float: left;
            display: inline-block;
            text-align: center;
            font-size: 4.5vw;
            margin: 1.25% 2.5% 2.5%;
        }
        
        h2 a,
        h3 a {
            display: inline-block;
            width: 90%;
            padding: 2.5% 5%;
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
            font-size: 2.5vw;
            padding: 0;
            margin: 0 2.5%;
            width: 95%;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }
    </style>
</head>

<body>
    <div id="greeting"></div>
    <div id="sign"></div>
    <h2><a href="/sign/">Colors and Symbols That Suits Our Feelings</a></h2>
    <div id="full">
        <div id="p5"></div>
        <h3>HTML graffiti</h3>
        <h3><a href="/thankyou/">Your Drawing is Seems So Beautiful</a></h3>
        <h3><a href="/thankyou/">Your Drawing is Seems So Beautiful</a></h3>
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
    <script type="text/javascript">
        $(function() {
            $("#greeting").load("../hello.php");
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
            jQuery('#now').css({
                'color': getRumRgba()
            });
        })
    </script>

</body>

</html>