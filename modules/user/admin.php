<? include("../../includes/functions.php"); db(); session_start(); if ($_SESSION[admin]==true) { ?>
<a href="../../admin/index.php?p=modules">[Обратно в Админ панел]</a><p />
<? 
if (isset($_GET[del])) {
mysql_query("DELETE FROM users WHERE id='".$_GET[del]."'");
echo "Потребителя изтрит успешно! <a href='admin.php'>Назад</a>";
}

if (!isset($_GET[del])) {
  $sql = mysql_query("SELECT * FROM users ORDER by id DESC");
  while($row = mysql_fetch_array($sql)) {
    echo "<a href=\"../../index.php?m=user&action=profile&id=$row[id]\">$row[user]</a> [$row[level]] <a href='?del=$row[id]'>:Изтрий:</a> <br />";
  }
}
}
?>