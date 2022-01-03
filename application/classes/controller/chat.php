<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Chat extends Controller_Template {

    public $template = 'templates/chat';
    
    public function before() {
        parent::before();

        if(!Auth::instance()->logged_in()) { //if not login redirect to login page
            $this->request->redirect('pages/login');
        } else if( Auth::instance()->get_user()->registration_steps != 'done') {
            Auth::instance()->get_user()->check_registration_steps();
        }
        
        Auth::instance()->get_user()->check_plan_validity();
        //if request is ajax don't load the template
        if(!$this->request->is_ajax()) {
            $this->template->title = Auth::instance()->get_user()->user_detail->get_name();

            $this->template->header = View::factory('templates/members-header');
            $this->template->footer = View::factory('templates/member-footer');
        }

    }

    public function action_index() {
        $session_user = Auth::instance()->get_user();
        
        $chats = ORM::factory('chat')
        ->where_open()
            ->where_open()
                ->where('user_to', '=', $session_user->id)
                ->where('to_deleted', '=', 0)
            ->where_close()
            ->or_where_open()
                ->where('user_from', '=', $session_user->id)
                ->where('from_deleted', '=', 0)
            ->or_where_close()
        ->where_close()
        ->order_by('last_message_time', 'desc')
        ->find_all()
        ->as_array();
        
        if(empty($chats)) {
            $this->request->redirect(url::base().'chat/compose');
        } else {
            $chat = $chats[0];
            $other_user = ($chat->from->id != Auth::instance()->get_user()->id) ? $chat->from : $chat->to;
            
            $this->request->redirect(url::base().'chat/view_message/'. $other_user->username);
        }
    }
    
    public function action_compose() {
        if(!Auth::instance()->logged_in()) { //if not login redirect to login page
            $this->request->redirect('pages/login');
        }
        $user = Auth::instance()->get_user();
       
        $data = array();
        if($this->request->query('user') && !$this->request->post('message')) {
            $user_to = ORM::factory('user', array('username' => $this->request->query('user')));

            if($user_to->id) {
                $chat = ORM::factory('chat')->get_conversation($user, $user_to);

                if(!empty($chat->id)) {
                    $deleted = ($chat->user_to == $user->id) ? $chat->to_deleted : $chat->from_deleted;
                    if(!$deleted) {
                        $this->request->redirect(url::base().'chat/view_message/'.$user_to->username);
                    }
                }

            }

            $data['user_to'] = $user_to;
        }

        if($this->request->post('message')) {
            $user_to = ORM::factory('user', array('email' => $this->request->post('email')));

            $proceed = true;
            if(!$user_to->id || !$user->check_friends($user_to)) {

                if($user->plan->m_to_anyone_used == $user->plan->m_to_anyone) {
                    Session::instance()->set('error', 'Sorry, you have used all your requests, please upgrade to continue');
                    $proceed = false;
                } else {
                    $user->plan->m_to_anyone_used = $user->plan->m_to_anyone_used + 1;
                    $user->plan->save();
                }

            }

            if($proceed) {
                if(!$user_to->id) {
                    $user_to = ORM::factory('user')->create_non_registered_user($this->request->post('email'));
                }

                $chat = ORM::factory('chat')->create_conversation($user, $user_to, $this->request->post('code'));

                $chat->last_message = $this->request->post('message');
                $chat->last_message_from = $user->id;
                $chat->last_message_time = date("Y-m-d H:i:s");
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

                //Session::instance()->set('success', 'Your message has been sent!');
                $this->request->redirect(url::base()."chat/view_message/".$user_to->username);
            } else {
                $redirect_url = ($user_to->id) ? 'chat/compose?user='.$user_to->username : 'chat/compose';
                Session::instance()->set('redirect_url', $redirect_url);
                $this->request->redirect(url::base()."upgrade");
            }

        }

        $this->template->content = View::factory('chat/send_message', $data);
    }
    
    public function action_check_message_allowed() {
        $this->auto_render = false;
        $user = Auth::instance()->get_user();
        $output = array('allowed' => true, 'code' => '');
        if($this->request->post('email')) {
            $user_to = ORM::factory('user', array('email' => $this->request->post('email')));

            $proceed = true;
            if(!$user_to->id || !$user->check_friends($user_to)) {

                if($user->plan->m_to_anyone_used == $user->plan->m_to_anyone) {
                    $output['allowed'] = false;
                }

            }
            
            if($user_to->id) {
                $chat = ORM::factory('chat')->get_conversation($user, $user_to);
                if($chat->id) {
                    $output['code'] = $chat->code;
                } else {
                    $output['code'] = '';
                }
            }
        }
        
        echo json_encode($output);
    }
    
    public function action_view_message() {
        $user = Auth::instance()->get_user();
        $user_to = $this->request->param('id');
        $user_to = ORM::factory('user', array('username' => $user_to));

        $chat = ORM::factory('chat')->get_conversation($user, $user_to);

        $data['chat'] = $chat;
        $this->template->content = View::factory('chat/view_chat', $data);
    }

    public function action_update_last_msg() {
        $this->auto_render = false;

        $user = Auth::instance()->get_user();
        $user_to = ORM::factory('user', array('username' => $this->request->param('id')));
        $chat = ORM::factory('chat')->get_conversation($user, $user_to);
        
        if($this->request->post('message') && $this->request->post('user')) {
            $chat->last_message = $this->request->post('message');
            $chat->last_message_from = ($user->username == $this->request->post('user')) ? $user->id : $user_to->id;
            $chat->last_message_time = date("Y-m-d H:i:s");
            $chat->save();
            
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error'));
        }
        
    }
    
    public function action_compose_popup() {
        $this->auto_render = false;
        $data = array();

        if($this->request->query('user')) {
            $user_to = ORM::factory('user', array('username' => $this->request->query('user')));
            $data['user_to'] = $user_to;
        }

        echo View::factory('chat/compose', $data); // show day form
    }

    public function action_delete_message() {
        $this->auto_render = false;
        if ($this->request->post('chat')) {

            $user = Auth::instance()->get_user();
            $user_to = ORM::factory('user', array('username' => $this->request->param('id')));
            $chat = ORM::factory('chat')->get_conversation($user, $user_to);
            if(empty($chat->id)) {
                return;
            }

            if ($chat->to == $user->id) {
                $chat->to_deleted = 1;
                $chat->to_deleted_time = date('Y-m-d H:i:s');
            } else {
                $chat->from_deleted = 1;
                $chat->from_deleted_time = date('Y-m-d H:i:s');
            }

            $chat->save();
            $this->request->redirect(url::base(). "chat");
        } else {
            echo "error";
        }
    }

    public function action_chats_for_noti() {
        if($this->request->is_ajax()) {
            $this->auto_render = false;
            $user = Auth::instance()->get_user();
            
            echo View::factory('chat/chats_for_noti');
        } else {
            $this->request->redirect(url::base()."chat");
        }
    }
}