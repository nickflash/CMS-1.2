<? 


if (!isset($_GET[pid])) {


$sql = mysql_query("SELECT * FROM siteconfig");
while ($row=mysql_fetch_array($sql)) {
$pid = $row[index_page];
}
}

if (isset($_GET[pid])) {
if (is_numeric($_GET[pid])) {
$pid = $_GET[pid];
 }
}

if (is_numeric($_SESSION["language"])) {
$sql = mysql_query("SELECT * FROM pages WHERE id='$pid'") or die(mysql_error());
while ($row=mysql_fetch_array($sql)) {
if ($row["lang"] == $_SESSION["language"]) {
echo "$row[content]";
  }
 if ($row["lang"] != $_SESSION["language"])  {
  
  $ses = $_SESSION["language"];

  $sqlt = mysql_query("SELECT * FROM pages_translated WHERE translationid='$row[id]' and lang='$ses' LIMIT 1") or die(mysql_error());
    while ($rowt=mysql_fetch_array($sqlt)) {
      echo "$rowt[content]";
  }
}
}
}
?>