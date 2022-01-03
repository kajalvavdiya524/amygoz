<?php defined('SYSPATH') or die('No direct script access.');


class Controller_Members extends Controller_Template {

    public $template = 'templates/profile';
    
    public function before() {
        parent::before();

        if(!Auth::instance()->logged_in()) { //if not login redirect to login page
            $this->request->redirect('pages/login');
        } else if( Auth::instance()->get_user()->registration_steps != 'done') {
            Auth::instance()->get_user()->check_registration_steps();
        }
        Auth::instance()->get_user()->check_plan_validity();
        //if request is ajax don't load the template
        if(!$this->request->is_ajax()) 
        {
            $this->template->title = 'Build your online credibility with people review site - Callitme';
            $this->template->description = 'Callitme is a crowd powered people network to review people and match single friends';
            $this->template->header = View::factory('templates/members-header');
            $this->template->sidemenu = View::factory('templates/sidemenu', array('side_menu' => 'feeds'));
            $this->template->footer = View::factory('templates/member-footer');
        }
    }
    public function action_index() 
    {
        $user = Auth::instance()->get_user();
        //create array of member_ids for fetching posts.
        $friends_array[0] = $user->id; //add member_id of current user also
        foreach ($user->friends->where('is_deleted', '=', 0)->find_all()->as_array() as $friend) 
        {
            $friends_array[] = $friend->id;
        }
        if(!$this->request->is_ajax()) 
        {
            $time = date("Y-m-d H:i:s", time()+10); //fetch all the posts
        } 
        else 
        {
            $time = date("Y-m-d H:i:s", $this->request->query('time')); // fetch posts before particular time for pagination
        }
        //fetch all posts from the members user is following.
        $posts = ORM::factory('post')
            ->where('user_id', 'IN', $friends_array)
            ->and_where('is_deleted', '=', 0)
            ->and_where('time', '<', $time)
            ->order_by('time', 'desc')
            ->limit(10)
            ->find_all()
            ->as_array();
        $data['posts'] = $posts; //set post to use in the view
        $data['friends'] = $user->friends->order_by(DB::expr('RAND()'))->find_all()->as_array(); 
        if(Request::current()->query('mutual')) 
        {
            $data['friends'] = $user->mutual_friends($session_user);
        }
        if(!$this->request->is_ajax()) 
        {
            $this->template->header = View::factory('templates/members-header');
            $this->template->title = 'Member Home';
            $this->template->footer = View::factory('templates/member-footer');
            $this->template->content = View::factory('members/feeds', $data);
        } 
        else 
        {
            $this->auto_render = false;
            echo View::factory('members/posts', $data);
        }
    }
    public function action_recent_post() 
    {
        $user = Auth::instance()->get_user();
        $friends_array[0] = $user->id; //add member_id of current user also
        foreach ($user->friends->where('is_deleted', '=', 0)->find_all()->as_array() as $friend) 
        {
            $friends_array[] = $friend->id;
        }
        $time = date("Y-m-d H:i:s", $this->request->query('time'));
        $posts = ORM::factory('post')
            ->where('user_id', 'IN', $friends_array)
            ->and_where('is_deleted', '=', 0)
            ->and_where('time', '>', $time)
            ->order_by('time', 'desc')
            ->limit(10)
            ->find_all()
            ->as_array();
        $data['posts'] = $posts; //set post to use in the view
        $this->auto_render = false;
        echo View::factory('members/posts', $data);
    }
    public function action_add_post() 
    {
        if($this->request->post('post')) 
        {


            $user = Auth::instance()->get_user();
            

            if($_FILES["picture"]["size"] > 0){

                $name1 = $_FILES["picture"]['name'];

                $ext = end((explode(".", $name1))); # extra () to prevent notice
                $picture = Upload::save($_FILES['picture'], null , DOCROOT."upload/");
                $str = Text::random();
                $original = "pp-".$user->id ."-".$str."_o.jpg"; //original profile pic
                //resize to different sizes
                $image = Image::factory($picture);
                $image->resize(500, 500);

                $image->save(DOCROOT."upload/".$original);

                $str = Text::random();
                $name = "ppi-".$user->id ."-".$str.".jpg"; //main profile pic
                $name_s = "ppi-".$user->id ."-".$str."_s.jpg"; //small pic
                $name_m = "ppi-".$user->id ."-".$str."_m.jpg"; //mini pic

                if(strtolower($ext) == 'jpg' || strtolower($ext) =='jpeg' || strtolower($ext) =='TIFE') {
                    $exif = exif_read_data($picture);
                } else {
                    $exif = $picture;
                }
                
                if(isset($exif['Orientation'])) {
                    $image = Image::factory($picture);
                    $ort =   $exif['Orientation'];
                   
                    switch ($ort) {
                        case 1: // nothing
                            break;

                        case 2: // horizontal flip
                            $image->flip(Image::HORIZONTAL);
                            break;

                        case 3: // 180 rotate left
                            $image->rotate(-180);
                            break;

                        case 4: // vertical flip
                            $image->flip(Image::VERTICAL);
                            break;

                        case 5: // vertical flip + 90 rotate right
                            $image->flip(Image::VERTICAL);
                            $image->rotate(90);
                            break;

                        case 6: // 90 rotate right
                            $image->rotate(90);
                            break;

                        case 7: // horizontal flip + 90 rotate right
                            $image->flip(Image::HORIZONTAL);
                            $image->rotate(90);
                            break;

                        case 8:    // 90 rotate left
                            $image->rotate(-90);
                            break;
                    }
                    $image->save();
                }

                $image->resize(400, null);
                //$image->crop(400,400);
                $image->save(DOCROOT."upload/".$name); 
                $image->resize(null, 63);
                $image->save(DOCROOT."upload/".$name_s);
                $image->resize(null, 50);
                $image->save(DOCROOT."upload/".$name_m);
                //update image names in database
                $photo = ORM::factory('photo');
                $photo->profile_pic   = basename($name);
                $photo->profile_pic_o = basename($original);
                $photo->profile_pic_m = basename($name_m);
                $photo->profile_pic_s = basename($name_s);
                $photo->save();
                

                //$this->post = new Model_Post;
                //$this->post->delete_post('profile_pic', $user);
                //$post = $this->post->new_post('profile_pic', url::base().'mobile/upload/'.$photo->profile_pic_o, " has updated profile picture. ");

                $content = [];

                $content['text'] = $this->request->post('post');
                $content['photo'] = url::base().'upload/'.$photo->profile_pic_o;

                $this->post = new Model_Post;
                $this->post->new_post_with_image('post', $content);

            }else{
                $this->post = new Model_Post;
                $this->post->new_post('post', $this->request->post('post'));
            }
            
        }
        $this->request->redirect(url::base());
    }
    public function action_view_post() 
    {
        //$this->auto_render = false;
        $post_id = $this->request->param('id');
        $post = ORM::factory('post',$post_id);
        $data['post'] = $post;
        $this->template->content = View::factory('members/view_post', $data);
    }

