<?php defined('SYSPATH') or die('No direct script access.');


class Controller_Friendsapi extends Controller_Template {

    public $template = 'templates/accessapi'; //template file
    
    public function before() {
        parent::before();
        header('Content-Type: application/json');
        header("Access-Control-Allow-Origin: *"); 

        
        $headers = apache_request_headers();
        
        if(isset($headers['Authorization']))
        {
            
            $token = ORM::factory('user_token')
                    ->where('token','=',$headers['Authorization'])
                    ->where('expires','>',time())
                    ->find();
            if($token->id)
            {
                $username = $token->user->email;
                Auth::instance()->force_login($username);
                Session::instance()->set('token', $token->token);
                
            }else
                {
                    echo json_encode(array('stauts'=>0,'message'=>'Invalid token'));
                    exit;
                }
            }
        }

    public function action_index() 
    {
        /*if($this->request->query('Authorization'))
        {
            
            $token = ORM::factory('user_token')
                    ->where('token','=',$this->request->query('Authorization'))
                    ->where('expires','>',time())
                    ->find();
            if($token->id)
            {
                $username = $token->user->email;
                Auth::instance()->force_login($username);
                Session::instance()->set('token', $token->token);
                
            }else
                {
                    echo json_encode(array('stauts'=>0,'message'=>'Invalid token'));
                    exit;
                }
            }*/
        $user = Auth::instance()->get_user();
        $friends_details =array();
        foreach ($user->friends->find_all()->as_array() as $friend) 
        {
            if ($friend->photo->profile_pic_s) 
            {
                $friend_profile_pic = url::base()."upload/".$friend->photo->profile_pic_s;
            }
            else
            {
                $friend_profile_pic =$friend->user_detail->first_name[0] . $friend->user_detail->last_name[0];
            }
            $n = ORM::factory('friendship')->where('user_id', '=', $friend->id)->count_all();
            if ($n == 0) 
            {
                $number_of_friends = 'No Friends';
            } else if ($n == 1) 
            {
                $number_of_friends = '1 friend';
            } else 
            {
                $number_of_friends =  $n . ' friends';
            }
            $friend_name = $friend->user_detail->first_name." ".$friend->user_detail->last_name;
            $friend_username = $friend->username;
            $friend_location = $friend->user_detail->location;
            $friends_details[] = array(
                                    'friend_profile_pic' => $friend_profile_pic,
                                    'friend_name' => $friend_name,
                                    'friend_username' => $friend_username,
                                    'number_of_friends' =>$number_of_friends,
                                    'friend_location' => $friend_location,
                                    );
        }
        echo json_encode(array('status'=>1,'message'=>'friends list','friends'=>$friends_details));
        exit;
    }


    public function action_add_friend() 
    {
        //$this->auto_render = false;
        if($this->request->query('friend_id') || $this->request->query('user')) 
        {
            $invitee_id = $this->request->query('friend_id') ? $this->request->query('friend_id') : $this->request->query('user');
            //$user = Auth::instance()->get_user();
            $user = ORM::factory('user' , array('id'=>$this->request->query('user_id')));
            $invitee = ORM::factory('user')->where('id', '=', $invitee_id)->find();

            //$user = Auth::instance()->get_user();
            $recommendations = $user->recommendations->where('state', '=', 'approve')->order_by('time', 'desc')->find_all()->as_array();
            
            $temp_words = array();

            foreach($recommendations as $recommend) 
            {
                $words = explode(', ', $recommend->words);
                $temp_words = array_merge($temp_words, $words);
            }
                
                $tags = array_count_values($temp_words);
            if(!$user->check_friends($invitee) && !$user->check_requests($invitee)) 
            {
                $user->add('requests', $invitee);
                $e_noti= $invitee->user_detail->friend_request_alert;
                if($e_noti == 1 )
                {
                    if($invitee->user_detail->friend_alert) 
                    {
                        //send email
                        $from = Auth::instance()->get_user();
                        /*$send_email = Email::factory('Friend request from '.$from->user_detail->first_name .' '.$from->user_detail->last_name)
                        ->message(View::factory('mails/friend_request_mail', array('to' => $invitee,'tag'=> $tags, 'recommendations' => $recommendations))->render(), 'text/html')
                        ->to($invitee->email)
                        ->from('noreply@callitme.com', 'Callitme')
                        ->send();*/
                    }
                   echo json_encode(array('status'=>1, 'message'=>'Friend Request Sent'));
                   exit;      
                }
            }
        } 
        else if($this->request->query('del_request')) 
        {
            $invitee_id = $this->request->query('del_request');
            //$user = Auth::instance()->get_user();
            $user = ORM::factory('user' , array('id'=>$this->request->query('user_id')));
            $invitee = ORM::factory('user')->where('id', '=', $invitee_id)->find();
            if ($user->has('requests', $invitee)) 
            {
                $user->remove('requests', $invitee);
                echo json_encode(array('status'=>1, 'message'=>'Removed Friend Request'));
                exit; 
            }
        }
    }

