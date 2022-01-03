<?php defined('SYSPATH') or die('No direct script access.');

//controller contains all the that does not require login
class Controller_Accessapi extends Controller_Template
{

    public $template = 'templates/accessapi'; //template file

    public $database_legace = "lu0NxpqvUrL1R045jU6XS9s6jXjLlRzK2bYfsJr9";

    public function before() {
        parent::before();

        header('Content-Type: application/json');
        header("Access-Control-Allow-Origin: *");
        $headers = apache_request_headers();

        if(isset($headers['Authorization'])) {
            $token  = ORM::factory('user_token')
                ->where('token', '=', $headers['Authorization'])
                ->where('expires','>',time())
                ->find();

            if($token->id) {
                $username = $token->user->email;
                Auth::instance()->force_login($username);
                Session::instance()->set('token', $token->token);
            } else {
                echo json_encode(array('stauts' => false, 'code' => 500, 'message' => 'Invalid token'));
                exit;
            }
        }
        require_once Kohana::find_file('classes', 'libs/firebase/firebaseLib');
    }

    public function action_index() {
        echo "<h1 align='center' style='margin-top:15%'>Api Section! Please stay out of here</h1>";
    }

    public function action_login() {
        $error = true; $msg = '';

        if($this->request->post()) {
            $validation = Validation::factory($this->request->post());
            $validation->rule('email', 'not_empty')
                ->rule('password', 'not_empty');

            if($validation->check()) {
                $post_data  = $this->request->post();
                $email      = $post_data['email'];
                $password   = $post_data['password'];
                $fcm_token   = $post_data['device_token'];

                if (Auth::instance()->login($email, $password, false)) {
                    $user   = Auth::instance()->get_user();
                    $account_expires = date("Y-m-d",
                        mktime(23, 59, 59, date("m", strtotime($user->registration_date)),
                            date("d", strtotime($user->registration_date))+3,
                            date("Y", strtotime($user->registration_date))
                        )
                    );
                    if($user->not_registered) {
                        $msg = 'The email address or password you entered does not match our records, checking.';
                    }
                    else if($user->is_blocked) {
                        $msg = 'Your account has been blocked. Please contact our support team'; //error message to show
                    }
                    else if (!$user->is_active && $account_expires < date("Y-m-d")) { // user is not activated
                        $msg = 'Your account has been suspended because you have not activated your account yet. Please activate your account <a href="'.url::base().'pages/resend_link"> Resend Activation Mail </a>.';
                    }
                    else {
                        $token  = ORM::factory('user_token');
                        $token->user_id = $user->id;
                        $token->expires = time() + 20000000000;
                        $token->type    = 'Login API';
                        $token->save();

                        $user->last_login = date('Y-m-d H:i:s');

                        $headers = array(
                            "Content-Type: application/json");

                        $url = "https://callitme-messaging.firebaseio.com/users/".$user->firebase_uuid.".json?auth=".$this->database_legace;

                        $body_post = array(
                            "name"=>$user->user_detail->first_name." ".$user->user_detail->last_name,
                            "username"=>$user->username,
                            "profile_img"=>!empty($user->photo->profile_pic) ? $user->photo->profile_pic : ""
                        );

                        $result_firebase  =  json_decode($this->curl_request($url,json_encode($body_post),$headers,'PUT'));

                        $headers = array(
                                "Authorization:  key=AAAA51iqDKw:APA91bHlOXpORpPJNxkoEfjY6sCzDq2wOQCueDGC2N3e6OSu8Klpu2joZg3Nvm4jC2GCK9DxPq-b_snW31Z-_zLAi3QIhhplRba3YDadfW4zezDquL0wO4ZVpRvyL8Lm4gtsV2AXx-pa",
                                "Content-Type: application/json",
                                "project_id: 993624984748",
                            );
                            if(empty($user->fcm_group_token)){
                                $body = array(
                                    "operation"=>"create",
                                    "notification_key_name"=>$user->username."_".$user->id,
                                    "registration_ids"=>array($post_data["device_token"])
                                );
                            }else{
                                $body = array(
                                    "operation"=>"add",
                                    "notification_key_name"=>$user->username."_".$user->id,
                                    "notification_key"=>$user->fcm_group_token,
                                    "registration_ids"=>array($post_data["device_token"])
                                );
                            }

                            $result  =  json_decode($this->curl_request("https://fcm.googleapis.com/fcm/notification",json_encode($body),$headers,'post'));
                            if(empty($result->error)){
                                $user->fcm_group_token = $result->notification_key;
                            }

                            //$firebase_tokens  = ORM::factory('fcmtoken');
                            //$firebase_tokens->user_id = $user->id;
                            //$firebase_tokens->device_type = $post_data["device_type"];
                            //$firebase_tokens->firebase_token = $post_data["device_token"];
                            //$firebase_tokens->save();


                        if($user->is_deleted) {
                            $user->is_deleted = 0;
                            $user->delete_expires = null;
                            $user->save();
                        }

                        $logged_user = ORM::factory('logged_user');
                        $logged_user->user_id = $user->id;
                        $logged_user->ip = Request::$client_ip;
                        $logged_user->user_agent = Request::$user_agent;
                        $logged_user->login_time = date('Y-m-d H:i:s');
                        $logged_user->save();


                        $default_path = Kohana::$config->load('settings')->get('firebase')['databaseURL'];
                        $firebase = new \Firebase\FirebaseLib($default_path);




                        $user->ip = Request::$client_ip;
                        $api_key = Kohana::$config->load('contact')->get('ip_api');

                        $url = "http://api.ipinfodb.com/v3/ip-city/?key=$api_key&ip=$user->ip&format=json";
                        $ch  = curl_init();

                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                        $data = curl_exec($ch);
                        curl_close($ch);

                        if ($data) {
                            $location = json_decode($data);

                            $lat = ($location) ? $location->latitude : 0;
                            $lon = ($location) ? $location->longitude : 0;

                            $user->latitute = $lat;
                            $user->longitude = $lon;
                        }

                        $user->save();

                        if(!$user->plan->id) {
                            $user_plan = ORM::factory('user_plan');
                            $user_plan->user_id = $user->id;
                            $user_plan->name = 'free';
                            $user_plan->plan_expires = date("Y-m-d H:i:s", mktime(23, 59, 59, date("m")+1  , date("d")-1, date("Y")));
                            $user_plan->r_to_friend = 20;
                            $user_plan->save();
                        }

                        $user->check_plan_validity();

                        $photo = $user->photo->profile_pic;
                        $photo_image_mob = file_exists("mobile/upload/".$photo);
                        $photo_image = file_exists("upload/".$photo);

                        $userInfo = array_merge(
                            $this->get_user_detail($user),
                            array (
                                'email'         => $user->email,
                                'fb_pass'       => $user->firebase_password,
                                'device_token'  => $user->device_token,
                                'token'         => $token->token
                            )
                        );

                        $list = array();
                        $friends = $user->friends->find_all()->as_array();
                        foreach($friends as $friend) {
                            $list[] = $this->get_user_detail($friend);
                        }
                        $userInfo['friends'] = $list;

                        $error = false;
                        //$response = array('status' => 'success', 'token' => $token->token, 'user' => $userInfo, 'friends' => $list);
                        $response = array('status' => true, 'code' => 200, 'message' => 'You are logged in successfully.', 'data' => $userInfo);

                    }

                    if(!empty($msg)) {
                        $user->logins = new Database_Expression('logins - 1');
                        $user->save();
                        Auth::instance()->logout(); //logout
                    }
                }
                else {
                    $msg = 'The email address or password you entered does not match our records.';
                }
            } else {
                $invalids = array();
                foreach($validation->errors() as $field => $error) {
                    $invalids[] = $field;
                }

                $msg = "Please fill all the required fields.";
                $invalids = implode(', ', $invalids);
            }
        } else {
            $msg = "Method not allowed";
        }

        if($error) {
            if(isset($user)) {
                $user->logins = new Database_Expression('logins - 1');
                $user->save();
                Auth::instance()->logout(); //logout
            }

            $response = array('status' => false, 'code' => 500, 'message' => $msg);
        }

        echo json_encode($response);
    }

