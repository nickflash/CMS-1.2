<center>

<? 
if ($_GET[action]=="register" && !isset($_GET[go])) {
?>
<b><? echo REGISTRATION; ?>:</b>
<p />
<form action="?m=user&go=register" method="POST">
<table border="0">
<tr><td align="left" ><? echo USERNAME; ?>:</td><td><input type="text" name="username" /></td></tr>
<tr>
<td align="left" ><? echo PASSWORD; ?>:</td><td><input type="password" name="password" /></td></tr>
<tr>
<td align="left"  ><? echo R_PASSWORD; ?>:</td><td><input type="password" name="confirm" /></td></tr>
<tr>
<td align="left" ><? echo  Y_EMAIL; ?>:</td><td><input type="text" name="email" /></td></tr>
<tr>
<td align="left" height="10" ></td><td></td></tr>
<tr>
<td></td><td align="right" ><input type="submit" name="register" value="<? echo REG_BUTT ?>" /></td></tr>
</table>
</form>
<?
}
if ($_GET[action]=="login" && !isset($_GET[go])) {
?>
<b><? echo LOGIN ?>:</b>
<p />
<form action="?m=user&go=login" method="POST">
<table border="0">
<tr><td align="left" ><? echo USERNAME; ?>:</td><td><input type="text" name="username" /></td></tr>
<tr>
<td align="left" ><? echo PASSWORD; ?>:</td><td><input type="password" name="password" /></td></tr>
<tr>
<td align="left" height="10" ></td><td></td></tr>
<tr>
<td></td><td align="right" ><input type="submit" name="login" value="<? echo LOG_BUTT; ?>" /></td></tr>
</table>
</form>
<?
}
if ($_GET[go]=="login") {
 if (isset($_POST[login])) {
  $user = $_POST[username];
  $pass = $_POST[password];
  $passMD5 = md5($pass);
  $sql = mysql_query("SELECT * FROM users WHERE user='$user'");
  while($row = mysql_fetch_array($sql)) {
    if ($row[password]==$passMD5) {
	       $_SESSION[user] = $user;
		   $_SESSION[id] = $row[id];
	   echo "".LOGIN_SUCC." <a href=\"index.php\">".CONTINIUE."</a>";
	}
   }
  }
}

if ($_GET[action] == "logout") {
session_unset();
echo LOGOUT_SUCC;
}

if ($_GET[go]=="register") {
 if (isset($_POST[register])) {
  $user = $_POST[username];
  $pass = $_POST[password];
  $confirm = $_POST[confirm];
  $email = $_POST[email];
  $date = date("d.m.Y , H:i:s");
  if (empty($user) or empty($pass) or empty($confirm) or empty($email)) {
   echo U_ERROR_1."<br />";
  }
  if (!eregi("@",$email) or !eregi(".",$email)) {
   echo U_ERROR_2."<br />";
  }
  if ($pass != $confirm) {
   echo U_ERROR_3;
  }
  if (!empty($user) && !empty($pass) && !empty($confirm) && !empty($email) && eregi("@",$email) && $pass == $confirm && eregi(".",$email)) {
   $passMD = md5($pass);
    $reg = mysql_query("INSERT INTO users (user,password,email,date,level) VALUES ('$user','$passMD','$email','$date','user')");
	if ($reg) {
	echo REG_SUCC."<a href=\"?m=user&action=login\">".LOGIN." ?</a>";
	 }
   }
  }
}

if ($_GET[action]=="profile") {
  if (is_numeric($_GET[id])) {
    $id = $_GET[id];
  }
  echo "<table bordercolor='#000000' border=1 cellspacing=0 width='400' >";
  $sql = mysql_query("SELECT * FROM users WHERE id='$id'");
  while($row = mysql_fetch_array($sql)) {
     echo "<tr><td>".PROF_OF.": $row[user]</td></tr>
	       <tr><td>".E_MAIL.": $row[email] </td></tr>
		   <tr><td>".U_LEVEL.": $row[level] </td></tr>";
		   $userP = $row[user];
  }
  echo "</table>";
  if ($_SESSION[user]==$userP) {
  echo "<p /><a href=\"?m=user&action=editprofile\">[".CHANGE_PASS."]</a>";
  }
}

if ($_GET[action]=="allusers") {
  $sql = mysql_query("SELECT * FROM users ORDER by id DESC");
  while($row = mysql_fetch_array($sql)) {
    echo "<a href=\"?m=user&action=profile&id=$row[id]\">$row[user]</a> <br />";
  }
}
?>
</center>