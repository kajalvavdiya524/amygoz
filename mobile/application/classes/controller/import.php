<?php defined('SYSPATH') or die('No direct script access.');


class Controller_Import extends Controller_Template {

    public $template = 'templates/profile';

    //Load the contact importer page
    public function before() {
        parent::before();
        if(!Auth::instance()->logged_in()) { //if not login redirect to login page
            $this->request->redirect('pages/login');
        } else if( Auth::instance()->get_user()->registration_steps != 'done' && Auth::instance()->get_user()->registration_steps != '6') {
            Auth::instance()->get_user()->check_registration_steps();
        }
        
        require_once Kohana::find_file('classes', 'libs/yahoo_oauth/getreqtok');
        //if request is ajax don't load the template
        if(!$this->request->is_ajax()) {

            $this->template->title = 'See who you know in Callitme by importing your contacts | Callitme';
            $this->template->description = 'Callitme is your personal network where you can match your single friends,
                review people you know, find singles around you and send requests to your crush anonymously.';
            $this->template->header = View::factory('templates/members-header');
            //$this->template->sidemenu = View::factory('templates/sidemenu');
            $this->template->sidemenu = View::factory('import/sidebar');
            $this->template->footer = View::factory('templates/member-footer');
        }

    }

    public function action_index() {
        $user = Auth::instance()->get_user();

        if($user->registration_steps == 6) {
            $this->template = View::factory('templates/pages');
            $this->template->title = 'Final Step | Find your friends in Callitme';
            $this->template->description = 'Callitme is your personal network where you can match your single friends, review people you know, find singles around you and send requests to your crush anonymously.'; //Added by Ash
            $this->template->header = View::factory('templates/header');
            $this->template->footer = View::factory('templates/footer');
            $this->template->content = View::factory('step4');
        } else {
            $this->template->content = View::factory('import/index' );
        }
    }

    public function action_get_list() {
        if($this->request->query('error')) {
            echo $this->request->query('error');
        } else if($this->request->query('code')){
            
            $urltopost = "https://accounts.google.com/o/oauth2/token";
            $datatopost = array(
                'code' => $this->request->query('code'),
                'client_id' => Kohana::$config->load('contact')->get('gmail_client_id'),
                'client_secret' => Kohana::$config->load('contact')->get('gmail_client_secret'),
                'redirect_uri' => Kohana::$config->load('contact')->get('gmail_redirect_uri'),
                'grant_type' => 'authorization_code',
            );
            
            $ch = curl_init ($urltopost);
            curl_setopt ($ch, CURLOPT_POST, true);
            curl_setopt ($ch, CURLOPT_POSTFIELDS, $datatopost);
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
            $returndata = curl_exec ($ch);
            curl_close($ch);
            
            $response =  json_decode($returndata);

            $accesstoken = $response->access_token;
            
            Session::instance()->set('gmail_access_token', $accesstoken);
            $this->request->redirect(url::base()."import/contacts/gmail");
        }

    }

