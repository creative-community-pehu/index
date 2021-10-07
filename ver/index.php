<?php

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$type = (string)filter_input(INPUT_POST, 'type');
$info = (string)filter_input(INPUT_POST, 'info');
$url = (string)filter_input(INPUT_POST, 'url');
$members = (string)filter_input(INPUT_POST, 'members');

$fp = fopen('topics.csv', 'a+b');
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
#ver {
    margin: 2.5vw 0 5vw;
}
#tba {
  filter: invert();
}

#hsl {
    width: 100%;
    height: 100vh;
    max-height: 100vh;
    position: fixed;
    top:0;
    z-index: -2;
    background-color: rgb(0, 0, 0);
}

#grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  padding: 2.5%;
  margin: 2.5%;
  font-size: 2vw;
  font-family: "YuGothic","Yu Gothic","游ゴシック体", sans-serif;
}
#grid div {
  position: relative;
  padding:5%;
  margin:0 0 -1px -1px;
  border:solid #000 1px;
  border-collapse: collapse;
  transition:1.5s all;
  filter: invert();
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
#grid div:nth-of-type(8) {
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
#grid span {
  display: inline-block;
  padding: 2vw 0.5vw;
  font-size: 55%;
  position: absolute; z-index:2;
  bottom:0; right:0;
  pointer-events:none;
  user-select:none;
}
#grid u {
  display: inline-block;
  padding:0.5vw 1vw;
  margin: 0.25vw;
  border: 1px solid;
  border-radius: 2vw;
  box-shadow:0.25vw 0.5vw 0 #000;
  text-decoration:none;
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
.nothing{
  opacity:0;
  transition:1.5s all;
  pointer-events:none;
  user-select:none;
}

.none,
input,
input[type="radio"],
.reset
{display:none;}

ul {padding:0; margin:0;}
li {list-style: none;}

#searchBox ul {
  position:fixed; z-index:100;
  bottom:0; left:0;
  width:95%;
  margin: 1.25% 2.5%;
  display: flex;
  flex-wrap: wrap;
  font-family: "ipag", monospace;
  transform:scale(1, 1.5);
  filter: invert();
}
#searchBox .label,
input[type="reset"] {
  display: inline-block;
  margin:0.25vw 1vw;
  padding:0.25vw 0.5vw;
  font-size: 2vw;
  color: #000;
  text-decoration:none;
  border-bottom:1px solid transparent;
  transition:1.5s all;
}
#searchBox input[type="checkbox"]:checked + label,
#searchBox input[type="radio"]:checked + label,
#searchBox .label:hover,
.reset-button:hover {
  cursor:pointer;
  text-shadow: 0px 0px 0.1vw #fff, 0.1vw 0.25vw 0 #fff;
  border-bottom:1px solid #000;
  transition:.5s all;
}

</style>
</head>
<body>
<div id="grid">
<div>
<p><i>Update | 更新情報</i></p>
<span>
<u style="display:inline;">View All | 全部見る</u>
</span>
<a href="/ver/"></a>
</div>
<?php if (!empty($rows)): ?>
<?php foreach ($rows as $row): ?>
<div class="list_item list_toggle <?=h($row[3])?>" data-type="<?=h($row[3])?>">
<p><i><?=h($row[0])?></i>
<?=h($row[1])?>
</p>
<span>
<u style="display:<?=h($row[4])?>;">Members Only</u>
</span>
<a href="<?=h($row[2])?>"></a>
</div>
<?php endforeach; ?>
<?php else: ?>
<?php endif; ?>
</div>
<div id="tobe"></div>

  <form id="searchBox">
  <label class="update" for="type"></label>
  <input type="checkbox" id="type" />
  <ul class="search-box type">
  <li>
  <a href="#grid" class="label">Update</a></li>
  <li>
  <input type="radio" name="type" value="news" id="news">
  <label for="news" class="label">New Contents</label></li>
  <li>
  <input type="radio" name="type" value="upgrade" id="upgrade">
  <label for="upgrade" class="label">Version Up</label></li>
  <li class="reset">
  <input type="reset" name="reset" value="" class="reset-button"></li>
  </ul>
  </form>

<div id="hsl"></div>

<script src="/ver/searchBox.js"></script>
<script src="/coding/js/randomcolor.js"></script>
<script type="text/javascript">

$(function() {
  $('#grid a').hover(function() {
	  $(this).css({'background':getRumRgba()});
  }, function() {
	  $(this).css({'background':''});
  });
});

$('a[href^="#"]').click(function(){
   var speed = 500;　//スクロールスピード
   var href= $(this).attr("href");
   var target = $(href == "#" || href == "" ? 'html' : href);
   var position = target.offset().top;
   $("html, body").animate({scrollTop:position}, speed, "swing");
   return false;
 });

$(function(){
    $("#tobe").load("/ver/tba.php");
    $("#hsl").load("/coding/js/hsl/");
})
</script>
</body>
</html>
