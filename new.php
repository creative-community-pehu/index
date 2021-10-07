<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Index | creative-community.space</title>
<link rel="stylesheet" href="/coding/fontbook/css/font-family.css"/>
<style type="text/css">
body {margin:0; padding:0;}
.pehu {font-family: "SimSong", "MS Mincho", serif;}
#index {
    position: fixed;
    z-index: 1000;
    top:0;
}
#greeting {
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
#ver #tobe,
#ver #grid div:nth-child(n + 7) {
  display: none;
}
</style>
</head>
<body>
<div id="index"></div>
<div id="greeting"></div>
<div id="ver"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
    $("#index").load("/menu.html");
    $("#greeting").load("/hello.html");
    $("#ver").load("/ver/");
})
</script>
</body>
</html>
