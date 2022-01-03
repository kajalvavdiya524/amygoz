<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Cron extends Controller {

    public function __construct() {
        ini_set( 'max_execution_time', 0); 
        if(!empty($_SERVER['HTTP_HOST']) || !Kohana::$is_cli)  {
            throw new HTTP_Exception_404('The requested page does not exist!');
        }
    }

    public function action_index() { }
    
    public function action_test() {
        /*
        echo "asdsads";
        $send_email = Email::factory('Reminder to connect with me in Amygoz')
            ->message('This is a test message')
            ->to('shrivastavashutosh@gmail.com')
            ->from('shrivastavashutosh@yahoo.com',' via Amygoz')
            ->send();
            */
    }

    /*Automatically approve Reviews if No action is taken within 24 hours*/
    public function action_update_recommendations() {
        $recommends = ORM::factory('recommend')
            ->where('state', '=', 'pending')
            ->find_all()
            ->as_array();

        $today = strtotime('now');
        $count = 0;
        foreach ($recommends as $recommend) {
            $recommend_time = strtotime($recommend->time);
            $interval = $today - $recommend_time;
            $days = intval($interval/(60*60*24));

            if($days >= 3) {
                $recommend->state = 'approve';
                $recommend->save();
                $count++;
            }
        }

        $crontest = ORM::factory('crontest');
        $crontest->name = 'update_recommendations';
        $crontest->text = $count." reviews updated";
        $crontest->time = date("Y-m-d H:i:s");
        $crontest->save();
    }

    public function action_profile_views() {
        $day = date('N');

        $users = ORM::factory('user')
            ->where('not_registered', '=', 0)
            ->where('is_deleted', '!=', '1')
            ->where(DB::expr('MOD(id, 7)'), '=', $day-1)
            ->find_all()
            ->as_array();

        $number = 0;
        $details = array();
        foreach($users as $user) {
            $viewers = $user->viewers
                ->where(DB::expr("DATE(time)"), '>=', DB::expr('date_sub(curdate(), INTERVAL 1 WEEK)'))
                ->group_by('viewed_by')
                ->find_all()
                ->as_array();

            $count = count($viewers);

            if($count === 0) {
                continue;
            }

            $details []= $user->user_detail->first_name .' - '.$count.' viewers';

            $subject = $user->user_detail->first_name .', '.(($count === 1) ? '1 person' : $count.' people').' viewed your profile in last 1 week';

            if($user->user_detail->profile_alert) {
                /*
                $send_email = Email::factory("See who viewed your profile")
                  ->message(View::factory('mails/profile_view_mail', array('user' => $user, 'viewers' => $viewers))->render(), 'text/html')
                  ->to($user->email)

                  ->from('noreply@amygoz.com', 'Amygoz')
                  ->send();
                  */
            }            

            $number++;
        }

        $crontest = ORM::factory('crontest');
        $crontest->name = 'profile_views';
        $crontest->text = $number." profile view mails sent --> Details ".implode(' | ', $details);
        $crontest->time = date("Y-m-d H:i:s");
        $crontest->save();
    }

    /*If account not activated in 30 days, delete those accounts*/
    public function action_delete_profiles() {
        $users = ORM::factory('user')
            ->where('is_active', '=', '0')
            ->where('is_deleted', '!=', '1')
            ->where('profile_public','!=','1')    
            ->find_all()
            ->as_array();

        $count = 0;
        foreach($users as $user) {
            $expires = date("Y-m-d", strtotime("+90 days", strtotime($user->registration_date)));

            if($expires < date("Y-m-d")) {
                $user->is_deleted = 1;
                $user->delete_expires = date("Y-m-d", strtotime("-3 days"));
                $user->save();
                $count++;
            }

        }

        $crontest = ORM::factory('crontest');
        $crontest->name = 'delete_profiles';
        $crontest->text = $count." profiles deleted";
        $crontest->time = date("Y-m-d H:i:s");
        $crontest->save();
    }

    public function action_send_invites() { }

    public function action_send_mails() { }

    public function action_convert_bulk_invite() {
        $users = DB::select('id', 'email', 'not_registered')->from('users')
            ->as_object()
            ->execute();
        
        $bulks = ORM::factory('invite_bulk')->find_all()->as_array();
        
        $registeredUserList = array();
        $notRegisteredUserList = array();
        foreach($users as $user) {
            if($user->not_registered == 0) {
                $registeredUserList[] = $user->email;
            } else {
                $notRegisteredUserList[$user->id] = $user->email;
            }
        }

        unset($users);
        $p_count = 0;
        foreach($bulks as $bulk) {
            if($p_count >= 5) {
                break;
            }
            $existing = unserialize($bulk->emails);
            $existing = array_unique($existing);
            
            $notRegisteredORNotExists = array_diff($existing, $registeredUserList);
            $notExists = array_diff($notRegisteredORNotExists, $notRegisteredUserList);
            $existsButNotRegistered = array_diff($notRegisteredORNotExists, $notExists);
            
            $errors = array();
            foreach($notExists as $ne) {
                try {
                    $user_to = ORM::factory('user')->create_non_registered_user(trim($ne));

                    $invite = ORM::factory('invite');
                    $invite->user_id = $bulk->user_id;
                    $invite->invitee_id = $user_to->id;
                    $invite->invite_date = date('Y-m-d');

                    $invite->created = date('Y-m-d H:i:s');
                    $invite->save();
                } catch (Exception $e) {
                    $errors[] = trim($ne);
                }
            }
            
            if(!empty($existsButNotRegistered)) {
                $alreadyInvited = ORM::factory('invite')
                    ->where('user_id', '=', $bulk->user_id)
                    ->find_all()
                    ->as_array();

                $alreadyInvitedList = array();
                foreach($alreadyInvited as $al) {
                    $alreadyInvitedList[] = $al->invitee_id;
                }

                $existsButNotRegistered = array_intersect($notRegisteredUserList, $existsButNotRegistered);
                $existsButNotRegistered = array_flip($existsButNotRegistered);
                
                $process = array_diff($existsButNotRegistered, $alreadyInvitedList);

                foreach($process as $p) {
                    $invite = ORM::factory('invite');
                    $invite->user_id = $bulk->user_id;
                    $invite->invitee_id = $p;
                    $invite->invite_date = date('Y-m-d');

                    $invite->created = date('Y-m-d H:i:s');
                    $invite->save();
                }
            }
            
            $p_count++;
            $bulk->delete();
        }

        $crontest = ORM::factory('crontest');
        $crontest->name = 'convert_bulk_invite';
        $crontest->text = " Executed";
        $crontest->time = date("Y-m-d H:i:s");
        $crontest->save();
    }

    /*  Send a reminder email to people who have been
     *  invited but have not joined yet 
     */
    public function action_remind_invitees() {
        $invites = ORM::factory('invite')
            ->where('joined', '!=', 1)
            ->where('email_notification','!=', '1')
            ->where_open()
            ->where('last_reminded','<', DB::expr('date_sub(now(), INTERVAL 2 WEEK)'))
            ->or_where('last_reminded', '', DB::expr('IS NULL'))
            ->where_close()
            ->limit(50)
            ->find_all()
            ->as_array();

        $number = 0;
        $details = array();
        foreach($invites as $invite) {
            if(empty($invite->to->id)) {
                continue;
            }
            $update_data = array();

            $exists = ORM::factory('unsubscribe')
                ->where('unsubscribe_user_id', '=', $invite->to->id)
                ->where('specific_user_id', '=', $invite->by->id)
                ->where('type', '=', 'invite_mail')
                ->count_all();

            if(!$exists) {
                $update_data['last_reminded'] = date('Y-m-d H:i:s');
                $update_data['no_of_reminders'] = $invite->no_of_reminders + 1;
            } else {
                $update_data['email_notification'] = '1';
            }
            $invite->values($update_data);
            $invite->save();

            if(!$exists) {
                $details []= $invite->to->email .' from '.$invite->by->user_detail->get_name();

                $mail_data = array();
                $mail_data['invite'] = $invite;

                $str = $invite->to->email.' from '.$invite->by->email;

                $encrypt = Encrypt::instance('tripledes');
                $str = $encrypt->encode($str);

                $mail_data['unsubsribe_url'] = url::base().'pages/unsubscribe?token='.urlencode($str);

                //send email
                /*$send_email = Email::factory($invite->by->user_detail->get_name().' waiting for you to connect on Amygoz')
                    ->message(View::factory('mails/remind_invitees', $mail_data)->render(), 'text/html')
                    ->to($invite->to->email)
                    ->from('noreply@amygoz.com', $invite->by->user_detail->get_name() .' via Amygoz')
                    ->send();*/

                $number++;
            }
        }

        $crontest = ORM::factory('crontest');
        $crontest->name = 'remind_invitees';
        $crontest->text = $number." Remind invitees mail sent --> Details ".implode(' | ', $details);
        $crontest->time = date("Y-m-d H:i:s");
        $crontest->save();
    }

    /*If I have reviewed a non-member, then ask to join to see the reviews*/
    public function action_remind_to_join_reviewed() {
        $users = ORM::factory('user')
            ->join('recommends', 'INNER')
            ->on('recommends.to','=', 'user.id')
            ->where('not_registered', '=', 1)
            ->group_by('user.id')
            ->find_all()
            ->as_array();

        $number = 0;
        $details = array();
        foreach($users as $user) {
            $recommendations = $user->recommendations->group_by('from')->find_all()->as_array();

            foreach($recommendations as $recommendation) {
                $owner = $recommendation->owner;
                $details []= $user->email .' for '.$owner->user_detail->get_name();
                //send email
                /*$send_email = Email::factory('My Review About You')
                    ->message(View::factory('mails/remind_to_join_reviewed', array('user' => $user, 'owner' => $owner))->render(), 'text/html')
                    ->to($user->email)
                    ->from('noreply@amygoz.com', $owner->user_detail->get_name() .' via Amygoz')
                    ->send();*/
                
                $number++;
            }
        }

        $crontest = ORM::factory('crontest');
        $crontest->name = 'remind_to_join_reviewed';
        $crontest->text = $number." Remind to join reviewed mail sent --> Details ".implode(' | ', $details);
        $crontest->time = date("Y-m-d H:i:s");
        $crontest->save();
    }

    /*Asking a memeber to review another member to build credibilty*/
    public function action_write_review() {
        $people_reviewed =  DB::select('to')
            ->distinct(TRUE)
            ->from('recommends')
            ->as_object()
            ->execute();

        $reviewed = array();
        foreach($people_reviewed as $people) {
            $reviewed[] = $people->to;
        }

        $users = ORM::factory('user')
            ->where('not_registered', '=', 0)
            ->where('is_active', '=', '1')
            ->where('is_deleted', '!=', '1')
            ->find_all()
            ->as_array();

        $number = 0;
        $details = array();
        foreach($users as $user) {
            $friends = $user->friends->where('friend_id', 'NOT IN', $reviewed)->find_all()->as_array();

            if(empty($friends))
                continue;

            $f_key = array_rand($friends);
            $friend = $friends[$f_key];
            $details []= $user->email .' for '.$friend->user_detail->get_name();

            $recommendations = $user->recommendations->where('state', '=', 'approve')->order_by('time', 'desc')->find_all()->as_array();

            $temp_words = array();
            foreach($recommendations as $recommend) {
                $words = explode(', ', $recommend->words);
                $temp_words = array_merge($temp_words, $words);
            }
            $tags = array_count_values($temp_words);

            //send email
            /*$send_email = Email::factory('Review '.$friend->user_detail->get_name())
                ->message(View::factory('mails/write_review', array('user' => $user, 'friend' => $friend, 'tag' => $tags))->render(), 'text/html')
                ->to($user->email)
                ->from('noreply@amygoz.com', 'Amygoz')
                //->to('amitaofmaangu@gmail.com')
                //->from('noreply@amygoz.com', 'Amygoz')
                //->to('infosoft90@gmail.com')
                //->from('pgoswami@apprit.com',' via Amygoz')
                ->send();*/

            $number++;
        }

        $crontest = ORM::factory('crontest');
        $crontest->name = 'write_review';
        $crontest->text = $number." Write review mail sent --> Details : ".implode(' | ', $details);
        $crontest->time = date("Y-m-d H:i:s");
        $crontest->save();
    }

    /*Ask a member to review you*/
    public function action_ask_review() {
        $users = ORM::factory('user')
            ->where('is_active', '=', '1')
           // ->where('id', '=', '3289')
            ->where('is_deleted', '!=', '1')
            ->find_all()
            ->as_array();
        
        $number = 0;
        $details = array();
        foreach($users as $user) {
            
            
            //fetch people already reviewed you
            $recommendations = $user->recommendations->group_by('from')->find_all();

            $already = array();
            foreach($recommendations as $recommendation) {
                $already[] = $recommendation->from;
            }
                
            //find friends excluding those who has already reviewed you
            $friends = $user->friends;
            if(!empty($already)) {
                $friends = $friends->where('friend_id', 'NOT IN', $already);
            }

            $friends = $friends->find_all()->as_array();
            
            //if no friend continue
            if(empty($friends)) {
                continue;
            }
            
            //random friend
            $f_key = array_rand($friends);
            $friend = $friends[$f_key];
            $details []= $user->email .' for '.$friend->user_detail->get_name();
            
            //send email
            /*$send_email = Email::factory('Get Reviewed by '.$friend->user_detail->get_name())
                ->message(View::factory('mails/ask_review', array('user' => $user, 'friend' => $friend))->render(), 'text/html')
                ->to($user->email)
                ->from('noreply@amygoz.com', 'Amygoz')
                ->send();*/

            $number++;
        }

        $crontest = ORM::factory('crontest');
        $crontest->name = 'ask_review';
        $crontest->text = $number." Ask review mail sent --> Details : ".implode(' | ', $details);
        $crontest->time = date("Y-m-d H:i:s");
        $crontest->save();
    }

    /*Showing friend suggestions*/
    public function action_suggest_friend() {
        $day = date('w');

        $users = ORM::factory('user')
            ->where('not_registered', '=', 0)
            ->where('is_active', '=', '1')
            ->where('is_deleted', '!=', '1')
            ->where(DB::expr('MOD(id, 7)'), '=', $day)
            ->find_all()
            ->as_array();

        $number = 0;
        $details = array();
        foreach($users as $user) {
            $suggestions = $user->users_with_common_friends();

            if(empty($suggestions))
                continue;

            $details []= $user->email;

            $names = array();
            foreach($suggestions as $suggestion) {
                $names[] = $suggestion->user_detail->first_name;
            }

            if($names > 2) {
                $names = implode(', ', $names);
                $names = substr_replace($names, ' or ', strrpos($names, ', '), strlen(', '));
            } else {
                $names = implode(' or ', $names);
            }

            if($user->user_detail->suggestion_email_alert) {
                //send email
                /*$send_email = Email::factory('Do you know '.$names.'?')
                    ->message(View::factory('mails/suggest_friend', array('user' => $user, 'suggestions' => $suggestions))->render(), 'text/html')
                    ->to($user->email)
                    ->from('noreply@amygoz.com', 'Amygoz')
                    ->send();*/
            
                $number++;
            }
        }

        $crontest = ORM::factory('crontest');
        $crontest->name = 'suggest_friend';
        $crontest->text = $number." Suggest friend mail sent --> Details : ".implode(' | ', $details);
        $crontest->time = date("Y-m-d H:i:s");
        $crontest->save();
    }

    /*Telling a user  that profile photo is missing*/
    public function action_photos_missing() {
        $users = ORM::factory('user')->with('photo')
            ->where('not_registered', '=', 0)
            ->where('is_active', '=', '1')
            ->where('is_deleted', '!=', '1')
            ->where('profile_pic', 'IS', null)
            ->find_all()
            ->as_array();

        $number = 0;
        $details = array();
        foreach($users as $user) {
            $details []= $user->email;

            //send email
            /*$send_email = Email::factory('Your Photo is Missing')
                ->message(View::factory('mails/photos_missing', array('user' => $user))->render(), 'text/html')
                ->to($user->email)
                ->from('noreply@amygoz.com', 'Amygoz')
                ->send();*/

            $number++;
        }

        $crontest = ORM::factory('crontest');
        $crontest->name = 'photos_missing';
        $crontest->text = $number." Photos Missing mail sent --> Details : ".implode(' | ', $details);
        $crontest->time = date("Y-m-d H:i:s");
        $crontest->save();
    }

    public function action_photo_requested() {
        $ask_request = DB::select()->from('askphoto')->execute();
        
        $number = 0;
        $details = array();
        foreach($ask_request as $user) {
            $asker_user = ORM::factory('user',array('id'=>$user['asker_id']));
            $request_user = ORM::factory('user',array('id'=>$user['user_id']));
            //echo $asker_email->email;
            //echo $users_email->email;
            
            /*$send_email = Email::factory($asker_user->user_detail->first_name.' asked for your Photo')
                ->message(View::factory('mails/cron_ask_photo',
                 array('newemail1' => $request_user->user_detail, 'newemail' =>$request_user, 'sess_us'=>$asker_user))->render(), 'text/html')
                ->to($request_user->email)
                ->from('noreply@amygoz.com', 'Amygoz')
                ->send();*/
            
            //$number++;
        }

       /* $crontest = ORM::factory('crontest');
        $crontest->name = 'photo_requested';
        $crontest->text = $number." Photos Requested mail sent --> Details : ".implode(' | ', $details);
        $crontest->time = date("Y-m-d H:i:s");
        $crontest->save();*/
    }

    /*Suggesting to match one of your single friends*/
    public function action_match_friend() {
        $users = ORM::factory('user')
            ->where('not_registered', '=', 0)
            ->where('is_active', '=', '1')
            ->where('is_deleted', '!=', '1')
            ->find_all()
            ->as_array();

        $number = 0;
        $details = array();
        foreach($users as $user) {
            $friends = $user->friends->with('user_detail')
                ->where('not_registered', '=', 0)
                ->where('is_active', '=', '1')
                ->where('is_deleted', '!=', '1')
                ->where('phase_of_life', '=', '1')
                ->find_all()
                ->as_array();

            if(empty($friends))
                continue;

            //random friend
            $f_key = array_rand($friends);
            $friend = $friends[$f_key];
            $details []= $user->email .' for '.$friend->user_detail->get_name();

            //send email
            /*$send_email = Email::factory('Match '.$friend->user_detail->get_name().' with your friend')
                ->message(View::factory('mails/match_friend', array('user' => $user, 'friend' => $friend))->render(), 'text/html')
                ->to($user->email)
                ->from('noreply@amygoz.com', 'Amygoz')
                ->send();*/

            $number++;
        }

        $crontest = ORM::factory('crontest');
        $crontest->name = 'match_friend';
        $crontest->text = $number." Match friend mail sent --> Details : ".implode(' | ', $details);
        $crontest->time = date("Y-m-d H:i:s");
        $crontest->save();
    }

    public function action_send_request() {
        $users = ORM::factory('user')->with('user_detail')
            ->where('phase_of_life','=',1)
            ->where('not_registered', '=', 0)
            ->where('is_active', '=', '1')
            ->where('is_deleted', '!=', '1')
            ->find_all()
            ->as_array();

        $number = 0;
        $details = array();
        foreach($users as $user) {
            $details []= $user->email;
            
            //send email
            /*$send_email = Email::factory('Invite your friend for lunch')
                ->message(View::factory('mails/send_request', array('user' => $user))->render(), 'text/html')
                ->to($user->email)
                ->from('noreply@amygoz.com', 'Amygoz')
                ->send();*/
            $number++;
        }

      
        $crontest = ORM::factory('crontest');
        $crontest->name = 'send_request';
        $crontest->text = $number." Send Request mail sent --> Details : ".implode(' | ', $details);
        $crontest->time = date("Y-m-d H:i:s");
        $crontest->save();
    }
    
    /*Aren't you curious to know who lives around you*/
    public function action_view_local() {
        $users = ORM::factory('user')
            ->where('not_registered', '=', 0)
            ->where('is_active', '=', '1')
            ->where('is_deleted', '!=', '1')
            ->find_all()
            ->as_array();
        $number = 0;
        $details = array();
        foreach($users as $user) {
            $details []= $user->email;
            /*$send_email = Email::factory('Meet people around you')
                ->message(View::factory('mails/view_local', array('user' => $user))->render(), 'text/html')
                ->to($user->email)
                ->from('noreply@amygoz.com', 'Amygoz')
                ->send();*/
            $number++;
        }
        $crontest = ORM::factory('crontest');
        $crontest->name = 'view_local';
        $crontest->text = $number." View local mail sent --> Details : ".implode(' | ', $details);
        $crontest->time = date("Y-m-d H:i:s");
        $crontest->save();
    }

    public function action_view_profile() {
        $previous_date = date('Y-m-d',strtotime('-1 days'));
        $activity_data = DB::select('activities.*',array(DB::expr('IF(activities.type = "profile_view", CONCAT(activities.user_id,activities.target_user,DATE(time)), id)'), 'group_by'),array(DB::expr('COUNT(activities.id)'), 'count_view'))
            ->from('activities')
            ->where(DB::expr("DATE(time)"), '=', $previous_date)
            ->where('is_private', '=', '0')
            ->where('type', '=', 'profile_view')
            ->group_by('group_by')
            ->order_by('time', 'desc')
            ->execute()
            ->as_array();
            
        if(!empty($activity_data)) {
            foreach($activity_data as $activit) {
                $activities_data = ORM::factory('activity')
                    ->where(DB::expr("DATE(time)"), '=', $previous_date)
                    ->where('user_id', '=', $activit['user_id'])
                    ->where('target_user', '=', $activit['target_user'])
                    ->where('is_private', '=', '0')
                    ->where('type', '=', 'profile_view')
                    ->order_by('time', 'DESC')
                    ->find_all()
                    ->as_array();
                if(!empty($activities_data)) {
                    foreach($activities_data as $activity) {
                        $activity->is_private = '1';
                        $activity->save();
                    }
                }

                $user_data = ORM::factory('user')
                    ->where('id','=', $activit['user_id'])
                    ->find();

                $name = $user_data->user_detail->first_name.' '.$user_data->user_detail->last_name;
                $msg = $name.' has viewed your profile on yesterday.';
                if($activit['count_view'] > 1) {
                    $msg = $name.' has viewed your profile'.' '.$activit['count_view'].' times on yesterday.';
                }

                //Send Push Notification
                $firebase_tokens = ORM::factory('fcmtoken')
                    ->where('user_id', '=', $activit['target_user'])
                    ->where('device_type', '=', 'android')
                    ->find_all()
                    ->as_array();
                $fcm_tokens = [];
                if(!empty($firebase_tokens)) {
                    foreach($firebase_tokens AS $token) {
                        if($token->firebase_token != ''){
                            $fcm_tokens[] = $token->firebase_token;
                        }
                    }
                }
                if(!empty($fcm_tokens)) {
                    $data['fcm_group_token'] = $fcm_tokens;
                    $data['device_type'] = 'android';
                    $name = $user_data->user_detail->first_name.' '.$user_data->user_detail->last_name;
                    $message_array['custom_data']['message'] = $msg;
                    $message_array['custom_data']['username'] = $user_data->username;
                    $message_array['custom_data']['name'] = $name;
                    $message_array['custom_data']['profile_pic'] = url::base().'mobile/upload/'.$user_data->photo->profile_pic_o;
                    $message_array['custom_data']['type'] = 'Profile view';
                    $this->send_fcm_push($data,$message_array);
                }
                $ios_firebase_tokens = ORM::factory('fcmtoken')
                    ->where('user_id', '=', $activit['target_user'])
                    ->where('device_type', '=', 'ios')
                    ->find_all()
                    ->as_array();
                $ios_fcm_tokens = [];
                if(!empty($ios_firebase_tokens)) {
                    foreach($ios_firebase_tokens AS $token) {
                        if($token->firebase_token != ''){
                            $ios_fcm_tokens[] = $token->firebase_token;
                        }
                    }
                }
                if(!empty($ios_fcm_tokens)) {
                    $data['fcm_group_token'] = $ios_fcm_tokens;
                    $data['device_type'] = 'ios';
                    $name = $user_data->user_detail->first_name.' '.$user_data->user_detail->last_name;
                    $message_array['custom_data']['message'] = $msg;
                    $message_array['custom_data']['username'] = $user_data->username;
                    $message_array['custom_data']['name'] = $name;
                    $message_array['custom_data']['profile_pic'] = url::base().'mobile/upload/'.$user_data->photo->profile_pic_o;
                    $message_array['custom_data']['type'] = 'Profile view';
                    $this->send_fcm_push($data,$message_array);
                }

                $crontest = ORM::factory('crontest');
                $crontest->name = 'profile_view';
                $crontest->text = $msg;
                $crontest->time = date("Y-m-d H:i:s");
                $crontest->save();
            }
        }
    }

    function send_fcm_push($data,$message_data) {
        $register_id = $data['fcm_group_token'];
        $device_type = $data['device_type'];
        $body_msg = $message_data['custom_data']['message'];
        
        if($register_id != "") {
            if($device_type == 'ios') {
                unset($message_data['custom_data']['message']);
                $push_data = array(
                    "notification" => array(
                        'title' => 'Amygoz',        
                        'body'=> $body_msg
                    ),
                    "registration_ids"=>$register_id,
                    "data"=>(object)array(
                        "bodyText" => (object)$message_data['custom_data']
                    )
                );
            }
            else {
                $push_data = array(
                    "registration_ids"=>$register_id,
                    "data"=>(object)array(
                        "bodyText" => (object)$message_data['custom_data']
                    )
                );
            }
            
            $key = Kohana::$config->load('settings')->get('firebase')['apiKey'];
            $headers = array(
                "Content-Type : application/json",
                "Authorization : key=AAAAFZyY3cE:APA91bGdJfKOFx_3QU9GP5sImmFpSs6nVHX0V23LbMaC3JNDYVYWWPgPcWVtXPFQ-qTY-b8gtgFXtrgdrGP-GKcJTdwceU5uttXGPcs8vKG_HR5JLkAsmWZEPuGoaoiPP9ol2hqOBNaE",
            );
            return   $this->curl_request("https://fcm.googleapis.com/fcm/send",json_encode((object)$push_data),$headers,'POST');
        }
    }

    function curl_request($url, $data,$headers,$method = 'GET') {
        try {
            $curl = curl_init();

            $curl_array =    array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => $method,
                CURLOPT_HTTPHEADER => $headers,
            );

            if(!empty($data)){
                $curl_array[CURLOPT_POSTFIELDS] = $data;
            }
            curl_setopt_array($curl,$curl_array );
            $return = curl_exec($curl);
        }
        catch (Exception $e) {
            $return = null;
        }
        return $return;
    }

} // End Welcome