    public function action_add_comment() {
        $this->auto_render = false;
        $user = Auth::instance()->get_user();
        if($this->request->post('comment')) {
            $post_id = $this->request->post('post_id');
            $comment = ORM::factory('comment');
            $comment->user_id = $user->id;
            $comment->post_id = $this->request->post('post_id');
            $comment->comment = $this->request->post('comment');
            $comment->time = date("Y-m-d H:i:s");
            $comment->save();

            $this->activity = new Model_Activity;
            if($comment->user_id != $comment->post->user->id) {
                //add to activity.
                $this->activity->new_activity('comment', 'added a comment on your post', $comment->post->id, $comment->post->user->id);
            }

            $unique_users_comment = $comment->post->comments
                                            ->where('user_id', '!=', $comment->user_id)
                                            ->and_where('user_id', '!=', $comment->post->user->id)
                                            ->group_by('user_id')
                                            ->find_all()
                                            ->as_array();
                                                    
            foreach($unique_users_comment as $unique_user_comment) {

                if($comment->user_id ==  $comment->post->user->id) {
                    
                    $this->activity->new_activity('comment',
                        'also commented on '.($comment->user->user_detail->sex == 'Female' ? 'her' : 'his').' post',
                        $comment->post->id, $unique_user_comment->user->id);
                } else {
                    $this->activity->new_activity('comment',
                        'also commented on '.$comment->post->user->user_detail->first_name .'\'s post',
                        $comment->post->id, $unique_user_comment->user->id);
                }

            }
              $this->request->redirect(url::base()."members/view_post/".$post_id);
            //$this->request->redirect(url::base()."commentpost".$post_id);
        }

    }

    public function action_delete_post() {
        $this->auto_render = false;
        if($this->request->post('post')) {
            // check if post is made by the current member or not
            $post = ORM::factory('post')
                ->where('user_id','=', Auth::instance()->get_user()->id)
                ->and_where('id', '=', $this->request->post('post'))
                ->find();
                
            if(!empty($post->id)) { //if yes, delete the post
                $post->is_deleted = 1;
                $post->save();
                $this->request->redirect(url::base());
                echo "deleted";
            } else {
                $this->request->redirect(url::base());
                echo "error";
            }
        } else {
            $this->request->redirect(url::base());
            echo "error";
        }
    }

