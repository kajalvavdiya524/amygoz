<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Messages extends Controller_Template {

    public $template = 'templates/message';
    
    public function before() 
    {
        parent::before();
        
        $this->request->redirect(url::base().'chat');
        
        if(!Auth::instance()->logged_in()) { //if not login redirect to login page
            $this->request->redirect('pages/login');
        } else if( Auth::instance()->get_user()->registration_steps != 'done') {
            Auth::instance()->get_user()->check_registration_steps();
        }
        
        Auth::instance()->get_user()->check_plan_validity();
        //if request is ajax don't load the template
        if(!$this->request->is_ajax()) {

            $this->template->title = 'Welcome to Callitme';
            $this->template->description = 'Callitme is your personal network where you can match your single friends,
                review people you know, find singles around you and send requests to your crush anonymously.';
            $this->template->header = View::factory('templates/members-header');
            $this->template->sidemenu = View::factory('templates/sidemenu', array('side_menu' => 'messages'));
            $this->template->footer = View::factory('templates/member-footer');
        }

    }
    
    public function action_index() 
    {
        $user = Auth::instance()->get_user();
        $data['user'] = $user;
        $this->template->title = $user->user_detail->first_name .' '.$user->user_detail->last_name;
        $session_user = Auth::instance()->get_user();
        $flag=0;
        $messages = ORM::factory('message')
            ->where('parent_id', '=', 0)
            ->where_open()
            ->where_open()
            ->where('to', '=', $session_user->id)
            ->where('to_deleted', '=', 0)
            ->where_close()
            ->or_where_open()
            ->where('from', '=', $session_user->id)
            ->and_where('from_deleted', '=', 0)
            ->or_where_close()
            ->where_close()
            ->order_by('replied_at', 'ASC')
            ->order_by('time', 'ASC')
            ->find_all()
            ->as_array();
        foreach($messages as $msg)
        {
            $username_p = $msg->owner->username;
            $flag=1;
            $other_user = ($msg->owner->id != Auth::instance()->get_user()->id) ?
            $msg->owner : $msg->message_to;
        }
        if($flag==1)
        {
            $this->template->content = View::factory('messages/index', $data);
            $this->template->footer = View::factory('templates/member-footer');
            //$this->request->redirect(url::base().'messages/view_message/'. $other_user->username);
        }
        else
        {
            //$this->template->title = $user->user_detail->first_name .' '.$user->user_detail->last_name;
            $this->request->redirect(url::base().'messages/compose');
        }
    }
    
    public function action_messages_for_noti() {
        if($this->request->is_ajax()) {
            $this->auto_render = false;
            $user = Auth::instance()->get_user();

            echo View::factory('messages/messages_for_noti');
        } else {
            $this->request->redirect(url::base()."messages");
        }
    }

    public function action_compose() {
        $user = Auth::instance()->get_user();
        if($this->request->query('user') && !$this->request->post('message')) {
            $user_to = ORM::factory('user', array('username' => $this->request->query('user')));
            if($user_to->id) {
                $message = ORM::factory('message')->get_conversation($user, $user_to);
                if(!empty($message->id)) {
                    $this->request->redirect(url::base().'messages/view_message/'.$user_to->username);
                }

            }

            if(!$user_to->id || !$user->check_friends($user_to)) 
                {

                if($user->plan->m_to_anyone_used == $user->plan->m_to_anyone) {
                    //Session::instance()->set('error', 'Please upgrade your plan to use this feature.');

                    //Session::instance()->set('redirect_url', 'messages/compose?user='.$this->request->query('user'));
                    //$this->request->redirect(url::base()."upgrade");
                }

            }
        }

        if($this->request->post('message')) {
            $user_to = ORM::factory('user', array('email' => $this->request->post('email')));
         
            $proceed = true;
            if(!$user_to->id || !$user->check_friends($user_to)) {

                if($user->plan->m_to_anyone_used == $user->plan->m_to_anyone) {
                    Session::instance()->set('error', 'Sorry, you have used all your requests, please upgrade to continue');
                    $proceed = true;
                } else {
                    $user->plan->m_to_anyone_used = $user->plan->m_to_anyone_used + 1;
                    $user->plan->save();
                }

            }
          
            if($proceed) {
                if(!$user_to->id) {
                    $user_to = ORM::factory('user')->create_non_registered_user($this->request->post('email'));
                }

                $parent_msg = ORM::factory('message')->get_conversation($user, $user_to);
                if(empty($parent_msg->id)) {
                    //create conversation msg
                    $parent_msg = ORM::factory('message');
                    $parent_msg->from = $user->id;
                    $parent_msg->to = $user_to->id;
                    $parent_msg->message = '';
                    $parent_msg->time = date("Y-m-d H:i:s");
                    $parent_msg->replied_at = date("Y-m-d H:i:s");
                    $parent_msg->to_unread = 1;
                    $parent_msg->save();
                } else {
                    $parent_msg->replied = 1;
                    $parent_msg->replied_at = date("Y-m-d H:i:s");
                    $parent_msg->to_deleted = 0;
                    $parent_msg->from_deleted = 0;
                    if ($parent_msg->to == $user->id) {
                        $parent_msg->from_unread = 1;
                    } else {
                        $parent_msg->to_unread = 1;
                    }

                    $parent_msg->save();
                }

                //create actual message
                $message_model = ORM::factory('message');
                $message_model->from = $user->id;
                $message_model->to = $user_to->id;
                $message_model->message = Text::parse_text($this->request->post('message'));
                $message_model->time = date("Y-m-d H:i:s");
                $message_model->parent_id = $parent_msg->id;
                $message_model->save();
                 
                if($user_to->user_detail->msg_alert) {
                    $mail_data = array(
                        'message' => $message_model->message,
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
                $this->request->redirect(url::base()."messages/view_message/".$user_to->username);
            
            } 
            else 
            {
                $redirect_url = ($user_to->id) ? 'messages/compose?user='.$user_to->username : 'messages/compose';
                Session::instance()->set('redirect_url', $redirect_url);
                //$this->request->redirect(url::base()."upgrade");
            }

        }
    
        $this->template->title = $user->user_detail->first_name .' '.$user->user_detail->last_name;
        $this->template->content = View::factory('messages/new_message');
    }

    public function action_view_message() {
        $user = Auth::instance()->get_user();
        $user_to = $this->request->param('id');

        $user_to = ORM::factory('user', array('username' => $user_to));
        $message = ORM::factory('message')->get_conversation($user, $user_to);

        if($message->to == $user->id) {
            $message->to_unread = 0;
        } else {
            $message->from_unread = 0;
        }
        $message->save();

        $data['message'] = $message;
        $data['username_to']=$this->request->param('id');

        $this->template->title = $user->user_detail->first_name .' '.$user->user_detail->last_name;
        $this->template->content = View::factory('messages/view_message', $data);
    }

    
    public function action_load_older_msg()
    {
        $user = Auth::instance()->get_user();
        $user_to = $this->request->query('username');
        $msg_id =$this->request->query('msg_id'); 
        
        $user_to = ORM::factory('user', array('username' => $user_to));
        $message = ORM::factory('message')->get_conversation($user, $user_to);

        if($message->to == $user->id) {
            $message->to_unread = 0;
        } else {
            $message->from_unread = 0;
        }
        $message->save();

        $data['message'] = $message;
        $data['username_to']=$user_to;
        $data['msg_id'] = $msg_id;
        //$this->template->title = $user->user_detail->first_name .' '.$user->user_detail->last_name;
        echo  View::factory('messages/load_older_msg', $data)->render();
    }




    public function action_recent() {
        $this->auto_render = false;

        $user = Auth::instance()->get_user();
        $user_to = ORM::factory('user', array('username' => $this->request->param('id')));

        $time = date("Y-m-d H:i:s", $this->request->query('time'));
        $messages = ORM::factory('message')->get_recent_messages($user, $user_to, $time);

        $data['messages'] = $messages;
        echo View::factory('messages/messages', $data);
    }

    public function action_reply() {
        $this->auto_render = false;
        if($this->request->post('reply')) {
            $user = Auth::instance()->get_user();
            $user_to = ORM::factory('user', $this->request->post('to'));

            $message = ORM::factory('message')->get_conversation($user, $user_to);

            $message_model = ORM::factory('message');
            $message_model->from = Auth::instance()->get_user()->id;
            $message_model->to = $this->request->post('to');
            $message_model->message = Text::parse_text($this->request->post('reply'));
            $message_model->time = date("Y-m-d H:i:s");
            $message_model->parent_id = $message->id;
            $message_model->save();

            $message->replied = 1;
            $message->replied_at = date("Y-m-d H:i:s");
            $message->to_deleted = 0;
            $message->from_deleted = 0;

            if($message->to == Auth::instance()->get_user()->id) {
                $message->from_unread = 1;
            } else {
                $message->to_unread = 1;
            }

            $message->save();

            if($user_to->user_detail->msg_alert) {
                $mail_data = array(
                    'message' => $message_model->message,
                    'user_to' => $user_to
                );
                //send email
                $from = Auth::instance()->get_user();
                /*$send_email = Email::factory('Message from '.$from->user_detail->first_name .' '.$from->user_detail->last_name)
                ->message(View::factory('mails/new_message_mail', $mail_data)->render(), 'text/html')
                ->to($user_to->email)
                ->from('noreply@Callitme.com', 'Callitme')
                ->send();*/
            }
             if(!$this->request->is_ajax())
             {
            //$this->template->title = 'Callitme';
            $this->template->content = View::factory('members/view_message', $message_model);
            //
        } 
        else{
            echo View::factory('messages/messages', array('messages' => array($message_model)));
        }

            
        }
    }

    public function action_delete_message() {
        $this->auto_render = false;
        if($this->request->post('message'))
        {
            $user = Auth::instance()->get_user();
            $user_to = ORM::factory('user', array('username' => $this->request->post('username')));
            $message = ORM::factory('message')->get_conversation($user, $user_to);
            //print_r($message);


            if(empty($message->id)) {
                return;
            }

            if ($message->to == $user->id)
            {
                $message->to_deleted = 1;
                $message->from_deleted = 1;
            }
            else
            {
                $message->to_deleted = 1;
                $message->from_deleted = 1;
            }

            $message->save();

            $this->request->redirect(url::base().'messages');
        } else {
            echo "error";
        }

    }

    public function action_sendmessage()
    {
        $user = Auth::instance()->get_user();
        if($this->request->query('user') && !$this->request->post('message')) 
        {
            $user_to = ORM::factory('user', array('username' => $this->request->query('user')));
            if($user_to->id) 
            {
                $message = ORM::factory('message')->get_conversation($user, $user_to);
                if(!empty($message->id)) 
                {
                    $this->request->redirect(url::base().'messages/view_message/'.$user_to->username);
                }

            }
            if(!$user_to->id || !$user->check_friends($user_to)) 
            {
                if($user->plan->m_to_anyone_used == $user->plan->m_to_anyone) 
                {
                    //Session::instance()->set('error', 'Please upgrade your plan to use this feature.');
                   // Session::instance()->set('redirect_url', 'messages/compose?user='.$this->request->query('user'));
                   // $this->request->redirect(url::base()."upgrade");
                }

            }
        }
        if($this->request->post('message')) 
        {
            //$user_to = ORM::factory('user', array('email' => $this->request->post('email')));
            $user_to   = ORM::factory('user_detail')->with('user')
                       ->where(DB::expr('CONCAT(first_name, " ", last_name)'),'like', $this->request->post('first_name').'%')
                       ->find(); 
            $proceed = true;
            if(!$user_to->id || !$user->check_friends($user_to)) 
            {
                if($user->plan->m_to_anyone_used == $user->plan->m_to_anyone) 
                {
                    Session::instance()->set('error', 'Sorry, you have used all your requests, please upgrade to continue');
                    $proceed = true;
                } 
                else 
                {
                    $user->plan->m_to_anyone_used = $user->plan->m_to_anyone_used + 1;
                    $user->plan->save();
                }
            }
             print_r($user_to);
             exit;  
            if($proceed) 
            {
                if(!$user_to->id) 
                {
                    $user_to = ORM::factory('user')->create_non_registered_user($this->request->post('email'));
                }
                $parent_msg = ORM::factory('message')->get_conversation($user, $user_to);

                if(empty($parent_msg->id)) {
                    //create conversation msg
                    $parent_msg = ORM::factory('message');
                    $parent_msg->from = $user->id;
                    $parent_msg->to = $user_to->id;
                    $parent_msg->message = '';
                    $parent_msg->time = date("Y-m-d H:i:s");
                    $parent_msg->replied_at = date("Y-m-d H:i:s");
                    $parent_msg->to_unread = 1;
                    $parent_msg->save();
                } 
                else 
                {
                    $parent_msg->replied = 1;
                    $parent_msg->replied_at = date("Y-m-d H:i:s");
                    $parent_msg->to_deleted = 0;
                    $parent_msg->from_deleted = 0;
                    if ($parent_msg->to == $user->id) 
                    {
                        $parent_msg->from_unread = 1;
                    } 
                    else 
                    {
                        $parent_msg->to_unread = 1;
                    }
                    $parent_msg->save();
                }

                //create actual message
                $message_model = ORM::factory('message');
                $message_model->from = $user->id;
                $message_model->to = $user_to->id;
                $message_model->message = Text::parse_text($this->request->post('message'));
                $message_model->time = date("Y-m-d H:i:s");
                $message_model->parent_id = $parent_msg->id;
                $message_model->save();
             print_r($message_model);
             exit;
                if($user_to->msg_alert) {
                    $mail_data = array(
                        'message' => $message_model->message,
                        'user_to' => $user_to
                    );
                    //send email
                    $from = Auth::instance()->get_user();
                    /*$send_email = Email::factory('Message from '.$from->user_detail->first_name .' '.$from->user_detail->last_name)
                    ->message(View::factory('mails/new_compose_mail', $mail_data)->render(), 'text/html')
                    ->to($user_to->user->email)
                    ->from('noreply@Callitme.com', 'Callitme')
                    ->send();*/
                }
            
                //Session::instance()->set('success', 'Your message has been sent!');
                $this->request->redirect(url::base()."messages/view_message/".$user_to->user->username);
            } 
            else 
            {
                $redirect_url = ($user_to->id) ? 'messages/compose?user='.$user_to->user->username : 'messages/compose';
                Session::instance()->set('redirect_url', $redirect_url);
                //$this->request->redirect(url::base()."upgrade");
            }
        }
        $this->template->content = View::factory('messages/compose');
    }
    public function action_newsend()
    {
        $user = Auth::instance()->get_user();
        if($this->request->query('user') && !$this->request->post('message')) 
        {
            $user_to = ORM::factory('user', array('username' => $this->request->query('user')));
            if($user_to->id) 
            {
                $message = ORM::factory('message')->get_conversation($user, $user_to);
                if(!empty($message->id))
                {
                    $this->request->redirect(url::base().'messages/view_message/'.$user_to->username);
                }
            }
            if(!$user_to->id || !$user->check_friends($user_to)) 
            {
                if($user->plan->m_to_anyone_used == $user->plan->m_to_anyone) 
                {
                    //Session::instance()->set('error', 'Please upgrade your plan to use this feature.');
                    //Session::instance()->set('redirect_url', 'messages/compose?user='.$this->request->query('user'));
                    //$this->request->redirect(url::base()."upgrade");
                }
            }
        }

        if($this->request->post('message')) {
            //$user_to = ORM::factory('user', array('email' => $this->request->post('email')));
            $user_to   = ORM::factory('user_detail')->with('user')
                       ->where(DB::expr('CONCAT(first_name, " ", last_name)'),'like', $this->request->post('first_name').'%')
                       ->find();

            if($user_to->user->id == '')
            {
                 Session::instance()->set('error', 'Invalid User !');
                 $this->request->redirect(url::base()."messages/sendmessage");
            }  
            else
            {
                $proceed = true;
            if(!$user_to->user->id || !$user->check_friends($user)) {

                if($user->plan->m_to_anyone_used == $user->plan->m_to_anyone) 
                {
                    //Session::instance()->set('error', 'Sorry, you have used all your requests, please upgrade to continue');
                    $proceed = true;
                } 
                else 
                {
                    $user->plan->m_to_anyone_used = $user->plan->m_to_anyone_used + 1;
                    $user->plan->save();
                }

            }
 
            if($proceed) 
            {
                if(!$user_to->user->id) 
                {
                    $user_to = ORM::factory('user')->create_non_registered_user($this->request->post('email'));
                }

                $parent_msg = ORM::factory('message')->get_conversation($user, $user_to);
                if(empty($parent_msg->id)) {
                    //create conversation msg
                    $parent_msg = ORM::factory('message');
                    $parent_msg->from = $user->id;
                    $parent_msg->to = $user_to->user->id;
                    $parent_msg->message = '';
                    $parent_msg->time = date("Y-m-d H:i:s");
                    $parent_msg->replied_at = date("Y-m-d H:i:s");
                    $parent_msg->to_unread = 1;
                    $parent_msg->save();
                } else {
                    $parent_msg->replied = 1;
                    $parent_msg->replied_at = date("Y-m-d H:i:s");
                    $parent_msg->to_deleted = 0;
                    $parent_msg->from_deleted = 0;
                    if ($parent_msg->to == $user->id) {
                        $parent_msg->from_unread = 1;
                    } else {
                        $parent_msg->to_unread = 1;
                    }

                    $parent_msg->save();
                }
                //create actual message
                $message_model = ORM::factory('message');
                $message_model->from = $user->id;
                $message_model->to = $user_to->user->id;
                $message_model->message = Text::parse_text($this->request->post('message'));
                $message_model->time = date("Y-m-d H:i:s");
                $message_model->parent_id = $parent_msg->id;
                $message_model->save();

                if($user_to->msg_alert) 
                {
                    $mail_data = array(
                        'message' => $message_model->message,
                        'user_to' => $user_to
                    );
                    //send email
                    $from = Auth::instance()->get_user();
                   /* $send_email = Email::factory('Message from '.$from->user_detail->first_name .' '.$from->user_detail->last_name)
                    ->message(View::factory('mails/new_compose_mail', $mail_data)->render(), 'text/html')
                    ->to($user_to->email)
                    ->from('noreply@Callitme.com', 'Callitme')
                    ->send();*/
                }
                //Session::instance()->set('success', 'Your message has been sent!');
                $this->request->redirect(url::base()."messages/view_message/".$user_to->user->username);
            } 
            else 
            {
                $redirect_url = ($user_to->id) ? 'messages/compose?user='.$user_to->user->username : 'messages/compose';
                Session::instance()->set('redirect_url', $redirect_url);
               // $this->request->redirect(url::base()."upgrade");
            }
            }         
            
        }
        $this->template->content = View::factory('messages/new_message');
    }
}