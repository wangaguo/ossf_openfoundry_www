<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
global $my, $g2Cache;
core::classRequireOnce('utility');
if(empty($my->usertype)){
	list($tree, $info) = $g2Cache->getCachedFunction('expiresLong', 'core::albumTree', null, null, null);
	$list = $g2Cache->getCachedFunction('expiresLong', 'utility::makeFlat', $tree);
} else {
	list($tree, $info) = $g2Cache->getCachedFunction('expiresShort', 'core::albumTree', null, null, $my->id);
	$list = $g2Cache->getCachedFunction('expiresShort', 'utility::makeFlat', $tree);	
}
/* begin output */
?>
<style type="text/css">
<!--
h1.g2sitemap
{
    margin: 0;
    border: 0;
    padding: 0;
    margin-left: 5px;
    margin-top: 20px;
    line-height:2px
}

h2.g2sitemap
{
    margin: 0;
    border: 0;
    padding: 0;
    margin-left: 30px;
    margin-top: 15px;
    line-height:2px
}

h3.g2sitemap
{
    margin: 0;
    border: 0;
    padding: 0;
    margin-left: 55px;
    margin-top: 15px;
    line-height:2px
}

h4.g2sitemap
{
    margin: 0;
    border: 0;
    padding: 0;
    margin-left: 70px;
}

h5.g2sitemap
{
    margin: 0;
    border: 0;
    padding: 0;
    margin-left: 95px;
}
-->
</style>
<span class="g2sitemap">
<?php
foreach($list as $array){
	switch($array[1]){
		case 0: 
			print ' <h1 class="g2sitemap"><a href="'.$info[$array[0]]['url'].'">'.$info[$array[0]]['title'].'</a></h1><br />'."\n";
			if(!empty($info[$array[0]]['description'])){
				print '<span class="small" style="margin-left:10px;">'.$info[$array[0]]['description'].'</span><br />'."\n";
			}
		break;
		case 1:
			print '<h2 class="g2sitemap"><a href="'.$info[$array[0]]['url'].'">'.$info[$array[0]]['title'].'</a></h2><br />'."\n";
			if(!empty($info[$array[0]]['summary'])){
				print '<span class="small" style="margin-left:35px; line-height:2px;">'.$info[$array[0]]['summary'].'</span></br />'."\n";
			}
		break;
		case 2:
			print '<h3 class="g2sitemap"><a href="'.$info[$array[0]]['url'].'">'.$info[$array[0]]['title'].'</a></h3><br />'."\n";
		break;
		case 3:
			print '<h4 class="g2sitemap"><a href="'.$info[$array[0]]['url'].'">'.$info[$array[0]]['title'].'</a></h4><br />'."\n";
		break;
		default:
			print '<h5 class="g2sitemap"><a href="'.$info[$array[0]]['url'].'">'.$info[$array[0]]['title'].'</a></h5><br />'."\n";
		break;
	}
}
?>
</span>