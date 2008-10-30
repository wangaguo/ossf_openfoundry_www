<?php
/**
* Mosets Tree 
*
* @package Mosets Tree 1.50
* @copyright (C) 2005 Mosets Consulting
* @url http://www.Mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

//Base plugin class.
global $mosConfig_absolute_path;
require_once $mosConfig_absolute_path.'/components/com_mtree/Savant2/Plugin.php';

class Savant2_Plugin_ahrefmap extends Savant2_Plugin {

	/**
	* 
	* Output an HTML <a href="">...</a> link that point to MapQuest or Yahoo! Maps
	* 
	* @param object $link Reference to link object.
	* 
	* @return string The <a href="">...</a> tag.
	* 
	*/
	
	function plugin( &$link, $attr=null, $show_arrow=1 )
	{
		global $_MT_LANG, $mtree;//, $mt_map, $mt_show_map;

		# Load Parameters
		$params =& new mosParameters( $link->attribs );
		$params->def( 'show_map', $mtree->getCfg( 'mt_show_map' ));
		$params->def( 'map', $mtree->getCfg( 'mt_map' ));

		if ( $params->get( 'show_map' ) == 1 ) {

			if ( $show_arrow == 1 ) {
				$html = '<img src="images/M_images/indent1.png" width="9" height="9" />';
			} else {
				$html = '';
			}

			# Map Quest
			if ( $params->get( 'map' ) == 'mapquest' ) {
				$html .= '<a href=" http://www.mapquest.com/maps/map.adp?';
				$html .= 'address='.urlencode($link->address);
				$html .= '&city='.$link->city;
				$html .= '&state='.$link->state;
				$html .= '&zip='.$link->zip;
				$html .= '&country='.$link->country;
				$html .= '"';

			# Yahoo Maps
			} elseif ( $params->get( 'map' ) == 'yahoomaps' ) {
				$html .= '<a href="http://us.rd.yahoo.com/maps/us/insert/Tmap/extmap/*-http://maps.yahoo.com/maps_result?';
				$html .= 'addr='.urlencode($link->address);
				$html .= '&csz='.$link->city.','.$link->state.'+'.$link->postcode;
				$html .= '&country='.$link->country.'"';
				
			# Google Maps
			} else {
				$html .= '<a href="http://maps.google.com/maps?';
				$html .= 'q=' . urlencode($link->address);
				$html .= '+' . urlencode($link->city) . '+' . $link->state . '+' . $link->postcode;
				$html .= '"';
			}

			# Insert attributes
			if (is_array($attr)) {
				// from array
				foreach ($attr as $key => $val) {
					$key = htmlspecialchars($key);
					$val = htmlspecialchars($val);
					$html .= " $key=\"$val\"";
				}
			} elseif (! is_null($attr)) {
				// from scalar
				$html .= " $attr";
			}
			
			$html .= ' target="_blank">'.$_MT_LANG->MAP	."</a>";

			# Return the map link
			return $html;
		}

	}

}
?>