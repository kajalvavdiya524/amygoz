<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * payment model
 *
 * @package   
 */
class Model_Ask_photo extends ORM {
    
    protected $_belongs_to = array(
        'requested_by' => array(
            'model' => 'member',
            'foreign_key' => 'asker_id',
        ),
        'member' => array(
            'model' => 'member',
            'foreign_key' => 'user_id',
        )
    );

}
