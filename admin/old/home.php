<table>
<tr>
 <td width="650" valign="top" >
 
   <?
   for ($i=0;$i<count($icon);$i++) {
   
	    $ico2 = "../modules/$titlnm[$i]/".$icon[$i];
	
  ?>
  

<div class="itemmenucontainer">
<div class="itemoverflow">
<table valign="top" >
	<tr>
		<td valign="top" >
<p class="itemicon">
	<a href="?module=<? echo $titlnm[$i];?>"><img src="<? echo $ico2;?>" class="itemicon" alt="<? echo $titlnm[$i];?>" title="<? echo $titlnm[$i];?>" /></a>
		</p></td>
		<td valign="top" >
<p class="itemtext">
	<a class="itemlink" href="?module=<? echo $titlnm[$i];?>"><? echo $titleMN[$i];?></a><br />
<? echo $describe[$i]; ?><br /><br />
 Линкове: 
 <? 

 for ($t=0;$t<count($buton);$t++) {
  $r+=1;
  $boom2 = explode("][",$buton[$t]);
	 $name2 = $boom2[0];
	 $link2 = $boom2[1];
	 $module2 = $boom2[3];
   if ($module2==$titlnm[$i]) {
 ?>
	<a class="itemsublink" href="<?  echo "?module=$titlnm[$i]&$link2";?>"><?  echo $name2;?></a>&nbsp;,&nbsp; 
	
	<? 
	?> 

	<?
	 }
	}
	?>
		</p></td>
	</tr>
</table>
</div>
</div>
  
  
  
  
  
  <?
   if ($i==10) {
   echo "<tr>";
    }
   }
   ?>
 </td>
 
 <td valign="top" width="150">
<div class="itemmenucontainer2 shortcuts">
<div class="itemoverflow">

<h2>Обновяване</h2>


 <table style='font-size:12px;' width="150">

<tr>
 <td>
- Добавени нови икони към модулите <br/> ( 09,09,2009 00:43 ) ;
</td>
</tr>

</table> 
<br/><br/>
<h2>Статистика</h2>


 <table style='font-size:12px;' width="150">

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
<br/><br/>
<h2>Склад</h2>


 <table style='font-size:12px;' width="150">

<tr>
 <td>
 Модули (10)
  <p />
Темплейти (7)
 <p />
Обновления (1)
 
</td>
</tr>
</table> 
<br/><br/>
<h2>Система Инфо</h2>


 <table style='font-size:12px;' width="150">

<tr>
 <td>
Версия : <? echo SYS_ver; ?>
  <p />
Ядро : <? echo K_ver; ?>
 <p />
Дата : <? echo date("Y.m.d"); ?>
<p />

</td>
</tr>
</table> 
<br/><br/>
<? sysStat(); ?>
<center>
<!-- <embed src=http://freeflashclocks.eu/free-flash-clocks-blog-topics/free-flash-clock-141.swf 
width=100 height=100 wmode=transparent type=application/x-shockwave-flash></embed></center> -->
</div>
</div>
 </td>
 
</tr>
</table>