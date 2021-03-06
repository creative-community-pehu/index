<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Your Drawing is Seems So Beautiful</title>
    <link rel="icon" href="/logo.png">
    <link rel="stylesheet" href="/coding/fontbook/css/font-family.css" />
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            background: #000;
        }
        
        .hue,
        .saturation,
        .lightness {
            font-size: 2vw;
            line-height: 2.5vw;
            text-align: center;
            white-space: nowrap;
            filter: invert();
        }
        
        .hue {
            width: 100%;
            position: fixed;
            top: 2vw;
            z-index: 100;
        }
        
        .saturation,
        .lightness {
            width: 2vw;
            position: fixed;
            top: 50%;
            z-index: 100;
            transform-origin: 50% 50% 0;
            transform: translateY(-50%) translateX(-50%);
            -webkit-transform: translateY(-50%) translateX(-50%);
        }
        
        .saturation {
            transform: rotate(90deg);
            left: 2vw;
            margin-bottom: 12.5vw;
        }
        
        .lightness {
            transform: rotate(-90deg);
            right: 2vw;
            margin-top: 12.5vw;
        }
        
        #color {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            min-height: 100vh;
        }
        
        #greeting {
            position: fixed;
            z-index: 10;
            width: 80%;
            max-height: 72.5vh;
            overflow: auto;
            margin: 10vh 10% 0;
            color: #fff;
        }
        
        hr,
        .hsl {
            filter: invert();
        }
        
        #sketch {
            width: 100%;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1;
            animation: colorchange 40s linear infinite;
        }
        
        #you,
        #submit {
            position: absolute;
            width: 100%;
            min-height: 100vh;
            display: none;
            z-index: 100;
        }
        
        @media screen and (max-width: 550px) {
            #greeting {
                max-height: 55vh;
            }
        }
        
        @media print {
            #greeting,
            #menu {
                display: none;
            }
            #color {
                position: relative;
                height: 200vh;
            }
            #you,
            #submit {
                display: block;
            }
            #submit {
                top: 100vh;
                background: #fff;
            }
            #you h1 {
                bottom: 0;
                left: 0;
                width: 95%;
                padding: 0 2.5%;
                font-size: 2rem;
                position: fixed;
                display: flex;
                justify-content: space-between;
                flex-wrap: wrap;
                font-family: "ipag", monospace;
            }
            #you h1 b {
                max-width: 33.5%;
                text-align: right;
                word-break: break-word;
            }
            #submit h1 {
                top: 0;
                left: 0;
                padding: 7.5rem 20%;
                line-height: 150%;
                font-size: 1.5rem;
                font-family: "ipag", monospace;
            }
            #submit p {
                top: 0;
                left: 0;
                padding: 2.5rem 20% 0;
                line-height: 150%;
                font-size: 1.25rem;
                font-family: "ipag", monospace;
            }
            #you h1 b,
            #you h1 span,
            #submit h1,
            #submit p {
                display: inline-block;
                transform: scale(1, 2);
            }
        }
    </style>
</head>

<body id="color">
    <div id="greeting"></div>

    <div class="hue hsl">Hue <span id="huecount"></span></div>
    <div class="saturation hsl">Saturation <span id="saturationcount"></span></div>
    <div class="lightness hsl">Lightness <span id="lightnesscount"></span></div>
    <div id="you">
        <h1>
            <span>Drawing by</span>
            <span><?php echo $_SERVER['REMOTE_ADDR']; ?></span>
        </h1>
    </div>
    <div id="submit">
        <h1>OMG!<br/> Your Drawing is Seems So Beautiful<3
        <br/>Let's Print it to PDF and Send to us !!<br/>
            <a href="mailto:pehu@creative-community.space">pehu@creative-community.space</a> *
        </h1>
        <p>
            This Email address is for receive-only.<br/> We will reply from other addresses.<br/> Thank You,<br/>
            <br/> creative-community.space
        </p>
    </div>
    <div id="sketch"></div>

    <script src="https://creative-community.space/coding/js/p5/sketch/sketch.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script>
        $(function() {
            $("#greeting").load("hello.html");
        })

        $(document).on('mousemove', function(e) {
            var hueraw = parseInt(255 - Math.round((e.pageY + 0.1) / ($(window).height()) * 255));
            var hue = '"srff"' + hueraw;

            $('#huecount').text(hueraw);
            $('#lightnesscount').text(hueraw + '%');
            $('#saturationcount').text(hueraw + '%');

            if ((e.pageX <= $(window).width() / 1)) {
                var sraw = parseInt(100 - Math.round((e.pageX + 0.1) / ($(window).width()) * 100));
                var lraw = parseInt(Math.round((e.pageX + 0.1) / ($(window).width()) * 100));
                $('#color').css({
                    'background': 'hsl(' + hueraw + ',' + sraw + '%,' + lraw + '%)'
                })
                $('.hsl').css({
                    'color': 'hsl(' + hueraw + ',' + sraw + '%,' + lraw + '%)'
                })
                $('#saturationcount').text(sraw + '%');
                $('#lightnesscount').text(lraw + '%');
            }
        });

        var COLOURS = ['#EEE'];
        var radius = 0;

        Sketch.create({
            container: document.getElementById('sketch'),
            autoclear: false,
            retina: 'auto',

            setup: function() {
                console.log('setup');
            },
            update: function() {
                radius = 2 + abs(sin(this.millis * 0.003) * 25);
            },

            // Event handlers
            keydown: function() {
                if (this.keys.C) this.clear();
            },

            touchmove: function() {

                for (var i = this.touches.length - 1, touch; i >= 0; i--) {
                    touch = this.touches[i];
                    this.lineCap = 'round';
                    this.lineJoin = 'round';
                    this.fillStyle = this.strokeStyle = COLOURS[i % COLOURS.length];
                    this.lineWidth = radius;

                    this.beginPath();
                    this.moveTo(touch.ox, touch.oy);
                    this.lineTo(touch.x, touch.y);
                    this.stroke();
                }
            }
        });
    </script>

</body>

</html>