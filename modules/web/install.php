<? include("../../includes/functions.php"); db();
mysql_query("
CREATE TABLE IF NOT EXISTS `web` (
id int(8) not null auto_increment,
title_w longtext not null,
url_w longtext not null,
desc_w longtext not null,
date_w longtext not null,
PRIMARY KEY (id)
);
") or die (mysql_error());

mysql_query("
CREATE TABLE IF NOT EXISTS `web_img` (
id int(8) not null auto_increment,
title_w longtext not null,
image_w longtext not null,
cover_w int(11) not null,
PRIMARY KEY (id)
);
") or die (mysql_error());

mysql_query("INSERT INTO menu (name,link,opisanie,active) VALUES ('Video','?m=video','Video','yes')") or die (mysql_error());
echo "Модула успешно инсталиран!<a href='../../admin/'>Назад</a>";
@rename("install.php","installed.php");
@rename("int_.php","int.php");
?>