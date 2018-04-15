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
	$route['relations/delete/(:num)'] = 'panel/delete_relations/$1';
	$route['relations/toggle/(:num)'] = 'panel/toggle_relations/$1';

$route['alerts'] = 'panel/alerts';
$route['settings'] = 'panel/settings';
	$route['settings/update'] = 'panel/update_setting';

// Route for the input hopper, a controller that recieves POSTs from Yoctopuce's VirtualHub
// on localhost.
// Device names and posted values are contained in the POST array
$route['hopper/debug'] = 'hopper/debug';
$route['hopper/(:any)'] = 'hopper/$1';
