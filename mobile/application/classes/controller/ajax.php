<?php defined('SYSPATH') or die('No direct script access.');

//controller contains only ajax functions
class Controller_Ajax extends Controller_Template {

    public $template = 'templates/pages'; //template file

    public function before() {
        parent::before();

        $this->auto_render = false;
    }

    public function action_get_inspire_list() {
        $data = array();

        $username = $this->request->query('public');
        if(!empty($username)) {
            $public_user = ORM::factory('user', array('username' => $username));
            $data['public_user'] = $public_user;

            $users = ORM::factory('inspire')
                ->where('user_id', '=', $public_user->id)
                ->where('status', '=', 1)
                ->find_all()
                ->as_array();

            $data['users'] = $users;
        }
        

        echo View::factory('ajax/inspire_list', $data); // show day form
    }

}