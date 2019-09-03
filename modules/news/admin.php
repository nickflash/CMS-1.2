<? if ($_SESSION[admin]==true) { $mf="?module=news&"; $indexM="?module=news"; 
$editor = "<script type='text/javascript'>
window.onload = function() {
	var oFCKeditor = new FCKeditor( 'news' ) ;
	oFCKeditor.BasePath	= '../fckeditor/' ;
	oFCKeditor.ReplaceTextarea() ;
}
</script>
";
?>
<?
if ($_GET[view]=="add") {
?>
<form action="<? echo $mf; ?>view=add" method="POST">

<table width="790">

<tr><th>Заглавие на новината:</th></tr>

<tr><td><input style="width:450px;" type="text" name="title" /></td></tr>

<tr><td><textarea name="news" rows="50" >Напишете тук съдържанието на вашата новина...</textarea></td></tr>

<tr><td><input type="submit" name="addnews" value="Добави новина" /></td></tr>

</table>

</form>
<?
 if ($_GET[view] == "add") {
 echo $editor; 
 }
if (isset($_POST[addnews])) {
$title = $_POST[title];
$news = $_POST[news];
$date = date("d.m.Y")."г. ".date("H:i")."ч.";
mysql_query("INSERT INTO news (title,news,date) VALUES ('$title','$news','$date')");
echo "<p />Новината е успешно добавена!";
 }
}
if (!isset($_GET[view])) { 
if (isset($_GET[del])) {
mysql_query("DELETE FROM news WHERE id='".$_GET[del]."'");
echo "Новината успешно изтрита!";
redirect($indexM);
}
?>
<table class="pagetable" width="800">
<thead><tr>
<th class="pagew70">Заглавие:</th><th class="pagew10">Действия:</th></tr></thead>
<?
$sql = mysql_query("SELECT * FROM news ORDER by id DESC");
while ($row = mysql_fetch_array($sql)) {
tr($i+=1);
echo "<td>$row[title]</td><td><a alt='изтрий'  title='изтрий' href='$indexM&v=all&del=$row[id]'><img border='0' src='../admin/images/delete.png'></a>&nbsp;&nbsp;&nbsp;<a alt='редакция'  title='редакция'  href='$indexM&v=edit&e=$row[id]' ><img border='0' src='../admin/images/edit.png'></a></td></tr>"; 
 }
 echo "</table>";
}
?>

<?
if ($_GET[view]=="ed") {
echo $editor;
$sql = mysql_query("SELECT * FROM news WHERE id='".$_GET[edit]."'");
while ($row = mysql_fetch_array($sql)) {
?>
<form action="<? echo $indexM."&view=ed&edit=".$_GET[edit]; ?>" method="POST">

<table width="790">

<tr><th>Заглавие на новината:</th></tr>

<tr><td><input style="width:450px;" value="<? echo $row[title]; ?>" type="text" name="title" /></td></tr>

<tr><td><textarea name="news"  rows="50" ><? echo $row[news]; ?></textarea></td></tr>

<tr><td><input type="submit" name="editnews" value="Промени новина" /></td></tr>

</table>

</form>
<?
 }
if (isset($_POST[editnews])) {
$title = $_POST[title];
$news = $_POST[news];
mysql_query("UPDATE news SET title='$title', news='$news' WHERE id='".$_GET[edit]."'");
echo "<p />Новината е успешно променена!";
redirect($indexM);
  }
 }
}
?> 