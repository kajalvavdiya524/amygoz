<?php defined('SYSPATH') or die('No direct script access.');

//controller contains all the that does not require login
class Controller_Pages extends Controller_Template
{

    public $template = 'templates/pages'; //template file

    public function before() {
        parent::before();
        if(!Auth::instance()->logged_in()) {
            $this->template->header = View::factory('templates/header'); //template header
        } else {
            $this->template->header = View::factory('templates/members-header');
            //$this->template->header = View::factory('templates/header');
        }
        $this->template->footer = View::factory('templates/footer'); //template footer
        $this->template->description = "Get Inspired";
        require_once Kohana::find_file('classes', 'libs/firebase/firebaseLib');

        require_once Kohana::find_file('classes', 'libs/MCAPI.class');//Added by Ash
    }

    public function action_index() {
        if(Auth::instance()->logged_in())
            {
            $this->request->redirect(url::base());
      
            }
        
        $userss = ORM::factory('user')->with('user_detail')
                            
                            ->where('is_deleted', '=', 0)
                            ->limit(50)
                            ->find_all()
                            ->as_array();
         
                $viewer_count=ORM::factory('profile_view')
                            ->select('user_id','COUNT("user_id") AS counter')
                            ->group_by('user_id')
                            ->order_by('counter','DESC')
                            ->limit(4)
                            ->find_all()
                            ->as_array();
            $item_fix = ORM::factory('user')->with('user_detail')
                 
                            ->where('username', 'IN', array('rosspford','ClaraFelix','LIpKEOSyW9j814','KhkoEc1ppUz877'))
                            ->where('is_deleted', '=', 0)
                            ->and_where('photo_id','!=','')
                            //->and_where('profile_private','=', '1')
                            ->and_where('profile_public','=', '0')
                            //->order_by(DB::expr('RAND()'))
                            ->find_all()
                            ->as_array();
            //echo count($item_fix);
            $profile_public =  ORM::factory('user')->with('user_detail')
                            //->where('first_name','LIKE', $startswith.'%')
                            ->where('is_deleted', '=', 0)
                            ->and_where('profile_public', '=', '1')
                            //->order_by('first_name')
                            ->limit(4)
                            ->find_all()
                            ->as_array();
           $data['public_user']=$profile_public;
           $data['item_fix']=$item_fix;
           $data['viewer_count']=$viewer_count;
        
            $data['item']=$userss;
         $this->template->title = "Get Inspired | Amygoz";
        $this->template->header = View::factory('templates/header', array('page' => 'index')); //template header
        $this->template->content = View::factory('index',$data);
    }
public function action_search_s() { 
       if ($this->request->query('query')) {
            // autocomplete functionality for searching a user.
            $users =  ORM::factory('user')->with('user_detail')
                    ->where_open()
                    ->where('first_name','like', '%'.$this->request->query('query').'%')
                    ->or_where('last_name', 'like', '%'.$this->request->query('query').'%')
                    ->where_close()
                    ->where('not_registered', '=', 0)
                    ->find_all();

            $data['users'] = $users;
            $data['search_word'] = $this->request->query('query');
            
            $this->auto_render = false;
            echo View::factory('members/search_s',$data)->render();
        } else if($this->request->post('search_word')) {
            $users =  ORM::factory('user')->with('user_detail')
                ->where_open()
                    ->where('first_name','like', '%'.$this->request->post('search_word').'%')
                    ->or_where('last_name', 'like', '%'.$this->request->post('search_word').'%')
                ->where_close()
                ->find_all()
                ->as_array();
            
            $data['users'] = $users;
            $data['search_word'] = $this->request->post('search_word');
            
            $this->template->content = View::factory('members/members', $data);
        
        } else {
            $this->request->redirect(url::base());
        }
    }
    public function action_search() 
    {
                $data = array();
                if($this->request->query('q')) {
                    $name = explode(' ',$this->request->query('q'));
                    $name = array_filter($name);
                    $name = implode('|', $name);
                    // autocomplete functionality for searching a user.
                    $users =  ORM::factory('user')->with('user_detail')
                        ->where_open()
                        ->where('first_name','REGEXP', '^('.$name.')')
                        ->or_where('last_name', 'REGEXP', '^('.$name.')')
                        ->where_close()
                        ->where('not_registered', '=', 0)
                        ->find_all()
                        ->as_array();
                    $data['users'] = $users;
                    $data['search'] = $this->request->query('q');
                }
                $this->template->title = 'Public Search | Amygoz';
                $this->template->content = View::factory('search', $data);
    }
    public function action_register() {
        if(Auth::instance()->logged_in()) {
            $this->request->redirect(url::base());
        }

        $this->template->title = 'Register | Amygoz';
        $this->template->content = View::factory('register');
    }

