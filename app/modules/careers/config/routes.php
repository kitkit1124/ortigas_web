<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route['careers'] = 'careers/careers/index';

$route['careers/post/(:any)']  = 'careers/view/$1';
