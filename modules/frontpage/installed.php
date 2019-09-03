<? include("../../includes/functions.php"); db();
mysql_query("
CREATE TABLE IF NOT EXISTS gallery (
id int(8) not null auto_increment,
image longtext not null,
title longtext not null,
basic int(8) not null,
in_cat int(11) not null,
`data` int(11) not null,
PRIMARY KEY (id)
);
") or die (mysql_error());

mysql_query("
CREATE TABLE IF NOT EXISTS gallery_cats (
id int(8) not null auto_increment,
name longtext not null,
is_sub int(8) not null,
title_img int(8) not null,
PRIMARY KEY (id)
);

") or die (mysql_error());

mysql_query("INSERT INTO menu (name,link,opisanie,active) VALUES ('Галерия','?m=gallery','Галерия','yes')") or die (mysql_error());
echo "Модула успешно инсталиран!<a href='../../admin/'>Назад</a>";
@rename("install.php","installed.php");
@rename("int_.php","int.php");
?>