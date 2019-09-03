<? 
function db () {
$host="localhost";
$user ="root";
$pass="";
$db="modules";
$connect = mysql_connect($host,$user,$pass) or die(mysql_error());
mysql_select_db($db ,$connect);
mysql_query("SET CHARACTER SET cp1251");
//Енкодинга (колацията) на базата данни трябва да е cp1251_bulgarian_ci + страниците ANSI
}

function fulladress() {
return "http://localhost/modulesystem/"; //целия път на сайта (понякога трябва ;) )
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
if (eregi("<div",$tag)) {
 $close = "</div>";
}
$sql = mysql_query("SELECT * FROM menu WHERE active='yes' ORDER by id") or die(mysql_error());
while($row = mysql_fetch_array($sql)) {
echo "$tag $bullet <a href='$row[link]' $other title='$row[title]' >$row[name]</a>$close $br";
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
return $row[name];
}
}
 
function user_panel() {
 if ($_SESSION[user] == true) { 
  echo WELCOME_LOGIN." <a  style=\"color:blue;\" href='?m=user&action=profile&id=".$_SESSION[id]."'>".$_SESSION[user]."</a> , <a href='?m=user&action=logout' style=\"color:red;\">[".LOGOUT."]</a>"; 
  }
  if ($_SESSION[user] == false) { 
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

?>