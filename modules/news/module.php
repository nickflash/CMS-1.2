<style type="text/css">
.curlycontainer{
border: 1px solid #b8b8b8;
margin-bottom: 1em;
width: 550px;
}
.curlycontainer .innerdiv{
background: transparent url(templates/default/images/brcorner.gif) bottom right no-repeat;
position: relative;
left: 2px;
top: 2px;
padding-bottom:16px;
}
</style>
<center><p /><? 
if (!isset($_GET[nid])) {
$broinastranica = 5;
$pageNum = 1;
if(isset($_GET['page']))
{
$pageNum = $_GET['page'];
}
$redove = ($pageNum - 1) * $broinastranica;

$sql = mysql_query("SELECT * FROM news ORDER by id DESC" . " LIMIT $redove, $broinastranica");
while ($row = mysql_fetch_array($sql)) {
echo "<div class=\"curlycontainer\">
<div class=\"innerdiv\">
<b></b> <br />";
echo "<table width='550' ><tr><td align=left><a href='?m=news&nid=$row[id]'>$row[title]</a> <br /><hr width=530 align=left /></td></tr>
<tr><td>$row[news]</td></tr>
<tr><td align='right'><b>$row[date]</b></td></tr>
</table></div></div>";
}
$query = "SELECT COUNT(title) AS numrows FROM news";
$result = mysql_query($query) or die('Error, query failed');
$row = mysql_fetch_array($result, MYSQL_ASSOC);
$numrows = $row['numrows'];


$maxPage = ceil($numrows/$broinastranica);

$self = $_SERVER['PHP_SELF'];
$nomeranastranici = '';

for($page = 1; $page <= $maxPage; $page++)
{
if ($page == $pageNum)
{
$nomeranastranici .= " $page ";
}
else
{
$nomeranastranici .= " <a class=paging href=\"?m=news&page=$page\">$page</a> ";
}
}
if ($pageNum > 1)
{
$page = $pageNum - 1;
$predishna = "  <a class=paging href=\"?m=news&page=$page\">[<<<<<]</a> ";

$parva = "  <a class=paging href=\"?m=news&page=1\">[първа]</a> ";
}
else
{
$predishna = ' ';
$parva = ' ';
}

if ($pageNum < $maxPage)
{
$page = $pageNum + 1;
$sledvashta = "  <a class=paging href=\"?m=news&page=$page\">[>>>>>]</a> ";

$posledna = "  <a class=paging href=\"?m=news&page=$maxPage\">[последна]</a> ";
}
else
{
$sledvashta = ' ';
$posledna = ' ';
}
echo "<p>";
echo $parva . $predishna . $nomeranastranici . $sledvashta . $posledna;
}
if (isset($_GET[nid])) {
$nid = $_GET[nid];
$sql = mysql_query("SELECT * FROM news WHERE id='$nid'");
while ($row = mysql_fetch_array($sql)) {
echo "<div class=\"curlycontainer\">
<div class=\"innerdiv\">
<b>$row[title]</b> <br />";
echo "<table width='550' ><tr><td align=left></td></tr>
<tr><td>$row[news]</td></tr>
<tr><td align='right'><b>$row[date]</b></td></tr>
</table></div>
</div>";
}
}
?>
</center>