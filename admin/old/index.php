<?   putenv ('TZ=Europe/Sofia');  include("../includes/functions.php"); db(); @session_start();  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<META http-equiv="Content-Type" content="text/html; charset=Windows-1251">

<!-- new sstyle !!!!!!! -->
<script src="standard.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" media="screen, projection" href="adminstyle.css" />

<!--  !!!!!!! -->
<link rel="stylesheet" type="text/css" href="jqueryslidemenu.css" />

<!--[if lte IE 7]>
<style type="text/css">
html .jqueryslidemenu{height: 1%;} /*Holly Hack for IE7 and below*/
#myslidemenu {
 position:relative;
 top:-1px;
}
</style>
<![endif]-->

<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="jqueryslidemenu.js"></script>



        <script type="text/javascript" src="../ow/scripts/wysiwyg.js"></script>
		<script type="text/javascript" src="../ow/scripts/wysiwyg-settings.js"></script>
              <title>���������������� �����</title>
		</head>
		<script type="text/javascript" src="../includes/LB2/prototype.js"></script>
<script type="text/javascript" src="../includes/LB2/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="../includes/LB2/lightbox_admin.js"></script>
<link rel="stylesheet" href="../includes/LB2/lightbox.css" type="text/css" media="screen" />
<script type="text/javascript" src="../fckeditor/fckeditor.js"></script>

<? if (!isset($_SESSION["admin"])) { if (!isset($_GET["p"])) { ?>

<body style='background:#fff url(images/body.jpg) repeat-x scroll left top;' > 
<div class="login-all clear">
<div class="info">

  <h1>����������</h1>
  <div class="centerLogin">
  <ol> 
  <li>���� � ������ ������� �� ���������</li> 
  <li>��������� ������ � �� �������</li> 
  <li>������ �� �������� ������ �� ��������� ��������� ����� : ���@���.��</li> 
</ol><br/><br/><span>( Crosing Chiken CMS )</span>
<br/><br/><br/><br/><br/><br/>
</div>
</div>
<div class="login">
<div class="top">���� � ���������</div>
		<div id="centerLogin" class="formcontainer">
			<!--	<div class="erroLogin">������ ��� ��� ������ !</div>	
				<div class="acceptLogin">������������ !!!</div>										
				<div class="warningLogin">���� ��������� ������ ������...</div>	
			-->		
				<div class="lbfieldstext">
					<p class="lbuser">���:</p>
					<p class="lbpass">������:</p>

					</div>
					<div class="login-fields">
					<form  method="post" action="index.php?p=">
						<p>
							<input name="admin_nm" class="input"  id="userlogin"   size="20" tabindex="10" type="text"><br>
						<input name="admin_pass" class="input"  id="userpass"  size="20" tabindex="10" type="password"><br>							<input class="loginsubmit" name="loginsubmit" value="����" type="submit"> 
													</p>
					</form>

					<div class="forgot-pw">
						<a href="login.php?forgotpw=1">��������� ������ ?</a>
					</div>
				</div>
				    </div>
  </div>

</div>
<div class="login-footer"></div>
<div id="copy"> � <a  href="">Crosing Chicken CMS</a>

<br> 
Its a CHiken !!!!!!!!</div>

<?
}
if (isset($_POST["loginsubmit"])) {
  $name = $_POST["admin_nm"];
  $pass = $_POST["admin_pass"];
  $passMD5 = md5($pass);
  $sql = mysql_query("SELECT * FROM admins WHERE name='$name'") or die(mysql_error());
  while($row = mysql_fetch_array($sql)) {
    if ($row["pass"]==$passMD5) {
	  $_SESSION["admin"] = $name;
	$uniqueKey = rand(0,1000).rand(0,1000).rand(0,1000).rand(0,1000);
	 $_SESSION[$uniqueKey] = true;
	 $_SESSION["kS"] = $uniqueKey;
	}
	if (!isset($_SESSION[$_SESSION["kS"]])) {
	  ?>
<div class="login-all clear">
<div class="info">

  <h1>����������</h1>
  <div class="centerLogin">
  <ol> 
  <li>���� � ������ ������� �� ���������</li> 
  <li>��������� ������ � �� �������</li> 
  <li>������ �� �������� ������ �� ��������� ��������� ����� : ���@���.��</li> 
</ol><br/><br/><span>( Crosing Chiken CMS )</span>
<br/><br/><br/><br/><br/><br/>
</div>
</div>
<div class="login">
<div class="top">���� � ���������</div>
		<div id="centerLogin" class="formcontainer">
				<div class="erroLogin">������ ��� ��� ������ !</div>	
			<!--	<div class="acceptLogin">������������ !!!</div>										
				<div class="warningLogin">���� ��������� ������ ������...</div>	
			-->		
				<div class="lbfieldstext">
					<p class="lbuser">���:</p>
					<p class="lbpass">������:</p>

					</div>
					<div class="login-fields">
					<form  method="post" action="index.php?p=">
						<p>
							<input name="admin_nm" class="input"  id="userlogin"   size="20" tabindex="10" type="text"><br>
						<input name="admin_pass" class="input"  id="userpass"  size="20" tabindex="10" type="password"><br>							<input class="loginsubmit" name="loginsubmit" value="����" type="submit"> 
													</p>
					</form>

					<div class="forgot-pw">
						<a href="login.php?forgotpw=1">��������� ������ ?</a>
					</div>
				</div>
				    </div>
  </div>

</div>
<div class="login-footer"></div>
<div id="copy"> � <a  href="">Crosing Chicken CMS</a>

<br> 
Its a CHiken !!!!!!!!</div>
	  <?
	 }
   } 
  }
 }
