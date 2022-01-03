<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * custom auth user
 *
 * @package   
 */
class Model_Match extends ORM {

    protected $_belongs_to = array(
        'match_by' => array(
            'model' => 'user',
            'foreign_key' => 'by',
        ),
        'match_to' => array(
            'model' => 'user',
            'foreign_key' => 'match_user',
        ),
        'match_with' => array(
            'model' => 'user',
            'foreign_key' => 'with',
        )
    );

}