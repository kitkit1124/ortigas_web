<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route['404_override'] = 'website/page/page_not_found';

$route['residences'] = 'properties/categories/view/residences';
$route['offices'] = 'properties/categories/view/offices';
$route['malls'] = 'properties/categories/view/malls';

$route['estates'] = 'properties/estates/index';
$route['estates/(:any)']  = 'properties/estates/view/$1';

$route['estates/property/(:any)'] = 'properties/properties/view/$1';

$route['residences/(:any)'] = 'properties/view_specific_property/$1';
$route['malls/(:any)'] = 'properties/view_specific_property/$1';
$route['offices/(:any)'] = 'properties/view_specific_property/$1';
$route['amenities/(:any)'] = 'properties/view_specific_property/$1';

$route['search'] = 'properties/search/sglobal'; 

$route['property_search'] = 'properties/search/index'; 

$route['projects'] = 'properties/properties/index';
