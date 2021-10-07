<?php

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$type = (string)filter_input(INPUT_POST, 'type'); // $_POST['type']
$info = (string)filter_input(INPUT_POST, 'info'); // $_POST['info']
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
#grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  margin: 5%;
  border:solid #000 1px;
  font-size: 2vw;
  font-family: "YuGothic","Yu Gothic","游ゴシック体";
}
#grid div {position: relative; padding:5%;}
#grid div:first-child {
  grid-column-start: 1;
  grid-column-end: 4;
  grid-row-start: 1;
  grid-row-end: 3;
  padding:2.5%;
}

#grid div:nth-of-type(2) {
  grid-column-start: 1;
  grid-row-start: 3;
  grid-row-end: 5;
}
#grid div:nth-of-type(9) {
  grid-column-start: 2;
  grid-row-start: 5;
  grid-row-end: 7;
}
#grid div:nth-of-type(16) {
  grid-column-start: 3;
  grid-row-start: 7;
  grid-row-end: 9;
}

#grid p {
  margin: 0;
  font-family: ;
  position: relative; z-index:2;
  pointer-events:none;
  user-select:none;
}
#grid u {
  font-family:"Times New Roman", serif;
  font-style:italic;
  display: block;
}
#grid span {
  font-size: 75%;
  display: inline-block;
  padding:0.5vw 1vw;
  margin-top:2vw;
  border: 1px solid;
  border-radius: 2vw;
  font-size: 75%;
  font-family: "ipag", monospace;
  position: relative; z-index:2;
  pointer-events:none;
  user-select:none;
}
#grid a {
  display: block;
  position: absolute; z-index:1;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border:solid #000 1px;
}

</style>
</head>
<body>
<div id="grid">
<?php if (!empty($rows)): ?>
<?php foreach ($rows as $row): ?>
<div>
<p><u><?=h($row[0])?></u>
<?=h($row[1])?></p>
<span><?=h($row[3])?></span>
<a href="<?=h($row[2])?>"></a>
</div>
<?php endforeach; ?>
<?php else: ?>
<?php endif; ?>
</div>
<script src="/coding/js/randomcolor.js"></script>
<script type="text/javascript">
$(function(){
	jQuery('##grid a').css({'background':getRumRgba()});
});

$(function() {
  $('#grid a').hover(function() {
	  $(this).css({'background':getRumRgba()});
  }, function() {
	  $(this).css({'background':''});
  });
});

$(function(){
	$("#").load("");
})
</script>
</body>
</html>
