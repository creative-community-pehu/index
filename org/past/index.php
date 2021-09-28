<?php
function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
$how = (string)filter_input(INPUT_POST, 'how');
$what = (string)filter_input(INPUT_POST, 'what');
$date = (string)filter_input(INPUT_POST, 'date');
$info = (string)filter_input(INPUT_POST, 'info');
$more = (string)filter_input(INPUT_POST, 'more');

$fp = fopen('past.csv', 'a+b');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    flock($fp, LOCK_EX);
    fputcsv($fp, [$how, $what, $date, $info, $more]);
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
<title>FREE TIME | したこと</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="FREE TIME | 何かする時間">

<script src="../js/ityped.js"></script>
<link rel="stylesheet" href="../css/ityped.css"/>
<link rel="stylesheet" href="../css/org.css"/>
<link rel="stylesheet" href="/coding/fontbook/css/font-family.css"/>
<style>

#org ul {
  flex-direction: row-reverse;
  flex-wrap: wrap-reverse;
}
#cover_freetime {
  max-height: 100vw;
}
.freetime:after {
  content:"chotto crazy";
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
  animation:2.5s linear infinite cc;
}
@-webkit-keyframes cc {
  0% {
    font-family: "Quarantype";
    top: 50%; left: 50%;
  }
  25% {
    font-family: "MESS";
    top: 25%; left: 50%;
  }
  50% {
    font-family: "inscrutable";
    top: 50%; left: 50%;
  }
  75% {
    font-family: "Orchard";
    top: 75%; left: 50%;
  }
  100% {
    font-family: "Quarantype";
    top: 50%; left: 50%;
  }
}
#back {
  position:fixed;
  margin: 2.5%;
  left:0; bottom:0;
  z-index: 100;
}
#back a {
  color:red;
  font-size:2rem;
  text-decoration:none;
  animation:2.5s linear infinite fontmotion;
}

</style>
  
</head>
<body>
<div id="freetime_menu"></div>

<div id="header">
<u>これまで</u>
<u>したこと</u>
</div>

<div id="list">
<div id="cover_freetime">
<div class="content">
<span>何か</span>
<div id="index">
  <form id="information">
  <div class="menu">
  <label class="freetime" for="past"></label>
  <input type="checkbox" id="past" />
  <ul class="search-box past" id="click">
<li>
<input type="radio" name="past" value="create" id="create">
<label for="create" class="label">作った 壊した</label></li>
<li>
<input type="radio" name="past" value="music" id="music">
<label for="music" class="label">音を出した 聞いた</label></li>
<li>
<input type="radio" name="past" value="image" id="image">
<label for="image" class="label">見た 撮影した</label></li>
<li>
<input type="radio" name="past" value="sports" id="sports">
<label for="sports" class="label">運動した</label></li>
<li>
<input type="radio" name="past" value="challenge" id="challenge">
<label for="challenge" class="label">練習した 挑戦した</label></li>
<li>
<input type="radio" name="past" value="communication" id="communication">
<label for="communication" class="label">書いた 読んだ 話した</label></li>
  </ul>
  </div>
  <div class="reset">
  <input type="reset" name="reset" value="全部見る" class="reset-button">
  </div>
  </form>
</div>
</div>
</div>

<div id="org">
<ul>
<?php if (!empty($rows)): ?>
<?php foreach ($rows as $row): ?>
<li class="list_item list_toggle" data-past="<?=h($row[0])?>">
<p class="what"><?=h($row[1])?></p>
<span class="date"><?=h($row[2])?></span>
<div class="info">
<span><?=h($row[3])?></span>
<a class="<?=h($row[4])?>" href="<?=h($row[4])?>" target="_blank"></a>
</div>
</li>
<?php endforeach; ?>
<?php else: ?>
<li class="list_item list_toggle" data-past="<?=h($row[0])?>">
<p class="what">できること</p>
<span class="date">カテゴリー</span>
<div class="info">
<span>説明</span>
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
});
</script>
<script src="../js/searchBox.js"></script>
</body>
</html>
