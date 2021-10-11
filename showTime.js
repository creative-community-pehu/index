function set2(num) {
  // 桁数が1桁だったら先頭に0を加えて2桁に調整する
  let ret;
  if (num < 10) { ret = "0" + num; }
  else { ret = num; }
  return ret;
}
function showClock() {
  const nowTime = new Date();
  const nowHour = set2(nowTime.getHours());
  const nowMin = set2(nowTime.getMinutes());
  const nowSec = set2(nowTime.getSeconds());
  const msg = "" + nowHour + ":" + nowMin + ":" + nowSec + "";
  document.getElementById("showTime").innerHTML = msg;
}
setInterval('showClock()', 1000);