    public function action_delete_comment() {
        $this->auto_render = false;
        if($this->request->post('comment')) {
            // check if comment is made by the current user
            $comment = ORM::factory('comment')
                ->where('user_id','=', Auth::instance()->get_user()->id)
                ->and_where('id', '=', $this->request->post('comment'))
                ->find();
                
            if(!empty($comment->id)) {
                $comment->is_deleted = 1; // update is delete fields
                $comment->save();
                $this->request->redirect(url::base());
                echo "deleted";
            } else {
                $this->request->redirect(url::base());
                echo "error";
            }
            
        } else {
            $this->request->redirect(url::base());
            echo "error";
        }
    }

 /*  public function action_search() { 
        if ($this->request->query('query')) {
            // autocomplete functionality for searching a user.
            $users =  ORM::factory('user')->with('user_detail')
                ->where_open()
                    ->where('first_name','like', '%'.$this->request->query('query').'%')
                    ->or_where('last_name', 'like', '%'.$this->request->query('query').'%')
                ->where_close()
                ->where('not_registered', '=', 0)
                ->find_all();

            $data['users'] = $users;
            $data['search_word'] = $this->request->query('query');
            
            $this->auto_render = false;
            echo View::factory('members/search',$data)->render();
        } else if($this->request->post('search_word')) {
            $users =  ORM::factory('user')->with('user_detail')
                ->where_open()
                    ->where('first_name','like', '%'.$this->request->post('search_word').'%')
                    ->or_where('last_name', 'like', '%'.$this->request->post('search_word').'%')
                ->where_close()
                ->find_all()
                ->as_array();
            
            $data['users'] = $users;
            $data['search_word'] = $this->request->post('search_word');
            
            $this->template->content = View::factory('members/members', $data);
        
        } else {
            $this->request->redirect(url::base());
        }
    }

    */
    /**********************search written by abhishek kumar singh**************************/
    public function action_search() { 
        if ($this->request->query('query')) 
        {
            $name=$this->request->query('query');
            $words = explode(' ', $name);       
            $users =  ORM::factory('user')->with('user_detail')
                    ->where_open()
                    ->where('first_name','like',$words[0].'%')
                    ->where('user.is_blocked','=',0)
                    ->or_where('last_name', 'like', $this->request->query('query').'%')
                    ->where_close()
                    ->where('not_registered', '=', 0)
                    ->find_all();
            $data['users'] = $users;
            $data['search_word'] = $this->request->query('query');
            $this->auto_render = false;
            echo View::factory('members/search',$data)->render();
        } 
        else if($this->request->post('search_word')) 
        {
            $users  =  ORM::factory('user')->with('user_detail')
                    ->where_open()
                    ->where('first_name','like', $this->request->post('search_word').'%')
                    ->or_where('last_name', 'like',$this->request->post('search_word').'%')
                    ->where('user.is_blocked','=',0)
                    ->where_close()
                    ->find_all()
                    ->as_array();
            $data['users'] = $users;
            $data['search_word'] = $this->request->post('search_word');
            $this->template->content = View::factory('members/members', $data);
        } 
        else 
        {
            $this->request->redirect(url::base());
        }
    }
    /********************** End search written by abhishek kumar singh**************************/
   

    public function action_find_user() {
        $this->auto_render = false;
        if ($this->request->query('query')) {
            $user = Auth::instance()->get_user();
            // autocomplete functionality for searching a user.
            $users =  ORM::factory('user')->with('user_detail')
                ->where_open()
                    ->where(DB::expr('CONCAT(first_name, " ", last_name)'),'like', $this->request->query('query').'%')
                    ->or_where('email', 'like', $this->request->query('query').'%')
                ->where_close()
                ->where('is_blocked','=',0)
                ->where('not_registered', '=', 0)
                ->and_where('profile_public', '=', '0')
                ->where('user.id', '!=', $user->id)
                ->find_all()
                ->as_array();

            $data['users'] = $users;
            echo View::factory('members/registered_users',$data)->render();
        }
    }
    
