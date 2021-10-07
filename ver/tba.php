<?php

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$type = (string)filter_input(INPUT_POST, 'type');
$info = (string)filter_input(INPUT_POST, 'info');
$url = (string)filter_input(INPUT_POST, 'url');
$members = (string)filter_input(INPUT_POST, 'members');

$fp = fopen('tobe.csv', 'a+b');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    flock($fp, LOCK_EX);
    fputcsv($fp, [$type, $info, $url, $members]);
    rewind($fp);
}
flock($fp, LOCK_SH);
while ($row = fgetcsv($fp)) {
    $rows[] = $row;
}
flock($fp, LOCK_UN);
fclose($fp);

?>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="/coding/fontbook/css/font-family.css"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width">
<title>Update | creative-community.space</title>
<style>
#tba {
  display: grid;
  grid-template-columns: repeat(1, 1fr);
  margin: 5% 5% 10%;
  font-size: 2vw;
  font-family: "YuGothic","Yu Gothic","游ゴシック体", sans-serif;
  user-select:none;
  white-space: pre-line;
}
#tba div {
  position: relative;
  padding:5%;
  margin:0 0 -1px -1px;
  border:solid #000 1px;
  border-collapse: collapse;
  transition:1.5s all;
  filter: invert();
}
#tba p {
  margin: 0;
  padding: 0 0 5vw;
  font-family: ;
  position: relative; z-index:2;
  pointer-events:none;
  user-select:none;
  white-space: pre-line;
}
#grid i {
  font-family:"Times New Roman", serif;
  font-style:italic;
  display: block;
}
#tba span {
  display: inline-block;
  padding: 2vw 0.5vw;
  font-size: 55%;
  position: absolute; z-index:2;
  bottom:0; right:0;
  pointer-events:none;
  user-select:none;
}
#tba u {
  display: inline-block;
  padding:0.5vw 1vw;
  margin: 0.25vw;
  border: 1px solid;
  border-radius: 2vw;
  box-shadow:0.25vw 0.5vw 0 #000;
  text-decoration:none;
}
</style>
</head>
<body>
<div id="tba">
<?php if (!empty($rows)): ?>
<?php foreach ($rows as $row): ?>
<div <?=h($row[3])?>">
<p><i><?=h($row[0])?></i>
<?=h($row[1])?>
</p>
<span>
<u>Members Only</u>
</span>
</div>
<?php endforeach; ?>
<?php else: ?>
<?php endif; ?>
</div>

<script type="text/javascript">
$(function(){
    $("#").load("");
})
</script>
</body>
</html>
