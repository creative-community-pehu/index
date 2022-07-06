<?php

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$title = (string)filter_input(INPUT_POST, 'type');
$info = (string)filter_input(INPUT_POST, 'info');
$url = (string)filter_input(INPUT_POST, 'url');

$fp = fopen('contents.csv', 'a+b');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    flock($fp, LOCK_EX);
    fputcsv($fp, [$title, $info, $url]);
    rewind($fp);
}
flock($fp, LOCK_SH);
while ($row = fgetcsv($fp)) {
    $rows[] = $row;
}
flock($fp, LOCK_UN);
fclose($fp);

?>
<html>
<head>
<link rel="stylesheet" href="/coding/fontbook/css/font-family.css"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width">
<title>会員になる | creative-community.space</title>
<style>

#faqs {
  display: grid;
  grid-template-columns: repeat(1, 1fr);
  margin: 2.5% 4.5% 4.5%;
  font-size: 1.5vw;
  font-family: "YuGothic","Yu Gothic","游ゴシック体", sans-serif;
}
#faqs b,
#faqs u {
  display: inline-block;
  transform:scale(1, 1.5);
  font-family: "ipag", monospace;
}
#faqs u {
  font-size:150%;
  padding-right: 1vw;
}
#faqs p {
  margin: 0;
  padding: 2.5vw 0 2.5vw;
  white-space: pre-line;
}
#faqs span {
  display: inline-block;
  padding: 0;
  font-size: 75%;
  pointer-events:none;
  user-select:none;
  display: block;
  font-family: "YuGothic","Yu Gothic","游ゴシック体", sans-serif;
}

#faqs div {
  position: relative;
  padding:2.5%;
  margin-bottom:-1px;
  border:solid 1px;
  border-collapse: collapse;
  transition:1.0s all;
}
#faqs div:hover {
  filter: invert(75%);
}
#faqs div p {
  padding: 0 0 2.5vw;
  position: relative;
  z-index: 2;
  pointer-events:none;
  user-select:none;
}
#faqs div a {
  display: block;
  position: absolute; z-index:1;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
.none {
  pointer-events:none;
  user-select:none;
  display:none;
}

.pehu {
  font-size: 125%;
  font-family: "MS Mincho", "SimSong", serif;
}
.nlc {
  font-size: 150%;
  font-family: 'Times New Roman', serif;
  font-weight:500;
  font-stretch: condensed;
  font-variant: common-ligatures tabular-nums;
  display:inline-block;
  transform: scale(1,1.1);
  letter-spacing: -.05rem;
  word-spacing: -.05rem;
}

.cc {
    font-family: "ipag", monospace;
    transform:scale(1, 1.25);
}
#bottom_btn {
    position: fixed;
    bottom:0.5rem; right:1rem;
    z-index: 1000;
    margin:0 0.5rem;
}
#bottom_btn a {
    display: block;
    text-align: center;
    font-size: 2rem;
    width: 3.5rem;
    height: 2.75rem;
    line-height: 2.75rem;
    color: #000;
    text-decoration:none;
    border: solid 1px #000;
    border-radius: 50%;
    cursor: pointer;
    transition: all 1000ms ease;
}
#bottom_btn a:hover {
    color:#fff;
    background-color:blue;
    border: solid 1px blue;
    cursor: pointer;
    transition: all 1000ms ease;
}

@media screen and (max-width: 1000px){
  #faqs {
  font-size: 1.75vw;
}
#faqs p {
  line-height: 200%;
}
}

@media screen and (max-width: 550px){
  #faqs {
  font-size: 2.5vw;
}
}
</style>
</head>
<body>

<div id="faqs">
<p><u>creative-community.space</u> は、 <a class="pehu">∧°┐</a> が運営する <b>会員制コミュニティサイト</b> です。<br/>
<b>is Community Site for <a class="nlc">New Life Collection</a> Members Only</b> (fees free)</p>
<p>誰にでもできることを自分らしく行うことの美しさを形にする会員限定オンラインコンテンツを運営する他、会員のみが参加できる特別イベントの開催／こ・こ・ろ・豊かな新しい生活をご提案する特集記事の発表などを行い、技術や知識がなくても誰もが平等に参加できるさまざまな「場」をつくることに挑戦します。</p>
<div>
<p>会員になる | Become a Members</p>
<span>入会を希望される方は、リンク先 の入力フォームに Eメールアドレス を入力後、自動返信メールから会員登録へお進みください。</span>
<a target="_parent" href="https://pehu.cart.fc2.com/signup"></a>
</div>
<div>
<p>ログイン | Log In</p>
<span>会員ページにログインすると、限定コンテンツや特別イベントへアクセスできます。</span>
<a target="_parent" href="https://newlifecollection.com/login_redirect"></a>
</div>
<hr/>
<p><br/><b>会員限定 | Members Only</b><br/>
コミュニティ会員限定コンテンツ／サービス一覧</p>
<?php if (!empty($rows)): ?>
<?php foreach ($rows as $row): ?>
<div>
<p><?=h($row[0])?></p>
<span><?=h($row[1])?></span>
<a class="<?=h($row[2])?>" href="<?=h($row[2])?>"></a>
</div>
<?php endforeach; ?>
<?php else: ?>
<?php endif; ?>
<hr/>
<p>※ 会員情報／会員限定コンテンツは、<a class="pehu">∧°┐</a> が運営するオウンドメディア <a class="nlc">newlifecollection.com</a> と連動し、運営・管理しています。</p>
<p id="bottom_btn"><a class="cc" href="#" onClick="history.back(); return false;" target-"_parent">CC</a></p>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
    $("#").load("");
})
</script>
</html>