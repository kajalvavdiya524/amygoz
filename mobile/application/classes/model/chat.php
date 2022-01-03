<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * custom auth user
 *
 * @package   
 */
class Model_Chat extends ORM {

    protected $_belongs_to = array(
        'from' => array(
            'model' => 'user',
            'foreign_key' => 'user_from',
        ),
        'to' => array(
            'model' => 'user',
            'foreign_key' => 'user_to',
        )
    );

    public function get_conversation($user, $user_to) {
        $chat = ORM::factory('chat')
            ->where_open()
                ->where_open()
                    ->where('user_to', '=', $user->id)
                    ->where('user_from', '=', $user_to->id)
                ->where_close()
                ->or_where_open()
                    ->where('user_to', '=', $user_to->id)
                    ->where('user_from', '=', $user->id)
                ->or_where_close()
            ->where_close()
            ->find();

        return $chat;
    }

    public function create_conversation($user, $user_to, $code = '') {
        $chat = ORM::factory('chat')
            ->where_open()
                ->where_open()
                    ->where('user_to', '=', $user->id)
                    ->where('user_from', '=', $user_to->id)
                ->where_close()
                ->or_where_open()
                    ->where('user_to', '=', $user_to->id)
                    ->where('user_from', '=', $user->id)
                ->or_where_close()
            ->where_close()
            ->find();
        
        if(!$chat->id){
            $chat = ORM::factory('chat');
            $chat->user_from = $user->id;
            $chat->user_to = $user_to->id;
            $chat->code = ($code) ? $code : Text::random(null, 10);
            $chat->start_date = date("Y-m-d H:i:s");
            
            $chat->save();
        }

        return $chat;
    }
}