    public function action_accept_friend() 
    {
        //$this->auto_render = false;
        if($this->request->query('friend_id'))
        {
            $friend_id = $this->request->query('friend_id');
            $friend = ORM::factory('user')->where('id', '=', $friend_id)->find();
            $user = Auth::instance()->get_user();
            $recommendations = $user->recommendations->where('state', '=', 'approve')->order_by('time', 'desc')->find_all()->as_array();
            $temp_words = array();
            foreach($recommendations as $recommend) 
            {
                $words = explode(', ', $recommend->words);
                $temp_words = array_merge($temp_words, $words);
            }
            $tags = array_count_values($temp_words);

            if ( ! $user->check_friends($friend) && $friend->has('requests', $user)) 
            {
                $user->add('friends', $friend);
                $friend->add('friends', $user);
                $friend->remove('requests', $user);
                
                $this->post = new Model_Post;
                $post = $this->post->new_post('friend', "", " is now connected with @".$friend->username ." .");
                
                $this->activity = new Model_Activity;
                $this->activity->new_activity('friend', ' has accepted your friend request.', $post->id, $friend->id);

                if($friend->user_detail->friend_alert==1)
                {
                    //send email
                    $send_email = Email::factory($user->user_detail->first_name .' '.$user->user_detail->last_name .' has accepted your friend request')
                    ->message(View::factory('mails/friend_request_accepted_mail', array('to' => $friend, 'tag'=> $tags, 'recommendations' => $recommendations))->render(), 'text/html')
                    ->to($friend->email)
                    ->from('noreply@callitme.com', 'Callitme')
                    ->send();
                }

                //  Session::instance()->set('Accepted','Friend Request Accepted');
                echo json_encode(array('status'=>1, 'message'=>'Friend Request Accepted'));
                exit;

            } 
        }
            else 
        {
            echo json_encode(array('status'=>0, 'message'=>'Request valid user id'));
            exit;
        }

    }
    
    public function action_reject_request() {
        //$this->auto_render = false;
        if($this->request->query('friend_id')) 
        {
            $friend_id = $this->request->query('friend_id');
            $user = Auth::instance()->get_user();
            $friend = ORM::factory('user')->where('id', '=', $friend_id)->find();
         
            if ($friend->has('requests', $user))
            {
                $friend->remove('requests', $user);
            }
              //Session::instance()->set('Accepted','Friend Request Rejected');
            echo json_encode(array('status'=>1, 'message'=>'Friend Request Rejected'));
            exit;

        } else {
             //Session::instance()->set('error','Error Occured');
            echo json_encode(array('status'=>0, 'message'=>'Error Occured ! Request valid user id'));
            exit;
        }
    }
    
    public function action_delete_friend() {
        //$this->auto_render = false;
        if($this->request->post('friend_id')) {
            $friend_id = $this->request->post('friend_id');
            $friend = ORM::factory('user')->where('id', '=', $friend_id)->find();
            $user = Auth::instance()->get_user();

            if ($user->check_friends($friend))
            {
                $user->remove('friends', $friend);
                $friend->remove('friends', $user);
            }
            echo "deleted";
        } else {
            echo "error";
        }
    }
    
    
    
    public function action_requests_sent() 
    {
        $user = Auth::instance()->get_user();
        $requests_sent = $user->requests->find_all()->as_array();
        $requests_sent_user = array();
        foreach ($requests_sent as $request) 
        {
            if ($request->photo->profile_pic_s) 
            {
                $request_pic = url::base()."upload/".$request->photo->profile_pic_s;
            }
            else
            {
                $request_pic = $request->user_detail->first_name[0] . $request->user_detail->last_name[0];
            }
            $request_name = $request->user_detail->first_name . " " . $request->user_detail->last_name;
            $request_email = $request->email;
            $request_username = $request->username;
            $requests_sent_user[] = array(
                                        'request_pic' =>$request_pic,
                                        'request_name'=>$request_name,
                                        'request_email'=>$request_email,
                                        'request_username'=>$request_username
                                        );
        }
            echo json_encode(array('stauts'=>1, 'message'=>'Friend request sent user fetch successfully.','requests_sent_user'=>$requests_sent_user));
        exit;
    }
    
