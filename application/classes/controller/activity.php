<?php defined('SYSPATH') or die('No direct script access.');


class Controller_Activity extends Controller_Template {

    public $template = 'templates/profile';
    
    public function before() 
    {
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

            $this->template->title = 'Build your social personality profile with people review site | Callitme';
            $this->template->description = 'Callitme is your personal network where you can match your single friends,
                review people you know, find singles around you and send requests to your crush anonymously.';
            $this->template->header = View::factory('templates/members-header');
            $this->template->sidemenu = View::factory('templates/activity_sidemenu', array('side_menu' => 'arequest'));
            $this->template->footer = View::factory('templates/member-footer');
        }
    }
    
    public function action_index() {
        $data['plans'] = ORM::factory('arequest_plan')->find_all()->as_array();
        $data['abouts'] = ORM::factory('arequest_about')->find_all()->as_array();
        $data['whies'] = ORM::factory('arequest_why')->find_all()->as_array();

        $user = Auth::instance()->get_user();
        
        if($this->request->query('user')) {
            $user_to = ORM::factory('user', array('username' => $this->request->query('user')));
            
            if(!$user_to->id || !$user->check_friends($user_to)) {

                if($user->plan->r_to_anyone_used == $user->plan->r_to_anyone) {
                    Session::instance()->set('error', 'Please upgrade your plan to use this feature.');

                    Session::instance()->set('redirect_url', 'activity?user='.$this->request->query('user'));
                    $this->request->redirect(url::base()."upgrade");
                }

            }
        }
        
        $data['arequests'] = $user->arequests->find_all()->as_array();
        $this->template->title = 'Callitme';
        $this->template->content = View::factory('arequest/home', $data);
    }

    public function action_view() {
        $user = Auth::instance()->get_user();
        $arequest_id = $this->request->param('id');

        $arequest = ORM::factory('arequest', $arequest_id);

        if(!$arequest->id) {
            $this->request->redirect(url::base());
        }

        if($this->request->post()) {

            if($this->request->post('arequest_action') == 'delete') {

                foreach($arequest->members->find_all()->as_array() as $mem) {
                    $mem->delete();
                }
                $arequest->delete();

                Session::instance()->set('main_success', 'Request deleted.');
            } else {
                $accepted = $this->request->post('arequest_action');

                if($arequest->from == $accepted) {

                    if($arequest->request_to->user_detail->req_alert) {
                        //send email
                        $send_email = Email::factory('Callitme | Request Match')
                        ->message(View::factory('mails/arequest_match_receiver_mail', array('arequest' => $arequest))->render(), 'text/html')
                        ->to($arequest->request_to->email)
                        ->from('noreply@Callitme.com', 'Callitme')
                        ->send();
                    }

                    if($arequest->owner->user_detail->req_alert) {
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

                } else {

                    $user_to = ORM::factory('user', $accepted);
                    $new_arequest = ORM::factory('arequest');
                    $s_friends = $user->friends_by_gender($user->user_detail->sex);

                    $arequest_people = $new_arequest->fetch_request_members($user, $user_to, $s_friends);

                    if(count($arequest_people) >= 6) {
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

                        foreach($arequest_people as $person) {
                            $amember = ORM::factory('arequest_member');
                            $amember->arequest_id = $arequest_id;
                            $amember->user_id = $person->id;
                            $amember->save();
                        }
                        
                        $this->activity = new Model_Activity;
                        $this->activity->new_activity('arequest', ' You have a new '.$arequest->plan.' request.', $arequest_id, $user_to->id);
                        
                        if($user_to->user_detail->req_alert) {
                            //send email
                            $send_email = Email::factory($arequest->plan .' Request from Callitme Member')
                            ->message(View::factory('mails/new_arequest_mail', array('arequest' => $new_arequest,'user_to'=>$user_to))->render(), 'text/html')
                            ->to($user_to->email)
                            ->from('noreply@Callitme.com', 'Callitme')
                            ->send();
                        }
                    }

                }
             /*i am doing a comment for a short time this code delete a data and notifaction from database pankaj sir says do this action 20-09-17*/    
                /*foreach($arequest->members->find_all()->as_array() as $mem) {
                    $mem->delete();
                }
                $arequest->delete();*/

            }

            $this->request->redirect(url::base());
        }

        $data['arequest'] = $arequest;
        $this->template->content = View::factory('arequest/view', $data);
    }

    public function action_send() {
        $user = Auth::instance()->get_user();

        if($this->request->post()) {
            $post_data = $this->request->post();
            if(empty($post_data['email'])) {
                session::instance()->set('error-email', "Please enter a valid email address or select any registered member.");
                $this->request->redirect(url::base()."activity");
            }

            if($user->email === $this->request->post('email')) {
                Session::instance()->set('error', 'You can\'t send a request to yourself.');
                $this->request->redirect(url::base()."activity");
            }

            $user_to = ORM::factory('user', array('email' => $this->request->post('email')));

            if($user->user_detail->sex === $user_to->user_detail->sex) {
                Session::instance()->set('error', 'Anonymous requests between same gender is not allowed.');
                $this->request->redirect(url::base()."activity");
            }

            $s_friends = $user->friends_by_gender($user->user_detail->sex);
            $not_callitme_user = $this->request->post('email');
            if($user_to->email === $user_to->not_registered)
            {  
                    $from = Auth::instance()->get_user();
                    $send_email = Email::factory('Invite')
                                ->message(View::factory('mails/new_user_register_mail', array('plan' => $this->request->post('plan'),'message'=>$this->request->post('message')))->render(), 'text/html')
                                ->to($not_callitme_user)
                                ->from('noreply@Callitme.com', 'Callitme')
                                ->send();
                Session::instance()->set('main_success', 'Your request has been sent.');
                $this->request->redirect(url::base()."activity");   
            }
            //else if(count($s_friends) >= 7) 
             else if($s_friends >= 7) {
                $post_data = $this->request->post();

                if(!$user_to->id || !$user->check_friends($user_to)) {

                    if($user->plan->r_to_anyone_used == $user->plan->r_to_anyone) {
                        Session::instance()->set('error', 'Sorry, you have used all requests allowed under your current plan. Please upgrade to continue.');

                        $redirect_url = ($user_to->id) ? 'activity?user='.$user_to->username : 'activity';
                        Session::instance()->set('redirect_url', $redirect_url);
                        $this->request->redirect(url::base()."upgrade");
                    } else {
                        $user->plan->r_to_anyone_used = $user->plan->r_to_anyone_used + 1;
                        $user->plan->save();
                    }

                } else {

                    if($user->plan->r_to_friend_used == $user->plan->r_to_friend) {
                        Session::instance()->set('error', 'Sorry, you have used all requests allowed under your current plan. Please upgrade to continue.');
                        
                        $redirect_url = ($user_to->id) ? 'activity?user='.$user_to->username : 'activity';
                        Session::instance()->set('redirect_url', $redirect_url);
                        $this->request->redirect(url::base()."upgrade");
                    } else {
                        $user->plan->r_to_friend_used = $user->plan->r_to_friend_used + 1;
                        $user->plan->save();
                    }

                }

                if(!$user_to->id) {
                    $user_to = ORM::factory('user')->create_non_registered_user($this->request->post('email'));
                }

                $arequest = ORM::factory('arequest');
                $arequest_people = $arequest->fetch_request_members($user, $user_to, $s_friends);
                
                shuffle($arequest_people);

                $arequest_data['to'] = $user_to->id;
                $arequest_data['from'] = $user->id;
                $arequest_data['plan'] = $this->request->post('plan');
                $arequest_data['about'] = $this->request->post('about');
                $arequest_data['why'] = $this->request->post('why');
                $arequest_data['message'] = $this->request->post('message');
                $arequest_data['time'] = date("Y-m-d H:i:s");
                $arequest->values($arequest_data);
                $arequest->save();
                $arequest_id = $arequest->id;

                foreach($arequest_people as $person) {
                    $amember = ORM::factory('arequest_member');
                    $amember->arequest_id = $arequest_id;
                    $amember->user_id = $person->id;
                    $amember->save();
                }

                $this->activity = new Model_Activity;
                $this->activity->new_activity('arequest', ' You have a new '.$this->request->post('plan').' request.', $arequest_id, $user_to->id);

                if($user_to->user_detail->req_alert) {
                    //send email
                    
                    $from = Auth::instance()->get_user();
                    $send_email = Email::factory($arequest->plan .' Request from Callitme Member')
                    ->message(View::factory('mails/new_arequest_mail', array('arequest' => $arequest,'user_to'=>$user_to))->render(), 'text/html')
                    ->to($user_to->email)
                    ->from('noreply@Callitme.com', 'Callitme')
                    ->send();
                }

                Session::instance()->set('main_success', 'Your request has been sent.');
            } else {
                Session::instance()->set('main_error', 'Sorry, you need to add more contacts to play this game. Please add more contacts to your profile.');
            }

        }

        $this->request->redirect(url::base()."activity");
    }
}