?>
<? 

if (@isset($_SESSION[$_SESSION["kS"]])) { ?>
<body style='background:#fff url(images/bg2.jpg) repeat-x scroll left top;' >
 

<?php 


echo "<center><table width=\"800\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">  <thead>    <tr>      <th class=\"capt\" colspan=\"8\"></th>    </tr></thead> </table>";



?>

<!--  11111111111111111111111111111111111111 -->



<div  style="width:800px;"  id="logocontainer">
<img src='images/graphene.png' height=30 />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<div class="logotext">��������� �� ������������� �� ��� �����...<br/>����� ����� : <strong style='color:black;'><? echo $_SESSION[admin]; ?></strong>
<br/>
<a   class="itemsublink"  href="../index.php">��� �����</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a   class="itemsublink"  href="index.php?p=out">�����</a></div>
</div>








<div  id="myslidemenu" class="jqueryslidemenu" >
<ul>
<li><a <? if (!isset($_GET["module"])) { echo " style=\"background: #f4f5f5; color: black;\"";}?>href="index.php">������</a></li>

<li><a <? if (isset($_GET["module"]) && $_GET["module"]!="config") { echo " style=\"background: #f4f5f5;color: black;\"";}?> href="#">������</a>
  <ul>

  

 



<? 
//MENU
$path = "../modules";
$dir_handle = @opendir($path) or die("������ �� ������ ������������ � �������� $path");

while ($dir = readdir($dir_handle)) 
{ 
if (file_exists("$path/$dir/int.php")) {
include("$path/$dir/int.php"); 
}
if (file_exists("$path/$dir/module.php")) {
$i+=1;
if ($dir!="config") {

?>

      <? for ($i=0;$i<count($icon);$i++) {
    if ($name=$dir) {
	if (file_exists("../modules/$dir/".$icon[$i])) {
	    $ico = "../modules/$dir/".$icon[$i];
		}
		elseif (!file_exists("../modules/$dir/".$icon[$i])) {
	    $ico = "images/blank.png";
		}
      }
   } ?>
     <li><a href="<? echo "?module=$dir"; ?>"><img src="<? echo $ico; ?>" width='15' height='15' />&nbsp;&nbsp;&nbsp;<? echo $mnu_title; ?></a>
	   <ul>
  
  <? 
                  for ($i=0; $i<count($buton); $i++) {
     $boom1 = explode("][",$buton[$i]);
	 $name1 = $boom1[0];
	 $link1 = $boom1[1];
	 $module1 = $boom1[3];
	 if($module1 == $dir) {
	 echo "<li><a href=\"?module=$dir&$link1\">$name1</a></li>";
	 }
   }
  ?>
  </li>
</ul>
 
  <? }
     $titleMN[] = $mnu_title; //important
	 $titlnm[] = $name; //important
	 
    }
   }

closedir($dir_handle);

//LOGOUT

?> 
 </li>
</ul>

<li>
<a <?
  
  if ($_GET["module"]=="config") {
     echo " style=\"background: #f4f5f5;
color: black;\"";
  }

 ?> href="?module=config">������������</a></li>
</ul>

<br style="clear: left" />
</div> <br/><br/><br/>
<?
session_unset();
if ($_GET["p"] == "out") {
session_unset();
echo "<center><div class=\"error\" style=\"width:780px;\"><span>�������� !</span>        <p> ��� ������� ��������� �� ������� ��...<br/><br/><br/><a href=\"../index.php\"/>��������</a></p></div></center>";

}
if (isset($_GET["module"])){
 ?>
 <table width="800">
 <th id="tit">
  <? 
   for ($i=0; $i<count($title); $i++) {
      $boom2 = explode("][",$title[$i]);
   $titleM = $boom2[1];
   $titleM2 = $boom2[0]; 
   if (!file_exists("../modules/$_GET[module]/$icon[$i]")) {
	    $fnIM = "images/blank.png";
	 }
	 else  {
	   $fnIM = "../modules/$_GET[module]/$icon[$i]";
	 }
   if($titleM == $_GET[module]) {
     echo "
	 <table align='left' class='itemmenucontainer3 shortcuts' ><tr><td align='left'  valign='top'><img width=\"50\" height=\"50\" src=\"$fnIM\" /></td><td align='left' width='800'  valign='top'> <h2>$titleM2</h2>
	";
   }
   }
   ?>
<div align="right">   
<table cellspacing="0" height='21' cellpadding="0"><tr>
   <?
   for ($i=0; $i<count($buton); $i++) {

     $boom = explode("][",$buton[$i]);
	 $name = $boom[0];
	 $link = $boom[1];
	 $class = $boom[2];
	 $module = $boom[3];
	 if($module == $_GET[module]) {
	 $mnusI .="<td  class='leftI'></td><td><a  class='links'  href=\"?module=$_GET[module]&$link\" class=\"$class\">$name</a><td  class='rightI'></td>";
	 }
   }
   
   echo $mnusI;

  ?></tr></table></td></tr></table>
  </div>
</th>
<tr>
 <td>
 <?
  include ("../modules/$_GET[module]/admin.php");
  ?>
  </td>
 </tr>
 </table>
 <?
}
if (!isset($_GET["module"]) && $_GET["p"]!="out"){
?>

 <table width="800">
 <th id="tit"> 
<?
   include ("home.php");
 }
 ?> 
 </td>
 </tr>
 </table>

<br/><br/><br/>
<center>
<table width="100%">
<tr><td id='footer' >
<br/>
Crosing Chicken CMS<br/>
v. 1.1 ( still demo ) 08.08.2009

</td></tr>
</table>
</center>

 <?
}
?>