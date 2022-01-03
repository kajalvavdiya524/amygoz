<?php defined('SYSPATH') or die('No direct script access.');
//controller contains all the that does not require login
class Controller_Accessapi extends Controller_Template 
{
    public $template = 'templates/accessapi'; //template file
    public function before() {
        parent::before();
        header('Content-Type: application/json');
        header("Access-Control-Allow-Origin: *"); 
        $headers = apache_request_headers();   
        if(isset($headers['Authorization']))
        {
            $token  = ORM::factory('user_token')
                    ->where('token','=',$headers['Authorization'])
                    ->where('expires','>',time())
                    ->find();
            if($token->id)  
            {
                $username = $token->user->email;
                Auth::instance()->force_login($username);
                Session::instance()->set('token', $token->token);
            }
            else
            {
                echo json_encode(array('stauts'=>0,'message'=>'Invalid token'));
                exit;
            }
        }
    } 
    public function action_get_email()
    { 
        $user = Auth::instance()->get_user();
        echo json_encode(array('email' => $user->email));
        exit;   
    }
    public function action_index()
    {
        echo "<h1 align='center' style='margin-top:15%'>Api Section! Please stay out of here</h1>";
        $user = Auth::instance()->get_user()->email;
       //$this->template->content = View::factory('accessapi/index'); //page content 
    }
    public function action_login() 
    {
        if($this->request->query())
        {   
            $post_data = $this->request->query();
            $username = urldecode($post_data['email']); //username
            $password = urldecode($post_data['password']); //password
            if(Auth::instance()->login($username, $password, false))
            { 
                $user  = Auth::instance()->get_user();
                $token = ORM::factory('user_token');
                $token->user_id = $user->id;
                $token->expires = time() + 20000000000;
                $token->type = 'app_login';
                $token->save(); 
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
                    $resposnce = array('status'=>'0','message'=>'The email address or password you entered does not match our records.'); //error message to show
                    echo json_encode($resposnce);
                    exit;
                } 
                else if($user->is_deleted && $user->delete_expires < date('Y-m-d')) 
                { //if user is blocked
                    $user->logins = new Database_Expression('logins - 1');
                    $user->save();
                    Auth::instance()->logout(); //logout
                    $resposnce = array('status'=>'0','message'=>'Your account has been deleted. Please contact our support team');
                    echo json_encode($resposnce);    
                    exit;
                } 
                else if($user->is_blocked) 
                { //if user is blocked
                    $user->logins = new Database_Expression('logins - 1');
                    $user->save();
                    Auth::instance()->logout(); //logout
                    $resposnce = array('status'=>'0','message'=>'Your account has been blocked. Please contact our support team'); //error message to show
                    echo json_encode($resposnce);
                    exit;
                } 
                else if (!$user->is_active && $account_expires < date("Y-m-d")) 
                { // user is not activated
                    $user->logins = new Database_Expression('logins - 1');
                    $user->save();
                    Auth::instance()->logout(); //logout
                    /*$data['msg'] = 'Your account has been suspended because you have not activated your account yet.
                    Please activate your account <a href="'.url::base().'pages/resend_link"> Resend Activation Mail </a>.';*/
                    $resposnce  = array('status'=>'0','message'=>'Your account has been suspended because you have not activated your account yet.
                    Please activate your account <a href="'.url::base().'pages/resend_link"> Resend Activation Mail </a>.');
                    echo json_encode($resposnce);
                    exit;
                } 
                else 
                {                    //if user is active redirect to post streaming page
                    if($user->is_deleted) 
                    {
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
                    //Session::instance()->set('logged_user', $logged_user);
                    $user->ip = Request::$client_ip;
                    $api_key = Kohana::$config->load('contact')->get('ip_api');
                    $url = "http://api.ipinfodb.com/v3/ip-city/?key=$api_key&ip=$user->ip&format=json";
                    $ch  = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                    $data = curl_exec($ch);
                    curl_close($ch);
                    if($data) 
                    {
                        $location = json_decode($data);
                        $lat = ($location) ? $location->latitude : 0;
                        $lon = ($location) ? $location->longitude : 0;
                        $user->latitute = $lat;
                        $user->longitude = $lon;
                    }
                    $user->save();
                    if(!$user->plan->id) 
                    {
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
                    foreach($recommendations as $recommend) 
                    {
                        if($recommend->state == 'approve') 
                        { 
                            $words = explode(', ', $recommend->words);
                            $temp_words = array_merge($temp_words, $words);
                        }
                    }
                    $tags = array_count_values($temp_words);
                    $social = $user->calculate_social_percentage($tags);
                    Session::instance()->set('social', $social);
                    $user->check_plan_validity();
                    $name = $user->user_detail->first_name." ".$user->user_detail->last_name;
                    $photo = $user->photo->profile_pic;
                    $photo_img = file_exists("upload/". $photo);
                    if(!empty($photo) && $photo_img)
                    {
                        $pro_pic = url::base()."upload/".$user->photo->profile_pic;
                    }
                    else
                    {
                        $pro_pic = $user->user_detail->first_name[0]."".$user->user_detail->last_name[0];    
                    }
                    $resposnce = array('status'=>'1','message'=>"Successfully login",'token'=>$token->token, 'profile_pic'=>$pro_pic, 'name'=>$name,'email'=>$user->email, 'username'=>$user->username,'user_detail_id'=>$user->user_detail_id,'user_id'=>$user->id);
                    echo json_encode($resposnce);
                    exit;
                }
            } 
            else 
            { 
               $resposnce = array('status'=>'0','message' => 'The email address or password you entered does not match our records' );
               echo json_encode($resposnce);
               exit;
            }
        } 
        else 
        {
            echo "Login Api";
            exit;
        }
    }
    public function action_logout() 
    {
        if(Session::instance()->get('logged_user')) 
        {
            $logged_user = Session::instance()->get('logged_user');
            $logged_user->logout_time = date('Y-m-d H:i:s');
            $logged_user->save();
        }
                Session::instance()->delete('social');
                Session::instance()->delete('logged_user');
                $token_key = Session::instance()->get('token');
                $token = ORM::factory('user_token', array('token'=>$token_key));
                $token->expires = time() - 20000000000;
                $token->save();
                Auth::instance()->logout(); //logout
                 //$this->request->redirect(url::base().'pages/logout');
                Session::instance()->destroy();
                echo json_encode(array('status'=>1,'message'=>'Successfully Logout'));
                exit;
    }
    public function action_signup() 
    {
        $data = array();
        if ($this->request->query()) // if post request, save user details
        { 
            $post_data = $this->request->query(); 
            try 
            {
                /*$post_data['birthday'] = $post_data['year']."-".$post_data['month']."-".$post_data['day'];
                $birthday =$post_data['year']."-".$post_data['month']."-".$post_data['day'];*/
                $first_name=$post_data['first_name'];
                $last_name=$post_data['last_name'];
                //$age = date_diff(DateTime::createFromFormat('Y-m-d', $post_data['birthday']), date_create('now'))->y;
                $from = new DateTime($post_data['birthday']);
                $to = new DateTime();
                $age = round(round(($to->format('U') - $from->format('U')) / (60 * 60 * 24)) / 365);
                
                if($age < 18) 
                {
                    echo json_encode(array('status'=>0, 'message'=>"We are sorry, but you must be at least 13 years or older to use Callitme. Come back once your hit 13!"));
                    exit;
                }
                else 
                {
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

                    $birthyear = date('Y', strtotime($post_data['birthday']));
                    $day = date('m', strtotime($post_data['birthday']));

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

                    $post_data['website']='www.callitme.com/'.$suggestions[0];
                    $allow = false;
                    if(!$user->id) 
                    {
                        $allow = true;
                        $user = ORM::factory('user');
                        $user_detail = ORM::factory('user_detail');
                        $user_detail->values($post_data);
                        $user_detail->save();
                        $post_data['user_detail_id'] = $user_detail->id;
                        $post_data['username'] = $suggestions[0];//Text::random(null, 11).$user_detail->id; 
                        $user->values($post_data);
                        $user->save();
                    }
                    else if($user->not_registered == 1) 
                    {
                        $allow = true;
                        $user_detail = $user->user_detail;
                        $user_detail->values($post_data);
                        $user_detail->save();
                        $post_data['username'] = $suggestions[0];//Text::random(null, 11).$user_detail->id; 
                        $post_data['not_registered'] = 0;
                        $user->values($post_data);
                        $user->save();
                    }

                    if($allow == true) 
                    {
                        $user->add('roles', ORM::factory('role')->where('name', '=', 'login')->find());
                        if(!$user->plan->id) 
                        {
                            $user_plan = ORM::factory('user_plan');
                            $user_plan->user_id = $user->id;
                            $user_plan->name = 'free';
                            $user_plan->plan_expires = date("Y-m-d H:i:s", mktime(23, 59, 59, date("m")+1  , date("d")-1, date("Y")));
                            $user_plan->r_to_friend = 20;
                            $user_plan->save();
                        }
                                
                        //begin add to mailchimp - Added by Ash
                        //$mc_instance = new MCAPI(Kohana::$config->load('mailchimp')->get('api_key'));
                        $first_name = $user_detail->first_name; // first name of the user
                        $last_name = $user_detail->last_name; // last name of the user
                        $email = $user->email; // email address of the user
                        $merge_vars = array('FNAME' => $first_name, 'LNAME'=> $last_name);
                        //$list_id = Kohana::$config->load('mailchimp')->get('list_id');

                        /*$retval = $mc_instance->listSubscribe($list_id, $email, $merge_vars, 'html', false);
                        if ($mc_instance->errorCode) 
                        {
                            // there was an error, let's log it
                            echo "Unable to load listUpdateMember. \t Code=".$mc_instance->errorCode."\n\tMsg=".$mc_instance->errorMessage."\n";
                        }*/

                        //end add to mailchimp - Added by Ash
                        $token = $this->activation_link($user);

                        //Auth::instance()->force_login($user); // force login the user without password
                        //Session::instance()->set('social', 0);
                        $token = ORM::factory('user_token');

                        // Set token data
                        /*$token->user_id = $user->id;

                        $token->expires = time() + 20000000000;
                        $token->type = 'app_login';
                        $token->save(); */
                        echo json_encode(array('status'=> 1,'message'=>'Successfully registered'));
                        exit;

                        //$this->request->redirect(url::base().'pages/newuser_profile'); //redirect to step2
                    } 
                    else 
                    {
                       // Session::instance()->set('error', 'This email address is already registered.');
                        echo json_encode(array('status'=>0, 'message' => 'This email address is already registered.'));
                        exit;
                    }

                }
            } 
            catch (ORM_Validation_Exception $e) 
            { 
                Session::instance()->set('error',$e->errors(''));
            }
        }
        echo "Register Section, please provide request parameter for getting responce";
        exit;
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
            
            if(empty($forgot_password)) 
            {
                $link = url::base()."pages/activate/".$email."/".$token->token;
                $code = md5($user->username.$user->email);
                $deactivate     = url::base()."pages/deactivate/".base64_encode($user->username)."/".$code;
                $send_email     = Email::factory('Welcome '.$user->user_detail->first_name .' '.$user->user_detail->last_name .' to Callitme')
                                ->message(View::factory('mails/activation_mail', array('user' => $user, 'link' => $link, 'deactivate' => $deactivate))->render(), 'text/html')
                                ->to($user->email)
                                ->from('noreply@callitme.com', 'Callitme')
                                ->send();
            } 
            else 
            {
                $link = url::base()."pages/reset_password/".$email."/".$token->token;
                $send_email = Email::factory('Reset Password')
                            ->message(View::factory('mails/reset_password_mail', array('user' => $user, 'link' => $link))->render(), 'text/html')
                            ->to($user->email)
                            ->from('noreply@callitme.com', 'Callitme')
                            ->send();
            }
            return $token->token;
        }
    }

    public function action_newuser_profile() 
    {
        if($this->request->query()) 
        {

           $user = Auth::instance()->get_user();
           $post_data = $this->request->query();
            //save member details
           $exists_phone = ORM::factory('user_detail', array('phone' => $post_data['phone']));
           if(!$exists_phone->id)
           {    
                $user->user_detail->values($post_data);
                $user->user_detail->save();
               // $this->action_skip_step();
           }
           else
           {
             echo json_encode(array('status'=>'0','message'=>'This phone number is already registered.'));
           }
            echo json_encode(array('status'=> 1, 'message'=>'Successfully updated'));
            exit;
        }
        echo "Please update data";
    }
    public function action_profile_picture()
    {   
       echo View::factory('callitmeapi/profile_pic'); //page content 
    }
    public function action_save_photo() 
    {
        if($this->request->post()) 
        {
            $user = ORM::factory('user', array('id'=>$this->request->post('user_id')));//Auth::instance()->get_user(); 
            if( $this->request->post('user_id') ) 
            {
                $post_data = $this->request->post();
                if($user->photo_id) 
                {
                    $photo = ORM::factory('photo', $user->photo_id);
                    try 
                    {
                        //delete previous profile picture if exists
                        if (file_exists(DOCROOT."upload/".$photo->profile_pic_o))
                            unlink(DOCROOT."upload/".$photo->profile_pic_o);
                        if (file_exists(DOCROOT."upload/".$photo->profile_pic))
                            unlink(DOCROOT."upload/".$photo->profile_pic);
                        if (file_exists(DOCROOT."upload/".$photo->profile_pic_m))
                            unlink(DOCROOT."upload/".$photo->profile_pic_m);
                        if (file_exists(DOCROOT."upload/".$photo->profile_pic_s))
                            unlink(DOCROOT."upload/".$photo->profile_pic_s);
                    } 
                    catch(Exception $e) { }
                } 
                else 
                {
                    $photo = ORM::factory('photo');
                }
                $original = Upload::save($_FILES['picture'], null , DOCROOT."upload/");
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
                $photo->profile_pic_o = basename($original);//basename($this->request->query('imag_name'));
                $photo->profile_pic_m = basename($name_m);
                $photo->profile_pic_s = basename($name_s);
                $photo->save();
                if (!$user->photo_id) 
                {
                    $user->photo_id = $photo->id;
                    $user->save();
                }
                echo json_encode(array('status'=>1, 'message'=>'photo updated'));
                exit;
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
                $data['height'] = $image->height + 190;
                $data['image']  = $original;
                echo json_encode(array('status'=>1, 'message'=>'photo updated'));
                //print_r($_FILES['picture']);
                exit;
            }
            echo json_encode(array('status'=>0, 'message'=>'photo not updated'));
            exit;
        }
        echo "please request picture to upload";
        exit;
    }

    public function action_newuser_username() 
    {
        if( $this->request->post() ) 
        {
            $user = ORM::factory('user',array('id'=>$this->request->post('user_id')));//Auth::instance()->get_user();
            if(!$user->check_username($this->request->post('username')))
            {
                $user->username = $this->request->post('username');
                $user->save();
                echo json_encode(array('status'=>'1','message'=>'Username updated.'));
                exit;
            }
            else 
            {
                //Session::instance()->set('error', 'Username already exists.');
                echo json_encode(array('status'=>'0','message'=>'Username already exists.'));
                exit;
            }
        }
        echo "Username update Api"; 
    }
    public function action_find_user() 
    {
        if ($this->request->query('query')) 
        {
            $user   =  ORM::factory('user',array('id'=>$this->request->query('user_id')));//Auth::instance()->get_user();
            $users  =  ORM::factory('user')->with('user_detail')
                    ->where_open()
                    ->where(DB::expr('CONCAT(first_name, " ", last_name)'),'like', $this->request->query('query').'%')
                    ->or_where('email', 'like', $this->request->query('query').'%')
                    ->where_close()
                    ->where('is_blocked','=',0)
                    ->where('not_registered', '=', 0)
                    ->where('user.id', '!=', $user->id)
                    ->find_all()
                    ->as_array();
            $result = array();        
            foreach ($users as $user) 
            {
                $user_id =  $user->id;
                $photo = $user->photo->profile_pic_s;
                $photo_img = file_exists("upload/". $photo);
                if(!empty($photo) && $photo_img)
                {
                    $pro_pic = url::base()."upload/".$user->photo->profile_pic_s;
                }
                else
                {
                    $pro_pic = $user->user_detail->get_no_image_name();    
                }
                $use_name = $user->user_detail->first_name." ".$user->user_detail->last_name;
                $user_email = $user->email;
                $recommendations = $user->recommendations->where('state', '=', 'approve')->order_by('time', 'desc')->find_all()->as_array();
                $temp_words = array();
                foreach($recommendations as $recommend) 
                {
                    $words = explode(', ', $recommend->words);
                    $temp_words = array_merge($temp_words, $words);
                }
                $tags = array_count_values($temp_words);
                if(!empty($user->user_detail->location))
                {
                    $location =  $user->user_detail->location; 
                }
                else if(!empty($user->user_detail->home_town))
                { 
                    $location = $user->user_detail->home_town;
                }
                else
                { 
                    $location = 'Washington, DC, United States';
                }
                $Social = $user->calculate_social_percentage($tags);
                $result[] = array('Profile_pic'=>$pro_pic,'Name'=>$use_name,'User_Email'=>$user_email,'Social_percent'=>$Social,'Location'=>$location,'user_id'=>$user_id);
            }
            echo json_encode(array('Status'=>'1','Filter_Register_User_Email'=>$result));
            exit;                
        }
    }
    public function action_search() 
    {
        if ($this->request->query('query')) 
        {
            if ($this->request->query('query') == '') 
            {
                echo '';
            } 
            else 
            {
                $query_string = $this->request->query('query');
                $substring = strstr($query_string, ' ');
                if ($substring) 
                {
                    $query_array = explode(' ', $query_string);
                    if ($query_array) 
                    {
                        $users  =  ORM::factory('user')->with('user_detail')
                                ->where_open()
                                ->where('first_name', 'like', $query_array[0] . '%')
                                ->and_where('last_name', 'like',$query_array[1] . '%')
                                ->where_close()
                                ->and_where('user.is_blocked', '=', 0)
                                ->where('not_registered', '=', 0)
                                ->find_all()
                                ->as_array();
                    }
                } 
                else 
                {
                    $users =  ORM::factory('user')->with('user_detail')
                            ->where_open()
                            ->where('first_name', 'like', $this->request->query('query') . '%')
                            ->or_where('last_name', 'like', $this->request->query('query') . '%')
                            ->where_close()
                            ->and_where('user.is_blocked', '=', 0)
                            ->where('not_registered', '=', 0)
                            ->find_all()
                            ->as_array();
                }
            }
            $search_name = array();        
            foreach ($users as $use) 
            {
                $photo = $use->photo->profile_pic;
                $photo_img = file_exists("upload/". $photo);
                if(!empty($photo) && $photo_img)
                {
                    $pro_pic = url::base()."upload/".$use->photo->profile_pic;
                }
                else
                {
                    $pro_pic = $use->user_detail->get_no_image_name();    
                }
                $use_name = $use->user_detail->first_name." ".$use->user_detail->last_name;
                if($use->profile_public == '1')
                {
                        $gender = $use->user_detail->sex;
                        /*if(!empty($use->user_detail->phase_of_life)) 
                        {
                            $phase_of_life = Kohana::$config->load('profile')->get('phase_of_life');
                            $phase_of = $phase_of_life[$use->user_detail->phase_of_life];
                        }*/
                        $username = $use->username;
                        $user_id = $use->id;
                        $ser_loc = $use->user_detail->location;
                        /*if(!empty($use->user_detail->location))
                        {
                            $loc = $use->user_detail->location;
                            $b = explode(', ', $loc);
                            if(!empty($b[0]) && !empty($b[2]))
                            {
                                $ser_loc = $b[0].", ".$b[2];
                            }
                            else if(!empty($b[0]))
                            {
                                $ser_loc =  $b[0];
                            }
                            else
                            {
                                $ser_loc = $b[2];
                            }
                        }*/
                        $search_name[]  = array(
                                            'profile_pic'=>$pro_pic,
                                            'name'=>$use_name,
                                            'username'=>$username,
                                            'user_id'=>$user_id,
                                            'gender'=>$gender,
                                            /*'phase_of_life'=>$phase_of,*/
                                            'location'=>$ser_loc
                                    );  
                }
                else
                {
                        $gender = $use->user_detail->sex;
                        /*if(!empty($use->user_detail->phase_of_life)) 
                        {
                            $phase_of_life = Kohana::$config->load('profile')->get('phase_of_life');
                            $phase_of = $phase_of_life[$use->user_detail->phase_of_life];
                        }*/
                        $username = $use->username;
                        $user_id = $use->id;
                        $ser_loc = $use->user_detail->location;
                        /*if(!empty($use->user_detail->location))
                        {
                            $loc = $use->user_detail->location;
                            $b = explode(', ', $loc);
                            if(!empty($b[0]) && !empty($b[2]))
                            {
                                $ser_loc = $b[0].", ".$b[2];
                            }
                            else if(!empty($b[0]))
                            {
                                $ser_loc =  $b[0];
                            }
                            else
                            {
                                $ser_loc = $b[2];
                            }
                        }*/
                        $search_name[]  = array(
                                            'profile_pic'=>$pro_pic,
                                            'name'=>$use_name,
                                            'username'=>$username,
                                            'user_id'=>$user_id,
                                            'gender'=>$gender,
                                            /*'phase_of_life'=>$phase_of,*/
                                            'location'=>$ser_loc
                                    );
                }
                
            } 
                echo json_encode(array('success'=>'1','search_user_name'=>$search_name));
        }
    }
    public function action_searchOLD()
    {
        if($this->request->query('query'))
        { 
            $post_data = $this->request->query();
            $name  = $this->request->query('query');
            $words = explode(' ', $name); 
            $users =  ORM::factory('user')->with('user_detail')
                    ->where_open()
                    ->where('first_name','like', '%'. $words[0].'%')
                    ->or_where('last_name', 'like', '%'.$this->request->query('query').'%')
                    ->where('user.is_blocked','=',0)
                    ->and_where('profile_public', '=', '0')
                    ->where_close()
                    ->where('not_registered', '=', 0)
                    ->find_all();
            $search_name = array();        
            foreach ($users as $use) 
            {
                $photo = $use->photo->profile_pic;
                $photo_img = file_exists("upload/". $photo);
                if(!empty($photo) && $photo_img)
                {
                    $pro_pic = url::base()."upload/".$use->photo->profile_pic;
                }
                else
                {
                    $pro_pic = $use->user_detail->first_name[0]."".$use->user_detail->last_name[0];    
                }
                $use_name = $use->user_detail->first_name." ".$use->user_detail->last_name;
                $gender = $use->user_detail->sex;
                if(!empty($use->user_detail->phase_of_life)) 
                {
                    $phase_of_life = Kohana::$config->load('profile')->get('phase_of_life');
                    $phase_of = $phase_of_life[$use->user_detail->phase_of_life];
                }
                $username = $use->username;
                if(!empty($use->user_detail->location))
                {
                    $loc = $use->user_detail->location;
                    $b = explode(', ', $loc);
                    if(!empty($b[0]) && !empty($b[2]))
                    {
                        $ser_loc = $b[0].", ".$b[2];
                    }
                    else if(!empty($b[0]))
                    {
                        $ser_loc =  $b[0];
                    }
                    else
                    {
                        $ser_loc = $b[2];
                    }
                }
                $search_name[]  = array(
                                    'profile_pic'=>$pro_pic,
                                    'name'=>$use_name,
                                    'username'=>$username,
                                    'gender'=>$gender,
                                    'phase_of_life'=>$phase_of,
                                    'location'=>$ser_loc
                            );
            } 
                echo json_encode(array('success'=>'1','search_user_name'=>$search_name));
        }
    }
    public function action_user_review()
    {
        if($this->request->query('query'))
        { 
            $post_data = $this->request->query();
            $name  = $this->request->query('query');
            $words = explode(' ', $name); 
            $users =  ORM::factory('user')->with('user_detail')
                    ->where_open()
                    ->where('first_name','like', '%'. $words[0].'%')
                    ->or_where('last_name', 'like', '%'.$this->request->query('query').'%')
                    ->or_where('email', 'like', '%'.$this->request->query('query').'%')
                    ->where('user.is_blocked','=',0)
                    ->and_where('profile_public', '=', '0')
                    ->where_close()
                    ->where('not_registered', '=', 0)
                    ->find_all();
            $search_name = '';        
            foreach ($users as $use) 
            {
                $photo = $use->photo->profile_pic;
                $photo_img = file_exists("upload/". $photo);
                if(!empty($photo) && $photo_img)
                {
                    $pro_pic = url::base()."upload/".$use->photo->profile_pic;
                }
                else
                {
                    echo $use->user_detail->first_name[0]."".$use->user_detail->last_name[1];    
                }
                $use_name = $use->user_detail->first_name." ".$use->user_detail->last_name;
                $gender = $use->user_detail->sex;
                if(!empty($use->user_detail->phase_of_life)) 
                {
                    $phase_of_life = Kohana::$config->load('profile')->get('phase_of_life');
                    $phase_of = $phase_of_life[$use->user_detail->phase_of_life];
                }
                $email = $use->email;
                $user_id = $use->id;
                if(!empty($use->user_detail->location))
                {
                    $loc = $use->user_detail->location;
                    $b = explode(', ', $loc);
                    if(!empty($b[0]) && !empty($b[2]))
                    {
                        $ser_loc = $b[0].", ".$b[2];
                    }
                    else if(!empty($b[0]))
                    {
                        $ser_loc =  $b[0];
                    }
                    else
                    {
                        $ser_loc = $b[2];
                    }
                }
                $search_name .= "
                            {  
                                '$email',
                                '$user_id'  
                            }";
            } 
                echo "{
                            $search_name     
                      }";
        }
    }
    public function action_review_user()
    {
        echo View::factory('members/review');   
    }
    public function action_review_sr()
    {
        if($this->request->query()) 
        {   
            $user = ORM::factory('user',array('id'=>$this->request->query('user_id')));//Auth::instance()->get_user();
            $post_data = $this->request->query();
            $user_to = ORM::factory('user', array('email' =>$this->request->query('email')));
            if(!$user_to->id)
            {
                $user_to = ORM::factory('user')->create_non_registered_user($post_data['email']);
                $Message = array('status'=>'0', 'message'=>'Your email is not register..');
                echo json_encode($Message);
                exit;
            }
            if($user->email === $user_to->email)
            {
                $yourself = array('status'=>'0', 'message'=>'You can not review yourself..');
                echo json_encode($yourself);
                exit; 
            }
            if(!$this->request->query('edit_recommend') && ORM::factory('recommend')->where('to', '=', $user_to->id)->where('from', '=', $user->id)->count_all())
            {
                $already = ORM::factory('recommend')
                        ->where('to', '=', $user_to->id)
                        ->where('from', '=', $user->id)
                        ->find();
                $msg = array('Status'=>'0','Message'=>'You have already reviewed..'); 
                echo json_encode($msg);
                exit;   
            }
            else
            {
                if($this->request->query('edit_recommend')) 
                {
                    $recommend = ORM::factory('recommend', $this->request->query('edit_recommend'));
                    $post_data['status'] = 'pending';
                    $pending = array('status'=>'0','Message'=>'You reviewed is pending..'); 
                    echo json_encode($pending);
                    exit; 
                }
                else
                {
                    $recommend = ORM::factory('recommend');
                    $post_data['to'] = $user_to->id;
                    $post_data['from'] = $user->id;
                }
                $post_data['time'] = date("Y-m-d H:i:s");
                $recommend->values($post_data);
                $recommend->save(); 
                echo json_encode(array('status'=>'1','message'=>'You reviewed is successfully send.'));  
                exit;
            } 
        }
        echo "Review user";
        exit;
    }
    public function action_annonymaous_review()
    {        
        if($this->request->query()) 
        {
            $user = ORM::factory('user',array('id'=>$this->request->query('user_id')));//Auth::instance()->get_user();
            $post_data = $this->request->query();
            $user_to = ORM::factory('user', array('email' =>$this->request->query('email')));
            if(!$user_to->id)
            {
                $user_to = ORM::factory('user')->create_non_registered_user($post_data['email']);
                $Message = array('status'=>0, 'message'=>'Your email is not register..');
                echo json_encode($Message);
            }
            if($user->email === $user_to->email)
            {
                $yourself = array('status'=>0, 'message'=>'You can not review yourself..');
                echo json_encode($yourself);
            }
            if(!$post_data['edit_recommend'] && ORM::factory('recommend')->where('to', '=', $user_to->id)->where('from', '=', $user->id)->count_all())
            {
                $already = ORM::factory('recommend')
                        ->where('to', '=', $user_to->id)
                        ->where('from', '=', $user->id)
                        ->find();
                $msg = array('status'=>'0','message'=>'You have already reviewed..'); 
                echo json_encode($msg);
            }
            else
            {
                if($post_data['edit_recommend']) 
                {
                    $recommend = ORM::factory('recommend', $post_data['edit_recommend']);
                    $post_data['status'] = 'pending';
                    $pending = array('Status'=>'0','Message'=>'You reviewed is pending..'); 
                    echo json_encode($pending);
                }
                else
                {
                    $recommend = ORM::factory('recommend');
                    $post_data['to'] = $user_to->id;
                    $post_data['from'] = $user->id;
                }
                $post_data['time'] = date("Y-m-d H:i:s");
                $post_data['type'] ='0';
                $post_data['state'] ='approve';
                $recommend->values($post_data);
                $recommend->save(); 
                echo json_encode(array('status'=>'1','message'=>'You reviewed is successfully send.'));  
            } 
        }
    }
    public function action_show_posts()
    {
        if($this->request->query())
        {
            $user = ORM::factory('user',array('user_detail_id'=>$this->request->query('user_detail_id')));
            $friends_array[0] = $user->id; 
            foreach ($user->friends->where('is_deleted', '=', 0)->find_all()->as_array() as $friend) 
            {
                $friends_array[] = $friend->id;
            }
            if(!$this->request->query()) 
            {
                $time = date("Y-m-d H:i:s", time()+10); //fetch all the posts
            } 
            else 
            {
                $time = date("Y-m-d H:i:s", $this->request->query('time')); // fetch posts before particular time for pagination
            }
            $posts = ORM::factory('post')
                    ->where('user_id', 'IN', $friends_array)
                    ->and_where('is_deleted', '=', 0)
                    ->and_where('time', '>', $time)
                    ->order_by('time', 'desc')
                    //->limit(10)
                    ->find_all()
                    ->as_array();
            $post1  = array();
            foreach ($posts as $post) 
            {
                if($post->user->is_blocked == 0) 
                {
                    if($post->user->photo->profile_pic_o) 
                    {
                        $profile_pic = url::base()."upload/".$post->user->photo->profile_pic_o;
                    }
                    else
                    {
                        $profile_pic = $post->user->user_detail->first_name[0].$post->user->user_detail->last_name[0];
                    }
                    if($post->type === 'profile_details2') 
                    {
                        $name = $post->user->user_detail->first_name." ".$post->user->user_detail->last_name ."'s" ;
                    } 
                    else 
                    { 
                        $name = $post->user->user_detail->first_name." ".$post->user->user_detail->last_name ;
                    }
                    $username = $post->user->username;
                    $user_id = $post->user->id;
                    $email = $post->user->email;
                    $action = $post->action;
                    $post_home = $post->post;
                    if($post->post)
                    {
                        if($post->type == 'recommend' && $post->user->id != $user->id) 
                        {
                            $recommendations = $post->user->recommendations->where('state', '=', 'approve')->find_all()->as_array();

                            $temp_words = array();
                            foreach($recommendations as $recommend) 
                            {
                                if($recommend->state == 'approve') 
                                { 
                                    $words = explode(', ', $recommend->words);
                                    $temp_words = array_merge($temp_words, $words);
                                }
                            }
                            $tags = array_count_values($temp_words);
                            $social = $post->user->calculate_social_percentage($tags);
                        }
                    }
                    $time = time() - strtotime($post->time);
                    if ($time >= 86400) 
                    {
                        $post_time =  date('jS M', strtotime($post->time));
                    } 
                    else 
                    {
                        $post_time = Date::time2string($time);
                    }
                    if($post->user->id == $user->id) 
                    {
                        $show_post_delete_button =true;    
                    }else
                    {
                        $show_post_delete_button =false;
                    }
                    $post_id = $post->id;
                    $comments = $post->comments->where('is_deleted', '=', 0)->find_all()->as_array();
                    $number_of_comments = count($comments);              
                    if (!empty($comments)) 
                    {
                        $comments_res = array();
                        foreach ($comments as $comment) 
                        {
                            if($comment->user->photo->profile_pic) 
                            {
                                $comment_user_dp =$comment->user->photo->profile_pic;
                            }
                            else
                            {
                                $comment_user_dp = 'no_image_m.png';
                            }

                            $comment_time = time() - strtotime($comment->time);
                            if ($comment_time >= 86400) 
                            {
                                $coment_time = Date('jS M', strtotime($comment->time));
                            }
                            else 
                            {
                                $coment_time = Date::time2string($comment_time);
                            }
                            $comment_user_username =$comment->user->username;
                            $comments_user_fullname = $comment->user->user_detail->first_name .' '. $comment->user->user_detail->last_name;
                            $comment_comment = $comment->comment;
                            if($comment->user->id == $user->id)
                            {
                                $show_delete_comment_button = true;
                            }
                            else
                            {
                                $show_delete_comment_button = false;
                            }
                            $comment_id = $comment->id;
                            $comment_comment = $comment->comment;
                            $comments_res[] = array(
                                'comment_id'=>$comment_id,
                                'comment_user_dp'=>$comment_user_dp,
                                'coment_time'=>$coment_time,
                                'show_delete_comment_button' =>$show_delete_comment_button,
                                'comment_user_username'=>$comment_user_username,
                                'comments_user_fullname'=>$comments_user_fullname,
                                'comment_comment' =>$comment_comment
                                );   
                        }
                    }
                    else
                    {
                        $comments_res =array('status' => 0, 'message'=>'No comments yet. Be the first to comment.');
                    }
                    $post1[] = array(
                        'profile_pic'=>$profile_pic,
                        'post_id'=>$post_id, 
                        'show_post_delete_button'=>$show_post_delete_button,
                        'name'=>$name,
                        'username'=>$username, 
                        'user_id'=>$user_id,
                        'email'=>$email, 
                        'post_title'=> $action,
                        'post'=> $post_home,
                        'post_time'=>$post_time,
                        'comments'=>$comments_res,
                        'number_of_comments'=>$number_of_comments
                        );
                }
            }    
            $resposnce = array('status'=>1, 'message'=>"Postsdata",'posts'=> $post1);
            echo json_encode($resposnce);
            exit; 
        }
        echo "<h1>User Home page activities</h1><br>
        Method =>GET<br>
        Parameter=> user_detail_id"; 
        exit;   
    }
        public function action_recent_post() 
        {
        // for fetching real time posts
            if($this->request->query())
            {
               $user = ORM::factory('user',array('username'=>$this->request->query('username')));
                //create array of member_ids for fetching posts.
                $friends_array[0] = $user->id; //add member_id of current user also
                foreach ($user->friends->where('is_deleted', '=', 0)->find_all()->as_array() as $friend) {
                    $friends_array[] = $friend->id;
                }

                // time of the first post currently showing
                $time = date("Y-m-d H:i:s", $this->request->query('time'));

                //fetch all recent posts posts from the members user is following.
                $posts = ORM::factory('post')
                    ->where('user_id', 'IN', $friends_array)
                    ->and_where('is_deleted', '=', 0)
                    ->and_where('time', '>', $time)
                    ->order_by('time', 'desc')
                    ->limit(10)
                    ->find_all()
                    ->as_array();
                $post1 =array();
            foreach ($posts as $post) 
            {
                if($post->user->is_blocked == 0) 
                {
                    if($post->user->photo->profile_pic_s) 
                    {
                        $profile_pic = url::base()."upload/".$post->user->photo->profile_pic_s;
                    }
                    else
                    {
                        $profile_pic = $post->user->user_detail->first_name[0].$post->user->user_detail->last_name[0];
                    }

                    if($post->type === 'profile_details2') 
                    {
                        $name = $post->user->user_detail->first_name." ".$post->user->user_detail->last_name ."'s" ;
                    } else { 
                        $name = $post->user->user_detail->first_name." ".$post->user->user_detail->last_name ;
                    }
                    $action = $post->action;
                    $username = $post->user->username;
                    $user_id = $post->user->id;
                    if($post->post)
                    {
                        if($post->type == 'recommend' && $post->user->id != $user->id) 
                        {
                            $recommendations = $post->user->recommendations->where('state', '=', 'approve')->find_all()->as_array();

                            $temp_words = array();
                            foreach($recommendations as $recommend) 
                            {
                                if($recommend->state == 'approve') 
                                { 
                                    $words = explode(', ', $recommend->words);
                                    $temp_words = array_merge($temp_words, $words);
                                }
                            }
                            $tags = array_count_values($temp_words);
                            $social = $post->user->calculate_social_percentage($tags);
                        }
                    }
                    $time = time() - strtotime($post->time);
                    if ($time >= 86400) 
                    {
                        $post_time =  date('jS M', strtotime($post->time));
                    } else 
                    {
                        $post_time = Date::time2string($time);
                    }
                    if($post->user->id == $user->id) 
                    {
                        $show_post_delete_button =true;    
                    }else
                    {
                        $show_post_delete_button =false;
                    }
                    $post_id = $post->id;

                    
                    /*$comments = $post->comments->where('is_deleted', '=', 0)->find_all()->as_array();                
                    if (!empty($comments)) 
                    {
                        $comments_res = array();
                        foreach ($comments as $comment) 
                        {
                            if($comment->user->photo->profile_pic_m) 
                            {
                                $comment_user_dp =$comment->user->photo->profile_pic_m;
                            }
                            else
                            {
                                $comment_user_dp = 'no_image_m.png';
                            }

                            $comment_time = time() - strtotime($comment->time);
                            if ($comment_time >= 86400) 
                            {
                                $coment_time = Date('jS M', strtotime($comment->time));
                            }
                             else 
                            {
                                $coment_time = Date::time2string($comment_time);
                            }
                            $comment_user_username =$comment->user->username;
                            $comments_user_fullname = $comment->user->user_detail->first_name .' '. $comment->user->user_detail->last_name;
                            $comment_comment = $comment->comment;
                            if($comment->user->id == $user->id)
                            {
                                $show_delete_comment_button = true;

                            }else
                            {
                                $show_delete_comment_button = false;
                            }
                            $comment_id = $comment->id;
                            $comment_comment = $comment->comment;
                            $comments_res[] = array(
                                'comment_id'=>$comment_id,
                                'comment_user_dp'=>$comment_user_dp,
                                'coment_time'=>$coment_time,
                                'show_delete_comment_button' =>$show_delete_comment_button,
                                'comment_user_username'=>$comment_user_username,
                                'comments_user_fullname'=>$comments_user_fullname,
                                'comment_comment' =>$comment_comment
                                );   

                        }
                    }
                    else
                    {
                        $comments_res[] =array('status' => 0, 'message'=>'No comments yet. Be the first to comment.');
                    }*/
                     
                    $post1[] = array(
                        'profile_pic'=>$profile_pic,
                        'post_id'=>$post_id, 
                        'show_post_delete_button'=>$show_post_delete_button,
                        'name'=>$name, 
                        'username'=>$username,
                        'user_id'=>$user_id, 
                        'post'=> $action,
                        'post_time'=>$post_time,
                        );
                }
                
            }    
            $resposnce = array('status'=>1, 'message'=>"Posts fetch successfully",'posts'=> $post1);
            echo json_encode($resposnce);
            exit;
            }
        }
    public function action_view_profile()
    {
        if($this->request->query())
        {
            $post_data = $this->request->query();
            $user_to = ORM::factory('user_detail',array('id'=>$this->request->query('user_detail_id')));
            $user = ORM::factory('user', array('username' => $post_data['username']));
            if($user->id == NULL) 
            {
                echo json_encode(array('status' => 0,'message'=>'invalid username'));
                exit;
            }
            if ($user->is_deleted == 1) 
            {
                echo json_encode(array('status'=>0,'message'=>'Sometimes member takes a break. Please check back once the member is active again!'));
                exit;
            }
            if($user->id !== $user_to) 
            {
                $viewed = Session::instance()->get('viewed');
                if(empty($viewed)) 
                {
                    $viewed = array();
                }
                if(!in_array($user->id, $viewed)) 
                {
                    $viewed[] = $user->id;
                    Session::instance()->set('viewed', $viewed);
                    $view = ORM::factory('profile_view');
                    $view->user_id = $user->id;
                    $view->viewed_by = $user_to;
                    $view->time = date("Y-m-d H:i:s");
                    $view->save();
                }
            }
            $data['user'] = $user;
            $recommendations = $user->recommendations->where('state', '=', 'approve')->order_by('time', 'desc')->find_all()->as_array();
            $temp_words = array();
            foreach($recommendations as $recommend) 
            {
                $words = explode(', ', $recommend->words);
                $temp_words = array_merge($temp_words, $words);
            }
            $tags = array_count_values($temp_words);
            $friends = $user->friends->find_all()->as_array();
            if(Request::current()->query('mutual')) 
            {
                $data['friends'] = $user->mutual_friends($session_user);
            }
                $item     = ORM::factory('user')->with('user_detail')
                            ->where('sex', '=', $user->user_detail->sex)
                            ->where('is_deleted', '=', 0)
                            ->where('username', '!=', $post_data['username'])
                            ->where('profile_private','=',0)
                            ->and_where('profile_public', '=', '0')
                            ->order_by(DB::expr('RAND()'))
                            ->limit(8)
                            ->find_all()
                            ->as_array();
                $matches    = ORM::factory('user')->with('user_detail')
                            ->where('sex', '=', (($user->user_detail->sex == 'Male') ? 'Female' : 'Male'))
                            ->where('is_deleted', '=', 0)
                            ->where('username', '!=', $post_data['username'])
                            ->where('profile_private','=',0)
                            ->and_where('profile_public', '=', '0')
                            ->order_by(DB::expr('RAND()'))
                            ->limit(8)
                            ->find_all()
                            ->as_array();            
            $data['match']=$matches;
            //$data['item']=$userss;
            $data['tags'] = $tags;
            $data['social'] = $user->calculate_social_percentage($tags);
            $data['recommendations'] = $recommendations;
            $phase_of_life = Kohana::$config->load('profile')->get('phase_of_life');
            $phase_of_life = ($user->user_detail->phase_of_life) ? $phase_of_life[$user->user_detail->phase_of_life]:"";
            if ($user->photo->profile_pic) 
            {
                $user_profile_pic = url::base()."upload/".$user->photo->profile_pic;
            }
            else
            {
                $user_profile_pic =$user->user_detail->first_name[0] . $user->user_detail->last_name[0];
            }
            $about = $user->user_detail->about;
            if($user->user_detail->home_town)
            {
                $from = $user->user_detail->home_town; 
            }
            else
            {
                if($user->ip) 
                {
                    $user_ip = $user->ip;
                    $api_key = Kohana::$config->load('contact')->get('ip_api');
                    $url = "http://api.ipinfodb.com/v3/ip-city/?key=$api_key&ip=$user_ip&format=json";
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                    $data_country = curl_exec($ch);
                    $location = json_decode( $data_country);
                    $from = $location->cityName.", ".$location->countryName;
                }
                else
                {
                    $from = 'Washington, DC, United States';
                }
            }
            if($user->user_detail->location)
            {
                $live_in = $user->user_detail->location;
            }
            else
            {
                if($user->ip) 
                {
                    $user_ip = $user->ip;
                    $api_key = Kohana::$config->load('contact')->get('ip_api');

                    $url = "http://api.ipinfodb.com/v3/ip-city/?key=$api_key&ip=$user_ip&format=json";
                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                    $data_country = curl_exec($ch);
                    $location = json_decode( $data_country);
                    $live_in = $location->cityName.", ".$location->countryName;
                }
                else
                {
                    $live_in = 'Washington, DC, United States';
                }
            }
            if($user->user_detail->website)
            {
                 $website =  $user->user_detail->website;
            }
            else
            {
                $website =  "https://www.callitme.com/".$user->username;
            }
            $n = ORM::factory('friendship')->where('user_id', '=', $user->id)->count_all();
            $friends_details = array();
            foreach ($friends as $friend) 
            {
                $photo = $friend->photo->profile_pic;
                $friend_image = file_exists("mobile/upload/" .$photo);
                $friend_image1 = file_exists("upload/" .$photo);
                if (!empty($photo) && $friend_image) 
                { 
                    $friend_profile_pic = url::base()."mobile/upload/".$friend->photo->profile_pic;
                }
                else if (!empty($photo) && $friend_image1)
                {
                   $friend_profile_pic = url::base()."upload/".$friend->photo->profile_pic;
                }  
                else
                {
                    $friend_profile_pic = $friend->user_detail->get_no_image_name();
                }
               $friend_name = $friend->user_detail->first_name." ".$friend->user_detail->last_name;
               $friend_username = $friend->username;
               $friend_email = $friend->email;
               $friend_id = $friend->id;
               $friend_location = $friend->user_detail->location;
               $friends_details[] = array(
                                    'friend_profile_pic' => $friend_profile_pic,
                                    'friend_name' => $friend_name,
                                    'friend_username' => $friend_username,
                                    'friend_email'    => $friend_email,
                                    'friend_location' => $friend_location,
                                    'friend_id'       => $friend_id,
                                    );
            }
            $similar_pic = array();
            foreach ($item as $item_s)
            {
                $photo = $item_s->photo->profile_pic;
                $item_image = file_exists("mobile/upload/" .$photo);
                $item_image1 = file_exists("upload/" .$photo);
                if (!empty($photo) && $item_image) 
                { 
                    $similar_profile_pic = url::base()."mobile/upload/".$item_s->photo->profile_pic;
                }
                else if (!empty($photo) && $item_image1)
                {
                   $similar_profile_pic = url::base()."upload/".$item_s->photo->profile_pic;
                }  
                else
                {
                    if(!empty($item_s->user_detail->sex))
                    {
                        if($item_s->user_detail->sex=='Male' || $item_s->user_detail->sex=='male')
                        {
                            $similar_profile_pic = url::base()."upload/avatar5.png";
                        }
                        if($item_s->user_detail->sex=='Female' || $item_s->user_detail->sex=='female')
                        {
                            $similar_profile_pic = url::base()."upload/avatar2.jpg";
                        }
                    }
                }
                $similar_name = $item_s->user_detail->first_name." ".$item_s->user_detail->last_name;
                $similar_username = $item_s->username;
                $similar_email = $item_s->email;
                $similar_id = $item_s->id;
                $details = array();
                if(!empty($item_s->user_detail->sex)) 
                {
                    $details[] = $item_s->user_detail->sex;
                }
                if(!empty($item_s->user_detail->phase_of_life)) 
                {
                    $phase_of_life = Kohana::$config->load('profile')->get('phase_of_life');
                    $details[] =($item_s->user_detail->phase_of_life) ? $phase_of_life[$item_s->user_detail->phase_of_life]:"";
                }
                $similar_pic_details[] = array(
                                    'similar_profile_pic' => $similar_profile_pic,
                                    'similar_name' => $similar_name,
                                    'similar_username' => $similar_username,
                                    'similar_email' => $similar_email,
                                    'user_id' => $similar_id,
                                    'phase_of_life' => implode(', ', $details)
                                    );
            }

            /*if(empty($recommendations))
            {
                $hasreviewed = array();
                if($user_to->id !== $user->id)
                {
                   $hasreviewed = "No one has reviewed".$user->user_detail->first_name."yet";
                   $askreview_peoplereview = url::base()."peoplereview/compose?ask=".$user->username."Review".$user->user_detail->first_name;
                }
                else
                {
                    $hasreviewedyet = "No one has reviewed you yet.";
                    $askreview_peoplereviewyet = url::base()."peoplereview/askreview"."Ask to be Reviewed";
                }*/
                /*$hasreviewed[] =array('status'=>'1','No_one_has_reviewed'=>$hasreviewed,'compose_ask'=>$askreview_peoplereview,'No_one_has_reviewed_you_yet'=>$hasreviewedyet,'askreview'=>$askreview_peoplereviewyet); 
                 echo json_encode(array('status' => 1,'compose_edit'=>$hasreviewed)); 
                 exit;*/          
            /*}
            else 
            {*/
                /*if($user_to->id != $user->id)
                { */  
                    if($user->user_detail->reviews_private == 0 || $user->user_detail->reviews_private == '1')  
                    {   
                        $review_details = array();
                        foreach ($recommendations as $recommendation) 
                        {  
                            if($recommendation->type =='1')
                            {
                                $photo = $recommendation->owner->photo->profile_pic;
                                $recomation_image = file_exists("mobile/upload/" .$photo);
                                $recomation_image1 = file_exists("upload/" .$photo);
                                if (!empty($photo) && $recomation_image) 
                                { 
                                    $review_profile_pic = url::base()."mobile/upload/".$recommendation->owner->photo->profile_pic;
                                }
                                else if (!empty($photo) && $recomation_image1)
                                {
                                   $review_profile_pic = url::base()."upload/".$recommendation->owner->photo->profile_pic;
                                }  
                                else
                                {
                                    $review_profile_pic = url::base()."upload/img/no_image_s.png";
                                }
                                $review_name = $recommendation->owner->user_detail->first_name . " " .$recommendation->owner->user_detail->last_name;
                                $review_message = $recommendation->message;
                                $review_sender_name = $user->user_detail->first_name." is ". $recommendation->owner->user_detail->first_name."`s ".$recommendation->relation;
                                $review_email = $recommendation->owner->email;
                                $age = time() - strtotime($recommendation->time);
                                 
                                if ($age >= 86400) 
                                {
                                    $reviewed_on = date('jS M', strtotime($recommendation->time));
                                } 
                                else 
                                {
                                    $reviewed_on = date::time2string($age);
                                }
                                $review_details[] = array('review_profile_pic'=>$review_profile_pic,
                                'review_name'=>$review_name,'review_email'=>$review_email,'review_message'=>$review_message,'review_sender_name'=>$review_sender_name,
                                'reviewed_on'=>$reviewed_on);
                            }
                            if($recommendation->type=='0')
                            {
                                $anonymous_profile_pic = url::base()."upload/img/no_image_s.png";
                                $anonymous_user = 'Anonymous User';
                                $review_message = $recommendation->message;
                                $age = time() - strtotime($recommendation->time);
                                if ($age >= 86400) 
                                {
                                    $reviewed_on = date('jS M', strtotime($recommendation->time));
                                } 
                                else 
                                {
                                    $reviewed_on = date::time2string($age);
                                }
                                $review_details[] =array('status'=>'Anonymous','anonymous_profile_pic'=>$anonymous_profile_pic,'review_message'=>$review_message,'reviewed_on'=>$reviewed_on,'anonymous_user'=>$anonymous_user); 
                            }
                        }
                    }
                    else
                    {
                        $ask_about_reviews = 'Ask about reviews';
                        $review_details[] = array('status'=>0,'Ask_about_reviews'=>$ask_about_reviews); 
                    }
                /*}
                else
                {*/
                    //$review_details = array();
                    foreach ($recommendations as $recommendation) 
                    { 
                        if( $recommendation->type=='1')
                        {
                            $photo = $recommendation->owner->photo->profile_pic;
                            $recomation_image = file_exists("mobile/upload/" .$photo);
                            $recomation_image1 = file_exists("upload/" .$photo);
                            if (!empty($photo) && $recomation_image) 
                            { 
                                $review_profile_pic = url::base()."mobile/upload/".$recommendation->owner->photo->profile_pic;
                            }
                            else if (!empty($photo) && $recomation_image1)
                            {
                               $review_profile_pic = url::base()."upload/".$recommendation->owner->photo->profile_pic;
                            }  
                            else
                            {
                                $review_profile_pic = url::base()."upload/img/no_image_s.png";
                            }
                            $review_name = $recommendation->owner->user_detail->first_name . " " .$recommendation->owner->user_detail->last_name;
                            $review_message = $recommendation->message;
                            $review_email = $recommendation->owner->email;
                            $review_sender_name = $user->user_detail->first_name." is ". $recommendation->owner->user_detail->first_name."`s ".$recommendation->relation;
                            $age = time() - strtotime($recommendation->time);
                            if ($age >= 86400) 
                            {
                                $reviewed_on = date('jS M', strtotime($recommendation->time));
                            } 
                            else 
                            {
                                $reviewed_on = date::time2string($age);
                            }
                            $review_details[] = array('review_profile_pic'=>$review_profile_pic,
                            'review_name'=>$review_name,'review_email'=>$review_email,'review_message'=>$review_message,'review_sender_name'=>$review_sender_name,
                            'reviewed_on'=>$reviewed_on);

                        }
                        if( $recommendation->type=='0')
                        {
                            $anonymous_profile_pic = url::base()."upload/img/no_image_s.png";
                            $anonymous_user = 'Anonymous User';
                            $review_message = $recommendation->message;
                            $age = time() - strtotime($recommendation->time);
                            if ($age >= 86400) 
                            {
                                $reviewed_on = date('jS M', strtotime($recommendation->time));
                            } 
                            else 
                            {
                                $reviewed_on = date::time2string($age);
                            }
                           $review_details[] =array('status'=>'Anonymous','anonymous_profile_pic'=>$anonymous_profile_pic,'review_message'=>$review_message,'reviewed_on'=>$reviewed_on,'anonymous_user'=>$anonymous_user); 
                        }
                        /*$review_details[] = array('review_profile_pic'=>$review_profile_pic,
                        'review_name'=>$review_name,'review_email'=>$review_email,'review_message'=>$review_message,'review_sender_name'=>$review_sender_name,
                        'reviewed_on'=>$reviewed_on); */
                  
               /* } */     
                           
                    echo json_encode(
                            array(
                                    'status' => 1, 
                                    'tags' => $tags,
                                    'Name' => $user->user_detail->first_name." ".$user->user_detail->last_name,
                                    'Profile_pic' => $user_profile_pic,
                                    'Social_percent' => $user->calculate_social_percentage($tags),
                                    'review' =>$review_details,
                                    'location' => $user->user_detail->location,
                                    'gender' => $user->user_detail->sex,
                                    'phase_of_life' => $phase_of_life,
                                    'education' => $user->user_detail->education,
                                    'Website' => $website,
                                    'profession' => $user->user_detail->designation." at ".$user->user_detail->employment,
                                    'from' => $from,
                                    'lives_in' => $live_in,
                                    'no_of_friends'=>$n,
                                    'friends' => $friends_details,
                                    'Details'  =>$about,
                                    'similar_pic_details' => $similar_pic_details
                                )
                            );
                    exit; 
            }   
        }
            echo "<h1>view Profile</h1></br>
            Method = GET</br>
            Parameter =></br>
            For view Profile =>username</br>"; 
            exit;
    }
    public function action_change_email() 
    {
        if ($this->request->query()) 
        { // if post request
            $post_data = $this->request->query();
            $user_email = ORM::factory('user',array('id'=>$this->request->query('user_id')));
            if($post_data['email'] != $user_email->email) 
            {
                $user = ORM::factory('user')
                    ->where('email', '=', $post_data['email'])
                    ->where('id', '!=', $user_email->id)
                    ->find();

                if($user->id) 
                {
                    //Session::instance()->set('error', 'This email is already registered.');
                    echo json_encode(array('status'=>0,'message'=>'This email is already registered.'));
                    exit;
                } 
                    else 
                {
                    //save data
                    $user = Auth::instance()->get_user();
                    $user->values(array('new_email' => $post_data['email']));
                    $user->save();

                    // Token data
                    $data = array(
                        'user_id'    => $user->pk(),
                        'expires'    => time() + 1209600,
                        'created'    => time(),
                        'type'       => 'change_email'
                    );
                    // Create a new activation token
                    $token = ORM::factory('user_token')
                           ->values($data)
                           ->create();
                    $email = base64_encode($user->new_email);
                    $link = url::base()."pages/change_email/".$email."/".$token->token;
                    Session::instance()->set('Link',$link);
                    //send activation email
                    $send_email = Email::factory('Change Email Address Confirmation')
                        ->message(View::factory('mails/change_email_mail', array('link' => $link))->render(), 'text/html')
                        ->to($user->new_email)
                        ->from('noreply@Callitme.com', 'Callitme')
                        ->send();
                    $send_email = Email::factory('Change Email Address Request')
                        ->message(View::factory('mails/alert_email_mail', array('new_email' => $user->new_email))->render(), 'text/html')
                        ->to($user->email)
                        ->from('noreply@Callitme.com', 'Callitme')
                        ->send();   
                    //Session::instance()->set('success', 'Your request to change email is being processed. Please verify your new email address to complete the process.');
                    echo json_encode(array('status'=>1,'message'=>'Your request to change email is being processed. Please verify your new email address to complete the process.'));
                    exit;
                    $this->request->redirect(url::base()."account/change_email");
                }
            }
        }
        echo "email update Api";
        exit;
    }
    public function action_email_resend()//resend change email mail 
    {
           $user = ORM::factory('user',array('id'=>$this->request->query('user_id')));//Auth::instance()->get_user();
           $link=session::instance()->get('Link');
             $send_email = Email::factory('Change Email Address Confirmation')
                        ->message(View::factory('mails/change_email_mail', array('link' => $link))->render(), 'text/html')
                        ->to($user->new_email)
                        ->from('noreply@Callitme.com', 'Callitme')
                        ->send();
             if($send_email)
             {
                //Session::instance()->set('success', 'Your request to change email is being processed. Please verify your new email address to complete the process.');
                echo json_encode(array('status'=>1,'message'=>'Your request to change email is being processed. Please verify your new email address to complete the process.'));
                exit;
                 //  $this->request->redirect(url::base()."account/change_email");
             }      
    }
    public function action_change_password() 
    {
        $user = Auth::instance()->get_user();
        
        if ($this->request->query('old_password')) 
        {
            
            if (Auth::instance()->check_password( $this->request->query('old_password') )) {
                //if old password match, save new password
                $user = ORM::factory('user', Auth::instance()->get_user()->id);
                $user->values($this->request->post());
                $user->save();
                //Session::instance()->set('success', 'Your Password has been updated');
                echo json_encode(array('status'=> 1,'message'=>'Your Password has been updated'));
                exit;
                
            } else {
                //Session::instance()->set('error', 'Incorrect Password.');
                echo json_encode(array('status'=> 0,'message'=>'Incorrect Password.'));
                exit;
            }
        }
        else
        {
            echo json_encode(array('status'=> 0,'message'=>'please paas your old password'));
            exit;
        }
    }
    //$user->username_suggestions();

