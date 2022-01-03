<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Activityapi extends Controller_Template {
    public $template = 'templates/accessapi';
    public function before() 
    {
        parent::before();
        header('Content-Type: application/json');
        header("Access-Control-Allow-Origin: *"); 
        $headers = apache_request_headers();
        if(isset($headers['Authorization']))
        {
            $token  = ORM::factory('user_token')
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
        $data['plans'] = ORM::factory('arequest_plan')->find_all()->as_array();
        $data['abouts'] = ORM::factory('arequest_about')->find_all()->as_array();
        $data['whies'] = ORM::factory('arequest_why')->find_all()->as_array();
        $user = Auth::instance()->get_user();
        if($this->request->query('user')) 
        {
            $user_to = ORM::factory('user', array('username' => $this->request->query('user')));
            if(!$user_to->id || !$user->check_friends($user_to)) 
            {
                if($user->plan->r_to_anyone_used == $user->plan->r_to_anyone) 
                {
                    echo json_encode(array('error'=>'0','Message'=>'Please upgrade your plan to use this feature.'));
                    Session::instance()->set('redirect_url', 'activity?user='.$this->request->query('user'));
                    $this->request->redirect(url::base()."upgrade");
                }
            }
        }
        $data['arequests'] = $user->arequests->find_all()->as_array();
        $this->template->title = 'Callitme';
        $this->template->content = View::factory('arequest/home', $data);
    }

    public function action_view() 
    {
        $user = Auth::instance()->get_user();
        $arequest_id = $this->request->param('id');
        $arequest = ORM::factory('arequest', $arequest_id);
        if(!$arequest->id) 
        {
            $this->request->redirect(url::base());
        }
        if($this->request->post()) 
        {
            if($this->request->post('arequest_action') == 'delete') 
            {
                foreach($arequest->members->find_all()->as_array() as $mem) 
                {
                    $mem->delete();
                }
                $arequest->delete();
                echo json_encode(array('main_success'=>'1', 'Message'=>'Request deleted.'));
                exit;
            } 
            else 
            {
                $accepted = $this->request->post('arequest_action');
                if($arequest->from == $accepted) 
                {
                    if($arequest->request_to->user_detail->req_alert) 
                    {
                        //send email
                        $send_email = Email::factory('Callitme | Request Match')
                        ->message(View::factory('mails/arequest_match_receiver_mail', array('arequest' => $arequest))->render(), 'text/html')
                        ->to($arequest->request_to->email)
                        ->from('noreply@Callitme.com', 'Callitme')
                        ->send();
                    }
                    if($arequest->owner->user_detail->req_alert) 
                    {
                        //send email
                        $send_email = Email::factory('Congratulations!')
                        ->message(View::factory('mails/arequest_match_sender_mail', array('arequest' => $arequest))->render(), 'text/html')
                        ->to($arequest->owner->email)
                        ->from('noreply@Callitme.com', 'Callitme')
                        ->send();
                    }
                    $this->activity = new Model_Activity;
                    $msg = 'Congratulations! '.$arequest->request_to->user_detail->first_name .' has accepted your '.$arequest->plan .' request';
                    $this->activity->new_activity('arequest_match', $msg, $arequest->request_to->id, $arequest->owner->id);
                    $msg = 'Surprise! You accepted '.$arequest->owner->user_detail->first_name .' 
                        '.$arequest->owner->user_detail->last_name .'\'s '.$arequest->plan .' request.';
                    $this->activity->new_activity('arequest_match', $msg, $arequest->owner->id, $arequest->request_to->id, $arequest->owner->id);
                } 
                else 
                {
                    $user_to = ORM::factory('user', $accepted);
                    $new_arequest = ORM::factory('arequest');
                    $s_friends = $user->friends_by_gender($user->user_detail->sex);
                    $arequest_people = $new_arequest->fetch_request_members($user, $user_to, $s_friends);
                    if(count($arequest_people) >= 6) 
                    {
                        $arequest_data['to'] = $user_to->id;
                        $arequest_data['from'] = $user->id;
                        $arequest_data['plan'] = $arequest->plan;
                        $arequest_data['about'] = $arequest->about;
                        $arequest_data['why'] = $arequest->why;
                        $arequest_data['message'] = $arequest->message;
                        $arequest_data['time'] = date("Y-m-d H:i:s");
                        $new_arequest->values($arequest_data);
                        $new_arequest->save();
                        $arequest_id = $new_arequest->id;
                        shuffle($arequest_people);
                        foreach($arequest_people as $person) 
                        {
                            $amember = ORM::factory('arequest_member');
                            $amember->arequest_id = $arequest_id;
                            $amember->user_id = $person->id;
                            $amember->save();
                        }
                        $this->activity = new Model_Activity;
                        $this->activity->new_activity('arequest', ' You have a new '.$arequest->plan.' request.', $arequest_id, $user_to->id);
                        if($user_to->user_detail->req_alert) 
                        {
                            $send_email = Email::factory($arequest->plan .' Request from Callitme Member')
                            ->message(View::factory('mails/new_arequest_mail', array('arequest' => $new_arequest))->render(), 'text/html')
                            ->to($user_to->email)
                            ->from('noreply@Callitme.com', 'Callitme')
                            ->send();
                        }
                    }
                }
                foreach($arequest->members->find_all()->as_array() as $mem) 
                {
                    $mem->delete();
                }
                $arequest->delete();
            }
            $this->request->redirect(url::base());
        }
        /*$data['arequest'] = $arequest;
        $this->template->content = View::factory('arequest/view', $data);*/
    }

    public function action_send()
    {
        $user = Auth::instance()->get_user();
        if($this->request->query())
        {
            if($user->email === $this->request->query('email'))
            {
                echo json_encode(array('error'=>'flase','Message'=>'You can\'t send a request to yourself.'));
                exit;
            }
            $user_to = ORM::factory('user',array('email'=>$this->request->query('email')));
            if($user->user_detail->sex === $user_to->user_detail->sex)
            {
               echo json_encode(array('error'=>'flase','Message'=>'Anonymous requests between same gender is not allowed.'));
               exit; 
            }
            $s_friends = $user->friends_by_gender($user->user_detail->sex);
            if(count($s_friends) >= 7) 
            {
                $post_data = $this->request->query();
                if(!$user_to->id || !$user->check_friends($user_to)) 
                {
                    if($user->plan->r_to_anyone_used == $user->plan->r_to_anyone) 
                    {
                        echo json_encode(array('error'=>'0', 'Sorry'=>'you have used all requests allowed under your current plan. Please upgrade to continue.'));
                        $redirect_url = ($user_to->id) ? 'activity?user='.$user_to->username : 'activity';
                        Session::instance()->set('redirect_url', $redirect_url);
                        $this->request->redirect(url::base()."upgrade");
                    } 
                    else 
                    {
                        $user->plan->r_to_anyone_used = $user->plan->r_to_anyone_used + 1;
                        $user->plan->save();
                    }
                } 
                else 
                {
                    if($user->plan->r_to_friend_used == $user->plan->r_to_friend) 
                    {
                        echo json_encode(array('error'=>'0', 'Sorry'=>'you have used all requests allowed under your current plan. Please upgrade to continue.'));
                        $redirect_url = ($user_to->id) ? 'activity?user='.$user_to->username : 'activity';
                        Session::instance()->set('redirect_url', $redirect_url);
                        $this->request->redirect(url::base()."upgrade");
                       
                    } 
                    else 
                    {
                        $user->plan->r_to_friend_used = $user->plan->r_to_friend_used + 1;
                        $user->plan->save();
                    }
                }

                if(!$user_to->id) 
                {
                    $user_to = ORM::factory('user')->create_non_registered_user($this->request->query('email'));
                }
                $arequest = ORM::factory('arequest');
                $arequest_people = $arequest->fetch_request_members($user, $user_to, $s_friends); 
                shuffle($arequest_people);
                $arequest_data['to'] = $user_to->id;
                $arequest_data['from'] = $user->id;
                $arequest_data['plan'] = $this->request->query('plan');
                $arequest_data['about'] = $this->request->query('about');
                $arequest_data['why'] = $this->request->query('why');
                $arequest_data['message'] = $this->request->query('message');
                $arequest_data['time'] = date("Y-m-d H:i:s");
                $arequest->values($arequest_data);
                $arequest->save();
                $arequest_id = $arequest->id;
                foreach($arequest_people as $person) 
                {
                    $amember = ORM::factory('arequest_member');
                    $amember->arequest_id = $arequest_id;
                    $amember->user_id = $person->id;
                    $amember->save();
                }
                $this->activity = new Model_Activity;
                $this->activity->new_activity('arequest', ' You have a new '.$this->request->post('plan').' request.', $arequest_id, $user_to->id);
                if($user_to->user_detail->req_alert) 
                {
                    $from = Auth::instance()->get_user();
                    $send_email = Email::factory($arequest->plan .' Request from Callitme Member')
                    ->message(View::factory('mails/new_arequest_mail', array('arequest' => $arequest))->render(), 'text/html')
                    ->to($user_to->email)
                    ->from('noreply@Callitme.com', 'Callitme')
                    ->send();
                }
                echo json_encode(array('main_success'=>'true','message'=>'Your request has been sent.'));
                exit;
            } 
            else 
            {
                echo json_encode(array('main_error'=>'0', 'Sorry'=>'you need to add more contacts to play this game. Please add more contacts to your profile.'));
                exit;
            }    
        }
    }
}