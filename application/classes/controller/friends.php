<?php defined('SYSPATH') or die('No direct script access.');


class Controller_Friends extends Controller_Template {

    public $template = 'templates/profile';

    public function before()  {
        parent::before();

        if(!Auth::instance()->logged_in()) { //if not login redirect to login page
            $this->request->redirect('login');
        } else if( Auth::instance()->get_user()->registration_steps != 'done') {
            Auth::instance()->get_user()->check_registration_steps();
        }

        Auth::instance()->get_user()->check_plan_validity();
        //if request is ajax don't load the template
        if(!$this->request->is_ajax()) {
            $this->template->title = 'Welcome to Amygoz';
            $this->template->description = 'Find, meet and get inspired by great people.';
            $this->template->header = View::factory('templates/members-header');
            $this->template->sidemenu = View::factory('friends/sidebar', array('side_menu' => 'friends'));
            $this->template->footer = View::factory('templates/member-footer');
        }
    }

    public function action_add_friend() {
        $this->auto_render = false;
        
        if($this->request->post('friend_id') || $this->request->query('user')) {
            $invitee_id = $this->request->post('friend_id') ? $this->request->post('friend_id') : $this->request->query('user');
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
                    ->from('noreply@callitme.com', 'Amygoz')
                    ->send();
                }

                $response = array(
                    'status' => 'success',
                    'message' => 'sent',
                    'msg_code' => '200'
                );
            }

        } else if($this->request->post('del_request')) {
            $invitee_id = $this->request->post('del_request');
            $user = Auth::instance()->get_user();
            $invitee = ORM::factory('user')->where('id', '=', $invitee_id)->find();

            if ( $user->has('requests', $invitee)) {
                $user->remove('requests', $invitee);
                //echo "removed";
                $response = array(
                    'status' => 'success',
                    'message' => 'removed',
                    'msg_code' => '200'
                );
            }
        }
        echo json_encode($response);
    }

    public function action_accept_friend() {
        $this->auto_render = false;
        if($this->request->post('friend_id')) {
            $friend_id = $this->request->post('friend_id');
            $friend = ORM::factory('user')->where('id', '=', $friend_id)->find();
            $user = Auth::instance()->get_user();
            $recommendations = $user->recommendations->where('state', '=', 'approve')->order_by('time', 'desc')->find_all()->as_array();

            $temp_words = array();
            foreach($recommendations as $recommend) {
                $words = explode(', ', $recommend->words);
                $temp_words = array_merge($temp_words, $words);
            }
            $tags = array_count_values($temp_words);

            if ( ! $user->check_friends($friend) && $friend->has('requests', $user)) {
                $user->add('friends', $friend);
                $friend->add('friends', $user);
                $friend->remove('requests', $user);

                $this->post = new Model_Post;
                $post = $this->post->new_post('friend', "", " is now connected with @".$friend->username ." .");

                $this->activity = new Model_Activity;
                $this->activity->new_activity('friend', ' has accepted your friend request.', $post->id, $friend->id);

                if($friend->user_detail->friend_alert) {
                    //send email
                    $send_email = Email::factory($user->user_detail->first_name .' '.$user->user_detail->last_name .' has accepted your friend request')
                    ->message(View::factory('mails/friend_request_accepted_mail', array('to' => $friend, 'tag'=> $tags, 'recommendations' => $recommendations))->render(), 'text/html')
                    ->to($friend->email)
                    ->from('noreply@callitme.com', 'Amygoz')
                    ->send();
                }
                Session::instance()->set('Accepted','You are now connected with <a href="'.url::base().$friend->username.'">'.$friend->user_detail->get_name().'</a>');
                echo "accepted";
            } 
        } else {
            Session::instance()->set('error','Error Occured');
            echo "error";
        }

    }

    public function action_reject_request() {
        $this->auto_render = false;
        if($this->request->post('friend_id')) {
            $friend_id = $this->request->post('friend_id');
            $user = Auth::instance()->get_user();
            $friend = ORM::factory('user')->where('id', '=', $friend_id)->find();

            if ($friend->has('requests', $user)) {
                $friend->remove('requests', $user);
            }

            Session::instance()->set('Accepted','Friend Request Rejected');
            echo "rejected";
        } else {
            Session::instance()->set('error','Error Occured');
            echo "error";
        }
    }

    public function action_delete_friend() {
        $this->auto_render = false;
        if($this->request->post('friend_id')) {
            $friend_id = $this->request->post('friend_id');
            $friend = ORM::factory('user')->where('id', '=', $friend_id)->find();
            $user = Auth::instance()->get_user();

            if ($user->check_friends($friend)) {
                $user->remove('friends', $friend);
                $friend->remove('friends', $user);
            }

            echo "deleted";
        } else {
            echo "error";
        }
    }

    public function action_index() {
        $user = Auth::instance()->get_user();

        $this->template->title = $user->user_detail->first_name .' '.$user->user_detail->last_name;
        $this->template->content = View::factory('friends/index');
    }

    public function action_requests_sent() {
        $user = Auth::instance()->get_user();
        $this->template->title = $user->user_detail->first_name .' '.$user->user_detail->last_name;
        $this->template->content = View::factory('friends/requests_sent');
    }
    
    public function action_requests() {
        $user = Auth::instance()->get_user();
        $data['requests'] = ORM::factory('Request')->with('user')
            ->where('request_to', '=', $user->id)
            //->where('is_active', '=', '1')
            ->where('is_deleted', '!=', '1')
            ->order_by('date_requested', 'desc')
            ->find_all()
            ->as_array();

        $this->template->title = $user->user_detail->first_name .' '.$user->user_detail->last_name;
        $this->template->content = View::factory('friends/pending_requests', $data);
    }

    public function action_friends_for_noti() {
        if($this->request->is_ajax()) {
            $this->auto_render = false;
            $user = Auth::instance()->get_user();

            if($this->request->query('seen')) {
                $query = DB::update(ORM::factory('Request')->table_name())
                    ->set(array('seen' => 1))
                    ->where('request_to', '=', $user->id);
                
                $query->execute(); 
            } else {

                $data['requests'] = ORM::factory('Request')->with('user')
                    ->where('request_to', '=', $user->id)
                    //->where('is_active', '=', '1')
                    ->where('is_deleted', '!=', '1')
                    ->order_by('date_requested', 'desc')
                    ->limit(5)
                    ->find_all()
                    ->as_array();

                echo View::factory('friends/friends_for_noti', $data);
            }
        } else {
            $this->request->redirect(url::base()."friends/requests");
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

        $this->template->title = $user->user_detail->first_name .' '.$user->user_detail->last_name;
        $this->template->sidemenu = View::factory('templates/sidemenu_home', $data);
        $this->template->content = View::factory('friends/member', $data);
    }
}