    public function action_search_user() {
        if(!Auth::instance()->logged_in()) {
            die("Invalid Request");
        }

        $error = true; $msg = '';
        $user = Auth::instance()->get_user();
        if($this->request->post())
        {
            $post_data = $this->request->post();
            $validation = Validation::factory($this->request->post());
            $validation->rule('name', 'not_empty')
                ->rule('full_info', 'not_empty');
            if($validation->check())
            {
                if ($post_data['full_info'] == 0)
                {
                    $name    = $post_data['name'];
                    $words   = explode(' ', $name);

                    $users =  ORM::factory('user')->with('user_detail')
                        ->where_open()
                        ->where('first_name','like', '%'. $words[0].'%')
                        ->or_where('last_name', 'like', '%'.$post_data['name'].'%')
                        ->where_close()
                        ->where('user.is_blocked','=',0)
                        ->where('profile_public', '=', '0')
                        ->where('not_registered', '=', 0)
                        ->find_all();

                    $list = array();
                    if(!empty($users)) {
                        foreach($users as $user) {
                            $u      = $this->get_user_detail($user);
                            $u['list_attributes'] = implode(', ', $user->user_detail->list_attributes());
                            $list[] = $u;
                        }
                        $response       = array('status' => true, 'code' => 200, 'message' => 'Data Found', 'data' => $list);
                        $error          = false;
                    }
                    else {
                        $msg = "Data Not Found";
                    }
                }
                else
                {
                    $query_string = $this->request->post('name');
                    $substring = strstr($query_string, ' ');
                    if ($substring) 
                    {
                        $query_array = explode(' ', $query_string);
                        if ($query_array) 
                        {
                            $users = ORM::factory('user')->with('user_detail')
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
                        $users = ORM::factory('user')->with('user_detail')
                        ->where_open() 
                        ->where('first_name', 'like', '%'. $this->request->post('name') . '%')  
                        ->or_where('last_name', 'like', '%'. $this->request->post('name') . '%') 
                         
                        ->where_close()
                        ->and_where('is_deleted', '=', 0)
                        ->and_where('is_blocked', '=' , 0)  
                        ->limit(10)
                        ->find_all()
                        ->as_array();                                  
                    }

                    $search_result = array();
                    if(!empty($users))
                    {
                        foreach ($users as $user) {
                            $details    = $this->get_user_detail($user);

                            $details['employment']  = $user->user_detail->employment;
                            $details['designation'] = $user->user_detail->designation;
                            $details['website'] = $user->user_detail->website;

                            $recommendations = $user->recommendations->where('state', '=', 'approve')->order_by('time', 'desc')->find_all();
                            $tag_words = array();
                            foreach($recommendations as $recommend) {
                                $words = explode(', ', $recommend->words);
                                $tag_words = array_merge($tag_words, $words);
                            }
                            $tags = array_count_values($tag_words);

                            //$details['tags'] = $tags;
                            $details['social'] = $user->calculate_social_percentage($tags);
                            $details['counts'] = array(
                                'friends' => $user->friends->count_all(),
                                //'reviews' => $user->recommendations->where('state', '=', 'approve')->count_all()
                            );

                            if($user->id !== Auth::instance()->get_user()->id) {
                                $mutual_count = count($user->mutual_friends(Auth::instance()->get_user()));
                                $details['counts']['mutual'] = "$mutual_count";
                            }

                            $posts_count = $posts_data = DB::select('id','user_id','type','gradient_bg','action','post','photo')
                                ->from('posts')
                                ->where('user_id','=',$user->id)
                                ->where('type','=','post')
                                ->where('is_deleted','=','0')
                                ->order_by('id', 'desc')
                                ->execute()
                                ->as_array();
                            $post_count = count($posts_count);
                            $details['counts']['post'] = "$post_count";

                            $inspires_count = $inspires_data = DB::select('inspires.id','user_id','user_by','users.email','users.username','user_details.first_name','user_details.last_name','user_details.phase_of_life','user_details.designation','photos.profile_pic_o','photos.profile_pic')
                               ->from('inspires')
                               ->join('users','RIGHT')
                               ->on('users.id','=','inspires.user_id')
                               ->join('photos','LEFT')
                               ->on('photos.id','=','users.photo_id')
                               ->join('user_details','LEFT')
                               ->on('users.user_detail_id','=','user_details.id')
                               ->where('user_by','=',$user->id)
                               ->where('status','=','1')
                               ->order_by('id', 'desc')
                               ->execute()
                               ->as_array();
                            $inspire_count = count($inspires_count);
                            $details['counts']['inspires'] = "$inspire_count";

                            $inspires_count = ORM::factory('inspire')
                            ->where('user_id', '=', $user->id)
                            ->where('status', '=', 1)
                            ->count_all();
                            $details['counts']['inspired'] = $inspires_count;

                            $details['posts_data'] = $posts_data;

                            $inspires = array();
                            if(!empty($inspires_data)) {
                                foreach($inspires_data as $inspire) {
                                    $inspires[] = array(
                                        'id' => $inspire['id'],
                                        'user_id' => $inspire['user_id'],
                                        'user_by' => $inspire['user_by'],
                                        'username' => $inspire['username'],
                                        'first_name' => $inspire['first_name'],
                                        'last_name' => $inspire['last_name'],
                                        'profile_pic_o' => url::base().'mobile/upload/'.$inspire['profile_pic_o'],
                                        'profile_pic' => url::base().'mobile/upload/'.$inspire['profile_pic'],
                                    );
                                }
                            }
                            $details['inspires_data'] = $inspires;

                            $reviewsInfo = array(
                                'review_count' => $user->recommendations->where('state', '=', 'approve')->count_all(),
                                'tags' => $tags
                            );
                            $details['reviews_data'] = $reviewsInfo;

                            $aboutInfo = array(
                                'about' => $user->user_detail->about,
                                'education' => $user->user_detail->education,
                                'website' => $user->user_detail->website,
                                'home_town' => $user->user_detail->home_town,
                                'location' => $user->user_detail->location,
                                'designation' => $user->user_detail->designation,
                                'employment' => $user->user_detail->employment
                            );
                            $details['about_data'] = $aboutInfo;

                            $search_result[] = $details;
                        }
                        $response   = array('status' => true, 'code' => 200, 'message' => 'Data Found', 'search_for' => $post_data['name'], 'search_count' => count($search_result), 'data' => $search_result);
                        $error      = false;
                    }
                    else {
                        $msg = "Data Not Found";
                    }
                }
            }
            else 
            {
                $msg = "Please fill all the feilds";
            }
            
        } else {
            $msg = "Method not allowed";
        }

        if($error) {
            $response = array('status' => false, 'code' => 500, 'message' => $msg);
        }

        echo json_encode($response);
    }

    public function action_profile() {
        if(!Auth::instance()->logged_in()) {
            die("Invalid Request");
        }

        $user = Auth::instance()->get_user();

        $error = true; $msg = '';
        $username = $this->request->query('username');
        if(!empty($username)) {
            $user = ORM::factory('user', array('username' => $username));
            if($user->id == NULL || $user->profile_public) {
                $msg = 'Invalid Username';
            }
            if($user->is_deleted) {
                $msg = 'User is deleted';
            }
        }

        if(empty($msg)) {
            $details    = $this->get_user_detail($user);

            $details['employment']  = $user->user_detail->employment;
            $details['designation'] = $user->user_detail->designation;
            $details['website'] = $user->user_detail->website;

            $recommendations = $user->recommendations->where('state', '=', 'approve')->order_by('time', 'desc')->find_all();
            $tag_words = array();
            foreach($recommendations as $recommend) {
                $words = explode(', ', $recommend->words);
                $tag_words = array_merge($tag_words, $words);
            }
            $tags = array_count_values($tag_words);

            //$details['tags'] = $tags;
            $details['social'] = $user->calculate_social_percentage($tags);
            $details['counts'] = array(
                'friends' => $user->friends->count_all(),
                //'reviews' => $user->recommendations->where('state', '=', 'approve')->count_all()
            );

            if($user->id !== Auth::instance()->get_user()->id) {
                $mutual_count = count($user->mutual_friends(Auth::instance()->get_user()));
                $details['counts']['mutual'] = "$mutual_count";
            }

            $posts_count = $posts_data = DB::select('id','user_id','type','gradient_bg','action','post','photo')
                ->from('posts')
                ->where('user_id','=',$user->id)
                ->where('type','=','post')
                ->where('is_deleted','=','0')
                ->order_by('id', 'desc')
                ->execute()
                ->as_array();
            $post_count = count($posts_count);
            $details['counts']['post'] = "$post_count";

            $inspires_count = $inspires_data = DB::select('inspires.id','user_id','user_by','users.email','users.username','user_details.first_name','user_details.last_name','user_details.phase_of_life','user_details.designation','photos.profile_pic_o','photos.profile_pic')
               ->from('inspires')
               ->join('users','RIGHT')
               ->on('users.id','=','inspires.user_id')
               ->join('photos','LEFT')
               ->on('photos.id','=','users.photo_id')
               ->join('user_details','LEFT')
               ->on('users.user_detail_id','=','user_details.id')
               ->where('user_by','=',$user->id)
               ->where('status','=','1')
               ->order_by('id', 'desc')
               ->execute()
               ->as_array();
            $inspire_count = count($inspires_count);
            $details['counts']['inspires'] = "$inspire_count";

            $inspires_count = ORM::factory('inspire')
            ->where('user_id', '=', $user->id)
            ->where('status', '=', 1)
            ->count_all();
            $details['counts']['inspired'] = $inspires_count;

            $details['posts_data'] = $posts_data;

            $inspires = array();
            if(!empty($inspires_data)) {
                foreach($inspires_data as $inspire) {
                    $inspires[] = array(
                        'id' => $inspire['id'],
                        'user_id' => $inspire['user_id'],
                        'user_by' => $inspire['user_by'],
                        'username' => $inspire['username'],
                        'first_name' => $inspire['first_name'],
                        'last_name' => $inspire['last_name'],
                        'profile_pic_o' => url::base().'mobile/upload/'.$inspire['profile_pic_o'],
                        'profile_pic' => url::base().'mobile/upload/'.$inspire['profile_pic'],
                    );
                }
            }
            $details['inspires_data'] = $inspires;

            $reviewsInfo = array(
                'review_count' => $user->recommendations->where('state', '=', 'approve')->count_all(),
                'tags' => $tags
            );
            $details['reviews_data'] = $reviewsInfo;

            $aboutInfo = array(
                'about' => $user->user_detail->about,
                'education' => $user->user_detail->education,
                'website' => $user->user_detail->website,
                'home_town' => $user->user_detail->home_town,
                'location' => $user->user_detail->location,
                'designation' => $user->user_detail->designation,
                'employment' => $user->user_detail->employment
            );
            $details['about_data'] = $aboutInfo;

            $response   = array('status' => true, 'code' => 200, 'message' => 'Your profile has been updated successfully.', 'data' => $details);
            $error      = false;
        }

        if($error) {
            $response = array('status' => false, 'code' => 500, 'message' => $msg);
        }

        echo json_encode($response);
    }

    public function action_inspire() {
        if(!Auth::instance()->logged_in()) {
            die("Invalid Request");
        }

        $error  = true; $msg = '';
        if($this->request->post()) {
            $user_id = $this->request->post('user_id');
            $user = ORM::factory('user', $user_id);
            $sess_user = Auth::instance()->get_user();
            if($user->id)
            {
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
                    $inspire->time = date("Y-m-d H:i:s");
                    $inspire->save();
                }

                if($inspire->status) {
                    //$post = $this->post->new_post('inspired', "", " is inspired by @".$user->username ." .");
                    $post = $this->new_post_with_image('inspired', array('photo' => url::base().'mobile/upload/'.$user->photo->profile_pic_o), " is inspired by @".$user->username ." .");
                } else {
                    $post = $this->new_post_with_image('inspired', array('photo' => url::base().'mobile/upload/'.$user->photo->profile_pic_o), " is not inspired by @".$user->username ." anymore.");
                }

                $response = array(
                    'status' => true,
                    'code' => 200,
                    'message' => ($inspire->status) ? 'Inspired' : 'Not Inspired',
                    'data' => array('msg_code' => $inspire->status)
                );
                
                $inspire_count = ORM::factory('inspire')
                    ->where('user_id', '=', $user_id)
                    ->where('status', '=', 1)
                    ->count_all();
                    
                $response['data']['count'] = $inspire_count;
                $error = false;
            }
            else {
                $msg = "Invalid userId";
            }
        }
        else {
            $msg = "Method not allowed";
        }
        if($error) {
            $response = array('status' => false, 'code' => 500, 'message' => $msg);
        }
        echo json_encode($response);
    }

