<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="/coding/hello/close_open.css"/>
<title> HTML graffiti </title>
<style type="text/css">
#hello u, #hello i {font-family:"Times New Roman", serif; font-size: 110%;}

#p5,
#hsl {
    width: 100%;
    height: 100vh;
    position: fixed;
    top:0;
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
#contents
{display:none;}

#you,
#submit
{display:block;}

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
    padding:12.5% 7.5%;
    line-height:150%;
    font-size:4.5vw;
    font-family: "ipag", monospace;
}
#submit p {
    top:0; left:0;
    padding:10% 7.5% 5%;
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
<div id="contents">
<div id="hello">
<b>HTML graffiti</b>
<p>
<u data-click="create">鼻歌</u>
みたいな、
<b id="create" class="open">beautiful things by</b>
<u data-click="communicate">落書き</u>
みたいな、 
<b id="communicate" class="open">through the things that everyone can do</b>
<b id="here" class="open">to Do the things that you want to do</b>
<u data-click="how">ウェブサイト</u>
を展示します。
</p>
<p class="singup"><a href="http://chottocrazy.pe.hu/2021/online/" target="_blank">もっと見る</a></p>
</div>
</div>
<div id="hsl"></div>
<div id="p5"></div>

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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="/coding/hello/open_close.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>
    $(function(){
    $("#p5").load("/coding/js/p5/sketch.html");
    $("#hsl").load("coding/js/hsl/");
    })
</script>
</body>
</html>
