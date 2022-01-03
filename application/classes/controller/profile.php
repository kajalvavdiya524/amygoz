<?php defined('SYSPATH') or die('No direct script access.');


class Controller_Profile extends Controller_Template {

    public $template = 'templates/profile';
    
    public function before() 
    {
        parent::before();
        if(!Auth::instance()->logged_in()) { //if not login redirect to login page
            $this->request->redirect('login');
        } else if( Auth::instance()->get_user()->registration_steps != 'done' && !in_array($this->request->action(), array('unique_username'))) {
            Auth::instance()->get_user()->check_registration_steps();
        }
        
        Auth::instance()->get_user()->check_plan_validity();
        //if request is ajax don't load the template
        if(!$this->request->is_ajax()) {

            $this->template->title = 'Amygoz';
            $this->template->description = 'Get Inspired.';
            $this->template->header = View::factory('templates/members-header');
            $this->template->sidemenu = View::factory('templates/sidemenu', array('side_menu' => 'profile'));
            $this->template->footer = View::factory('templates/member-footer');
        }

    }

    public function action_edit_profile() {
        $user =  Auth::instance()->get_user();

        if ($this->request->post()) 
        { // if post request
            $post_type = 'profile_details';
            $post_data = $this->request->post();
            //save member details2
            if(!empty($post_data['location']) || !empty($post_data['home_town']))
            {
                if($post_data['location'] && $post_data['location_chk'] == 'done' || $post_data['home_town'] && $post_data['location_chkb'] == 'done')
                {
                    $user->user_detail->values($post_data);
                    $changed = $user->user_detail->changed();
                    $original_values = $user->user_detail->original_values();
                    $user->user_detail->save();
                    
                    $this->post = new Model_Post;
                    $show_column = Kohana::$config->load('profile')->get('show_column');
                    foreach($changed as $change) 
                    {
                        if(array_key_exists($change, $show_column)) 
                        {
                            $change_config = Kohana::$config->load('profile')->get($change);
                            
                            if(!empty($original_values[$change])) {
                                $update_text = Kohana::$config->load('profile')->get('update_text');

                                if(!empty($change_config)) {
                                    $old = $change_config[$original_values[$change]];
                                    $new = $change_config[$user->user_detail->$change];
                                } else {
                                    $old = $original_values[$change];
                                    $new = $user->user_detail->$change;
                                }

                                $post_content = str_replace(array('{old}', '{new}'), array($old, $new), $update_text[$change]);
                            } else {
                                $add_text = Kohana::$config->load('profile')->get('add_text');

                                if(!empty($change_config)) {
                                    $new = $change_config[$user->user_detail->$change];
                                } else {
                                    $new = $user->user_detail->$change;
                                }

                                $post_content = str_replace('{new}', $new, $add_text[$change]);
                            }

                            $has_s = Kohana::$config->load('profile')->get('has_s');
                            if($has_s[$change]) {
                                $post_type = 'profile_details2';
                            }

                            $this->post->new_post($post_type, '', $post_content);
                        }
                        
                    }
                    Session::instance()->set('success', 'Details have been updated');
                    $this->request->redirect(url::base()."account/edit_profile");
                }else
                {
                    Session::instance()->set('location_error', 'Please choose a proper location.');
                    $this->request->redirect(url::base()."account/edit_profile");
                }
            }
            else
            {
                $user->user_detail->values($post_data);
                $changed = $user->user_detail->changed();
                $original_values = $user->user_detail->original_values();
                $user->user_detail->save();
                
                //add post.
                $this->post = new Model_Post;
                $show_column = Kohana::$config->load('profile')->get('show_column');

                foreach($changed as $change) 
                {
                    if($change != 'phone' )
                    {
                        if(array_key_exists($change, $show_column)) 
                        {
                            $change_config = Kohana::$config->load('profile')->get($change);
                            
                            if(!empty($original_values[$change])) {
                                $update_text = Kohana::$config->load('profile')->get('update_text');

                                if(!empty($change_config)) {
                                    $old = $change_config[$original_values[$change]];
                                    $new = $change_config[$user->user_detail->$change];
                                } else {
                                    $old = $original_values[$change];
                                    $new = $user->user_detail->$change;
                                }

                                $post_content = str_replace(array('{old}', '{new}'), array($old, $new), $update_text[$change]);
                            } else {
                                $add_text = Kohana::$config->load('profile')->get('add_text');

                                if(!empty($change_config)) {
                                    $new = $change_config[$user->user_detail->$change];
                                } else {
                                    $new = $user->user_detail->$change;
                                }

                                $post_content = str_replace('{new}', $new, $add_text[$change]);
                            }

                            $has_s = Kohana::$config->load('profile')->get('has_s');
                            if($has_s[$change]) {
                                $post_type = 'profile_details2';
                            }

                            $this->post->new_post($post_type, '', $post_content);
                        }
                    }
                }
                Session::instance()->set('success', 'Details have been updated');
                $this->request->redirect(url::base()."account/edit_profile");
            }
        }

        $data['user'] = $user;
         $this->template->sidemenu = View::factory('templates/sidemenu', array('side_menu' => 'edit_profile'));
        $this->template->content = View::factory('profile/edit_profile', $data);
        $this->template->title = 'Crowdprofiling, crowdmatching, social dating and people review'; //Ash added
    }

