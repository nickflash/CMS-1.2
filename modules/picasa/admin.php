<? if ($_SESSION[admin]==true) { $mf="?module=picasa&"; $indexM="?module=picasa"; 
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
 if ($_GET[view] == "settings") {
 
 }
if (isset($_POST[change_btn])) {
$title = $_POST[title];
$news = $_POST[news];
$date = date("d.m.Y")."г. ".date("H:i")."ч.";
mysql_query("INSERT INTO news (title,news,date) VALUES ('$title','$news','$date')");
echo "<p />Новината е успешно добавена!";
 }
}
