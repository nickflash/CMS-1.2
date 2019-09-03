<?  $nameM="config"; $mf="?module=$nameM&"; $indexM="?module=$nameM"; /*if ($_SESSION[dev]!=true) { ?><center>
<form action="<? echo $indexM; ?>" method="POST">
<table
Парола:<input name="pass" type="password">
<input type="submit" name="sub" value="Достъп" >
</form></center>
<? } 
if(isset($_POST[sub])) {
 $pass=$_POST[pass];
 if ($pass=="windows98") {
  $_SESSION[dev]="1";
  redirect($indexM);
 }
}
if ($_SESSION[dev]==true) { */
?>

<?
if ($_GET["p"] == "menus") {
?><p /><?
if ($_GET["view"] =="menu") {
?>
<form action="<? echo $mf; ?>p=menus" method="POST">
Име на линк:<input type="text" name="name"><p />
URL на линк:<input type="text" name="link"><p />
Описание(alt) на линк:<input type="text" name="opisanie"><p />
<input type="submit" name="addlink" value="Добави линк" >
</form>
<?
}
if (!isset($_GET["view"])) {
echo "<b>Текущи менюта:</b><p />";
$sql = mysql_query("SELECT * FROM menu ORDER by id ASC");
while($row=mysql_fetch_array($sql)) {
echo "$row[name] => $row[link] ($row[opisanie]) <a href='$inedexM&menus&view=edit&mid=$row[id]'>[Промени]</a> <a href='$indexM&menus&view=del&mid=$row[id]'>[Изтрий]</a> <br />";
}
}
if ($_GET["view"] == "del") {
$mid = $_GET["mid"];
mysql_query("DELETE FROM menu WHERE id='$mid'");
echo "Линка изтрит успешно!";
}
if ($_GET["view"] == "edit") {
$mid = $_GET["mid"];
$sql = mysql_query("SELECT * FROM menu WHERE id='$mid'");
while($row=mysql_fetch_array($sql)) {
	echo "<form action=\"$indexM&p=menus&view=edit&mid=$mid\" method=\"POST\">
	Име на линк:<input type=\"text\" value=\"$row[name]\" name=\"name\"><p />
	URL на линк:<input type=\"text\" value=\"$row[link]\" name=\"link\"><p />
	Описание(alt) на линк:<input type=\"text\" value=\"$row[opisanie]\" name=\"opisanie\"><p />
	<input type=\"submit\" name=\"editlink\" value=\"Промени линк\" >
	</form>";
}
if (isset($_POST["editlink"])) {
	$lname = $_POST["name"];
	$llink = $_POST["link"];
	$lopisanie = $_POST["opisanie"];
	mysql_query("UPDATE menu SET name='$lname' , link='$llink' ,opisanie='$lopisanie' WHERE id='$mid' ");
	echo "<p />Линка променен успешно!";
	}
}

if (isset($_POST["addlink"])) {
	$lname = $_POST["name"];
	$llink = $_POST["link"];
	$lopisanie = $_POST["opisanie"];
	mysql_query("INSERT INTO menu (name,link,opisanie,active) VALUES ('$lname','$llink','$lopisanie','yes')");
	echo "<p />Линка добавен успешно!";
	}
}

