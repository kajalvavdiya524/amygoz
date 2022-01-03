<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * payment model
 *
 * @package   
 */
class Model_Profile_view extends ORM {
    
    protected $_belongs_to = array(
        'viewer' => array(
            'model' => 'user',
            'foreign_key' => 'viewed_by',
        )
    );

}