<?php
include '../../../_conf.php'; // getting constants

$file = file_get_contents("http://picasaweb.google.com/data/feed/api/user/".$uName."?kind=album&access=public&thumbsize=".$tSize);
$xml = new SimpleXMLElement($file);
$xml->registerXPathNamespace('gphoto', 'http://schemas.google.com/photos/2007');
$xml->registerXPathNamespace('media', 'http://search.yahoo.com/mrss/');

if($gTitle == null){ // if empty Gallery title will be "user id's  Photo Gallery"
	$nickname = $xml->xpath('//gphoto:nickname');
	$gTitle =$nickname[0]."'s Photo Gallery";
}
?>
	
				<div class="container_16">
					<div class="grid_16">
					<?php
						// print gallery title
						echo "<h1>". $gTitle ."</h1>";
					?>
						<div class="grid_1 alpha">
							<a id="prev" class="disabled">&nbsp;</a>
						</div> 
						<div id="albums" class="scrollable grid_14">
							 <table>
					<?php
					
						foreach($xml->entry as $feed){
						$num+=1;
						
					
						
							$group = $feed->xpath('./media:group/media:thumbnail');
							$a = $group[0]->attributes(); // we need thumbnail path
							$id = $feed->xpath('./gphoto:id'); // and album id for our thumbnail
							echo '<td><table bgcolor="#01B1B1" width="110"><tr><td><img src="'.$a[0].'" alt="'.$feed->title.'" title="'.$feed->title.'" ref="'.$id[0].'"/>
</td></tr><tr><td>'.$feed->title.'</td></tr></table></td>'.$ic;
	 if ($num==$per_row) 
         {
         $num=0;
         echo "</tr><tr>";
         }
						}
					?>
						</table><p /><table><tr><td>
						</div>
						<div class="grid_1 omega">
							<a id="next">&nbsp;</a>
						</div>
						<div class="clear">&nbsp;</div>
						<div class="grid_2 prefix_7 alpha" id="navi"></div>
						<div class="clear">&nbsp;</div>
					<h2 id="a_title"></h2>
						<div class="grid_14 alpha prefix_1 suffix_1" id="pic_holder">
						</div>	
				</div>
				<div class="clear">&nbsp;</div>
				</td></tr></table>
			</div>
			<script type="text/javascript" language="JavaScript" src="http://jqueryjs.googlecode.com/files/jquery-1.3.2.min.js"></script>
			<script type="text/javascript" language="JavaScript" src="jquery.mousewheel.min.js"></script>
			<script type="text/javascript" language="JavaScript" src="jquery.tools.min.js"></script>
			<script type="text/javascript" language="JavaScript" src="jquery.easing.1.3.js"></script>
			<script type="text/javascript" language="JavaScript" src="jquery.fancybox-1.2.1.pack.js"></script>

			<script type="text/javascript">
				$(document).ready(function(){         
					$("div.scrollable").scrollable({
						size: 10, // number of pictures per page
						next: '#next', // id of next control element
						prev: '#prev', // id of prev control element
						navi:'#navi' // id of navigation control holder
					});
					$("#albums img").bind("click", function(){
						$("#a_title").text($(this).attr('title'));
						$("#pic_holder").html('<div class="loading">Loading...</div>').load("_ajax.php",{"aID":$(this).attr("ref")},function(){
							$("#pic_holder").find("a").fancybox();
						});
					});
				}); 
			</script>
			