<? include("../../includes/functions.php"); db();
mysql_query("INSERT INTO menu (name,link,opisanie,active) VALUES ('�������','?m=contact','������ � ���','yes')") or die (mysql_error());
echo "������ ������� ����������!<a OnClick=\"window.close()\" href='#'>������� ���������</a>";
@rename("install.php","installed.php");
@rename("int_.php","int.php");
?>