    public function action_contacts() 
            {
        $page = $this->request->param('id');
        
        $contactlist = array();
        $gsess = Session::instance()->get('gmail_access_token');
        $hsess = Session::instance()->get('hotmail_access_token');
        
        if($page == 'gmail' && !empty( $gsess ) ) {
        
            $gmail_access_token = Session::instance()->get('gmail_access_token');
            $url = 'https://www.google.com/m8/feeds/contacts/default/full?max-results=1000&oauth_token='.urlencode($gmail_access_token);

            $xmlresponse =  Text::get_url_contents($url);
    
            $xml =  new SimpleXMLElement($xmlresponse);
            $xml->registerXPathNamespace('gd', 'http://schemas.google.com/g/2005');
            $contacts = $xml->xpath('//gd:email');

            foreach ($contacts as $contact) {

                foreach($contact->attributes() as $key => $val){
                    if ($key == 'address') $contactlist[] =(string) $val;
                }

            }

            $skip_url = url::base().'import/contacts/gmail?invites=true';
        } else if($page == 'hotmail' && !empty( $hsess )) {
        
            $hotmail_access_token = Session::instance()->get('hotmail_access_token');
            $url = 'https://apis.live.net/v5.0/me/contacts?access_token='.$hotmail_access_token.'';
            $xmlresponse =  Text::get_url_contents($url);

            $xml = json_decode($xmlresponse, true);

            foreach($xml['data'] as $emails) {
                if(isset($emails['emails']['personal'])) {
                    $contactlist[] = $emails['emails']['personal'];
                }
            }

            $skip_url = url::base().'import/contacts/hotmail?invites=true';
        } else if($page == 'yahoo' && $this->request->query('oauth_verifier')) {
        
            $consumer_key = Kohana::$config->load('contact')->get('yahoo_customer_key');
            $consumer_secret = Kohana::$config->load('contact')->get('yahoo_customer_secret');
            
            $retarr = get_access_token($consumer_key, $consumer_secret,
                           Session::instance()->get('token'), Session::instance()->get('token_secret'),
                           $this->request->query('oauth_verifier'), false, true, true);

            $response = $retarr[3];

            $yql = call_yql($consumer_key, $consumer_secret,
                   1, urldecode($response['oauth_token']), $response['oauth_token_secret'],
                   false, true);

            if(count($yql) === 3) {
                $response = json_decode($yql[2], true);

                if(isset($response['query']['results']['contact'])) {

                    foreach($response['query']['results']['contact'] as $contacts) {

                        if(isset($contacts['fields']['type']) && $contacts['fields']['type'] == 'email') {
                            $contactlist[] = $contacts['fields']['value'];
                        }

                    }

                }
            }

            $skip_url = url::base().'import/contacts/yahoo?oauth_verifier='.$this->request->query('oauth_verifier').'&invites=true';
        } else {
            $this->request->redirect(url::base()."import");
        }

        $user = Auth::instance()->get_user();

        $contactlist = array_diff($contactlist, array($user->email));

        if(!empty($contactlist)) 
            {
            
            $already = ORM::factory('user')
                    ->where('email', 'IN', $contactlist)
                    ->where('not_registered', '=', 0)
                    ->find_all()->as_array();
            
        } else {
            $already = array();
        }

        $alreadylist = array();

        foreach($already as $c_key => $contacts) {
            $alreadylist[] = $contacts->email;

            if ($user->check_friends($contacts)) {
                unset($already[$c_key]);
            }
             if ($user->check_requests($contacts)) {
                unset($already[$c_key]);
            }
        }

        $data['skip_url'] = $skip_url;
        $data['invites'] = array_diff($contactlist, $alreadylist);
        $data['already'] = $already;
        
        if($this->request->query('invites')) {
            if($user->registration_steps == 6) {
                $this->template = View::factory('templates/pages');
                $this->template->title = 'Step 4 | Find your friends';
                $this->template->description = 'Callitme is your personal network where you can match your single friends,
                review people you know, find singles around you and send requests to your crush anonymously.'; //Added by Ash
                $this->template->header = View::factory('templates/header');
                $this->template->footer = View::factory('templates/footer');
                $this->template->content = View::factory('pages_invites', $data);
            } else {
                $this->template->content = View::factory('import/invites', $data);
            }
            
        } else {
            if($user->registration_steps == 6) {
                $this->template = View::factory('templates/pages');
                $this->template->title = 'Step 4 | Find your friends';
                $this->template->description = 'Callitme is your personal network where you can match your single friends,
                review people you know, find singles around you and send requests to your crush anonymously.'; //Added by Ash
                $this->template->header = View::factory('templates/header');
                $this->template->footer = View::factory('templates/footer');
                $this->template->content = View::factory('pages_contacts', $data);
            } else {
                $this->template->content = View::factory('import/contacts', $data);
            }
            
        }

    }
    
    public function action_send_requests() {
        if($this->request->post('contacts')) {
            $contacts = $this->request->post('contacts');

            $user = Auth::instance()->get_user();

            foreach($contacts as $contact) {
                $new_contact = ORM::factory('user', array('username' => $contact));

                if (! $user->check_friends($new_contact) && ! $user->check_requests($new_contact)) {
                    $user->add('requests', $new_contact);
                }

            }

            $this->request->redirect($this->request->post('skip_url'));
        }

        $redirect = $this->request->post('skip_url') ? $this->request->post('skip_url') : url::base()."import";

        $this->request->redirect($redirect);
    }

