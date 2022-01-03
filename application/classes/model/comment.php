<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * custom auth user
 *
 * @package   
 */
class Model_Comment extends ORM {

    protected $_belongs_to = array(
        'post' => array(),
        'user' => array()
    );

}