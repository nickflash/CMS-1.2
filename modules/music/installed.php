<? include("../../includes/functions.php"); db();
mysql_query("
CREATE TABLE IF NOT EXISTS `video` (
id int(8) not null auto_increment,
title_m longtext not null,
desc_m longtext not null,
file_m longtext not null,
date_m longtext not null,
PRIMARY KEY (id)
);
") or die (mysql_error());



mysql_query("INSERT INTO menu (name,link,opisanie,active) VALUES ('Video','?m=video','Video','yes')") or die (mysql_error());
echo "Модула успешно инсталиран!<a href='../../admin/'>Назад</a>";
@rename("install.php","installed.php");
@rename("int_.php","int.php");
?>