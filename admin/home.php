<table>
<tr>
 <td width="650"><div align="left">
   <table style="border:0px;"><tr>
   <?
   for ($i=0;$i<count($icon);$i++) {
   if (file_exists("../modules/$titlnm[$i]/$icon[$i]")) {
   $iconImg = "../modules/$titlnm[$i]/$icon[$i]";
   }
   else {
   $iconImg = "images/blank.png";
   }
   echo "<td><table><tr><td><a href=\"?module=$titlnm[$i]\"><img  border=\"0\" src=\"$iconImg\" /></a></td></tr><tr><td>$titleMN[$i]</td></tr></table></td>";
  
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
 echo $row["pos"];
}
 ?> <p />
 импресии: <? 
 $sql = mysql_query("SELECT SUM(impressions) AS imp FROM statistics");
while($row=mysql_fetch_array($sql)) {
  echo $row["imp"];
}
 ?>
</td>
</tr>

</table> 
 </td>
 
</tr>
</table>

<!-- Page Head -->
			<h2>Welcome John</h2>
			<p id="page-intro">What would you like to do?</p>
			
			<ul class="shortcut-buttons-set">
				
				<li><a class="shortcut-button new-article" href="#"><span class="png_bg">
					Write an Article
				</span></a></li>
				
				<li><a class="shortcut-button new-page" href="#"><span class="png_bg">
					Create a New Page
				</span></a></li>
				
				<li><a class="shortcut-button upload-image" href="#"><span class="png_bg">
					Upload an Image
				</span></a></li>
				
				<li><a class="shortcut-button add-event" href="#"><span class="png_bg">
					Add an Event
				</span></a></li>
				
				<li><a class="shortcut-button manage-comments" href="#messages" rel="modal"><span class="png_bg">
					Open Modal
				</span></a></li>
				
			</ul><!-- End .shortcut-buttons-set -->
			
			<div class="clear"></div> <!-- End .clear -->