<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="このウェブサイトは、誰にでもできることを自分らしく行うことの美しさを形にするコミュニティサイトです。
やりたいことをみんなで実現するクリエイティブ・コミュニティを作りましょう。">
<title>Index | creative-community.space</title>
<link rel="icon" href="/logo.png">
<link rel="stylesheet" href="/coding/fontbook/css/font-family.css"/>
<style type="text/css">
body {margin:0; padding:0;}
.pehu {font-family: "SimSong", "MS Mincho", serif;}
#greeting {
    position: relative; z-index:10;
    width:80%;
    margin: 12.5vw 10% 10vw;
}
#greeting #hello,
#grid div,
#now,
#tobe {
    filter: invert();
}
#greeting #hello #join {
    filter: invert(1);
}
#ver #grid div:nth-child(n + 12),
#ver #searchBox .label {
  display: none;
}
#sketch {
    width: 100%;
    height: 100vh;
    position: fixed;
    top:0; left:0;
    z-index: 0;
    animation: colorchange 40s linear infinite;
}
#mobile {display:none;}
#you,
#submit {
    position: absolute;
    width:100%;
    min-height: 100vh;
    display:none;
    z-index: 100;
}
#you img {
    position: absolute;
    top: 50%;
    left: 50%;
    -webkit-transform : translate(-50%,-50%);
    transform : translate(-50%,-50%);
}
#you img {
    width: 5rem;
}

#now {
  position: fixed;
  bottom:0;
  line-height: 200%;
  font-family: "ipag", monospace;
  transform:scale(1, 1.25);
  font-size:2.5vw;
  color:#fff;
  padding:0;
  margin:0 2.5%;
  width:95%;
  display:flex;
  flex-direction:row;
  justify-content:space-between;
}

@keyframes colorchange
{
  0%   {background: rgba(255,255,255, .0);}
  25%  {background: rgba(125, 125, 215, .25);}
  50%  {background: rgba(0, 0, 0, .25);}
  75%  {background: rgba(125, 125, 125, .25);}
  100% {background: rgba(255,255,255, .0);}
}

@media print{
#index,
#greeting,
#ver #grid,
#ver #tobe,
#ver #searchBox,
#ver #searchBox,
#now
{display:none;}

#you,
#submit
{display:block;}

#submit {
    top:100vh;
    background:#fff;
}
#submit h1 {
    top:0; left:0;
    padding:5.5rem 7.5%;
    line-height:150%;
    font-size:1.5rem;
    font-family: "ipag", monospace;
}
#submit p {
    top:0; left:0;
    padding:2.5rem 7.5% 0;
    line-height:150%;
    font-size:1.25rem;
    font-family: "ipag", monospace;
}
#submit h1,
#submit p {
    display: inline-block;
    transform:scale(1, 2);
}
}
</style>
  <script>
  if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
    redirect:window.location.replace("mobile.php");
  }
  </script>
</head>
<body id="color">
<div id="greeting"></div>
<div id="ver"></div>
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
<div id="sketch"></div>

<div id="you">
<img src="/qr.png">
</div>
<div id="submit">
<h1>creative-community.space</h1>
<p>
<br/>Emergency<br/>
we.are.pe.hu@gmail.com
</p>
</div>

<script src="now.js"></script>
<script src="https://creative-community.space/coding/js/p5/sketch/sketch.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript">
$('a[href^="#"]').click(function(){
   var speed = 500;　//スクロールスピード
   var href= $(this).attr("href");
   var target = $(href == "#" || href == "" ? 'html' : href);
   var position = target.offset().top;
   $("html, body").animate({scrollTop:position}, speed, "swing");
   return false;
 });

$(document).on('mousemove', function(e){
  var hueraw = parseInt(255 - Math.round((e.pageY + 0.1) / ($(window).height()) * 255));
  var hue = '"srff"' + hueraw;

    $('#huecount').text(hueraw);
    $('#lightnesscount').text(hueraw + '%');
    $('#saturationcount').text(hueraw + '%');

    if((e.pageX <= $(window).width()/1)){
    var sraw = parseInt(100 - Math.round((e.pageX + 0.1) / ($(window).width()) * 100));
      var lraw = parseInt(Math.round((e.pageX + 0.1) / ($(window).width()) * 100));
      $('#color').css({'background': 'hsl(' + hueraw + ',' + sraw + '%,' + lraw + '%)'})
      $('#now, #mobile a').css({'color': 'hsl(' + hueraw + ',' + sraw + '%,' + lraw + '%)'})
      $('#saturationcount').text(sraw + '%');
      $('#lightnesscount').text(lraw + '%');
  }
});

var COLOURS = [ '#EEE' ];
var radius = 0;

Sketch.create({
  container: document.getElementById( 'sketch' ),
  autoclear: false,
  retina: 'auto',

  setup: function() {
    console.log( 'setup' );
  },
  update: function() {
    radius = 2 + abs( sin( this.millis * 0.003 ) * 25 );
  },

  // Event handlers
  keydown: function() {
    if ( this.keys.C ) this.clear();
  },

  touchmove: function() {

    for ( var i = this.touches.length - 1, touch; i >= 0; i-- ) {
      touch = this.touches[i];
      this.lineCap = 'round';
      this.lineJoin = 'round';
      this.fillStyle = this.strokeStyle = COLOURS[ i % COLOURS.length ];
      this.lineWidth = radius;

      this.beginPath();
      this.moveTo( touch.ox, touch.oy );
      this.lineTo( touch.x, touch.y );
      this.stroke();
    }
  }
});

$(function(){
    $("#greeting").load("hello.php");
    $("#ver").load("ver/");
})
</script>

</body>
</html>
