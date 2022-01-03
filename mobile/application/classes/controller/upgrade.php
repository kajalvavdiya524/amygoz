<?php defined('SYSPATH') or die('No direct script access.');

// this is the controller for Upgrade page

class Controller_Upgrade extends Controller_Template {

    public $template = 'templates/profile';
    
    public function before() 
    {
        parent::before();
        if(!Auth::instance()->logged_in()) { //if not login redirect to login page
            $this->request->redirect('pages/login');
        } else if( Auth::instance()->get_user()->registration_steps != 'done') {
            Auth::instance()->get_user()->check_registration_steps();
        }
        
        require_once Kohana::find_file('classes', 'libs/stripe-php/lib/Stripe');

        Auth::instance()->get_user()->check_plan_validity();
        //if request is ajax don't load the template
        if(!$this->request->is_ajax()) {

            $this->template->title = 'Build your social personality profile with Callitme | Upgrade';
            $this->template->description = 'Callitme is a crowd profiling network to review people.';
            $this->template->header = View::factory('templates/members-header');
            $this->template->sidemenu = '';//View::factory('templates/sidemenu', array('side_menu' => 'upgrade'));
            $this->template->footer = View::factory('templates/member-footer');
        }

    }

    public function action_index() {
        $user = Auth::instance()->get_user();
        $data['recommends'] = $user->recommendations->find_all()->as_array();
        
        $this->template->title = $user->user_detail->first_name .' '.$user->user_detail->last_name ." | Callitme";
        $this->template->content = View::factory('upgrade/index', $data);
    }

    public function action_pay() {
        $user = Auth::instance()->get_user();

        if($this->request->post()) {
            
            try { // Use Stripe's bindings... 
                
                $available_plans = Kohana::$config->load('stripe')->get('plans');
                $plan_name = $this->request->post('plan_name');

                if(!in_array($plan_name, $available_plans)) {
                    $this->request->redirect(url::base().'upgrade');
                }

                $plan = Kohana::$config->load('stripe')->get($plan_name);
                Stripe::setApiKey(Kohana::$config->load('stripe')->get('secret_key'));

                $charge = Stripe_Charge::create(array(
                    "amount" => $plan['cents'], // amount in cents, again
                    "currency" => "usd",
                    "card" => $this->request->post('stripeToken'),
                    "description" => "payinguser@example.com")
                );

                $user = Auth::instance()->get_user();

                $next_plan = false;
                if($user->plan->plan_expires > date("Y-m-d H:i:s") && $user->plan->name != 'free') {
                    $payment_expires = date("Y-m-d H:i:s",
                        mktime(23, 59, 59, date("m", strtotime($user->plan->plan_expires))+1,
                            date("d", strtotime($user->plan->plan_expires)),
                            date("Y", strtotime($user->plan->plan_expires))
                        )
                    );
                    $next_plan = true;
                } else {
                    $payment_expires = date("Y-m-d H:i:s", mktime(23, 59, 59, date("m")+1  , date("d")-1, date("Y")));
                    //$user->payment_expires = $payment_expires;
                    
                    if(!$user->plan->id) {
                        $user_plan = ORM::factory('user_plan');
                        $user_plan->user_id = $user->id;
                    } else {
                        $user_plan = $user->plan;
                    }

                    $user_plan->name                    = $plan_name;
                    $user_plan->plan_expires            = $payment_expires;
                    $user_plan->r_to_friend             = $plan['r_to_friend'];
                    $user_plan->r_to_anyone             = $plan['r_to_anyone'];
                    $user_plan->m_to_anyone             = $plan['m_to_anyone'];
                    $user_plan->r_to_friend_used        = 0;
                    $user_plan->r_to_anyone_used        = 0;
                    $user_plan->m_to_anyone_used        = 0;
                    $user_plan->save();
                }

                $payment = ORM::factory('payment');
                $payment->user_id = $user->id;
                $payment->plan = $plan_name;
                $payment->price = $plan['cents'];
                $payment->payment_date = date("Y-m-d H:i:s");
                $payment->payment_expires = $payment_expires;
                $payment->save();

                if($next_plan) {
                    $user->next_plan = $payment->id;
                }
                $user->last_payment = date("Y-m-d H:i:s");
                $user->save();

                Session::instance()->set('success', 'Subscription updated successfully');
                
                if(Session::instance()->get('redirect_url')) {
                    $this->request->redirect(url::base().Session::instance()->get_once('redirect_url'));
                } else {
                    $this->request->redirect(url::base().'profile/subscription_details');
                }
                
            } catch(Stripe_CardError $e) {
                // Since it's a decline, Stripe_CardError will be caught
                $body = $e->getJsonBody();
                $err = $body['error'];
                Session::instance()->set('error', $err['message']);
            } catch (Stripe_InvalidRequestError $e) {
                // Invalid parameters were supplied to Stripe's API 
                $body = $e->getJsonBody();
                $err = $body['error'];
                Session::instance()->set('error', $err['message']);
            } catch (Stripe_AuthenticationError $e) { 
                // Authentication with Stripe's API failed // (maybe you changed API keys recently) 
                $body = $e->getJsonBody();
                $err = $body['error'];
                Session::instance()->set('error', $err['message']);
            } catch (Stripe_ApiConnectionError $e) {
                // Network communication with Stripe failed 
                $body = $e->getJsonBody();
                $err = $body['error'];
                Session::instance()->set('error', $err['message']);
            } catch (Stripe_Error $e) {
                // Display a very generic error to the user, and maybe send // yourself an email 
                $body = $e->getJsonBody();
                $err = $body['error'];
                Session::instance()->set('error', $err['message']);
            } catch (Exception $e) {
                // Something else happened, completely unrelated to Stripe
                Session::instance()->set('error', $e);
            }

            $this->request->redirect(url::base().'upgrade');
        } else {
            $plan = $this->request->param('id');
            $data['plan_name'] = $plan;
            $plan = Kohana::$config->load('stripe')->get($plan);

            $data['plan'] = $plan;
            $this->auto_render = false;
            echo View::factory('upgrade/pay_form', $data);
        }

    }

}
