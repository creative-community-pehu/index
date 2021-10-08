<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<title>Everyones Drawings are So Beautiful</title>
<link rel="stylesheet" href="/coding/fontbook/css/font-family.css"/>
<style type="text/css">
body {margin:0; padding:0;}
#greeting {
    position: relative; z-index:10;
    width:80%;
    margin: 12.5vw 10% 10vw;
}
#greeting #hello,
hr {
    filter: invert();
}

#p5 {
    width: 100%;
    height: 100vh;
    position: fixed;
    top:0; left:0;
    z-index: 0;
}
#hsl {
    width: 100%;
    height: 100vh;
    max-height: 100vh;
    position: fixed;
    top:0; z-index: -2;
    background-color: rgb(0, 0, 0);
}

#you,
#submit {
    position: absolute;
    width:100%;
    min-height: 100vh;
    display:none;
    z-index: 100;
}
#you img {width: 3.5rem;}

@media print{
#greeting
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
    font-size:2rem;
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

<div id="greeting"></div>
<div id="hsl"></div>
<div id="p5"></div>

<div id="you">
<h1><span>Drawing by</span>
<img src="/qr.png">
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
    $("#greeting").load("/thankyou/hello.html");
    $("#p5").load("/coding/js/p5/sketch.html");
    $("#hsl").load("/coding/js/hsl/");
    })
</script>

</body>
</html>
