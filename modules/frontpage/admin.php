<? $name="gallery"; $mf="?module=$name&"; $indexM="?module=$name";  if ($_SESSION[admin]==true) {
$view = $_GET[view];
if (!isset($view)) {
?>
<table class="pagetable" width="790" >
<tr>

<th class="pagew70" width="150" >
Снимка:
</th>
<th class="pagew70" >
Заглавие:
</th>
<th class="pagew70" >
В категория:
</th>

<th class="pagew70" >
Главна:
</th>

<th class="pagew70" >
Действия:
</th>

</tr>

<? 
function name_cat($idd) {
$sql = mysql_query("SELECT * FROM gallery_cats WHERE id='$idd'");
while($row = mysql_fetch_array($sql)) {
  echo $row[name];
 }
}

function basic ($int) {
   if ($int==0) {
    return "НЕ";
   }
     if ($int==1) {
    return "ДА";
   }
 }
 
// определяме колко реда да ни показва. В случая 20 на страница.

$broinastranica = 5;

// от коя страница да почне да показва.Може да искаме да е от втора или от последна.

$pageNum = 1;

// ако има получени данни $_GET['page'] ще покаже страницата с номер $_GET['page']

if(isset($_GET['page']))
{
$pageNum = $_GET['page'];
}

//тука определяме кои редове ще се показват - примерно ако $_GET['page']=2
// ще покаже от 20 до 40-ти ред.
$redove = ($pageNum - 1) * $broinastranica;
//заявката ще върне само посочените редове - примерно от 20 до 40 в зависимост от $_GET['page']
$sql = mysql_query("SELECT * FROM gallery ORDER by id DESC"." LIMIT $redove, $broinastranica");
while($row = mysql_fetch_array($sql)) {
tr($i+=1);
?>
<td width="150" ><a href="../modules/gallery/uploads/<? echo $row[image]; ?>" rel="lightbox"><img src="../modules/gallery/thumbs/<? echo $row[image]; ?>" border="0" /></a></td><td><? echo $row[title]; ?></td> <td><? echo name_cat($row[in_cat]); ?></td> <td><? echo basic($row[basic]); ?></td> <td><a href="<? echo $mf; ?>view=delete&id=<? echo $row[id]; ?>&file=<? echo $row[image]; ?>" class="delete"><img border='0' src='../admin/images/delete.png'/></a></td></tr>
<?
}
?>

</table>

<? 


$query = "SELECT COUNT(id) AS numrows FROM gallery";
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
$nomeranastranici .= " <b style=\"color:red; font-size:25px;\">$page</b> ";
}
else
{
$nomeranastranici .= " <a  style=\"font-size:25px;\" href=\"$mf&page=$page\">$page</a> ";
}
}



// създаване на ликовете [предишна] [следваща]
// както и линковете [първа] и [последна]


if ($pageNum > 1)
{
$page = $pageNum - 1;
$predishna = "  <a class=paging href=\"$mf&page=$page\">[<<<<<]</a> ";

$parva = "  <a class=paging href=\"$mf&page=1\">[първа]</a> ";
}
else
{
$predishna = ' ';
$parva = ' ';
}

if ($pageNum < $maxPage)
{
$page = $pageNum + 1;
$sledvashta = "  <a class=paging href=\"$mf&page=$page\">[>>>>>]</a> ";

$posledna = "  <a class=paging href=\"$mf&page=$maxPage\">[последна]</a> ";
}
else
{
$sledvashta = ' ';
$posledna = ' ';
}
echo $nomeranastranici;
  } 