if ($_GET["p"] == "modules") {
	?>
	<table class="pagetable" width="800">
	<thead><tr>
	<th></th><th >Модул</th><th >Статус</th><th>Действия</th></tr> </thead>
	<?
$path = "../modules";
if (isset($_GET["on"])) {
		@rename("$path/".$_GET["on"]."/moduleOFF.php","$path/".$_GET["on"]."/module.php");

		mysql_query("UPDATE menu SET active='yes' WHERE active='no' && link LIKE '%".$_GET[on]."%'");
	}
if (isset($_GET["off"])) {
	@rename("$path/".$_GET["off"]."/module.php","$path/".$_GET["off"]."/moduleOFF.php");
	$mname=$_GET["off"];
	mysql_query("UPDATE menu SET active='no' WHERE active='yes' && link LIKE '%$mname%'");
}
$dir_handle = @opendir($path) or die("Unable to open $path");
while ($file = readdir($dir_handle)) 
{
if (!strstr($file,".")){
if (file_exists("$path/$file/module.php") && !file_exists("$path/$file/install.php")){
$active="<img border='0' src='../modules/config/on.png'>";
$turn = "<a class=\"delete\" href='$indexM&p=modules&off=$file'>Изключи?</a>";
if (file_exists("$path/$file/admin.php")) {
$admin = "<a class=\"reset\" href='?module=$file'>АДМИНИСТРАЦИЯ</a>";
}
if (!file_exists("$path/$file/admin.php")) {
$admin = "";
}
}
if (!file_exists("$path/$file/module.php") && !file_exists("$path/$file/install.php")){
$active="<img border='0' src='../modules/config/off.png'>";
$turn = "<a class=\"add\" href='$indexM&p=modules&on=$file'>Включи?</a>";
$admin = "";
}
if (file_exists("$path/$file/install.php")) {
$active="UNINSTALLED";
$turn = "<a class=\"publish\" href='$path/$file/install.php' target=\"_blank\">Инсталирай?</a>";
$admin = "";
}


	 for ($i=0;$i<count($icon);$i++) {
              if (file_exists("../modules/$file/".$icon[$i])) {
			      $imgF = $icon[$i];
			  }
        }	 
	 if (!file_exists("../modules/$file/$imgF")) {
	    $fnIM = "images/blank.png";
	 }
	 else {
	   $fnIM = "../modules/$file/$imgF";
	 }
	 
	for ($w=0;$w<count($conf_tit); $w++) {
	  $pp = explode("][",$conf_tit[$w]);
	  if ($pp[1] == $file) {
	    $nameMD = $pp[0];
	  }
	}
	
	//tr($s+=1);
   echo "<td align='center'><img src=\"$fnIM\" /></td><td>$nameMD</td><td>$active</td><td>$turn $admin</td></tr>";
    
   }
   
}
closedir($dir_handle);
?>
</table>
<?
}
if (@$_GET[p] == "siteconfig") {
?>
<b>Конфигурация</b> <p />
<?
$sql = mysql_query("SELECT * FROM siteconfig ORDER by id ASC");
while($row=mysql_fetch_array($sql)) {
echo "<form action=\"$indexM&p=siteconfig&a=b\" method=\"POST\">
Име на сайта:<input type=\"text\" value=\"$row[name]\" name=\"name\"><p />
Тема:<p />
<select name=\"theme\">";

$path = "../templates";
$dir_handle = @opendir($path) or die("Unable to open $path");
while ($file = readdir($dir_handle)) 
{
if (!strstr($file,".")){
   echo "<option value=\"$file\">$file</option>";
   }
}
closedir($dir_handle);
echo "</select><p />
Начална страница:<input type=\"text\" value=\"$row[index_page]\" name=\"index_page\"><p />
<input type=\"submit\" name=\"editconf\" value=\"Промени\"></form>";
 }
 if (isset($_POST[editconf])) {
 mysql_query("UPDATE siteconfig SET name='".$_POST["name"]."',theme='".$_POST["theme"]."' , index_page='".$_POST["index_page"]."' WHERE id='1'");
 echo "<p />Настройките успешно променени!";
 }
}



if ($_GET["p"] == "admins") {
?>
<b>Администраторски акаунти</b> <p />
 <p />
<?
 if (isset($_GET["del"])) {
   mysql_query("DELETE FROM admins WHERE id='".$_GET["del"]."'");
   echo "Администратора изтрит успешно! <a href='?p=admins'>Назад</a>";
   redirect($mf."p=admins");
 }
 if (!isset($_GET["del"]) && !isset($_GET["ac"])) {
   ?>
<table class="pagetable" width="800">
<thead><tr>
<th></th><th>Име</th><th>Действия</th></tr></thead>
   <?
   $sql = mysql_query("SELECT * FROM admins ORDER by id DESC");
   while($row = mysql_fetch_array($sql)) {
     tr($i+=1);
     echo "<td></td><td>$row[name]</td><td><a class=\"delete\" href='$indexM&p=admins&del=$row[id]'><img border='0' src='../admin/images/delete.png'></a></td></tr>";
   }
   ?>
   </table>
   <?
  }
  if (@$_GET["ac"] == "edit") {
   ?>
 <form action="index.php?p=admins&ac=add" method="POST">
  Администраторско име:<input type="text" name="name"><p />
  Парола:<input type="password" name="pass"><p />
  <input type="submit" name="addlink" value="Добави" >
 </form>
   <?
  }
  if ($_GET["ac"] == "add") {
    $name = $_POST["name"];
	$pass = $_POST["pass"];
	$passMD = md5($pass);
	mysql_query("INSERT INTO admins (name,pass) VALUES ('$name','$passMD')");
	echo "Администратора добавен успешно! <a href='?p=admins'>Назад</a>";
  }
 }
 if (!isset($_GET["p"])) {
  redirect($mf."p=modules");
 }
 //}