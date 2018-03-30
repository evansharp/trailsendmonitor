<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'panel/dashboard';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['assets/(:any)'] = 'assets/$1';


// Panel screens
$route['streams'] = 'panel/streams';
	$route['streams/create'] = 'panel/create_stream';
	$route['stream/edit/(:num)'] = 'panel/edit_stream/$1';
	$route['stream/delete/(:num)'] = 'panel/delete_stream/$1';
	$route['stream/raw/(:num)'] = 'panel/view_raw_stream/$1';
	$route['stream/toggle/(:num)'] = 'panel/toggle_stream/$1';

$route['relations'] = 'panel/relations';
	$route['relations/create'] = 'panel/create_relations';
	$route['relations/edit'] = 'panel/edit_relations';

$route['alerts'] = 'panel/alerts';
$route['settings'] = 'panel/settings';

// Route for the input hopper, a controller that recieves POSTs from Yoctopuce's VirtualHub
// on localhost. The wildcard URI segment is used to delineate which device is sending the data.
// Device name and posted value are contained in the POST array
//
// MAKE SURE the serial numbers of configured devices match the hopper URI configured in VirtualHub!
$route['hopper/debug'] = 'hopper/debug';
$route['hopper/(:any)'] = 'hopper/$1';
