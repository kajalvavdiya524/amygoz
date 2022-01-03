<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * payment model
 *
 * @package   
 */
class Model_Arequest_member extends ORM {
    protected $_belongs_to = array(
        'user' => array(
            'model' => 'user',
            'foreign_key' => 'user_id',
        )
    );
}