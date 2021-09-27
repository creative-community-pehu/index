<?php

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$type = (string)filter_input(INPUT_POST, 'type'); // $_POST['type']
$info = (string)filter_input(INPUT_POST, 'onfo'); // $_POST['info']
$url = (string)filter_input(INPUT_POST, 'url'); // $_POST['url']

$fp = fopen('todo.csv', 'a+b');
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width">
<script type="text/javascript">
$(function(){
})
</script>
<title>Under Construction | creative-community.space</title>
<style>
#update {
  font-size: 2vw; padding:2.5%;
  font-family: "YuGothic","Yu Gothic","游ゴシック体";
}
#update u,
#update a {
  display:inline-block;
  text-decoration:none;
  line-height:222%;
  padding:0vw 1vw;
  margin:0.5vw 1vw 0.5vw 0;
  transform: scale(1,1);
  transition: all 500ms ease;
}
#update a {
  color:#000;
  background:rgba(255,255,255,0.75);
  border:solid #000 1px;
}
#update a:hover {
  text-decoration:none;
  padding:0.5vw 1vw;
  transform: scale(1,1.1);
  transition: all 1000ms ease;
}

</style>
</head>
<body>
<div id="update">
<u>Under Construction</u>
<?php if (!empty($rows)): ?>
<?php foreach ($rows as $row): ?>
<span class="<?=h($row[0])?>">
<a href="<?=h($row[2])?>" target="_blank" rel="noopener noreferrer">
<?=h($row[1])?>
</a>
</span>
<?php endforeach; ?>
<?php else: ?>
<?php endif; ?>
</div>
</body>
</html>
