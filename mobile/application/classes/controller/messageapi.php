<?php defined('SYSPATH') or die('No direct script access.');

//controller contains all the that does not require login
class Controller_Messageapi extends Controller_Template 
{

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
           /* if($token->id)
            {
                $username = $token->user->email;
                Auth::instance()->force_login($username);
                Session::instance()->set('token', $token->token);
                
            }else
                {
                    echo json_encode(array('stauts'=>0,'message'=>'Invalid token'));
                    exit;
                }*/
            } 
        if(!Auth::instance()->logged_in()) 
        {
            $this->template->header = View::factory('templates/accessapi'); //template header
        } 
        else 
        {
            $this->template->header = View::factory('templates/accessapi');
        }
        //$this->template->footer = View::factory('templates/footer'); //template footer
        // $this->template->title = "Nepal's Largest Social Matrimony Site | Nepali Matrimony - Nepali Dating NepaliVivah"; //page title
        // $this->template->content = View::factory('accessapi/callitmeusername'); //page content
    }
    
    /*public function action_callitmeusername()
    {
        $username = $this->request->post('username');

        echo $username;
    }*/

    public function action_index()
    {
        echo "Message Api";
        exit;
    }
    public function action_show_conversation_user_list() 
    {
        /*if(!$this->request->query())
        {
            echo json_encode(array('status'=>0,'message'=>'Please provide username'));
            exit;
        }*/
        $session_user = ORM::factory('user',array('user_detail_id'=>$this->request->query('user_detail_id')));//Auth::instance()->get_user();

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
            ->order_by('replied_at', 'DESC') //order of conversation
            ->order_by('time', 'ASC')
            ->find_all()
            ->as_array();

        if (empty($messages)) 
        {
            echo json_encode(array('status'=>1, 'message'=>'You have no conversation with other. Start conversation .'));
            exit;
        }
        $conversation_member = array();
        
        foreach($messages as $message )
        {
            $conv_count = $message->conversations->count_all();
            $other_user = ($message->owner->id != $session_user->id) ?
            $message->owner : $message->message_to;
            $age = time() - strtotime($message->replied_at);
            if ($age >= 86400) {
                $time = date('jS M', strtotime($message->replied_at));
            } else {
                $time = date::time2string($age);
            }

            if ($conv_count > 0) 
            {
                $message = nl2br(substr($message->conversations->order_by('id', 'desc')->limit(1)->find()->message, 0, 20)) . "....";
            } else {
                $message = nl2br(substr($message->message, 0, 20)) . "...";
            }
            if($other_user->photo->profile_pic)
            {
                $profile_pic = url::base()."upload/".$other_user->photo->profile_pic;
            }
            else
            {
                $profile_pic = $other_user->user_detail->get_no_image_name();
                //$profile_pic = url::base() . 'img/logo-sm.png';
            }
            
            $user_id = $other_user->id;
            $Name = $other_user->user_detail->first_name.' '.$other_user->user_detail->last_name;
            $username = $other_user->username;
            //echo "<pre>"; 
             //$conversation_member .="{'Name':$Name,'time':$time,'message':$message}";
            $conversation_member[]=array('profile_pic'=>$profile_pic, 'user_id'=>$user_id,'Name'=>$Name,'time'=>$time,'message'=>$message,'username'=>$username);        
        }
        
        echo json_encode(array('status'=>'1','conversation_list'=>$conversation_member));
        exit;
    }
     public function action_compose() 
     {
        $user = ORM::factory('user', array('id' => $this->request->query('user_id')));
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
                if($user->plan->m_to_anyone_used == $user->plan->m_to_anyone) 
                {
                
                }
            }
        }

        if($this->request->query('message')) 
        {
            $user_to = ORM::factory('user', array('email' => $this->request->query('email')));
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
                $message_model->message = Text::parse_text($this->request->query('message'));
                $message_model->time = date("Y-m-d H:i:s");
                $message_model->parent_id = $parent_msg->id;
                $message_model->save();
                
                if($user_to->user_detail->msg_alert) 
                {
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

                echo json_encode(array('status' => 1,'message'=>'Your message has been sent!'));
                exit;
            } 
            else 
            {
                echo json_encode(array('status'=>0, 'message'=>'Sorry, you have used all your requests, please upgrade to continue'));
                exit;
            }

        }
        echo "Message Api ";
        exit;
    }
   public function action_compose28AUG17() 
   {
        $user = ORM::factory('user', array('id' => $this->request->query('user_id')));
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
                    /*Session::instance()->set('error', 'Please upgrade your plan to use this feature.');
                    Session::instance()->set('redirect_url', 'messages/compose?user='.$this->request->query('user'));
                    $this->request->redirect(url::base()."upgrade");*/
                }
            }
        }
        if($this->request->query('message')) 
        {
            $user_to = ORM::factory('user', array('email' => $this->request->query('email')));
            $proceed = true;
            if(!$user_to->id || !$user->check_friends($user_to)) {

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

                if($user_to->user_detail->msg_alert) 
                {
                    $mail_data = array(
                        'message' => $message_model->message,
                        'user_to' => $user_to
                    );
                    //send email
                    /*$from = Auth::instance()->get_user();
                    $send_email = Email::factory('Message from '.$from->user_detail->first_name .' '.$from->user_detail->last_name)
                    ->message(View::factory('mails/new_message_mail', $mail_data)->render(), 'text/html')
                    ->to($user_to->email)
                    ->from('noreply@Callitme.com', 'Callitme')
                    ->send();*/
                }

                echo json_encode(array('status' => 1,'message'=>'Your message has been sent!'));
                exit;
            } 
            else 
            {
                echo json_encode(array('status'=>0, 'message'=>'Sorry, you have used all your requests, please upgrade to continue'));
                exit;
            }
            echo json_encode(array('status' => 0,'message'=>'Your message has not been sent!'));
            exit;
        }
        echo "Message Api ";
        exit;
    }
    public function action_compose21_08_2017() 
    {
        if($this->request->query())
        {    
            $validation = Validation::factory($this->request->query());
            $validation->rule('message', 'not_empty')
                ->rule('email', 'not_empty');
                //->rule('birth_place','not_empty');
            if($validation->check())
            {
                if($this->request->query('user') && !$this->request->query('message')) 
                {
                    $user =Auth::instance()->get_user();
                    $user_to = ORM::factory('user', array('email' => $this->request->query('email')));
                    
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
                            echo json_encode(array('status'=>0, 'message'=>'Please upgrade your plan to use this feature.'));
                            exit;

                            //Session::instance()->set('redirect_url', 'messages/compose?user='.$this->request->query('user'));
                            //$this->request->redirect(url::base()."upgrade");
                        }
                    }
                }

                if($this->request->query('message')) 
                {
                    $user = Auth::instance()->get_user();
                    $user_to = ORM::factory('user', array('email' => $this->request->query('email')));

                    $proceed = true;
                    if(!$user_to->id || !$user->check_friends($user_to)) 
                    {

                        if($user->plan->m_to_anyone_used == $user->plan->m_to_anyone) 
                        {
                            //Session::instance()->set('error', 'Sorry, you have used all your requests, please upgrade to continue');
                            $proceed = false;
                            echo json_encode(array('status'=> 0, 'message'=>'Sorry, you have used all your requests, please upgrade to continue'));
                            exit;
                        } 
                        else 
                        {
                            $user->plan->m_to_anyone_used = $user->plan->m_to_anyone_used + 1;
                            $user->plan->save();
                        }
                    }

                    if($proceed) 
                    {
                        if(!$user_to->id) 
                        {
                            $user_to = ORM::factory('user')->create_non_registered_user($this->request->query('email'));
                        }

                        $parent_msg = ORM::factory('message')->get_conversation($user, $user_to);
                        if(empty($parent_msg->id)) 
                        {
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
                        $message_model->message = Text::parse_text($this->request->query('message'));
                        $message_model->time = date("Y-m-d H:i:s");
                        $message_model->parent_id = $parent_msg->id;
                        $message_model->save();
                        
                        $from = Auth::instance()->get_user()->user_detail;

                        if($user_to->user_detail->msg_alert) 
                        {
                            $mail_data = array(
                                'message' => $message_model->message,
                                'user_to' => $user_to,
                                'from' => $from
                            );
                            //send email
                            
                            $send_email = Email::factory('Message from '.$from->first_name .' '.$from->last_name)
                            ->message(View::factory('mails/new_message_mail', $mail_data)->render(), 'text/html')
                            ->to($user_to->email)
                            ->from('noreply@Callitme.com', 'Callitme')
                            ->send();
                        }

                        //Session::instance()->set('success', 'Your message has been sent!');
                        echo json_encode(array('status' => 1,'message'=>'Your message has been sent!'));
                        exit;//$this->request->redirect(url::base()."messages/view_message/".$user_to->username);
                    } 
                    else 
                    {
                        echo json_encode(array('status'=>0, 'message'=>'Sorry, you have used all your requests, please upgrade to continue'));
                            exit;
                    }
                }
            }
            else
            {
                echo json_encode(array('status'=>0, 'message'=>'All fields required.'));
                exit;
            }
        }
        echo "Message Api ";
        exit;
    }

    public function action_reply() //reply message api
    { 
        if(!$this->request->query())
        {
            echo json_encode(array('status'=>0, 'message'=>'Request not available '));
            exit;
        }
        $validation = Validation::factory($this->request->query());
        $validation->rule('reply', 'not_empty')
            ->rule('to', 'not_empty');
        if($validation->check())
        {
            if($this->request->query('reply')) 
            {
                $user = ORM::factory('user',array('user_detail_id'=>$this->request->query('user_detail_id')));//Auth::instance()->get_user();
                $user_to = ORM::factory('user',$this->request->query('to'));

                $message = ORM::factory('message')->get_conversation($user, $user_to);

                $message_model = ORM::factory('message');
                $message_model->from = $user->id;
                $message_model->to = $this->request->query('to');
                $message_model->message = Text::parse_text($this->request->query('reply'));
                $message_model->time = date("Y-m-d H:i:s");
                $message_model->parent_id = $message->id;
                $message_model->save();

                $message->replied = 1;
                $message->replied_at = date("Y-m-d H:i:s");
                $message->to_deleted = 0;
                $message->from_deleted = 0;

                if($message->to == $user->id) {
                    $message->from_unread = 1;
                } else {
                    $message->to_unread = 1;
                }

                $message->save();
                $from = ORM::factory('user',array('user_detail_id'=>$this->request->query('user_detail_id')))->user_detail;
                if($user_to->user_detail->msg_alert) {
                    $mail_data = array(
                        'message' => $message_model->message,
                        'user_to' => $user_to,
                        'from' =>$from
                    );
                    //send email
                    /*$from = Auth::instance()->get_user();
                    $send_email = Email::factory('Message from '.$from->first_name .' '.$from->last_name)
                    ->message(View::factory('mails/new_message_mail', $mail_data)->render(), 'text/html')
                    ->to($user_to->email)
                    ->from('noreply@Callitme.com', 'Callitme')
                    ->send();*/
                }
                if(!$this->request->is_ajax())
                {
                //$this->template->title = 'Callitme';
                    //$this->template->content = View::factory('members/view_message', $message_model);
                    echo json_encode(array('status'=>1, 'message'=>'successfully replied'));
                    exit;
                //
                } 
                /*else{
                echo View::factory('messages/messages', array('messages' => array($message_model)));
                }*/
            }
        }else{
            echo json_encode(array('status'=>0, 'message'=>'Please fill all fields'));
            exit;
        } 
        echo "Reply Api";
    }

    public function action_view_message() 
    {
        if($this->request->query())
        {
            $validation = Validation::factory($this->request->query());
            $validation->rule('other_username', 'not_empty');
            if($validation->check())
            {
                $user = ORM::factory('user',array('user_detail_id'=>$this->request->query('user_detail_id')));//Auth::instance()->get_user();
                //$user_to = $this->request->param('id');

                $user_to = ORM::factory('user', array('username' => $this->request->query('other_username')));
                /*if(empty($user_to))
                {
                    echo json_encode(array('status'=>0,'message'=>'Invalid username'));
                    exit;
                }*/

                $message = ORM::factory('message')->get_conversation($user, $user_to);
                /*if(!$message)
                {
                    echo json_encode(array('status'=>0,'message'=>'You have no conversation with this user.'));
                    exit;
                }*/
                if($message->to == $user->id) 
                {
                    $message->to_unread = 0;
                } 
                else 
                {
                    $message->from_unread = 0;
                }
                    $message->save();

                $data['message'] = $message;
                $data['username_to']=$this->request->query('other_username');
                $conversatios = $message->conversations
                                    ->order_by('id','DESC')
                                    ->find_all()
                                    ->as_array();
                $conversation_list = array();

                foreach(array_reverse($conversatios) as $conversation) 
                {
                    $name = $conversation->owner->user_detail->first_name." ".$conversation->owner->user_detail->last_name;
                    $username = $conversation->owner->username;
                    if($conversation->owner->photo->profile_pic_s)
                    {
                        $profile_pic = url::base()."upload/".$conversation->owner->photo->profile_pic_s;
                    }
                    else
                    {
                        $profile_pic = $conversation->owner->user_detail->first_name[0]." ".$conversation->owner->user_detail->last_name[0];
                    }
                    
                    $age = time() - strtotime($conversation->time);
                    if ($age >= 86400) {
                        $time = date('jS M', strtotime($conversation->time));
                    } else {
                        $time = date::time2string($age);
                    }
                    $message = nl2br($conversation->message);

                    $conversation_list[] =array('Name'=>$name,'username'=>$username,'profile_pic'=>$profile_pic,'message'=>$message,'time'=>$time);
                }
                echo json_encode(array('status'=>'1','conversation_list'=>$conversation_list));
                exit;
            }
            else
            {
                echo json_encode(array('status'=>0, 'message'=>'please give valid username and other_username .'));
            } 
        }
        echo "conversation messages";
    }


    public function action_messages_for_noti() {
        
            //$this->auto_render = false;
            $user = ORM::factory('user',array('user_detail_id'=>$this->request->query('user_detail_id')));//Auth::instance()->get_user();
            $messages = ORM::factory('message')
                    ->where('parent_id', '=', 0)
                    ->where_open()
                    ->where_open()
                    ->where('to', '=', $user->id)
                    ->where('to_deleted', '=', 0)
                    ->where_close()
                    ->or_where_open()
                    ->where('from', '=', $user->id)
                    ->and_where('from_deleted', '=', 0)
                    ->or_where_close()
                    ->where_close()
                    ->order_by('replied_at', 'desc')
                    ->order_by('time', 'desc')
                    ->limit(5)
                    ->find_all()
                    ->as_array();

            $sent = '';

            if (!empty($messages)) 
            {   
                $messages_noti = array();
                foreach ($messages as $message) 
                { 
                    $conv_count = $message->conversations->count_all();
                    $check_unread = ($message->to == Auth::instance()->get_user()->id) ? $message->to_unread : $message->from_unread;
                    $other_user = ($message->owner->id != Auth::instance()->get_user()->id) ?
                    $message->owner : $message->message_to;

                    if($other_user->is_blocked == 0) 
                    {
                        if ($other_user->photo->profile_pic_m) 
                        {
                            $proile_pic = url::base() . 'upload/' . $other_user->photo->profile_pic_m;
                        }
                        else
                        {
                            $proile_pic = $other_user->user_detail->first_name[0] . $other_user->user_detail->last_name[0];
                        }
                    }else
                    {
                         $proile_pic = url::base() . 'img/logo-sm.png';
                    }

                    if($other_user->is_blocked == 0) 
                    {
                        $name = $other_user->user_detail->first_name . " " . $other_user->user_detail->last_name;
                    }
                    else
                    {
                        $name = "Callitme User";

                    }
                    $username =  $other_user->username;
                    if ($conv_count > 0) 
                    {
                        $msg = $message->conversations->order_by('id', 'desc')->limit(1)->find()->message;
                    } 
                        else 
                    {
                        $msg = $message->message;
                    }
                    
                    $message1 = nl2br(substr($msg, 0, 100) . "...");
                    $age = time() - strtotime($message->replied_at);
                    if ($age >= 86400) 
                    {
                        $time =  date('jS M', strtotime($message->replied_at));
                    } 
                        else 
                    {
                        $time = date::time2string($age);
                    }
                    $messages_noti[] = array(
                                    'proile_pic' => $proile_pic,
                                    'name' => $name,
                                    'username' => $username,
                                    'message' => $message1,
                                    'time' => $time
                                    );
                }
                echo json_encode(array('status'=>1,'message'=>'successfully fetch','message_list'=>$messages_noti));
                exit;
            }
            else
            {
                echo json_encode(array('status'=>1, 'message'=>'No messages.'));
                exit;
            }
        } 

} 