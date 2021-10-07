<?php

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$type = (string)filter_input(INPUT_POST, 'type'); // $_POST['type']
$info = (string)filter_input(INPUT_POST, 'info'); // $_POST['info']
$url = (string)filter_input(INPUT_POST, 'url'); // $_POST['url']

$fp = fopen('topics.csv', 'a+b');
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
  margin: 5% 5% 10%;
  font-size: 2vw;
  font-family: "YuGothic","Yu Gothic","游ゴシック体";
}
#grid div {
  position: relative;
  padding:5%;
  margin: -1px;
  border:solid #000 1px;
}
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
}

.is-hide,
.nothing,
.none,
input,
input[type="radio"]
{display:none;}

ul {padding:0; margin:0;}
li {list-style: none;}

#searchBox ul {
  position:fixed; z-index:100;
  bottom:0; left:0;
  width:95%;
  padding:1.25% 2.5%;
  margin:0;
  display: flex;
  flex-wrap: wrap;
  font-family: "YuGothic","Yu Gothic","游ゴシック体";
}
#searchBox .label,
.reset-button {
  display: inline-block;
  background-color:rgba(255,255,255,0);
  margin:0.25vw 1vw;
  padding:0.25vw 0.5vw;
  font-size: 1.5vw;
  color: #000;
  border:1px solid #000;
  border-radius:0.25vw;
  transition:1.5s all;
}
#searchBox input[type="checkbox"]:checked + label,
#searchBox input[type="radio"]:checked + label,
#searchBox .label:hover,
.reset-button:hover {
  background-color:rgba(255,255,255,1);
  cursor:pointer;
  transition:.5s all;
}

</style>
</head>
<body>

  <form id="searchBox">
  <label class="freetime" for="type"></label>
  <input type="checkbox" id="type" />
  <ul class="search-box type">
  <li>
  <input type="radio" name="type" value="topics" id="topics">
  <label for="topics" class="label">New</label></li>
  <li>
  <input type="radio" name="type" value="update" id="update">
  <label for="update" class="label">Version Up</label></li>
  <li class="reset">
  <input type="reset" name="reset" value="全部見る" class="reset-button"></li>
  </ul>
  </form>

<div id="grid">
<?php if (!empty($rows)): ?>
<?php foreach ($rows as $row): ?>
<div class="list_item list_toggle" data-type="<?=h($row[3])?>">
<p><u><?=h($row[0])?></u>
<?=h($row[1])?></p>
<span><?=h($row[3])?></span>
<a href="<?=h($row[2])?>"></a>
</div>
<?php endforeach; ?>
<?php else: ?>
<?php endif; ?>
</div>
<script src="searchBox.js"></script>
<script src="/coding/js/randomcolor.js"></script>
<script type="text/javascript">

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
