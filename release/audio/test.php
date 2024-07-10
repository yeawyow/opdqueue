<?php
	$text = substr($_GET['words'], 0, 100);
    $lang = "th-TH";
    $file  = $text; //md5($lang."?".urlencode($text));
    $file =  $file .".mp3";
    
    //if(!is_dir("audio/"))
    //    mkdir("audio/");
    //else
    //    if(substr(sprintf('%o', fileperms('audio/')), -4)!="0777")
    //        chmod("audio/", 0777);
           // https://translate.google.com/translate_tts?ie=UTF-8&q=สวัสดีครับ&tl=th-TH&client=tw-ob

    if (!file_exists($file))
    {
        $mp3 = file_get_contents(
        'https://translate.google.com/translate_tts?ie=UTF-8&q='. urlencode($text) .'&tl='. $lang .'&client=tw-ob');
        file_put_contents($file, $mp3);
    }

?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" lang="en-US">
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" lang="en-US">
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html lang="en-US">
<!--<![endif]-->
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
<body>
<div align="center">
<audio controls="controls" autoplay="autoplay">
  <source src="<?php echo $file; ?>" type="audio/mp3" />
</audio>
</div>
<div align="center"><a href="<?php echo $file; ?>">Download File MP3 ที่ทดสอบที่นี่</a><br/>คลิกขวา เลือก Save Target As</div>
</body>
</html>