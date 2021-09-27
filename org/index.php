<?php
function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
$how = (string)filter_input(INPUT_POST, 'how');
$what = (string)filter_input(INPUT_POST, 'what');
$date = (string)filter_input(INPUT_POST, 'date');
$info = (string)filter_input(INPUT_POST, 'info');
$more = (string)filter_input(INPUT_POST, 'more');

$fp = fopen('org.csv', 'a+b');
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
<title>FREE TIME | creative-community.space</title>

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
  flex-direction: row;
  flex-wrap: wrap;
}

.freetime:after {
  content:"We Can Do";
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
  
<div id="header">
<u>できること</u>
<u>機材・ツール一覧</u>
</div>

<p id="back"><a href="/org/">FREE TIME</a></p>

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
  <label for="create" class="label">作る 壊す</label></li>
  <li>
  <input type="radio" name="cando" value="print" id="print">
  <label for="print" class="label">印刷する 出版する</label></li>
  <li>
  <input type="radio" name="cando" value="image" id="image">
  <label for="image" class="label">撮影する 見る</label></li>
  <li>
  <input type="radio" name="cando" value="music" id="music">
  <label for="music" class="label">音を出す 聞く</label></li>
  <li>
  <input type="radio" name="cando" value="communication" id="communication">
  <label for="communication" class="label">書く 読む 話す</label></li>
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
<li class="list_item list_toggle" data-cando="<?=h($row[0])?>">
<p class="what"><?=h($row[1])?></p>
<span class="date"><?=h($row[2])?></span>
<div class="info">
<span><?=h($row[3])?></span>
<a class="<?=h($row[4])?>" href="<?=h($row[4])?>" target="_parent"></a>
</div>
</li>
<?php endforeach; ?>
<?php else: ?>
<li class="list_item list_toggle" data-cando="<?=h($row[0])?>">
<p class="what">機材名</p>
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
<script src="../js/searchBox.js"></script>
</body>
</html>
