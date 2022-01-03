<?php
defined('SYSPATH') or die('No direct script access.');


class Controller_Peoplereview extends Controller_Template {

    public $template = 'templates/profile';

    public function before() {
        parent::before();
        if(!Auth::instance()->logged_in()) { //if not login redirect to login page
            $this->request->redirect('pages/login');
        } else if( Auth::instance()->get_user()->registration_steps != 'done') {
            Auth::instance()->get_user()->check_registration_steps();
        }

        Auth::instance()->get_user()->check_plan_validity();
        //if request is ajax don't load the template
        if(!$this->request->is_ajax()) {

            $this->template->title = 'Building trust online through people reviews | Callitme';
            $this->template->description = 'Write reviews for people you know and ask people to review you';
            $this->template->header = View::factory('templates/members-header');
            $this->template->sidemenu = View::factory('templates/sidemenu', array('side_menu' => 'recommend'));
            $this->template->footer = View::factory('templates/member-footer');
        }

    }

    public function action_index() {
        $user = Auth::instance()->get_user();

        $data['relations'] = ORM::factory('recommend_relation')->find_all()->as_array();
        $data['words'] = ORM::factory('recommend_word')->find_all()->as_array();

        if($this->request->param('id')) {
            $data['recommend'] = ORM::factory('recommend', $this->request->param('id'));
        }

        if($this->request->query('id')) {
            $data['recommend'] = ORM::factory('recommend', $this->request->query('id'));
        }
        
        if($this->request->query('ask')) {
            $user_to = ORM::factory('user', array('username' => $this->request->query('ask')));
        }
        
        if($this->request->post('email')) {
            if($user->email === $this->request->post('email')) {
                Session::instance()->set('error', 'You can\'t review yourself.');
                $this->request->redirect(url::base()."peoplereview/compose");
            }

            $user_to = ORM::factory('user')
                ->where('email', '=',  $this->request->post('email'))
                ->where('not_registered', '=', 0)
                ->find();
        }

        if(isset($user_to) && $user_to->id) {
            $data['user_to'] = $user_to;
            
            if($user_to->user_detail->sex) {
                $data['relations'] = ORM::factory('recommend_relation')
                    ->where('gender', '=', $user_to->user_detail->sex)
                    ->or_where('gender', '=', '')
                    ->find_all()
                    ->as_array();
            }
        }

        if(!$this->request->is_ajax()) {
            $this->template->title = $user->user_detail->first_name .' '.$user->user_detail->last_name;
            $this->template->sidemenu = View::factory('recommend/menu', array('submenu' => 'compose'));
            $this->template->content = View::factory('recommend/send', $data);
        } else {
            $this->auto_render = false;
            echo View::factory('recommend/send',$data)->render();
        }
    }

    public function action_recommend_recieve() {
        $user = Auth::instance()->get_user();
        $data['recommends'] = $user->recommendations->order_by('time', 'desc')->find_all()->as_array();

        $this->template->sidemenu=   View::factory('recommend/menu', array('submenu' => 'recommend'));

        $this->template->title = $user->user_detail->first_name .' '.$user->user_detail->last_name;
        $this->template->content = View::factory('recommend/recommendations_received', $data);

    }

    public function action_recommend_sent() {
        $user = Auth::instance()->get_user();
        $data['recommends'] = $user->sent_recommendations->order_by('time', 'desc')->find_all()->as_array();
        $this->template->sidemenu = View::factory('recommend/menu', array('submenu' => 'recommend_sent'));
        $this->template->title = $user->user_detail->first_name .' '.$user->user_detail->last_name;
        $this->template->content = View::factory('recommend/recommendations_sent', $data);
    }