    public function action_find_user_json() {
        $this->auto_render = false;
        $final_json = array();
        if ($this->request->query('term')) {
            $user = Auth::instance()->get_user();
            // autocomplete functionality for searching a user.
            $users  =  ORM::factory('user')->with('user_detail')
                ->where_open()
                ->where(DB::expr('CONCAT(first_name, " ", last_name)'),'like', $this->request->query('term').'%')
                ->or_where('email', 'like', $this->request->query('term').'%')
                ->where_close()
                ->where('is_blocked','=', 0)
                ->where('not_registered', '=', 0)
                ->and_where('profile_public', '=', '0')
                ->where('user.id', '!=', $user->id)
                ->find_all();

            foreach($users as $user) {
                $temp = array();
                $temp['name'] = $user->user_detail->first_name." ".$user->user_detail->last_name;
                $temp['email'] = $user->email;
                $temp['no_image'] = $user->user_detail->get_no_image_name();

                $photo = $user->photo->profile_pic_s;
                $user_image_mob = file_exists("mobile/upload/" .$photo);
                $user_image = file_exists("upload/" .$photo);

                if(!empty($photo) && $user_image_mob) {
                    $temp['image'] = url::base()."mobile/upload/".$user->photo->profile_pic_s;
                } else if(!empty($photo) && $user_image_mob) {
                    $temp['image'] = url::base()."upload/".$user->photo->profile_pic_s;
                } else {
                    $temp['image'] = '';
                }

                $recommendations = $user->recommendations->where('state', '=', 'approve')->order_by('time', 'desc')->find_all()->as_array();

                $temp_words = array();
                foreach($recommendations as $recommend) {
                    $words = explode(', ', $recommend->words);
                    $temp_words = array_merge($temp_words, $words);
                }

                $tags = array_count_values($temp_words);
                $temp['social'] = $user->calculate_social_percentage($tags);

                if(!empty($user->user_detail->location)) {
                    $loc =  $user->user_detail->location; 
                    $b   =  explode(', ', $loc);

                    if(!empty($b[0]) && !empty($b[2])) {
                        $temp['location'] = $b[0].", ".$b[2];
                    } else if(!empty($b[0])) {
                        $temp['location'] = ucwords($b[0]);
                    } else {
                        $temp['location'] = ucwords($b[2]);
                    } 
                } else if(!empty($user->user_detail->home_town)) { 
                    $temp['location'] = $user->user_detail->home_town;
                } else {
                    $temp['location'] = 'Washington, DC, United States';
                }

                $final_json[] = $temp;
            }

        }

        echo  json_encode($final_json);
    }
    
    public function action_invite_find_user() {
       $this->auto_render = false;
        if ($this->request->query('query')) {
            $user = Auth::instance()->get_user();
            
            // autocomplete functionality for searching a user.
            $users  =  ORM::factory('user')->with('user_detail')
                    ->where_open()
                    ->where(DB::expr('CONCAT(first_name, " ", last_name)'),'like', $this->request->query('query').'%')
                    ->or_where('email', 'like', $this->request->query('query').'%')
                    ->where_close()
                    ->where('is_blocked','=',0)
                    ->where('not_registered', '=', 0)
                    ->and_where('profile_public', '=', '0')
                    ->where('user.id', '!=', $user->id)
                    ->find_all()
                    ->as_array();

            $data['users'] = $users;
            echo View::factory('members/request_send_users',$data)->render();
        }
    }
    public function action_is_registered() {
        $this->auto_render = false;
        if ($this->request->post('email')) {
            // autocomplete functionality for searching a user.
            $count =  ORM::factory('user')->with('user_detail')
                ->where('email','=', $this->request->post('email'))
                ->where('not_registered', '=', 0)
                ->count_all();

            echo $count;
        }
    }

