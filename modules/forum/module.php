<? 
echo "Форуми";

//forums
if($_GET['f']=="all") {
$sql = mysql_query("SELECT * FROM forums ORDER by ID DESC");
while ($row=mysql_fetch_array($sql)) {
        $c = mysql_query("SELECT COUNT(*) FROM topic WHERE in_forum='$row[id]'");
        $total = mysql_fetch_array($c);
        $num = $total[0];
		$n +=1;
		if ($n == 1) {
		$hr = "";
		}
		if ($n > 1) {
		$hr = "<hr width=650 />";
		}
		echo "<table border=0 width=650>";
echo "<tr><td align=left >>> <b><a href=forum.php?f=topics&id=$row[id] > $row[name]</a></b> </td><td align=right >(Теми:$num)</td></tr>
<tr><td align=left>".emotes($row[opisanie])." </td></tr>$hr";
echo "</table>";
}



}

// TEMI :P 

if($_GET['f']=="topics") {
$id = $_GET['id'];

$broinastranica = 25;

// от коя страница да почне да показва.Може да искаме да е от втора или от последна.

$pageNum = 1;

// ако има получени данни $_GET['page'] ще покаже страницата с номер $_GET['page']

if(isset($_GET['page']))
{
$pageNum = $_GET['page'];
}

//тука определяме кои редове ще се показват - примерно ако $_GET['page']=2
// ще покаже от 20 до 40-ти ред.
$redove = ($pageNum - 1) * $broinastranica;
//заявката ще върне само посочените редове - примерно от 20 до 40 в зависимост от $_GET['page']





$sv = mysql_query("SELECT * FROM forums WHERE id='$id' ORDER by id LIMIT 1");
while ($v = mysql_fetch_array($sv)) {
echo "<b><a href=forum.php?f=all>Форуми</a></b> > $v[name]";
}

echo "<p />";
 $c = mysql_query("SELECT COUNT(*) FROM topic WHERE in_forum='$id'");
        $total = mysql_fetch_array($c);
        if ($total[0] == 0 ) {
		echo "Все още няма теми в този форум.";
		$paging=false;
		}
		else {
		$paging=true;
		}
		//ako nqma 
		echo  "<table border=0 width=650>";
		if ($total[0] != 0 ) {
		echo "<tr><td width=200 align=left>ТЕМИ</td><td width=100 align=right>ОТГОВОРИ</td><td width=120 align=right>ДАТА | ЧАС</td><td align=left width=70>ОТ</td></tr><tr><td width=10></td></tr>";
		}
		$sql = mysql_query("SELECT * FROM topic WHERE in_forum='$id' ORDER by ID DESC "."LIMIT $redove, $broinastranica");
         while ($row=mysql_fetch_array($sql)) {
		 
		 if ($_SESSION[user]==$row[user]) {
		$del = "<a href=forum.php?f=topics&id=$id&d=$row[id]>[изтрий]</a>";
		}
         if (isadmin($_SESSION["user"])==1) {
		 $del = "<a href=forum.php?f=topics&id=$id&d=$row[id]>[изтрий]</a>";
		 }
		  if (ismod($_SESSION["user"])==1) {
		  $del = "<a href=forum.php?f=topics&id=$id&d=$row[id]>[изтрий]</a>";
		 }
		  
		  
            echo "<tr><td width=200 align=left><b><a href=forum.php?f=read&topic=$row[id]>".substr($row[name],0,56)."</a></b>$del</td><td width=100 align=right>".answers($row[id]). "</td><td width=120 align=right>$row[data] </td><td align=left width=70><b><a href='profile.php?user=$row[user]'>$row[user]</a></b></td></tr>";
		}
		echo "</table>";
	
		if (isset($_GET[d])) {
		$del = $_GET[d];
		$sqq = mysql_query("SELECT * FROM topic WHERE id='$del'");
		while ($sml = mysql_fetch_array($sqq)) {
		if ($sml[user]==$_SESSION['user']) {
		mysql_query("DELETE FROM topic WHERE id='$del'");
		mysql_query("DELETE FROM msg WHERE in_topic='$del'");
		echo "<p />Темата изтрите успешно!";
		}
		}
		}
		
	// проверяваме таблицата колко редове има
$query = "SELECT COUNT(id) AS numrows FROM topic WHERE in_forum='$id'";
$result = mysql_query($query) or die('Error, query failed');
$row = mysql_fetch_array($result, MYSQL_ASSOC);
$numrows = $row['numrows'];


$maxPage = ceil($numrows/$broinastranica);

$self = $_SERVER['PHP_SELF'];
$nomeranastranici = '';

for($page = 1; $page <= $maxPage; $page++)
{
if ($page == $pageNum)
{
$nomeranastranici .= " $page ";
}
else
{
$nomeranastranici .= " <a class=paging href=\"$self?f=read&topic=$topic&page=$page\">$page</a> ";
}
}
// показваме
echo "<p>";

$new= "<a href=forum.php?f=new&forum=$id><img src=images/new_topic.gif border=0 /></a>";
if ($paging==true) {
$pages = "страници:";
}
else { $pages=""; }	
echo "<p><table width=650><tr><td align=left><b>$new</b></td><td align=right>$pages <b>$nomeranastranici</b></td><td width=10></td></tr></table>";

}