    public function action_change_username() //change username
    {
        $user =  ORM::factory('user',array('id'=>$this->request->query('user_id')));//Auth::instance()->get_user();

        if ($this->request->query()) 
        { // if post request
            if(!$user->check_username($this->request->query('username'))) {

                //save member details
                $user->username = $this->request->query('username');
                $user->save();
                //Session::instance()->set('success', 'Your username has been updated');
                echo json_encode(array('status'=>1,'message'=>'Your username has been updated'));
                exit;

            } else {
                //Session::instance()->set('error', 'Username already exists.');
                echo json_encode(array('status'=>0,'message'=>'Username already exists.'));
                exit;
            }

        }
        echo "change username";
        exit;
    }

    public function action_username_suggestions() //change username
    {
        $user =  Auth::instance()->get_user();
        $suggestions = $user->username_suggestions();
        echo json_encode(array('status' => 1,'suggestions' => $suggestions));
        exit;
    }
    public function action_activity_notification() 
    {
        
            $this->auto_render = false;
            $user = ORM::factory('user',array('id'=>$this->request->query('user_id')));//Auth::instance()->get_user();
            if($this->request->query('seen')) 
            {
                $user->read_notification_at = date("Y-m-d H:i:s");
                $user->save();
                echo 'done';
            } else 
            {
                $friends_array = array();
                //create array of member_ids for fetching posts.
                foreach ($user->friends->where('is_deleted', '=', 0)->find_all()->as_array() as $friend) 
                {
                    $friends_array[] = $friend->id;
                }
                
                if(!empty($friends_array)) 
                {
                    $activities = ORM::factory('activity')
                        ->and_where_open()
                            ->where('target_user', '=', $user->id)
                            ->or_where_open()
                                ->where('user_id', 'IN', $friends_array)
                                ->and_where('target_user', '=', 0)
                            ->or_where_close()
                        ->and_where_close()
                        ->order_by('time', 'desc')
                        ->limit(8)
                        ->find_all()
                        ->as_array();
                } else 
                {
                    $activities = ORM::factory('activity')
                        ->where('target_user', '=', $user->id)
                        ->order_by('time', 'desc')
                        ->limit(8)
                        ->find_all()
                        ->as_array();
                }

                if (!empty($activities))
                {
                    $act = array();
                    foreach ($activities as $activity) 
                    {
                        $href = url::base() . "members/view_post/" . $activity->target_id;
                        if ($activity->type == 'arequest') 
                        {
                            $href = url::base() . "activity/view/" . $activity->target_id;
                            $class = '';
                        } 
                        else if ($activity->type == 'new_recommend') 
                        {
                            $href = url::base() . "peoplereview/recommend_recieve";
                            $class = '';
                        }
                        else if ($activity->type == 'anon_recommend') 
                        {
                            $href = url::base() . "peoplereview/recommend_recieve";
                            $class = '';
                        }
                        else if ($activity->type == 'ask_recommend' || $activity->type == 'askreview') 
                        {
                            $href = url::base() . "peoplereview/recommend_request/";
                            $class = '';
                        } 
                        else if ($activity->type == 'profile_view' || $activity->type == 'arequest_match') 
                        {
                            $href = url::base() . ORM::factory('user', $activity->target_id)->username;
                            $class = '';
                        }

                        else if ($activity->type == 'profile_pic') 
                        {

                            $href = url::base() . "members/view_post/" . $activity->target_id;
                            $class = "noti_pop";
                        }
                        else if ($activity->type == 'ask_user_photo') 
                        {
                            $postid=ORM::factory('post')->where('type','=',$activity->type)->order_by('id','desc')->limit(1)->find();
                            $href = url::base().$session_user->username.'/edit_profile';
                            $class = '';
                        }

                        if ($activity->type != 'arequest')
                        {
                            if ($activity->type == 'anon_recommend') 
                            {
                                $profile_pic = url::base() . "img/no_image_s.png";
                                //$href = url::base() . "peoplereview/recommend_recieve";
                            }
                            else
                            {
                                //$href = url::base() . $activity->user->username;
                                 if ($activity->user->photo->profile_pic_m) 
                                 {
                                    $profile_pic = url::base() . "upload/" . $activity->user->photo->profile_pic_m;
                                 }
                                 else
                                 {
                                    $profile_pic = $activity->user->user_detail->first_name[0] . $activity->user->user_detail->last_name[0];
                                 }
                                //$profile_pic = url::base() . "img/no_image_s.png";
                            }
                        }
                        else
                        {
                            $profile_pic = $user->user_detail->first_name[0] . $user->user_detail->last_name[0];
                             
                        }

                        $activity1 = str_replace($user->user_detail->first_name . " " . $user->user_detail->last_name, 'you', $activity->activity);
                        $age = time() - strtotime($activity->time);
                        if ($age >= 86400) {
                            $time = date('jS M', strtotime($activity->time));
                        } else {
                            $time = date::time2string($age);
                        }
                        $act[] = array(
                               'href' => $href,
                               'activity_type' =>$activity->type,
                               'profile_pic'=>$profile_pic,
                               'activity1' => $activity1,
                               'time' => $time

                            );
                    }
                    echo json_encode(array('status'=>1,'message'=>'fetch successfully','noti'=>$act));
                    exit;
                }
                else
                {
                    echo json_encode(array('status'=>1, 'message'=>"No new notification."));
                    exit;
                }
            }
    }
    public function action_profile_check_out()
    {
        if($this->request->query())
        {
            $user = ORM::factory('user' , array('id'=>$this->request->query('user_id')));
            $check_out  = ORM::factory('user')->with('user_detail')
                        ->where('sex', '=', (($user->user_detail->sex == 'Male') ? 'Female' : 'Male'))
                        ->where('is_deleted', '=', 0)
                        ->where('is_blocked','=',0)
                        ->where('profile_private','=',0)
                        ->and_where('profile_public', '=', '0')
                        ->order_by(DB::expr('RAND()'))
                        ->limit(10)
                        ->find_all()
                        ->as_array();
            $user_chk_out = array();
            foreach ($check_out as $check_chk) 
            {
                $recommendations = $check_chk->recommendations->where('state', '=', 'approve')->order_by('time', 'desc')->find_all()->as_array();
                $temp_words = array();
                foreach($recommendations as $recommend) 
                {
                    $words = explode(', ', $recommend->words);
                    $temp_words = array_merge($temp_words, $words);
                }
                $tags = array_count_values($temp_words);

                $photo = $check_chk->photo->profile_pic_s;
                $photo_img = file_exists("upload/". $photo);
                if(!empty($photo) && $photo_img)
                {
                    $pro_pic = url::base()."upload/".$check_chk->photo->profile_pic_s;
                }
                else
                {
                    $pro_pic = $check_chk->user_detail->first_name[0]."".$check_chk->user_detail->last_name[0];    
                }
                $use_name = $check_chk->user_detail->first_name." ".$check_chk->user_detail->last_name;
                $usename = $check_chk->username;
                $user_id = $check_chk->id;
                $email = $check_chk->email;
                $user_sex = $check_chk->user_detail->sex;
                $phase_of_life = Kohana::$config->load('profile')->get('phase_of_life');
                $phase_of_life = ($check_chk->user_detail->phase_of_life) ? $phase_of_life[$check_chk->user_detail->phase_of_life]:"";
                
                $Social = $check_chk->calculate_social_percentage($tags);
                $user_chk_out[] = array('Profile_pic'=>$pro_pic,'Name'=>$use_name,'username'=>$usename,'user_id'=>$user_id,'email'=>$email,'User_Sex'=>$user_sex,'Social_percent'=>$Social,'phase_of_life'=>$phase_of_life); 
            }            
            echo json_encode(array('Status'=>'1','Profile_check_out_user'=>$user_chk_out));
            exit;
        }
    }
    public function action_search_result()
    {
        if($this->request->query())
        {
            $user = ORM::factory('user')->with('user_detail')
                  ->where('first_name','like','%'.$this->request->query('first_name').'%')
                  ->and_where('last_name','like','%'.$this->request->query('last_name').'%')
                  ->where('is_deleted', '=', 0)
                  ->limit(10)
                  ->find_all()
                  ->as_array();
            $data = array();
            foreach ($user as $user_search) 
            {
                    $recommendations = $user_search->recommendations->where('state', '=', 'approve')->order_by('time', 'desc')->find_all()->as_array();
                    $temp_words = array();
                    foreach ($recommendations as $recommend) 
                    {
                        $words = explode(', ', $recommend->words);
                        $temp_words = array_merge($temp_words, $words);
                    }
                    $tags = array_count_values($temp_words);
                    $n = ORM::factory('friendship')->where('user_id', '=', $user_search->id)->count_all();
                    $photo = $user_search->photo->profile_pic_s;
                    $photo_img = file_exists("upload/". $photo);
                    if(!empty($photo) && $photo_img)
                    {
                        $pro_pic = url::base()."upload/".$user_search->photo->profile_pic_s;
                    }
                    else
                    {
                        $pro_pic = $user_search->user_detail->first_name[0]."".$user_search->user_detail->last_name[0];    
                    } 
                    $name =  $user_search->user_detail->first_name . " " . $user_search->user_detail->last_name;           
                    $display_details = array();
                    if(!empty($user_search->user_detail->designation)) 
                    { 
                        $display_details[] = $user_search->user_detail->designation;
                    }
                    if (!empty($user_search->user_detail->phase_of_life)) 
                    {
                        $phase_of_life = Kohana::$config->load('profile')->get('phase_of_life');
                        $display_details[] = $phase_of_life[$user_search->user_detail->phase_of_life];
                    }
                    if (!empty($user_search->user_detail->education))
                    {
                        $display_details[] = $user_search->user_detail->education;
                    }
                    $user_id = $user_search->user->id;
                    $location =  $user_search->user_detail->location;
                    $website  =  $user_search->user_detail->website;
                    $Social = $user_search->calculate_social_percentage($tags);
                    $user_search_res[] = array('Profile_pic'=>$pro_pic,'Name'=>$name,'Lives_in'=>$location,'Website'=>$website,'Social_percent'=>$Social,'user_id'=>$user_id,'Friends'=>$n,'Review'=>count($recommendations),'phase_of_life'=>implode(', ', $display_details));
            }      
            echo json_encode(array('number_of_user'=>count($user),'Status'=>'1','search_result'=>$user_search_res));
            exit;   
        }
    }
    public function action_emailnotification()
    {
        $user = ORM::factory('user',array('id'=>$this->request->query('user_id')));
        if($this->request->query())
        {
            $update['req_alert']    = $this->request->query('req_alert') ? 1 : 0;
            $update['msg_alert']    = $this->request->query('msg_alert') ? 1 : 0;
            $update['rec_alert']    = $this->request->query('rec_alert') ? 1 : 0;
            $update['friend_alert'] = $this->request->query('friend_alert') ? 1 : 0;
            $update['join_alert'] = $this->request->query('join_alert') ? 1 : 0;
            $update['profile_alert'] = $this->request->query('profile_alert') ? 1 : 0;
            $update['friend_request_alert'] = $this->request->query('friend_request_alert') ? 1 : 0;
            $update['meet_people_alert'] = $this->request->query('meet_people_alert') ? 1 : 0;
            $update['suggestion_email_alert'] = $this->request->query('suggestion_email_alert') ? 1 : 0;
            $update['profile_information_alert'] = $this->request->query('profile_information_alert') ? 1 : 0;
            $update['photo_alert'] = $this->request->query('photo_alert') ? 1 : 0;
            $update['friend_email_alert'] = $this->request->query('friend_email_alert') ? 1 : 0;
            $user->user_detail->values($update);
            $user->user_detail->save();
            echo json_encode(array('Status'=>'1','success'=>'Your settings have been updated','req_alert'=>$update['req_alert'],'msg_alert'=>$update['msg_alert'],'rec_alert'=>$update['rec_alert'],
                'friend_alert'=>$update['friend_alert'],'join_alert'=>$update['join_alert'],'profile_alert'=>$update['profile_alert'],'friend_request_alert'=>$update['friend_request_alert'],
                'meet_people_alert'=>$update['meet_people_alert'],'suggestion_email_alert'=>$update['suggestion_email_alert'],
                'profile_information_alert'=>$update['profile_information_alert'],'photo_alert'=>$update['photo_alert'],'friend_email_alert'=>$update['friend_email_alert']));
            exit;
        }
      
    }
    public function action_privacy_settings()
    {
        $user = ORM::factory('user',array('id'=>$this->request->query('user_id')));
        if($this->request->query())
        {
            if($user->profile_private != $this->request->query('profile_private')) 
            {
                $user->profile_private = $this->request->query('profile_private') ? 1 : 0;
                $user->save();
            }
            $update['friends_private']    = $this->request->query('friends_private') ? 1 : 0;
            $update['reviews_private']    = $this->request->query('reviews_private') ? 1 : 0;
            $update['people_say_private'] = $this->request->query('people_say_private') ? 1 : 0;
            $user->user_detail->values($update);
            $user->user_detail->save();
            echo json_encode(array('Status'=>'1','success'=>'privacy_settings','friends_private'=>$update['friends_private'],'reviews_private'=>$update['reviews_private'],'people_say_private'=>$update['people_say_private']));
            exit;
        }
    }
   
} 