    public function action_requests() {
        $user = Auth::instance()->get_user();
        $requests = ORM::factory('Request')->where('request_to', '=', $user->id)->find_all()->as_array();
        if (!empty($requests)) 
        {
            $request_friend = array();
            foreach ($requests as $request) 
            {
                if ($request->user->photo->profile_pic_s) 
                {
                    $request_friend_pic = url::base() . "upload/" . $request->user->photo->profile_pic_s;
                }
                else
                {
                    $request_friend_pic = $request->user->user_detail->first_name[0] . $request->user->user_detail->last_name[0];
                }
                $request_friend_user_id = $request->user->id;
                $request_friend_username = $request->user->username;
                $request_friend_name = $request->user->user_detail->first_name." ".$request->user->user_detail->last_name;
                $request_friend_location = $request->user->user_detail->location;
                $request_friend_sex = $request->user->user_detail->sex;
                $phase_of_life = Kohana::$config->load('profile')->get('phase_of_life');
                $request_friend_phase_of_life = $phase_of_life[$request->user->user_detail->phase_of_life];
            }
            $request_friend[] =array(
                            'request_friend_pic'=>$request_friend_pic,
                            'request_friend_user_id'=>$request_friend_user_id,
                            'request_friend_username'=>$request_friend_username,
                            'request_friend_name'=>$request_friend_name,
                            'request_friend_location'=>$request_friend_location,
                            'request_friend_sex'=>$request_friend_sex,
                            'request_friend_phase_of_life'=>$request_friend_phase_of_life
                            );
            $messege = "Friends List ";
            $status = 1;
            echo json_encode(array('status'=>$status, 'message'=>$messege,'friends request'=>$request_friend));
            exit; 
        }
        else
        {
            $messege ="No Pending Friend Requests";
            $status = 0;
            echo json_encode(array('status'=>$status, 'message'=>$messege));
            exit;


        }
         
        /*$this->template->title = $user->user_detail->first_name .' '.$user->user_detail->last_name;
        $this->template->content = View::factory('friends/pending_requests', $data);*/
    }
    
    public function action_friends_for_noti() 
    {
        
        $this->auto_render = false;
            $user = Auth::instance()->get_user();

            if($this->request->query('seen')) {
                $query = DB::update(ORM::factory('Request')->table_name())
                    ->set(array('seen' => 1))
                    ->where('request_to', '=', $user->id);
                
                $query->execute(); 
            } else {
            
                $requests = ORM::factory('Request')
                    ->where('request_to', '=', $user->id)
                    ->order_by('date_requested', 'desc')
                    ->limit(5)
                    ->find_all()
                    ->as_array();
                if(!empty($requests)) 
                {
                    $friends_req =array();

                    foreach($requests as $request) 
                    {
                        if($request->user->is_blocked == 0) 
                        {
                            if($request->user->photo->profile_pic_m) 
                            {
                                $request_proile_pic = url::base()."upload/".$request->user->photo->profile_pic_m;
                            }
                                else
                            {
                                $request_proile_pic = $request->user->user_detail->first_name[0] . $request->user->user_detail->last_name[0];
                            }
                            $name = $request->user->user_detail->first_name . $request->user->user_detail->last_name;
                            $user_id = $request->user->id;
                            $username = $request->user->username;
                            $location = $request->user->user_detail->location;
                            $sex = $request->user->user_detail->sex;
                            $phase_of_life1 = Kohana::$config->load('profile')->get('phase_of_life');
                            $phase_of_life = $phase_of_life1[$request->user->user_detail->phase_of_life];
                            $friends_req[] =array(
                                                'name' => $name,
                                                'request_proile_pic'=>$request_proile_pic,
                                                'user_id' => $user_id,
                                                'username' =>$username,
                                                'location' => $location,
                                                'sex'=>$sex,
                                                'phase_of_life'=>$phase_of_life
                                                ); 

                        }   
                    } 
                    echo json_encode(array('status'=>1, 'message'=>'request user fetch successfully', 'friends_request'=>$friends_req));
                            exit;  
                }
                else
                {
                    echo json_encode(array('status'=>0, 'message'=>"No pending friend request."));
                    exit;
                }
                
                
            }
       
    }
    
    public function action_member() {
        $username = $this->request->param('username'); // username
        $user = ORM::factory('user', array('username' => $username));

        if($user->id == NULL) {
            $this->request->redirect(url::base());
        }

        $data['user'] = $user;
        $recommendations = $user->recommendations->where('state', '=', 'approve')->find_all()->as_array();

        $temp_words = array();
        foreach($recommendations as $recommend) {
            $words = explode(', ', $recommend->words);
            $temp_words = array_merge($temp_words, $words);
        }
        $tags = array_count_values($temp_words);
        
        $data['tags'] = $tags;

        $data['social'] = $user->calculate_social_percentage($tags);
        
        $data['recommendations'] = $recommendations;
        
        $data['friends'] = $user->friends->find_all()->as_array();
        
        /*if(Request::current()->query('mutual')) {
            $data['friends'] = $user->mutual_friends($session_user);
        }*/
        
        $this->template->title = $user->user_detail->first_name .' '.$user->user_detail->last_name;
        $this->template->sidemenu = View::factory('templates/sidemenu_home', $data);
        $this->template->content = View::factory('friends/member', $data);
    }
}