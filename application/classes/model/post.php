<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * custom auth user
 *
 * @package   
 */
class Model_Post extends ORM {

    protected $_belongs_to = array(
        'user' => array(),
    );
    
    protected $_has_many = array(
        'comments' => array(
            'model' => 'comment',
            'foreign_key' => 'post_id',
        )
    );

    public function new_post($type, $content, $action = '', $another_user = null) {
        $post = ORM::factory('post');
        
        if(empty($another_user)) {
            $user = Auth::instance()->get_user();
        } else {
            $user = ORM::factory('user', $another_user);
        }

        $content = strip_tags($content);
        if($type == 'post') {
            $content = Text::parse_text($content);
        } else {
            $content = Text::parse_text($content, false);
        }
        
        $pattern = "/(@)([^\s]*)/i";
        $replace='Model_Post::format_username';
        $content =  preg_replace_callback($pattern,$replace, $content);
        $action =  preg_replace_callback($pattern,$replace, $action);

        $post->user_id = $user->id;
        $post->type = $type;
        $post->post = $content;
        $post->action = $action;
        $post->time = date("Y-m-d H:i:s");

        $post->save();

        return $post;
    }
    
    public function delete_post($type, $user) {
        $post = ORM::factory('post');

        $post->where('user_id', '=', $user->id);
        $post->where('type', '=', $type);

        foreach($post->find_all()->as_array() as $pos) {
            $pos->delete();
        }
    }

    public static function format_username($matches) { 
        // preg_replace_callback() is passed one parameter: $matches.

        $user = ORM::factory('user', array('username' => $matches[2]));
        if($user->loaded()) {
            $str = '<a href="'. $matches[2] .'">'.$user->user_detail->first_name ." ".$user->user_detail->last_name .'</a>';
        } else {
            $str = $matches[0];
        }
        return $str;
    }
}