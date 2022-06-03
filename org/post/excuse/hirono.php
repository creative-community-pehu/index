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
})
</script>
<style type="text/css">
</style>
</head>
<body>
<h2 class="top" onclick="obj=document.getElementById('about').style; obj.display=(obj.display=='none')?'block':'none';">廣野鮎美の口実</h2>
<div id="all" class="center" onclick="obj=document.getElementById('about').style; obj.display=(obj.display=='none')?'block':'none';">
<?php if (!empty($rows)): ?>
<?php foreach ($rows as $row): ?>
<span><?=h($row[0])?>､</span>
<?php endforeach; ?>
<?php else: ?>
<?php endif; ?>
</div>   
<script type="text/javascript">
$(function() {
    var arr = [];
    $("#all span").each(function() {
        arr.push($(this).html());
    });
    arr.sort(function() {
        return Math.random() - Math.random();
    });
    $("#all").empty();
    for(i=0; i < arr.length; i++) {
        $("#all").append('<span>' + arr[i] + '</span>');
    }
});
</script>
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script type="text/javascript" src="active.js"></script>
</body>