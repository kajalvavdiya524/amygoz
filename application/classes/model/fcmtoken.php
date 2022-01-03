<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * custom auth user
 *
 * @package   
 */
class Model_Fcmtoken extends ORM {

    protected $_belongs_to = array(
        'from' => array(
            'model' => 'user',
            'foreign_key' => 'user_id',
        ),
    );

}