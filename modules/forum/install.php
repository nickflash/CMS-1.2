<? include("../../functions.php"); db();
mysql_query("
CREATE TABLE IF NOT EXISTS forums (
id int(8) not null auto_increment,
name longtext not null,
opisanie longtext not null,
PRIMARY KEY (id)
)") or die (mysql_error());
mysql_query("CREATE TABLE topic(
id int(8) not null auto_increment,
name longtext not null,
user longtext not null,
data longtext not null,
in_forum longtext not null,
PRIMARY KEY (id)
);
") or die (mysql_error());
mysql_query("CREATE TABLE msg ( 
id int(8) not null auto_increment,
user longtext not null,
msg longtext not null,
in_topic longtext not null,
data longtext not null,
PRIMARY KEY (id)
);") or die (mysql_error());
mysql_query("INSERT INTO menu (name,link,opisanie,active) VALUES ('�����','?m=forum&f=all','�����','yes')") or die (mysql_error());
echo "������ ������� ����������!<a href='../../admin/?p=modules'>�����</a>";
@rename("install.php","installed.php");
?>