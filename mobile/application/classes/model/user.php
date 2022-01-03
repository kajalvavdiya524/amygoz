<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * custom auth user
 *
 * @package   
 */
class Model_User extends Model_Auth_User {

    protected $_belongs_to = array(
        'user_detail' => array(),
        'photo' => array(),
        
    );
    
    protected $_has_one = array(
        'plan' => array(
            'model' => 'user_plan',
            'foreign_key' => 'user_id'
        )
    );
    
    protected $_has_many = array(
        'user_tokens' => array('model' => 'user_token'),
        'roles'       => array('model' => 'role', 'through' => 'roles_users'),
        'friends'     => array(
            'model'       => 'user',
            'through'     => 'friendships',
            'foreign_key' => 'user_id', 
            'far_key'     => 'friend_id'
        ),
        'posts' => array(
            'model' => 'post',
            'foreign_key' => 'user_id',
        ),
        'requests'    => array(
            'model'       => 'user',
            'through'     => 'requests',
            'foreign_key' => 'request_from',
            'far_key'     => 'request_to'
        ),
        'arequests' => array(
            'model' => 'arequest',
            'foreign_key' => 'to',
        ),
        'messages' => array(
            'model' => 'message',
            'foreign_key' => 'to',
        ),
        'sent_messages' => array(
            'model' => 'message',
            'foreign_key' => 'from',
        ),
        'recommendations' => array(
            'model' => 'recommend',
            'foreign_key' => 'to',
        ),
        'sent_recommendations' => array(
            'model' => 'recommend',
            'foreign_key' => 'from',
        ),
        'rec_req' => array(
            'model' => 'recommend_request',
            'foreign_key' => 'to',
        ),
        'match_req' => array(
            'model' => 'match',
            'foreign_key' => 'with',
        ),
        'payments' => array(
            'model' => 'payment',
            'foreign_key' => 'user_id',
        ),
        'viewers' => array(
            'model' => 'profile_view',
            'foreign_key' => 'user_id',
        ),
        'invites' => array(
            'model' => 'invite',
            'foreign_key' => 'user_id',
        ),
        'invited_by' => array(
            'model' => 'invite',
            'foreign_key' => 'invitee_id',
        ),
        'inspires' => array(
            'model' => 'inspire',
            'foreign_key' => 'user_id',
        ),
        'inspire_by' => array(
            'model' => 'invite',
            'foreign_key' => 'user_by',
        )
    );

    public function rules() {
        return array(
            'password' => array(
                array('not_empty'),
            ),
            'email' => array(
                array('not_empty'),
                array('email'),
                //array(array($this, 'unique'), array('email', ':value')),
            ),
            'username' => array(
                array('alpha_dash')
            ),
        );
    }

    public function unique_key($value) {
        return 'email';
    }

    public function check_username($username) {
        $exists = ORM::factory('user')
            ->where('username', '=', $username)
            ->where('id', '!=', $this->id)
            ->find();
        
        return $exists->id;
    }

    public function username_suggestions() {
        $first_name = strtolower($this->user_detail->first_name);
        $last_name = strtolower($this->user_detail->last_name);
        $suggestions = array();

        $suggestions[] = $first_name;
        if(strlen($first_name.$last_name) < 30)
            $suggestions[] = str_replace(' ','',$first_name.$last_name);
        if(strlen($last_name.$first_name) < 30)
            $suggestions[] = str_replace(' ','',$last_name.$first_name);
        if(strlen($first_name.'-'.$last_name) < 30)
            $suggestions[] = $first_name.'-'.$last_name;
        if(strlen($last_name.'-'.$first_name) < 30)
            $suggestions[] = $last_name.'-'.$first_name;

        $birthyear = date('Y', strtotime($this->user_detail->birthday));
        $day = date('m', strtotime($this->user_detail->birthday));

        if(strlen($first_name.$last_name.$day) < 30)
            $suggestions[] = str_replace(' ','',$first_name.$last_name.$day);
        if(strlen($last_name.$first_name.$day) < 30)
            $suggestions[] = str_replace(' ','',$last_name.$first_name.$day);

        if(strlen($first_name.$last_name.$birthyear) < 30)
            $suggestions[] = str_replace(' ','',$first_name.$last_name.$birthyear);
        if(strlen($last_name.$first_name.$birthyear) < 30)
            $suggestions[] = str_replace(' ','',$last_name.$first_name.$birthyear);

        $exists = ORM::factory('user')
            ->where('username', 'IN', $suggestions)
            ->find_all()
            ->as_array();

        $already = array();
        foreach($exists as $exist) {
            $already[] = $exist->username;
        }

        $suggestions = array_diff($suggestions, $already);
        shuffle($suggestions); 
        $suggestions = array_slice($suggestions, 0, 4);

        return $suggestions;
    }

