<?
//USER module lang
define("LOGIN","Login");
define("REGISTRATION","Registrate");
define("USERNAME","Username");
define("PASSWORD","Password");
define("R_PASSWORD","Repeat password");
define("Y_EMAIL","Your e-mail");
define("REG_BUTT","Registration");
define("LOG_BUTT","Log me in");
define("LOGIN_SUCC","Login succesful!");
define("CONTINIUE","Continiue");
define("WELCOME_LOGIN","Welcome, ");
define("LOGOUT","Logout");
define("LOGOUT_SUCC","Logout succesful please <a href='index.php'>continiue</a> ! ");
define("REG_SUCC","Registration successful!");
define("PROF_OF","Profile of");
define("E_MAIL","E-mail");
define("U_LEVEL","Level");
define("CHANGE_PASS","Change password");
define("U_ERROR_1","Please, field all the fields!");
define("U_ERROR_2","Please, type valid email!");
define("U_ERROR_3","The passwords does not mach!");

//E-mail module
define("MAIL_ERROR_1","Please, type valid mail!");
define("MAIL_ERROR_2","Dont try this ! ! ");
define("MAIL_ERROR_3","Please, field the fields!");
define("MAIL_MSG","The message has sent successfuly!");
define("Y_MAIL_CONT","Your e-mail");
define("Y_NAME_MAIL","Your name");
define("Y_MESSAGE_MAIL","Your message...");
define("SND_MAIL","Send message");

$sql = mysql_query("SELECT * FROM news");
while ($row = mysql_fetch_array($sql)) {
 define($row[en],$row[bg]);
}
?>