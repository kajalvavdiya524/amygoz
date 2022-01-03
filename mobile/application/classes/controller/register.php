<?php defined('SYSPATH') or die('No direct script access.');

//controller contains all the that does not require login
class Controller_Register extends Controller_Template {

    public $template = 'templates/pages'; //template file

    public function before() {
        parent::before();

        if(!Auth::instance()->logged_in()) {
            $this->template->header = View::factory('templates/header', array('page' => 'index')); //template header
        } else {
            $this->template->header = View::factory('templates/members-header');
        }

        $this->template->title = "Register | Amygoz";
        $this->template->description = 'Register in Amygoz to find, meet and chat with your friends';
        $this->template->careers_header = View::factory('templates/careers-header');
        $this->template->footer = View::factory('templates/footer');
    }

    public function action_index() {
        $this->template->content = View::factory('register');
    }

    

}