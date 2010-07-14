<?php
global $mainframe;

$class_sfx = $params->get('moduleclass_sfx', "");
/*
 * Get project activities from OpenFoundry module.
 */
$query_size = 10;
$pa_url = "http://www.openfoundry.org/of/proj_acts?qs=".$query_size;

// cURL initialize
$ch = curl_init();

// Set cURL option
curl_setopt($ch, CURLOPT_URL, $pa_url);

// Get result
$result = curl_exec($ch);

// Close cURL resource
curl_close($ch);
?>
