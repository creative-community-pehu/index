<?php
function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
$org = (string)filter_input(INPUT_POST, 'org');
$is = (string)filter_input(INPUT_POST, 'is');
$motto = (string)filter_input(INPUT_POST, 'motto');
$link = (string)filter_input(INPUT_POST, 'link');
$url = (string)filter_input(INPUT_POST, 'url');

$fp = fopen('list.csv', 'a+b');
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
        h3 {
            font-size:1rem;
            margin: 0.5rem 0;
            font-weight: 500;
            display: inline-block;
            font-family: "Arial Narrow",monospace;
            transform: scale(1, 1.25);
        }
        </style>
    </head>

    <body>
        <ol class="org">
            <h2>Websites</h2>
            <?php if (!empty($rows)): ?>
            <?php foreach ($rows as $row): ?>
            <li class="list_item list_toggle" data-org="<?=h($row[0])?>">
                <h3><?=h($row[2])?></h3>
                <a class="<?=h($row[3])?>" href="<?=h($row[4])?>" target="_blank"></a>
            </li>
            <?php endforeach; ?>
            <?php else: ?>
            <li class="list_item list_toggle" data-org="test">
                <h3>Title</h3>
            </li>
            <?php endif; ?>
        </ol>
    </body>

    </html>