    public function action_compose() {
        $user = Auth::instance()->get_user();

        $data['relations'] = ORM::factory('recommend_relation')->find_all()->as_array();
        $data['words'] = ORM::factory('recommend_word')->find_all()->as_array();

        if($this->request->query('id')) {
            $data['recommend'] = ORM::factory('recommend', $this->request->query('id'));
        }
        
        if($this->request->query('ask')) {
            $data['user_to'] = ORM::factory('user', array('username' => $this->request->query('ask')));
        }
        
        if($this->request->post('email')) {
            if($user->email === $this->request->post('email')) {
                Session::instance()->set('error', 'You can\'t review yourself.');
                $this->request->redirect(url::base()."peoplereview/compose");
            }

            $user_to = ORM::factory('user')
                ->where('email', '=',  $this->request->post('email'))
                ->where('not_registered', '=', 0)
                ->find();
            
            if($user_to->id) {
                $data['user_to'] = $user_to;
                
                if($user_to->user_detail->sex) {
                    $data['relations'] = ORM::factory('recommend_relation')
                    ->where('gender', '=', $user_to->user_detail->sex)
                    ->or_where('gender', '=', '')
                    ->find_all()
                    ->as_array();
                }
            }

        }

        if(!$this->request->is_ajax()) {
            $this->template->title = $user->user_detail->first_name .' '.$user->user_detail->last_name;
            $this->template->sidemenu = View::factory('recommend/menu', array('submenu' => 'compose'));
            $this->template->content = View::factory('recommend/send', $data);
        } else {
            $this->auto_render = false;
            echo View::factory('recommend/send',$data)->render();
        }
    }

