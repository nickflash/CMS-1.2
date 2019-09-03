<? $index=false; ?>
<head>
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><? echo title(); ?></title>
</head>
<style>
#menu {
 background:#FED69A
}
#menu:hover {
  background:#FEBB56;
}
.menu_font {
 color: #382703;
 font: normal 14px Verdana, Arial, Helvetica, sans-serif;
 text-decoration: none;
}
</style>
<body><center>
<table width="700" border=1><tr><td><img width=700 src='<? theme_dir(); ?>images/logo.jpg'/></td></tr><tr><td>
<? user_panel() ?>
</td></tr>
<tr><td><table width="699" ><tr valign="top" ><td width="130">
<? menu("h",theme_dir("f")."images/arrow_right.png","class=menu_font","<div id=menu >"); //theme_dir() ima f za6toto e vuv funkciq?>
<hr width="130" />
<? plugin("news"); //Странични кирии към модулите ?>
<p />
<b>Времето</b>
<? plugin("weather"); ?>
</td><td>
<? content($_GET[m]); ?></td></tr></table>
</td></tr><tr><td><center><b>copyright nickflash 2009</b></center></td></tr>
</table>
</center>
</body>
<? 
/*
Нито един от параметрите във функциите не е задължителен тук са сложени за окраса булети 
функцията меню се ползва така:
 menu([h за хоризонтално меню и v за вертикално],[Адрес за картинката на булета]);
*/
?>