    public function check_friends($user) {
        return $this->has('friends', $user) || $user->has('friends', $this);
    }

    public function check_requests($user) {
        return $this->has('requests', $user) || $user->has('requests', $this);
    }

    public function users_with_common_friends($limit = 4) {
        $subquery = DB::select('friend_id')->from('friendships')->where('user_id', '=', $this->id);

        $users = DB::select('ff.friend_id', array(DB::expr('COUNT(*)'), 'friends_in_common'))
        ->from(array('friendships', 'f'))
        ->join(array('friendships', 'ff'), 'LEFT')
        ->on('f.friend_id', '=', 'ff.user_id')
        ->WHERE('f.user_id', '=', $this->id)
        ->WHERE('ff.friend_id', 'NOT IN', $subquery)
        ->WHERE('ff.friend_id', '!=', $this->id)
        ->GROUP_BY('ff.friend_id')
        ->ORDER_BY('friends_in_common', 'DESC')
        ->limit($limit)
        ->as_assoc()
        ->execute()
        ->as_array();

        $ids = array();
        foreach($users as $u) {
            $ids[] = $u['friend_id'];
        }

        $users = array();
        if(!empty($ids))
            $users = ORM::factory('user')->where('id', 'IN', $ids)->find_all()->as_array();

        return $users;
    }

    public function mutual_friends($another_user) {
        $friend_ids = array();

        foreach($this->friends->find_all()->as_array() as $friend1) {
            $friend_ids[] = $friend1->id;
        }

        $mutual = array();
        foreach($another_user->friends->find_all()->as_array() as $friend2) {
            if(in_array($friend2->id, $friend_ids)) {
                $mutual[] = $friend2;
            }
        }

        return $mutual;
    }

    public function mutual_friends_by_gender($another_user, $gender) {
        $friend_ids = array();

        foreach($this->friends->find_all()->as_array() as $friend1) {
            if($friend1->user_detail->sex == $gender) {
                $friend_ids[] = $friend1->id;
            }
        }

        $mutual = array();
        foreach($another_user->friends->find_all()->as_array() as $friend2) {
            if(in_array($friend2->id, $friend_ids)) {
                $mutual[] = $friend2;
            }
        }

        return $mutual;
    }

    public function friends_by_gender($gender) {
        $friends = array();

        foreach($this->friends->find_all()->as_array() as $friend) {
            if($friend->user_detail->sex == $gender) {
                $friends[] = $friend;
            }
        }

        return $friends;
    }

    public function friends_by_gender_ex_mutual($gender, $mutuals) {
        $friends = array();

        foreach($this->friends->find_all()->as_array() as $friend) {
            if($friend->user_detail->sex == $gender && !in_array($friend->id, $mutuals)) {
                $friends[] = $friend;
            }
        }

        return $friends;
    }

    public function create_non_registered_user($email) {
        $user = ORM::factory('user');
        $user_detail = ORM::factory('user_detail');
        $user_detail->values(array());
        $user_detail->save();
        $post_data['user_detail_id'] = $user_detail->id;
        $post_data['email'] = $email;
        $post_data['password'] = Text::random(null, 11);
        $post_data['not_registered'] = 1;
        $post_data['username'] = Text::random(null, 11).$user_detail->id;
        $user->values($post_data);
        $user->save();
        
        //$user->add('roles', ORM::factory('role')->where('name', '=', 'login')->find());

        return $user;
    }
    public function create_non_registered_user_pp($email,$first_name,$last_name) {
        
            $user = ORM::factory('user');
            $post_data_u['first_name'] = $first_name;
            $post_data_u['last_name'] = $last_name;
            $user_detail = ORM::factory('user_detail');
            $user_detail->values($post_data_u);
            $user_detail->save();
            $post_data['user_detail_id'] = $user_detail->id;
            $post_data['email'] = $email;
            $post_data['password'] = Text::random(null, 11);
            $post_data['not_registered'] = 1;
            $post_data['username'] = Text::random(null, 11).$user_detail->id;
            $user->values($post_data);
            $user->save();
        
        //$user->add('roles', ORM::factory('role')->where('name', '=', 'login')->find());

        return $user;
    }

