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
		global $_MT_LANG, $mtconf;
		//, $mt_map, $mt_show_map;

		# Load Parameters
		$params =& new mosParameters( $link->attribs );
		$params->def( 'show_map', $mtconf->get('show_map') );
		$params->def( 'map', $mtconf->get('map') );
		$html = '';

		if ( $params->get( 'show_map' ) == 1 ) {

			if ( $show_arrow == 1 ) {
				// $html = '<img src="images/M_images/indent1.png" width="9" height="9" />';
			} else {
				$html = '';
			}
			switch($params->get('map')) {
				# Map Quest
				case 'mapquest':
					$html .= '<a href=" http://www.mapquest.com/maps/map.adp?';
					$html .= 'address='.urlencode($link->address);
					$html .= '&city='.urlencode($link->city);
					$html .= '&state='.urlencode($link->state);
					$html .= '&zip='.urlencode($link->zip);
					$html .= '&country='.urlencode($link->country);
					$html .= '"';
					break;
					
				# Yahoo Maps
				case 'yahoomaps':
					$html .= '<a href="http://us.rd.yahoo.com/maps/us/insert/Tmap/extmap/*-http://maps.yahoo.com/maps_result?';
					$html .= 'addr='.urlencode($link->address);
					$html .= '&csz='.urlencode($link->city).','.urlencode($link->state).'+'.urlencode($link->postcode);
					$html .= '&country='.urlencode($link->country).'"';
					break;
					
				# Google Maps
				default:
					$html .= '<a href="http://';
					switch(substr($params->get('map'),11,2)) {
						#Canada
						case 'ca':
							$html .= 'maps.google.ca/maps?';
							break;
						case 'cn':
							$html .= 'ditu.google.com/maps?';
							break;
						case 'fr':
							$html .= 'maps.google.fr/maps?';
							break;
						case 'de':
							$html .= 'maps.google.de/maps?';
							break;
						case 'it':
							$html .= 'maps.google.it/maps?';
							break;
						case 'jp':
							$html .= 'maps.google.co.jp/maps?';
							break;
						case 'es':
							$html .= 'maps.google.es/maps?';
							break;
						case 'uk':
							$html .= 'maps.google.co.uk/maps?';
							break;
						default:
							$html .= 'maps.google.com/maps?';
							break;
					}
					$html .= 'q=' . urlencode($link->address);
					$html .= '+' . urlencode($link->city) . '+' . urlencode($link->state) . '+' . urlencode($link->postcode);
					$html .= '"';
					break;
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