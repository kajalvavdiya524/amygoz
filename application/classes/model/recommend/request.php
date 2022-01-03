<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * payment model
 *
 * @package   
 */
class Model_Recommend_request extends ORM {
    
    protected $_belongs_to = array(
        'owner' => array(
            'model' => 'user',
            'foreign_key' => 'from',
        ),
        'request_to' => array(
            'model' => 'user',
            'foreign_key' => 'to',
        )
    );

}