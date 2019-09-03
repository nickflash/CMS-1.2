<? $path = "templates/default"; ?>
<META http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><? echo title(); ?></title>
<style>
body {
/*  font: italic bold normal small/1.4em Verdana, sans-serif; */
font-family:Verdana,Helvetica,sans-serif;}
background: #FFFFFF;
background-repeat:repeat-x;
}
#mnu {
	position: relative;
	left:-10px;
	top:54px;
}

	#content {
	 padding-left:0px;
	}
	
	
	
	#coolMenu,
#coolMenu ul {
    list-style: none;
}
#coolMenu {
    float: left;
}
#coolMenu > li {
    float: left;
	background: #FFFFFF;
    margin:0 20px 20px 0px; vertical-align:top /*  Space between menu */
}
#coolMenu li a {
display: block;
    height: 2em;
    line-height: 2em;
    padding: 0em 0em;
    text-decoration: none;
}
#coolMenu ul {
    position: absolute;
    display: none;
z-index: 999;
}
#coolMenu ul li a {
    width: 200px; /* wicth of submenus */
}
#coolMenu li:hover ul {
    display: block;
}

/* Main menu
------------------------------------------*/
#coolMenu {
    font-family: Arial;
    font-size: 15px;
    
}
#coolMenu > li > a {
display: block;
	padding: 2px 15px;
	text-decoration: none;
	font-weight: bold;
	color: #253a62;
	
}
#coolMenu > li:hover > a {
   color: #ba6045;
	
    background-color: #FFFFFF;
}
 
/* Submenu
------------------------------------------*/
#coolMenu ul {
    background: #FFFFFF;
	width:176px;
	padding-bottom:5px;
}

#coolMenu ul li a {
    color: #000;
	padding-left:5px;
	position:relative;
    left:-35px;
}
#coolMenu ul li:hover a {
    background: #dfdfdf;
}
#coolMenu {
 position:relative;
 top:10px;
 left:-35px;
}
</style>

<body><center>
<table width="700" border=0><tr><td height="57">
<img width="250" src='templates/spas/logo.png'/></td>


<td height="57">




<!-- ???????????????????????????????????? -->
<ul id="coolMenu">
    <li><a href="#">Начало</a></li>
    <li>
        <a href="#">Портфолио</a>
        <ul>
            <li><a href="#">Книжки за оцветяване</a></li>
            <li><a href="#">Герои</a></li>
            <li><a href="#">Скици</a></li>
			<li><a href="#">Детски книжки</a></li>
        </ul>
    </li>
    <li><a href="#">За мен</a></li>
 
</ul>

</td>
</tr>
<tr>
<td colspan="2">
<div style="width:600px;position:relative; bottom:25px; border-color:#e7e7e7; border-bottom-style:dotted;"></div>
</td>
</tr>
<tr>
<td colspan="2">

<tr>
<td id="content" colspan="2">
<? content($_GET["m"]); ?>
</td>
</tr>
<tr>
<td colspan="2" >
<img src='templates/spas/footerdivider.png'/>
<center></center></td>
</tr>
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
