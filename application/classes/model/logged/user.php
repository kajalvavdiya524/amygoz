<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * payment model
 *
 * @package   
 */
class Model_Logged_user extends ORM {
    
    protected $_belongs_to = array(
		'user' => array(),
	);
    
}