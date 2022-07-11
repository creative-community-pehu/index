<?php
function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
$org = (string)filter_input(INPUT_POST, 'org');
$what = (string)filter_input(INPUT_POST, 'what');
$info = (string)filter_input(INPUT_POST, 'info');
$link = (string)filter_input(INPUT_POST, 'link');
$url = (string)filter_input(INPUT_POST, 'url');

$fp = fopen('index.csv', 'a+b');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    flock($fp, LOCK_EX);
    fputcsv($fp, [$org, $what, $info, $link, $url]);
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
<title>Template | Things that I (We) owned</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="/org/template/index.css" />
<link rel="stylesheet" href="/org/css/searchBox.css" />
<style>
header,
header marquee,
#main {
    border-bottom: 1px dashed #ccc;
}

header a,
header label,
footer a {
    color: #ccc;
    text-decoration: none;
    transition: all 1000ms ease;
}

header a:hover,
header label:hover,
footer a:hover {
    color: #333;
    text-decoration: wavy underline;
    cursor: pointer;
}

h1,
h2 {
    font-family: 'Times New Roman', serif;
    font-weight: 500;
    font-stretch: condensed;
    font-variant: common-ligatures tabular-nums;
    transform: scale(1, 1.1);
    letter-spacing: -0.1rem;
    word-spacing: -.1ch;
}

form,
marquee,
#presents,
.mousedragscrollable p,
#footer span,
#footer a, {
    display: inline-block;
    font-family: "Arial Narrow",monospace;
    transform: scale(1, 1.25);
}

#test:checked~label {
    text-decoration: double underline;
}

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="greeting.js"></script>
<script src="/org/js/searchBox.js"></script>
<script src="/www/scrollable.js"></script>
</head>

<body>

    <header id="header">
        <a class="_more" onclick="more()">私（わたしたち）が所有するもの</a>
        <marquee>PHP | CSV ファイル を 使って、所有するもののコレクションページを作成する</marquee>
        <nav id="nav">
            <h1>Things that I (We) owned</h1>
            <p id="presents">
                <b>私（わたしたち）が所有するもの</b>
                <br/><span>Things that I (We) owned</span>
                <br/>
                <span>
                    <?php
                    echo $_SERVER['SERVER_NAME'];
                    ?>
                </span>
                </p>
            <form>
                <ol class="search-box">
                    <li>index</li>
                    <li>
                        <input type="radio" name="org" value="php" id="php">
                        <label for="php" class="label">php</label>
                    </li>
                    <li>
                        <input type="radio" name="org" value="csv" id="csv">
                        <label for="csv" class="label">csv</label>
                    </li>
                    <li>
                        <input type="radio" name="org" value="css" id="css">
                        <label for="css" class="label">css</label>
                    </li>
                    <li>
                        <input type="radio" name="org" value="js" id="js">
                        <label for="js" class="label">JavaScript</label>
                    </li>
                    <li class="reset">
                        <input type="reset" name="reset" value="View All" class="reset-button">
                    </li>
                </ol>
            </form>
        </nav>
    </header>

    <main id="main">
        <ul class="mousedragscrollable">
            <li class="collection">
                <ol class="org">
                <h2>How to Coding</h2>
                    <?php if (!empty($rows)): ?>
                    <?php foreach ($rows as $row): ?>
                    <li class="list_item list_toggle" data-org="<?=h($row[0])?>">
                        <p class="what"><?=h($row[1])?></p>
                        <sup class="date"><?=h($row[0])?></sup>
                        <div class="info"><span><?=h($row[2])?></span></div>
                        <a class="<?=h($row[3])?>" href="<?=h($row[4])?>" target="_parent"></a>
                    </li>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <li class="list_item list_toggle" data-org="test">
                        <p class="what">What</p>
                        <sup class="date">date</sup>
                        <div class="info"><span>Infomation</span></div>
                    </li>
                    <?php endif; ?>
                </ol>
            </li>
        </ul>
    </main>

    <footer id="footer">
        <address id="address">
          <span>LINKS</span>
          <a>HyperLink</a><br/>
          <span>
              USER 
              <?php
              echo 'IP : '. $_SERVER['REMOTE_ADDR']." | ";
              echo 'PORT : '. $_SERVER['REMOTE_PORT']." | ";
              echo ''. $_SERVER['HTTP_USER_AGENT'].".";
              ?>
        </span>
        </address>
    </footer>

    <script type="text/javascript ">
        $('a[href^="# "]').click(function() {
            var href = $(this).attr("href ");
            var target = $(href == "# " || href == " " ? 'html' : href);
            return false;
        });
    </script>
</body>

</html>