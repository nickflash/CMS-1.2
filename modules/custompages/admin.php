<? $name="custompages"; $mf="?module=$name&"; $indexM="?module=$name"; if ($_SESSION["admin"]==true) { ?>
<head>
<META http-equiv="Content-Type" content="text/html; charset=Windows-1251">
</head>
<p />
<? 
$editor = "<script type='text/javascript'>
window.onload = function() {
	var oFCKeditor = new FCKeditor( 'content' ) ;
	oFCKeditor.BasePath	= '../fckeditor/' ;
	oFCKeditor.ReplaceTextarea() ;
}
</script>
";
if (@$_GET["v"]=="new_cat") { 
?>

<table height="30" width="200"><tr>
<form method="POST" action="<? echo $mf; ?>v=cat_action" id="contact_form">
<td><input type="text" name="title_cat" />

<div id="loader"><input type="submit" class="button" name="add_cat" value="Add category" /></div></td>

</form>
</table>
</tr>
<table>
<tr><td><b>Page Categories</b></td></tr>
<?
$sql = mysql_query("SELECT * FROM pages_cat ORDER by id DESC");
while($row=mysql_fetch_array($sql)) {
        echo "<tr><td>".$row["name"]."</td></tr>";
   }
   
   ?>
   </table>
   <?
}

if (@$_GET["v"]=="cat_action") {
if(isset($_POST["add_cat"])) {

$title_cat = $_POST["title_cat"];
mysql_query("INSERT INTO pages_cat (name) VALUES ('$title_cat');");
echo "The category is added successfully!";
redirect($mf."v=new_cat");
  }
}


if (@$_GET["v"]=="new") {  echo $editor;?>

<form action="<? echo $mf; ?>v=new" method="POST">

<table class="pagetable" width="800">
<thead><tr><th class="pagew70">Нова страница:</th></tr></thead>
<tr><td></tr></td>
<tr><td>Име на страница:&nbsp;<input style="width:250px;" type="text" name="name" /></td></tr>
<tr><td>
Category: 

<select>
<option>English</option>
</select>
&nbsp;
<a href="#" class="button">Добави нова</a>

</td></tr>
<tr><td><textarea type="text" style="width:500px;height:350px;" id="page" name="content">Тук приложете вашето съдържание...</textarea></td></tr>
<tr><td><input class="button" type="submit" name="addpage" value="Добави страница" ></td></tr>
</table>
</form>
<?
 }

db();
if (isset($_POST["addpage"])) {
$pname = $_POST["name"];
$pcontent = $_POST["content"];
mysql_query("INSERT INTO pages (name,content) VALUES ('$pname','$pcontent')");
$sql = mysql_query("SELECT * FROM pages ORDER by id DESC LIMIT 1") or die(mysql_error());
while ($row=mysql_fetch_array($sql)) {
mysql_query("INSERT INTO menu (name,link,opisanie,active) VALUES ('$pname','?m=custompages&pid=$row[id]','$pname','yes')");
}
echo "<p />Страницата добавена успешно!";
}

if (!isset($_GET["v"])) {
if (isset($_GET["del"])) {
mysql_query("DELETE FROM pages WHERE id='".$_GET[del]."'");
mysql_query("DELETE FROM menu WHERE link='?m=custompages&pid=".$_GET[del]."'");
}
?>
<table class="pagetable" width="800">
<thead><tr><th class="pagew70">Заглавие:</th><th class="pagew10">Действия:</th></tr></thead>
<?
$sql = mysql_query("SELECT * FROM pages ORDER by id ASC");

while($row=mysql_fetch_array($sql)) {
tr($i+=1);
 echo "<td >$row[name]</td><td align='center'><a alt='изтрий'  title='изтрий' href='$indexM&v=all&del=$row[id]'><img border='0' src='../admin/images/delete.png'></a>&nbsp;&nbsp;&nbsp;<a alt='редакция'  title='редакция'  href='$indexM&v=edit&e=$row[id]' ><img border='0' src='../admin/images/edit.png'></a></td></tr>";
}

?>
</table>
<?
}
if (@$_GET["v"]=="edit") {
$id = $_GET["e"];
$sql = mysql_query("SELECT * FROM pages WHERE id='$id'");
while($row=mysql_fetch_array($sql)) {
echo $editor;
echo "
<form action=\"$indexM&v=edit&e=$id\" method=\"POST\">
<table class=\"pagetable\" width=\"800\">
<thead><tr><th class=\"pagew70\">Промяна на: $row[name]</th></tr></thead>
<tr><td></td></tr>
<tr><td>Име на страница:<input type=\"text\" value=\"$row[name]\" name=\"name\" /></td></tr>
<tr><td>Съдържание:</td></tr>
<tr><td><textarea style=\"width:700px;height:350px;\" type=\"text\" id=\"pagee\" name=\"content\">$row[content]</textarea></td></tr>
<tr><td><input type=\"submit\" name=\"editpage\" value=\"Промени страница\" ></td></tr>
</table>
</form>
";
}
if (isset($_POST[editpage])) {
$pname = $_POST[name];
$pcontent = $_POST[content];
mysql_query("UPDATE pages SET name='$pname' , content='$pcontent' WHERE id='$id'");
$sql = mysql_query("SELECT * FROM pages ORDER by id DESC LIMIT 1") or die(mysql_error());
while ($row=mysql_fetch_array($sql)) {
mysql_query("UPDATE menu SET name='$pname' WHERE link='?m=custompages&pid=$id'");
}
echo "<p />Страницата променена успешно!";
}
}
}
?>