  /*  public function action_profile_pic() {
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
            
                //echo $image->width;exit;
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

                //update image names in database
                $photo = ORM::factory('photo', $user->photo_id);
                $photo->profile_pic = basename($name);
                $photo->profile_pic_o = basename($this->request->post('imag_name'));
                $photo->profile_pic_m = basename($name_m);
                $photo->profile_pic_s = basename($name_s);
                $photo->save();
                if (!$user->photo_id) {
                    $user->photo_id = $photo->id;
                    $user->save();
                }

                $this->post = new Model_Post;
                $this->post->delete_post('profile_pic', $user);
                $post = $this->post->new_post('update_profile_pic', url::base().'upload/'.$photo->profile_pic_o, " has updated profile picture. ");
               
                $this->activity = new Model_Activity;
                $this->activity->delete_activity('update_profile_pic', $user);               
                $this->activity->new_activity('update_profile_pic', 'has updated Profile picture', $post->id,'');
                
                $request_id = DB::select()
                            ->from('askphoto')
                            ->where('user_id','=',$user->id)
                            ->execute();
                            foreach ($request_id as  $value)
                             {
                                 
                                $request_user=ORM::factory('user')->with('user_detail')
                                                ->where('user.id','=',$value['asker_id'])
                                                ->find_all()
                                                ->as_array();

                                                                      
                                   foreach ($request_user as $request_users ) 
                                   {        
                                         $mail_id= $request_users->email;                                                                                                                                                     
                                         $send_email = Email::factory($user->user_detail->first_name." has uploaded profile picture")                                      
                                        ->message(View::factory('mails/upload_picture', array('newemail' => $request_users->user_detail->first_name,'username'=>$user->username,'user_name'=>$user->user_detail->first_name))->render(), 'text/html')
                                        //->to('pgoswami@maangu.com') 
                                        ->to($request_users->email)                                     
                                        ->from($user->email)
                                        ->send();
                                         

                                $this->activity = new Model_Activity;    
                                $this->activity->new_activity('profile_pic', 'has uploaded a profile picture', $user->id, $request_users->id);      

                                    


                                }
                                foreach ($request_user as $request_users ) 
                                   {
                                $delete_ask_pic_entry=DB::delete('askphoto')
                                                        ->where('user_id', '=', $user->id)
                                                        ->where('asker_id','=',$request_users->id)
                                                        ->execute();
                                                    }
                                   
                             }  
                
                                                                                            
                $this->request->redirect(url::base()."profile/edit_profile");
                 


            } else {
                $picture = Upload::save($_FILES['picture'], null , DOCROOT."upload/");
                $str = Text::random();
                $original = "pp-".$user->id ."-".$str."_o.jpg"; //original profile pic
                //resize to different sizes
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
        
    }*/
    
