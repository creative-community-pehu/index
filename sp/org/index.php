<?php
function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
$word = (string)filter_input(INPUT_POST, 'word');
$weight = (string)filter_input(INPUT_POST, 'weight');
$size = (string)filter_input(INPUT_POST, 'size');
$feel = (string)filter_input(INPUT_POST, 'feel');

$fp = fopen('org.csv', 'a+b');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    flock($fp, LOCK_EX);
    fputcsv($fp, [$word, $weight, $size, $feel,]);
    rewind($fp);
}

flock($fp, LOCK_SH);
while ($row = fgetcsv($fp)) {
    $rows[] = $row;
}
flock($fp, LOCK_UN);
fclose($fp);

?>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title> 感想 | 新しい生活を集める </title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="http://creative-community.space/coding/js/org.js"></script>
<script type="text/javascript">
$(function(){
$("#org_emoji").load("submit.html");
})
</script>
<link rel="stylesheet" href="submit.css"/>
<link rel="stylesheet" href="/coding/fontbook/css/font-family.css"/>
<style type="text/css">
.cc {
    font-family: "ipag", monospace;
    transform:scale(1, 1.25);
}
#top_btn {
    position: fixed;
    bottom:0;
    z-index: 1000;
    margin:2.5vw;
    font-size:4.5vw;
}
#top_btn a {
    display: block;
    text-align: center;
    width: 7.5vw;
    height: 6vw;
    line-height: 6vw;
    color:#000;
    border: solid 0.25vw #000;
    border-radius: 50%;
    cursor: pointer;
    text-decoration:none;
    transition: all 1000ms ease;
}
#top_btn a:hover {
    color:#fff;
    background-color:blue;
    border: solid 0.25vw blue;
    cursor: pointer;
    transition: all 1000ms ease;
}

#random a {
  text-decoration: none;
  color:#000;
}
#random a:hover {
  color:#CCC;
}
@media print{
#org_header {display:none;}
}
</style>
</head>
<body>
<p id="top_btn"><a class="cc" href="/">CC</a></p>
<div id="org_header">
<span class="reset">
<input type="reset" name="reset" value="全部見る" class="reset-button">
</span>
<a onclick="obj=document.getElementById('org_members').style; obj.display=(obj.display=='none')?'block':'none';">投稿フォーム</a>
</div>

<div id="org_emoji"></div>

<div class="list">
<div id="inside">
<ul id="random" class="random">
<?php if (!empty($rows)): ?>
<?php foreach ($rows as $row): ?>
<li class="list_item list_toggle" data-weight="<?=h($row[1])?>" data-size="<?=h($row[2])?>" data-feel="<?=h($row[3])?>"><span class="<?=h($row[1])?> <?=h($row[2])?>"><a href="https://www.google.com/search?q=<?=h($row[0])?>" target="_blank" rel="noopener noreferrer"><?=h($row[0])?></a></span></li>
<?php endforeach; ?>
<?php else: ?>
<li class="list_item list_toggle" data-weight="<?=h($row[1])?>" data-size="<?=h($row[2])?>" data-feel="<?=h($row[3])?>"><span class="<?=h($row[1])?> <?=h($row[2])?>"><a href="https://www.google.com/search?q=keyword" target="_blank" rel="noopener noreferrer">keyword</a></span></li>
<?php endif; ?>
</ul>
</div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript">
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
$(function(){
   // #で始まるアンカーをクリックした場合に処理
   $('a[href^=#]').click(function() {
      // スクロールの速度
      var speed = 1500; // ミリ秒
      // アンカーの値取得
      var href= $(this).attr("href");
      // 移動先を取得
      var target = $(href == "#" || href == "" ? 'html' : href);
      // 移動先を数値で取得
      var position = target.offset().top;
      // スムーススクロール
      $('body,html').animate({scrollTop:position}, speed, 'swing');
      return false;
   });
});
</script>
</body>
</html>