    public function action_signup() {
        if(Auth::instance()->logged_in()) {
            $this->request->redirect(url::base());
        }

        $data = array();
        if ($this->request->post()) { // if post request, save user details
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
                        $suggestions[] = strtolower($first_name.$last_name);
                    if(strlen($last_name.$first_name) < 30)
                        $suggestions[] = strtolower($last_name.$first_name);
                    if(strlen($first_name.'-'.$last_name) < 30)
                        $suggestions[] = strtolower($first_name.'-'.$last_name);
                    if(strlen($last_name.'-'.$first_name) < 30)
                        $suggestions[] = strtolower($last_name.'-'.$first_name);

                    $birthyear = date('Y', strtotime($birthday));
                    $day = date('m', strtotime($birthday));

                    if(strlen($first_name.$last_name.$day) < 30)
                        $suggestions[] = strtolower($first_name.$last_name.$day);
                    if(strlen($last_name.$first_name.$day) < 30)
                        $suggestions[] = strtolower($last_name.$first_name.$day);

                    if(strlen($first_name.$last_name.$birthyear) < 30)
                        $suggestions[] = strtolower($first_name.$last_name.$birthyear);
                    if(strlen($last_name.$first_name.$birthyear) < 30)
                        $suggestions[] = strtolower($last_name.$first_name.$birthyear);

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
                        if(!$user->has('roles', ORM::factory('role')->where('name', '=', 'login')->find())) {
                            $user->add('roles', ORM::factory('role')->where('name', '=', 'login')->find());
                        }
                        
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
                        $this->request->redirect(url::base().'pages/newuser_profile'); //redirect to step2
                    } else {
                        Session::instance()->set('error', 'This email address is already registered.');
                    }

                }

            } catch (ORM_Validation_Exception $e) { 
                Session::instance()->set('error', implode('<br />', $e->errors('')));
            }

        }

        $this->request->redirect(url::base()."pages/register");
    }

    public function action_newuser_profile() {
        if(!Auth::instance()->logged_in()) {
            $this->request->redirect(url::base());
        }

        $user = Auth::instance()->get_user();
        if($user->registration_steps == 2) {

            if($this->request->post()) {
                $post_data = $this->request->post();
                //save member details
                $exists_phone = ORM::factory('user_detail', array('phone' => $post_data['phone']));
                if(!$exists_phone->id) {
                    $user->user_detail->values($post_data);
                    $user->user_detail->save();
                    $this->action_skip_step();
                } else {
                    session::instance()->set('phone_exists','This phone number is already ragistered.');
                    $this->request->redirect(url::base());
                }
            }

            $this->template = View::factory('templates/pages');
            $this->template->title = 'Step 2 | Tell us more about yourself | Amygoz';
            $this->template->header = View::factory('templates/header_newuser');
            $this->template->footer = '';// View::factory('templates/footer');
            $this->template->description = "Tell more about yourself"; //Added by Ash

            $this->template->content = View::factory('step1')->bind('user', $user);
        } else {
            $user->check_registration_steps();
        }
    }

    public function action_newuser_photo() {
        if(!Auth::instance()->logged_in()) {
            $this->request->redirect(url::base());
        }

        $user = Auth::instance()->get_user();

        if($user->registration_steps == 3) {
            $this->template = View::factory('templates/pages');
            $this->template->title = 'Step 3 | Upload your profile picture | Amygoz';
            $this->template->header = View::factory('templates/header');
            $this->template->footer = '';//View::factory('templates/footer');
            $this->template->description = 'Profile Photo'; //Added by Ash
            $this->template->content = View::factory('step2')->bind('user',$user);
        } else {
            $user->check_registration_steps();
        }
    }

    public function action_save_photo17JULY2017() {
        if(!Auth::instance()->logged_in()) {
            $this->request->redirect(url::base());
        }

        $this->auto_render = false;

        if( $this->request->post() ) {
            $user = Auth::instance()->get_user();
        
            if( $this->request->post('crop') ) {
                $post_data = $this->request->post();
                if ($user->photo_id) {
                    $photo = ORM::factory('photo', $user->photo_id);

                    try {
                        //delete previous profile picture if exists
                        if (file_exists(DOCROOT."upload/".$photo->profile_pic_o))
                            unlink(DOCROOT."upload/".$photo->profile_pic_o);
                        if (file_exists(DOCROOT."upload/".$photo->profile_pic))
                            unlink(DOCROOT."upload/".$photo->profile_pic);
                        if (file_exists(DOCROOT."upload/".$photo->profile_pic_m))
                            unlink(DOCROOT."upload/".$photo->profile_pic_m);
                        if (file_exists(DOCROOT."upload/".$photo->profile_pic_s))
                            unlink(DOCROOT."upload/".$photo->profile_pic_s);

                    } catch(Exception $e) { }
                } else {
                    $photo = ORM::factory('photo');
                }
                $original = DOCROOT."upload/".$this->request->post('imag_name');
                $image = Image::factory($original);
                $str = Text::random();
                $name = "pp-".$user->id ."-".$str.".jpg"; //main profile pic
                $name_s = "pp-".$user->id ."-".$str."_s.jpg"; //small pic
                $name_m = "pp-".$user->id ."-".$str."_m.jpg"; //mini pic                
                $post_data['x1'] = !empty($post_data['x1']) ? $post_data['x1'] : 0;
                $post_data['y1'] = !empty($post_data['y1']) ? $post_data['y1'] : 0;
                $post_data['x2'] = !empty($post_data['x2']) ? $post_data['x2'] : $image->width;
                $post_data['y2'] = !empty($post_data['y2']) ? $post_data['y2'] : $image->height;            
                $new_w = $post_data['x2'] - $post_data['x1'];
                $new_h = $post_data['y2'] - $post_data['y1'];
                $image->crop($new_w, $new_h, $post_data['x1'], $post_data['y1']);
                $image->save(DOCROOT."upload/".$name);                
                $image->resize(270, null);
                $image->save(DOCROOT."upload/".$name);               
                $image->resize(null, 63);
                $image->save(DOCROOT."upload/".$name_s);
                $image->resize(null, 50);
                $image->save(DOCROOT."upload/".$name_m);
                $photo = ORM::factory('photo', $user->photo_id);
                $photo->profile_pic = basename($name);
                $photo->profile_pic_o = basename($this->request->post('imag_name'));
                $photo->profile_pic_m = basename($name_m);
                $photo->profile_pic_s = basename($name_s);
                $photo->save();
                if (!$user->photo_id) 
                {
                    $user->photo_id = $photo->id;
                    $user->save();
                }
                $this->action_skip_step();
            } 
            else 
            {
                $picture = Upload::save($_FILES['picture'], null , DOCROOT."upload/");
                $str = Text::random();
                $original = "pp-".$user->id ."-".$str."_o.jpg"; //original profile pic

                $image = Image::factory($picture);
                $image->resize(600, 500);
                $image->save(DOCROOT."upload/".$original);

                $data['width']  = $image->width + 60;
                $data['height']  = $image->height + 190;
                $data['image'] = $original;
                
                try {
                    unlink($picture);
                } catch (Exception $e) {}
                
                echo json_encode($data);
            }
        
        }

    }
    public function action_save_photo() 
    {
        $this->auto_render = false;
                if( $this->request->post() )
                {
                $user = Auth::instance()->get_user();
                $name1= $_FILES["picture"]['name'];
                $ext = end((explode(".", $name1))); # extra () to prevent notice
                $picture = Upload::save($_FILES['picture'], null , DOCROOT."upload/");
                $str = Text::random();
                $original = "pp-".$user->id ."-".$str."_o.jpg"; //original profile pic

                //resize to different sizes
                $image = Image::factory($picture);
                $image->resize(800, NULL);
                $image->save(DOCROOT."upload/".$original);
                $photo = ORM::factory('photo', $user->photo_id); 
                    try {
                       if (file_exists(DOCROOT."upload/".$photo->profile_pic))
                            unlink(DOCROOT."upload/".$photo->profile_pic);
                        if (file_exists(DOCROOT."upload/".$photo->profile_pic_m))
                            unlink(DOCROOT."upload/".$photo->profile_pic_m);
                        if (file_exists(DOCROOT."upload/".$photo->profile_pic_s))
                            unlink(DOCROOT."upload/".$photo->profile_pic_s);
                            
                    } catch(Exception $e) { }
                // $image = Image::factory($picture);
                 $str = Text::random();
                 $name = "pp-".$user->id ."-".$str.".jpg"; //main profile pic
                 $name_s = "pp-".$user->id ."-".$str."_s.jpg"; //small pic
                 $name_m = "pp-".$user->id ."-".$str."_m.jpg"; //mini pic

                if($ext=='jpg' || $ext=='jpeg' || $ext=='TIFE') 
                  {                                                                
                    $exif = exif_read_data($picture);
                  } 
                  else {
                      $exif=$picture;
                    }
            if (isset($exif['Orientation'])) 
            {
                $image = Image::factory($picture);
                $ort =   $exif['Orientation'];
               
                switch ($ort) {
                    case 1: // nothing
                        break;

                    case 2: // horizontal flip
                        $image->flip(Image::HORIZONTAL);
                        break;

                    case 3: // 180 rotate left
                        $image->rotate(-180);
                        break;

                    case 4: // vertical flip
                        $image->flip(Image::VERTICAL);
                        break;

                    case 5: // vertical flip + 90 rotate right
                        $image->flip(Image::VERTICAL);
                        $image->rotate(90);
                        break;

                    case 6: // 90 rotate right
                        $image->rotate(90);
                        break;

                    case 7: // horizontal flip + 90 rotate right
                        $image->flip(Image::HORIZONTAL);
                        $image->rotate(90);
                        break;

                    case 8:    // 90 rotate left
                        $image->rotate(-90);
                        break;
                }
                $image->save();
            }

                $image->resize(800, null);
                //$image->crop(400,400);
                $image->save(DOCROOT."upload/".$name); 
                $image->resize(null, 63);
                $image->save(DOCROOT."upload/".$name_s);
                $image->resize(null, 50);
                $image->save(DOCROOT."upload/".$name_m);
                //update image names in database
                $photo = ORM::factory('photo', $user->photo_id);
                $photo->profile_pic   = basename($name);
                $photo->profile_pic_o = basename($original);
                $photo->profile_pic_m = basename($name_m);
                $photo->profile_pic_s = basename($name_s);
                $photo->save();
                if (!$user->photo_id) 
                {
                    $user->photo_id = $photo->id;
                    $user->save();
                }
               $this->action_skip_step();   
        }
    }

    public function action_newuser_username() {
        if(!Auth::instance()->logged_in()) {
            $this->request->redirect(url::base());
        }

        $user = Auth::instance()->get_user();

        if($user->registration_steps == 4) {
            if( $this->request->post() ) {
                if(!$user->check_username($this->request->post('username'))) {
                    $user->username = $this->request->post('username');
                    $user->save();

                    $this->action_skip_step();
                } else {
                    Session::instance()->set('error', 'Username already exists.');
                }
            }

            $data['suggestions'] = $user->username_suggestions();
            $data['user'] = $user;

            $this->template = View::factory('templates/pages');
            $this->template->title = 'Step 4 | Choose Username | Amygoz';
            $this->template->header = View::factory('templates/header');
            $this->template->footer = '';//View::factory('templates/footer');
            $this->template->description = 'Choose Username'; //Added by Ash
            
            $this->template->content = View::factory('step3', $data);
        } else {
            $user->check_registration_steps();
        }
    }

    public function action_newuser_invites() {
        if(!Auth::instance()->logged_in()) {
            $this->request->redirect(url::base());
        }

        $user = Auth::instance()->get_user();

        if($user->registration_steps == 5) {
            $invites = $user->invited_by->find_all()->as_array();

            $this->activity = new Model_Activity;
            foreach($invites as $invite) {
                if(!$invite->informed) {
                    $this->activity->new_activity('joined', 'just joined Amygoz <b> Add as friend</b>.', $invite->user_id, $user->id);

                    $send_email = Email::factory($user->user_detail->get_name()." just joined Amygoz! Want to connect?")
                    ->message(View::factory('mails/contact_joined', array('invite' => $invite))->render(), 'text/html')
                    ->to($invite->by->email)
                    ->from('noreply@callitme.com', 'Amygoz')
                    ->send();
                }
            }

            DB::update(ORM::factory('invite')->table_name())
            ->set(array('informed' => 1))
            ->set(array('joined' => 1))
            ->where('invitee_id', '=', $user->id)
            ->execute();

            $data['invites'] = $invites;

            $this->template = View::factory('templates/pages');
            $this->template->title = 'Step 5 | People that have invited you | Amygoz';
            $this->template->header = View::factory('templates/header_newuser');
            $this->template->footer =' ';//View::factory('templates/footer');
            $this->template->description = 'People who have invited you to join Amygoz'; //Added by Ash

            $this->template->content = View::factory('step5', $data);
        } else {
            $user->check_registration_steps();
        }

    }

    public function action_skip_step() {
        if(!Auth::instance()->logged_in()) {
            $this->request->redirect(url::base());
        }

        $user = Auth::instance()->get_user();

        if($user->registration_steps == 6) {
            $user->registration_steps = 'done';
        } else if($user->registration_steps == 4) {

            if($user->invited_by->count_all() > 0) {
                $user->registration_steps += 1;
            } else {
                $user->registration_steps += 2;
            }

        } else {
            $user->registration_steps += 1;
        }

        $user->save();
        $user->check_registration_steps();
    }

     public function action_redirect_to() {

        $username = $this->request->param('id');
        $page = urldecode($this->request->query('page'));
        
        
        if(Auth::instance()->logged_in()) 
        {
            $this->request->redirect(url::base().$page);
        } 
        else 
        {
            $user = ORM::factory('user', array('username' => $username));
            Session::instance()->set('redirect_to', $page);

            if(!$user->id || $user->not_registered == 1) {
               // $this->request->redirect(url::base()."register");
                $this->request->redirect(url::base());
            }

            /*if(!$user->id ) {
                //$this->request->redirect(url::base()."pages/register");
                $this->request->redirect(url::base()."login");
            }*/

        }

        $this->request->redirect(url::base()."login");

    }


    public function action_login() {
        if(Auth::instance()->logged_in())
         {
            $this->request->redirect(url::base());
        }
             $data = array();
             
             
             
           
              //Session::instance()->set('redirect_to', $this->request->query('page'));
              //Session::instance()->set('redirect_to_import', $this->request->post('page1'));
             
              /*if($this->request->query('page')=="")
              {
               Session::instance()->set('redirect_to', $this->request->post('page'));
              
              }*///remove by pchauhan 21 july
           
          
            if(!empty($_GET['page']))
              {
               Session::instance()->set('redirect_to', $_GET['page']);
              
              }
            
            
              if($this->request->query('page1')!=" ")
             {
                 Session::instance()->set('redirect_to_import', $this->request->post('page1'));
            
             }
          
            if($this->request->post('data1')!=" ")
            {

                     Session::instance()->set('plan',$this->request->post('data1'));
                     Session::instance()->set('user_email',$this->request->post('data2'));
                     echo Session::instance()->get('plan');
                     echo Session::instance()->get('user_email');
                     
            }
                   
            $data['page']=Session::instance()->get('redirect_to');
            if ($this->request->post()) 
            { // if post request, save user details
                
                //temporary fix for fixing session cookie
                if (isset($_SERVER['HTTP_COOKIE'])) {
                    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
                    foreach($cookies as $cookie) {
                        $parts = explode('=', $cookie);
                        $name = trim($parts[0]);
                        setcookie($name, '', time()-1000);
                        setcookie($name, '', time()-1000, '/');
                    }
                }
                
                if($this->request->post('page')!='')
                {
                    Session::instance()->set('redirect_to', $this->request->post('page'));
                }
           $username = $this->request->post('email'); //username
           $password = $this->request->post('password'); //password


            if (Auth::instance()->login($username, $password, true))
             { // if login successfull
                $user = Auth::instance()->get_user();

                $account_expires = date("Y-m-d",
                    mktime(23, 59, 59, date("m", strtotime($user->registration_date)),
                        date("d", strtotime($user->registration_date))+3,
                        date("Y", strtotime($user->registration_date))
                    )
                );

                if($user->not_registered)
                {
                    $user->logins = new Database_Expression('logins - 1');
                    $user->save();
                    Auth::instance()->logout(); //logout
                    $data['msg'] = 'The email address or password you entered does not match our records.'; //error message to show
                } /*else if($user->is_deleted && $user->delete_expires < date('Y-m-d')) { //if user is blocked

                    $user->logins = new Database_Expression('logins - 1');
                    $user->save();
                    Auth::instance()->logout(); //logout
                    $data['msg'] = 'Your account has been deleted. Please contact our support team'; //error message to show
                }*/ else if($user->is_blocked) { //if user is blocked

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
                } else {                    //if user is active redirect to post streaming page

                    if($user->is_deleted) {
                        $user->is_deleted = 0;
                        $user->delete_expires = null;
                        $user->save();
                    }
                    //add ip details in logged user table
                    $logged_user = ORM::factory('logged_user');
                    $logged_user->user_id = $user->id;
                    $logged_user->ip = Request::$client_ip;
                    $logged_user->user_agent = Request::$user_agent;
                    $logged_user->login_time = date('Y-m-d H:i:s');
                    $logged_user->save();
                    
                    Session::instance()->set('logged_user', $logged_user);

                    $user->ip = Request::$client_ip;
                    $api_key = Kohana::$config->load('contact')->get('ip_api');
                    
                    $url = "http://api.ipinfodb.com/v3/ip-city/?key=$api_key&ip=$user->ip&format=json";
                    $ch  = curl_init();

                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                    $data = curl_exec($ch);
                    curl_close($ch);

                    if ($data) {
                        $location = json_decode($data);

                        $lat = ($location) ? $location->latitude : 0;
                        $lon = ($location) ? $location->longitude : 0;

                        $user->latitute = $lat;
                        $user->longitude = $lon;
                    }

                    $user->save();
                    
                    if(!$user->plan->id) {
                        $user_plan = ORM::factory('user_plan');
                        $user_plan->user_id = $user->id;
                        $user_plan->name = 'free';
                        $user_plan->plan_expires = date("Y-m-d H:i:s", mktime(23, 59, 59, date("m")+1  , date("d")-1, date("Y")));
                        $user_plan->r_to_friend = 20;
                        $user_plan->save();
                    }
                    
                    //social score
                    $recommendations = $user->recommendations->where('state', '=', 'approve')->find_all()->as_array();

                    $temp_words = array();
                    foreach($recommendations as $recommend) {
                        if($recommend->state == 'approve') { 
                            $words = explode(', ', $recommend->words);
                            $temp_words = array_merge($temp_words, $words);
                        }
                    }

                    $tags = array_count_values($temp_words);

                    $social = $user->calculate_social_percentage($tags);

                    Session::instance()->set('social', $social);

                    $user->check_plan_validity();
                    
                    if(Session::instance()->get('redirect_to') && $user->registration_steps == 'done') 
                    {
                        $redirect_to = Session::instance()->get_once('redirect_to');
                        $this->request->redirect(url::base().$redirect_to);
                    }
                    if( Session::instance()->get('redirect_to_import')&& $user->registration_steps == 'done') 
                    {
                        $redirect_to_import=Session::instance()->get('redirect_to_import');
                        $this->request->redirect($redirect_to_import);
                    }

                    if (Session::instance()->get('redirect_to'))
                    {
                        echo Session::instance()->get('redirect_to');
                        die();
                        exit;
                        $redirect_url1 = Session::instance()->get_once('redirect_to');
                            $redirect_url = url::base() . Auth::instance()->get_user()->username . $redirect_url1;
                            $this->request->redirect($redirect_url);
                    } 
                    else
                    {
                        $redirect_url = Session::instance()->get_once('redirect_to');
                        $this->request->redirect($redirect_url);
                    }
                    

                    $this->request->redirect(url::base()); //redirect to home page
                }
            } else { 
                $data['msg'] = 'The email address or password you entered does not match our records.';
            }
        }
        $this->template->title = 'Login | Amygoz';
        $this->template->content = View::factory('login')->set($data);
    }

    public function action_logout() {
        //Begin delete record form currently logged users added by Ash
        if(Session::instance()->get('logged_user')) {
            $logged_user = Session::instance()->get('logged_user');
            $logged_user->logout_time = date('Y-m-d H:i:s');
            $logged_user->save();
        }
        //end delete record form currently logged users added by Ash
        
        Session::instance()->delete('social');
        Session::instance()->delete('logged_user');
        
        Auth::instance()->logout(); //logout
        //$this->request->redirect(url::base().'pages/logout');
        Session::instance()->destroy();
        //$this->request->redirect(url::base());
        $userss = ORM::factory('user')->with('user_detail')
           //->where('profile_private','=','0')
            ->where('profile_public', '=', '1')
            ->where('is_deleted', '=', 0)
            ->limit(50)
            ->find_all()
            ->as_array();
        
        $viewer_count=ORM::factory('profile_view')
            ->select('user_id','COUNT("user_id") AS counter')
            ->group_by('user_id')
            ->order_by('counter','DESC')
            ->limit(4)
            ->find_all()
            ->as_array();
        $data['viewer_count']=$viewer_count;
        
        $data['item']=$userss;
        
        //temporary fix for fixing session cookie
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time()-1000);
                setcookie($name, '', time()-1000, '/');
            }
        }
        
        $this->template->title = "Activities | Amygoz";
        $this->template->header = View::factory('templates/header', array('page' => 'index')); //template header
        $this->template->content = View::factory('staticpages/signout',$data);
    }

    public function action_thank_you() {
        $this->template->title = 'Thank You | Amygoz';
        $this->template->content = View::factory('thank_you');
    }

    public function action_unique_email() {
        // check if the email in sign up page is unique or not
        $this->auto_render = false;
        if($this->request->post()) {

            if(Auth::instance()->logged_in()) {
                $user = ORM::factory('user')
                        ->where('email', '=', $this->request->post('email'))
                        ->where('id', '!=', Auth::instance()->get_user()->id)
                        ->find();
            } else {
                $user = ORM::factory('user')
                    ->where('email', '=', $this->request->post('email'))
                    ->where('not_registered', '=', 0)
                    ->find();
            }

            if($user->id) {
                echo '1'; 
            } else {
                echo '0';
            }
        }
    }

    public function action_profile() {
        $username = $this->request->param('username'); // username
        $user = ORM::factory('user', array('username' => $username));
       
        $data_user=ORM::factory('user')->with('user_detail')
            ->where('username','=',$username)
            ->find_all()
            ->as_array();

        if($user->profile_public=='1') {
            $path=url::base()."public/".$username;
            $this->request->redirect($path);
        }

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
        $data['friends'] = $user->friends->order_by(DB::expr('RAND()'))->find_all()->as_array();


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


        $data['recommendations'] = $recommendations;
        $userss = ORM::factory('user')->with('user_detail')
            ->where('sex', '=', $user->user_detail->sex)
            ->and_where('profile_public','=','0')
            ->where('username', '!=', $username)              
            ->where('is_deleted', '=', 0)
            ->order_by(DB::expr('RAND()'))    
            ->limit(8)
            ->find_all()
            ->as_array();
        $data['item'] = $userss;

        $name = $user->user_detail->get_name();
        $keyword = $name." Reviews, " .$name. " Personality, ";
        $keyword .= $name." ".$user->user_detail->location . ", Friends of ".$name;
        /* if(!empty($user->user_detail->designation)){ $keyword.= " and works as " .$user->user_detail->designation ; }
        if(!empty($user->user_detail->employment)){ $keyword.= " at " .$user->user_detail->employment. " ," ; }
        if(!empty($data['social'])){ $keyword.=  " social percentage " . $data['social']. " ," ; }
        if(!empty($user->friends)){ $keyword.=  " Friends of ".$user->friends."".$name. " ," ; } */

        if (count($data_user)) {
            $this->template->keywords =  $keyword;
            $title_str = $name;
            if(!empty($user->user_detail->employment)){
                $title_str .= " - ".$user->user_detail->employment;
            }
            if(!empty($user->user_detail->designation)){
                $title_str .= " - ".$user->user_detail->designation;
            }
            if(!empty($user->user_detail->location)){
                $title_str .= " - ".$user->user_detail->location;
            }
            $this->template->title = $title_str .' | Amygoz';
            $this->template->img = "http://m.amygoz.com/upload/" . $user->photo->profile_pic;
            $this->template->description = 'View ' . $name . '\'s full profile on Amygoz. People like you and ' . $name . ' from '.$user->user_detail->location . 'find new friends and meet trusted people online in Amygo.com. Find ' . $name . '\'s  friends, family, education, school, job and reviews.';

            $this->template->header = View::factory('templates/header', array('page' => 'index')); //template header
            $this->template->content = View::factory('profile', $data);
        } else {
            $this->request->redirect(url::base()."invalid_search");
        }
    }

    public function action_change_email() {
        $email = base64_decode($this->request->param('id')); //decode email address
        $token = $this->request->param('page'); // activation token

        if(!empty($email) && !empty($token)) {
            //find token with type activation code
            $token = ORM::factory('user_token', array('token' => $token, 'type' => "change_email"));

            if ($token->loaded() && $token->user->loaded() && ($token->user->new_email == $email)) {
                // if token is valid and email address matches activate user and delete the token
                $user = $token->user;

                $default_path = Kohana::$config->load('settings')->get('firebase')['databaseURL'];
                $firebase = new \Firebase\FirebaseLib($default_path);

                $credentials = array(
                    'email' => $user->email,
                    'password' => $user->firebase_password,
                    'returnSecureToken' => true
                );

                $key = Kohana::$config->load('settings')->get('firebase')['apiKey'];
                $firebase_user = json_decode($firebase->auth($key, $credentials));

                $user->email = $email;
                $user->new_email = null;
                $user->save();

                $token->delete();

                $change_email_firebase = array(
                    "email"=>$user->email,
                    "idToken"=>$firebase_user->idToken
                );
                $this->change_firebase_email($key,$change_email_firebase);

                Session::instance()->set('main_success', 'Your email address has been changed successfully.');
                $this->request->redirect(url::base());
            } else {
                Session::instance()->set('main_error', 'This link is invalid.'); //if link is not valid
            }

        }

        $this->request->redirect(url::base());
    }

    private function change_firebase_email($key,$data){
        $auth_url = "https://identitytoolkit.googleapis.com/v1/accounts:update?key=".$key;
        try {
            $ch = $this->_curlHandler;
            curl_setopt($ch, CURLOPT_URL, $auth_url);
            curl_setopt($ch, CURLOPT_TIMEOUT, $this->_timeout);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->_timeout);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

            $jsonData = json_encode($data);
            $header = array(
                'Content-Type: application/json'
            );

            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
            $return = curl_exec($ch);
        } catch (Exception $e) {
            $return = null;
        }

        return $return;
    }

    private function get_firebase_conn($user) {
        $default_path = Kohana::$config->load('settings')->get('firebase')['databaseURL'];
        $firebase = new \Firebase\FirebaseLib($default_path);

        $credentials = array(
            'email' => $user->email,
            'password' => $user->firebase_password,
            'returnSecureToken' => true
        );

        $key = Kohana::$config->load('settings')->get('firebase')['apiKey'];
        $user = $firebase->auth($key, $credentials);

        $user = json_decode($user);
        $firebase->setToken($user->idToken);

        return $firebase;
    }

    public function action_forgot_password(){
        if(Auth::instance()->logged_in()) {
            $this->request->redirect(url::base());
        }

        $data = array();
        if ($this->request->post()) { // if post request
            $email = $this->request->post('email');

            //check user exists for this email
            $user = ORM::factory('user', array('email' => $email));
            if ($user->loaded() && $user->not_registered !== '1') {

                // check if token is already there for the user
                $token = ORM::factory('user_token', array('user_id' => $user->id, 'type' => "forgot_password"));
                if ($token->loaded()) {   
                    // if token is already present, delete it
                    $token->delete();
                }
                // create reset password link and send mail
                $token_val = $this->activation_link($user, true);
                Session::instance()->set('success', 'We have sent an email to your registered email address with a password reset link. Please check your email and click on the link.'); //if link is not valid
                
            } else { 
                $data['msg'] = "Sorry, this email is not registered in our system.";
                
            }
        }
        
        $this->template->title = 'Forgot Password | Amygoz';
        $this->template->content = View::factory('email_form', $data);
    }

    public function action_activate() {
        $email = base64_decode($this->request->param('id')); //decode email address
        $token = $this->request->param('page'); // activation token
        
        if(!empty($email) && !empty($token)) {
            //find token with type activation code
            $token = ORM::factory('user_token', array('token' => $token, 'type' => "activation_code"));
            if ($token->loaded() && $token->user->loaded() && ($token->user->email == $email))
            {   // if token is valid and email address matches activate user and delete the token
                $user = $token->user;
                $user->is_active = 1;
                $user->activation_date = date("Y-m-d H:i:s");
                $user->save();
                Auth::instance()->force_login($token->user); // force login the user without password

                $token->delete();

                Session::instance()->set('main_success', 'Welcome back! Your account has been successfully activated.');
                $this->request->redirect(url::base());
            } else {
                Session::instance()->set('main_error', 'This activation link is invalid or expired. Please visit Amygoz website to generate a new one. '); //if link is not valid
            }
            
        }
        
        $this->request->redirect(url::base());
    }

    public function action_reset_password() {
        $email = base64_decode($this->request->param('id')); //decode email address
        $token = $this->request->param('page'); // activation token
        
        if(!empty($email) && !empty($token)) {
            
            $token = ORM::factory('user_token', array('token' => $token, 'type' => "forgot_password"));
            if ($token->loaded() &&
                $token->user->loaded() && ($token->user->email == $email))
            {   // if token is valid and email address reset user and delete the token

                if ($this->request->post()) { //if post data i.e. new password data
                    try {
                        //update password
                        $user = $token->user;
                        $user->values($this->request->post());
                        $user->save();
                        $token->delete();
                        Session::instance()->set('main_success', 'Your Password has been updated');
                        $this->request->redirect(url::base()."login");
                    } catch (ORM_Validation_Exception $e) { 
                        Session::instance()->set('error', 'Password not reset');
                    }
                }
                
                $this->template->title = 'Reset Password | Amygoz';
                $this->template->content = View::factory('change_password');
                return;
                
            } else {
                Session::instance()->set('main_error', 'Invalid reset password link.'); //if link is not valid
            }
            
        }
        
        $this->request->redirect(url::base());
    }

    public function action_deactivate() {
        $username = base64_decode($this->request->param('id'));
        $code = $this->request->param('page');

        $success = false;
        if(!empty($username)) {
            //find user from username
            $user = ORM::factory('user', array('username' => $username));

            if ($user->loaded()) {
                $email = $user->email;
                $generated_code = md5($username.$email);

                if($generated_code === $code) {
                    $user->not_registered = 1;
                    $user->registration_steps = 1;
                    $user->registration_date = null;
                    $user->is_active = 0;
                    $user->activation_date = null;
                    $user->save();

                    $success = true;
                }

            }

        }

        if($success) {
            Session::instance()->set('success', 'The account is deactivated.');
        } else {
            Session::instance()->set('error', 'This link is invalid');
        }

        $this->request->redirect(url::base());
    }

    public function action_pricing() {
        $this->template->title = 'Pricing | Amygoz';
        $this->template->content = View::factory('staticpages/pricing');
    }

    public function action_contact_us() {
        $this->auto_render = false;
        if($this->request->post()) {
            //send activation email
            $validation = Validation::factory($this->request->post());
            $validation
                ->rule('first_name', 'not_empty')
                ->rule('first_name', 'alpha')
                ->rule('last_name', 'not_empty')
                ->rule('last_name', 'alpha')
                ->rule('email', 'not_empty')
                ->rule('email', 'email')
                ->rule('issue', 'not_empty')
                ->rule('subject', 'not_empty')
                ->rule('message', 'not_empty');
            
            if ($validation->check())
            {
                $send_email = Email::factory('Amygoz - '.$this->request->post('subject'))
                ->message(View::factory('mails/contact_us_mail', $this->request->post())->render(), 'text/html')
                ->to('support@amygoz.com', 'Amygoz')
                ->from($this->request->post('email'))
                ->send();
                echo "done";
            } else {
                echo "error";
            }
        }
    }

    public function action_support() {
        $this->template->title = 'Support Questions | Amygoz';
        $this->template->content = View::factory('staticpages/support');
    }

 public function action_resend_link() {
        $data = array();
        if ($this->request->post()) { // if post request
            $email = $this->request->post('email');

            $user = ORM::factory('user', array('email' => $email));
            if ($user->loaded() && $user->not_registered !== '1') {
                if($user->is_active == 0) {
                    $token = ORM::factory('user_token', array('user_id' => $user->id, 'type' => "activation_code"));
                    if ($token->loaded()) {   
                        // if token is already present, delete it
                        $token->delete();
                    }
                    // create activation link and send mail
                    $token_val = $this->activation_link($user);
                    
                    if(Auth::instance()->logged_in()) {
                        Session::instance()->set('resend_success', 'true');
                        $this->request->redirect(url::base()); //redirect to thank you page
                    } else {
                        $this->request->redirect(url::base().'pages/thank_you'); //redirect to thank you page
                    }
                } else {
                    $data['msg'] = "Sorry, This account is already active.";
                }
                
            } else { 
                $data['msg'] = "Sorry, This email is not registered yet. If you are a new user, please click on the Register button.";
            }
        }
        
        $this->template->title = 'Resend Activation Link | Amygoz';
        $this->template->content = View::factory('email_form', $data);
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

   

    public function action_directory() {
        $startswith = $this->request->param('startswith'); //startswith
        if(!$startswith) {
            $startswith = 'A';
        }

        $users =  ORM::factory('user')->with('user_detail')
            ->where('first_name','LIKE', $startswith.'%')
            ->where('not_registered', '=', 0)
            ->where('is_deleted', '=', 0)
            ->where('profile_private', '=', 0)
            ->order_by('first_name')
            ->find_all()
            ->as_array();

        //echo "<pre>";print_r($users);exit;
        $data['users'] = $users;
        $data['startswith'] = $startswith;
        $this->template->title = 'People Directory | Amygoz';
        $this->template->content = View::factory('directory', $data);
    }
    
     public function action_directory_public()
             {
         
        
        $startswith = $this->request->param('startswith'); //startswith
        if(!$startswith) {
            $startswith = 'A';
        }

            $users =  ORM::factory('user')->with('user_detail')
                    ->where('first_name','LIKE', $startswith.'%')
                    ->where('is_deleted', '=', 0)
                    ->and_where('profile_public', '=', '1')
                    ->order_by('first_name')
                    ->find_all()
                    ->as_array();

        //echo "<pre>";print_r($users);exit;
        $data['users'] = $users;
        $data['startswith'] = $startswith;
        $this->template->title = 'Amygoz | People Directory';
        $this->template->content = View::factory('public_directory', $data);
    }
    //Static Pages

    public function action_activity() {
        $this->template->title = "Activity | Amygoz";
        $this->template->header = View::factory('templates/header', array('page' => 'index')); //template header
        $this->template->content = View::factory('staticpages/activity');
    }
      public function action_activity_public() {
        $this->template->title = "Activity | Amygoz";
        $this->template->header = View::factory('templates/header', array('page' => 'index')); //template header
        $this->template->content = View::factory('staticpages/activity-public');
    }
      public function action_match() {
        $this->template->title = "Match Singles | Amygoz";
        $this->template->header = View::factory('templates/header', array('page' => 'index')); //template header
        $this->template->content = View::factory('staticpages/match');
    }
    public function action_peoplereview() {
        $this->template->title = "Review People | Amygoz";
        $this->template->header = View::factory('templates/header', array('page' => 'index')); //template header
        $this->template->content = View::factory('staticpages/peoplereview');
    }

    public function action_localpeople() {
        $this->template->title = "People Near Me | Amygoz";
        $this->template->header = View::factory('templates/header', array('page' => 'index')); //template header
        $this->template->content = View::factory('staticpages/localpeople');
        $this->template->footer = " ";
    }

    public function action_localdating() {
        $this->template->title = "Singles Near Me | Amygoz";
        $this->template->header = View::factory('templates/header', array('page' => 'index')); //template header
        $this->template->content = View::factory('staticpages/localdating');
    }

    public function action_import() {
        $this->template->title = "Import Friends| Amygoz";
        $this->template->header = View::factory('templates/header', array('page' => 'index')); //template header
        $this->template->content = View::factory('staticpages/import');
    }

  public function action_matchme() 
   {
        $this->template->title = "Match Singles | Amygoz";
        $this->template->header = View::factory('templates/header', array('page' => 'index')); //template header
        $this->template->content = View::factory('staticpages/matchme');
    }

     public function action_find_user()
      {
        $this->auto_render = false;
        if ($this->request->query('query'))
         {
            //$user = Auth::instance()->get_user();
            // autocomplete functionality for searching a user.
            $users =  ORM::factory('user')->with('user_detail')
                ->where_open()
                ->where(DB::expr('CONCAT(first_name, " ", last_name)'),'like', $this->request->query('query').'%')
                ->or_where('email', 'like', $this->request->query('query').'%')

                ->where_close()
                ->where('not_registered', '=', 0)
                ->where('is_blocked','=',0)
                ->find_all()
                ->as_array();

            $data['users'] = $users;
            echo View::factory('staticpages/register_user',$data)->render();
        }
    }

    public function action_Select_user()
      {
        $this->auto_render = false;
        if ($this->request->query('query'))
         {
          
            $users =  ORM::factory('user')->with('user_detail')
                    
                        ->where('email', '=', $this->request->query('query'))
                        ->where('not_registered', '=', 0)
                        ->find_all()
                        ->as_array();

            if(count($users)> 0)
            {
                echo  "True";
            }
            else
            {
                  echo  "False";
            }
        }
    }

   public function action_search_results()
    {
       // $this->auto_render = false;
        
            if ($this->request->post()) 
            {
                
                $user = ORM::factory('user')->with('user_detail')
                    ->where('first_name','like', '%'.$this->request->post('first_name').'%')
                    ->and_where('last_name', 'like','%'.$this->request->post('last_name').'%')
                    ->where('is_deleted', '=', 0)
                    ->limit(10)
                    ->find_all()
                    ->as_array();    
                   $data['search_for'] =  $this->request->post('first_name')." ".$this->request->post('last_name');            
                   $data['search_user']=$user; 
                   $this->template->title = 'Search Results | Amygoz';
                  
                   $this->template->content = View::factory('staticpages/searh_results', $data);
                    //$this->template->sidemenu = View::factory('templates/sidemenu', array('side_menu' => ''));
                  
                //echo View::factory('staticpages/searh_results', $data)->render();
                } 
                else
                {
                   $this->request->redirect(url::base().'import');                       
                }
         }
    public function action_invalid_search()
        {
                //Session::instance()->set('error', 'We could not locate a user with that username');
                $this->template->title = "Find Friends| Amygoz";
                $this->template->header = View::factory('templates/header', array('page' => 'index')); //template header
                $this->template->content = View::factory('staticpages/invalid_search');

        }
        public function action_invalid_member()
        {
                Session::instance()->set('error', 'This member is not active');
                $this->template->title = "Find Friends | Amygoz";
                $this->template->header = View::factory('templates/header', array('page' => 'index')); //template header
                $this->template->content = View::factory('staticpages/invalid_search');

        }
        
        
        
        public function action_unsubscribe() {
           //$username = base64_decode($this->request->param('id'));
            $username=$this->request->param('id');
           
            if(empty($username))
            {
                $username=$_GET['id'];
            }
            
        if(!empty($username)) 
            {
            //find user from username
            $user = ORM::factory('user', array('username' => $username));
           
            
            if ($user->id)
            {
               /* $user->email_notification = 0;
                $user->save();
                Session::instance()->set('toastr_success', 'Your are unsubscribed from system email notifications.');*/
                
                $query = DB::update('invites')->set(array('email_notification' => '1'))->where('invitee_id', '=', $user->id)->execute();
                Session::instance()->set('success', 'Your are unsubscribed from system email notifications.');
               
            } else {
                Session::instance()->set('error', 'This link is invalid');
            }

        } else {
            Session::instance()->set('error', 'This link is invalid');
        }
        $this->request->redirect(url::base());
    }

    public function action_post_detail() {
        if(!$this->request->is_ajax()) {
            $time = date("Y-m-d H:i:s", time()+10); //fetch all the posts
        } else {
            $time = date("Y-m-d H:i:s", $this->request->query('time')); // fetch posts before particular time for pagination
        }        
        $post_id = $this->request->param('id');
        //$post = ORM::factory('post',$post_id);
        $post = ORM::factory('post')
                ->where(DB::expr('(MD5(SHA1(id)))'),'=', $post_id)
                ->find();

        $data['post'] = $post; //set post to use in the view
        if(isset($post->id)) {
            $name = $post->user->user_detail->first_name ." ".$post->user->user_detail->last_name;
            $image = url::base().'mobile/upload/'.$post->user->photo->profile_pic;
            //$this->template->title = $name."'s post on Amygoz";
            $this->template->img = ($post->photo) ? $post->photo : $image;
            $this->template->title = ($post->post) ? $post->post : $name."'s post on Amygoz";
            $this->template->header = View::factory('templates/header', array('page' => 'index')); //template header
            //$this->template->content = View::factory('post_detail', $data);
            $this->template->content = View::factory('templates/v2/post_detail', $data);
        }
        else {
            $this->template->title = "404 Error - Page Not Found";
            $this->template->header = View::factory('templates/header', array('page' => 'index')); //template header
            $this->template->content = View::factory('staticpages/page404');
        }
    }

}