    public function action_send_invites() 
            {
        if($this->request->post('contacts')) {
            $contacts = $this->request->post('contacts');

            $user = Auth::instance()->get_user();

            $bulk = ORM::factory('invite_bulk', array('user_id' => $user->id));
            if($bulk->id) {
                $existing = unserialize($bulk->emails);
                $contacts = array_unique(array_merge($existing, $contacts));
            } else {
                $bulk = ORM::factory('invite_bulk');
                $bulk->user_id = $user->id;
            }

            $bulk->created = date('Y-m-d H:i:s');
            $bulk->emails = serialize($contacts);
            $bulk->save();

            if($user->registration_steps == 6) {
                $this->request->redirect(url::base()."pages/skip_step");
            } else {
                $this->request->redirect(url::base()."import");
            }
        }

        $this->request->redirect(url::base()."import");
    }

    public function action_get_yahoo_list() {
        $consumer_key = Kohana::$config->load('contact')->get('yahoo_customer_key');
        $consumer_secret = Kohana::$config->load('contact')->get('yahoo_customer_secret');

        $callback = 'http://www.callitme.com/import/contacts/yahoo';

        $returndata = get_request_token($consumer_key, $consumer_secret, $callback, true, true, $passOAuthInHeader=false);

        $response = $returndata[3];
        Session::instance()->set('token_secret', $response['oauth_token_secret']);
        Session::instance()->set('token', $response['oauth_token']);
        $this->request->redirect(urldecode($response['xoauth_request_auth_url']));
    }

    public function action_apiget_hotmail() {
        $client_id = Kohana::$config->load('contact')->get('hotmail_client_id');
        $client_secret = Kohana::$config->load('contact')->get('hotmail_client_secret');
        $redirect_uri = Kohana::$config->load('contact')->get('hotmail_redirect_uri');

        $auth_code = $_GET['code'];

        $fields=array(
            'code'=>  urlencode($auth_code),
            'client_id'=>  urlencode($client_id),
            'client_secret'=>  urlencode($client_secret),
            'redirect_uri'=>  urlencode($redirect_uri),
            'grant_type'=>  urlencode('authorization_code'),
            'scope'=>'wl.signin%20wl.basic%20wl.emails%20wl.contacts_emails'
        );

        $post = '';
        foreach($fields as $key=>$value) {
            $post .= $key.'='.$value.'&'; 
        }

        $post = rtrim($post,'&');

        $curl = curl_init();
        curl_setopt($curl,CURLOPT_URL,'https://login.live.com/oauth20_token.srf');
        curl_setopt($curl,CURLOPT_POST,5);
        curl_setopt($curl,CURLOPT_POSTFIELDS,$post);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
        $result = curl_exec($curl);
        curl_close($curl);

        $response =  json_decode($result);

        if(!isset($response->error)) {
            $accesstoken = $response->access_token;
            Session::instance()->set('hotmail_access_token', $accesstoken);
            $this->request->redirect(url::base()."import/contacts/hotmail");
        } else {
            Session::instance()->set('main_error', 'Something went wrong please try again later');
            $this->request->redirect(url::base()."import");
        }
    }

    public function action_invite() {
        if($this->request->post()) {
           $emails = $this->request->post('email');
           $emails = explode(';', $emails);
                   

           $user = Auth::instance()->get_user();
           $already = array();

           $recommendations = $user->recommendations->where('state', '=', 'approve')->order_by('time', 'desc')->find_all()->as_array();

           $temp_words = array();
            foreach($recommendations as $recommend) {
                $words = explode(', ', $recommend->words);
                $temp_words = array_merge($temp_words, $words);
            }
            $tags = array_count_values($temp_words);

            foreach($emails as $email)
            {
                if(!empty($email)){
                $user_to = ORM::factory('user', array('email' => trim($email)));

                if($user_to->id && $user_to->not_registered == 0) {
                    $already[] = $user_to->id;
                } else {

                    if(!$user_to->id) {
                        $user_to = ORM::factory('user')->create_non_registered_user(trim($email));
                    }

                    ORM::factory('invite')->send_invite($user, $user_to, $tags);
                }
                }
            }

            if(count($already) !== count($emails)) {
                Session::instance()->set('success', "Invitation sent successfully.");
            }

            if(!empty($already)) {
                Session::instance()->set('already', $already);
            }
        }

        $this->request->redirect(url::base()."import");
    }
}