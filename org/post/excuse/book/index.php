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
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="../style.css" rel="stylesheet">
<title>本屋行こ</title>
<script type="text/javascript">
$(function(){
})
</script>
<style type="text/css">
</style>
</head>
<body>
<section id="submit">
<h2 class="top">本屋行こ</h2>
<form action="excuse.php" method="post">
<p class="center"><textarea name="excuse"  placeholder="ここに口実を記入してください" required></textarea></p>
<p class="bottom"><button type="submit">口実を送る</button></p>
</form>
</section>
<div id="list">
<?php if (!empty($rows)): ?>
<?php foreach ($rows as $row): ?>
<button><?=h($row[0])?></button>
<?php endforeach; ?>
<?php else: ?>
<?php endif; ?>
</div>  
<script type="text/javascript">
$(function() {
    var arr = [];
    $("#list button").each(function() {
        arr.push($(this).html());
    });
    arr.sort(function() {
        return Math.random() - Math.random();
    });
    $("#list").empty();
    for(i=0; i < arr.length; i++) {
        $("#list").append('<button>' + arr[i] + '</button>');
    }
});
</script>
</body>