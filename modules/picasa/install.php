<? include("../../includes/functions.php"); db();
mysql_query("
CREATE TABLE IF NOT EXISTS `picasa` (
id int(8) not null auto_increment,
username longtext not null,
per_row longtext not null,
per_page longtext not null,
basic int(8) not null,
PRIMARY KEY (id)
);
") or die (mysql_error());


mysql_query("INSERT INTO menu (name,link,opisanie,active) VALUES ('�������','?m=picasa','�������','yes')") or die (mysql_error());
echo "������ ������� ����������!<a href='../../admin/'>�����</a>";
@rename("install.php","installed.php");
@rename("int_.php","int.php");
?>