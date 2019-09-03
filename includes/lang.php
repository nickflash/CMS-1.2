<?php 
if (is_numeric($_SESSION["language"])) {
$lang = $_SESSION["language"];
$sqla = mysql_query("SELECT * FROM translations WHERE id='$lang' LIMIT 1");
while($rowa = mysql_fetch_array($sqla)) {
    eval ($rowa['translation']);
   }
  }

?>