    public function action_profile_pic() {
        $this->auto_render = false;

        if( $this->request->post() ) {
            $user = Auth::instance()->get_user();
            $name1 = $_FILES["picture"]['name'];
            $ext = end((explode(".", $name1))); # extra () to prevent notice
            $picture = Upload::save($_FILES['picture'], null , DOCROOT."mobile/upload/");
            $str = Text::random();
            $original = "pp-".$user->id ."-".$str."_o.jpg"; //original profile pic
            //resize to different sizes
            $image = Image::factory($picture);
            $image->resize(500, 500);

            $image->save(DOCROOT."mobile/upload/".$original);
                
            $photo = ORM::factory('photo', $user->photo_id);
                    
            try {
                      
                if (file_exists(DOCROOT."upload/".$photo->profile_pic) || file_exists(DOCROOT."mobile/upload".$photo->profile_pic))
                    unlink(DOCROOT."upload/".$photo->profile_pic);
                    unlink(DOCROOT."mobile/upload".$photo->profile_pic);
                if (file_exists(DOCROOT."upload/".$photo->profile_pic_m) || file_exists(DOCROOT."mobile/upload".$photo->profile_pic_m))
                    unlink(DOCROOT."upload/".$photo->profile_pic_m);
                    unlink(DOCROOT."mobile/upload".$photo->profile_pic_m);
                if (file_exists(DOCROOT."upload/".$photo->profile_pic_s) || file_exists(DOCROOT."mobile/upload".$photo->profile_pic_s))
                    unlink(DOCROOT."upload/".$photo->profile_pic_s);
                    unlink(DOCROOT."mobile/upload".$photo->profile_pic_s);
                            
            } catch(Exception $e) { }
                // $image = Image::factory($picture);
            $str = Text::random();
            $name = "pp-".$user->id ."-".$str.".jpg"; //main profile pic
            $name_s = "pp-".$user->id ."-".$str."_s.jpg"; //small pic
            $name_m = "pp-".$user->id ."-".$str."_m.jpg"; //mini pic

            if(strtolower($ext) == 'jpg' || strtolower($ext) =='jpeg' || strtolower($ext) =='TIFE') {
                $exif = exif_read_data($picture);
            } else {
                $exif = $picture;
            }
            
            if(isset($exif['Orientation'])) {
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

            $image->resize(400, null);
            //$image->crop(400,400);
            $image->save(DOCROOT."mobile/upload/".$name); 
            $image->resize(null, 63);
            $image->save(DOCROOT."mobile/upload/".$name_s);
            $image->resize(null, 50);
            $image->save(DOCROOT."mobile/upload/".$name_m);
            //update image names in database
            $photo = ORM::factory('photo', $user->photo_id);
            $photo->profile_pic   = basename($name);
            $photo->profile_pic_o = basename($original);
            $photo->profile_pic_m = basename($name_m);
            $photo->profile_pic_s = basename($name_s);
            $photo->save();
            if (!$user->photo_id) {
                $user->photo_id = $photo->id;
                $user->save();
            }

            $this->post = new Model_Post;
            $this->post->delete_post('profile_pic', $user);
            $post = $this->post->new_post('profile_pic', url::base().'mobile/upload/'.$photo->profile_pic_o, " has updated profile picture. ");
            $this->activity = new Model_Activity;
            $this->activity->delete_activity('profile_pic', $user);               
            $this->activity->new_activity('profile_pic', 'has updated Profile picture', $post->id,'');
                
            $request_id = DB::select()
                ->from('askphoto')
                ->where('user_id','=',$user->id)
                ->execute();

            foreach($request_id as  $value) {

                $request_user = ORM::factory('user')->with('user_detail')
                    ->where('user.id','=',$value['asker_id'])
                    ->find_all()
                    ->as_array();

                foreach($request_user as $request_users ) {        
                    $mail_id = $request_users->email;      
                    
                    $send_email = Email::factory($user->user_detail->first_name." has uploaded profile picture")                                      
                        ->message(View::factory('mails/upload_picture', array('newemail' => $request_users,'username'=>$user->username,'user_name'=>$user->user_detail->first_name))->render(), 'text/html')
                        ->to($request_users->email)                                     
                        ->from('noreply@callitme.com', $user->user_detail->first_name)
                        ->send();

                    $this->activity = new Model_Activity;    
                    $this->activity->new_activity('profile_pic', 'has uploaded a profile picture', $post->id, $request_users->id);      
                }

                foreach($request_user as $request_users ) {
                    $delete_ask_pic_entry = DB::delete('askphoto')
                        ->where('user_id', '=', $user->id)
                        ->where('asker_id','=',$request_users->id)
                        ->execute();
                }
            }  
                
            $this->request->redirect(url::base()."profile/edit_profile");
 
        }

    }
        

    public function action_deactivate() {
        if($this->request->post('confirm')) {
            $user = Auth::instance()->get_user();
            $user->is_deleted = 1;
            $user->delete_expires = date("Y-m-d", strtotime("+30 days"));
            $user->save();
        }
        
        $this->request->redirect(url::base()."profile/email");
    }

    public function action_subscription_details() {
        $user = Auth::instance()->get_user();
        
        $this->template->title = 'Amygoz';
        $this->template->content = View::factory('profile/subscription_details');
    }

    public function action_unique_username() {
        // check if the username is already taken or not
        $this->auto_render = false;
        if($this->request->post()) {
            if(Auth::instance()->get_user()->check_username($this->request->post('username'))) {
                echo '1'; 
            } else {
                echo '0';
            }
        }
    }

    public function action_change_username() {
        $user =  Auth::instance()->get_user();

        if ($this->request->post()) { // if post request
            if(!$user->check_username($this->request->post('username'))) {
                //save member details
                $user->username = $this->request->post('username');
                $user->save();
                Session::instance()->set('success', 'Your username has been updated');
            } else {
                Session::instance()->set('error', 'Username already exists.');
            }

        }

        $data['suggestions'] = $user->username_suggestions();
        $data['user'] = $user;
        $this->template->content = View::factory('profile/change_username', $data);
    }
    
    public function action_change_email() {
        if ($this->request->post()) { // if post request
            $post_data = $this->request->post();

            if($post_data['email'] != Auth::instance()->get_user()->email) {

                $user = ORM::factory('user')
                    ->where('email', '=', $post_data['email'])
                    ->where('id', '!=', Auth::instance()->get_user()->id)
                    ->find();

                if($user->id) {
                    Session::instance()->set('error', 'This email is already registered.');
                } 
                else {
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
                        ->from('noreply@callitme.com', 'Amygoz')
                        ->send();

                     $send_email = Email::factory('Change Email Address Request')
                        ->message(View::factory('mails/alert_email_mail', array('new_email' => $user->new_email))->render(), 'text/html')
                        ->to($user->email)
                        ->from('noreply@callitme.com', 'Amygoz')
                        ->send();
                        
                    Session::instance()->set('success', 'Your request to change email is being processed. Please verify your new email address to complete the process.');
                    $this->request->redirect(url::base()."account/change_email");
                }

            }

        }

        $this->template->content = View::factory('profile/change_email');
        $this->template->title = 'Change Email'; //Ash added
    }
    
    public function action_email_resend()
    {
           $user = Auth::instance()->get_user();
           $link=session::instance()->get('Link');
             $send_email = Email::factory('Change Email Address Confirmation')
                        ->message(View::factory('mails/change_email_mail', array('link' => $link))->render(), 'text/html')
                        ->to($user->new_email)
                        ->from('noreply@callitme.com', 'Amygoz')
                        ->send();
             if($send_email)
             {
                  Session::instance()->set('success', 'Your request to change email is being processed. Please verify your new email address to complete the process.');
                    $this->request->redirect(url::base()."account/change_email");
             }
           
    }

    public function action_change_password() {
        $user = Auth::instance()->get_user();
        
        if ($this->request->post('old_password')) {
            
            if (Auth::instance()->check_password( $this->request->post('old_password') )) {
                //if old password match, save new password
                $user = ORM::factory('user', Auth::instance()->get_user()->id);
                $user->values($this->request->post());
                $user->save();
                Session::instance()->set('success', 'Your Password has been updated');
                
            } else {
                Session::instance()->set('error', 'Incorrect Password.');
            }
            
        }
        
        $data['user'] = $user;
        $this->template->content = View::factory('profile/change_password', $data);
    }

    public function action_viewers() {
        $user = Auth::instance()->get_user();
        $time = date('Y-m-d', strtotime('-30 days'));
        
        $viewers = $user->viewers
                        ->where(DB::expr("DATE(time)"), '>=', $time)
                        ->group_by('viewed_by')
                        ->order_by('time','desc')
                        ->find_all()
                        ->as_array();

        $data['viewers'] = $viewers;
        $this->template->content = View::factory('profile/viewers', $data);
    }

    public function action_unsubscribe() {
        $username = base64_decode($this->request->param('id'));
        if(!empty($username)) {
            //find user from username
            $user = ORM::factory('user', array('username' => $username));
            if ($user->loaded())
            {
                $user->email_notification = 0;
                $user->save();
                Session::instance()->set('active', 'Your are unsubscribed from system email notifications.');
            } else {
                Session::instance()->set('active', 'This link is invalid');
            }

        } else {
            Session::instance()->set('active', 'This link is invalid');
        }
        $this->request->redirect(url::base());
    }

    public function action_email_notification_settings() {
        $user = Auth::instance()->get_user();
    
        if($this->request->post()) {
            $update['req_alert'] = $this->request->post('req_alert') ? 1 : 0;
            $update['msg_alert'] = $this->request->post('msg_alert') ? 1 : 0;
            $update['rec_alert'] = $this->request->post('rec_alert') ? 1 : 0;
            $update['friend_alert'] = $this->request->post('friend_alert') ? 1 : 0;
            $update['join_alert'] = $this->request->post('join_alert') ? 1 : 0;
            $update['profile_alert'] = $this->request->post('profile_alert') ? 1 : 0;
            $update['friend_request_alert'] = $this->request->post('friend_request_alert') ? 1 : 0;
            $update['meet_people_alert'] = $this->request->post('meet_people_alert') ? 1 : 0;
            $update['suggestion_email_alert'] = $this->request->post('suggestion_email_alert') ? 1 : 0;
            $update['profile_information_alert'] = $this->request->post('profile_information_alert') ? 1 : 0;
            $update['photo_alert'] = $this->request->post('photo_alert') ? 1 : 0;
            $update['friend_email_alert'] = $this->request->post('friend_email_alert') ? 1 : 0;
            
            $user->user_detail->values($update);
            $user->user_detail->save();
            
            Session::instance()->set('success', 'Your settings have been updated');
            $this->request->redirect(url::base()."account/email_notification_settings");
        }
    
        $this->template->content = View::factory('profile/email_settings', array('user' => $user));
    }

    public function action_privacy_settings() {
        $user = Auth::instance()->get_user();

        if($this->request->post()) {

            if($user->profile_private != $this->request->post('profile_private')) {
                $user->profile_private = $this->request->post('profile_private') ? 1 : 0;
                $user->save();
            }

            $update['sex_private'] = $this->request->post('sex_private') ? 1 : 0;
            $update['phase_of_life_private'] = $this->request->post('phase_of_life_private') ? 1 : 0;
            $update['location_private'] = $this->request->post('location_private') ? 1 : 0;
            $update['home_town_private'] = $this->request->post('home_town_private') ? 1 : 0;
            $update['about_private'] = $this->request->post('about_private') ? 1 : 0;
            $update['education_private'] = $this->request->post('education_private') ? 1 : 0;
            $update['employment_private'] = $this->request->post('employment_private') ? 1 : 0;
            $update['designation_private'] = $this->request->post('designation_private') ? 1 : 0;
            $update['website_private'] = $this->request->post('website_private') ? 1 : 0;
            $update['friends_private'] = $this->request->post('friends_private') ? 1 : 0;
            $update['reviews_private'] = $this->request->post('reviews_private') ? 1 : 0;
            $update['people_say_private'] = $this->request->post('people_say_private') ? 1 : 0;

            $user->user_detail->values($update);
            $user->user_detail->save();

            Session::instance()->set('success', 'Your settings have been updated');
            $this->request->redirect(url::base()."account/privacy_settings");
        }

        $this->template->content = View::factory('profile/privacy_settings', array('user' => $user));
        $this->template->title = 'Privacy Settings';
    }



    

} // End Welcome
