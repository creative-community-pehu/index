<?php

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
$link = (string)filter_input(INPUT_POST, 'link'); // $_POST['link']

$fp = fopen('all.csv', 'a+b');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    flock($fp, LOCK_EX);
    fputcsv($fp, [$link]);
    rewind($fp);
}
flock($fp, LOCK_SH);
while ($row = fgetcsv($fp)) {
    $rows[] = $row;
}
flock($fp, LOCK_UN);
fclose($fp);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Everyones Drawings are So Beautiful</title>
    <style type="text/css">
#p5,
#hsl {
    width: 100%;
    height: 100vh;
    position: fixed;
    top:0; left:0;
}
#p5
    z-index: 0;
}
#hsl {
    z-index: -1;
}

.library {
  position:relative;
    z-index:0;
}
.library li:first-child {
    width:100vw;
    overflow:auto;
    pointer-evente:none;
    user-select:none;
}
.library li{
    width:67vh;
    max-width:90vw;
    height: 94vh;
    overflow:hidden;
}
#you,
#submit {
    position: absolute;
    width:100%;
    min-height: 100vh;
    display:none;
    z-index: 100;
}
#you img {width: 3.5rem;}

@media print{
.mousedragscrollable
{display:none;}

#you,
#submit
{display:block;}

#submit {
    top:100vh;
    background:#fff;
}
#you h1 {
    bottom:0; left:0;
    width:95%;
    padding:0 2.5%;
    font-size:2rem;
    position: fixed;
    display: flex;
    justify-content: space-between;
    flex-wrap:wrap;
    font-family: "ipag", monospace;
}
#you h1 b {
    max-width:33.5%;
    text-align:right;
    word-break: break-word;
    
}
#submit h1 {
    top:0; left:0;
    padding:5.5rem 7.5%;
    line-height:150%;
    font-size:1.5rem;
    font-family: "ipag", monospace;
}
#submit p {
    top:0; left:0;
    padding:2.5rem 7.5% 0;
    line-height:150%;
    font-size:1.25rem;
    font-family: "ipag", monospace;
}
#you h1 b,
#you h1 span,
#submit h1,
#submit p {
    display: inline-block;
    transform:scale(1, 2);
}
}
    </style>
    
    <!-- Import the webpage's stylesheet -->
    <link rel="stylesheet" href="style.css" />
  
  </head>
  <body>
    <div id="p5"></div>
    <div id="hsl"></div>

<div id="you">
<h1><span>Drawing by</span>
<img src="/qr.png">
<span><?php echo $_SERVER['REMOTE_ADDR']; ?></span></h1>
</div>
<div id="submit">
<h1>OMG!<br/>
Your Drawing is Seems So Beautiful<3<br/>
Print it to PDF
and Send it to us !!<br/>
<a href="mailto:pehu@creative-community.space">pehu@creative-community.space</a> *
</h1>
<p>
This Email address is for receive-only.<br/>
We will reply from other addresses.<br/>
Thank You,<br/>
<br/>
creative-community.space
</p>
</div>

    <ul class="mousedragscrollable library">
    <li></li>
      <?php if (!empty($rows)): ?>
        <?php foreach ($rows as $row): ?>
          <li><iframe src="<?=h($row[0])?>"></iframe></li>
          <?php endforeach; ?>
        <?php else: ?>
      <?php endif; ?>
    </ul>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="/coding/js/mousedragscrollable/scrollable.js"></script>
<script type="text/javascript">
$(function(){
    $("#p5").load("/coding/js/p5/sketch.html");
    $("#hsl").load("/coding/js/hsl/");
})
</script>
  </body>
</html>
