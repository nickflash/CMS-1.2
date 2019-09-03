<?   putenv ('TZ=Europe/Sofia');  include("../includes/functions.php"); db(); session_start(); ?>

<? if (!isset($_SESSION["admin"])) { if (!isset($_GET["p"])) { ?> 

  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
 
	<head>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<title>Graphene CMS | Sign In</title>
		
		<!--                       CSS                       -->
	  
		<!-- Reset Stylesheet -->
		<link rel="stylesheet" href="resources/css/reset.css" type="text/css" media="screen" />
	  
		<!-- Main Stylesheet -->
		<link rel="stylesheet" href="resources/css/style.css" type="text/css" media="screen" />
		
		<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
		<link rel="stylesheet" href="resources/css/invalid.css" type="text/css" media="screen" />	
		
		<!-- Colour Schemes
	  
		Default colour scheme is green. Uncomment prefered stylesheet to use it.
		
		<link rel="stylesheet" href="resources/css/blue.css" type="text/css" media="screen" />
		
		<link rel="stylesheet" href="resources/css/red.css" type="text/css" media="screen" />  
	 
		-->
		
		<!-- Internet Explorer Fixes Stylesheet -->
		
		<!--[if lte IE 7]>
			<link rel="stylesheet" href="resources/css/ie.css" type="text/css" media="screen" />
		<![endif]-->
		
		<!--                       Javascripts                       -->
	  
		<!-- jQuery -->
		<script type="text/javascript" src="resources/scripts/jquery-1.3.2.min.js"></script>
		
		<!-- jQuery Configuration -->
		<script type="text/javascript" src="resources/scripts/simpla.jquery.configuration.js"></script>
		
		<!-- Facebox jQuery Plugin -->
		<script type="text/javascript" src="resources/scripts/facebox.js"></script>
		
		<!-- jQuery WYSIWYG Plugin -->
		<script type="text/javascript" src="resources/scripts/jquery.wysiwyg.js"></script>
		
		<!-- Internet Explorer .png-fix -->
		
		<!--[if IE 6]>
			<script type="text/javascript" src="resources/scripts/DD_belatedPNG_0.0.7a.js"></script>
			<script type="text/javascript">
				DD_belatedPNG.fix('.png_bg, img, li');
			</script>
		<![endif]-->
		
	</head>
  
	<body id="login">
		
		<div id="login-wrapper" class="png_bg">
			<div id="login-top">
			
				<h1>Graphene CMS</h1>
				<!-- Logo (221px width) -->
				<img id="logo" src="resources/images/logo.png" alt="Simpla Admin logo" />
			</div> <!-- End #logn-top -->
			
			<div id="login-content">
				
				<form method="post" action="index.php?p=">
				
					<div class="notification information png_bg">
						<div>
							Welcome to Graphene CMS! тест на кирилицата
						</div>
					</div>
					
					<p>
						<label>Username</label>
						<input class="text-input"  name="admin_nm" type="text" />
					</p>
					<div class="clear"></div>
					<p>
						<label>Password</label>
						<input class="text-input" name="admin_pass" type="password" />
					</p>
					<div class="clear"></div>
					<p id="remember-password">
						<input type="checkbox" />Remember me
					</p>
					<div class="clear"></div>
					<p>
						<input class="button" name="admin" type="submit" value="Sign In" />
					</p>
					
				</form>
			</div> <!-- End #login-content -->
			
		</div> <!-- End #login-wrapper -->
		
  </body>
  
</html>

<?
}
if (isset($_POST["admin"])) {
  $name = $_POST["admin_nm"];
  $pass = $_POST["admin_pass"];
  $passMD5 = md5($pass);
  $sql = mysql_query("SELECT * FROM admins WHERE name='$name'") or die(mysql_error());
  while($row = mysql_fetch_array($sql)) {
   
   if ($row["pass"]==$passMD5) {
	  $_SESSION["admin"] = $name;
	  $sysKey = md5(rand(0,100).rand(0,100).rand(0,100).rand(0,100));
	  $_SESSION[$sysKey] = "set";
	  $_SESSION["ready"] = $sysKey;
	 }
	 //ELSE WRONG PASSS USER!
	 else {
	 $failMSG = true;
   }
}   
//CHECK iF USERNAME IS NOT IN DB >> WRONG UNAME

 if (mysql_num_rows($sql) == 0)
      $failMSG = true;
    }  
   //DISPLAY WRONG PASS OR NAME MSG
   if (isset($failMSG)) {
	  echo "<center><div class=\"error\" style=\"width:780px;\"><span>Внимание !</span>        <p> Грешно администраторско име или парола!<br/><br/><br/><a href=\"index.php\"/>Опитай пак</a></p></div></center>";

	 }
  }
 
