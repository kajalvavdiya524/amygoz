<?php defined('SYSPATH') or die('No direct script access.');

//controller contains all the that does not require login
class Controller_Socialdating extends Controller_Template {

    public $template = 'templates/pages'; //template file

    public function before() {
        parent::before();

        if(!Auth::instance()->logged_in()) {
            $this->template->header = View::factory('templates/header', array('page' => 'index')); //template header
        } else {
            $this->template->header = View::factory('templates/members-header');
        }

        $this->template->title = "World's First Peer-Reviewed Trusted Website for Online Social Dating | Callitme Dating";
        $this->template->description = 'Callitme Dating is a peer reviewed trusted online network to match single friends, find local singles around you and send anonymous dating requests to your crush';
        $this->template->careers_header = View::factory('templates/careers-header');
        $this->template->footer = View::factory('templates/footer');
    }

    public function action_index() {
        $this->template->content = View::factory('socialdating/index');
    }

    

}