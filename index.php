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
#greeting #hello {
    filter: invert();
}
#greeting #hello #join {
    filter: invert(1);
}
#ver #grid div:nth-child(n + 17),
#ver #searchBox .label {
  display: none;
}
#p5 {
    width: 100%;
    height: 100vh;
    position: fixed;
    top:0; left:0;
    z-index: 0;
}
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
  padding:0;
  margin:0 2.5%;
  width:95%;
  display:flex;
  flex-direction:row;
  justify-content:space-between;
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
@media screen and (max-width: 500px){
  #greeting,
  #ver,
  #p5 {
  display: none;
}
#now {font-size:1rem;}

#mobile
{display:block;}

#mobile h1 {
    padding:0 7.5% 2.5rem;
    line-height:150%;
    font-size:1.5rem;
    font-family: "ipag", monospace;
}
#mobile p {
    top:0; left:0;
    padding:2.5rem 7.5%;
    line-height:150%;
    font-size:1.25rem;
    font-family: "ipag", monospace;
}
#mobile h1,
#mobile p {
    display: inline-block;
    transform:scale(1, 2);
}
#mobile a {
    color:blue;
}
}
</style>
</head>
<body>
<div id="greeting"></div>
<div id="ver"></div>
<div id="p5"></div>
<div id="now">
<span><?php
$date = new DateTime();
date_default_timezone_set('Asia/Tokyo');
echo $date->format('F d, Y');
?></span>
<span id="showTime"></span>
</div>

<div id="you">
<img src="/qr.png">
</div>
<div id="mobile">
<p>for Mobile</p>
<h1><a href="/faqs/">creative-community.space/faqs/</a></h1>
<p>
<br/>Instagram
<a href="https://www.instagram.com/c_c.mobile/">@c_c.mobile</a>
</p>
</div>
<div id="submit">
<h1>creative-community.space</h1>
<p>
<br/>Emergency<br/>
we.are.pe.hu@gmail.com
</p>
</div>

<script src="now.js"></script>
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

$(function(){
    $("#greeting").load("/hello.php");
    $("#ver").load("/ver/");
    $("#p5").load("/coding/js/p5/sketch.html");
})
</script>

</body>
</html>
