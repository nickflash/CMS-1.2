<? include("../../includes/functions.php"); db();
mysql_query("
CREATE TABLE IF NOT EXISTS users (
id int(8) not null auto_increment,
user longtext not null,
password longtext not null,
email longtext not null,
date longtext not null,
level longtext not null,
PRIMARY KEY (id)
);
") or die (mysql_error());
mysql_query("INSERT INTO menu (name,link,opisanie,active) VALUES ('�����������','?m=user&action=allusers','������ � ���','yes')") or die (mysql_error());
echo "������ ������� ����������!<a href='../../admin/'>�����</a>";
@rename("install.php","installed.php");
?>