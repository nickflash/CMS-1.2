<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
</head>
<title>Инсталация на системата</title>
<body bgcolor="#eeeeee">
<?php  error_reporting(0);
//CREATE DATABASE `modules_inst` DEFAULT CHARACTER SET cp1251 COLLATE cp1251_bulgarian_ci;
if (!isset($_GET['install'])) {
?><center>
<form action="?install=step1" method="POST">
<table cellspacing="0" cellpadding="2" width="330" bgcolor="#DBC9DB" ><tr>
<td bgcolor="#B58E8E"><b style="color:#50140E;">Инсталация</b></td><td bgcolor="#B58E8E"><b style="color:#F4F0F0;">СТЪПКА 1</b></td>
</tr>

<tr><td align="left">

Сървър на БД (localhost):</td><td><input type="text" name="server" /></td></tr>
<tr><td align="left" >Име на БД: </td><td align="left" ><input type="text" name="dbname" /> </td></tr>
<tr><td align="left" >Потребител на БД: </td><td align="left" ><input type="text" name="user" /> </td></tr>
<tr><td align="left" >Парола на БД: </td><td align="left" ><input type="text" name="pass" /> </td></tr>
<tr><td></td><td align="left" ><input type="submit" value="Напред" /></td></tr>
</table>
</form>
</center>
<?php }  
if ($_GET['install'] == "step1") {
$connect = @mysql_connect($_POST[server],$_POST[user],$_POST[pass]);
if (@mysql_select_db($_POST[dbname] ,$connect)) {

$file="includes/functions.php";
$fp = fopen('includes/functions.php', 'r+');
$cont=file_get_contents($file);
fwrite($fp, '<?
function db() {
$host="'.$_POST[server].'";
$user ="'.$_POST[user].'";
$pass="'.$_POST[pass].'";
$db="'.$_POST[dbname].'";
$connect = mysql_connect($host,$user,$pass) or die(mysql_error());
  mysql_select_db($db ,$connect);
  
  mysql_query("SET CHARACTER SET utf8_unicode_ci");
  mysql_query("SET CHARACTER_SET_CLIENT=utf8_unicode_ci");
  mysql_query("SET CHARACTER_SET_RESULTS=utf8_unicode_ci");
  mysql_query("SET CHARACTER_SET_CONNECTION=utf8_unicode_ci");
  mysql_query("SET NAMES utf8 ");
}
?>'.$cont);
fclose($fp);
  include("includes/functions.php");
  db();
 
  mysql_query("SET CHARACTER_SET_CLIENT=utf8_unicode_ci");
  mysql_query("SET CHARACTER_SET_RESULTS=utf8_unicode_ci");
  mysql_query("SET CHARACTER_SET_CONNECTION=utf8_unicode_ci");


mysql_query("ALTER DATABASE ".$_POST[dbname]." COLLATE utf8_unicode_ci");
mysql_query("CREATE TABLE IF NOT EXISTS menu (
id int(8) not null auto_increment,
name longtext not null,
link longtext not null,
opisanie longtext not null,
active longtext not null,
lang longtext not null,
PRIMARY KEY (id)
);") or die(mysql_error());

mysql_query("CREATE TABLE IF NOT EXISTS menu_translated (
id int(8) not null auto_increment,
name longtext not null,
link longtext not null,
opisanie longtext not null,
active longtext not null,
translationid longtext not null,
lang longtext not null,
PRIMARY KEY (id)
);") or die(mysql_error());

mysql_query("CREATE TABLE IF NOT EXISTS submenus (
id int(8) not null auto_increment,
name longtext not null,
link longtext not null,
opisanie longtext not null,
active longtext not null,
PRIMARY KEY (id)
);") or die(mysql_error());

mysql_query("INSERT INTO menu (name,link,opisanie,active,lang) VALUES ('Начало','index.php','Начало на сайта','yes','1');");

mysql_query("CREATE TABLE IF NOT EXISTS admins (
id int(8) not null auto_increment,
name longtext not null,
pass longtext not null,
PRIMARY KEY (id)
);") or die(mysql_error());

mysql_query("INSERT INTO admins (name,pass) VALUES ('admin','21232f297a57a5a743894a0e4a801fc3');");

mysql_query("CREATE TABLE IF NOT EXISTS siteconfig (
id int(8) not null auto_increment,
name longtext not null,
theme longtext not null,
index_page longtext not null,
def_lang longtext not null,
PRIMARY KEY (id)
);") or die(mysql_error());

mysql_query("INSERT INTO siteconfig (name,theme,index_page,def_lang) VALUES ('CMS module system','default','?m=custompages&pid=1','1');");

mysql_query("CREATE TABLE IF NOT EXISTS pages (
id int(8) not null auto_increment,
name longtext not null,
content longtext not null,
lang longtext not null,
in_cat longtext not null,
PRIMARY KEY (id)
);") or die(mysql_error());

mysql_query("CREATE TABLE IF NOT EXISTS pages_translated (
id int(8) not null auto_increment,
name longtext not null,
content longtext not null,
translationid longtext not null,
lang longtext not null,
PRIMARY KEY (id)
);") or die(mysql_error());

mysql_query("CREATE TABLE IF NOT EXISTS pages_cat (
id int(8) not null auto_increment,
name longtext not null,
PRIMARY KEY (id)
);") or die(mysql_error());


mysql_query("CREATE TABLE IF NOT EXISTS pages_cat_tr (
id int(8) not null auto_increment,
name longtext not null,
tr_of longtext not null,
PRIMARY KEY (id)
);") or die(mysql_error());

mysql_query("INSERT INTO pages (name,content,lang) VALUES ('Начало','Това е началната страница на нашата система.','1');");

mysql_query("CREATE TABLE IF NOT EXISTS news (
id int(8) not null auto_increment,
title longtext not null,
news longtext not null,
date longtext not null,
lang longtext not null,
PRIMARY KEY (id)
);") or die(mysql_error());


mysql_query("CREATE TABLE IF NOT EXISTS news_translated (
id int(8) not null auto_increment,
title longtext not null,
news longtext not null,
date longtext not null,
translationid longtext not null,
lang longtext not null,
PRIMARY KEY (id)
);") or die(mysql_error());

mysql_query("INSERT INTO news (title,news,date,lang) VALUES ('Пробна новина','Това което виждате е пробна новина.','29.03.2009 г.  16:18 ч.','1');");

mysql_query("INSERT INTO menu (name,link,opisanie,active) VALUES ('Новини','?m=news','Новини в сайта','yes');");

mysql_query("CREATE TABLE IF NOT EXISTS statistics (
id int(8) not null auto_increment,
ips longtext not null,
impressions longtext not null,
PRIMARY KEY (id)
);") or die(mysql_error());

mysql_query("CREATE TABLE IF NOT EXISTS translations (
id int(8) not null auto_increment,
lang_name longtext not null,
tr longtext not null,
translation longtext not null,
PRIMARY KEY (id)
);") or die(mysql_error());


mysql_query('INSERT INTO translations 
(lang_name,tr,translation) VALUES (\'English\',\'en\',\'
//USER module lang
define("LOGIN","Login");
define("REGISTRATION","Registrate");
define("USERNAME","Username");
define("PASSWORD","Password");
define("R_PASSWORD","Repeat password");
define("Y_EMAIL","Your e-mail");
define("REG_BUTT","Registration");
define("LOG_BUTT","Log me in");
define("LOGIN_SUCC","Login succesful!");
define("CONTINIUE","Continiue");
define("WELCOME_LOGIN","Welcome, ");
define("LOGOUT","Logout");
define("LOGOUT_SUCC","Logout succesful please <a href=\"index.php\">continiue</a> ! ");
define("REG_SUCC","Registration successful!");
define("PROF_OF","Profile of");
define("E_MAIL","E-mail");
define("U_LEVEL","Level");
define("CHANGE_PASS","Change password");
define("U_ERROR_1","Please, field all the fields!");
define("U_ERROR_2","Please, type valid email!");
define("U_ERROR_3","The passwords does not mach!");

//E-mail module
define("MAIL_ERROR_1","Please, type valid mail!");
define("MAIL_ERROR_2","Dont try this ! ! ");
define("MAIL_ERROR_3","Please, field the fields!");
define("MAIL_MSG","The message has sent successfuly!");
define("Y_MAIL_CONT","Your e-mail");
define("Y_NAME_MAIL","Your name");
define("Y_MESSAGE_MAIL","Your message...");
define("SND_MAIL","Send message");
\');');

mysql_query('INSERT INTO translations 
(lang_name,tr,translation) VALUES (\'Български\',\'bg\',\'
//USER module lang
define("LOGIN","Вход");
define("REGISTRATION","Регистрация");
define("USERNAME","Потребителско име");
define("PASSWORD","Парола");
define("R_PASSWORD","Повтори парола");
define("Y_EMAIL","Вашият имейл");
define("REG_BUTT","Регистрация");
define("REG_SUCC","Регистрацията приключи успешно!");
define("LOG_BUTT","Вход");
define("LOGOUT_SUCC","Изход успешен, моля <a href=\"index.php\">продължете</a> нататък.");
define("LOGIN_SUCC","Вход успешен! Моля ");
define("CONTINIUE","продължете");
define("WELCOME_LOGIN","Добре дошъл, ");
define("LOGOUT","Изход");
define("PROF_OF","Профил на");
define("E_MAIL","E-mail");
define("U_LEVEL","Левъл");
define("CHANGE_PASS","Промени парола");
define("U_ERROR_1","Моля, попълнете всички полета!");
define("U_ERROR_2","Моля, въведете правилен имейл!");
define("U_ERROR_3","Паролите не се съвпадат!");

//E-mail module
define("MAIL_ERROR_1","Моля въведете валиден имейл");
define("MAIL_ERROR_2","Не опитвай това ! ! ");
define("MAIL_ERROR_3","Моля попълнете всички полета!");
define("MAIL_MSG","Съобщението изпратено успешно!");
define("Y_MAIL_CONT","Вашият имейл");
define("Y_NAME_MAIL","Вашето име");
define("Y_MESSAGE_MAIL","Вашето съобщение...");
define("SND_MAIL","Изпрати");

\');');
?>

<center>
<form action="?install=step2" method="POST">
<table cellspacing="0" cellpadding="2" width="330" bgcolor="#DBC9DB" ><tr>
<td bgcolor="#B58E8E"><b style="color:#50140E;">Инсталация</b></td><td bgcolor="#B58E8E"><b style="color:#F4F0F0;">СТЪПКА 2</b></td>
</tr>

<tr><td align="left">

Администраторско име:</td><td><input type="text" name="name" /></td></tr>
<tr><td align="left" >Администраторска парола: </td><td align="left" ><input type="password" name="pass" /> </td></tr>
<tr><td></td><td align="left" ><input type="submit" value="Напред" /></td></tr>
</table>
</form>
</center>
<?
 }
 if (!@mysql_select_db($_POST['dbname'] ,$connect)) {
     echo "Възникна грешка във свързването с базата данни, моля уверете се, че сте попълнили вярно формата за инсталация!";
 }
}
  if ($_GET[install] == "step2") {
  include("includes/functions.php");
  db();
    $name = $_POST['name'];
	$pass = $_POST['pass'];
	$passMD = md5($pass);
	mysql_query("INSERT INTO admins (name,pass) VALUES ('$name','$passMD')");
  ?>
  <center>
<form action="?install=step2" method="POST">
<table cellspacing="0" cellpadding="2" width="330" bgcolor="#DBC9DB" ><tr>
<td bgcolor="#B58E8E"><b style="color:#50140E;">Инсталация</b></td><td bgcolor="#B58E8E"><b style="color:#F4F0F0;">СТЪПКА 2</b></td>
</tr>
<tr><td align="left" >Инсталацията приключи</td><td align="left"  ><b style="color:green;">УСПЕШНО</b></td></tr>
<tr><td></td><td align="left"  ><a href="index.php">Към сайта</a></td></tr>
</table>
</form>
</center>
  <?php
 } 
?>

</body>
