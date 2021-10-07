<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<title>Index | creative-community.space</title>
<style type="text/css">
body {margin:0; padding:0;}
.pehu {font-family: "SimSong", "MS Mincho", serif;}
#index {
    position: fixed;
    z-index: 100;
    top:0;
}
#greeting {
    position: relative;
    top:0;
    width:80%;
    margin: 12.5vw 10% 10vw;
}
#greeting #hello {
    filter: invert();
}
#greeting #hello #mc_embed_signup,
#greeting #hello .qr img {
    filter: invert(1);
}
#update {
    position: relative;
    top:0;
    z-index:10;
    filter: invert();
}
#update #grid div:nth-child(n + 17) {
  display: none;
}

#hsl,
#p5 {
    width: 100%;
    min-height: 100vh;
    position: fixed;
    top:0;
}
#hsl {
    z-index: -2;
    background-color: rgb(0, 0, 0);
}
#p5 {
    z-index: -1;
}

#you,
#submit {
    position: absolute;
    width:100%;
    min-height: 100vh;
    display:none;
    z-index: 100;
}
#you img {width: 7.5vw;}

@media print{
#greeting, #index {display:none;}
#you,
#submit {display:block;}
#submit {
    top:100vh;
    background:#fff;
}
#you h1 {
    bottom:0; left:0;
    width:95%;
    padding:0 2.5%;
    font-size:4.5vw;
    position: fixed;
    display: flex;
    justify-content: space-between;
    flex-wrap:wrap;
    font-family: "ipag", monospace;
}
#you h1 b {
    max-width:33.5%;
    text-align:right;
    word-break: break-word;
    
}
#submit h1 {
    top:0; left:0;
    padding:25% 7.5% 12.5%;
    line-height:150%;
    font-size:4.5vw;
    font-family: "ipag", monospace;
}
#submit p {
    top:0; left:0;
    padding:12.5% 7.5%;
    line-height:150%;
    font-size:2.5vw;
    font-family: "ipag", monospace;
}
#you h1 b,
#you h1 span,
#submit h1,
#submit p {
    display: inline-block;
    transform:scale(1, 2);
}
}
</style>
</head>
<body>
<p id="index"></div>

<div id="greeting"></div>
<div id="update"></div>
<div id="p5"></div>
<div id="hsl"></div>

<div id="you">
<h1><span>Drawing by</span>
<img src="qr.png">
<span><?php echo $_SERVER['REMOTE_ADDR']; ?></span></h1>
</div>
<div id="submit">
<h1>OMG!<br/>
Your Drawing is Seems So Beautiful<3<br/>
Print it to PDF
and Send it to us !!<br/>
<a href="mailto:pehu@creative-community.space">pehu@creative-community.space</a> *
</h1>
<p>
This Email address is for receive-only.<br/>
We will reply from other addresses.<br/>
Thank You,<br/>
<br/>
creative-community.space
</p>
</div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>
    $(function(){
    $("#index").load("menu.html");
    $("#greeting").load("hello.html");
    $("#update").load("grid/");
    $("#hsl").load("/coding/js/hsl/");
    $("#p5").load("/coding/js/p5/sketch.html");
    })

    let btn = document.querySelector('#btn');
    let index = document.querySelector('#menu');
     
    let btnToggleclass = function(el) {
      el.classList.toggle('index');
    }
     
    btn.addEventListener('click', function() {
      btnToggleclass(index);
    }, false);
</script>

<script src="/coding/js/randomcolor.js"></script>
<script type="text/javascript">
$(function(){
	jQuery('#grid a').css({'background':getRumRgba()});
});

$(function() {
  $('#grid a').hover(function() {
	  $(this).css({'background':getRumRgba()});
  }, function() {
	  $(this).css({'background':''});
  });
});

$(function(){
	$("#").load("");
})
</script>
</body>
</html>
