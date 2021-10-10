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
<title> 言葉の強さと方向と感情 | creative-community.space </title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="http://creative-community.space/coding/js/org.js"></script>
<link rel="stylesheet" href="/coding/fontbook/css/font-family.css"/>
<style type="text/css">
ul {padding:0; margin:0;}
li {list-style: none;}

.list #inside {
  margin:2.5rem auto;
  width:95%;
}
.list #inside ul {
  display:flex;
  align-content:flex-end;
  flex-direction: row-reverse;
  flex-wrap: wrap-reverse;
  font-family: "ipag", monospace;
  font-size:5vw;
  line-height:300%;
}
.list #inside li {
  position:relative;
  white-space:pre-wrap;
  padding:2.5vw;
}
.list .must {font-weight:900;}
.list .should {font-weight:700;}
.list .can {font-weight:500;}
.list .may {font-weight:300;}
.list .could {font-weight:200;}
.list .cant {font-weight:100;}

.list .positive {font-size:250%;}
.list .negative {font-size:50%;}
.list .both {font-size:200%;}
.list .neither {font-size:100%;}
.list .unknown {font-size:150%;}
#random a {
  text-decoration: none;
  color:#000;
}
#random a:hover {
  color:#CCC;
}
@media print{
  .list #inside li {
  width:100%;
  height:100vh;
  display:inline-block;
  padding:0;
}
}
</style>
</head>
<body>

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
</script>
</body>
</html>
