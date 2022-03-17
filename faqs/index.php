<?php

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$type = (string)filter_input(INPUT_POST, 'type');
$info = (string)filter_input(INPUT_POST, 'info');
$url = (string)filter_input(INPUT_POST, 'url');

$fp = fopen('contents.csv', 'a+b');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    flock($fp, LOCK_EX);
    fputcsv($fp, [$type, $info, $url]);
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
<title>会員になる | creative-community.space</title>
<style>

#faqs {
  display: grid;
  grid-template-columns: repeat(1, 1fr);
  margin: 5% 5% 10%;
  font-size: 1.5vw;
  font-family: "ipag", monospace;
}
#faqs div {
  position: relative;
  padding:2.5%;
  margin-bottom:-1px;
  border:solid #000 1px;
  border-collapse: collapse;
  transition:1.5s all;
}
#faqs b {
  display: inline-block;
  transform:scale(1, 1.5);
}
#faqs p {
  margin: 0;
  padding: 0 0 2vw;
  font-family: ;
  position: relative; z-index:2;
  pointer-events:none;
  user-select:none;
  white-space: pre-line;
}
#faqs span {
  display: inline-block;
  padding: 0;
  font-size: 75%;
  pointer-events:none;
  user-select:none;
  display: block;
  font-family: "YuGothic","Yu Gothic","游ゴシック体", sans-serif;
}
#faqs a {
  display: block;
  position: absolute; z-index:1;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
.none {
  pointer-events:none;
  user-select:none;
  display:none;
}
</style>
</head>
<body>
<div id="faqs">
<p><b>会員になる | Become A Free Members</b></p>
<?php if (!empty($rows)): ?>
<?php foreach ($rows as $row): ?>
<div>
<p><?=h($row[0])?></p>
<span><?=h($row[1])?></span>
<a class="<?=h($row[2])?>" href="<?=h($row[2])?>"></a>
</div>
<?php endforeach; ?>
<?php else: ?>
<?php endif; ?>
</div>
</body>
</html>