    public function action_profile() {
        $username = $this->request->param('username'); // username
        $user = ORM::factory('user', array('username' => $username));
        if($user->id == NULL) {
            $this->request->redirect(url::base());
        }
        if($user->profile_public == '1') {
            $path=url::base()."public/".$username;
            $this->request->redirect( $path);
        }

        if ($user->is_deleted == 1) {
            $this->auto_render = false;
            $this->response->body(View::factory('error/deactivate'));
        }

        if($user->id !== Auth::instance()->get_user()->id) {
            $viewed = Session::instance()->get('viewed');

            if(empty($viewed)) {
                $viewed = array();
            }

            if(!in_array($user->id, $viewed)) {
                $viewed[] = $user->id;
                Session::instance()->set('viewed', $viewed);

                $this->activity = new Model_Activity;
                $this->activity->new_activity('profile_view', 'has viewed your profile', Auth::instance()->get_user()->id, $user->id);
                
                $view = ORM::factory('profile_view');
                $view->user_id = $user->id;
                $view->viewed_by = Auth::instance()->get_user()->id;
                $view->time = date("Y-m-d H:i:s");
                $view->save();
            }
        }

        $data['user'] = $user;
        

        $recommendations = $user->recommendations->where('state', '=', 'approve')->order_by('time', 'desc')->find_all()->as_array();

        $temp_words = array();
        foreach($recommendations as $recommend) {
            $words = explode(', ', $recommend->words);
            $temp_words = array_merge($temp_words, $words);
        }
        $tags = array_count_values($temp_words);
        
        $data['friends'] = $user->friends->find_all()->as_array();
        
        if(Request::current()->query('mutual')) {
            $data['friends'] = $user->mutual_friends($session_user);
        }
         $userss = ORM::factory('user')->with('user_detail')
            ->where('sex', '=', $user->user_detail->sex)
            ->where('is_deleted', '=', 0)
            ->where('username', '!=', $username)
            ->and_where('profile_public', '=', '0')
            ->order_by(DB::expr('RAND()'))
            ->limit(8)
            ->find_all()
            ->as_array();

        $matches = ORM::factory('user')->with('user_detail')
            ->where('sex', '=', (($user->user_detail->sex == 'Male') ? 'Female' : 'Male'))
            ->where('is_deleted', '=', 0)
            ->where('username', '!=', $username)
            ->and_where('profile_public', '=', '0')
            ->order_by(DB::expr('RAND()'))
            ->limit(8)
            ->find_all()
            ->as_array();

        $data['match'] = $matches;
        $data['item'] = $userss;
        $data['tags'] = $tags;

        $posts = ORM::factory('post')
            ->where('user_id', '=', $user->id)
            ->and_where('is_deleted', '=', 0)
            ->order_by('time', 'desc')
            ->find_all()
            ->as_array();

        // $posts = DB::select('*')
        //     ->from('posts')
        //     ->where('user_id','=',$user->id)
        //     ->where('type','=','post')
        //     ->where('is_deleted','=','0')
        //     ->order_by('id', 'desc')
        //     ->execute()
        //     ->as_array();

        $data['posts'] = $posts;

        $data['social'] = $user->calculate_social_percentage($tags);

        $data['recommendations'] = $recommendations;        
        $name = $user->user_detail->get_name();
        $keyword = $name." Reviews, " .$name. " Personality, ";

        $keyword .= $name." ".$user->user_detail->location . ", Friends of ".$name;
        /* if(!empty($user->user_detail->designation)){ $keyword.= " and works as " .$user->user_detail->designation ; }
        if(!empty($user->user_detail->employment)){ $keyword.= " at " .$user->user_detail->employment. " ," ; }
        if(!empty($data['social'])){ $keyword.=  " social percentage " . $data['social']. " ," ; }
        if(!empty($user->friends)){ $keyword.=  " Friends of ".$user->friends."".$name. " ," ; } */

        $title_str = $name;
        if(!empty($user->user_detail->employment)){
            $title_str .= " - ".$user->user_detail->employment;
        }
        if(!empty($user->user_detail->designation)){
            $title_str .= " - ".$user->user_detail->designation;
        }

        $this->template->title = $title_str  .' | Callitme';
        $this->template->keywords =  $keyword;
        $this->template->img = url::base()."upload/".$user->photo->profile_pic;
        $this->template->description = 'View ' . $name . '\'s full profile on Callitme. Callitme helps people like you and ' . $name . ' find new friends and meet trusted people online. Find ' . $name . '\'s  friends, family, education, school, job and reviews.';

        $this->template->sidemenu = View::factory('templates/sidemenu_home', $data);
        $this->template->content = View::factory('members/profile', $data);

    }
    
    public function action_check_notifications() 
    {
        $this->auto_render = false;
        $user = Auth::instance()->get_user();
        $data['friend'] =  ORM::factory('Request')->where('request_to', '=', $user->id)->where('seen', '=', 0)->count_all();

        $data['message'] = ORM::factory('message')
                    ->where_open()
                        ->where_open()
                            ->where('to', '=', $user->id)
                            ->where('to_unread', '=', 1)
                            ->where('to_deleted', '=', 0)
                        ->where_close()
                        ->or_where_open()
                            ->where('from', '=', $user->id)
                            ->where('from_unread', '=', 1)
                            ->where('from_deleted', '=', 0)
                        ->or_where_close()
                    ->where_close()
                    ->and_where('parent_id', '=', 0)
                    ->count_all();

        $friends_array = array();
        foreach ($user->friends->where('is_deleted', '=', 0)->find_all()->as_array() as $friend) {
            $friends_array[] = $friend->id;
        }
        
        $user = Auth::instance()->get_user();

      
            $activities = ORM::factory('activity')
                ->where('time', '>', $user->read_notification_at)
                ->where('target_user', '=', $user->id)
                ->order_by('time', 'desc')
                ->count_all();
        
        $data['message'] = 0;
        $data['activities'] = $activities;
        echo json_encode($data);
    }

