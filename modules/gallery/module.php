<? if (isset($_GET["c"])) { ?>
<table>
<? 
if (is_numeric($_GET["c"])) {
$category = $_GET["c"];
}
$sql = mysql_query("SELECT * FROM gallery WHERE in_cat='$category' ORDER BY id DESC");
$i=0;
while ($row=mysql_fetch_array($sql)) {

         ?>
		 <td><img  src="modules/gallery/thumbs/<? echo $row["image"]; ?>" /></td>
		 <? 
         $i++;
		  if ($i>=4) {
		    echo "</tr><tr>";
			$i=0;
		  }
}

echo "asfasfasfa";

?>
</table>
<? } if (!isset($_GET["c"])) { ?>
<table border="1" height="400"><tr>
<?
$sql2 = mysql_query("SELECT * FROM gallery_cats ORDER BY id DESC");
while ($row2=mysql_fetch_array($sql2)) {
?>
<td valign="top">
<table border="1"  cellspacing="0" cellpadding="0">
<tr><td  style="height:35px; background:#253a62; font-size:20px; color:#f8c752;">
<b style="padding-left:10px;"><? echo $row2["name"]; ?></b>
</td>
</tr>
<tr>
<td width="200">
<?
$sql3 = mysql_query("SELECT * FROM gallery WHERE in_cat='$row2[id]' &&  basic='1' ");
while ($row3=mysql_fetch_array($sql3)) {
  echo "<a href='?m=gallery&c=$row2[id]'><img src='modules/gallery/thumbs/$row3[image]' /></a>";
  
  
}

?>

</td>
</tr>
</table>
</td>

<?
 $i++;
		  if ($i>=2) {
		    echo "</tr><tr>";
			$i=0;
		  }
		  
}
?>
</tr>
</table>
<? } ?>