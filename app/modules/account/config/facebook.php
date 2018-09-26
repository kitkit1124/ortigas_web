<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['facebook_app_id']				= '';
$config['facebook_app_secret']			= '';
$config['facebook_login_url']			= 'account/facebook/login';
$config['facebook_callback_url']		= 'account/facebook/callback';
$config['facebook_permissions']         = array('public_profile', 'email');
$config['facebook_graph_version']		= 'v3.0';
$config['facebook_default_password']	= '@facebook^does&not*have%pass123';