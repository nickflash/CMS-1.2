CREATE TABLE IF NOT EXISTS menu (
id int(8) not null auto_increment,
name longtext not null,
link longtext not null,
opisanie longtext not null,
active longtext not null,
PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS submenus (
id int(8) not null auto_increment,
name longtext not null,
link longtext not null,
opisanie longtext not null,
active longtext not null,
PRIMARY KEY (id)
);

INSERT INTO menu (name,link,opisanie,active) VALUES ('Начало','index.php','Начало на сайта','yes');

CREATE TABLE IF NOT EXISTS admins (
id int(8) not null auto_increment,
name longtext not null,
pass longtext not null,
PRIMARY KEY (id)
);

INSERT INTO admins (name,pass) VALUES ('admin','21232f297a57a5a743894a0e4a801fc3');

CREATE TABLE IF NOT EXISTS siteconfig (
id int(8) not null auto_increment,
name longtext not null,
theme longtext not null,
index_page longtext not null,
PRIMARY KEY (id)
);

INSERT INTO siteconfig (name,theme,index_page) VALUES ('CMS module system','default','?m=custompages&pid=1');

CREATE TABLE IF NOT EXISTS pages (
id int(8) not null auto_increment,
name longtext not null,
content longtext not null,
PRIMARY KEY (id)
);

INSERT INTO pages (name,content) VALUES ('Начало','Това е началната страница на нашата система.');

CREATE TABLE IF NOT EXISTS news (
id int(8) not null auto_increment,
title longtext not null,
news longtext not null,
date longtext not null,
PRIMARY KEY (id)
);

INSERT INTO news (title,news,date) VALUES ('Пробна новина','Това което виждате е пробна новина.','29.03.2009 г.  16:18 ч.');
INSERT INTO menu (name,link,opisanie,active) VALUES ('Новини','?m=news','Новини в сайта','yes');

CREATE TABLE IF NOT EXISTS statistics (
id int(8) not null auto_increment,
ips longtext not null,
impressions longtext not null,
PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS gallery (
id int(8) not null auto_increment,
image longtext not null,
title longtext not null,
basic int(8) not null,
in_cat int(11) not null,
`data` int(11) not null,
PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS gallery_cats (
id int(8) not null auto_increment,
name longtext not null,
is_sub int(8) not null,
title_img int(8) not null,
PRIMARY KEY (id)
);

