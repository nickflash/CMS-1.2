<? $path = "templates/default"; ?>
<META http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><? echo title(); ?></title>
<body><center>
<table width="700" border=1><tr><td>
<img width=700 src='templates/default/images/logo.jpg'/></td></tr>
<tr><td><? menu("h","$path/images/bullet_star.png"); ?> &nbsp&nbsp&nbsp; <? getLang(); ?> </td></tr><tr><td>
<? user_panel(); ?> </td></tr>
<tr><td>
<? content($_GET["m"]); ?>
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
