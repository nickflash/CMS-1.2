<? include("../../includes/functions.php"); db();
mysql_query("INSERT INTO menu (name,link,opisanie,active) VALUES ('Контакт','?m=contact','Връзка с нас','yes')") or die (mysql_error());
echo "Модула успешно инсталиран!<a OnClick=\"window.close()\" href='#'>Затвори прозореца</a>";
@rename("install.php","installed.php");
@rename("int_.php","int.php");
?>