if ($view=="add_cat") {
   ?>
<form method="POST" action="<? echo $mf; ?>view=subm_cat">
<center><table>
<tr><td align="left" >
Име на категорията:</td><td align="left" ><input type="text" name="cat_name" /></td></tr><tr><td align="left" >
Е подкатегория на:</td><td align="left" >
<select name="subcat">
<option value="0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
<? 
$sql = mysql_query("SELECT * FROM gallery_cats WHERE is_sub='0' ORDER by id DESC");
while($row = mysql_fetch_array($sql)) {
    echo "<option value=\"$row[id]\">$row[name]</option>";
 }
?>
</select> (Незадължително)</td></tr><tr><td>
</td><td align="left"><input type="submit" value="Добави" name="submit_cat" /></td></tr>
</table></center>
</form>
  <?
  }
  if ($view=="subm_cat") {
   if (isset($_POST[submit_cat])) {
    $sub = $_POST[subcat];
     mysql_query("INSERT INTO gallery_cats (name,is_sub,title_img) VALUES ('$_POST[cat_name]','$sub','0')") or die(mysql_error());
    echo "Категорията е успешно добавена!";
	redirect($mf."view=cats");
   }
  }
  
  if ($view=="cats") {
  ?>
  <table width="790">
  <tr>
  
  <th>
  Категория:
  </th>
  
     <th>
  Снимки:
  </th>
  
    <th>
  Действия:
  </th>
  
  </tr>
  
  <? function count_imgs($id) {
$sql = mysql_query("SELECT COUNT(id) as numb FROM gallery WHERE in_cat='$id'");
while($row = mysql_fetch_array($sql)) {
 return $row[numb];
 }
}
  $sql = mysql_query("SELECT * FROM gallery_cats WHERE is_sub='0' ORDER by id ASC");
while($row = mysql_fetch_array($sql)) {
  ?>
    <tr><td style="color:#015C98;"><b><? echo $row[name]; ?></b></td> <td><? echo count_imgs($row[id]); ?></td> <td><a href="<? echo $mf; ?>view=edit_cat&id=<? echo $row[id]; ?>" class="add">Промяна</a><a href="<? echo $mf; ?>view=del_cat&id=<? echo $row[id]; ?>" class="delete">Изтриване</a></td></tr>
  <?
    $sql2 = mysql_query("SELECT * FROM gallery_cats WHERE is_sub='$row[id]' ORDER by id ASC");
while($row2 = mysql_fetch_array($sql2)) {
      ?>
	  <tr><td style="color:#880909;" align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><? echo $row2[name]; ?></b></td> <td><? echo count_imgs($row2[id]); ?></td> <td><a href="<? echo $mf; ?>view=edit_cat&id=<? echo $row[id]; ?>" class="add">Промяна</a><a href="<? echo $mf; ?>view=del_cat&id=<? echo $row2[id]; ?>" class="delete">Изтриване</a></td></tr>
	  <?
    }
   }
  ?>
  </table>
  <?
  }
   if ($view=="del_cat") {
    if (isset($_GET[id])) {
	 mysql_query("DELETE FROM gallery_cats WHERE id='$_GET[id]'");
	 echo "Категорията изтрита успешно!";
	 redirect($mf."view=cats");
	}
   }
   
   
   if ($view == "edit_cat") {
     $sql = mysql_query("SELECT * FROM gallery_cats WHERE id='$_GET[id]' LIMIT 1");
while($row = mysql_fetch_array($sql)) {
   ?>
   <form method="POST" action="<? echo $mf; ?>view=ed_cat&id=<? echo $_GET[id]; ?>">
<center><table>
<tr><td align="left" >
Име на категорията:</td><td align="left" ><input type="text" value="<? echo $row[name] ?>" name="cat_name" /></td></tr><tr><td align="left" >
Е подкатегория на:</td><td align="left" >
<select name="subcat">
<option value="0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
<? 
$sql = mysql_query("SELECT * FROM gallery_cats WHERE is_sub='0' ORDER by id DESC");
while($row = mysql_fetch_array($sql)) {
    echo "<option value=\"$row[id]\">$row[name]</option>";
 }
?>
</select> (Незадължително)</td></tr><tr><td>
</td><td align="left"><input type="submit" value="Добави" name="edit_cat" /></td></tr>
</table></center>
</form>
   <?
    }
   }
     if ($view=="ed_cat") {
   if (isset($_POST[submit_cat])) {
    $sub = $_POST[subcat];
     mysql_query("UPDATE gallery_cats SET name='$_POST[cat_name]' , is_sub='$sub' WHERE id='$_GET[id]'") or die(mysql_error());
    echo "Категорията е успешно променена!";
	redirect($mf."view=cats");
   }
  }
   
   if($view=="add") {
    ?>
	<form action='<? echo $mf."view=upload"; ?>' enctype='multipart/form-data' method='POST'>
	<center><table>
<tr><td align="left" >
Заглавие:</td><td><input type='text' name='ime'></td></tr>
<tr><td>Изображение:
</td><td><input type='file' name='fail'></td></tr><tr><td>
В категория:</td><td>
<select name="cat">
<? 
$sql = mysql_query("SELECT * FROM gallery_cats ORDER by id DESC");
while($row = mysql_fetch_array($sql)) {
    echo "<option value=\"$row[id]\">$row[name]</option>";
 }
?>
</select>
</td></tr><tr><td>Главна:</td><td>
<select name="head"> 
<option value="0">Не</option>
<option value="1">Да</option>
</select></td></tr>
<tr><td></td><td align="left">
<input type='submit' value='Качи изображение'></td></tr>
</table></center>
</form>
	<?
   }
   
   
   if ($view=="upload") {
   $ime=$_POST['ime'];
$filename=$_FILES['fail']['name'];
$rename= date("Y_m_d_H_i_s").$filename;
$tempname=$_FILES['fail']['tmp_name'];
$papka = '../modules/gallery/uploads/'; 
$papka2 = "../modules/gallery/thumbs/";  
$putq = $papka.basename($rename);
$type = $_FILES['fail']['type'];
$data = date("d.m.Y");
if (@copy($tempname, $putq)) {
createThumbs($papka,$papka2,100);
if ($_POST[head]==1) {
 mysql_query("UPDATE gallery SET basic='0' WHERE in_cat='$_POST[cat]'");
}
mysql_query("INSERT INTO gallery (image,title,basic,in_cat,data) VALUES ('$rename','$_POST[ime]','$_POST[head]','$_POST[cat]','$data')");
echo "Файла е успешно качен!";
redirect($indexM);
}
   }
   
   if($view == "delete") {
     if (isset($_GET[id])) {
	  mysql_query("DELETE FROM gallery WHERE id='$_GET[id]'");
	  unlink("../modules/gallery/uploads/$_GET[file]");
	  unlink("../modules/gallery/thumbs/$_GET[file]");
	  echo "Файла успешно изтрит!";
	  redirect($indexM);
	 }
   }
}
 ?>