<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * payment model
 *
 * @package   
 */
class Model_User_plan extends ORM {

    protected $_belongs_to = array(
        'user' => array(),
    );
}