<?
//USER module lang
define("LOGIN","Вход");
define("REGISTRATION","Регистрация");
define("USERNAME","Потребителско име");
define("PASSWORD","Парола");
define("R_PASSWORD","Повтори парола");
define("Y_EMAIL","Вашият имейл");
define("REG_BUTT","Регистрация");
define("REG_SUCC","Регистрацията приключи успешно!");
define("LOG_BUTT","Вход");
define("LOGOUT_SUCC","Изход успешен, моля <a href=\"index.php\">продължете</a> нататък.");
define("LOGIN_SUCC","Вход успешен! Моля ");
define("CONTINIUE","продължете");
define("WELCOME_LOGIN","Добре дошъл, ");
define("LOGOUT","Изход");
define("PROF_OF","Профил на");
define("E_MAIL","E-mail");
define("U_LEVEL","Левъл");
define("CHANGE_PASS","Промени парола");
define("U_ERROR_1","Моля, попълнете всички полета!");
define("U_ERROR_2","Моля, въведете правилен имейл!");
define("U_ERROR_3","Паролите не се съвпадат!");

//E-mail module
define("MAIL_ERROR_1","Моля въведете валиден имейл");
define("MAIL_ERROR_2","Не опитвай това ! ! ");
define("MAIL_ERROR_3","Моля попълнете всички полета!");
define("MAIL_MSG","Съобщението изпратено успешно!");
define("Y_MAIL_CONT","Вашият имейл");
define("Y_NAME_MAIL","Вашето име");
define("Y_MESSAGE_MAIL","Вашето съобщение...");
define("SND_MAIL","Изпрати");

$sql = mysql_query("SELECT * FROM news");
while ($row = mysql_fetch_array($sql)) {
 define($row[en],$row[bg]);
}
?>