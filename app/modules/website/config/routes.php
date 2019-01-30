<?php defined('BASEPATH') OR exit('No direct script access allowed');


$route['category/(:any)'] = 'website/category/posts/$1';
$route['category/(:any)/(:any)'] = 'website/category/posts/$1/$2';
$route['category/(:any)/(:any)/(:any)'] = 'website/category/posts/$1/$2/$3';
$route['post/(:any)'] = 'website/post/view/$1';
$route['account/(:any)'] = 'website/account/$1';
$route['account/reset_password/(:any)'] = 'website/account/reset_password/$1';
$route['account/activate/(:num)/(:any)'] = 'website/account/activate/$1/$2';
$route['contact-us'] = 'website/contact/index';

$route['news'] = 'website/news/index';
$route['news/(:any)'] = 'website/news/view/$1';

$route['careers'] = 'careers/careers/index';
$route['careers/(:any)'] = 'careers/careers/view_division/$1';
$route['careers/(:any)/(:any)'] = 'careers/careers/view/$1/$2';

$route['page-not-found'] = 'website/page/page_not_found';

$route['([a-z0-9\-]+)'] = 'website/page/view/$1';



