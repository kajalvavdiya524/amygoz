<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * payment model
 *
 * @package   
 */
class Model_Request extends ORM {
    
    protected $_belongs_to = array(
        'user' => array(
            'model' => 'user',
            'foreign_key' => 'request_from',
        ),
        'to' => array(
            'model' => 'user',
            'foreign_key' => 'request_to',
        )
    );
}