    public function action_activity_notification() 
    {

        $user = Auth::instance()->get_user();
        if($this->request->query('seen')) 
        {
            $user->read_notification_at = date("Y-m-d H:i:s");
            $user->save();
            echo 'done';
        } 
        else 
        {
            $user->read_notification_at = date("Y-m-d H:i:s");
            $user->save();
            $friends_array = array(); 
            foreach ($user->friends->where('is_deleted', '=', 0)->find_all()->as_array() as $friend) 
            {
                $friends_array[] = $friend->id;
            } 
            if(!empty($friends_array)) 
            {
                $activities = ORM::factory('activity')
                            ->and_where_open()
                            ->where('target_user', '=', $user->id)
                            ->or_where_open()
                            ->where('user_id', 'IN', $friends_array)
                            ->and_where('target_user', '=', 0)
                            ->or_where_close()
                            ->and_where_close()
                            ->order_by('time', 'desc')
                            ->limit(8)
                            ->find_all()
                            ->as_array();
            } 
            else 
            {
                $activities = ORM::factory('activity')
                            ->where('target_user', '=', $user->id)
                            ->order_by('time', 'desc')
                            ->limit(8)
                            ->find_all()
                            ->as_array();
            }
            $this->template->content = View::factory('members/activities', array('activities' => $activities))->render();
        }
    }
    public function action_view_activities() 
    {
        $user = Auth::instance()->get_user();
        $friends_array = array();
        //create array of member_ids for fetching posts.
        foreach ($user->friends->where('is_deleted', '=', 0)->find_all()->as_array() as $friend) {
            $friends_array[] = $friend->id;
        }

        if(!empty($friends_array)) {
            $activities = ORM::factory('activity')
                ->and_where_open()
                    ->where('target_user', '=', $user->id)
                    ->or_where_open()
                        ->where('user_id', 'IN', $friends_array)
                        ->and_where('target_user', '=', 0)
                    ->or_where_close()
                ->and_where_close()
                ->order_by('time', 'desc')
                ->find_all()
                ->as_array();
        } else {
            $activities = ORM::factory('activity')
                ->where('target_user', '=', $user->id)
                ->order_by('time', 'desc')
                ->find_all()
                ->as_array();
        }

        $data['activities'] = $activities;
        
        $this->template->sidemenu = View::factory('templates/sidemenu', array('side_menu' => ''));
        $this->template->content = View::factory('members/view_activities', $data);

    }

    public function action_matchOLD27_03_2017() {
        $user = Auth::instance()->get_user();

        if($this->request->post()) {
            $user_with = ORM::factory('user', array('email' => $this->request->post('email')));
            $match_user = ORM::factory('user', $this->request->post('match_user'));

            if(!$user_with->id) {
                $user_with = ORM::factory('user')->create_non_registered_user($this->request->post('email'));
            } else if($user_with->user_detail->sex == $match_user->user_detail->sex){
                Session::instance()->set('error', 'You cannot match your friends of same gender!');
                $this->request->redirect(url::base().$match_user->username);
            }

            $match = ORM::factory('match');
            $match->match_user = $match_user->id;
            $match->with = $user_with->id;
            $match->by = $user->id;
            $match->time = date("Y-m-d H:i:s");
            $match->save();
            if($user_with->user_detail->suggestion_email_alert)
            {
            //send email
                            $send_email = Email::factory('Callitme - '.$user->user_detail->first_name . ' has a match for you')
                            ->message(View::factory('mails/new_match_mail', array('match' => $match))->render(), 'text/html')
                            ->to($user_with->email)
                            ->from('noreply@callitme.com', 'Callitme')
                            ->send();
             }               
            Session::instance()->set('success', "".$user->user_detail->first_name.", thanks for taking your time to match ".$match_user->user_detail->first_name.". Match more of your single connections.");
            Session::instance()->set('matchs', 'match profile');
            $this->request->redirect(url::base().$match->match_to->username);

        } else {
            $this->request->redirect(url::base());
        }

    }
        public function action_match() {
        $user = Auth::instance()->get_user();

        if($this->request->post()) {
            $user_with  =  ORM::factory('user_detail')->with('user')
                        ->where(DB::expr('CONCAT(first_name, " ", last_name)'),'like', $this->request->post('first_name').'%')
                        ->find(); 
            /*$user_with = ORM::factory('user', array('email' => $this->request->post('email')));*/
            
            $match_user = ORM::factory('user', $this->request->post('match_user'));

            if(!$user_with->id) 
            {
                $user_with = ORM::factory('user')->create_non_registered_user($this->request->post('email'));
            } 
            else if($user_with->sex == $match_user->user_detail->sex)
            {
                Session::instance()->set('error', 'You cannot match your friends of same gender!');
                $this->request->redirect(url::base().$match_user->username);
            }

            $match = ORM::factory('match');
            $match->match_user = $match_user->id;
            $match->with = $user_with->id;
            $match->by = $user->id;
            $match->time = date("Y-m-d H:i:s");
            $match->save();
            if($user_with->suggestion_email_alert)
            {
            //send email
                            $send_email = Email::factory('Callitme - '.$user->user_detail->first_name . ' has a match for you')
                            ->message(View::factory('mails/new_match_mail', array('match' => $match))->render(), 'text/html')
                            ->to($user_with->user->email)
                            ->from('noreply@callitme.com', 'Callitme')
                            ->send();
             }               
            Session::instance()->set('success', "".$user->user_detail->first_name.", thanks for taking your time to match ".$match_user->user_detail->first_name.". Match more of your single connections.");
            Session::instance()->set('matchs', 'match profile');
            $this->request->redirect(url::base().$match->match_to->username);

        } else {
            $this->request->redirect(url::base());
        }

    }