//NEW THREAD



if($_GET['f']=="new") {
$id = $_GET['forum'];
if ($_SESSION["user"]==true) {
echo "
<form method=POST action=forum.php?f=new&forum=$id >
<b>Заглавие:</b><input type=text name=topic style='width:250px;' /><p>
         <b>съобщение:</b><br />
<textarea cols=100 rows=10 name=msg class=sk ></textarea>
<p><input type=submit name=submit value='Изпрати' />
</form>
";
}
if ($_SESSION["user"]==false) {
echo "Само <b><a href=register.php>регистрирани</a></b> потребители могат да пускат теми!";
}
if (isset($_POST['submit'])) {
$name = secure($_POST['topic']);
$msg = secure($_POST['msg']);

$data = date("Y-m-d  H:i:s");
mysql_query("INSERT INTO topic (name,user,data,in_forum) VALUES ('$name','".$_SESSION["user"]."','$data','$id')");
$s = mysql_query("SELECT * FROM topic WHERE name='$name' LIMIT 1");
while ($e = mysql_fetch_array($s)) {
mysql_query("INSERT INTO msg (user,msg,in_topic,data) VALUES ('".$_SESSION["user"]."','$msg','$e[id]','$data')");
echo "<p><b>Темата добавена успешно!</b> | <b><a href='forum.php?f=read&topic=$e[id]'>към темата</a> | </b>";
}

} if (!$_POST['submit']) {echo "<p>"; }echo "<b><a href=forum.php?f=topics&id=$id >Назад</a></b>";
}


// READ TOPIC


