<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// default
$template['default_index']['template'] = 'default/index';
$template['default_index']['regions'] = array('head', 'styles', 'header', 'content', 'footer', 'scripts');
$template['default_index']['parser'] = 'parser';
$template['default_index']['parser_method'] = 'parse';
$template['default_index']['parse_template'] = FALSE;

// default
$template['default']['template'] = 'default/template';
$template['default']['regions'] = array('head', 'styles', 'header', 'content', 'footer', 'scripts');
$template['default']['parser'] = 'parser';
$template['default']['parser_method'] = 'parse';
$template['default']['parse_template'] = FALSE;

// modal
$template['modal']['template'] = 'default/modal';
$template['modal']['regions'] = array('styles', 'content', 'scripts');
$template['modal']['parser'] = 'parser';
$template['modal']['parser_method'] = 'parse';
$template['modal']['parse_template'] = FALSE;