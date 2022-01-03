<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * custom auth user
 *
 * @package   
 */
class Model_Recommend extends ORM {
    
    protected $_belongs_to = array(
        'owner' => array(
            'model' => 'user',
            'foreign_key' => 'from',
        ),
        'recommend_to' => array(
            'model' => 'user',
            'foreign_key' => 'to',
        )
    );
}