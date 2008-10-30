<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
class HTML_content {


	function showHelp( $option, $act, $task, $anchor ){
		core::classRequireOnce('utility');
		$version = utility::comVersion();
		?>
		<table width="100%" border="0" cellpadding="4">
		    <td colspan="5" align="left" valign="bottom"> 
		    	<p><strong>Credits:</strong><br />
			        <span class="smallgrey">To all people of the Joomla+G2 community! Helping and pionting out Bugs and Improvements.<br /><br />
			        Special thank's for testing &amp; good suggestions to:<br />
			        Peter(Aravot),Ken Nozawa(colt45) ,Christopher Condrup(ccondrup) , Tim Carr(zephyr325) , Kostas Petrakis (Pestilence) and Brent Stolle(trompete)<br />
			        <br />
			        Special thanks for learning me G2 system to:<br />
			        bharat & Valiant and the rest of the gallery dev team.<br /><br />
			        </span>
			        <strong>Contact:<br></strong>
			        <a href="http://opensource.4theweb.nl" class="smallgrey">Support and Documentation</a><br />
			        <a href="http://developer.joomla.org/sf/frs/do/viewSummary/projects.gallery2_bridge/frs" class="smallgrey">Files<span class="smallgrey"></span></a>
			        <br />
			        <strong>Version:</strong><br />
			        <span class="smallgrey">&nbsp;<?php echo $version; ?></span><br />
		      	</p>
		    </td>
		</table>
		<?php
	}
}
?>