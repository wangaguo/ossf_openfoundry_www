<?php
global $mainframe;

$class_sfx = $params->get('moduleclass_sfx', "");

/*
 * Get project activities from OpenFoundry module.
 */
$query_size = 8;
//$pa_url = "http://ssodev.openfoundry.org/of/proj_acts?qs=".$query_size;
$pa_url = "http://ssodev.openfoundry.org/of/api/user?do=partners&name=kaworu";

// cURL initialize
$ch = curl_init();

// Set cURL option
curl_setopt($ch, CURLOPT_URL, $pa_url);

// Get result
$result = curl_exec($ch);

// Close cURL resource
curl_close($ch);

?>
