<?php
defined('SYSPATH') or die('No direct script access.');


class Controller_Peoplereviewapi extends Controller_Template {

    public $template = 'templates/accessapi'; //template file
    
    public function before() 
    {
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
            }
            else
                {
                    echo json_encode(array('stauts'=>0,'message'=>'Invalid token'));
                    exit;
                }
            }
    }

    public function action_index()
    {
        echo "People Review Api Controller";
        exit;
    }
    public function action_recommend_recieve()
    {
        $user = Auth::instance()->get_user();
        $recommends = $user->recommendations->order_by('time', 'desc')->find_all()->as_array();
        if(!empty($recommends))
        {
                $responce = array();
                foreach ($recommends as $recommend) 
                {
                    if($recommend->type == '1') 
                    {
                        if ($recommend->owner->photo->profile_pic_s) 
                        {
                            $profile_pic = url::base()."upload/".$recommend->owner->photo->profile_pic_s;
                        }
                        else
                        {
                            $profile_pic = $recommend->owner->user_detail->first_name[0] . " " . $recommend->owner->user_detail->last_name[0];
                        }
                        if ($recommend->owner->username != 'nagecs9pm8t3347')
                        {
                            $username = $recommend->owner->username;
                        }
                        else
                        {
                            $username = 'nagecs9pm8t3347'; //for anonymous user 
                        }
                        if ($recommend->owner->user_detail->first_name != '') 
                        {
                            $name = $recommend->owner->user_detail->first_name." ".$recommend->owner->user_detail->last_name;
                        } 
                        else 
                        {
                            $name = "Anonymous User";
                        }
                        $message = $recommend->message;
                        $time = time() - strtotime($recommend->time);
                        if ($time >= 86400) 
                        {
                            $review_time = date('jS M', strtotime($recommend->time));
                        } else 
                        {
                            $review_time = date::time2string($time);
                        }
                        if ($recommend->state == 'pending') 
                        {
                            $approve = "Approve";
                            $review_id = $recommend->id;
                            $pending = "Pending";
                            $responce[] = array(
                                    'name' =>$name,
                                    'review_message' =>$message,
                                    'review_id' =>$review_id,
                                    'review_time' =>$review_time,
                                    'username' =>$username,
                                    'profile_pic' =>$profile_pic,
                                    'approve' =>'Approve',
                                    'pending' =>'Pending'
                                    );
                       }
                       else if ($recommend->state == 'decline') 
                       {
                            $approve = "Approve";
                            $review_id = $recommend->id;
                            $responce[] = array(
                                    'name' =>$name,
                                    'review_message' =>$message,
                                    'review_id' =>$review_id,
                                    'review_time' =>$review_time,
                                    'username' =>$username,
                                    'profile_pic' =>$profile_pic,
                                    'approve' =>'Approve'
                                    );
                       } 
                       else if ($recommend->state == 'approve') 
                       {
                            $hide = "Hide";
                            $review_id = $recommend->id;
                            $responce[] = array(
                                    'name' =>$name,
                                    'review_message' =>$message,
                                    'review_id' =>$review_id,
                                    'review_time' =>$review_time,
                                    'username' =>$username,
                                    'profile_pic' =>$profile_pic,
                                    'hide' =>'Hide'
                                    );
                       }
                       else if ($recommend->state == 'hide') 
                       {
                            $show ="Show";
                            $review_id = $recommend->id;
                            $responce[] = array(
                                    'name' =>$name,
                                    'review_message' =>$message,
                                    'review_id' =>$review_id,
                                    'review_time' =>$review_time,
                                    'username' =>$username,
                                    'profile_pic' =>$profile_pic,
                                    'show' =>'Show'
                                    );
                       }
                       
                    }
                    else
                    {
                        $name = "Anonymous User (one of your connections)"; 
                        $review_message = $recommend->message;
                        $time = time() - strtotime($recommend->time);
                        if ($time >= 86400) 
                        {
                            $review_time = date('jS M', strtotime($recommend->time));
                        } 
                        else 
                        {
                            $review_time =  date::time2string($time);
                        }
                        $responce[] = array(
                                    'name' =>$name,
                                    'review_message' =>$review_message,
                                    'review_time' =>$review_time
                                    );
                    }      
                } 
                echo json_encode(array('status'=>1, 'receive reviews'=>$responce));
                exit;  
        }
        else
        {
            echo json_encode(array('stauts'=>0, 'message'=>'No one has reviewed you yet.'));
            exit;
        }   

    }
    public function action_recommend_sent() 
    {
                $user = Auth::instance()->get_user();
                $recommends = $user->sent_recommendations->order_by('time', 'desc')->find_all()->as_array();
                if(!empty($recommends)) 
                {
                    $list = array();
                    foreach($recommends as $recommend) 
                    {
                        if($recommend->recommend_to->photo->profile_pic_s) 
                        { 
                            $profile_pic = url::base()."upload/".$recommend->recommend_to->photo->profile_pic_s;
                        }
                        else
                        {
                            $profile_pic = "no_image_s.png";//$recommend->recommend_to->user_detail->first_name[0].$recommend->recommend_to->user_detail->last_name[0];
                        }
                        $time = time() - strtotime($recommend->time); 
                        if ($time >= 86400) 
                        {
                            $review_time = date('jS M', strtotime($recommend->time));
                        } 
                        else 
                        {
                            $review_time = date::time2string($time);
                        }
                        $username = $recommend->recommend_to->username;
                        $name = $recommend->recommend_to->user_detail->first_name." ".$recommend->recommend_to->user_detail->last_name;
                        $review_message = $recommend->message;
                        $review_id = $recommend->id;
                        $list[] = array(
                                'name' => $name,
                                'username' => $username,
                                'profile_pic' => $profile_pic,
                                'review_time' =>$review_time,
                                'review_message' => $review_message,
                                'review_id' => $review_id
                            ); 
                    }
                        echo json_encode(array('status'=>1, 'message'=>'Review List', 'list' => $list));
                        exit;
                } 
                else 
                {
                    echo json_encode(array('status' =>1, 'message'=>"You have not reviewed anyone yet."));
                    exit;
                }
    }

    public function action_compose()
    {
        $user = Auth::instance()->get_user();
        $data['relations'] = ORM::factory('recommend_relation')->find_all()->as_array();
        $data['words'] = ORM::factory('recommend_word')->find_all()->as_array();
        if($this->request->param('id'))
        {
            $data['recommend'] = ORM::factory('recommend', $this->request->param('id'));  
        }
        if($this->request->query('ask'))
        {
            $data['user_to'] = ORM::factory('user', array('username' => $this->request->query('ask')));
            echo json_encode(array('Status'=>'1','Email'=>$data['user_to']->email,'User'=>$data['user_to']->user_detail->first_name.' '.$data['user_to']->user_detail->last_name));
            exit; 
        }
        if($this->request->post('email'))
        {
            if($user->email === $this->request->post('email')) 
            {
               /* Session::instance()->set('error', 'You can\'t review yourself.');
                $this->request->redirect(url::base()."peoplereview/compose");*/
               echo json_encode(array('Status'=>'0','error'=>'You can\'t review yourself.'));
               exit;
            }
            $user_to = ORM::factory('user')
                        ->where('email', '=',  $this->request->post('email'))
                        ->where('not_registered', '=', 0)
                        ->find();   
            if($user_to->id) 
            {
                $data['user_to'] = $user_to;
                if($user_to->user_detail->sex) 
                {
                    $data['relations'] = ORM::factory('recommend_relation')
                    ->where('gender', '=', $user_to->user_detail->sex)
                    ->or_where('gender', '=', '')
                    ->find_all()
                    ->as_array();
                }
            }
        }
        if(!$this->request->is_ajax())
        {
            $this->template->title = $user->user_detail->first_name .' '.$user->user_detail->last_name;
            $this->template->sidemenu = View::factory('recommend/menu', array('submenu' => 'compose'));
            $this->template->content = View::factory('recommend/send', $data);
        } 
        else 
        {
            $this->auto_render = false;
            echo View::factory('recommend/send',$data)->render();
        }
    }
    public function action_send() 
    {
        $user = Auth::instance()->get_user();
        if($this->request->query())
        {      
            $post_data = $this->request->query();
            $post_data['message'] = strip_tags($post_data['message'], "<br>");

            // fetch all the improper words that are there in the database
            $improper_words = ORM::factory('improper_word')
                ->find_all()
                ->as_array();

            // create a proper array of all the words
            $words = array();
            foreach($improper_words as $iw) {
                $words[] = $iw->word;
            }

            if(!empty($words)) {
                // check if the any of the word exists in the message posted
                $word_exists = preg_match('/('.implode('|', $words).')/i', $post_data['message']);

                if($word_exists) { // return with an error.
                    echo json_encode(array('status' => '0', 'message' => 'This review contains some improper words that are not allowed.'));
                    exit;
                }
            }

            $user_to = ORM::factory('user', array('email' => $this->request->query('email')));
            if(!$user_to->id)
            {
                $user_to = ORM::factory('user')->create_non_registered_user($this->request->query('email'));
            }
            if($user->email === $user_to->email)
            {
                Session::instance()->set('error', 'You can\'t review yourself.');
                echo json_encode(array('status'=>'0','message'=>'You can\'t review yourself.'));
                exit;
            }
            if(!$this->request->query('edit_recommend') && ORM::factory('recommend')->where('to', '=', $user_to->id)->where('from', '=', $user->id)->count_all())
            {
                $already    = ORM::factory('recommend')
                            ->where('to', '=', $user_to->id)
                            ->where('from', '=', $user->id)
                            ->find();
                $responce   = array(
                            'status'=> 1,
                            'message'=> 'you have already reviewed. Please edit the review',
                            'email'=> $user_to->email,
                            'review_id'=>$already->id,
                            'about'=> $already->message,
                            'words'=> $already->words,
                            'relation'=> $already->relation
                        );
                echo json_encode($responce);
                exit;
            }
            else
            {
                if($this->request->query('edit_recommend')) 
                {
                    $recommend = ORM::factory('recommend', $this->request->query('edit_recommend'));
                    $post_data['status'] = 'pending';
                }
                else 
                {
                    $recommend = ORM::factory('recommend');
                    $post_data['to'] = $user_to->id;
                    $post_data['from'] = Auth::instance()->get_user()->id;
                }
                if(!isset($post_data['words']))
                {
                    //session::instance()->set('error-check',"This field is required.");
                    echo json_encode(array('status'=>'0','message'=>'This field is required.'));
                    exit;
                }
                $post_data['words'] = $post_data['words'];
                $post_data['time'] = date("Y-m-d H:i:s");
                $recommend->values($post_data);
                $recommend->save();

                if($user->rec_req->where('from', '=', $user_to->id)->count_all()) 
                {
                    $user->rec_req->where('from', '=', $user_to->id)->find()->delete();
                }
                    /*$this->activity = new Model_Activity;
                    $this->activity->new_activity_api('new_recommend', ' has reviewed you', $recommend->id, $user_to->id);*/
               /* if($user_to->user_detail->rec_alert) 
                {
                    $from = ORM::factory('user',array('username'=>$this->request->query('username')));
                    $send_email = Email::factory('Review from '.$from->user_detail->first_name .' '.$from->user_detail->last_name)
                                ->message(View::factory('mails/Api/new_recommend_mail_api', array('user_to' => $user_to, 'message' => $recommend->message, 'username' => $from->username))->render(), 'text/html')
                                ->to($user_to->email)
                                ->from('noreply@callitme.com', 'Callitme')
                                ->send();
                }*/
                echo json_encode(array('status'=>1,'message'=>'Your review has been successfully sent.'));
                exit;
            }
        }
    }


    public function action_send_annonymaous()
    {
        $user = Auth::instance()->get_user();
        if($this->request->query()) 
        {
            $post_data = $this->request->query();
            $post_data['message'] = strip_tags($post_data['message'], "<br>");

            // fetch all the improper words that are there in the database
            $improper_words = ORM::factory('improper_word')
                ->find_all()
                ->as_array();

            // create a proper array of all the words
            $words = array();
            foreach($improper_words as $iw) {
                $words[] = $iw->word;
            }

            if(!empty($words)) {
                // check if the any of the word exists in the message posted
                $word_exists = preg_match('/('.implode('|', $words).')/i', $post_data['message']);

                if($word_exists) { // return with an error.
                    echo json_encode(array('status' => '0', 'message' => 'This review contains some improper words that are not allowed.'));
                    exit;
                }
            }

            $user_to = ORM::factory( 'user', array('email' => $post_data['email']));
            if(!$user_to->id)
            {
                $user_to = ORM::factory('user')->create_non_registered_user($post_data['email']);
            }

            if($user->email === $user_to->email)
            {
                //Session::instance()->set('error', 'You can\'t review yourself.');
                echo json_encode(array('status'=>0,'message'=>'You can\'t review yourself.'));
                exit;
                //$this->request->redirect(url::base()."peoplereview/compose");
            }

            if(!$this->request->query('edit_recommend') && ORM::factory('recommend')->where('to', '=', $user_to->id)->where('from', '=', $user->id)->count_all())
            {
                $already = ORM::factory('recommend')->where('to', '=', $user_to->id)->where('from', '=', $user->id)->find();
                /*$msg = "You have already reviewed ".$user_to->user_detail->first_name .".
                You can <a href=\"".url::base()."peoplereview/compose/".$already->id."\">Edit the review</a> you wrote for ".$user_to->user_detail->first_name;
                */
                //Session::instance()->set('error', $msg);
                $responce = array(
                        'status'=> 1,
                        'message'=> 'you have already reviewed. Please edit the review',
                        'email'=> $user_to->email,
                        'review_id'=>$already->id,
                        'about'=> $already->message,
                        'words'=> $already->words,
                        'relation'=> $already->relation
                        );
                echo json_encode($responce);
                exit;
                //$this->request->redirect(url::base()."peoplereview/compose");

            }
            else
            {

                if($this->request->query('edit_recommend')) 
                {
                    $recommend = ORM::factory('recommend', $this->request->query('edit_recommend'));
                    $post_data['status'] = 'pending';
                }
                else 
                {
                    $recommend = ORM::factory('recommend');
                    $post_data['to'] = $user_to->id;
                    $post_data['from'] =  Auth::instance()->get_user()->id;
                }

                if(!isset($post_data['words']))
                {
                    //session::instance()->set('error-check',"Please check the words that describe the person");
                    echo json_encode(array('status'=>0,'message'=>'Please check the words that describe the person'));
                    exit;
                    //$this->request->redirect(url::base()."peoplereview");
                }

                $post_data['words'] =$post_data['words'];
                $post_data['time'] = date("Y-m-d H:i:s");
                $post_data['type'] ='0';
                $post_data['state'] ='approve';
                $recommend->values($post_data);
                $recommend->save();
                if($user->rec_req->where('from', '=', $user_to->id)->count_all()) 
                {
                    $user->rec_req->where('from', '=', $user_to->id)->find()->delete();
                }
                /*$this->activity = new Model_Activity;
                $this->activity->new_s_activity('anon_recommend', ' has reviewed you', $recommend->id, $user_to->id, $user->id);
                if($user_to->user_detail->rec_alert)
                {
                     //send email
                     $from = ORM::factory('user',array('username'=>$this->request->query('username')));
                     $send_email = Email::factory('Review from  Anonymous user')
                         ->message(View::factory('mails/Api/new_rec_anon_api', array('user_to' => $user_to,'username'=>$from->username, 'message' => $recommend->message))->render(), 'text/html')
                         ->to($user_to->email)
                        //->to('pgoswami@maangu.com')
                         ->from('noreply@callitme.com', 'Callitme')
                         ->send();
                }*/
                echo json_encode(array('status'=>1, 'message'=>'Your review has been successfully sent.'));
                exit;
            }
        }
        echo "Review Anonymously";
        exit;
    }
    
    public function action_send_success()
    {
        $user = Auth::instance()->get_user();
        $data['relations'] = ORM::factory('recommend_relation')->find_all()->as_array();
        $data['words'] = ORM::factory('recommend_word')->find_all()->as_array();

        if($this->request->param('id')) 
        {
            $data['recommend'] = ORM::factory('recommend', $this->request->param('id'));
        }
        if($this->request->query('ask')) 
        {
            $data['user_to'] = ORM::factory('user', array('username' => $this->request->query('ask')));
        }
        if($this->request->post('email')) 
        {
            if($user->email === $this->request->post('email')) 
            {
                Session::instance()->set('error', 'You can\'t review yourself.');
                $this->request->redirect(url::base()."peoplereview/send_success");
            }
            $user_to    = ORM::factory('user')
                        ->where('email', '=',  $this->request->post('email'))
                        ->where('not_registered', '=', 0)
                        ->find();
            if($user_to->id) 
            {
                $data['user_to'] = $user_to;
                if($user_to->user_detail->sex) 
                {
                    $data['relations']  = ORM::factory('recommend_relation')
                                        ->where('gender', '=', $user_to->user_detail->sex)
                                        ->or_where('gender', '=', '')
                                        ->find_all()
                                        ->as_array();
                }
            }
        }
        $check_arr=  array();
        $user = Auth::instance()->get_user();
        $user_alreay=ORM::factory('recommend')->where('from', '=', $user->id)->find_all()->as_array();
        $i=0;
        foreach($user_alreay as $al_id)
        {
            $check_arr[$i]=$al_id->to;
            $i++;
        }
        $userss = ORM::factory('user')->with('user_detail')
                ->where('user.id', 'NOT IN', $check_arr)
                ->where('is_deleted', '=', 0)
                ->limit(8)
                ->order_by(DB::expr('RAND()'))->find_all()->as_array();
        $send_success = array();            
        foreach ($userss as $item_s) 
        {
            if($item_s->photo->profile_pic_s)
            {
                $send_success_pic = url::base()."upload/".$item_s->photo->profile_pic_s;
            }
            else
            {
               if(!empty($item_s->user_detail->sex))
               {
                   if($item_s->user_detail->sex=='Male' || $item_s->user_detail->sex=='male')
                    {
                        $send_success_pic = url::base()."upload/avatar5.png";
                    }
                    if($item_s->user_detail->sex=='Female' || $item_s->user_detail->sex=='female')
                    {
                        $send_success_pic = url::base()."upload/avatar2.png";
                    }   
               }
                $name   = $item_s->user_detail->first_name." ".$item_s->user_detail->last_name;
                                       $details = array();
                                        if(!empty($item_s->user_detail->sex)) 
                                        {
                                            $details[] = $item_s->user_detail->sex;
                                        }
                                        if(!empty($item_s->user_detail->phase_of_life)) 
                                        {
                                            $phase_of_life = Kohana::$config->load('profile')->get('phase_of_life');
                                            $details[] = $phase_of_life[$item_s->user_detail->phase_of_life];
                                        }
                                        $status = implode(', ', $details);
            }   
            $send_success[] = array('profile_pic'=>$send_success_pic,'Name'=>$name,'Status'=>$status,'Review'=>url::base()."peoplereviewapi/compose?ask=".$item_s->username);       
        } 
        echo json_encode(array('Status'=>'1','Review More People'=>$send_success));
        exit;                   
    }
    public function action_state()
    {
        //$this->auto_render = false;
        if($this->request->query()) 
        {
            $post_data = $this->request->query();
            $user = Auth::instance()->get_user();
            $recommend = ORM::factory('recommend', $post_data['recommend']);
            if($recommend->recommend_to->id == $user->id) 
            {
                $r_previous = $recommend->state;
                $recommend->values(array('state' => $post_data['state']));
                $recommend->save();
                if($post_data['state'] === 'approve' && ($r_previous === 'pending' || $r_previous === 'decline')) {
                    $this->post = new Model_Post;
                    $str = $recommend->recommend_to->user_detail->first_name." is ".$recommend->owner->user_detail->first_name."'s ".$recommend->relation;
                    $post = $this->post->new_post('recommend', $str.".\n".$recommend->message, " is reviewed by @".$recommend->owner->username , $recommend->recommend_to->id);
                    $this->activity = new Model_Activity;
                    $this->activity->new_activity('recommend', " is reviewed by @".$recommend->owner->username, $post->id, '', $recommend->recommend_to->id);
                }
                //social score
                $recommendations = $user->recommendations->where('state', '=', 'approve')->find_all()->as_array();
                $temp_words = array();
                foreach($recommendations as $recommend) {
                    if($recommend->state == 'approve') { 
                        $words = explode(', ', $recommend->words);
                        $temp_words = array_merge($temp_words, $words);
                    }
                }
                $tags = array_count_values($temp_words);
                $social = $user->calculate_social_percentage($tags);
                Session::instance()->set('social', $social);
                //echo $r_previous.$post_data['state'];
                echo json_encode(array('status'=> 1, 'message' => $post_data['state']));
                exit;
                //exit;
            }
        }
            echo "Approve review, Declined review, show review or hide review";
    }
    public function action_askreview() 
    {
        $user = $this->request->query();
        $data = array();
        if($this->request->query('ask')) 
        {
            $data['user_to'] = ORM::factory('user', array('username' => $this->request->query('ask')));
            echo json_encode(array('Status'=>'1','User Email'=>$data['user_to']->email));
            exit;
         }
        if($this->request->query()) 
        {
            $post_data = $this->request->query();
            if($user->email === $post_data['email']) 
            {
                Session::instance()->set('error', 'You can\'t ask for a review from yourself.');
                echo json_encode(array('status'=>0, 'message'=>'You can\'t ask for a review from yourself.'));
                exit;
            } 
            else 
            {
                $user_to = ORM::factory('user', array('email' => $post_data['email']));
                if(!$user_to->id) 
                {
                    $recommendations = $user->recommendations->where('state', '=', 'approve')->order_by('time', 'desc')->find_all()->as_array();
                    $temp_words = array();
                    foreach($recommendations as $recommend) 
                    {
                        $words = explode(', ', $recommend->words);
                        $temp_words = array_merge($temp_words, $words);
                    }
                    $tags = array_count_values($temp_words);
                    $user_to = ORM::factory('user')->create_non_registered_user($post_data['email']);
                    ORM::factory('invite')->send_invite($user, $user_to, $tags);
                }
                if(ORM::factory('recommend')->where('to', '=', $user->id)->where('from', '=', $user_to->id)->count_all()) 
                {
                    $msg = $user_to->user_detail->first_name ." ".$user_to->user_detail->last_name ." has already reviewed you once. 
                    ".$user_to->user_detail->first_name ." cannot review you again.";
                    $responce =array(
                                'status' =>1,
                                'message'=>$msg,
                                );
                        echo json_encode($responce);
                        exit;
                }
                else 
                {
                    $ask = ORM::factory('recommend_request');
                    $post_data['to'] = $user_to->id;
                    $post_data['from'] = Auth::instance()->get_user();
                    $post_data['message'] = $post_data['message'];
                    $post_data['time'] = date("Y-m-d H:i:s");
                    $ask->values($post_data);
                    $ask->save();
                    $this->activity = new Model_Activity;
                    $this->activity->new_activity_api('askreview', ' has requested for a review', $ask->id, $user_to->id, $user->id);
                    if($user_to->user_detail->rec_alert) 
                    {
                        $from = ORM::factory('user',array('username'=>$post_data['username']));
                        $send_email = Email::factory('Request to Review from '.$from->user_detail->first_name .' '.$from->user_detail->last_name)
                                    ->message(View::factory('mails/Api/recommend_request_mail_api', array('to' => $user_to,'username'=>$from->username))->render(), 'text/html')
                                    ->to($user_to->email)
                                    ->from('noreply@callitme.com', 'Callitme')
                                    ->send();
                    }
                    echo json_encode(array('status'=>1, ',message'=>'Your request for review is sent successfully.'));
                    exit;
                }
            }
        }
            $check_arr=  array();
            $user = Auth::instance()->get_user();
            $user_alreay=ORM::factory('recommend_request')->where('from', '=', $user->id)->find_all()->as_array();
            $i=0;
            foreach($user_alreay as $al_id)
            {
                 $check_arr[$i]=$al_id->to;
                 $i++; 
            }
            $userss = ORM::factory('user')->with('user_detail');
            if(count($check_arr)>0)
            {
                $userss->where('user.id', 'NOT IN', $check_arr);
            }
            $userss->where('is_deleted', '=', 0);
            $userss->limit(8);
            $userss->order_by(DB::expr('RAND()'));
            $userss=$userss->find_all()->as_array();
            $askreview_success = array();            
            foreach ($userss as $item_s) 
            {
                    if($item_s->photo->profile_pic_s)
                    {
                        $send_success_pic = url::base()."upload/".$item_s->photo->profile_pic_s;
                    }
                    else
                    {
                       if(!empty($item_s->user_detail->sex))
                       {
                           if($item_s->user_detail->sex=='Male' || $item_s->user_detail->sex=='male')
                            {
                                $send_success_pic = url::base()."upload/avatar5.png";
                            }
                            if($item_s->user_detail->sex=='Female' || $item_s->user_detail->sex=='female')
                            {
                                $send_success_pic = url::base()."upload/avatar2.png";
                            }   
                       }
                        $name   = $item_s->user_detail->first_name." ".$item_s->user_detail->last_name;
                                               $details = array();
                                                if(!empty($item_s->user_detail->sex)) 
                                                {
                                                    $details[] = $item_s->user_detail->sex;
                                                }
                                                if(!empty($item_s->user_detail->phase_of_life)) 
                                                {
                                                    $phase_of_life = Kohana::$config->load('profile')->get('phase_of_life');
                                                    $details[] = $phase_of_life[$item_s->user_detail->phase_of_life];
                                                }
                                                $status = implode(', ', $details);
                    }   
                    $askreview_success[] = array('profile_pic'=>$send_success_pic,'Name'=>$name,'Status'=>$status,'Ask Review'=>url::base()."peoplereviewapi/askreview?ask=".$item_s->username);       
            } 
        echo json_encode(array('Status'=>'1','Get reviewed from more people'=>$askreview_success));
        exit;
       }
    public function action_recommend_request() 
    {
        $user = Auth::instance()->get_user();
        $requests = $user->rec_req->order_by('time', 'desc')->find_all()->as_array();
        if(!empty($requests)) 
        {
            $responce = array();
            foreach($requests as $request) 
            {
                if($request->owner->photo->profile_pic_s) 
                {
                    $profile_pic = url::base()."upload/".$request->owner->photo->profile_pic_s;
                }
                else
                {
                    $profile_pic = "no_image_s.png";
                }
                 $time = time() - strtotime($request->time); 
                if ($time >= 86400) {
                    $req_time =  date('jS M', strtotime($request->time));
                } 
                else 
                {
                    $req_time =  date::time2string($time);
                }
                $username = $request->owner->username;
                $name = (($request->owner->user_detail->first_name) ? 
                                ($request->owner->user_detail->first_name ." ".$request->owner->user_detail->last_name) : 
                                ($request->owner->email));
                $message = nl2br($request->message);
                $request_id = $request->id;
                $responce[] =array(
                    'profile_pic' =>$profile_pic,
                    'req_time' =>$req_time,
                    'request_id' =>$request->id,
                    'username' =>$username,
                    'name' =>$name,
                    'message'=>$message
                    );
            }
            echo json_encode(array('status'=>1, 'message'=>'request for Review','requested_users'=> $responce));
            exit;
        }
        else
        {
            echo json_encode(array('status'=>1, 'message'=>'No one has requested a review from you.'));
            exit;
        }
    }
    public function action_delete_request() 
    {
        $this->auto_render = false;
        if($this->request->post()) {
            $recommend = ORM::factory('recommend_request', $this->request->post('request'));
            if($recommend->to == Auth::instance()->get_user()->id) 
            {
                $recommend->delete();
            }
            echo "deleted";
        }
    }
}
