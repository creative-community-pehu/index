<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="style.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<title>Index | creative-community.space</title>
<style type="text/css">
body {margin:0; padding:0;}
.pehu {font-family: "SimSong", "MS Mincho", serif;}
#btn {
    position: fixed;
    z-index: 100;
    margin:2.5vw;
    font-size:4.5vw;
}
#btn a {
    display: block;
    text-align: center;
    width: 5vw;
    height: 5vw;
    line-height: 5.5vw;
    border: solid 0.25vw #000;
    border-radius: 50%;
    font-family:Arial, sans-serif;
    cursor: pointer;
    transition: all 1000ms ease;
}
#btn a:hover {
    color:#fff;
    background-color:blue;
    border: solid 0.25vw blue;
    cursor: pointer;
    transition: all 1000ms ease;
}
.none {
    z-index: 99;
    width: 100%;
    height: 0;
    opacity: 0;
    overflow-y: auto;
    transition: all 1500ms ease;
    position: fixed;
}
.index {
    z-index: 99;
    width: 100%;
    height: 100vh;
    opacity: 1;
    overflow-y: auto;
    transition: all 2500ms ease;
    position: fixed;
    background-color: #fff;
}
#pehu {margin-top: 10vw;}
#greeting {
    position: absolute;
    width:80%;
    margin: 12.5vw 10% 5vw;
}
#greeting #hello {
    filter: invert();
}
#greeting #hello #mc_embed_signup,
#greeting #hello .qr img {
    filter: invert(1);
}
#hsl,
#p5 {
    width: 100%;
    height: 100vh;
    position: fixed;
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
#greeting, #btn, #menu {display:none;}
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
#submit h1 {
    top:0; left:0;
    width:95%;
    padding:2.5%;
    font-size:4.5vw;
    position: fixed;
    display: flex;
    justify-content: space-between;
    flex-wrap:wrap;
    font-family: "ipag", monospace;
}
#you h1 span,
#submit h1 span {
    transform:scale(1, 2);
}
}
</style>
</head>
<body>
<p id="btn"><a>?</a></p>
<div id="menu" class="none">
<div id="pehu"></div>
<div id="inside">
<div><a onclick="window.print();" class="tab"
    onmouseover="this.innerText='Print Your Drawing'"
	onmouseout="this.innerText='あなたの絵を出力する'">
    あなたの絵を出力する</a><span class="check"><b>✔</b></span></div>
</div>
<!--
<div><a href="/coding/" class="tab"
    onmouseover="this.innerText='How to Coding'"
	onmouseout="this.innerText='ウェブサイトを作る'">
    ウェブサイトを作る</a><span class="check"><b>✔</b></span></div>
-->
</div>

<div id="you">
<h1><span>Drawing by</span>
<img src="qr.png">
<span><?php echo $_SERVER['REMOTE_ADDR']; ?></span></h1>
</div>
<div id="submit">
<h1><span>OMG!</span><br/>
Your Drawing is So Beautiful<3<br/>
Please send to us
Your Drawing <span>Printed to PDF</span><br/>
<br/>
<span>we.are.pe.hu@gmail.com</span>
</h1>
</div>

<div id="greeting"></div>
<div id="p5"></div>
<div id="hsl"></div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>
    $(function(){
    $("#pehu").load("/pehu/menu.html");
    $("#greeting").load("hello.html");
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
</body>
</html>
