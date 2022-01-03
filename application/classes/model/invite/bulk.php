<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * custom auth user
 *
 * @package   
 */
class Model_Invite_bulk extends ORM {
    
    protected $_belongs_to = array(
        'user' => array(
            'model' => 'user',
            'foreign_key' => 'user_id',
        ),
    );

}