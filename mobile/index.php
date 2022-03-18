<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="このウェブサイトは、誰にでもできることを自分らしく行うことの美しさを形にするコミュニティサイトです。
やりたいことをみんなで実現するクリエイティブ・コミュニティを作りましょう。">
<title>Mobile | creative-community.space</title>
<link rel="icon" href="/logo.png">
<link rel="stylesheet" href="/coding/fontbook/css/font-family.css"/>
<style type="text/css">
body {margin:0; padding:0;}
.pehu {font-family: "SimSong", "MS Mincho", serif;}

#greeting #hello,
#menu,
#mobile a {
    filter: invert();
}
#greeting #hello #join {
    filter: invert(1);
}

#greeting,
#menu {
  display: none;
}

#now {
  position: fixed;
  bottom:0;
  z-index: 100;
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
#mobile {display:block;}
#mobile a {
  display: inline-block;
  transform:scale(1, 2);
  top:0; left:0;
  padding:7.5vw 7.5%;
  line-height:200%;
  font-size:4.5vw;
  font-family: "ipag", monospace;
}

#p5 {
  width: 100%;
  height: 100vh;
  position: fixed;
  top:0; left:0;
  z-index: 0;
}
@media screen and (max-width: 500px){
#hello {font-size: 125%;}
#greeting,
#menu {
  display: block;
}
#menu {
  position: relative;
  z-index: 100;
  padding: 1.25%;
  margin-bottom: 10vw;
}
#greeting {
  position: relative;
  z-index: 100;
  width:90%;
  margin: 5vw 5% 10vw;
}
#now {font-size:4.5vw;}
#mobile {display:none;}
}
</style>
</head>
<body>
<div id="p5"></div>
<div id="greeting"></div>
<div id="menu"></div>
<div id="mobile">
<a href="/">creative-community.space</a>
</div>
<div id="now">
<span><?php
$date = new DateTime();
date_default_timezone_set('Asia/Tokyo');
echo $date->format('F d, Y');
?></span>
<span id="showTime"></span>
</div>


<script src="../now.js"></script>
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
    $("#greeting").load("../hello.php");
    $("#menu").load("../menu/all.html");
    $("#p5").load("/coding/js/hsl/");
})
</script>

</body>
</html>
