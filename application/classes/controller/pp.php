<?php defined('SYSPATH') or die('No direct script access.');

//controller contains all the that does not require login
class Controller_Pp extends Controller_Template
{
      public $template = 'templates/pages'; //template file

    public function before() {
        parent::before();
        if(!Auth::instance()->logged_in()) {
            $this->template->header = View::factory('templates/header'); //template header
        } else {
            $this->template->header = View::factory('templates/members-header');
        }

        $this->template->footer = '';
        $this->template->description = "Find, meet and get inspired by great people around you.";
        $this->template->title = "Get Inspired | Amygoz";
        $this->template->content = "";
        require_once Kohana::find_file('classes', 'libs/MCAPI.class');//Added by Ash
    }

    public function action_index() {
        $username = $this->request->param('username'); // username
        $user = ORM::factory('user', array('username' => $username));
       
        $data_user = ORM::factory('user')->with('user_detail')
            ->where('username','=',$username)
            ->where('is_deleted', '=', 0)        
            ->find_all()
            ->as_array();
           
        if($user->profile_public == '1' && $user->is_deleted == 0) {
            $data['user'] = $user;
            $recommendations = $user->recommendations->where('state', '=', 'approve')->order_by('time', 'desc')->find_all()->as_array();

            $temp_words = array();
            foreach ($recommendations as $recommend) {
                $words = explode(', ', $recommend->words);
                $temp_words = array_merge($temp_words, $words);
            }
            $tags = array_count_values($temp_words);

            $data['tags'] = $tags;
            $data['social'] = $user->calculate_social_percentage($tags);

            $posts = DB::select('*')
            ->from('posts')
            ->where('user_id','=',$user->id)
            ->where('type','=','post')
            ->where('is_deleted','=','0')
            ->order_by('id', 'desc')
            ->execute()
            ->as_array();

            $data['posts'] = $posts;


            $inspires = DB::select('inspires.id','user_id','user_by','users.email','users.username','user_details.first_name','user_details.last_name','user_details.phase_of_life','user_details.designation','photos.profile_pic_o','photos.profile_pic')
            ->from('inspires')
            ->join('users','RIGHT')
            ->on('users.id','=','inspires.user_id')
            ->join('photos','LEFT')
            ->on('photos.id','=','users.photo_id')
            ->join('user_details','LEFT')
            ->on('users.user_detail_id','=','user_details.id')
            ->where('user_by','=',$user->id)
            ->where('status','=','1')
            ->order_by('id', 'desc')
            ->execute()
            ->as_array();

            $data['inspires'] = $inspires;

            $data['recommends'] = $user->recommendations->order_by('time', 'desc')->find_all()->as_array();
            $data['recommendations'] = $recommendations;

            $name = $user->user_detail->get_name();
            $keyword = $name." Reviews, " .$name. " Personality, " ."Trusted Profile of " .$name.", ";     
            $keyword .= "Public opinion of ".$name.",";
            $keyword .= " ".$name." ".$user->user_detail->location.", ";

            if(!empty($user->user_detail->designation)) {
                $keyword .= $name ." ".$user->user_detail->designation;
            }
            if(!empty($user->user_detail->employment)) {
                $keyword.= " at " .$user->user_detail->employment. " "; 
            }
            /* if(!empty($data['social'])) { 
                $keyword.=  "Amygoz profile with social percentile " . $data['social']. "%, " ; 
            } */

            if(count($data_user)) {
                $this->template->keywords =  $keyword;
                $this->template->title = $name . " - " . $user->user_detail->designation . " | Amygoz";
                $this->template->img = "https://www.amygoz.com/mobile/upload/" . $user->photo->profile_pic;

                $this->template->description = 'Read public opinion on ' . $name .' the '. $user->user_detail->designation .' and write your own opinion.' . $name . ' is ranked at ' . $data['social'] . '%';

                $this->template->content = View::factory('pp/profile', $data);
            } else {
                $this->request->redirect(url::base()."invalid_search");
            }

        } else {
           $this->request->redirect(url::base()."invalid_member");
        }
    }

