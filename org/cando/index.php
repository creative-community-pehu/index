<?php
function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
$how = (string)filter_input(INPUT_POST, 'how');
$what = (string)filter_input(INPUT_POST, 'what');
$date = (string)filter_input(INPUT_POST, 'date');
$info = (string)filter_input(INPUT_POST, 'info');
$info_more = (string)filter_input(INPUT_POST, 'info_more');
$pro = (string)filter_input(INPUT_POST, 'pro');
$pro_more = (string)filter_input(INPUT_POST, 'pro_more');
$link = (string)filter_input(INPUT_POST, 'link');
$url = (string)filter_input(INPUT_POST, 'url');
$id = (string)filter_input(INPUT_POST, 'id');

$fp = fopen('cando.csv', 'a+b');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    flock($fp, LOCK_EX);
    fputcsv($fp, [$how, $what, $date, $info, $info_more, $pro, $pro_more, $link, $url, $id]);
    rewind($fp);
}

flock($fp, LOCK_SH);
while ($row = fgetcsv($fp)) {
    $rows[] = $row;
}
flock($fp, LOCK_UN);
fclose($fp);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<title>したいこと | creative-community.space</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="FREE TIME | 何かする時間">

<script src="../js/ityped.js"></script>
<link rel="stylesheet" href="../css/ityped.css"/>
<link rel="stylesheet" href="../css/org.css"/>
<link rel="stylesheet" href="/coding/fontbook/css/font-family.css"/>

<style>
#cover_freetime {max-height:100vw;}
#org ul {
  flex-direction: row-reverse;
  flex-wrap: wrap-reverse;
}
#org li {
  border:dotted 2px #fff;
  padding:1rem;
  transition: all 500ms ease;
  animation:5s linear infinite radius;
}
#org li:hover {
  cursor: help;
  border:dotted 2px red;
  border-radius: 50% 20% / 10% 40%;
  transition: all 750ms ease;
}

@-webkit-keyframes radius {
  0% {
    border-radius: 50% 20% / 10% 40%;
  }
  25% {
    border-radius: 30% 40% / 20% 30%;
  }
  50% {
    border-radius: 10% 50% / 40% 10%;
  }
  75% {
    border-radius: 25% 45% / 30% 20%;
  }
  100% {
    border-radius: 50% 20% / 10% 40%;
  }
}

.freetime:after {
  content:"Want to do";
  font-size: 7rem;
  color: #fff;
  text-shadow: 0 0 1vw red;
  text-align: center;
  position:absolute;
  z-index:0;
  user-select:none;
  pointer-events:none;
  top: 50%; left: 50%;
  -webkit-transform:translate(-50%,-50%);
  transform:translate(-50%,-50%);
  width:125%;
  animation:2.5s linear infinite fontmotion;
}

.what p {
  font-size:100%;
  margin: 0;
  transform:scale(1, 1.25);
}
.name {
  font-size:75%;
  margin: 0;
}
.name b {
  color:red;
  font-size:125%;
  padding: 0.25rem;
  margin: 0;
  transform:scale(1, 1.25);
}
.info {white-space:pre-wrap;}

.pro {
  width:100%;
  color:red;
  margin:0.25rem 0;
}
.pro b {
  padding:0.5rem;
  border:solid 1px;
  position: relative;
  display : inline-block;
  font-size:75%;
  white-space:pre-wrap;
}
.pro a {
  position: absolute;
  top: 0;
  left: 0;
  padding:0;
  margin: 0;
  height:100%;
  width: 100%;
}
#back {
  position:fixed;
  margin: 2.5%;
  left:0; bottom:0;
  z-index: 100;
}
#back a {
  color:red;
  font-size:1.5rem;
  text-decoration:none;
  animation:2.5s linear infinite fontmotion;
}

</style>
  
</head>
<body>
<div id="freetime_menu"></div>

<div id="header">
<u>みんなの</u>
<u>したいこと</u>
</div>