    public function action_accept_match() {
        $user = Auth::instance()->get_user();
        $status = $this->request->post('status');
        $match = ORM::factory('match', $this->request->post('match'));
        
        $this->auto_render = false;
        if($match->id) {
        
            if($match->with == $user->id) {
                $match->with_agree = ($status == 'accept') ? 1 : 2;
                $match->save();
                
                if($status == 'accept') {
                    //send email
                    $send_email = Email::factory('Callitme - '.$user->user_detail->first_name . ' has a match for you')
                    ->message(View::factory('mails/conf_match_mail', array('match' => $match))->render(), 'text/html')
                    ->to($match->match_to->email)
                    ->from('noreply@callitme.com', 'Callitme')
                    ->send();
                }

                echo $status;
            } else if($match->match_user == $user->id) {
                $match->user_agree = ($status == 'accept') ? 1 : 2;
                $match->save();
                
                if($status == 'accept') {
                    //send email
                    $send_email = Email::factory('Congratulations! You made a match')
                    ->message(View::factory('mails/congrts_match_mail', array('match' => $match))->render(), 'text/html')
                    ->to($match->match_by->email)
                    ->from('noreply@callitme.com', 'Callitme')
                    ->send();
                }
                
                echo $status;
            }
        
        }
    }

public function action_askphoto()
    {
         $username = $this->request->param('username');
            $user_login = Auth::instance()->get_user();
            $asker_name=$user_login->user_detail->first_name;
         $user=ORM::factory('user',array('username'=>$username));
         $user_dtl = $user->user_detail;
         /*$user_dtl=DB::select()
                 ->from('user_details')
                 ->where('id','=',$user[0]['user_detail_id'])
                 ->execute();*/

         $time=date('Y-m-d H:i:s');
       
         $session_user = Auth::instance()->get_user();
         $current_user_id= $session_user->id;
         $current_user_detail_id=$session_user->user_detail_id;   
         $userid= $user->id;
         
        

        $membername=DB::select()
                         ->from('user_details')
                         ->where('id','=',$current_user_detail_id)
                         ->execute();

         //$user_name=$membername[0]['first_name']." ".$membername[0]['last_name'];
        
         $ask_photo=DB::insert( 'askphoto', array('user_id', 'asker_id') )
                            ->values( array($userid, $current_user_id) )
                            ->execute();
        if($user_dtl->photo_alert == 1)
        {
                  $send_email = Email::factory( $asker_name.' asked for your Photo')
                    //->message('Hi '.$user_dtl[0]['first_name'].' please upload your profile pic ' .$membername[0]['first_name'].' wants to see your photo')
                    ->message(View::factory('mails/ask_photo', array('newemail1' => $user_dtl, 'newemail' =>$user))->render(), 'text/html')
                    //->to('pgoswami@maangu.com')
                    ->to($user->email)
                    ->from('noreply@callitme.com', 'Callitme')
                    ->send();

               
        }

        $target_id=0;
         $this->activity = new Model_Activity;
         $this->activity->new_activity('ask_user_photo', 'wants to see your profile picture', $target_id, $userid ,Auth::instance()->get_user()->id);
         $this->request->redirect(url::base().$username);   

} 