    public function action_send() {
        $user = Auth::instance()->get_user();

        if($this->request->post()) {
            $post_data = $this->request->post();
            $post_data['message'] = strip_tags($post_data['message'], "<br>");

            if(empty($post_data['email'])) {
                session::instance()->set('error-email', "Please enter a valid email address or select any registered member.");
                $this->request->redirect(url::base()."peoplereview");
            }

            if(!isset($post_data['words'])) {
                session::instance()->set('error-words', "This field is required.");
                $this->request->redirect(url::base()."peoplereview");
            }

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
                $word_exists = preg_match('/('.implode('|', $words).')/i', $post_data['message']);

                if($word_exists) { // return with an error.
                    Session::instance()->set('error', 'This review contains some improper words that are not allowed.');
                    $this->request->redirect(url::base()."peoplereview");
                }
            }

            $user_to = ORM::factory('user')
                ->where('email', '=', $this->request->post('email'))
                ->find();  

            if(!$user_to->id) {
                $user_to = ORM::factory('user')->create_non_registered_user($this->request->post('email'));
            }

            if($user->email === $user_to->email) {
                Session::instance()->set('error', 'You can\'t review yourself.');
                $this->request->redirect(url::base()."peoplereview");
            }

            if(!$this->request->post('edit_recommend') && ORM::factory('recommend')->where('to', '=', $user_to->id)->where('from', '=', $user->id)->count_all()) {
                $already = ORM::factory('recommend')->where('to', '=', $user_to->id)->where('from', '=', $user->id)->find();
                $msg = "You have already reviewed ".$user_to->user_detail->first_name .".
                You can <a href=\"".url::base()."peoplereview/compose?id=".$already->id."\">Edit the review</a> you wrote for ".$user_to->user_detail->first_name;

                Session::instance()->set('error', $msg);
                $this->request->redirect(url::base()."peoplereview");
            } else {
                if($this->request->post('edit_recommend')) {
                    $recommend = ORM::factory('recommend', $this->request->post('edit_recommend'));
                    $post_data['status'] = 'pending';
                } else {
                    $recommend = ORM::factory('recommend');
                    $post_data['to'] = $user_to->id;
                    $post_data['from'] = Auth::instance()->get_user()->id;
                }

                $post_data['words'] = implode(', ', $post_data['words']);
                $post_data['time'] = date("Y-m-d H:i:s");

                if($post_data['review_type'] === 'anonymously') {
                    $post_data['type'] ='0';
                    $post_data['state'] ='approve';
                }

                $recommend->values($post_data);
                $recommend->save();

                if($user->rec_req->where('from', '=', $user_to->id)->count_all()) {
                    $user->rec_req->where('from', '=', $user_to->id)->find()->delete();
                }

                $this->activity = new Model_Activity;
                if(!$this->request->post('edit_recommend')) {
                    if($post_data['review_type'] === 'anonymously') {
                        $this->activity->new_s_activity('anon_recommend', ' has reviewed you', $recommend->id, $user_to->id);
                    } else {
                        $this->activity->new_activity('new_recommend', ' has reviewed you', $recommend->id, $user_to->id);
                    }
                } else {
                    if($post_data['review_type'] === 'anonymously') {
                        $this->activity->new_s_activity('anon_edit_recommend', ' has reviewed you', $recommend->id, $user_to->id);
                    } else {
                        $this->activity->new_activity('edit_review', 'has reviewed you', $recommend->id, $user_to->id);
                    }
                }

                if($user_to->user_detail->rec_alert) {
                    $from = Auth::instance()->get_user();

                    if($post_data['review_type'] === 'anonymously') {
                        $send_email = Email::factory('Review from  Anonymous user')
                            ->message(View::factory('mails/new_rec_anon', array('user_to' => $user_to->user_detail, 'message' => $recommend->message))->render(), 'text/html')
                            ->to($user_to->email)
                            ->from('noreply@callitme.com', 'Callitme')
                            ->send();
                    } else {
                        $send_email = Email::factory('Review from '.$from->user_detail->first_name .' '.$from->user_detail->last_name)
                            ->message(View::factory('mails/new_recommend_mail', array('user_to' => $user_to->user_detail, 'message' => $recommend->message))->render(), 'text/html')
                            ->to($user_to->email)
                            ->from('noreply@callitme.com', 'Callitme')
                            ->send();
                    }

                }

                Session::instance()->set('success', 'Your review has been successfully sent.');
                $this->request->redirect(url::base()."peoplereview/send_success");
            }
        }
    }

    public function action_send_success() {

          $user = Auth::instance()->get_user();

        $data['relations'] = ORM::factory('recommend_relation')->find_all()->as_array();
        $data['words'] = ORM::factory('recommend_word')->find_all()->as_array();

        if($this->request->param('id')) {
            $data['recommend'] = ORM::factory('recommend', $this->request->param('id'));
        }
        
        if($this->request->query('ask')) {
            $data['user_to'] = ORM::factory('user', array('username' => $this->request->query('ask')));
        }
        
        if($this->request->post('email')) {

            if($user->email === $this->request->post('email')) {
                Session::instance()->set('error', 'You can\'t review yourself.');
                $this->request->redirect(url::base()."peoplereview/send_success");
            }

            $user_to = ORM::factory('user')
                ->where('email', '=',  $this->request->post('email'))
                ->where('not_registered', '=', 0)
                ->find();
            
            if($user_to->id) {
                $data['user_to'] = $user_to;
                
                if($user_to->user_detail->sex) {
                    $data['relations'] = ORM::factory('recommend_relation')
                    ->where('gender', '=', $user_to->user_detail->sex)
                    ->or_where('gender', '=', '')
                    ->find_all()
                    ->as_array();
                }
            }

        }

        if(!$this->request->is_ajax()) {
            $this->template->title = $user->user_detail->first_name .' '.$user->user_detail->last_name;
            $this->template->sidemenu=   View::factory('recommend/menu', array('submenu' => ''));
            $this->template->content = View::factory('recommend/send_success', $data);
        } else {
            $this->auto_render = false;
            echo View::factory('recommend/send_success',$data)->render();
        }
    }

    public function action_state() {
        $this->auto_render = false;
        if($this->request->post()) {
            $user = Auth::instance()->get_user();

            $recommend = ORM::factory('recommend', $this->request->post('recommend'));
            
            if($recommend->recommend_to->id == $user->id) {
                $r_previous = $recommend->state;
                $recommend->values(array('state' => $this->request->post('state')));
                $recommend->save();
                
                if($this->request->post('state') === 'approve' && ($r_previous === 'pending' || $r_previous === 'decline')) {
                    $this->post = new Model_Post;
                    $str = $recommend->recommend_to->user_detail->first_name." is ".$recommend->owner->user_detail->first_name."'s ".$recommend->relation;
                    $post = $this->post->new_post('recommend', $str.".\n".$recommend->message, " is reviewed by @".$recommend->owner->username , $recommend->recommend_to->id);

                    $this->activity = new Model_Activity;
                    $this->activity->new_activity('recommend', " is reviewed by @".$recommend->owner->username, $post->id, '', $recommend->recommend_to->id);
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

                echo $r_previous.$this->request->post('state');
            }
        }
    }

    public function action_askreview() {
        $user = Auth::instance()->get_user();
        $data = array();

        if($this->request->query('ask')) {
            $data['user_to'] = ORM::factory('user', array('username' => $this->request->query('ask')));
        }

        if($this->request->post()) {
            $post_data = $this->request->post();

            if(empty($post_data['email'])) {
                session::instance()->set('error-email', "Please enter a valid email address or select any registered member.");
                $this->request->redirect(url::base()."peoplereview/askreview");
            }

            if($user->email === $this->request->post('email')) {
                Session::instance()->set('error', 'You can\'t ask for a review from yourself.');
            } else {
                $user_to = ORM::factory('user')
                    ->where('email', '=', $this->request->post('email'))
                    ->find();  

                if(!$user_to->id) {
                    $recommendations = $user->recommendations->where('state', '=', 'approve')->order_by('time', 'desc')->find_all()->as_array();

                    $temp_words = array();
                    foreach($recommendations as $recommend) {
                        $words = explode(', ', $recommend->words);
                        $temp_words = array_merge($temp_words, $words);
                    }
                    $tags = array_count_values($temp_words);

                    $user_to = ORM::factory('user')->create_non_registered_user($this->request->post('email'));
                    ORM::factory('invite')->send_invite($user, $user_to, $tags);
                }

                if(ORM::factory('recommend')->where('to', '=', $user->id)->where('from', '=', $user_to->id)->count_all()) {
                    $msg = $user_to->first_name ." ".$user_to->last_name ." has already reviewed you once. 
                    ".$user_to->first_name ." cannot review you again.";
                    Session::instance()->set('error', $msg);
                } else {
                    $ask = ORM::factory('recommend_request');
                    $post_data['to'] = $user_to->id;
                    $post_data['from'] = Auth::instance()->get_user()->id;
                    $post_data['message'] = $this->request->post('message');
                    $post_data['time'] = date("Y-m-d H:i:s");
                    $ask->values($post_data);
                    $ask->save();
                    $this->activity = new Model_Activity;
                    $this->activity->new_activity('askreview', ' has requested for a review', $ask->id, $user_to->id);

                    if($user_to->rec_alert) {
                        $from = Auth::instance()->get_user();
                        $send_email = Email::factory('Request to Review from '.$from->user_detail->first_name .' '.$from->user_detail->last_name)
                            ->message(View::factory('mails/recommend_request_mail', array('to' => $user_to))->render(), 'text/html')
                            ->to($user_to->user->email)
                            ->from('noreply@callitme.com', 'Callitme')
                            ->send();
                    }

                    Session::instance()->set('success', 'Your request for review is sent successfully.');
                    $this->request->redirect(url::base()."peoplereview/askreview");
                }
            }
        }

        $this->template->sidemenu = View::factory('recommend/menu', array('submenu' => 'askreview'));
        $this->template->title = $user->user_detail->first_name .' '.$user->user_detail->last_name;
        $this->template->content = View::factory('recommend/ask_for_recommend', $data);
    }

    public function action_recommend_request() {
        $user = Auth::instance()->get_user();

        $data['requests'] = $user->rec_req->order_by('time', 'desc')->find_all()->as_array();
        $this->template->sidemenu = View::factory('recommend/menu', array('submenu' => 'recommend_request'));
        $this->template->title = $user->user_detail->first_name .' '.$user->user_detail->last_name;
        $this->template->content = View::factory('recommend/rec_requests', $data);
    }

    public function action_delete_request() {
        $this->auto_render = false;
        if($this->request->post()) {
            $recommend = ORM::factory('recommend_request', $this->request->post('request'));
            if($recommend->to == Auth::instance()->get_user()->id) {
                $recommend->delete();
            }
            echo "deleted";
        }
    }
}
