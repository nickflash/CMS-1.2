<?   putenv ('TZ=Europe/Sofia');  include("../includes/functions.php"); db(); @session_start(); ?>
<html>
<head>
<META http-equiv="Content-Type" content="text/html; charset=Windows-1251">
        <link rel="stylesheet" type="text/css" href="tables.css">
		<link rel="stylesheet" type="text/css" href="common.css">
		<link rel="stylesheet" type="text/css" href="form.css">
		<link rel="stylesheet" type="text/css" href="menu.css">
		
        <link rel="stylesheet" href="../ow/docs/style.css" type="text/css">
		<link rel="stylesheet" type="text/css" href="jqueryslidemenu.css" />

<!--[if lte IE 7]>
<style type="text/css">
html .jqueryslidemenu{height: 1%;} /*Holly Hack for IE7 and below*/
</style>
<![endif]-->

<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="jqueryslidemenu.js"></script>
        <script type="text/javascript" src="../ow/scripts/wysiwyg.js"></script>
		<script type="text/javascript" src="../ow/scripts/wysiwyg-settings.js"></script>
              <title>Администраторски панел</title>
		</head>
		<script type="text/javascript" src="../includes/LB2/prototype.js"></script>
<script type="text/javascript" src="../includes/LB2/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="../includes/LB2/lightbox_admin.js"></script>
<link rel="stylesheet" href="../includes/LB2/lightbox.css" type="text/css" media="screen" />
<script type="text/javascript" src="../fckeditor/fckeditor.js"></script>
<body bgcolor='#d5d5d5' style='background:#d5d5d5;'><? if ($_SESSION[admin]==false) { if (!isset($_GET[p])) { ?>
 <center>
 <div id="middlepart" >

<!--  Login Box -->
   <div id="login">

<table width="550" align="left">
<thead>
<tr><th colspan="2">
Система за администрация на уеб сайта
</th></tr></thead>
<tfoot><tr><td colspan="2">
		   <span class="forgot">
           CCMS
		   </span>
<!-- LOGIN FORM -->		   
</td></tr></tfoot>
<tbody><tr><td align="left" class="vmiddle"></td><td align="center">
<!-- LOGIN FORM -->
        <form  method="post" action="index.php?p=">
            <label>Потребителско Име</label>
            <input name="admin_nm" class="input"  id="userlogin"   size="20" tabindex="10" type="text">
            <label>Парола</label>
            <input name="admin_pass" class="input"  id="userpass"  size="20" tabindex="10" type="password">

          <p class="submit"><input type="submit" name="admin" value="Вход" /></p>
        </form>		</td></tr></tbody></table>
    </div>
<!--  LoginBox End -->

  </div>
<!--  Content End -->  
  

<?
}
if (isset($_POST[admin])) {
  $name = $_POST[admin_nm];
  $pass = $_POST[admin_pass];
  $passMD5 = md5($pass);
  $sql = mysql_query("SELECT * FROM admins WHERE name='$name'") or die(mysql_error());
  while($row = mysql_fetch_array($sql)) {
    if ($row[pass]==$passMD5) {
	  $_SESSION[admin] = $name;
	 }
	 else {
	  echo "<center><div class=\"error\" style=\"width:780px;\"><span>Внимание !</span>        <p> Грешно администраторско име или парола!<br/><br/><br/><a href=\"index.php\"/>Опитай пак</a></p></div></center>";

	 }
   } 
  }
 }
?>
<? if ($_SESSION[admin]==true) { ?>
 

<?php 


echo "<center><table width=\"800\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">  <thead>    <tr>      <th class=\"capt\" colspan=\"8\">Администрация Уеб Сайт&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class=\"publish\" href=\"../index.php\">Към Сайта</a> <a class=\"delete\" href=\"index.php?p=out\">изход</a></th>    </tr></thead> </table>";



?>

<div  style="width:800px;" id="myslidemenu" class="jqueryslidemenu">
<ul>
<li><a href="index.php">Начало</a></li>


<li><a href="#">Модули</a>
  <ul>

  

 



<? 
//MENU
$path = "../modules";
$dir_handle = @opendir($path) or die("Немога да отворя директорията с модулите $path");

while ($dir = readdir($dir_handle)) 
{ 
if (file_exists("$path/$dir/int.php")) {
$i+=1;

include("$path/$dir/int.php"); 
if ($dir!="config") {

?>
<li>
      <? for ($i=0;$i<count($icon);$i++) {
    if ($name=$dir) {
	    $ico = $icon[$i];
      }
   } ?>
     <a href="<? echo "?module=$dir"; ?>"><img src="<? echo "../modules/$dir/".$ico; ?>" width='15' height='15' />&nbsp;&nbsp;&nbsp;<? echo $mnu_title; ?></a>
	 
  <ul>
  <? 
                  for ($i=0; $i<count($buton); $i++) {
     $boom1 = explode("][",$buton[$i]);
	 $name1 = $boom1[0];
	 $link1 = $boom1[1];
	 $module1 = $boom1[3];
	 if($module1 == $dir) {
	 echo "<li><a href=\"?module=$dir&$link1\">$name1</a></li>";
	 }
   }
  ?>
  
    		
  
  </ul>
  
  </li>
  <? }
     $titleMN[] = $mnu_title; //important
	 $titlnm[] = $name; //important
	 
    }
   }

closedir($dir_handle);

//LOGOUT
if ($_GET[p] == "out") {
session_unset();
echo "<center><div class=\"error\" style=\"width:780px;\"><span>Внимание !</span>        <p> Вие успешно излязохте от профила си...<br/><br/><br/><a href=\"../index.php\"/>Продължи</a></p></div></center>";

}
?>  
</ul>
<li><a href="?module=config">Конфигурация</a></li>
 </li>
</ul>
<br style="clear: left" />
</div>
<?
if (isset($_GET[module])){
 ?>
 <table width="800">
 <th id="tit">
  <? 
   for ($i=0; $i<count($title); $i++) {
      $boom2 = explode("][",$title[$i]);
   $titleM = $boom2[1];
   $titleM2 = $boom2[0]; 
   if (!file_exists("../modules/$_GET[module]/$icon[$i]")) {
	    $fnIM = "images/blank.png";
	 }
	 else  {
	   $fnIM = "../modules/$_GET[module]/$icon[$i]";
	 }
   if($titleM == $_GET[module]) {
     echo "<div align=\"left\"><img width=\"22\" height=\"22\" src=\"$fnIM\" />&nbsp;<div id=\"admin_title\" >$titleM2</div></div>";
   }
   }
   ?>
<div align="right">   
   <?
   for ($i=0; $i<count($buton); $i++) {
     $boom = explode("][",$buton[$i]);
	 $name = $boom[0];
	 $link = $boom[1];
	 $class = $boom[2];
	 $module = $boom[3];
	 if($module == $_GET[module]) {
	 echo "<a href=\"?module=$_GET[module]&$link\" class=\"$class\">$name</a>";
	 }
   }

  ?>
  </div>
</th>
<tr>
 <td>
 <?
  include ("../modules/$_GET[module]/admin.php");
  ?>
  </td>
 </tr>
 </table>
 <?
}
if (!isset($_GET[module]) && $_GET[p]!="out"){
?>
 <table width="800">
 <th id="tit"> 
<?
   include ("home.php");
 }
 ?> 
 </td>
 </tr>
 </table>
 <?
}
?>