?>
<? if (isset($_SESSION["admin"]) && @$_GET["p"]!="out") {  
if (isset($_SESSION[$_SESSION["ready"]])) {
echo $_SESSION["ready"];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
 
	<head>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<title>Graphene CMS - Signed in</title>
		<script type="text/javascript" src="../includes/jquery.min.js"></script>
		<!--                       CSS                       -->
	  
		<!-- Reset Stylesheet -->
		<link rel="stylesheet" href="resources/css/reset.css" type="text/css" media="screen" />
	  
		<!-- Main Stylesheet -->
		<link rel="stylesheet" href="resources/css/style.css" type="text/css" media="screen" />
		
		<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
		<link rel="stylesheet" href="resources/css/invalid.css" type="text/css" media="screen" />	
		<link rel="stylesheet" href="resources/css/blue.css" type="text/css" media="screen" />
		
		<!-- Colour Schemes
	  
		Default colour scheme is green. Uncomment prefered stylesheet to use it.
		
		
		<link rel="stylesheet" href="resources/css/red.css" type="text/css" media="screen" />  
	 
		-->
		
		<!-- Internet Explorer Fixes Stylesheet -->
		
		<!--[if lte IE 7]>
			<link rel="stylesheet" href="resources/css/ie.css" type="text/css" media="screen" />
		<![endif]-->
		
		<!--                       Javascripts                       -->
  
		<!-- jQuery -->
		<script type="text/javascript" src="resources/scripts/jquery-1.3.2.min.js"></script>
		
		<!-- jQuery Configuration -->
		<script type="text/javascript" src="resources/scripts/simpla.jquery.configuration.js"></script>
		
		<!-- Facebox jQuery Plugin -->
		<script type="text/javascript" src="resources/scripts/facebox.js"></script>
		
		<!-- jQuery WYSIWYG Plugin -->
		<script type="text/javascript" src="resources/scripts/jquery.wysiwyg.js"></script>
		<script src="../includes/LB2/lightbox_admin.js"></script>
		<link href="../includes/LB2/lightbox.css" rel="stylesheet" />
		
		<!-- Internet Explorer .png-fix -->
		
		<!--[if IE 6]>
			<script type="text/javascript" src="resources/scripts/DD_belatedPNG_0.0.7a.js"></script>
			<script type="text/javascript">
				DD_belatedPNG.fix('.png_bg, img, li');
			</script>
		<![endif]-->

<script type="text/javascript" src="../fckeditor/fckeditor.js"></script>
	</head>
  
	<body>
	<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
		
		<div id="sidebar">
		
		<div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->
			
		<h1 id="sidebar-title"><a href="#">Graphene CMS</a></h1>
		  
			<!-- Logo (221px wide) -->
			<a href="#"><img id="logo" src="resources/images/logo.png" alt="Graphene CMS" /></a>
		  <span style="font-size:20px; color:#FFFFFF; padding-left:40px;">Graphene CMS</span><p />
			<!-- Sidebar Profile links -->
			<div id="profile-links">
				Hello, <a href="#" title="Edit your profile"><? echo $_SESSION["admin"]; ?></a><p />
				<br />
				<a href="../index.php" title="View the Site">View the Site</a> | <a href="index.php?p=out" title="Sign Out">Sign Out</a>
			</div>        
			
		<ul id="main-nav">  <!-- Accordion Menu -->
			
			<? $gets = http_build_query($_GET) ?>
<li><a class="nav-top-item no-submenu <? echo $homeCur ?>" href="index.php">Home</a></li>
        

  

 



<? 
//MENU
$path = "../modules";
$dir_handle = @opendir($path) or die("Немога да отворя директорията с модулите $path");

while ($dir = readdir($dir_handle)) 
{ 
if (file_exists("$path/$dir/int.php")) {
@$i+=1;

include("$path/$dir/int.php"); 
//if ($dir!="config") {
if (file_exists("$path/$dir/installed.php")) {
?>
<li>

      <? for ($i=0;$i<count($icon);$i++) {
    if ($name=$dir) {
	    $ico = $icon[$i];
      }
   }
 if (file_exists("../modules/$dir/".$ico)) {
   $iconImg = "../modules/$dir/".$ico;
   }
   else {
   $iconImg = "images/blank.png";
   }
   
   
   
   //MAIN TITLE OF MODULE IN MENU
     
	 //echo $gets;
	 
   if (strpos($gets,"$dir") !== false) {
    $addCur = "current";
    }

else {
$addCur = "";
}

   ?>
   <li> 			
     <a class="nav-top-item <? echo $addCur; ?>" href="<? echo "?module=$dir"; ?>">
	<? echo $mnu_title; ?> &nbsp;<img src="<? echo $iconImg; ?>" width='15' height='15' />
	 </a>

	    <ul>			
  
  <? 
  //READING SUBMENUS 

                  for ($i=0; $i<count($buton); $i++) {
     $boom1 = explode("][",$buton[$i]);
	 $name1 = $boom1[0];
	 $link1 = $boom1[1];
	 $module1 = $boom1[3];
	 if($module1 == $dir) {
	 $sfor = "module=$dir&$link1";
	 if ($gets == $sfor || $gets."&" == $sfor ) {
	  
      //echo "ima q ";
	  //echo $link1;
	  $class="class='current'"; 
	  
	  
	  
}
else {
//echo "nqma q";
$class = "";
}

	 echo "<li><a $class href=\"?module=$dir&$link1\">$name1</a></li>";
	 
	 }
   }
  ?> </li>
  </ul>
  
    		
  	    
	</li>

  <? //}
  }
     $titleMN[] = $mnu_title; //important
	 $titlnm[] = $name; //important
	 
    }
   }

closedir($dir_handle);

?>  
</ul>




</div></div> <!-- End #sidebar -->
		
		
		<div id="main-content"> <!-- Main Content Section with everything -->
			
			<noscript> <!-- Show a notification if the user has disabled javascript -->
				<div class="notification error png_bg">
					<div>
						Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
					</div>
				</div>
			</noscript>
			
			
			
			<? //MODULE ADMIN CONTENT
if (isset($_GET["module"])){
 ?>
 
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
	 
   if($titleM == $_GET["module"]) {
     echo "<div style=\"background:#EEEEEE;\"  align=\"left\"><img width=\"22\" height=\"22\" src=\"$fnIM\" />&nbsp;<div>$titleM2</div></div>";
   }
   }
   ?>
  
   <? /*
   for ($i=0; $i<count($buton); $i++) {
     $boom = explode("][",$buton[$i]);
	 $name = $boom[0];
	 $link = $boom[1];
	 $class = $boom[2];
	 $module = $boom[3];
	 if($module == $_GET["module"]) {
	 echo "<a href=\"?module=$_GET[module]&$link\" class=\"$class\">$name</a>";
	 }
   }
   */
  ?>
  
 <?
  include ("../modules/$_GET[module]/admin.php");
  ?>
  
 <?
}

if (!isset($_GET["module"]) && @$_GET["p"]!="out"){
?>
 
<?
   //include ("home.php");
 }
// END OF CONTENT INCLUDE ?> 
			
			
			</div> <!-- end of contents -->
		
		
		
		
	</div></body>
  
</html>



 <?
 
}
}

//LOGOUT
if (isset($_GET["p"])) {
if ($_GET["p"] == "out") {
session_unset();
echo "logged out";
redirect("index.php");
   }
  }
?>