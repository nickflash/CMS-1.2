<?
function db() {
$host="localhost";
$user ="root";
$pass="";
$db="cms";
$connect = mysql_connect($host,$user,$pass) or die(mysql_error());
  mysql_select_db($db ,$connect);
  
  mysql_query("SET CHARACTER SET utf8_unicode_ci");
  mysql_query("SET CHARACTER_SET_CLIENT=utf8_unicode_ci");
  mysql_query("SET CHARACTER_SET_RESULTS=utf8_unicode_ci");
  mysql_query("SET CHARACTER_SET_CONNECTION=utf8_unicode_ci");
  mysql_query("SET NAMES utf8 ");
}
?><?
//error_reporting(0);

define("K_ver","2.00");
define("SYS_ver","1.01");
define("_YEAR_",date("Y"));


function getCurrentDirectory($file) {
	$path = dirname($file);
	$position = strrpos($path,'/') + 1;
	return substr($path,$position);
}


function fulladress() {
$d = explode("/",$_SERVER['PHP_SELF']);

if ($d[1]!=NULL) {
$dir = $d[1]."/";
}
return "http://".$_SERVER['HTTP_HOST']."/$dir"; 
} 

function createthumb($name,$filename,$new_w,$new_h){
	$system=explode('.',$name);
	if (preg_match('/jpg|jpeg/',$system[1])){
		$src_img=imagecreatefromjpeg($name);
	}//big jpg
	if (preg_match('/JPG|JPEG/',$system[1])){
		$src_img=imagecreatefromjpeg($name);
	}
	if (preg_match('/png/',$system[1])){
		$src_img=imagecreatefrompng($name);
	}//big png
	if (preg_match('/PNG/',$system[1])){
		$src_img=imagecreatefrompng($name);
	}//big gif
	if (preg_match('/GIF/',$system[1])){
		$src_img=imagecreatefromgif($name);
	}//
	if (preg_match('/gif/',$system[1])){
		$src_img=imagecreatefromgif($name);
	}
	
	$old_x=imageSX($src_img);
$old_y=imageSY($src_img);
if ($old_x > $old_y) {
	$thumb_w=$new_w;
	$thumb_h=$old_y*($new_h/$old_x);
}
if ($old_x < $old_y) {
	$thumb_w=$old_x*($new_w/$old_y);
	$thumb_h=$new_h;
}
if ($old_x == $old_y) {
	$thumb_w=$new_w;
	$thumb_h=$new_h;
}

$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
	imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 

	if (preg_match("/png/",$system[1]) or preg_match("/PNG/",$system[1]))
{
	imagepng($dst_img,$filename); 
} else {
	imagejpeg($dst_img,$filename); 
}
imagedestroy($dst_img); 
imagedestroy($src_img); 
}

function createThumbs( $pathToImages, $pathToThumbs, $thumbWidth ) {
  // Отваря директорията
  $dir = opendir( $pathToImages );

  // преглежда директорията с цикъл и изважда jpg файловете:
  while (false !== ($fname = readdir( $dir ))) {
    // Парсва пътя на файла
    $info = pathinfo($pathToImages . $fname);

	if (!file_exists($pathToThumbs.$fname)) {
	
    if ( strtolower($info['extension']) == 'jpg' )
    {

      // load image and get image size
      $img = imagecreatefromjpeg( "{$pathToImages}{$fname}" );
      $width = imagesx( $img );
      $height = imagesy( $img );

      // calculate thumbnail size
      $new_width = $thumbWidth;
      $new_height = floor( $height * ( $thumbWidth / $width ) );

      // create a new temporary image
      $tmp_img = imagecreatetruecolor( $new_width, $new_height );

      // copy and resize old image into new image
      imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

      // save thumbnail into a file
      imagejpeg( $tmp_img, "{$pathToThumbs}{$fname}" );
    }
	
	 }
  }
  // close the directory
  closedir( $dir );
}
function createCrop ($filename, $newname) {

// Get dimensions of the original image
list($current_width, $current_height) = getimagesize($filename);
 
// The x and y coordinates on the original image where we
// will begin cropping the image
$left = rand(100,$current_width);
$top = rand(100,$current_height);
 
// This will be the final size of the image (e.g. how many pixels
// left and down we will be going)
$crop_width = 350;
$crop_height = 260;
 
// Resample the image
$canvas = imagecreatetruecolor($crop_width, $crop_height);
$current_image = imagecreatefromjpeg($filename);
imagecopy($canvas, $current_image, 0, 0, $left, $top, $current_width, $current_height);
imagejpeg($canvas, $newname, 100);
} 
/* CREATE TABLE IF NOT EXISTS menu (
id int(8) not null auto_increment,
name longtext not null,
link longtext not null,
title longtext not null,
PRIMARY KEY (id)
);*/

