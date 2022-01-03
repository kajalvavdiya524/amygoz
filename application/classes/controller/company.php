<?php defined('SYSPATH') or die('No direct script access.');

//controller contains all the that does not require login
class Controller_Company extends Controller_Template {

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
        $this->template->description = "Callitme is world's first peer-reviewed online network";

        require_once Kohana::find_file('classes', 'libs/MCAPI.class');//Added by Ash
    }
    public function action_about() {
        $this->template->title = 'About | Amygoz';
        $this->template->content = View::factory('company/about_us');
    }
    public function action_privacypolicy() {
        $this->template->title = 'Privacy Policy | Amygoz';
        $this->template->content = View::factory('company/privacy_policy');
    }
    public function action_terms() {
        $this->template->title = 'Terms of Use | Amygoz';
        $this->template->content = View::factory('company/terms');
    }
   public function action_support() {
        $this->template->title = 'Support | Amygoz';
        $this->template->content = View::factory('staticpages/support');
    }


}    