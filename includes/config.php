<?
function db() {
$host="localhost";
$user ="root";
$pass="";
$db="modules";
$connect = mysql_connect($host,$user,$pass) or die(mysql_error());
mysql_select_db($db ,$connect);
mysql_query("SET CHARACTER SET cp1251");
}
?>