if($_GET['f']=="read") {


$topic = $_GET['topic'];
$sq = mysql_query("SELECT * FROM topic WHERE id='$topic' ORDER by id LIMIT 1");
while ($p = mysql_fetch_array($sq)) {
$sv = mysql_query("SELECT * FROM forums WHERE id='$p[in_forum]' ORDER by id LIMIT 1");
while ($v = mysql_fetch_array($sv)) {
echo "<b><a href=forum.php?f=all>Форуми</a></b> > <b><a href=forum.php?f=topics&id=$v[id]>$v[name]</a></b> > $p[name]";
}
}
echo "<p />";
$broinastranica = 5;

// от коя страница да почне да показва.Може да искаме да е от втора или от последна.

$pageNum = 1;

// ако има получени данни $_GET['page'] ще покаже страницата с номер $_GET['page']

if(isset($_GET['page']))
{
$pageNum = $_GET['page'];
}

//тука определяме кои редове ще се показват - примерно ако $_GET['page']=2
// ще покаже от 20 до 40-ти ред.
$redove = ($pageNum - 1) * $broinastranica;
//заявката ще върне само посочените редове - примерно от 20 до 40 в зависимост от $_GET['page']

$us = $_SESSION['user'];
$sqls = mysql_query("SELECT * FROM msg WHERE in_topic='$topic' ORDER by id "."LIMIT $redove, $broinastranica");
while ($rows = mysql_fetch_array($sqls)) {
//edit

if ($rows["user"]==$us) {
$edit = "<a href=forum.php?f=edit&topic=$topic&post=$rows[id] style='color:#CC0000;'>[EDIT]</a>";
}

else { 
$edit="";
}
if (isadmin($us)==1) {
$edit = "<a href=forum.php?f=edit&topic=$topic&post=$rows[id] style='color:#CC0000;'>[EDIT]</a>";
}

if (ismod($us)==1) {
$edit = "<a href=forum.php?f=edit&topic=$topic&post=$rows[id] style='color:#CC0000;'>[EDIT]</a>";
}
if (isadmin($_SESSION["user"])==1) {
$del = " <b><a href=forum.php?f=read&topic=$topic&dd=$rows[id] >[del]</a></b>";
}
if (ismod($_SESSION["user"])==1) {
$del = " <b><a href=forum.php?f=read&topic=$topic&dd=$rows[id] >[del]</a></b>";
}


echo "<table bgcolor=#FFFFFF width=650 style='BORDER: #666666 1px solid;' ><tr valign=top ><td><table bgcolor=#FFFFFF width=100 border=0 id='forum_avatar' ><tr  ><td width=100 align=left  ><b><a href=profile.php?user=$rows[user]>$rows[user]</a></b><br /><a href=profile.php?user=$rows[user]>".user_avatar($rows[user])."</a></td></tr><tr><td align=left >постове:".posts($rows[user])."<br /><center>".is_admin($rows['user'])."</center></td></tr></table></td><td align=right>
<table bgcolor=#FFFFFF width=550 border=0><tr><td align=left>".url_replace(img_replace(emotes(nl2br($rows[msg]))))."</td></tr><tr><td align=left><hr style='color:#CCCCCC;' width=350 align=left /><b class=data >$rows[data] $del $edit</b></td></tr></table></td></tr></table> <p />";
}

// проверяваме таблицата колко редове има
$query = "SELECT COUNT(user) AS numrows FROM msg WHERE in_topic='$topic'";
$result = mysql_query($query) or die('Error, query failed');
$row = mysql_fetch_array($result, MYSQL_ASSOC);
$numrows = $row['numrows'];


$maxPage = ceil($numrows/$broinastranica);

$self = $_SERVER['PHP_SELF'];
$nomeranastranici = '';

for($page = 1; $page <= $maxPage; $page++)
{
if ($page == $pageNum)
{
$nomeranastranici .= " $page ";
$gg="$page";
}
else
{
$nomeranastranici .= " <a class=paging href=\"$self?f=read&topic=$topic&page=$page\">$page</a> ";
$gg="$page";
}

}
if (isset($_GET['dd'])) {
$idd = $_GET['dd'];
mysql_query("DELETE FROM msg WHERE id='$idd'");
echo "<META HTTP-EQUIV=\"Refresh\" content=\"X;URL=forum.php?f=read&topic=$topic&page=$gg\">";
echo "Изтрито успешно!";
}
// показваме
echo "<p>";

echo "<table width=650><tr><td width=20 ></td><td align=left>страници: <b>$nomeranastranici</b></td></tr></table>";
//otgovor

if ($_SESSION["user"] == true) {
echo "<p /><form method=POST action=\"forum.php?f=read&topic=$topic\" name=\"form\" >
<b>отговор:</b><br>
";
echo echo_emotes();
echo "<br />
<textarea name=comment id='otgovor' class=sk cols=80 rows=5  value='' ></textarea><br />
<input type=submit name=sub value=изпрати />
</form>";
if (isset($_POST['sub'])) {
$user=$_SESSION["user"];
$reply = secure($_POST["comment"]);
$data = date("Y-m-d H:i:s");
mysql_query("INSERT INTO msg (user,msg,in_topic,data) VALUES ('$user','$reply','$topic','$data')");
echo "<META HTTP-EQUIV=\"Refresh\" content=\"X;URL=forum.php?f=read&topic=$topic&page=$gg\">";
}

}


}



// EDIT POST

if($_GET['f']=="edit") {
$topic = $_GET[topic];
$post = $_GET[post];
$user = $_SESSION["user"];
if ($_SESSION["user"]==true) {
$oo = mysql_query("SELECT * FROM msg WHERE id='$post' ORDER by id DESC LIMIT 1");
while ($u = mysql_fetch_array($oo)) {
echo "
<form method=POST action=forum.php?f=edit&topic=$topic&post=$post >
         <b>съобщение:</b><br />
<textarea cols=100 rows=10 name=edit class=sk >$u[msg]</textarea>
<p><input type=submit name=submitedit value='Промени' />
</form>
";}
}
if ($_SESSION["user"]==false) {
echo "Само <b><a href=register.php>регистрирани</a></b> потребители могат да пускат теми!";
}
if (isset($_POST['submitedit'])) {
$edit = secure($_POST['edit']);
$s = mysql_query("SELECT * FROM topic WHERE id='$topic' LIMIT 1");
while ($e = mysql_fetch_array($s)) {
mysql_query("UPDATE msg SET msg='$edit' WHERE id='$post'");

echo "<p><b>Поста променен успешно!</b> | <b><a href='forum.php?f=read&topic=$e[id]'>към поста</a>  </b>";

}

} if (!$_POST['submit']) {echo "<p>"; }echo "<b><a href=forum.php?f=read&topic=$topic >Назад</a></b>";

}



//fix na dizain

if ($_GET['f'] == "all") {

echo spacer("Нови теми:");
$ssql = mysql_query("SELECT * FROM topic ORDER by ID DESC LIMIT 10");
while ($g =mysql_fetch_array($ssql)) {
echo "<a href=forum.php?f=read&topic=$g[id] ><b>$g[name]</b>(".answers($g[id]).")</a><br />";
}

}
?>