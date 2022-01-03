<?php defined('SYSPATH') or die('No direct script access.');


class Controller_Nepalivivahregister extends Controller_Template {

    //public $template = 'templates/profile';
    
    public $template = 'templates/nepalivivah_register'; //template file
    
    public function before() 
    {
        parent::before();
        header('Content-Type: application/json');
        
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: bitmap;charset=utf'); 
        if(!Auth::instance()->logged_in()) {
            $this->template->header = View::factory('templates/nepalivivah_register'); //template header
        } else {
            $this->template->header = View::factory('templates/nepalivivah_register');
        }
        require_once Kohana::find_file('classes', 'libs/MCAPI.class');//Added by Ash
        //$this->template->footer = View::factory('templates/footer'); //template footer
        // $this->template->title = "Nepal's Largest Social Matrimony Site | Nepali Matrimony - Nepali Dating NepaliVivah"; //page title
        // $this->template->content = View::factory('accessapi/callitmeusername'); //page content
    }
    public function action_index()
    {
        echo "Api Section! Please stay out of here";
       //$this->template->content = View::factory('accessapi/index'); //page content 
        
    }
    public function action_signup()
    {
        if(Auth::instance()->logged_in()) 
        {
            $this->request->redirect(url::base());
        }
        
        $data = array();
        if ($this->request->query()) { // if post request, save user details
            $post_data = $this->request->query();
            
            try {
                //create bday element
                $post_data['birthday'] = $post_data['year']."-".$post_data['month']."-".$post_data['day'];
                $birthday=$post_data['year']."-".$post_data['month']."-".$post_data['day'];
                $first_name=$post_data['first_name'];

                $last_name=$post_data['last_name'];
                $age = date_diff(DateTime::createFromFormat('Y-m-d', $post_data['birthday']), date_create('now'))->y;

                if($age < 13) {
                    Session::instance()->set('error', "We are sorry, but you must be at least 13 years or older to use Amygoz. Come back once your hit 13!");
                } else {

                    //save details in users table and user_details table
                    $user = ORM::factory('user', array('email' => $post_data['email']));
                    $post_data['registration_steps'] = '2'; 
                    $post_data['registration_date'] = date('Y-m-d H:i:s'); 
        
                    /***************************************************************/
                    if(strlen($first_name.$last_name) < 30)
                        $suggestions[] = $first_name.$last_name;
                    if(strlen($last_name.$first_name) < 30)
                        $suggestions[] = $last_name.$first_name;
                    if(strlen($first_name.'-'.$last_name) < 30)
                        $suggestions[] = $first_name.'-'.$last_name;
                    if(strlen($last_name.'-'.$first_name) < 30)
                        $suggestions[] = $last_name.'-'.$first_name;

                    $birthyear = date('Y', strtotime($birthday));
                    $day = date('m', strtotime($birthday));

                    if(strlen($first_name.$last_name.$day) < 30)
                        $suggestions[] = $first_name.$last_name.$day;
                    if(strlen($last_name.$first_name.$day) < 30)
                        $suggestions[] = $last_name.$first_name.$day;

                    if(strlen($first_name.$last_name.$birthyear) < 30)
                        $suggestions[] = $first_name.$last_name.$birthyear;
                    if(strlen($last_name.$first_name.$birthyear) < 30)
                        $suggestions[] = $last_name.$first_name.$birthyear;

                    $exists = ORM::factory('user')
                        ->where('username', 'IN', $suggestions)
                        ->find_all()
                        ->as_array();

                    $already = array();
                    foreach($exists as $exist)
                    {
                        $already[] = $exist->username;
                    }

                    $suggestions = array_diff($suggestions, $already);
                    shuffle($suggestions); 
                    $suggestions = array_slice($suggestions, 0, 4);

                    /************************************************************************/
                    $post_data['website']='www.amygoz.com/'.$suggestions[0];
                    $allow = false;
                    if(!$user->id) {
                        $allow = true;
                        $user = ORM::factory('user');
                        $user_detail = ORM::factory('user_detail');
                        $user_detail->values($post_data);
                        $user_detail->save();
                        $post_data['user_detail_id'] = $user_detail->id;
                        $post_data['username'] = $suggestions[0];//Text::random(null, 11).$user_detail->id; 
                        $user->values($post_data);
                        $user->save();
                        
                    } else if($user->not_registered == 1) {
                        $allow = true;
                        $user_detail = $user->user_detail;
                        $user_detail->values($post_data);
                        $user_detail->save();
                        $post_data['username'] = $suggestions[0];//Text::random(null, 11).$user_detail->id; 
                        $post_data['not_registered'] = 0;
                        $user->values($post_data);
                        $user->save();
                    }

                    if($allow == true) {
                        $user->add('roles', ORM::factory('role')->where('name', '=', 'login')->find());
                        
                        if(!$user->plan->id) {
                            $user_plan = ORM::factory('user_plan');
                            $user_plan->user_id = $user->id;
                            $user_plan->name = 'free';
                            $user_plan->plan_expires = date("Y-m-d H:i:s", mktime(23, 59, 59, date("m")+1  , date("d")-1, date("Y")));
                            $user_plan->r_to_friend = 20;
                            $user_plan->save();
                        }
                        
                        //begin add to mailchimp - Added by Ash
                        $mc_instance = new MCAPI(Kohana::$config->load('mailchimp')->get('api_key'));
                        $first_name = $user_detail->first_name; // first name of the user
                        $last_name = $user_detail->last_name; // last name of the user
                        $email = $user->email; // email address of the user
                        $merge_vars = array('FNAME' => $first_name, 'LNAME'=> $last_name);
                        $list_id = Kohana::$config->load('mailchimp')->get('list_id');

                        $retval = $mc_instance->listSubscribe($list_id, $email, $merge_vars, 'html', false);
                        if ($mc_instance->errorCode) {
                            // there was an error, let's log it
                            echo "Unable to load listUpdateMember. \t
                            Code=".$mc_instance->errorCode."\n\tMsg=".$mc_instance->errorMessage."\n";
                        }

                        //end add to mailchimp - Added by Ash
                        $token = $this->activation_link($user);
                        echo "ok";
                        //Auth::instance()->force_login($user); // force login the user without password
                        //Session::instance()->set('social', 0);
                        //$this->request->redirect(url::base().'pages/newuser_profile'); //redirect to step2
                    } 
                    //else {
                    // Session::instance()->set('error', 'This email address is already registered.');
                    //}
                }
            } catch (ORM_Validation_Exception $e) { 
                Session::instance()->set('error',$e->errors(''));
            }
        }
        echo "Nepalivivah Register API";
    }

