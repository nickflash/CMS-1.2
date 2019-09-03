<?php session_start();
//error_reporting(0);
$index = true;
include("includes/functions.php");
if (!function_exists("db")) {
 redirect("install.php");
}
db();

$ip = $_SERVER['REMOTE_ADDR'];
 $sqln = mysql_query("SELECT COUNT(ips) AS number FROM statistics WHERE ips='$ip'");
while ($row=mysql_fetch_array($sqln)) { 

 if ($row["number"]==1) {
  $sqln2 = mysql_query("SELECT * FROM statistics WHERE ips='$ip'");
while ($row2=mysql_fetch_array($sqln2)) { 
  $imp=$row2["impressions"]+1;
  mysql_query("UPDATE statistics SET impressions='$imp' WHERE ips='$ip'");
  }
}
 elseif ($row["number"]==0) {
  mysql_query("INSERT INTO statistics (ips,impressions) VALUES ('$ip','1')");
 }
}

if(isset($_GET["setLang"])) {
if (is_numeric($_GET["setLang"])) {
$_SESSION["language"] = $_GET["setLang"];
}
}

$sql = mysql_query("SELECT * FROM siteconfig");
while ($row=mysql_fetch_array($sql)) {
 
if (!isset($_GET['m'])) {
 redirect( $row["index_page"]);
}
if (!isset($_SESSION['language'])) {
  $_SESSION['language']= $row['def_lang'];
  include("includes/lang.php");
} 
if (isset($_SESSION['language'])) {
  include("includes/lang.php");
} 



include("templates/$row[theme]/theme.php");
}
?>