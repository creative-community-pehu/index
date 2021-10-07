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
<link rel="stylesheet" href="/coding/fontbook/css/font-family.css"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width">
<title>Update | creative-community.space</title>
<style>

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
}
#tba b {
  display: inline-block;
  font-family: "ipag", monospace;
  transform:scale(1, 1.5);
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
  font-size: 75%;
  pointer-events:none;
  user-select:none;
  display: block;
  font-family:"Times New Roman", serif;
  font-style:italic;
}
</style>
</head>
<body>
<div id="tba">
<p><b>Under Construction | 準備中</b></p>
<?php if (!empty($rows)): ?>
<?php foreach ($rows as $row): ?>
<div>
<p><?=h($row[1])?></p>
<span><?=h($row[2])?></span>
</div>
<?php endforeach; ?>
<?php else: ?>
<?php endif; ?>
</div>
</body>
</html>
