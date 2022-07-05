<?php

date_default_timezone_set('Asia/Tokyo');

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$today = date("Ymd");
$symbol = (string)filter_input(INPUT_POST, 'symbol'); // $_POST['symbol']
$color = (string)filter_input(INPUT_POST, 'color'); // $_POST['color']
$timestamp = date("g:i:s A \J\S\T");
$filename =  $today . ".csv"; 

$forwardedFor = $_SERVER["REMOTE_ADDR"];
$ips = explode(",", $forwardedFor);
$ip = $ips[0];

$fp = fopen($filename, 'a+b');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    flock($fp, LOCK_EX);
    fputcsv($fp, [$symbol, $color, $timestamp, $today, $ip,]);
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
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>自分の気持ちを知る・表す</title>
        <link rel="stylesheet" type="text/css" href="gradient.css" />
    </head>

    <body>

        <span id="update">
          <b>
            <?php
            date_default_timezone_set('Asia/Tokyo');
            print(date('Y年n月j日'))
            ?>
          </b>
          <br/>
          <i>
          <?php
          $mod = filemtime($filename);
          date_default_timezone_set('Asia/Tokyo');
          print "".date("g:i:s A \J\S\T",$mod);
          ?>
          </i>
          Update
        </span>

        <div id="log" class="none">
            <ul id="log_items">
                <?php if (!empty($rows)): ?>
                <?php foreach ($rows as $row): ?>
                <li>
                    <p><u style="background:#<?=h($row[1])?>;"><span><?=h($row[0])?></span></u>
                        <b style="color:#<?=h($row[1])?>; filter: invert();"><?=h($row[4])?></b></p>
                    <p>Posted on <i><?=h($row[2])?></i></p>
                </li>
                <?php endforeach; ?>
                <?php else: ?>
                <li>
                    <p>
                        <i><?php echo $_SERVER['REMOTE_ADDR']; ?></i>
                    </p>
                </li>
                <?php endif; ?>
                <li>
                    <sup>
                      <?php
                      date_default_timezone_set('Asia/Tokyo');
                      print(date('Y年n月j日'))
                      ?>
                      の
                    </sup>
                    <br/> 気持ちを表す <b>色と記号</b>
                    <p><br/>This is The Colors and Symbols That expresses
                        <i>
                          <?php
                          date_default_timezone_set('Asia/Tokyo');
                          print(date('l jS \o\f F Y'))
                          ?>
                        </i>
                        <br/>
                    </p>
                    <hr/>
                </li>
            </ul>
        </div>

        <ul id="symbol_color">
            <li class="bg_gradient" style="background-image: linear-gradient(0deg,
            <?php if (!empty($rows)): ?>
            <?php foreach ($rows as $row): ?>
            #<?=h($row[1])?>,
            <?php endforeach; ?>
            <?php else: ?>
            <?php endif; ?>
            #fff);">
            </li>
        </ul>

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script>
            let btn = document.querySelector('#update');
            let log = document.querySelector('#log');

            let btnToggleclass = function(el) {
                el.classList.toggle('open');
            }

            btn.addEventListener('click', function() {
                btnToggleclass(log);
            }, false);
        </script>
    </body>

    </html>