    public function new_post_with_image($type, $content, $action = '', $another_user = null) {
        $post = ORM::factory('post');
        
        if(empty($another_user)) {
            $user = Auth::instance()->get_user();
        } else {
            $user = ORM::factory('user', $another_user);
        }

        $postImage = $content['photo'];

        if(isset($content['text']) && $content['text'] != ''){
            $content = strip_tags($content['text']);
            if($type == 'post') {
                $content = Text::parse_text($content);
            } else {
                $content = Text::parse_text($content, false);
            }
        }else{
            $content = '';
        }
        
        $pattern = "/(@)([^\s]*)/i";
        $replace='Model_Post::format_username';
        $content =  preg_replace_callback($pattern,$replace, $content);
        $action =  preg_replace_callback($pattern,$replace, $action);

        $post->user_id = $user->id;
        $post->type = $type;
        $post->post = $content;
        $post->photo = $postImage;
        $post->action = $action;
        $post->time = date("Y-m-d H:i:s");

        $post->save();

        return $post;
    }

    public function action_friends() {
        if(!Auth::instance()->logged_in()) {
            die("Invalid Request");
        }

        $error  = true; $msg = '';
        $user = Auth::instance()->get_user();
        if($this->request->query('username')) {
            $user = ORM::factory('user', array('username' => $this->request->query('username')));
            if(!$user->id) {
                $msg = 'Invalid Username';
            }
        }

        if(empty($msg)) {
            $list = array();
            $friends = $user->friends->find_all()->as_array();
            if(!empty($friends)) {
                foreach($friends as $friend) {
                    $frnd = $this->get_user_detail($friend);
                    $frnd['list_attributes'] = implode(', ', $user->user_detail->list_attributes());
                    $list[] = $frnd;
                }

                $response       = array('status' => true, 'code' => 200, 'message' => 'Data Found', 'data' => $list);
                $error          = false;
            }
            else {
                $msg = "Data Not Found";
            }
        }
        if($error) {
            $response = array('status' => false, 'code' => 500, 'message' => $msg);
        }

        echo json_encode($response);
    }

    public function action_send_friend_request()
    {
        if(!Auth::instance()->logged_in()) {
            die("Invalid Request");
        }

        $error  = true; $msg = '';
        $user = Auth::instance()->get_user();
        if($this->request->post()) {
            $validation = Validation::factory($this->request->post());
            $validation->rule('friend_id', 'not_empty');

            if($validation->check()) {
                $invitee_id = $this->request->post('friend_id');
                $user = Auth::instance()->get_user();
                $invitee = ORM::factory('user')->where('id', '=', $invitee_id)->find();

                $user = Auth::instance()->get_user();
                $recommendations = $user->recommendations->where('state', '=', 'approve')->order_by('time', 'desc')->find_all()->as_array();

                $temp_words = array();
                foreach($recommendations as $recommend) {
                    $words = explode(', ', $recommend->words);
                    $temp_words = array_merge($temp_words, $words);
                }
                $tags = array_count_values($temp_words);

                if ( ! $user->check_friends($invitee) && ! $user->check_requests($invitee)) {
                    $user->add('requests', $invitee);

                    if($invitee->user_detail->friend_alert) {
                        //send email
                        $from = Auth::instance()->get_user();
                        $send_email = Email::factory('Friend request from '.$from->user_detail->first_name .' '.$from->user_detail->last_name)
                        ->message(View::factory('mails/friend_request_mail', array('to' => $invitee,'tag'=> $tags, 'recommendations' => $recommendations))->render(), 'text/html')
                        ->to($invitee->email)
                        ->from('noreply@callitme.com', 'Callitme')
                        ->send();
                    }

                    $error = false;
                    $response = array('status' => true, 'code' => 200, 'message' => 'Friend request send successfully.', 'data' => array());
                }
                else
                {
                    $msg = "Friend request already send.";
                }
            } 
            else {
                $msg = "Please fill all the required fields.";
            }
        } else {
            $msg = "Method not allowed";
        }

        if($error) {
            $response = array('status' => false, 'code' => 500, 'message' => $msg);
        }

        echo json_encode($response);
    }

    public function action_friend_requests() {
        if(!Auth::instance()->logged_in()) {
            die("Invalid Request");
        }

        $error  = true; $msg = '';
        $user = Auth::instance()->get_user();

        $list = array();
        $requests = ORM::factory('Request')->with('user')
            ->where('request_to', '=', $user->id)
            //->where('is_active', '=', '1')
            ->where('is_deleted', '!=', '1')
            ->order_by('date_requested', 'desc')
            ->find_all()
            ->as_array();
        if(!empty($requests)) {
            foreach($requests as $request) {
                $req = $this->get_user_detail($request->user);
                $req['list_attributes'] = implode(', ', $user->user_detail->list_attributes());
                $list[] = $req;
            }
            $response       = array('status' => true, 'code' => 200, 'message' => 'Data Found', 'data' => $list);
            $error          = false;
        }
        else {
            $msg = 'Data Not Found';
        }
        if($error) {
            $response = array('status' => false,'code' => 500, 'message' => $msg);
        }

        echo json_encode($response);
    }

    public function action_chat_list() {
        if(!Auth::instance()->logged_in()) {
            die("Invalid Request");
        }

        $error  = true; $msg = '';
        $user = Auth::instance()->get_user();
        if ($this->request->query()) {
            $chats = ORM::factory('chat')
                ->where_open()
                ->where_open()
                ->where('user_to', '=', $user->id)
                ->where('to_deleted', '=', 0)
                ->where_close()
                ->or_where_open()
                ->where('user_from', '=', $user->id)
                ->where('from_deleted', '=', 0)
                ->or_where_close()
                ->where_close()
                ->where('last_message', 'IS NOT', Null)
                ->order_by('last_message_time', 'desc')
                ->find_all()
                ->as_array();

            $list = array();
            if($chats) {
                foreach($chats as $chat) {
                    $c              = $chat->as_array();
                    $c['to']        = $this->get_user_detail($chat->to);
                    $c['from']      = $this->get_user_detail($chat->from);

                    unset($c['id']);
                    unset($c['user_to']);
                    unset($c['user_from']);
                    $list[] = $c;
                }
                $response       = array('status' => true, 'code' => 200,'message' => 'Chat data', 'data' => $list);
                $error          = false;
            }
            else {
                $msg = 'Data Not Found';
            }
        }
        else {
            $msg = "Method not allowed";
        }

        if($error) {
            $response = array('status' => false, 'code' => 500, 'message' => $msg);
        }

        echo json_encode($response);
    }

    public function action_chat_initiate() {
        if(!Auth::instance()->logged_in()) {
            die("Invalid Request");
        }

        $error  = true; $msg = '';
        $user = Auth::instance()->get_user();
        if($this->request->post()) {
            $validation = Validation::factory($this->request->post());
            $validation->rule('message', 'not_empty')
                ->rule('username', 'not_empty')
                ->rule('timestamp', 'not_empty');

            if($validation->check()) {
                $user_to = ORM::factory('user', array('username' => $this->request->post('username')));
                if($user_to->id) {
                    if(!$user_to->id || !$user->check_friends($user_to)) {

                        if($user->plan->m_to_anyone_used == $user->plan->m_to_anyone) {
                            $msg = 'Sorry, you have used all your requests, please upgrade to continue';
                        } else {
                            $user->plan->m_to_anyone_used = $user->plan->m_to_anyone_used + 1;
                            $user->plan->save();
                        }

                    }

                    if(empty($msg)) {
                        $chat = ORM::factory('chat')->create_conversation($user, $user_to);

                        $timestamp = $this->request->post('timestamp');
                        $chat->last_message = $this->request->post('message');
                        $chat->last_message_from = $user->id;
                        $chat->last_message_time = date("Y-m-d H:i:s", $timestamp);
                        $chat->to_deleted = 0;
                        $chat->from_deleted = 0;
                        $chat->save();

                        if($user_to->user_detail->msg_alert) {
                            $mail_data = array(
                                'message' => $chat->last_message,
                                'user_to' => $user_to
                            );

                            //send email
                            $from = Auth::instance()->get_user();
                            $send_email = Email::factory('Message from '.$from->user_detail->first_name .' '.$from->user_detail->last_name)
                                ->message(View::factory('mails/new_message_mail', $mail_data)->render(), 'text/html')
                                ->to($user_to->email)
                                ->from('noreply@Callitme.com', 'Callitme')
                                ->send();
                        }

                        $firebase = $this->get_firebase_conn($user);
                        $fb_data = array(
                            "from" => $user->firebase_uuid,
                            "message" => $chat->last_message,
                            "timestamp" => $timestamp
                        );
                        $firebase->push('/Chats/'.$chat->code, $fb_data);

                        $res_chat = $chat->as_array();
                        $res_chat['to'] = $this->get_user_detail($chat->to);
                        $res_chat['from'] = $this->get_user_detail($chat->from);

                        $error = false;
                        $response = array('status' => true, 'code' => 200, 'message' => '', 'data' => $res_chat);
                    }
                } else {
                    $msg = "Invalid username";
                }
            } else {
                $invalids = array();
                foreach($validation->errors() as $field => $error) {
                    $invalids[] = $field;
                }

                $msg = "Please fill all the required fields in proper format.";
                $invalids = implode(', ', $invalids);
            }
        } else {
            $msg = "Method not allowed";
        }

        if($error) {
            $response = array('status' => false, 'code' => 500, 'message' => $msg);
            if(!empty($invalids)) {
                $response['invalid_fields'] = $invalids;
            }
        }

        echo json_encode($response);
    }

    public function action_update_last_message() {
        if(!Auth::instance()->logged_in()) {
            die("Invalid Request");
        }

        $error = true; $msg = '';
        $user = Auth::instance()->get_user();
        if ($this->request->post()) {
            $validation = Validation::factory($this->request->post());

            $validation->rule('code', 'not_empty')
                ->rule('username', 'not_empty')
                ->rule('message', 'not_empty')
                ->rule('timestamp', 'not_empty');

            if($validation->check()) {
                $post_data = $this->request->post();

                //echo time();exit;
                $chat = ORM::factory('chat', array('code' => $post_data['code']));
                if($chat->id) {

                    $chat->last_message = $this->request->post('message');
                    $chat->last_message_from = ($chat->from->username == $this->request->post('username')) ? $chat->from->id : $chat->to->id;

                    //$chat->last_message_time = date("Y-m-d H:i:s", $post_data['timestamp']);
                    $chat->last_message_time = date("Y-m-d H:i:s");
                    $chat->save();

                    if(!empty($post_data["Device"]) && $post_data["Device"] == "Android"){
                        $response =  $this->action_send_push_notification_android($user,$post_data['code']);
                    }

                    $error = false;
                    $response = array('status' => true, 'code' => 200, 'message' => 'Message Updated Successfully', 'data' => array());
                } else {
                    $msg = "Invalid code";
                }
            } else {
                $invalids = array();
                foreach($validation->errors() as $field => $error) {
                    $invalids[] = $field;
                }

                $msg = "Please fill all the required fields.";
                $invalids = implode(', ', $invalids);
            }

        } else {
            $msg = "Method not allowed";
        }

        if($error) {
            $response = array('status' => false, 'code' => 500, 'message' => $msg);
        }

        echo json_encode($response);
    }

