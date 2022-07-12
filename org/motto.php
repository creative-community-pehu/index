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

        h3 {
            font-family: "MS Mincho", serif;
            font-size:1.25rem;
            margin: 1rem 0.5rem;
            font-weight: 500;
            transition: all 1000ms ease;
        }

        .org li:hover h3 {
            color: #aaa;
            transition: all 500ms ease;
        }

        </style>
    </head>

    <body>
        <ol class="org">
            <?php if (!empty($rows)): ?>
            <?php foreach ($rows as $row): ?>
            <li class="list_item list_toggle" data-org="<?=h($row[0])?>">
                <h3 style="text-align:center;"><?=h($row[2])?></h3>
            </li>
            <?php endforeach; ?>
            <?php else: ?>
            <li class="list_item list_toggle" data-org="test">
                <h3 style="text-align:center;">P E H U is</h3>
            </li>
            <?php endif; ?>
        </ol>

    <script type="text/javascript ">
        var volume;
        var synth;
        var notes;

        $(document).ready(function(event) {
            // StartAudioContext(Tone.context, window);  
            $(window).click(function() {
                Tone.context.resume();
            });

            volume = new Tone.Volume(-10);
            synth = new Tone.PolySynth(10, Tone.Synth).chain(volume, Tone.Master);
            notes = Tone.Frequency("E6").harmonize([12, 14, 16, 19, 21, 24]);
        });

        $(".list_toggle").hover(function() {
            let randNote = Math.floor(Math.random() * notes.length);
            synth.triggerAttackRelease(notes[randNote], "6n");
        });
    </script>
    </body>

    </html>