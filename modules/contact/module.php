<center>
<? if (!isset($_GET[ac])) { ?>
<form action="?m=contact&ac=send" method="POST">
<table border=0 ><tr><td align="right" width="150" >
<? echo Y_MAIL_CONT; ?>:</td><td width="150" ><input style="width:300px;" type="text" name="mail" /><br /></td></tr></table><table border=0 ><tr><td align="right" width="150" >
<? echo Y_NAME_MAIL; ?>: </td><td width="150" ><input style="width:300px;" type="text" name="name" /><p /></td></tr></table>
<table><tr><td>
<textarea style="width:500px; height:250px;" name="msg"><? echo Y_MESSAGE_MAIL; ?></textarea></td></tr><tr><td align="right" >
<input type="submit" name="sndm" value="<? echo SND_MAIL; ?>" /></td></tr></table>
</form>



<br /><!-- paragraph end (516)--><!-- paragraph start (545) -->
<a name="545_15"></a><form action="?m=contact&ac=send" method="post" target="_top">
	<table border="0" cellspacing="0" cellpadding="0" width="100%"><tr>
		<td width="100%" valign="top" align="left"><span class="big">Please fill out this form, and you will soon be contacted by one of our sales persons.</span><table summary="" border="0" cellpadding="0" cellspacing="0"><tr><td><img src="x.gif" alt="" width="1" height="15" /></td></tr></table></td>
	</tr></table>
	<table border="0" cellspacing="0" cellpadding="0" width="100%"><tr>
		<td width="50%" valign="top" align="left"><table summary="" border="0" cellpadding="0" cellspacing="0"><tr><td><span class="norm"><label for="FIELD_549_id">First name:</label></span></td></tr><tr><td><img src="x.gif" alt="" width="1" height="1" /></td></tr><tr><td><span class="norm"><input type="text" name="fname" id="FIELD_549_id" size="25" maxlength="100" value="" class="norm swformsingle" /></span></td></tr><tr><td><img src="x.gif" alt="" width="1" height="12" /></td></tr></table></td><td width="50%" valign="top" align="left">&nbsp;</td>
	</tr></table>
	<table border="0" cellspacing="0" cellpadding="0" width="100%"><tr>
		<td width="50%" valign="top" align="left"><table summary="" border="0" cellpadding="0" cellspacing="0"><tr><td><span class="norm"><label for="FIELD_550_id">Surname:</label></span></td></tr><tr><td><img src="x.gif" alt="" width="1" height="1" /></td></tr><tr><td><span class="norm"><input type="text" name="sname" id="FIELD_550_id" size="25" maxlength="100" value="" class="norm swformsingle" /></span></td></tr><tr><td><img src="x.gif" alt="" width="1" height="12" /></td></tr></table></td><td width="50%" valign="top" align="left">&nbsp;</td>
	</tr></table>
	<table border="0" cellspacing="0" cellpadding="0" width="100%"><tr>
		<td width="50%" valign="top" align="left"><table summary="" border="0" cellpadding="0" cellspacing="0"><tr><td><span class="norm"><label for="FIELD_551_id">Your E-mail:</label></span></td></tr><tr><td><img src="x.gif" width="1" height="1" alt="" /></td></tr><tr><td><span class="norm"><input type="text" name="mail" size="25" value="" class="norm swformsingle" /></span></td></tr><tr><td><img src="x.gif" width="1" height="12" alt="" /></td></tr></table></td><td width="50%" valign="top" align="left">&nbsp;</td>
	</tr></table>
	<table border="0" cellspacing="0" cellpadding="0" width="100%"><tr>
		<td width="50%" valign="top" align="left"><table summary="" border="0" cellpadding="0" cellspacing="0"><tr><td><span class="norm"><label for="FIELD_552_id">Subject:</label></span></td></tr><tr><td><img src="x.gif" alt="" width="1" height="1" /></td></tr><tr><td><span class="norm"><input type="text" name="subject" id="FIELD_552_id" size="25" maxlength="100" value="" class="norm swformsingle" /></span></td></tr><tr><td><img src="x.gif" alt="" width="1" height="12" /></td></tr></table></td><td width="50%" valign="top" align="left">&nbsp;</td>
	</tr></table>
	<table border="0" cellspacing="0" cellpadding="0" width="100%"><tr>
		<td width="100%" valign="top" align="left"><table summary="" border="0" cellpadding="0" cellspacing="0"><tr><td><span class="norm"><label for="FIELD_553_id">Your message:</label></span></td></tr><tr><td><img src="x.gif" width="1" height="1" alt="" /></td></tr><tr><td><span class="norm"><textarea name="msg" id="FIELD_553_id" cols="35" rows="8" wrap="" class="norm swformtext"></textarea></span></td></tr><tr><td><img src="x.gif" width="1" height="12" alt="" /></td></tr></table></td>
	</tr></table>
	<table border="0" cellspacing="0" cellpadding="0" width="100%"><tr>
		<td width="100%" valign="top" align="left"><input type="submit" class="swformbutton" value="Send e-mail" name="554"><img src="x.gif" height="1" width="6" alt="" /><input type="reset" class="swformbutton" value="Reset" name="554"><br /><img src="x.gif" alt="" width="1" height="12" /></td>
	</tr></table>

	<input type="hidden" name="lFormId" value="69" />
</form><!-- paragraph end (545)--></TD>
				</TR>
			</TABLE>
			</TD>
			</TR>
	</TABLE>
	<table cellspacing="0" border="0" cellpadding="0"><tr><td><br>
<table width="777" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td>&nbsp;</td>
    <td><table width="605" border="0" cellpadding="0" cellspacing="0" bgcolor="#f2f2f2">
        <tr> 
<?php
}
if($_GET[ac]=="send" && isset($_POST[sndm])) {
$visitormail = $_POST['mail'];
$name = $_POST['fname']." ".$_POST['sname'];
$msg = $_POST['msg'];
$subject = $_POST['subject'];
if(!$visitormail == "" && (!strstr($visitormail,"@") || !strstr($visitormail,".")))
{
echo MAIL_ERROR_1;
$badinput = "";
echo $badinput;
}

if (eregi('http:', $visitormail)) {
die (MAIL_ERROR_2);
}

if(empty($from) or empty($visitormail) or empty($subject)) {
echo MAIL_ERROR_3;
}

$todayis = date("l, F j, Y, g:i a") ;
$from = "от: $name";
if(mail("nickflash@abv.bg", $subject, $msg, $from)) {
echo MAIL_MSG;
}
}
?>
</center>