<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * custom auth user
 *
 * @package   
 */
class Model_Activity extends ORM {

    protected $_belongs_to = array(
        'user' => array()
    );

    public function new_activity($type, $content, $target_id, $target_user, $another_user = null) {
        $activity = ORM::factory('activity');

        if(empty($another_user)) {
            $user = Auth::instance()->get_user();
        } else {
            $user = ORM::factory('user', $another_user);
        }
        
        $pattern = "/(@)([^\s]*)/i";
        $replace='Model_Post::format_username';
        $content =  preg_replace_callback($pattern,$replace, $content);

        $activity->user_id = $user->id;
        $activity->type = $type;

        if($type === 'arequest' || $type === 'arequest_match') {
            $activity->activity = $content;
        } else {
            $activity->activity = $user->user_detail->first_name ." ".$user->user_detail->last_name ." ".$content;
        }

        $activity->target_id = $target_id;
        $activity->target_user = $target_user;
        $activity->time = date("Y-m-d H:i:s");

        $activity->save();
    }


    public function new_s_activity($type, $content, $target_id, $target_user, $another_user = null) {
        $activity = ORM::factory('activity');

        if(empty($another_user)) {
            $user = Auth::instance()->get_user();
        } else {
            $user = ORM::factory('user', $another_user);
        }

        $pattern = "/(@)([^\s]*)/i";
        $replace='Model_Post::format_username';
        $content =  preg_replace_callback($pattern,$replace, $content);

        $activity->user_id = $user->id;
        $activity->type = $type;

        if($type === 'arequest' || $type === 'arequest_match') {
            $activity->activity = $content;
        } else {
            $activity->activity = "Anonymous User ".$content;
        }

        $activity->target_id = $target_id;
        $activity->target_user = $target_user;
        $activity->time = date("Y-m-d H:i:s");

        $activity->save();
    }

    public function delete_activity($type, $user) {
        $activity = ORM::factory('activity');

        $activity->where('user_id', '=', $user->id);
        $activity->where('type', '=', $type);

        foreach($activity->find_all()->as_array() as $acti) {
            $acti->delete();
        }
    }
}