    private function activation_link($user, $forgot_password = '') {
        if (!empty($user)) {
            // Token data
            $data = array(
                'user_id'    => $user->pk(),
                'expires'    => time() + 1209600,
                'created'    => time(),
            );
            
            $data['type'] = (empty($forgot_password)) ? 'activation_code' : 'forgot_password';

            // Create a new activation token
            $token = ORM::factory('user_token')
                        ->values($data)
                        ->create();

            $email = base64_encode($user->email); // encode email for sending with the link
            
            if(empty($forgot_password)) {
                $link = url::base()."pages/activate/".$email."/".$token->token;

                $code = md5($user->username.$user->email);
                $deactivate = url::base()."pages/deactivate/".base64_encode($user->username)."/".$code;

                //send activation email
                 $send_email = Email::factory('Welcome '.$user->user_detail->first_name .' '.$user->user_detail->last_name .' to Amygoz')
                ->message(View::factory('mails/activation_mail', array('user' => $user, 'link' => $link, 'deactivate' => $deactivate))->render(), 'text/html')
                ->to($user->email)
                ->from('noreply@callitme.com', 'Amygoz')
                ->send();

            } else {
                $link = url::base()."pages/reset_password/".$email."/".$token->token;
                
                //send activation email
                $send_email = Email::factory('Reset Password')
                ->message(View::factory('mails/reset_password_mail', array('user' => $user, 'link' => $link))->render(), 'text/html')
                ->to($user->email)
                ->from('noreply@callitme.com', 'Amygoz')
                ->send();
            }

            return $token->token;
        }
    }

    public function action_update_info()
    {
        if($this->request->query())
        {
            $post_data = $this->request->query();
            $user = ORM::factory('user',array('email'=>$post_data['email']));
            $user_detail = $user->user_detail;
            $user_detail->values($post_data);
            $user_detail->save();
            echo "done";
            exit;
        }else{
            echo "not done";
            exit;
        }
        echo "Update info";
        exit;
    }

    public function action_profile_pic_update(){
        if($this->request->query())
        {
            $post_data = $this->request->query();
            $user = ORM::factory('user',array('email'=>$post_data['email']));

            $pic = $post_data['picture'];
            $filename = substr(strrchr($pic, "/"), 1);
            $final = str_replace(".jpg","",$filename);
            $profile_pic = $final.".jpg";
            $profile_pic_o = $final."_o.jpg";
            $profile_pic_m = $final."_m.jpg";
            $profile_pic_s = $final."_s.jpg";

            $newfile = "/var/www/html/mobile/upload/$profile_pic";
            $newfile1 = "/var/www/html/mobile/upload/$profile_pic_o";
            $newfile2 = "/var/www/html/mobile/upload/$profile_pic_m";
            $newfile3 = "/var/www/html/mobile/upload/$profile_pic_s";
            if(!copy($pic, $newfile) || !copy($pic, $newfile1) || !copy($pic, $newfile2) || !copy($pic, $newfile3))
            {
                echo "not copy";
                
            }else
            {
                echo "adasd yoooooooo";
                
            }
            if ($user->photo_id) {
                $photo = ORM::factory('photo', $user->photo_id);

            } else {
                $photo = ORM::factory('photo');

            }
            $photo = ORM::factory('photo', $user->photo_id);
                $photo->profile_pic = $profile_pic;
                $photo->profile_pic_o = $profile_pic_o;
                $photo->profile_pic_m = $profile_pic_m;
                $photo->profile_pic_s = $profile_pic_s;
                $photo->save();
                if (!$user->photo_id) 
                {
                    $user->photo_id = $photo->id;
                    $user->save();
                }
            $user->registration_steps = 'done';
            $user->save();
            exit;
        }

    }

    public function action_get_username()
    {
        if($this->request->query())
        {
            $user = ORM::factory('user',array('email'=>$this->request->query('email')));
            $responce = array('username'=>$user->username);
            echo json_encode($responce);
            exit; 
        }
        echo "No username ";
    }

    
}