    public function action_update_last_message_new() {
        if(!Auth::instance()->logged_in()) {
            die("Invalid Request");
        }
        $error = true; $msg = '';
        $user = Auth::instance()->get_user();
        if ($this->request->post()) {
            $validation = Validation::factory($this->request->post());

            $validation->rule('code', 'not_empty')
                ->rule('username', 'not_empty')
                ->rule('message', 'not_empty')
                ->rule('timestamp', 'not_empty');

            if($validation->check()) {

                $post_data = $this->request->post();
                $chat = ORM::factory('user_chat');
                $chat->message = $this->request->post('message');
                $chat->fb_from_id = $user->firebase_uuid;
                $second_user = ORM::factory('user', array('username' => $post_data['second_name']));

                $chat->fb_to_id = $second_user->firebase_uuid;
                $chat->sending_timestamp = $this->request->post('timestamp');
                $chat->code = $this->request->post('code');
                $chat->user_id = $user->id;
                $chat->save();

                $response =  $this->action_send_push_notification_android($user,$post_data['code']);

                $error = false;
                $response = array('status' => true, 'code' => 200, 'message' => 'Message Updated Successfully', 'data' => array());

            }
            else {
                $invalids = array();

                $msg = "Please fill all the required fields.";
                $invalids = implode(', ', $invalids);
            }
        }
        else {
            $msg = "Method not allowed";
        }
        if($error) {
            $response = array('status' => false, 'code' => 500, 'message' => $msg);
        }
        echo json_encode($response);
    }

    public function action_update_fcm_token() {

        if(!Auth::instance()->logged_in()) {
            die("Invalid Request");
        }

        $error = true; $msg = '';
        $user = Auth::instance()->get_user();
        if ($this->request->post()) {
            $validation = Validation::factory($this->request->post());
            $validation->rule('fcm_token', 'not_empty');

            if($validation->check()) {
                $user->fcm_token = $this->request->post('fcm_token');
                $user->save();

                $error = false;
                $response = array('status' => true, 'code' => 200, 'message' => 'Token Updated Successfully', 'data' => array());
            } else {
                $invalids = array();
                foreach($validation->errors() as $field => $error) {
                    $invalids[] = $field;
                }

                $msg = "Please fill all the required fields.";
                $invalids = implode(', ', $invalids);
            }

        } else {
            $msg = "Method not allowed";
        }

        if($error) {
            $response = array('status' => false, 'code' => 500, 'message' => $msg);
        }

        echo json_encode($response);
    }

    public function action_update_device_token() {
        if(!Auth::instance()->logged_in()) {
            die("Invalid Request");
        }

        $error = true; $msg = '';
        $user = Auth::instance()->get_user();
        if ($this->request->post()) {

            $validation = Validation::factory($this->request->post());

            $validation->rule('device_token', 'not_empty');

            //if($validation->check()) {
            $post_data = $this->request->post();

            $user->device_token = $this->request->post('device_token');

            $user->save();


            $error = false;
            $response = array('status' => true, 'code' => 200, 'message' => 'Token Updated Successfully', 'data' => array());

            // }else {
            //     $invalids = array();
            //     foreach($validation->errors() as $field => $error) {
            //         $invalids[] = $field;
            //     }

            //     $msg = "Please fill all the required fields.";
            //     $invalids = implode(', ', $invalids);
            // }

        } else {
            $msg = "Method not allowed";
        }
        if($error) {
            $response = array('status' => false, 'code' => 500, 'message' => $msg);
        }
        echo json_encode($response);
    }

    public function action_send_push_notification() {
        if(!Auth::instance()->logged_in()) {
            die("Invalid Request");
        }

        $error = true; $msg = '';
        //$user = Auth::instance()->get_user();
        if ($this->request->post()) {
            $post_data = $this->request->post();

            $second_user = ORM::factory('user', array('username' => $post_data['username']));

            $playerId = [];

            if($second_user->device_token != ''){
                $playerId[] = $second_user->device_token;
            }

            $response = $this->SendNotification($playerId , array(
                "en" => $post_data['message']
            ));

            $error = false;
            $response = array('status' => true, 'code' => 200, 'message' => 'Notification sent successfully', 'data' => array());
        } else {
            $msg = "Method not allowed";
        }

        if($error) {
            $response = array('status' => false, 'code' => 500, 'message' => $msg);
        }

        echo json_encode($response);
    }

    public function action_send_push_notification_android($firstuser,$code) {
        if(!Auth::instance()->logged_in()) {
            die("Invalid Request");
        }

        $error = true; $msg = '';
        //$user = Auth::instance()->get_user();
        if ($this->request->post()) {
            $post_data = $this->request->post();
            $second_user = ORM::factory('user', array('username' => $post_data['second_name']));
            $data = array(
                "to"=>$second_user->fcm_group_token,
                "data"=>(object)array(
                    "priority"=>"high",
                    "sound"=>"app_sound.wav",
                    "content_available"=>true,
                    "bodyText"=>(object)array(
                        "username"=>$firstuser->username,
                        "second_username"=>$second_user->username,
                        "name"=>$firstuser->user_detail->first_name." ".$firstuser->user_detail->last_name,
                        "message"=>$post_data["message"],
                        "firebase_uuid"=>$firstuser->firebase_uuid,
                        "code"=>$code,
                        "photo_url"=>$firstuser->photo->profile_pic,
                    ),
                )
            );

            $key = Kohana::$config->load('settings')->get('firebase')['apiKey'];
            $headers = array(
                "Content-Type : application/json",
                "Authorization : key=AAAA51iqDKw:APA91bHlOXpORpPJNxkoEfjY6sCzDq2wOQCueDGC2N3e6OSu8Klpu2joZg3Nvm4jC2GCK9DxPq-b_snW31Z-_zLAi3QIhhplRba3YDadfW4zezDquL0wO4ZVpRvyL8Lm4gtsV2AXx-pa",
            );
            return   $this->curl_request("https://fcm.googleapis.com/fcm/send",json_encode((object)$data),$headers,'POST');

        } else {
            return  "Method not allowed";
        }
    }

