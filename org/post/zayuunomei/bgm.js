document.addEventListener('click', audioPlay);
function audioPlay() {
  document.getElementById('audio').play();
  document.removeEventListener('click', audioPlay);
}

function sound()
{
	// 対象となるID名
	var id = 'sound-file' ;

	// 初回以外だったら音声ファイルを巻き戻す
	if( typeof( document.getElementById( id ).currentTime ) != 'undefined' )
	{
		document.getElementById( id ).currentTime = 0;
	}

	// [ID:sound-file]の音声ファイルを再生[play()]する
	document.getElementById( id ).play() ;
}