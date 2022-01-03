<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin extends Controller_Template {
    public $template = 'templates/admin';
    
    public function before() 
    {
        parent::before();
        /*if(!Auth::instance()->logged_in('admin')) { //if not login redirect to login page
            $this->request->redirect('pages/login');
        }*/
        
        if(!$this->request->is_ajax()) {
            $header_data['page'] = $this->request->action();
        
            $this->template->title = "Callitme Management";
            $this->template->header = View::factory('templates/admin-header', $header_data);
            $this->template->footer = View::factory('templates/footer');
        }

    }

    public function action_combine_messages() {
        $parent_msgs = ORM::factory('message')
            ->where('parent_id', '=', 0)
            ->group_by('to', 'from')
            ->find_all()
            ->as_array();

        foreach($parent_msgs as $parent_msg) {
            if($parent_msg->parent_id) {
                continue;
            }

            $other_parent = ORM::factory('message')
            ->where('parent_id', '=', 0)
            ->where_open()
                ->where_open()
                    ->where('to', '=', $parent_msg->to)
                    ->where('from', '=', $parent_msg->from)
                ->where_close()
                ->or_where_open()
                    ->where('to', '=', $parent_msg->from)
                    ->where('from', '=', $parent_msg->to)
                ->or_where_close()
            ->where_close()
            ->order_by('time')
            ->find();

            DB::update(ORM::factory('message')->table_name())
            ->set(array('parent_id' => $other_parent->id))
            ->where('id', '!=', $other_parent->id)
            ->where_open()
                ->where_open()
                    ->where('to', '=', $parent_msg->to)
                    ->where('from', '=', $parent_msg->from)
                ->where_close()
                ->or_where_open()
                    ->where('to', '=', $parent_msg->from)
                    ->where('from', '=', $parent_msg->to)
                ->or_where_close()
            ->where_close()
            ->execute();
        }

        echo "<pre>";print_r('updated');exit;
    }

    public function action_make_conversation() {
        $parent_msgs = ORM::factory('message')
            ->where('parent_id', '=', 0)
            ->find_all()
            ->as_array();

        foreach($parent_msgs as $parent_msg) {
            if(!$parent_msg->message) {
                continue;
            }

            $first_msg = ORM::factory('message');
            $first_msg->message = $parent_msg->message;
            $first_msg->to = $parent_msg->to;
            $first_msg->from = $parent_msg->from;
            $first_msg->time = $parent_msg->time;
            $first_msg->to_unread = $parent_msg->to_unread;
            $first_msg->from_unread = $parent_msg->from_unread;
            $first_msg->parent_id = $parent_msg->id;
            //$first_msg->replied = $parent_msg->replied;
            //$first_msg->replied_at = $parent_msg->replied_at;
            $first_msg->to_deleted = $parent_msg->to_deleted;
            $first_msg->from_deleted = $parent_msg->from_deleted;
            $first_msg->save();

            $parent_msg->message = '';
            $parent_msg->save();

        }

        echo "<pre>";print_r('updated');exit;
    }

    public function action_index()
    {
        if(!$this->request->is_ajax()) {
            if($this->request->query('search_member')) {
                $users = ORM::factory('user')->with('user_detail')
                    ->where_open()
                        ->where('first_name','like', '%'.$this->request->query('search_member').'%')
                        ->or_where('last_name', 'like', '%'.$this->request->query('search_member').'%')
                    ->where_close()
                    ->and_where('not_registered', '=', 0)
                    ->order_by('id', 'desc')
                    ->limit(10)
                    ->find_all()
                    ->as_array();

            } else {
                $users = ORM::factory('user')
                    ->and_where('not_registered', '=', 0)
                    ->order_by('id', 'desc')
                    ->limit(10)
                    ->find_all()
                    ->as_array();
            }
        } else {
            $id = $this->request->post('id');
            if($this->request->query('search_member')) {
                
                $users = ORM::factory('user')->with('user_detail')
                    ->where_open()
                        ->where('first_name','like', '%'.$this->request->query('search_member').'%')
                        ->or_where('last_name', 'like', '%'.$this->request->query('search_member').'%')
                    ->where_close()
                    ->and_where('user.not_registered', '=', 0)
                    ->and_where('user.id', '<', $id)
                    ->order_by('user.id', 'desc')
                    ->limit(5)
                    ->find_all()
                    ->as_array();
            } else {
                $users = ORM::factory('user')
                    ->and_where('not_registered', '=', 0)
                    ->and_where('id', '<', $id)
                    ->order_by('id', 'desc')
                    ->limit(5)
                    ->find_all()
                    ->as_array();
            }
        }
        $data['total_users'] = ORM::factory('user')->where('not_registered', '=', 0)->count_all();
        $data['users'] = $users;
        $data['page'] = 'members';
        if(!$this->request->is_ajax()) {
            $this->template->content = View::factory('admin/index', $data); //page content
        } else {
            $this->auto_render = false;
            
            echo View::factory('admin/ajax', $data);
        }
    }
    
    public function action_current_users()
    {
        $users = ORM::factory('logged_user')
                ->order_by('login_time','desc')
                ->find_all()
                ->as_array();

        $data['users'] = $users;
        $data['page'] = 'current_users';
        if(!$this->request->is_ajax()) {
            $this->template->content = View::factory('admin/current_users', $data); //page content
        } else {
            $this->auto_render = false;
            echo View::factory('admin/ajax', $data);
        }
    }
    
    public function action_log_info()
    {
        if($this->request->post('log_date')) {
            $users = ORM::factory('logged_user')
                ->where(DB::expr("DATE(login_time)"), '=', $this->request->post('log_date'))
                ->order_by('login_time','desc')
                ->find_all()
                ->as_array();
        } else {
            $users = ORM::factory('logged_user')
                ->order_by('login_time','desc')
                ->find_all()
                ->as_array();
        }
        $data['users'] = $users;
        $data['page'] = 'log_info';
        
        $this->template->content = View::factory('admin/log_info', $data); //page content
    }
    
    public function action_payment_info() {
        $payments = ORM::factory('payment')
                ->order_by('payment_date', 'desc')
                ->find_all()
                ->as_array();

        $data['payments'] = $payments;
        $data['page'] = 'payments';

        $this->template->content = View::factory('admin/payment_info', $data); //page content
    }
    
    public function action_plans_info() {
        $data['page'] = 'plans';

        $this->template->content = View::factory('admin/plan_info', $data); //page content
    }

    public function action_block()
    {
        $this->auto_render = false;
        if($this->request->post('block')) {
            // request for follow a member
            $user = ORM::factory('user', $this->request->post('block'));
            $user->is_blocked = 1;
            $user->save();
            
            echo "blocked";
        } else if($this->request->post('unblock')) {
            $user = ORM::factory('user', $this->request->post('unblock'));
            $user->is_blocked = 0;
            $user->save();
            
            echo "unblocked";
        }
        
    }
    
    public function action_approve()
    {
        $this->auto_render = false;
        if($this->request->post('approve')) {
            // request for follow a member
            $user = ORM::factory('user', $this->request->post('approve'));
            $user->is_active = 1;
            $user->save();
            
            echo "approved";
        } else {
            echo "error";
        }
        
    }
    
    public function action_delete()
    {
        $this->auto_render = false;
        if($this->request->post('user')) {
            // request for follow a member
            $user = ORM::factory('user', $this->request->post('user'));
            $user->is_deleted = 1;
            $user->save();
            
            echo "deleted";
        } else {
            echo "error";
        }
        $this->request->redirect(url::base()."admin");
    }
    
    public function action_reactivate()
    {
        if($this->request->post('user')) {
            // request for follow a member
            $user = ORM::factory('user', $this->request->post('user'));
            $user->is_deleted = 0;
            $user->delete_expires = null;
            $user->save();
            
        }
        $this->request->redirect(url::base()."admin");
    }

    
    public function action_edit_profile()
    {
        $this->auto_render = false;
        $user_id = $this->request->param('id');
        $user = ORM::factory('user', $user_id);
        
        if($this->request->post()) {
            
            try {
                // request for follow a member
                $post_data = $this->request->post();
                if(empty($post_data['password'])) {
                    unset($post_data['password']);
                }
                $post_data['birthday'] = $post_data['year']."-".$post_data['month']."-".$post_data['day'];
                $user->values($post_data);
                $user->save();
                $user_detail = $user->user_detail;
                $user_detail->values($post_data);
                $user_detail->save();
                
                echo "updated";
            } catch(ORM_Validation_Exception $e) {
                echo "error";
            }
        } else {
           echo View::factory('admin/edit_profile', array('user' => $user));
        }
        
    }
    
    public function action_unique_email() 
    {
        // check if the email in sign up page is unique or not
        $this->auto_render = false;
        if($this->request->post()) {
            $user = ORM::factory('user')
                    ->where('email', '=', $this->request->post('email'))
                    ->where('id', '!=', $this->request->post('user_id'))
                    ->find();

            if($user->id) {
                echo '1'; 
            } else {
                echo '0';
            }
        }
    }
    
    public function action_unique_username() {
        // check if the username is already taken or not
        $this->auto_render = false;
        if($this->request->post()) {
            $user = ORM::factory('user')
                        ->where('username', '=', $this->request->post('username'))
                        ->where('id', '!=', $this->request->post('user_id'))
                        ->find();
            
            if($user->id) {
                echo '1'; 
            } else {
                echo '0';
            }
        }
    }
    
    public function action_reminder()
    {
        $this->auto_render = false;
        if($this->request->post('user')) {
            // request for follow a member
            $user = ORM::factory('user', $this->request->post('user'));
            if ($user->loaded()) {
            
                // create activation link and send mail
                $token = ORM::factory('user_token', array('user_id' => $user->id, 'type' => "activation_code"));
                if (!$token->loaded()) {
                    // if token is already present, delete it and create new token
                    $data = array(
                        'user_id'    => $user->pk(),
                        'expires'    => time() + 1209600,
                        'type'       => "activation_code",
                        'created'    => time(),
                    );
                    // Create a new activation token
                    $token = ORM::factory('user_token')
                        ->values($data)
                        ->create();
                }
                $email = base64_encode($user->email);
                
                $link = url::base()."pages/activate/".$email."/".$token->token;

                //send activation email
                $send_email = Email::factory('Activation Reminder callitme.com')
                    ->message(View::factory('mails/remind_activation_mail', array('user' => $user, 'link' => $link))->render(), 'text/html')
                    ->to($user->email)
                    ->from('noreply@ipintoo.com', 'Callitme')
                    ->send();
                
                $user->reminder_date = date('Y-m-d H:i:s');
                $user->save();
                
                echo date('j M, Y');
            }
            
        }
    }

    public function action_privilege() {
        $this->auto_render = false;
        if($this->request->post('add')) {
            $user = ORM::factory('user', $this->request->post('add'));
            $user->add('roles', ORM::factory('role')->where('name', '=', 'admin')->find());
            
            echo "added";
        } else if($this->request->post('remove')) {
            $user = ORM::factory('user', $this->request->post('remove'));
            $user->remove('roles', ORM::factory('role')->where('name', '=', 'admin')->find());
            
            echo "removed";
        }
    }
}
