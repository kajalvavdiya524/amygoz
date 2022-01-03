<?php defined('SYSPATH') or die('No direct script access.');
// application/config/encrypt.php
 
return array(
 
    'default' => array(
        'key'    => 'pOlUEN98kmc3Lquj54R8qPEka36cJ85lkgMrDg3287ubfYOPqd91cnAS952CNsD',
        'cipher' => MCRYPT_RIJNDAEL_128,
        'mode'   => MCRYPT_MODE_NOFB,
    ),
    'blowfish' => array(
        'key'    => 'bapUEN98kmc3namj54R8qPEka36cJ85lkgXzdg3287ubfYOPqd91cnASoqmCNsD',
        'cipher' => MCRYPT_BLOWFISH,
        'mode'   => MCRYPT_MODE_ECB,
    ),
    'tripledes' => array(
        'key'    => 'mbvUEN98kmc3navc0ji8qPEka36cJOadsaXzdg3287ubfYOPqd91cnASoqmCNsD',
        'cipher' => MCRYPT_3DES,
        'mode'   => MCRYPT_MODE_CBC,
    ),
);

?>