//TEMPLATE FUNCTIONS
function menu ($type=NULL,$b=NULL,$other=NULL,$tag=NULL) {
if ($type == "h") {
$br = "";
}
if ($type == "v") {
$br = "<br />";
}
if (isset($b)) {
$bullet = "<img border=\"0\" src=\"$b\" alt=\"\" />";
}
if (preg_match("<div>",$tag)) {
 $close = "</div>";
}
else {
$close = "";
}
$sql = mysql_query("SELECT * FROM menu WHERE active='yes' ORDER by id") or die(mysql_error());
while($row = mysql_fetch_array($sql)) {

echo "$tag $bullet <a href='$row[link]' $other title='' >$row[name]</a>$close $br";
   }
}

function content ($get=NULL) {
$sql = mysql_query("SELECT * FROM siteconfig");
while ($row=mysql_fetch_array($sql)) {
if (!isset($get) && is_numeric($row[index_page])) {
@include("modules/custompages/module.php");
if (!file_exists("modules/custompages/module.php")) {
echo "<center>Несъществуващ или неактивен модул!</center>";
  }
 }
}
if (isset($get)) {
//malko za6titi
$get = str_replace("../","",$get);
$get = str_replace("./","",$get);
$get = str_replace("/","",$get);
@include("modules/$get/module.php");
if (!file_exists("modules/$get/module.php")) {
echo "<center>Несъществуващ или неактивен модул!</center>";
   }
  }
}

function title () {
$sql = mysql_query("SELECT * FROM siteconfig");
while ($row=mysql_fetch_array($sql)) {
return $row["name"];
}
}
 
function user_panel() {

 if (isset($_SESSION["user"])) { 
  echo WELCOME_LOGIN." <a  style=\"color:blue;\" href='?m=user&action=profile&id=".$_SESSION["id"]."'>".$_SESSION["user"]."</a> , <a href='?m=user&action=logout' style=\"color:red;\">[".LOGOUT."]</a>"; 
  }
  if (!isset($_SESSION["user"])) { 
   echo "<a href=\"?m=user&action=login\">".LOGIN."</a> | <a href=\"?m=user&action=register\">".REGISTRATION."</a> ";
  }
}

function plugin($modname=NULL) {
 $path = "modules/$modname/plugin.php";
 if ($modname==NULL) {
  echo "Моля задайте име на модул!";
 } 
 if (!file_exists($path)) {
  echo "Не е наличен плугин за зададения модул!";
 } 
 if (file_exists($path)) {
  include($path);
 }
}

function theme_dir($f=NULL) {
 $sql = mysql_query("SELECT * FROM siteconfig");
 while ($row=mysql_fetch_array($sql)) {
  if ($f == "f") {
    return "templates/$row[theme]/";
	}
	if ($f==NULL) {
	  echo "templates/$row[theme]/";
	}
 }
}

function custom_plugin($modname=NULL,$plugname) {
 $path = "modules/$modname/$plugname.php";
 if ($modname==NULL) {
  echo "Моля задайте име на модул!";
 } 
  if ($plugname==NULL) {
  echo "Моля задайте име на плугин!";
 } 
 if (!file_exists($path)) {
  echo "Не е наличен плугин за зададения модул!";
 } 
 if (file_exists($path)) {
  include($path);
 }
}

function upload($filename,$tempname,$papka,$text=NULL) {
  $putq = $papka.basename($filename);
   if (@copy($tempname, $putq)) {
     return $text;
  }
}