<div id="list">
<div id="cover_freetime">
<div class="content">
<span>何か</span>
<div id="index">
  <form id="information">
  <div class="menu">
  <label class="freetime" for="cando"></label>
  <input type="checkbox" id="cando" />
  <ul class="search-box cando" id="click">
  <li>
  <input type="radio" name="cando" value="create" id="create">
  <label for="create" class="label">作ったり 壊したり</label></li>
  <li>
  <input type="radio" name="cando" value="music" id="music">
  <label for="music" class="label">音を出したり 聞いたり</label></li>
  <li>
  <input type="radio" name="cando" value="publication" id="publication">
  <label for="publication" class="label">印刷したり 出版したり</label></li>
  <li>
  <input type="radio" name="cando" value="broadcast" id="broadcast">
  <label for="broadcast" class="label">見たり 撮影したり</label></li>
  <li>
  <input type="radio" name="cando" value="food" id="food">
  <label for="food" class="label">料理したり</label></li>
  <li>
  <input type="radio" name="cando" value="sports" id="sports">
  <label for="sports" class="label">運動したり 休憩したり</label></li>
  <li>
  <input type="radio" name="cando" value="relax" id="relax">
  <label for="relax" class="label">休憩したり</label></li>
  <li>
  <input type="radio" name="cando" value="fantasy" id="fantasy">
  <label for="fantasy" class="label">空想したり</label></li>
  <li>
  <input type="radio" name="cando" value="research" id="research">
  <label for="research" class="label">調べたり</label></li>
  <li>
  <input type="radio" name="cando" value="communication" id="communication">
  <label for="communication" class="label">書いたり 話したり</label></li>
  <li>
  <input type="radio" name="cando" value="challenge" id="challenge">
  <label for="challenge" class="label">挑戦 実験したり</label></li>
  </ul>
  </div>
  <span>したい</span>
  <div class="reset">
  <input type="reset" name="reset" value="全部見る" class="reset-button">
  </div>
  </form>
</div>
</div>
</div>

<div id="org">
<ul class="random">
<?php if (!empty($rows)): ?>
<?php foreach ($rows as $row): ?>
<li class="list_item list_toggle" data-cando="<?=h($row[0])?>" onclick="obj=document.getElementById('<?=h($row[9])?>').style; obj.display=(obj.display=='none')?'block':'none';">
<div class="what">
<p><?=h($row[1])?></p>
</div>

<div id="<?=h($row[9])?>" class="more" style="display:none;">
<p class="info" style="display:<?=h($row[4])?>;"><?=h($row[3])?></p>
<p class="name">これは<b><?=h($row[2])?></b>のしたいこと</p>
<span class="pro" style="display:<?=h($row[6])?>;">
<b>
<?=h($row[5])?>
<a style="display:<?=h($row[7])?>;" href="<?=h($row[8])?>" target="_blank" rel="noopener noreferrer"></a>
</b>
</span>
</div>
</li>
<?php endforeach; ?>

<?php else: ?>
<li class="list_item list_toggle" data-cando="<?=h($row[0])?>" onclick="obj=document.getElementById('<?=h($row[9])?>').style; obj.display=(obj.display=='none')?'block':'none';">
<div class="info">
<p>実現したいこと</p>
</div>

<div id="<?=h($row[9])?>" class="more" style="display:none;">
<p class="info" style="display:<?=h($row[4])?>;"><?=h($row[3])?></p>
<p class="name">これは<b>名前</b>のしたいこと</p>
<span class="pro" style="display:<?=h($row[6])?>;">
<b>プロフィール
<a style="display:<?=h($row[7])?>;" href="<?=h($row[8])?>" target="_blank" rel="noopener noreferrer"></a>
</b>
</span>
</div>
</li>
<?php endif; ?>
</ul>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
$("#freetime_menu").load("../menu.html");
})

function shuffleContent(container) {
  var content = container.find("> *");
  var total = content.length;
  content.each(function() {
    content.eq(Math.floor(Math.random() * total)).prependTo(container);
  });
}
$(function() {
  shuffleContent($(".random"));
});
</script>
<script src="../js/searchBox.js"></script>
</body>
</html>
