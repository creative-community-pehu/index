<?php
function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
$how = (string)filter_input(INPUT_POST, 'how');
$what = (string)filter_input(INPUT_POST, 'what');
$date = (string)filter_input(INPUT_POST, 'date');
$info = (string)filter_input(INPUT_POST, 'info');
$more = (string)filter_input(INPUT_POST, 'more');

$fp = fopen('template.csv', 'a+b');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    flock($fp, LOCK_EX);
    fputcsv($fp, [$how, $what, $date, $info, $more]);
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
<html lang="ja">

<head>
    <title>Things that I (We) owned | creative-community.space</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
</head>

<body>

    <header id="header">
        <a class="_more" onclick="more()">私（わたしたち）が所有するもの</a>
        <marquee>Greeting</marquee>
        <nav id="nav">
            <h1 class="nlc_style">Things that I (We) owned</h1>
            <h1 id="presents">
                <b class="cc_style">「私（わたしたち）が所有するもの」</b>
                <br/><span class="cc_style">説明</span>
            </h1>
            <form>
                <ol class="search-box org">
                    <li>index</li>
                    <li>
                        <input type="radio" name="org" value="test" id="test">
                        <label for="test" class="label">test</label>
                    </li>
                    <li class="reset">
                        <input type="reset" name="reset" value="全部見る" class="reset-button">
                    </li>
                </ol>
            </form>
        </nav>
    </header>

    <main id="main">
        <ul class="mousedragscrollable">
            <li class="list">
                <h2>ORG</h2>
                <ol class="org">
                    <?php if (!empty($rows)): ?>
                    <?php foreach ($rows as $row): ?>
                    <li class="list_item list_toggle" data-org="<?=h($row[0])?>">
                        <p class="what">
                            <?=h($row[1])?>
                        </p>
                        <sup class="date"><?=h($row[2])?></sup>
                        <div class="info">
                            <span><?=h($row[3])?></span>
                        </div>
                        <a class="<?=h($row[4])?>" href="<?=h($row[4])?>" target="_parent"></a>
                    </li>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <li class="list_item list_toggle" data-org="test">
                        <p class="what">What</p>
                        <sup class="date">date</sup>
                        <div class="info">
                            <span>Infomation</span>
                        </div>
                    </li>
                    <?php endif; ?>
                </ol>
            </li>
            <li class="list">
                <h2>このウェブサイトについて</h2>
                <p id="greeting"></p>
                <hr/>
                <p>
                    Download
                    <br/> index.php
                </p>
            </li>
        </ul>
    </main>

    <footer id="footer">
        <address id="address" class="cc_style">
          LINKS
          <a class="cc_style">HyperLink</a><br/>
          <?php
          echo 'IP : '. $_SERVER['REMOTE_ADDR']." | ";
          echo 'PORT : '. $_SERVER['REMOTE_PORT'].".";
          echo 'USER : '. $_SERVER['HTTP_USER_AGENT']." | ";
          ?>
        </address>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/template.js"></script>
    <script src="js/searchBox.js"></script>
    <script src="js/mousedragscrollable.js"></script>
    <script type="text/javascript ">
        $('a[href^="# "]').click(function() {
            var href = $(this).attr("href ");
            var target = $(href == "# " || href == " " ? 'html' : href);
            return false;
        });
    </script>
</body>

</html>