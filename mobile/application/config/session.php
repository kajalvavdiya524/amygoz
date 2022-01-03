<?php defined('SYSPATH') or die('No direct script access.');

return array(
    'native' => array(
        'name' => 'ipintoo_session',
        'lifetime' => 31536000, 
    ),
    'cookie' => array(
        'name' => 'ipintoo_session',
        'encrypted' => TRUE,
        'lifetime' => 31536000,
    ),
);