    public function SendNotification($field , $message) {
        $content = $message;

        $fields = [];
        $fields['app_id'] = "f6d9c285-c3b2-4ca4-9d59-7eecb3bdac31" ;
        $fields['contents'] = $content ;
        $fields['data'] = array("title" => "MeChat") ;
        $fields['include_player_ids'] = $field ;



        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
            'Authorization: Basic OTZmZDUzZmYtYTU0MS00MmJlLTg4YjAtMTY2Y2EzNGNmMDMz'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function SendNotificationFirebase($field , $message) {
        $content = $message;

        $fields = [];
        $fields['app_id'] = "f6d9c285-c3b2-4ca4-9d59-7eecb3bdac31" ;
        $fields['contents'] = $content ;
        $fields['data'] = array("title" => "MeChat") ;
        $fields['include_player_ids'] = $field ;



        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
            'Authorization: Basic OTZmZDUzZmYtYTU0MS00MmJlLTg4YjAtMTY2Y2EzNGNmMDMz'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    private function get_user_detail($user) {
        $detail = array();

        $detail['username']     = $user->username;
        $detail['gender']       = $user->user_detail->sex;
        $detail['first_name']   = $user->user_detail->first_name;
        $detail['last_name']    = $user->user_detail->last_name;
        $detail['name']         = ($user->is_blocked == 0 && $user->is_deleted == 0) ? $user->user_detail->get_name() : "Callitme User";

        $detail['fb_uid']       = $user->firebase_uuid;
        $detail['fcm_token']    = $user->fcm_token;

        $loc_array = explode(',', $user->user_detail->location);
        $location = array();
        if(!empty($loc_array[0])) {
            $location[] = trim($loc_array[0]);
        }
        if(!empty($loc_array[2])) {
            $location[] = trim($loc_array[2]);
        }
        $detail['location']     = implode(', ', $location);

        $phase_of_life = '';
        if(!empty($user->user_detail->phase_of_life)) {
            $phases = Kohana::$config->load('profile')->get('phase_of_life');
            $phase_of_life = $phases[$user->user_detail->phase_of_life];
        }
        $detail['phase_of_life']     = $phase_of_life;

        $photo = $user->photo->profile_pic;
        $photo_image_mob = file_exists("mobile/upload/" . $photo);
        $photo_image = file_exists("upload/" .$photo);

        if($user->is_blocked == 0 && $user->is_deleted == 0 ) {
            if(!empty($photo) && $photo_image_mob) {
                $detail['profile_pic_o']        = url::base().'mobile/upload/'.$user->photo->profile_pic_o;
                $detail['profile_pic']          = url::base().'mobile/upload/'.$user->photo->profile_pic;
                $detail['profile_pic_mini']     = url::base().'mobile/upload/'.$user->photo->profile_pic_m;
                $detail['profile_pic_small']    = url::base().'mobile/upload/'.$user->photo->profile_pic_s;
            } else if(!empty($photo) && $photo_image) {
                $detail['profile_pic_o']        = url::base().'upload/'.$user->photo->profile_pic_o;
                $detail['profile_pic']          = url::base().'upload/'.$user->photo->profile_pic;
                $detail['profile_pic_mini']     = url::base().'upload/'.$user->photo->profile_pic_m;
                $detail['profile_pic_small']    = url::base().'upload/'.$user->photo->profile_pic_s;
            } else {
                $detail['profile_pic_o']        = null;
                $detail['profile_pic']          = null;
                $detail['profile_pic_mini']     = null;
                $detail['profile_pic_small']    = null;
                $detail['no_profile_pic']       = $user->user_detail->get_no_image_name();
            }
        } else {
            $detail['profile_pic_o']            = null;
            $detail['profile_pic']              = null;
            $detail['profile_pic_mini']         = null;
            $detail['profile_pic_small']        = null;
            $detail['no_profile_pic']           = 'CU';
        }

        return $detail;
    }

    public function action_user_chat() {
        if($this->request->post()) {
            if(!Auth::instance()->logged_in()) {
                die("Invalid Request");
            }
            $chatting = ORM::factory('user_chat')
                ->where_open()
                ->where_open()
                ->where('fb_from_id', '=', $this->request->post("from_id"))
                ->where('fb_to_id', '=', $this->request->post("to_id"))
                ->where_close()
                ->or_where_open()
                ->where('fb_from_id', '=', $this->request->post("to_id"))
                ->where('fb_to_id', '=', $this->request->post("from_id"))
                ->or_where_close()
                ->where_close()->find_all()->as_array();

            $final_response = array();
            if(!empty($chatting)) {
                foreach ($chatting as $chat){
                    array_push($final_response,array(
                        "message"=>$chat->message,
                        "fb_from_id"=>$chat->fb_from_id,
                        "fb_to_id"=>$chat->fb_to_id,
                        "timestamp"=>$chat->sending_timestamp,
                        "code"=>$chat->code
                    ));
                }
                $response = array('status' => true, 'code' => 200, 'message' => 'User Chat Data', 'data' => $final_response);
            }
            else {
                $response = array('status' => false, 'code' => 500, 'message' => "Data Not Found");
            }

        } else {
            $response = array('status' => false, 'code' => 500, 'message' => "Invilid Method");
        }
        echo json_encode($response);
    }

    public function action_signup()
    {
        $data = array();
        if ($this->request->post()) // if post request, save user details
        {
            $post_data = $this->request->post();

            $validation = Validation::factory($this->request->post());
            $validation->rule('first_name', 'not_empty')
                ->rule('first_name', 'regex', array(':value', '/^[a-zA-Z_.]++$/'))
                ->rule('last_name', 'not_empty')
                ->rule('last_name', 'regex', array(':value', '/^[a-zA-Z_.]++$/'))
                ->rule('last_name','max_length', array(':value', '20'))
                ->rule('day', 'not_empty')
                ->rule('month', 'not_empty')
                ->rule('year', 'not_empty')
                ->rule('phone','not_empty');
                //rint_r($validation);die;
            if($validation->check())
            {
                try
                {
                    $post_data['birthday'] = $post_data['year']."-".$post_data['month']."-".$post_data['day'];
                    $birthday=$post_data['year']."-".$post_data['month']."-".$post_data['day'];
                    $first_name=$post_data['first_name'];

                    $last_name=$post_data['last_name'];
                    $age = date_diff(DateTime::createFromFormat('Y-m-d', $post_data['birthday']), date_create('now'))->y;

                    if($age < 13)
                    {
                        echo json_encode(array('status'=>false, 'code' => 500, 'message'=>"We are sorry, but you must be at least 13 years or older to use Callitme. Come back once your hit 13!"));
                        exit;

                    }
                    else
                    {

                        $user = ORM::factory('user', array('email' => $post_data['email']));
                        $post_data['registration_steps'] = '2';
                        $post_data['registration_date'] = date('Y-m-d H:i:s');

                        $exists_phone = ORM::factory('user_detail', array('phone' => $post_data['phone']));
                        if(!$exists_phone->id)
                        {
                            /***************************************************************/
                            if(strlen($first_name.$last_name) < 30)
                                $suggestions[] = $first_name.$last_name;
                            if(strlen($last_name.$first_name) < 30)
                                $suggestions[] = $last_name.$first_name;
                            if(strlen($first_name.'-'.$last_name) < 30)
                                $suggestions[] = $first_name.'-'.$last_name;
                            if(strlen($last_name.'-'.$first_name) < 30)
                                $suggestions[] = $last_name.'-'.$first_name;

                            $birthyear = date('Y', strtotime($birthday));
                            $day = date('m', strtotime($birthday));

                            if(strlen($first_name.$last_name.$day) < 30)
                                $suggestions[] = $first_name.$last_name.$day;
                            if(strlen($last_name.$first_name.$day) < 30)
                                $suggestions[] = $last_name.$first_name.$day;
                            if(strlen($first_name.$last_name.$birthyear) < 30)
                                $suggestions[] = $first_name.$last_name.$birthyear;
                            if(strlen($last_name.$first_name.$birthyear) < 30)
                                $suggestions[] = $last_name.$first_name.$birthyear;

                            $exists = ORM::factory('user')
                                ->where('username', 'IN', $suggestions)
                                ->find_all()
                                ->as_array();

                            $already = array();
                            foreach($exists as $exist)
                            {
                                $already[] = $exist->username;
                            }

                            $suggestions = array_diff($suggestions, $already);
                            shuffle($suggestions);
                            $suggestions = array_slice($suggestions, 0, 4);

                            /************************************************************************/
                        
                            $post_data['website']='www.callitme.com/'.$suggestions[0];
                            $allow = false;
                            if(!$user->id)
                            {
                                $allow = true;
                                $user = ORM::factory('user');
                                $user_detail = ORM::factory('user_detail');
                                $user_detail->values($post_data);
                                $user_detail->save();
                                //$post_data['photo_id'] = $photo->id;
                                $post_data['user_detail_id'] = $user_detail->id;
                                $post_data['username'] = $suggestions[0];//Text::random(null, 11).$user_detail->id;
                                $user->email = $post_data['email'];
                                $user->values($post_data);
                                $user->save();

                                //profile upload
                                if(!empty($_FILES)) {
                                    $name1 = $_FILES["picture"]['name'];
                                    $ext = end((explode(".", $name1))); # extra () to prevent notice
                                    $picture = Upload::save($_FILES['picture'], null , DOCROOT."mobile/upload/");
                                    $str = Text::random();
                                    $original = "pp-".$user->id ."-".$str."_o.jpg"; //original profile pic
                                    //resize to different sizes
                                    $image = Image::factory($picture);
                                    $image->resize(500, 500);

                                    $image->save(DOCROOT."mobile/upload/".$original);
                                        
                                    $photo = ORM::factory('photo', $user->photo_id);
                                            
                                    try {
                                              
                                        if (file_exists(DOCROOT."upload/".$photo->profile_pic) || file_exists(DOCROOT."mobile/upload".$photo->profile_pic))
                                            unlink(DOCROOT."upload/".$photo->profile_pic);
                                            unlink(DOCROOT."mobile/upload".$photo->profile_pic);
                                        if (file_exists(DOCROOT."upload/".$photo->profile_pic_m) || file_exists(DOCROOT."mobile/upload".$photo->profile_pic_m))
                                            unlink(DOCROOT."upload/".$photo->profile_pic_m);
                                            unlink(DOCROOT."mobile/upload".$photo->profile_pic_m);
                                        if (file_exists(DOCROOT."upload/".$photo->profile_pic_s) || file_exists(DOCROOT."mobile/upload".$photo->profile_pic_s))
                                            unlink(DOCROOT."upload/".$photo->profile_pic_s);
                                            unlink(DOCROOT."mobile/upload".$photo->profile_pic_s);
                                                    
                                    } catch(Exception $e) { }
                                        // $image = Image::factory($picture);
                                    $str = Text::random();
                                    $name = "pp-".$user->id ."-".$str.".jpg"; //main profile pic
                                    $name_s = "pp-".$user->id ."-".$str."_s.jpg"; //small pic
                                    $name_m = "pp-".$user->id ."-".$str."_m.jpg"; //mini pic

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
                                    $image->save(DOCROOT."mobile/upload/".$name); 
                                    $image->resize(null, 63);
                                    $image->save(DOCROOT."mobile/upload/".$name_s);
                                    $image->resize(null, 50);
                                    $image->save(DOCROOT."mobile/upload/".$name_m);
                                    //update image names in database
                                    $photo = ORM::factory('photo', $user->photo_id);
                                    $photo->profile_pic   = basename($name);
                                    $photo->profile_pic_o = basename($original);
                                    $photo->profile_pic_m = basename($name_m);
                                    $photo->profile_pic_s = basename($name_s);
                                    $photo->save();
                                    if (!$user->photo_id) {
                                        $user->photo_id = $photo->id;
                                        $user->save();
                                    }
                                }
                            }
                            else if($user->not_registered == 1)
                            {
                                $allow = true;
                                $user_detail = $user->user_detail;
                                $user_detail->values($post_data);
                                $user_detail->save();
                                $post_data['username'] = $suggestions[0];//Text::random(null, 11).$user_detail->id;
                                $post_data['not_registered'] = 0;
                                $user->email = $post_data['email'];

                                $user->values($post_data);
                                $user->save();
                            }

                            if($allow == true)
                            {
                                $user->add('roles', ORM::factory('role')->where('name', '=', 'login')->find());
                                if(!$user->plan->id)
                                {
                                    $user_plan = ORM::factory('user_plan');
                                    $user_plan->user_id = $user->id;
                                    $user_plan->name = 'free';
                                    $user_plan->plan_expires = date("Y-m-d H:i:s", mktime(23, 59, 59, date("m")+1  , date("d")-1, date("Y")));
                                    $user_plan->r_to_friend = 20;
                                    $user_plan->save();
                                }

                                //begin add to mailchimp - Added by Ash
                                //$mc_instance = new MCAPI(Kohana::$config->load('mailchimp')->get('api_key'));
                                $first_name = $user_detail->first_name; // first name of the user
                                $last_name = $user_detail->last_name; // last name of the user
                                $email = $user->email; // email address of the user
                                $merge_vars = array('FNAME' => $first_name, 'LNAME'=> $last_name);
                                //$list_id = Kohana::$config->load('mailchimp')->get('list_id');

                                /*$retval = $mc_instance->listSubscribe($list_id, $email, $merge_vars, 'html', false);
                                if ($mc_instance->errorCode)
                                {
                                    // there was an error, let's log it
                                    echo "Unable to load listUpdateMember. \t Code=".$mc_instance->errorCode."\n\tMsg=".$mc_instance->errorMessage."\n";
                                }*/

                                //end add to mailchimp - Added by Ash
                                $token = $this->activation_link($user);

                                //Auth::instance()->force_login($user); // force login the user without password
                                //Session::instance()->set('social', 0);

                                $userInfo = array_merge(
                                    $this->get_user_detail($user),
                                    array (
                                        'email'         => $user->email,
                                        'fb_pass'       => $user->firebase_password,
                                        'device_token'  => $user->device_token,
                                        'token'         => $token
                                    )
                                );

                                $list = array();
                                $friends = $user->friends->find_all()->as_array();
                                foreach($friends as $friend) {
                                    $list[] = $this->get_user_detail($friend);
                                }
                                $userInfo['friends'] = $list;

                                echo json_encode(array('status'=>true, 'code'=>200,'message'=>'Successfully registered', 'data'=>$userInfo));
                                exit;

                                //$this->request->redirect(url::base().'pages/newuser_profile'); //redirect to step2
                            }
                            else
                            {
                                // Session::instance()->set('error', 'This email address is already registered.');
                                echo json_encode(array('status'=>false, 'code'=>500, 'message'=>'This email address is already registered.'));
                                exit;
                            }
                        }
                        else {
                            // Session::instance()->set('error', 'This email address is already registered.');
                            echo json_encode(array('status'=>false, 'code'=>500, 'message'=>'This phone number is already registered.'));
                            exit;
                        }
                    }
                }
                catch (ORM_Validation_Exception $e)
                {
                    Session::instance()->set('error',$e->errors(''));
                }
            }
            else
            {
                echo json_encode(array('status'=>false, 'code'=>500, 'message'=>'Please fill all the feilds'));
                exit;
            }
        }

        echo "Register Section, please provide request parameter for getting responce";
        exit;
    }

    private function activation_link($user, $forgot_password = '') {
        if (!empty($user)) {
            // Token data
            $data = array(
                'user_id'    => $user->pk(),
                'expires'    => time() + 1209600,
                'created'    => time(),
            );

            $data['type'] = (empty($forgot_password)) ? 'activation_code' : 'forgot_password';

            // Create a new activation token
            $token = ORM::factory('user_token')
                ->values($data)
                ->create();

            $email = base64_encode($user->email); // encode email for sending with the link

            if(empty($forgot_password)) {
                $link = url::base()."pages/activate/".$email."/".$token->token;

                $code = md5($user->username.$user->email);
                $deactivate = url::base()."pages/deactivate/".base64_encode($user->username)."/".$code;

                //send activation email
                $send_email = Email::factory('Welcome '.$user->user_detail->first_name .' '.$user->user_detail->last_name .' to Callitme')
                    ->message(View::factory('mails/activation_mail', array('user' => $user, 'link' => $link, 'deactivate' => $deactivate))->render(), 'text/html')
                    ->to($user->email)
                    ->from('noreply@callitme.com', 'Callitme')
                    ->send();

            } else {
                $link = url::base()."pages/reset_password/".$email."/".$token->token;

                //send activation email
                $send_email = Email::factory('Reset Password')
                    ->message(View::factory('mails/reset_password_mail', array('user' => $user, 'link' => $link))->render(), 'text/html')
                    ->to($user->email)
                    ->from('noreply@callitme.com', 'Callitme')
                    ->send();
            }

            return $token->token;
        }
    }

    public function action_edit_profile() 
    {
        if(!Auth::instance()->logged_in()) {
            die("Invalid Request");
        }

        $error  = true; $msg = '';
        $user = Auth::instance()->get_user();
        if($this->request->post())
        {
            $validation = Validation::factory($this->request->post());
            $validation->rule('first_name', 'not_empty')
                ->rule('first_name', 'regex', array(':value', '/^[a-zA-Z_.]++$/'))
                ->rule('last_name', 'not_empty')
                ->rule('last_name', 'regex', array(':value', '/^[a-zA-Z_.]++$/'))
                ->rule('last_name','max_length', array(':value', '20'))
                ->rule('phase_of_life', 'not_empty')
                ->rule('website', 'not_empty')
                ->rule('location', 'not_empty')
                ->rule('home_town', 'not_empty')
                ->rule('education', 'not_empty')
                ->rule('designation', 'not_empty')
                ->rule('about', 'not_empty')
                ->rule('birthday', 'not_empty');
            if($validation->check())
            {
                $post_data = $this->request->post();
                $age = date_diff(DateTime::createFromFormat('Y-m-d', $post_data['birthday']), date_create('now'))->y;

                if($age < 13)
                {
                    $msg = 'We are sorry, but you must be at least 13 years or older to use Callitme. Come back once your hit 13!';
                }
                else
                {
                    $post_data['birthday'] = date('Y-m-d', strtotime($post_data['birthday']));
                    $user->user_detail->values($post_data);
                    $user->user_detail->save();
                    $response = array('status' => true, 'code' => 200, 'message' => 'Successfully updated', 'data' => array());
                    $error = false;
                }
            }
            else
            {
                $msg = 'All fields required';
            }
        }
        else {
            $msg = "Method not allowed";
        }
        if($error) {
            $response = array('status' => false, 'code' => 500, 'message' => $msg);
        }

        echo json_encode($response);
    }

    public function action_save_photo() {
        if( $this->request->post() )
        {
            if(!empty($this->request->post('username')))
            {
                $user = ORM::factory('user',array('username'=>$this->request->post('username')));
            }else
            {
                echo json_encode(array('status'=>false,'code'=>500,'message'=>'Please provide your username '));
                exit;
            }


            if( $this->request->post('username') )
            {

                $post_data = $this->request->post();
                if ($user->photo_id)
                {
                    $photo = ORM::factory('photo', $user->photo_id);
                    try
                    {
                        //delete previous profile picture if exists
                        if (file_exists(DOCROOT."mobile/upload/".$photo->profile_pic_o))
                            unlink(DOCROOT."mobile/upload/".$photo->profile_pic_o);
                        if (file_exists(DOCROOT."mobile/upload/".$photo->profile_pic))
                            unlink(DOCROOT."mobile/upload/".$photo->profile_pic);
                        if (file_exists(DOCROOT."mobile/upload/".$photo->profile_pic_m))
                            unlink(DOCROOT."mobile/upload/".$photo->profile_pic_m);
                        if (file_exists(DOCROOT."mobile/upload/".$photo->profile_pic_s))
                            unlink(DOCROOT."mobile/upload/".$photo->profile_pic_s);

                    } catch(Exception $e) { }
                } else
                {
                    $photo = ORM::factory('photo');
                }

                $original = Upload::save($_FILES['picture'], null , DOCROOT."mobile/upload/");
                $image = Image::factory($original);
                $str = Text::random();
                $name = "pp-".$user->id ."-".$str.".jpg"; //main profile pic
                $name_s = "pp-".$user->id ."-".$str."_s.jpg"; //small pic
                $name_m = "pp-".$user->id ."-".$str."_m.jpg"; //mini pic
                $post_data['x1'] = !empty($post_data['x1']) ? $post_data['x1'] : 0;
                $post_data['y1'] = !empty($post_data['y1']) ? $post_data['y1'] : 0;
                $post_data['x2'] = !empty($post_data['x2']) ? $post_data['x2'] : $image->width;
                $post_data['y2'] = !empty($post_data['y2']) ? $post_data['y2'] : $image->height;
                $new_w = $post_data['x2'] - $post_data['x1'];
                $new_h = $post_data['y2'] - $post_data['y1'];
                $image->crop($new_w, $new_h, $post_data['x1'], $post_data['y1']);
                $image->save(DOCROOT."mobile/upload/".$name);
                $image->resize(270, null);
                $image->save(DOCROOT."mobile/upload/".$name);
                $image->resize(null, 63);
                $image->save(DOCROOT."mobile/upload/".$name_s);
                $image->resize(null, 50);
                $image->save(DOCROOT."mobile/upload/".$name_m);
                $photo = ORM::factory('photo', $user->photo_id);
                $photo->profile_pic = basename($name);
                $photo->profile_pic_o = basename($this->request->post('imag_name'));
                $photo->profile_pic_m = basename($name_m);
                $photo->profile_pic_s = basename($name_s);
                $photo->save();
                if (!$user->photo_id)
                {
                    $user->photo_id = $photo->id;
                    $user->save();
                }
                echo json_encode(array('status'=>true,'code'=>200,'message'=>'photo updated','data'=>array('profile_pic_link'=>url::base()."mobile/upload/".$name)));

                exit;
            }
            else
            {


                $picture = Upload::save($_FILES['picture'], null , DOCROOT."mobile/upload/");
                $str = Text::random();
                $original = "pp-".$user->id ."-".$str."_o.jpg"; //original profile pic

                $image = Image::factory($picture);
                $image->resize(600, 500);
                $image->save(DOCROOT."mobile/upload/".$original);

                $data['width']  = $image->width + 60;
                $data['height']  = $image->height + 190;
                $data['image'] = $original;

                echo json_encode(array('status'=>true,'code'=>200,'message'=>'photo updated','data'=>array('profile_pic_link'=>url::base()."mobile/upload/".$user->photo->profile_pic)));

                exit;
            }
            echo json_encode(array('status'=>false, 'code'=>500, 'message'=>'photo not updated'));
            exit;

        }

    }

    public function action_username_suggestions() //change username
    {
        $error = true; $msg = '';
        if( $this->request->post())
        {
            $post_data = $this->request->post();
            $validation = Validation::factory($this->request->post());
            $validation->rule('on_signup', 'not_empty');
            if($validation->check())
            {
                if($post_data['on_signup'] == 0)
                {
                    if(!Auth::instance()->logged_in()) {
                        die("Invalid Request");
                    }

                    $user =  Auth::instance()->get_user();
                    $post_data['first_name'] = $user->user_detail->first_name;
                    $post_data['last_name'] = $user->user_detail->last_name;
                    $post_data['birthday'] = $user->user_detail->birthday;
                    $suggestions = $this->username_suggestions($post_data);
                    $response = array('status'=>true,'code'=>200,'message'=>'Username suggestions data.','data'=>array('suggestions' => $suggestions));
                    $error = false;
                }
                else
                {
                    $first_name = $post_data['first_name'];
                    $last_name = $post_data['last_name'];
                    $birthday = date('Y-m-d', strtotime($post_data['birthday']));
                    if($first_name != '' && $last_name != '' && $birthday != '')
                    {
                        $suggestions = $this->username_suggestions($post_data);
                        $response = array('status'=>true,'code'=>200,'message'=>'Username suggestions data.','data'=>array('suggestions' => $suggestions));
                        $error = false;
                    }
                    else
                    {
                        $msg = "Please fill all the feilds";
                    }
                }
            }
            else 
            {
                $msg = "Please fill all the feilds";
            }
        }
        else
        {
            $msg = "Method not allowed";
        }
        if($error) {
            $response = array('status' => false, 'code' => 500, 'message' => $msg);
        }
        echo json_encode($response);
    }
    private function username_suggestions($data)
    {
        $first_name = strtolower($data['first_name']);
        $last_name = strtolower($data['last_name']);
        $suggestions = array();

        $suggestions[] = $first_name;
        if(strlen($first_name.$last_name) < 30)
            $suggestions[] = $first_name.$last_name;
        if(strlen($last_name.$first_name) < 30)
            $suggestions[] = $last_name.$first_name;
        if(strlen($first_name.'-'.$last_name) < 30)
            $suggestions[] = $first_name.'-'.$last_name;
        if(strlen($last_name.'-'.$first_name) < 30)
            $suggestions[] = $last_name.'-'.$first_name;

        $birthyear = date('Y', strtotime($data['birthday']));
        $day = date('m', strtotime($data['birthday']));

        if(strlen($first_name.$last_name.$day) < 30)
            $suggestions[] = $first_name.$last_name.$day;
        if(strlen($last_name.$first_name.$day) < 30)
            $suggestions[] = $last_name.$first_name.$day;

        if(strlen($first_name.$last_name.$birthyear) < 30)
            $suggestions[] = $first_name.$last_name.$birthyear;
        if(strlen($last_name.$first_name.$birthyear) < 30)
            $suggestions[] = $last_name.$first_name.$birthyear;

        $exists = ORM::factory('user')
            ->where(strtolower('username'), 'IN', $suggestions)
            ->find_all()
            ->as_array();

        $already = array();
        foreach($exists as $exist) {
            $already[] = strtolower($exist->username);
        }


        $suggestions = array_diff($suggestions, $already);
        shuffle($suggestions); 
        $suggestions = array_slice($suggestions, 0, 4);

        return $suggestions;
    }

    public function action_change_username() {
        $error = true; $msg = '';
        if( $this->request->post())
        {
            $user =  Auth::instance()->get_user();
            if(!$user->check_username($this->request->post('username')))
            {
                $user->username = $this->request->post('username');
                $user->save();
                $response = array('status' => true, 'code' => 200, 'message' => 'Your username has been updated.','data'=>array());
                $error = false;
            } 
            else
            {
                $msg = "Username already exists.";
            }
        }
        else
        {
            $msg = "Method not allowed";
        }
        if($error) {
            $response = array('status' => false, 'code' => 500, 'message' => $msg);
        }

        echo json_encode($response);
    }

    public function action_change_email() {
        if( $this->request->post() )
        {
            $post_data = $this->request->post();

            if($post_data['email'] != Auth::instance()->get_user()->email) {

                $user = ORM::factory('user')
                    ->where('email', '=', $post_data['email'])
                    ->where('id', '!=', Auth::instance()->get_user()->id)
                    ->find();

                if($user->id) {
                    echo json_encode(array('status'=>false,'code'=>500,'message'=>'This email is already registered.'));
                    exit;
                } 
                else {
                    //save data
                    $user = Auth::instance()->get_user();
                    $user->values(array('new_email' => $post_data['email']));
                    $user->save();

                    // Token data
                    $data = array(
                        'user_id'    => $user->pk(),
                        'expires'    => time() + 1209600,
                        'created'    => time(),
                        'type'       => 'change_email'
                    );

                    // Create a new activation token
                    $token = ORM::factory('user_token')
                        ->values($data)
                        ->create();

                    $email = base64_encode($user->new_email);

                    $link = url::base()."pages/change_email/".$email."/".$token->token;
                    Session::instance()->set('Link',$link);
                    //send activation email
                    $send_email = Email::factory('Change Email Address Confirmation')
                        ->message(View::factory('mails/change_email_mail', array('link' => $link))->render(), 'text/html')
                        ->to($user->new_email)
                        ->from('noreply@Callitme.com', 'Callitme')
                        ->send();

                    $send_email = Email::factory('Change Email Address Request')
                        ->message(View::factory('mails/alert_email_mail', array('new_email' => $user->new_email))->render(), 'text/html')
                        ->to($user->email)
                        ->from('noreply@Callitme.com', 'Callitme')
                        ->send();

                    echo json_encode(array('status'=>true,'code'=>200,'message'=>'Your request to change email is being processed. Please verify your new email address to complete the process.','data'=>array()));
                    exit;
                }
            }
        }
        echo "Email update Api";
    }

    public function action_change_password() {
        if( $this->request->post() )
        {
            $user = Auth::instance()->get_user();
            if ($this->request->post('old_password')) {
                
                if (Auth::instance()->check_password( $this->request->post('old_password') )) {
                    //if old password match, save new password
                    $user = ORM::factory('user', Auth::instance()->get_user()->id);
                    $user->values($this->request->post());
                    $user->save();
                    echo json_encode(array('status'=>true,'code'=>200,'message'=>'Your Password has been updated','data'=>array()));
                    exit;
                    
                } else {
                    echo json_encode(array('status'=>false,'code'=>500,'message'=>'Incorrect Password.'));
                    exit;
                }
                
            }
        }
        echo "Password update Api";
    }

    public function action_forgot_password() {
        if($this->request->post()) 
        {
            $validation = Validation::factory($this->request->post());
            $validation->rule('email', 'not_empty');
            if($validation->check())
            {
                $user = ORM::factory('user', array('email' => $this->request->post('email')));
                if($user->id)
                {
                    $forgot = $this->activation_link($user, 'forgot_password');
                    if(!empty($forgot))
                    {
                        echo json_encode(array('status'=>true, 'code'=>200, 'message'=>'Your password has been emailed to your registered email address.', 'data' => array()));
                        exit;
                    }
                }
                else
                {
                    echo json_encode(array('status'=>false,'code'=>500,'message' => 'Your email is not registered.'));
                    exit;
                }
            }
            else
            {
                echo json_encode(array('status'=>false,'code'=>500,'message'=>'Email fields required'));
                exit;
            }
        }
        echo "Forgot password Api";
    }

    public function action_add_post()
    {
        if(!Auth::instance()->logged_in()) {
            die("Invalid Request");
        }

        $error = true; $msg = '';
        $user = Auth::instance()->get_user();        
        if($this->request->post()) 
        {
            $text = $this->request->post('text');
            $gradient_bg = $this->request->post('gradient_bg'); // 1 = Orange, 2 = Purple, 3 = Yellow
            if(!empty($_FILES) && $_FILES["picture"]["size"] > 0)
            {
                $name1 = $_FILES["picture"]['name'];

                $allow = false;
                if ($text != '' || $name1 != '') {
                    $allow = true;
                }
                elseif ($gradient_bg != '' && $text != '') {
                    $allow = true;
                }
                elseif ($gradient_bg != '' && $text != '' && $name1 != '') {
                    $allow = true;
                }

                if ($allow == true) {
                    $ext = end((explode(".", $name1))); # extra () to prevent notice
                    $picture = Upload::save($_FILES['picture'], null , DOCROOT."mobile/upload/");
                    $str = Text::random();
                    $original = "pp-".$user->id ."-".$str."_o.jpg"; //original profile pic
                    //resize to different sizes
                    $image = Image::factory($picture);
                    $image->resize(500, 500);

                    $image->save(DOCROOT."mobile/upload/".$original);

                    $str = Text::random();
                    $name = "ppi-".$user->id ."-".$str.".jpg"; //main profile pic

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

                    $image->save(DOCROOT."mobile/upload/".$name); 

                    if($this->request->post('text')) {
                        $post_data['post'] = $text;
                    }
                    if($this->request->post('gradient_bg')) {
                        $post_data['gradient_bg'] = $gradient_bg;
                    }
                    $post_data['photo'] = url::base().'mobile/upload/'.$name;
                    $post_data['user_id'] = $user->id;
                    $post_data['time'] = date('Y-m-d H:i:s');

                    $post = ORM::factory('post');
                    $post->values($post_data);
                    $post->save();

                    $post = ORM::factory('post', array('id' => $post->id));
                    $postInfo = array(
                        'id' => $post->id,
                        'user_id' => $post->user_id,
                        'type' => $post->type,
                        'action' => $post->action,
                        'post' => $post->post,
                        'gradient_bg' => $post->gradient_bg,
                        'photo_id' => $post->photo_id,
                        'photo' => $post->photo
                    );
                    $response = array('status' => true, 'code' => 200, 'message' => 'Post added successfully', 'data' => $postInfo);
                     $error = false;
                }
                else
                {
                    $msg = "Please fill the text field.";
                }
            } 
            else
            {
                $allow = false;
                if ($text != '') {
                    $allow = true;
                }
                elseif ($gradient_bg != '' && $text != '') {
                    $allow = true;
                }

                if ($allow == true) {
                    $post_data['user_id'] = $user->id;
                    $post_data['post'] = $text;
                    $post_data['gradient_bg'] = $gradient_bg;
                    $post_data['time'] = date('Y-m-d H:i:s');
                    $post = ORM::factory('post');
                    $post->values($post_data);
                    $post->save();

                    $post = ORM::factory('post', array('id' => $post->id));
                    $postInfo = array(
                        'id' => $post->id,
                        'user_id' => $post->user_id,
                        'type' => $post->type,
                        'action' => $post->action,
                        'post' => $post->post,
                        'gradient_bg' => $post->gradient_bg,
                        'photo_id' => $post->photo_id,
                        'photo' => $post->photo
                    );
                    $response = array('status' => true, 'code' => 200, 'message' => 'Post added successfully', 'data' => $postInfo);
                    $error = false;
                }
                else
                {
                    $msg = "Please fill the text field.";
                }
            }
        }
        else {
            $msg = "Method not allowed";
        }
        if($error) {
            $response = array('status' => false, 'code' => 500, 'message' => $msg);
        }

        echo json_encode($response);
    }

    public function action_feeds()
    {
        if(!Auth::instance()->logged_in()) {
            die("Invalid Request");
        }
        $error = true; $msg = '';
        $user = Auth::instance()->get_user();
        if($this->request->query()){
            $offset = $this->request->query('offset');
            //create array of member_ids for fetching posts.
            $friends_array[0] = $user->id; //add member_id of current user also
            foreach ($user->friends->where('is_deleted', '=', 0)->find_all()->as_array() as $friend) 
            {
                $friends_array[] = $friend->id;
            }
            $time = date("Y-m-d H:i:s", time()+10); //fetch all the posts

            //fetch all posts count
            $post_count = ORM::factory('post')
                ->where('user_id', 'IN', $friends_array)
                ->and_where('is_deleted', '=', 0)
                ->and_where('time', '<', $time)
                ->order_by('time', 'desc')
                ->find_all()
                ->as_array();

            //fetch all posts from the members user is following.
            $posts = ORM::factory('post')
                ->where('user_id', 'IN', $friends_array)
                ->and_where('is_deleted', '=', 0)
                ->and_where('time', '<', $time)
                ->order_by('time', 'desc')
                ->limit(10)
                ->offset($offset)
                ->find_all()
                ->as_array();
            //$data['posts'] = $posts; //set post to use in the view

            $feed_data = array();
            if(!empty($posts)) {
                foreach ($posts as $post) {
                    if($post->user->is_blocked == 0) {
                        $age = time() - strtotime($post->time);

                        $username = '';
                        if($post->type == 'inspired' || $post->type == 'friend') {
                            $link = $post->action;
                            preg_match_all('/<a[^>]+href=([\'"])(?<href>.+?)\1[^>]*>/i', $link, $matches);
                            $username = $matches['href'][0];
                        }

                        $action = $post->action;
                        if($post->type == 'inspired' || $post->type == 'friend') {
                            $action = str_replace('<a href="'.$username.'">', '', str_replace('</a>', '', $post->action));
                        }

                        $feed_data[] = array(
                            'post_id' => $post->id,
                            'user_id' => $post->user_id,
                            'profile_pic_s' => ($post->user->photo->profile_pic_s) ? url::base()."mobile/upload/".$post->user->photo->profile_pic_s : $post->user->user_detail->get_no_image_name(),
                            'first_name' => $post->user->user_detail->first_name,
                            'last_name' => $post->user->user_detail->last_name,
                            'action' => $action,
                            'username' => $username,
                            'time' => ($age >= 86400) ? date('jS M', strtotime($post->time)) : Date::time2string($age),
                            'post' => $post->post,
                            'gradient_bg' => $post->gradient_bg,
                            'photo' => $post->photo
                        );
                    }
                }
                $next_offset = $offset + 10;
                if (count($post_count) > $next_offset) {
                    $new_offset = $next_offset;
                } else {
                    $new_offset = -1;
                }
                $response   = array('status' => true, 'code' => 200, 'message' => 'Feeds data', 'offset' => $new_offset, 'data' => $feed_data);
                $error      = false;
            }
            else {
                $msg = "Feeds data not found.";
            }
        }
        else {
            $msg = "Method not allowed";
        }
        if($error) {
            $response = array('status' => false, 'code' => 500, 'message' => $msg);
        }

        echo json_encode($response);
    }

    public function action_user_notification()
    {
        if(!Auth::instance()->logged_in()) {
            die("Invalid Request");
        }

        $error  = true; $msg = '';
        $user = Auth::instance()->get_user();
        if($this->request->query()){
            $offset = $this->request->query('offset');

            $user->read_notification_at = date("Y-m-d H:i:s");
            $user->save();
            $friends_array = array();
            foreach ($user->friends->where('is_deleted', '=', 0)->find_all()->as_array() as $friend) {
                $friends_array[] = $friend->id;
            }
            if(!empty($friends_array)) {
                $activity_count = ORM::factory('activity')
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

                $activities = ORM::factory('activity')
                    ->and_where_open()
                        ->where('target_user', '=', $user->id)
                        ->or_where_open()
                            ->where('user_id', 'IN', $friends_array)
                            ->and_where('target_user', '=', 0)
                        ->or_where_close()
                    ->and_where_close()
                    ->order_by('time', 'desc')
                    ->limit(10)
                    ->offset($offset)
                    ->find_all()
                    ->as_array();
            } else {
                $activity_count = ORM::factory('activity')
                    ->where('target_user', '=', $user->id)
                    ->order_by('time', 'desc')
                    ->find_all()
                    ->as_array();

                $activities = ORM::factory('activity')
                    ->where('target_user', '=', $user->id)
                    ->order_by('time', 'desc')
                    ->limit(10)
                    ->offset($offset)
                    ->find_all()
                    ->as_array();
            }
            $activities_data = array();
            if(!empty($activities)) {
                foreach($activities as $activity) {
                    $age = time() - strtotime($activity->time);
                    if ($age >= 86400) {
                        $time = date('j M', strtotime($activity->time));
                    } else {
                        $time = date::time2string($age);
                    }

                    $date = date('Y-m-d');
                    $section = 'Yesterday';
                    if ($date == date('Y-m-d', strtotime($activity->time))) {
                        $section = 'Today';
                    }

                    if($activity->type == 'recommend') {
                        $link = $activity->activity;
                        preg_match_all('/<a[^>]+href=([\'"])(?<href>.+?)\1[^>]*>/i', $link, $matches);
                        $username = $matches['href'][0];
                    }
                    else
                    {
                        $users = ORM::factory('user', array('id' => $activity->user_id));
                        $username = $users->username;
                    }

                    $activiti = $activity->activity;
                    if($activity->type == 'recommend') {
                        $activiti = str_replace('<a href="'.$username.'">', '', str_replace('</a>', '', $activity->activity));
                    }
                    $activities_data[] = array(
                        'id' => $activity->id, 
                        'user_id' => $activity->user_id,
                        'profile_pic' => url::base()."mobile/upload/".$activity->user->photo->profile_pic,
                        'first_name' => $activity->user->user_detail->first_name,
                        'last_name' => $activity->user->user_detail->last_name,
                        'dateFact' => $activity->dateFact, 
                        'type' => $activity->type, 
                        'activity' => $activiti,
                        'username' => $username,
                        'target_user' => $activity->target_user, 
                        'target_id' => $activity->target_id, 
                        'time' => $time,
                        'section' => $section
                    );
                }
                $next_offset = $offset + 10;
                if (count($activity_count) > $next_offset) {
                    $new_offset = $next_offset;
                } else {
                    $new_offset = -1;
                }
                $response       = array('status' => true, 'code' => 200, 'message' => 'Activities notification data', 'offset' => $new_offset, 'data' => $activities_data);
                $error          = false;
            }
            else {
                $msg = 'Data Not Found';
            }
        }
        else {
            $msg = "Method not allowed";
        }

        if($error) {
            $response = array('status' => false,'code' => 500, 'message' => $msg);
        }

        echo json_encode($response);
    }

    public function action_suggestions_profile()
    {
        if(!Auth::instance()->logged_in()) {
            die("Invalid Request");
        }

        $error  = true; $msg = '';
        $session_user = Auth::instance()->get_user();

        $userss = ORM::factory('user')->with('user_detail')
            ->where('sex', '=', (($session_user->user_detail->sex == 'Male') ? 'Female' : 'Male'))
            ->where('is_deleted', '=', 0)
            ->where('is_blocked', '=', 0)
            ->where('profile_private', '=', 0)
            ->where('profile_public', '=', '0')
            ->where('photo_id', '!=', '0')
            ->order_by(DB::expr('RAND()'))
            //->order_by('id', 'desc')
            ->limit(10)
            ->find_all()
            ->as_array();

        $posts = DB::select('posts.id','posts.user_id','posts.type','posts.gradient_bg','posts.action','posts.post','posts.photo','users.username')
		    ->from('posts')
		    ->join('users','RIGHT')
		    ->on('users.id','=','posts.user_id')
		    ->where('posts.type','=','post')
		    ->where('posts.post','!=','')
		    ->where('posts.is_deleted','=','0')
		    ->order_by(DB::expr('RAND()'))
		    ->limit(1)
		    ->execute()
		    ->as_array();

		$text = $post_username = $gradient_bg = '';
	    if(!empty($posts)) { 
            foreach($posts as $post) {
            	$text = $post['post'];
            	$post_username = $post['username'];
            	$gradient_bg = $post['gradient_bg'];
            }
        }

		$post_photo = DB::select('posts.id','posts.user_id','posts.type','posts.gradient_bg','posts.action','posts.post','posts.photo','users.username')
		    ->from('posts')
		    ->join('users','RIGHT')
		    ->on('users.id','=','posts.user_id')
		    ->where('posts.type','=','post')
		    ->where('posts.photo','!=','')
		    ->where('posts.is_deleted','=','0')
		    ->order_by(DB::expr('RAND()'))
		    ->limit(1)
		    ->execute()
		    ->as_array();

		$img = $photo_username = '';
		if(!empty($post_photo)) { 
            foreach($post_photo as $photo) {
            	$img = $photo['photo'];
            	$photo_username = $photo['username'];
            }
        }

        $list = array();
        $suggestionsData['photo'] = $img;
        $suggestionsData['post_username'] = $photo_username;
        $suggestionsData['gradient_bg'] = $gradient_bg;
        $suggestionsData['post'] = $text;
        $suggestionsData['post_username1'] = $post_username;
        if (!empty($userss)) {
            foreach($userss as $friend) {
                $list[] = array(
                    'id' => $friend->id,
                    'user_detail_id' => $friend->user_detail_id,
                    'name' => $friend->user_detail->get_name(),
                    'username' => $friend->username,
                    'list_attributes' => implode(', ', $friend->user_detail->list_attributes()),
                    'profile_pic' => ($friend->photo->profile_pic_s) ? url::base()."mobile/upload/".$friend->photo->profile_pic_s : $friend->user_detail->get_no_image_name()
                );
            }
        }
        $suggestionsData['suggestions_data'] = $list;

        $response       = array('status' => true, 'code' => 200, 'message' => 'suggestions profile data', 'data' => $suggestionsData);
        $error          = false;

        if($error) {
            $response = array('status' => false,'code' => 500, 'message' => $msg);
        }

        echo json_encode($response);
    }

    public function action_check_username()
    {
        $error = true; $msg = '';
        if( $this->request->post())
        {
            $post_data = $this->request->post();
            $validation = Validation::factory($this->request->post());
            $validation->rule('on_signup', 'not_empty')
                ->rule('username', 'not_empty');
            if($validation->check())
            {
                if($post_data['on_signup'] == 0)
                {
                    if(!Auth::instance()->logged_in()) {
                        die("Invalid Request");
                    }

                    $user =  Auth::instance()->get_user();
                    $exists = ORM::factory('user')
                        ->where(strtolower('username'), '=', strtolower($post_data['username']))
                        ->where('id', '!=', $user->id)
                        ->find();

                    if(!$exists->id)
                    {
                        $response = array('status'=>true,'code'=>200,'message'=>'','data'=>array());
                        $error = false;
                    }
                    else
                    {
                        $msg = "Username already exists.";
                    }
                }
                else
                {
                    $exists = ORM::factory('user')
                        ->where(strtolower('username'), '=', strtolower($post_data['username']))
                        ->find();

                    if(!$exists->id)
                    {
                        $response = array('status'=>true,'code'=>200,'message'=>'','data'=>array());
                        $error = false;
                    }
                    else
                    {
                        $msg = "Username already exists.";
                    }
                }
            }
            else 
            {
                $msg = "Please fill all the feilds";
            }
        }
        else
        {
            $msg = "Method not allowed";
        }
        if($error) {
            $response = array('status' => false, 'code' => 500, 'message' => $msg);
        }
        echo json_encode($response);
    }

    private function get_firebase_conn($user) {
        $default_path = Kohana::$config->load('settings')->get('firebase')['databaseURL'];
        $firebase = new \Firebase\FirebaseLib($default_path);

        $credentials = array(
            'email' => $user->email,
            'password' => $user->firebase_password,
            'returnSecureToken' => true
        );

        $key = Kohana::$config->load('settings')->get('firebase')['apiKey'];
        $user = $firebase->auth($key, $credentials);

        $user = json_decode($user);
        $firebase->setToken($user->idToken);

        return $firebase;
    }

    private function curl_request($url, $data,$headers,$method = 'GET')
    {
        try {
             $curl = curl_init();

             $curl_array =    array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => $method,
                    CURLOPT_HTTPHEADER => $headers,
                );


            if(!empty($data)){
                $curl_array[CURLOPT_POSTFIELDS] = $data;
            }
            curl_setopt_array($curl,$curl_array );

            $return = curl_exec($curl);


        } catch (Exception $e) {

            $return = null;
        }

        return $return;
    }

}
