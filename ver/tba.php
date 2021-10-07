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
#p5 {
    width: 100%;
    height: 100vh;
    position: fixed;
    top:0;
    z-index: -1;
}

#tba {
  display: grid;
  grid-template-columns: repeat(1, 1fr);
  margin: 5% 5% 10%;
  font-size: 1.5vw;
  font-family: "YuGothic","Yu Gothic","游ゴシック体", sans-serif;
  pointer-events:none;
  user-select:none;
}
#tba div {
  position: relative;
  padding:2.5%;
  margin-bottom:-1px;
  border:solid #000 1px;
  border-collapse: collapse;
  transition:1.5s all;
  filter: invert();
}
#tba p {
  margin: 0;
  padding: 0 0 2vw;
  font-family: ;
  position: relative; z-index:2;
  pointer-events:none;
  user-select:none;
  white-space: pre-line;
}
#tba span {
  display: inline-block;
  padding: 0;
  font-size: 55%;
  pointer-events:none;
  user-select:none;
}
#tba u {
  display: block;
  font-family:"Times New Roman", serif;
  font-style:italic;
  text-decoration:none;
}
</style>
</head>
<body>
<div id="tba">
<?php if (!empty($rows)): ?>
<?php foreach ($rows as $row): ?>
<div <?=h($row[3])?>">
<p><?=h($row[1])?></p>
<span>
<u>Members Only</u>
</span>
</div>
<?php endforeach; ?>
<?php else: ?>
<?php endif; ?>
</div>

<div id="p5"></div>

<script type="text/javascript">
$(function(){
    $("#p5").load("/coding/js/p5/sketch.html");
})
</script>
</body>
</html>
