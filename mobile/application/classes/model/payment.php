<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * payment model 
 *
 *
 @package
 */
 
 class Model_Payment extends ORM {
    protected $_belongs_to = array(
        'user' => array(),
    );
}