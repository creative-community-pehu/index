<?php

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$excuse = (string)filter_input(INPUT_POST, 'excuse'); // $_POST['excuse']

$fp = fopen('excuse.csv', 'a+b');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    flock($fp, LOCK_EX);
    fputcsv($fp, [$excuse]);
    rewind($fp);
}

flock($fp, LOCK_SH);
while ($row = fgetcsv($fp)) {
    $rows[] = $row;
}
flock($fp, LOCK_UN);
fclose($fp);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device-width">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="style.css" rel="stylesheet">
<title>口実を作る by 廣野鮎美</title>
<script type="text/javascript">
$(function(){
$("#hirono").load("hirono.php");
})
</script>
<style type="text/css">
</style>
</head>
<body>
<div class="popup" id="about" style="display:none;">
<p><iframe src="about.php"></iframe></p>
<span class="close" onclick="obj=document.getElementById('about').style; obj.display=(obj.display=='none')?'block':'none';">✕</span>
</div>
<div class="base">
<div id="scaler" class="scaler">
<h1 class="top">口実を作る</h1>
<section class="section section" data-z="-0.25">
<h2 class="tate" onclick="obj=document.getElementById('about').style; obj.display=(obj.display=='none')?'block':'none';">企画：廣野鮎美</h2>
<h3 class="info" onclick="obj=document.getElementById('about').style; obj.display=(obj.display=='none')?'block':'none';">何かやりたいことがある時、口実を考える。<br/>ストレートに理由を話すのは少しくすぐったいし、今なんて特に。
<br/><br/>
だから口実を作りたい。なるべくたくさん、飽きるほど集まったら嬉しい。<br/>突拍子のない口実も、お決まりの口実も、思いつきでも、なんでも。</h3>
</section>
<section id="cover" class="section section-0" data-z="1">
</section>
<section class="section section-1" data-z="1">
<iframe src="gyoza/" scrolling="no"></iframe>
</section>
<section class="section section-2" data-z="2">
<iframe src="park/" scrolling="no"></iframe>
</section>
<section class="section section-3" data-z="3">
<iframe src="sun/" scrolling="no"></iframe>
</section>
<section class="section section-4" data-z="4">
<iframe src="book/" scrolling="no"></iframe>
</section>
<section class="section section-5" data-z="5">
<iframe src="talk/" scrolling="no"></iframe>
</section>
<section class="section section-6" data-z="6">
<iframe src="potatoes/" scrolling="no"></iframe>
</section>
<section class="section section-7" data-z="7">
<iframe src="chocolate/" scrolling="no"></iframe>
</section>
<section class="section section-8" data-z="8">
<iframe src="together/" scrolling="no"></iframe>
</section>
<section class="section section-9" data-z="9">
<iframe src="building/" scrolling="no"></iframe>
</section>
<section id="excuse" class="section section-10" data-z="10.1">
<h2 class="all"><a href="index.php" target="_parent">一つずつ</a></h2>
<div id="hirono"></div>
</section>
</div>
</div>
<div id="scroll" class="scroll"></div>
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script type="text/javascript" src="active.js"></script>
</body>