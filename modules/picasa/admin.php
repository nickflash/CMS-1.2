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

<tr><th>�������� �� ��������:</th></tr>

<tr><td><input style="width:450px;" type="text" name="title" /></td></tr>

<tr><td><textarea name="news" rows="50" >�������� ��� ������������ �� ������ ������...</textarea></td></tr>

<tr><td><input type="submit" name="addnews" value="������ ������" /></td></tr>

</table>

</form>
<?
 if ($_GET[view] == "settings") {
 
 }
if (isset($_POST[change_btn])) {
$title = $_POST[title];
$news = $_POST[news];
$date = date("d.m.Y")."�. ".date("H:i")."�.";
mysql_query("INSERT INTO news (title,news,date) VALUES ('$title','$news','$date')");
echo "<p />�������� � ������� ��������!";
 }
}
