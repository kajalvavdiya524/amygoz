<?php defined('SYSPATH') or die('No direct script access.');

// this is the controller for the around page. 


class Controller_Localpeople extends Controller_Template {

     public $template = 'templates/localpeople';
    
//if the user is not logged in
    
    public function before() 
    {
        parent::before();
        if(!Auth::instance()->logged_in()) { //if not login redirect to login page
            $this->request->redirect('pages/login');
        } else if( Auth::instance()->get_user()->registration_steps != 'done') {
            Auth::instance()->get_user()->check_registration_steps();
        }
        
        //if request is ajax don't load the template
        if(!$this->request->is_ajax()) {

            $this->template->title = 'Find local singles around you | Callitme';
            $this->template->description = 'Callitme helps you find local singles';
            $this->template->header = View::factory('templates/members-header');
            $this->template->sidemenu = View::factory('templates/sidemenu', array('side_menu' => 'around'));
            $this->template->footer = View::factory('templates/footer');
        }
	
    }


//if the user is logged in

    public function action_index() 
    {
        $current_user = Auth::instance()->get_user();
        
        $data['userlat'] = $current_user->latitute;
        $data['userlong'] = $current_user->longitude;
        $this->template->title = 'Find local singles around you | callitme';

        // $current_user->latitute = 37;
        // $current_user->longitude = -122;
        $radius = $this->request->post('radius') ? $this->request->post('radius') : 50;
        $expr = "( 3959 * acos( cos( radians('".$current_user->latitute."') ) * cos( radians( latitute ) ) * cos( radians( longitude ) - radians('".$current_user->longitude."') ) + sin( radians('".$current_user->latitute."') ) * sin( radians( latitute ) ) ) )";
        
        $users = ORM::factory('user')->select(array(DB::expr($expr), 'distance'))
            ->where(DB::expr($expr), '<', $radius)
            ->where('not_registered', '=', 0)
            ->where('id', '!=', $current_user->id)
            ->group_by('ip')
            ->find_all()
            ->as_array();

        $mapusers = array();
        $mapusers['count'] = count($users);
        foreach($users as $user) {
            $temp['id'] = $user->id;
            $temp['url'] = url::base().$user->username;
            $temp['recommend_url'] = url::base().'peoplereview/compose?ask='.$user->username;
            $temp['message_url'] = url::base().'chat/compose?user='.$user->username;
            $temp['request_url'] = url::base().$user->username;
            $temp['friend_url'] = url::base().$user->username;
            
            if($current_user->check_friends($user)) {
                $temp['friend'] = 'friend';
            } else if($current_user->has('requests', $user)) {
                $temp['friend'] = 'request_sent';
            } else if($user->has('requests', $current_user)) {
                $temp['friend'] = 'request_received';
            } else {
                $temp['friend'] = 'not_friends';
            }
            
            $temp['lat'] = $user->latitute;
            $temp['long'] = $user->longitude;
            $temp['name'] = $user->user_detail->first_name." ".$user->user_detail->last_name;
            if($user->photo->profile_pic_s) {
                $temp['image'] = url::base()."upload/".$user->photo->profile_pic_s;
            } else {
                $temp['image'] = url::base()."img/no_image_s.png";
            }
            $temp['username'] = $user->username;
            $temp['age'] = $user->user_detail->birthday != '0000-00-00' ? date_diff(DateTime::createFromFormat('Y-m-d', $user->user_detail->birthday), date_create('now'))->y : 'NA' ;
            $temp['gender'] = $user->user_detail->sex;
            
            $mapusers['users'][] = $temp;
        }

        $data['mapusers'] = $mapusers;

        $this->template->content = View::factory('around/index',$data);
    }

}