    public function check_plan_validity() {
        //check plan's validity
        $today = date("Y-m-d H:i:s");
        
        if(!$this->plan->id) {
            $user_plan = ORM::factory('user_plan');
            $user_plan->user_id = $this->id;
            $user_plan->name = 'free';
            $user_plan->plan_expires = date("Y-m-d H:i:s", mktime(23, 59, 59, date("m")+1  , date("d")-1, date("Y")));
            $user_plan->r_to_friend = 20;
            $user_plan->save();
        }

        if($this->plan->id && $today > $this->plan->plan_expires) {

            $r_to_friend_left = $this->plan->r_to_friend - $this->plan->r_to_friend_used;
            $r_to_anyone_left = $this->plan->r_to_anyone - $this->plan->r_to_anyone_used;
            $m_to_anyone_left = $this->plan->m_to_anyone - $this->plan->m_to_anyone_used;

            if(!empty($this->next_plan)) {
                $next_plan = ORM::factory('payment', $this->next_plan);
                $plan_detail = Kohana::$config->load('stripe')->get($next_plan->plan);

                $new_plan['name']            = $next_plan->plan;
                $new_plan['expires']         = $next_plan->payment_expires;

                $new_plan['r_to_friend']     = $r_to_friend_left + $plan_detail['r_to_friend'];
                $new_plan['r_to_anyone']     = $r_to_anyone_left + $plan_detail['r_to_anyone'];
                $new_plan['m_to_anyone']     = $m_to_anyone_left + $plan_detail['m_to_anyone'];

            } else {
                $new_expires = date("Y-m-d H:i:s",
                    mktime(23, 59, 59, date("m", strtotime($this->plan->plan_expires))+1,
                        date("d", strtotime($this->plan->plan_expires)),
                        date("Y", strtotime($this->plan->plan_expires))
                    )
                );
                $new_plan['name']            = 'free';
                $new_plan['expires']         = $new_expires;
                
                if($this->plan->name != 'free') {
                    $new_plan['r_to_friend']     = $r_to_friend_left + 20;
                } else {
                    if($r_to_friend_left > 20) {
                        $new_plan['r_to_friend'] = $r_to_friend_left;
                    } else {
                        $new_plan['r_to_friend'] = 20;
                    }
                }

                $new_plan['r_to_anyone']        = $r_to_anyone_left;
                $new_plan['m_to_anyone']        = $m_to_anyone_left;
            }
            
            $this->plan->name                   = $new_plan['name'];
            $this->plan->plan_expires           = $new_plan['expires'];
            $this->plan->r_to_friend            = $new_plan['r_to_friend'];
            $this->plan->r_to_anyone            = $new_plan['r_to_anyone'];
            $this->plan->m_to_anyone            = $new_plan['m_to_anyone'];
            $this->plan->r_to_friend_used       = 0;
            $this->plan->r_to_anyone_used       = 0;
            $this->plan->m_to_anyone_used       = 0;
            $this->plan->save();
            
            $this->next_plan = null;
            $this->save();

        }
    }

    public function calculate_social_percentage($tags) {
        if(!empty($tags)) {
            $keys = array_keys($tags);
            
            $multi = 0;
            $weightages = ORM::factory('recommend_word')->where('word', 'IN', $keys)->find_all()->as_array();
            
            foreach($weightages as $weightage) {

                if(array_key_exists($weightage->word, $tags)) {
                    $multi += ($tags[$weightage->word]*$weightage->weightage);
                }

            }

            $sum = 0;
            foreach($tags as $tag) {
                $sum += $tag;
            }
            
            $social = round(($multi/$sum)*100); //normalizing and rounding
        } else {
            $social = 0;
        }
        
        return $social;
    }

    public function check_registration_steps() {

        if($this->registration_steps == 1) {
            $this->registration_steps = 2;
            $this->save();
        }

        if($this->registration_steps == 'done') {

            if(Session::instance()->get('redirect_to')) {
                $redirect_to = Session::instance()->get_once('redirect_to');
                Request::current()->redirect(url::base().$redirect_to);
            }

            Request::current()->redirect(url::base());
        } else if($this->registration_steps == 2) {
            Request::current()->redirect(url::base().'pages/newuser_profile');
        } else if($this->registration_steps == 3) {
            Request::current()->redirect(url::base().'pages/newuser_photo');
        } else if($this->registration_steps == 4) {
            Request::current()->redirect(url::base().'pages/newuser_username');
        } else if($this->registration_steps == 5) {
            Request::current()->redirect(url::base().'pages/newuser_invites');
        } else if($this->registration_steps == 6) {
            Request::current()->redirect(url::base().'import');
        }

    }

}