    public function action_search_results()
    {
       // $this->auto_render = false;
        $data = array();    
        if ($this->request->post('first_name')) 
        {
            if ($this->request->post('first_name') == '') 
            {
                echo '';
            } 
            else 
            {
                $query_string = $this->request->post('first_name');
                $substring = strstr($query_string, ' ');
                if ($substring) 
                {
                    $query_array = explode(' ', $query_string);
                    if ($query_array) 
                    {
                        $user = ORM::factory('user')->with('user_detail')
                                ->where_open()
                                ->where('first_name', 'like', '%' .$query_array[0] . '%')
                                ->and_where('last_name', 'like', '%'. $query_array[1] . '%')
                                ->where_close()
                                ->and_where('is_deleted', '=', 0)
                                ->and_where('is_blocked','=',0)
                                ->limit(10)
                                ->find_all()
                                ->as_array();
                    }
                } 
                else 
                {
                    $user = ORM::factory('user')->with('user_detail')
                    ->where_open() 
                    ->where('first_name', 'like', '%'. $this->request->post('first_name') . '%')  
                    ->or_where('last_name', 'like', '%'. $this->request->post('first_name') . '%') 
                     
                    ->where_close()
                    ->and_where('is_deleted', '=', 0)
                    ->and_where('is_blocked', '=' , 0)  
                    ->limit(10)
                    ->find_all()
                    ->as_array();                                  
                }
                   $data['search_for'] =  $this->request->post('first_name')." ".$this->request->post('last_name');            
                   $data['search_user']=$user; 
                   //$this->template->title = '';
                   $this->template->header = View::factory('templates/members-header');
                   $this->template->content = View::factory('staticpages/searh_results', $data);
                   $this->template->sidemenu = View::factory('templates/sidemenu', array('side_menu' => ''));                  
            }
        }
        else
        {
            $this->request->redirect(url::base().'import');   
        }
                        
    }
    public function action_search_member()
    {   
           
       $this->template->header  = View::factory('templates/members-header');
       $this->template->content = View::factory('members/search_member');
        
    }
    public function action_navigation()
    {
         $user = Auth::instance()->get_user();
         $data['user']   = $user;
         $this->template->content = View::factory('members/navigation', $data);
    }
    public function action_commentpost()
    {
        $id     = $this->request->param('id');
        $member = Auth::instance()->get_user();
        $posts  = ORM::factory('post')
                ->where('id', '=', $id)
                ->and_where('is_deleted', '=', 0)
                ->find_all()
                ->as_array();
            $data['posts']  = $posts;
            $data['member'] = $member;
        $this->template->content=View::factory('members/comment',$data);

    }
 
    public function action_inspire() {
        $this->auto_render = false;
        
        $response = array(
            'status' => 'error',
            'message' => 'Invalid Parameter'
        );

        if($this->request->post('user_id')) {
            $user_id = $this->request->post('user_id');
            $user = ORM::factory('user', $user_id);
            $sess_user = Auth::instance()->get_user();
            
            $inspire = ORM::factory('inspire')
                ->where('user_id', '=', $user_id)
                ->where('user_by', '=', $sess_user->id)
                ->find();

            if(empty($inspire->id)) {
                $inspire = ORM::factory('inspire');
                $inspire->user_id = $user_id;
                $inspire->user_by = $sess_user->id;
                $inspire->time = date("Y-m-d H:i:s");
                $inspire->status = 1;
                $inspire->save();
            } else {
                $inspire->status = $inspire->status ? 0 : 1;
                $inspire->save();
            }

            $this->post = new Model_Post;
            if($inspire->status) {
                $post = $this->post->new_post('inspired', "", " is inspired by @".$user->username ." .");
            } else {
                $post = $this->post->new_post('inspired', "", " is not inspired by @".$user->username ." anymore.");
            }

            $response = array(
                'status' => 'success',
                'message' => ($inspire->status) ? 'Inspired' : 'Not Inspired',
                'msg_code' => $inspire->status
            );
        }
        
        if(!$this->request->is_ajax()) {
            $url = $this->request->referrer() ? $this->request->referrer() : url::base();
            $this->request->redirect($url);
        }
        
        $inspire_count = ORM::factory('inspire')
            ->where('user_id', '=', $user_id)
            ->where('status', '=', 1)
            ->count_all();
            
        $response['count'] = $inspire_count;
        echo json_encode($response);
    }

    public function action_firebaseSignIn() {
        $this->auto_render = false;

        if($this->request->post('uuid')) {
            $uuid = $this->request->post('uuid');
            $user = Auth::instance()->get_user();
            $user->firebase_uuid = $uuid;
            $user->save();

            echo "success";
            return true;
        }

        echo "false";
        return true;
    }
}
