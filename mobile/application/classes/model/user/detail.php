<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * payment model
 *
 * @package   
 */
class Model_User_detail extends ORM {

    public function get_name() {
        return $this->first_name .' '.$this->last_name;
    }

    protected $_has_one = array(
        'user' => array(),
         'photo' => array(),
    );

    public function get_no_image_name() {
        return (isset($this->first_name[0]) ? $this->first_name[0] : '').(isset($this->last_name[0]) ? $this->last_name[0] : '');
    }

    public function list_attributes($count = 2) {
        $attr = array();
        
        //Username
        $user = ORM::factory('user', array('user_detail_id' => $this->id));
        if (!empty($user->username)) {
            $attr[] = '@'.$user->username;
        }

        if(!empty($this->location)) {
            $attr[] = explode(',', $this->location)[0];
        }


        $posts = $this->user->posts->where('type','=','post')
            ->where('is_deleted','=','0')->count_all();

        if($posts > 1) {
            $attr[] = $posts." Posts";
        }

        // Number of Inspires
        $inspires = DB::select('inspires.id','user_id','user_by','users.email','users.username','user_details.first_name','user_details.last_name','user_details.phase_of_life','user_details.designation','photos.profile_pic_o','photos.profile_pic')
               ->from('inspires')
               ->join('users','RIGHT')
               ->on('users.id','=','inspires.user_id')
               ->join('photos','LEFT')
               ->on('photos.id','=','users.photo_id')
               ->join('user_details','LEFT')
               ->on('users.user_detail_id','=','user_details.id')
               ->where('user_by','=',$this->id)
               ->where('status','=','1')
               ->order_by('id', 'desc')
               ->execute()
               ->as_array();
        if(count($inspires) > 1) {
            $attr[] = count($inspires)." Inspired";
        }

        if(count($attr) == $count) { return $attr; }

        $friends = ORM::factory('friendship')->where('user_id', '=', $this->user->id)->count_all();
        if($friends > 1) {
            $attr[] = $friends." Friends";
        }
        if(count($attr) == $count) { return $attr; }

        if($this->education) {
            $attr[] = $this->education;
        }

        if(count($attr) == $count) { return $attr; }

        if($this->employment) {
            $attr[] = $this->employment;
        }

        return $attr;
    }    
}