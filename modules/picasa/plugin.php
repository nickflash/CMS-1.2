<b>Последни новини</b>
<? 
$kolko = 5; //kolko posledni novini da pokazva
$sql = mysql_query("SELECT * FROM news ORDER by id DESC LIMIT $kolko");
while ($row = mysql_fetch_array($sql)) {
   echo "<a href=\"?m=news&nid=$row[id]\">".substr($row[title],0,14)."...</a><br />";
}
?>