function get_lang($lang=NULL) {
 include("lang/".$lang.".php");
}

function redirect($url){
   if (!headers_sent()){
     header('Location: '.$url);
   } else {
     echo '<script type="text/javascript">';
     echo 'window.location.href="'.$url.'";';
     echo '</script>';
     }
}

function warning($msg,$type) {
if ($type==0) {
 return "<li class=\"NotificationsItem NotificationsPriority1\">
<span class=\"NotificationsItemData\">
<em><strong>Предупреждение:</strong></em> $msg
</span>
</li>";
}
if ($type==1) {
return "<li class=\"NotificationsItem NotificationsPriority2\"><span class=\"NotificationsItemData\">
Your mail settings have not been configured.  This could interfere with the ability of your website to send email messages.  You should go to <a href=\"moduleinterface.php?sp_=b741b9fd&amp;module=CMSMailer\">Extensions >> CMSMailer</a> and configure the mail settings with the information provided by your host.
</span>
</li>";
}

if ($type==2) {
return "<li class=\"NotificationsItem NotificationsPriority3\">
<span class=\"NotificationsItemData\">
Your mail settings have not been configured.  This could interfere with the ability of your website to send email messages.  You should go to <a href=\"moduleinterface.php?sp_=b741b9fd&amp;module=CMSMailer\">Extensions >> CMSMailer</a> and configure the mail settings with the information provided by your host.
</span>
</li>";
  }

}


function messages () {
$messages=0;

//CHECKS
if (file_exists("../install.php")) {
  $messages+=1;
}
//END CHECKS

if ($messages>1) {
$rod = "нови съобщения";
}
if ($messages==1) {
$rod = "ново съобщение";
}

if ($messages>0) {
  echo "<!-- notifications-container -->
 <div class=\"full-Notifications clear\">
<div class=\"Notifications-title\">Имате <b>$messages</b> $rod</div>
<div title=\"You have $messages unhandled notifications\" id=\"notifications-display\" class=\"notifications-show\" onclick=\"change('notifications-display', 'notifications-hide', 'notifications-show'); change('notifications-container', 'invisible', 'visible');\"></div>
<div id=\"notifications-container\" class=\"invisible\">
<ul id=\"Notifications-area\">";

//CHECKS WARNINGS
if (file_exists("../install.php")) {
  echo warning("Не е изтрит install.php файл от главната директория!",0);
}
//END CHECKS WARNINGS

echo "</ul></div>
</div><br/><br/><!-- notifications-container -->";
 }
}


function sysStat () {
if (file_exists("../index.php") 
    && file_exists("../includes/functions.php")
	&& file_exists("../modules/config/admin.php")
	&& file_exists("../admin/home.php")
	&& file_exists("../admin/index.php")
	)  {
 echo "<div class=\"acceptLogin\" style='font-size:11px;'>Системата Работи !!!</div><br/>";
 }
 if (!file_exists("../index.php") 
    && !file_exists("../includes/functions.php")
	&& !file_exists("../modules/config/admin.php")
	&& !file_exists("../admin/home.php")
	&& !file_exists("../admin/index.php"))  {
 echo "<div class=\"warningLogin\" style='font-size:11px;'>Грешка в системата !!!</div><br/>";
}
if (!file_exists("../index.php")) {
 echo "<div class=\"erroLogin\" style='font-size:11px;'>Сайтът е ОФЛАЙН !!!</div>";
 }

}

function tr ($i) {
echo "<tr  class='row";
if ($i % 2) {echo "2";} else {echo "1";}

echo "' onmouseover='this.className='row";

if ($i % 2) {echo "2";} else {echo "1";}
echo "hover';' onmouseout='this.className='row";
if ($i % 2) {echo "2";} else {echo "1";}
echo "';'>";
}


function getLang() {
$sql = mysql_query("SELECT * FROM translations ORDER by id DESC");
while($row = mysql_fetch_array($sql)) {
 $gets = http_build_query($_GET);
    echo  "<a style='margin-left:6px;' href='?$gets&setLang=$row[id]' >$row[lang_name]</a>";
  }
}


?>