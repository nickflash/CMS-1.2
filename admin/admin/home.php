<table>
<tr>
 <td width="650"><div align="left">
   <table style="border:0px;"><tr>
   <?
   for ($i=0;$i<count($icon);$i++) {
   
   echo "<td><table><tr><td><a href=\"?module=$titlnm[$i]\"><img  border=\"0\" src=\"../modules/$titlnm[$i]/$icon[$i]\" /></a></td></tr><tr><td>$titleMN[$i]</td></tr></table></td>";
   if ($i==10) {
   echo "<tr>";
    }
   }
   ?></div>
   </tr>
   </table>
 </td>
 
 <td width="150">
 <table width="150">
<tr>
 <td class="cap">
 <b>Статистика:</b> 
</td>
</tr>

<tr>
 <td>
 посещения: <? 
   $sql = mysql_query("SELECT COUNT(ips) AS pos FROM statistics");
while($row=mysql_fetch_array($sql)) {
 echo $row[pos];
}
 ?> <p />
 импресии: <? 
 $sql = mysql_query("SELECT SUM(impressions) AS imp FROM statistics");
while($row=mysql_fetch_array($sql)) {
  echo $row[imp];
}
 ?>
</td>
</tr>

</table> 
 </td>
 
</tr>
</table>