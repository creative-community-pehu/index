<?php
function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
$org = (string)filter_input(INPUT_POST, 'org');
$is = (string)filter_input(INPUT_POST, 'is');
$motto = (string)filter_input(INPUT_POST, 'motto');
$link = (string)filter_input(INPUT_POST, 'link');
$url = (string)filter_input(INPUT_POST, 'url');

$fp = fopen('motto.csv', 'a+b');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    flock($fp, LOCK_EX);
    fputcsv($fp, [$org, $is, $motto, $link, $url]);
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
        <title>P E H U is | Things that I (We) owned</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="template/index.css" />
        <link rel="stylesheet" href="css/searchBox.css" />
        <style>
        @font-face {
            font-family: "MS Mincho";
            src: url("https://creative-community.space/coding/fontbook/family/MS%20Mincho.ttf");
        }
        
        .pehu {
            font-family: "MS Mincho", serif;
        }

        h3 {
            font-size:1.25rem;
            margin: 1rem 0;
            font-weight: 500;
        }

        </style>
    </head>

    <body>
        <ol class="org pehu">
            <h3 class="pehu">∧°┐</h3>
            <?php if (!empty($rows)): ?>
            <?php foreach ($rows as $row): ?>
            <li class="list_item list_toggle" data-org="<?=h($row[0])?>">
                <sup class="date"><?=h($row[1])?></sup>
                <p class="info">
                    <span class="pehu"><?=h($row[2])?></span>
                </p>
                <a class="<?=h($row[3])?>" href="<?=h($row[4])?>" target="_blank"></a>
            </li>
            <?php endforeach; ?>
            <?php else: ?>
            <li class="list_item list_toggle" data-org="test">
                <sup class="date">date</sup>
                <p class="info">
                    <span class="pehu">Infomation</span>
            </p>
            </li>
            <?php endif; ?>
        </ol>
    </body>

    </html>