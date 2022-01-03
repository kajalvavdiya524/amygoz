<?php defined('SYSPATH') or die('No direct script access.');


//this code is from meribahu website
return array(
    'secret_key' => 'sk_live_kkbqce7uZpKM3gQoonNHrFVW',
    'publishable_key' => 'pk_live_xGGLFofePaF3Yd9SrGuL3CjG',

    'plans' => array('python', 'cobra', 'rattle'),

    'python' => array(
        'name' => 'Python',
        'cents' => 499,
        'dollar' => '$4.99',
        'r_to_friend' => 20,
        'r_to_anyone' => 8,
        'm_to_anyone' => 20,
    ),
    
    'cobra' => array(
        'name' => 'Cobra',
        'cents' => 599,
        'dollar' => '$5.99',
        'r_to_friend' => 20,
        'r_to_anyone' => 16,
        'm_to_anyone' => 25,
    ),
    
    'rattle' => array(
        'name' => 'Rattle',
        'cents' => 699,
        'dollar' => '$6.99',
        'r_to_friend' => 20,
        'r_to_anyone' => 24,
        'm_to_anyone' => 30,
    ),
);