<?
$nameM="designer"; 
$mf="?module=$nameM&"; 
$indexM="?module=$nameM";
if ($_SESSION[admin]==true) {
$view = $_GET[v];
$editor = "
<script type='text/javascript'>
window.onload = function() {
	var oFCKeditor = new FCKeditor( 'template' ) ;
	oFCKeditor.BasePath	= '../fckeditor/' ;
	oFCKeditor.ReplaceTextarea() ;
}
</script>";

if ($view == "new") {
echo $editor;
    ?>
	 <form action="<? echo $mf;?>v=subm" method="POST">
	 <table width="790px">
	   <tr><td>КОМАНДИ:</td></tr>
	   <tr><td>
	    [TITLE]  - Заглавие на страницата<br />
		[MENU-HORIZONTAL] - Хоризантално меню<br />	
		[MENU-VERTICAL] - Вертикално меню<br />
		[CONTENT] - Съдържание на модулите<br />
		[PLUGIN] - Плугин на модула<br />
		[CUSTOM-плугинът] - Друг плугин <br />
		[USER-PANEL] - Потребителски панел <br />
	   </td></tr>
	   <tr><td>Заглавие на папка:<input type="text" name="dir" /></td></tr>
	   <tr><td><textarea name="template">
	   
	   
<META http-equiv="Content-Type" content="text/html; charset=Windows-1251">
<title>[TITLE]</title>
<body><center>
<table width="700" border=1><tr><td>
<img width=700 src='../../templates/default/images/logo.jpg'/></td></tr>
<tr><td>[MENU-HORIZONTAL] &nbsp&nbsp&nbsp; <a href="?l=bg">BG</a> / <a href="?l=en">EN</a></td></tr><tr><td>
[USER-PANEL]</td></tr>
<tr><td>
[CONTENT]
</td></tr><tr><td><center><b>copyright nickflash 2009</b></center></td></tr>
</table>
</center>
</body>
	   
	   
	   </textarea></td></tr>
	   <tr><td><input type="submit" value="Направи темплейт" /></td></tr>
	 </form>
	<?
 }
 if ($view =="subm") {
    $tmpl = $_POST[template];
	$dir = $_POST[dir];
	
	$tmpl = str_replace("[TITLE]","<? echo title(); ?>",$tmpl);
	$tmpl = str_replace("[MENU-HORIZONTAL]",'<? menu("h"); ?>',$tmpl);
	$tmpl = str_replace("[MENU-VERTICAL]",'<? menu("v"); ?>',$tmpl);
	$tmpl = str_replace("[CONTENT]",'<? content($_GET[m]); ?>',$tmpl);
	$tmpl = str_replace("[USER-PANEL]",'<? user_panel() ?>',$tmpl);
	@mkdir("../templates/$_POST[dir]");
		 $newfile = fopen("../templates/$_POST[dir]/theme.php", "w+");
		 $striped = stripslashes($tmpl);

         fputs($newfile, $striped);
		 
	echo "Темплейта успешно добавен!";
 }
}
?>