<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * custom auth user
 *
 * @package   
 */
class Model_Message extends ORM {

    protected $_belongs_to = array(
        'owner' => array(
            'model' => 'user',
            'foreign_key' => 'from',
        ),
        'message_to' => array(
            'model' => 'user',
            'foreign_key' => 'to',
        ),
        'main' => array(
            'model' => 'message',
            'foreign_key' => 'parent_id'
        )
    );

    protected $_has_many = array(
        'conversations' => array(
            'model' => 'message',
            'foreign_key' => 'parent_id',
        )
    );
    
    public function get_conversation($user, $user_to) {
        $message = ORM::factory('message')
                    ->where('parent_id', '=', 0)
                    ->where_open()
                        ->where_open()
                            ->where('to', '=', $user->id)
                            ->where('from', '=', $user_to->id)
                        ->where_close()
                        ->or_where_open()
                            ->where('to', '=', $user_to->id)
                            ->where('from', '=', $user->id)
                        ->or_where_close()
                    ->where_close()
                    ->find();

        return $message;
    }
    
    public function get_recent_messages($user, $user_to, $time) {
        $message = ORM::factory('message')
                    ->where('time', '>', $time)
                    ->where('to', '=', $user->id)
                    ->where('from', '=', $user_to->id)
                    ->find_all()
                    ->as_array();

        return $message;
    }

}