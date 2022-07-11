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
    <title>Things that I (We) owned</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="template/index.css" />
    <link rel="stylesheet" href="css/searchBox.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <style>
        @font-face {
            font-family: "ipag";
            src: url("https://creative-community.space/coding/fontbook/family/IPA/ipag.ttf");
        }
        
        @font-face {
            font-family: "MS Mincho";
            src: url("https://creative-community.space/coding/fontbook/family/MS%20Mincho.ttf");
        }
        
        header,
        header marquee,
        #main {
            border-bottom: 1px dashed #ccc;
        }
        
        header a,
        header label,
        footer a {
            color: #ccc;
        }
        
        header a:hover,
        header label:hover,
        footer a:hover {
            color: #aaa;
        }
        
        .nlc_style,
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
        
        .nlc_style {
            display: inline-block;
        }
        
        .cc_style,
        form,
        marquee,
        .mousedragscrollable p {
            display: inline-block;
            font-family: "ipag", monospace;
            transform: scale(1, 1.25);
        }
        
        .vg_style {
            font-family: 'Great Vibes', cursive;
            transform: scale(1, 1.5);
            display: inline-block;
        }
        
        .pehu {
            font-family: "MS Mincho", serif;
        }
        
        #bought:checked~label,
        #gift:checked~label,
        #free:checked~label,
        #made:checked~label,
        #collaborations:checked~label,
        #other:checked~label,
        #sale:checked~label {
            text-decoration: double underline;
        }
        
        .mousedragscrollable .list {
            width: 20rem;
            max-width: 95vw;
            border-right: 1px solid #ccc;
        }
        
        header a:hover,
        header label:hover,
        footer a:hover {
            color: #aaa;
            text-decoration: wavy underline;
            cursor: pointer;
        }
        
        hr {
            border: none;
        }
        
        #print {
            display: none;
        }

        @media print {
            #address {
                display: none;
            }
            #print {
                display: block;
            }
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="greeting.js"></script>
    <script src="js/searchBox.js"></script>
    <script src="../www/scrollable.js"></script>
</head>

<body>

    <header id="header">
        <a class="_more" onclick="more()">私（わたしたち）が所有するもの</a>
        <marquee>会期：2022年7月23日（土）〜 8月21日（日） | 会場：BnA Alter Museum</marquee>
        <nav id="nav">
            <h1>Things that I (We) owned</h1>
            <p id="presents">
                <b class="cc_style">私（わたしたち）が所有するもの</b>
                <br/><span class="cc_style">会期：2022年7月23日（土）〜 8月21日（日）</span>
                <br/><span class="cc_style">会場：BnA Alter Museum</span>
            </p>
            <form>
                <ol class="search-box">
                    <li>index</li>
                    <li>
                        <input type="radio" name="org" value="bought" id="bought">
                        <label for="bought" class="label">bought</label>
                    </li>
                    <li>
                        <input type="radio" name="org" value="gift" id="gift">
                        <label for="gift" class="label">gift</label>
                    </li>
                    <li>
                        <input type="radio" name="org" value="free" id="free">
                        <label for="free" class="label">free or found</label>
                    </li>
                    <li>
                        <input type="radio" name="org" value="made" id="made">
                        <label for="made" class="label">made</label>
                    </li>
                    <li>
                        <input type="radio" name="org" value="collaborations" id="collaborations">
                        <label for="collaborations" class="label">collaborations</label>
                    </li>
                    <li>
                        <input type="radio" name="org" value="other" id="other">
                        <label for="other" class="label">other</label>
                    </li>
                    <li>
                        <input type="radio" name="org" value="sale" id="sale">
                        <label for="sale" class="label">$$$ FOR SALE $$$</label>
                    </li>
                    <li class="reset">
                        <input type="reset" name="reset" value="View All" class="reset-button cc_style">
                    </li>
                </ol>
            </form>
        </nav>
    </header>

    <main id="main">
        <ul class="mousedragscrollable">
        </ul>
    </main>

    <footer id="footer">
        <address id="print">
            <hr/>
            <img src="https://bnaaltermuseum.com/wp-content/themes/bna_kyoto/img/logo_bam.svg" width="200rem" alt="BnA Alter Museum">
            <a href="<?php echo $_SERVER['REQUEST_URI'];?>">
            <?php
            echo $_SERVER['SERVER_NAME'];
            echo $_SERVER['REQUEST_URI'];
            ?>
            </a>
        </address>
        <address id="address">
          <span>URL : </span>
          <a href="<?php echo $_SERVER['REQUEST_URI'];?>">
              <?php
              echo $_SERVER['SERVER_NAME'];
              echo $_SERVER['REQUEST_URI'];
              ?>
          </a>
          <br/>
          <span>
              <?php
              echo 'IP : '. $_SERVER['REMOTE_ADDR']." | ";
              echo 'PORT : '. $_SERVER['REMOTE_PORT']." | ";
              echo ''. $_SERVER['HTTP_USER_AGENT'].".";
              ?>
          </span>
        </address>
    </footer>

    <script type="text/javascript ">
        $(function() {
            $("#").load("");
        })

        $('a[href^="# "]').click(function() {
            var href = $(this).attr("href ");
            var target = $(href == "# " || href == " " ? 'html' : href);
            return false;
        });
    </script>
</body>

</html>