    public function action_write_review() {
        $password = $this->request->post('password_type');
        $user_to = ORM::factory('user', array('username' => $this->request->post('username')));

        if($this->request->post()) {
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
                $word_exists = preg_match('/('.implode('|', $words).')/i', $this->request->post('message'));

                if($word_exists) { // return with an error.
                    Session::instance()->set('error_pp', 'This review contains improper words that are not allowed.');
                    //$this->request->redirect(url::base()."peoplereview/compose");
                    $this->request->redirect(url::base().$user_to->username);
                    //$this->request->redirect(url::base()."public/".$user_to->username);
                }
            }
        }
        
        if($password == 'Yes') {
            $username = $this->request->post('email'); //username
            $password = $this->request->post('password'); //password

            if(Auth::instance()->login($username, $password, true)) { // if login successfull
                $user = Auth::instance()->get_user();

                $account_expires = date("Y-m-d",
                    mktime(23, 59, 59, date("m", strtotime($user->registration_date)),
                        date("d", strtotime($user->registration_date))+3,
                        date("Y", strtotime($user->registration_date))
                    )
                );

                if($user->not_registered) {
                    $user->logins = new Database_Expression('logins - 1');
                    $user->save();
                    Auth::instance()->logout(); //logout
                    $data['msg'] = 'The email address or password you entered does not match our records.'; //error message to show
                } else if($user->is_deleted && $user->delete_expires < date('Y-m-d')) { //if user is blocked

                    $user->logins = new Database_Expression('logins - 1');
                    $user->save();
                    Auth::instance()->logout(); //logout
                    $data['msg'] = 'Your account has been deleted. Please contact our support team'; //error message to show
                } else if($user->is_blocked) { //if user is blocked

                    $user->logins = new Database_Expression('logins - 1');
                    $user->save();
                    Auth::instance()->logout(); //logout
                    $data['msg'] = 'Your account has been blocked. Please contact our support team'; //error message to show
                } else if (!$user->is_active && $account_expires < date("Y-m-d")) { // user is not activated

                    $user->logins = new Database_Expression('logins - 1');
                    $user->save();
                    Auth::instance()->logout(); //logout
                    $data['msg'] = 'Your account has been suspended because you have not activated your account yet.
                    Please activate your account <a href="'.url::base().'pages/resend_link"> Resend Activation Mail </a>.';
                } else {
                    /*********************Review Here*************************/
                    $user = Auth::instance()->get_user();
                    $post_data = $this->request->post();

                    $already = ORM::factory('recommend')->where('to', '=', $user_to->id)->where('from', '=', $user->id)->find();
                    if($already->id) {
                        $msg = "You have already reviewed ".$user_to->user_detail->first_name ;
                        Session::instance()->set('error_pp', $msg);
                        $this->request->redirect(url::base()."public/".$user_to->username);
                    } else {
                        $recommend = ORM::factory('recommend');
                        $post_data['to'] = $user_to->id;
                        $post_data['from'] = Auth::instance()->get_user()->id;
                        $post_data['state'] ='approve';

                        $post_data['message'] = strip_tags($post_data['message'], "<br>");
                        $post_data['words'] = implode(', ', $post_data['words']);
                        $post_data['time'] = date("Y-m-d H:i:s");

                        $recommend->values($post_data);
                        $recommend->save();

                        Session::instance()->set('success_pp', 'Your review has been successfully sent.');
                        $this->request->redirect(url::base()."public/".$user_to->username);
                    }

                }
            } else {
                Session::instance()->set('error_pp', 'Wrong Username or Password .');
            }
            
        } else if($password == 1 || $password == '1') {
            if($this->request->post()) {
                $user = Auth::instance()->get_user();
                $post_data = $this->request->post();

                $already = ORM::factory('recommend')->where('to', '=', $user_to->id)->where('from', '=', $user->id)->find();                
                if($already->id) {
                    $msg = "You have already reviewed ".$user_to->user_detail->first_name ;
                    Session::instance()->set('error_pp', $msg);
                    $this->request->redirect(url::base()."public/".$user_to->username);
                }

                $recommend = ORM::factory('recommend');
                $post_data['to'] = $user_to->id;
                $post_data['from'] = Auth::instance()->get_user()->id;
                $post_data['state'] ='approve';

                $post_data['message'] = strip_tags($post_data['message'], "<br>");
                $post_data['words'] = implode(', ', $post_data['words']);
                $post_data['time'] = date("Y-m-d H:i:s");

                $recommend->values($post_data);
                $recommend->save();
                Session::instance()->set('success_pp', 'Review successfull');
                $this->request->redirect(url::base()."public/".$user_to->username);
            } else {
                Session::instance()->set('error_pp', 'Your review cannot be submitted');
                $this->request->redirect(url::base()."public/".$user_to->username);
            }

        } else {
            if($this->request->post()) { // if post request, save user details
                $post_data = $this->request->post();

                try {
                    //create bday element
                    $post_data['birthday'] = $post_data['year']."-".$post_data['month']."-".$post_data['day'];
                    $birthday = $post_data['year']."-".$post_data['month']."-".$post_data['day'];
                    $first_name = $post_data['first_name'];
                    $last_name = $post_data['last_name'];

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
                        foreach($exists as $exist) {
                            $already[] = $exist->username;
                        }

                        $suggestions = array_diff($suggestions, $already);
                        shuffle($suggestions); 
                        $suggestions = array_slice($suggestions, 0, 4);

                        /************************************************************************/

                        $post_data['website'] = 'www.amygoz.com/'.$suggestions[0];
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

                            Auth::instance()->force_login($user); // force login the user without password

                            Session::instance()->set('social', 0);

                        } else {
                            Session::instance()->set('error', 'This email address is already registered.');
                        }
                    
                        $recommend = ORM::factory('recommend');
                        $post_data1['to'] = $user_to->id;
                        $post_data1['from'] = $user->id;
                        $post_data1['state'] ='approve';
                        $post_data1['message'] = strip_tags($post_data['message'], "<br>");
                        $post_data1['words'] = implode(', ', $post_data['words']);
                        $post_data1['time'] = date("Y-m-d H:i:s");

                        $recommend->values($post_data1);
                        $recommend->save();
                        
                        $this->request->redirect(url::base().'pages/newuser_profile'); //redirect to step2      

                    }

                } catch (ORM_Validation_Exception $e) { 
                    Session::instance()->set('error',$e->errors(''));
                }

            }

            Session::instance()->set('success_pp', 'Your review has been successfully sent.');
            $this->request->redirect(url::base()."public/".$user_to->username);
        }
    }
   
    public function action_create() {
        if(Auth::instance()->logged_in()) { 
            if($this->request->post()) {
                $user = Auth::instance()->get_user();
                $creater_id      =  $user->id;
                $first_name      =  trim($this->request->post('first_name'));
                $last_name       =  trim($this->request->post('last_name'));
                $location        =  $this->request->post('location');
                $designation     =  $this->request->post('about');
                $email           = strtolower($first_name.$last_name.$creater_id."@amygoz.com");
                $username        = strtolower($first_name."-". $last_name);
                $gender          = $this->request->post('gender');
                $username1="";

                $exists = ORM::factory('user')
                    ->where('username', '=', $username)
                    ->find_all()
                    ->as_array();

                foreach($exists as $exist) {
                    $username1 = $exist->username;
                }

                if($username1 == $username) {
                    $username=  $first_name."-". $last_name.$creater_id;
                    $email   = strtolower($first_name. $last_name .Text::random(null, 11)."@amygoz.com");
                }

                $username = strtolower($username);
                $post_data['first_name']  = $first_name;
                $post_data['last_name']   = $last_name;
                $post_data['sex']         = $gender;
                $post_data['designation'] = $designation ;
                //$post_data['website']     = $email ;
                $post_data['website']     = "www.amygoz.com/".$username ;
                $post_data['location']    = $location;
                $post_data['about']       = $designation;
                $user_detail = ORM::factory('user_detail');
                $user_detail->values($post_data);
                $user_detail->save();

                $post_data1['user_detail_id'] = $user_detail->id;
                $post_data1['username'] = $username;
                $post_data1['email'] = $email;
                $post_data1['creater_id'] = $creater_id ;
                $post_data1['profile_public'] ='1';
                $post_data1['password'] = Text::random(null, 11);
                $post_data1['not_registered'] = 0;
                $post_data1['is_deleted'] = 0;
                $user_pp = ORM::factory('user');
                $user_pp->values($post_data1);
                $user_pp->save();

                Session::instance()->set('username_p', $username);

                $this->request->redirect(url::base()."pp/add_photo");
            }

            $this->template->keywords ="Create public personality profile";
            $this->template->description ="Create a Public Personality in Amygoz";
            $this->template->title = "Create a Public Personality Profile | Amygoz";
            $this->template->content = View::factory('pp/add_public');
        } else {
            $this->request->redirect(url::base()."login?page=pp/create");
        }

    }

    public function action_add_photo() {
        $username =  Session::instance()->get('username_p');

        $user = ORM::factory('user', array('username' => $username));
        $data_user = ORM::factory('user')->with('user_detail')
            ->where('username','=',$username)
            ->find_all()
            ->as_array();

        $data['username'] = $username ;
        $data['user'] = $user;

        $this->template->keywords = "Create public personality profile ,Create Amygoz Public Profile";
        $this->template->description = "Create a Public Personality in Amygoz";
        $this->template->title = "Add Photo - Create a Public Personality Profile | Amygoz";
        $this->template->content = View::factory('pp/add_photo',$data);

    }

    public function action_upload_pic() {
        $this->auto_render = false;
        if( $this->request->post() ) {
            $username = $this->request->post('username');
            $user = ORM::factory('user', array('username' => $username));

            $data_user=ORM::factory('user')->with('user_detail')
                ->where('username','=',$username)
                ->find_all()
                ->as_array();

            $picture = Upload::save($_FILES['picture'], null , DOCROOT."mobile/upload/");
            $str = Text::random();
            $original = "pp-".$user->id ."-".$str."_o.jpg"; //original profile pic

            $image = Image::factory($picture);
            $image->resize(400, NULL);
            $image->save(DOCROOT."mobile/upload/".$original);
            $photo = ORM::factory('photo', $user->photo_id);

            try {
                //delete previous profile picture if exists
                if (file_exists(DOCROOT."upload/".$photo->profile_pic_o) || file_exists(DOCROOT."mobile/upload/".$photo->profile_pic_o)) {
                    unlink(DOCROOT."upload/".$photo->profile_pic_o);
                    unlink(DOCROOT."mobile/upload".$photo->profile_pic_o);
                }
                if (file_exists(DOCROOT."upload/".$photo->profile_pic) || file_exists(DOCROOT."mobile/upload".$photo->profile_pic)) {
                    unlink(DOCROOT."upload/".$photo->profile_pic);
                    unlink(DOCROOT."mobile/upload".$photo->profile_pic);
                }
                if (file_exists(DOCROOT."upload/".$photo->profile_pic_m) || file_exists(DOCROOT."mobile/upload".$photo->profile_pic_m)) {
                    unlink(DOCROOT."upload/".$photo->profile_pic_m);
                    unlink(DOCROOT."mobile/upload".$photo->profile_pic_m);
                }
                if (file_exists(DOCROOT."upload/".$photo->profile_pic_s) || file_exists(DOCROOT."mobile/upload".$photo->profile_pic_s)) {
                    unlink(DOCROOT."upload/".$photo->profile_pic_s);
                    unlink(DOCROOT."mobile/upload".$photo->profile_pic_s);
                }
            } catch(Exception $e) { }

            $image = Image::factory($picture);

            $str = Text::random();
            $name = "pp-".$user->id ."-".$str.".jpg"; //main profile pic
            $name_s = "pp-".$user->id ."-".$str."_s.jpg"; //small pic
            $name_m = "pp-".$user->id ."-".$str."_m.jpg"; //mini pic

            $image->resize(300, null);
            $image->save(DOCROOT."mobile/upload/".$name);
            $image->resize(null, 63);
            $image->save(DOCROOT."mobile/upload/".$name_s);

            $image->resize(null, 50);
            $image->save(DOCROOT."mobile/upload/".$name_m);

            //update image names in database
            $photo = ORM::factory('photo', $user->photo_id);
            $photo->profile_pic = basename($name);
            $photo->profile_pic_o = basename($original);
            $photo->profile_pic_m = basename($name_m);
            $photo->profile_pic_s = basename($name_s);
            $photo->save();
            if (!$user->photo_id) {
                $user->photo_id = $photo->id;
                $user->save();
            }

        }

        Session::instance()->set('s_img', 'profile picture uploaded successfully.');
        $this->request->redirect(url::base().$username);
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

    public function action_edit_public_data() {
        $user_detail_id = $this->request->post('user_detail_id');
        $user_detail_username = $this->request->post('user_detail_username');
        $edit_public = ORM::factory('user_detail')->where('id', '=', $user_detail_id)->find();
        $designation = $this->request->post('designation');
        $edit_public->designation = $designation;
        $edit_public->save();
        $this->request->redirect(url::base().$user_detail_username);
    }

}