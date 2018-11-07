<?php defined('BASEPATH') OR exit('No direct script access allowed');

// account
$route['estates/category/(:any)'] = 'properties/categories/view/$1';

$route['estates'] = 'properties/estates/index';
$route['estates/(:any)']  = 'properties/estates/view/$1';

$route['estates/property/(:any)'] = 'properties/properties/view/$1';

$route['search'] = 'properties/search/index'; 

$route['inquire'] = 'properties/search/index';

$route['projects'] = 'properties/properties/index';
