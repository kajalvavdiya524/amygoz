<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Error extends Controller_Template
{
    public $template = 'templates/pages'; //template file
    
    /**
     * @var string
     */
    protected $_requested_page;
     
    /**
     * @var string
     */
    protected $_message;

    /**
     * All methods should be internal only, otherwise 404
     */
    public function before()
    {
        parent::before();

        if(!Auth::instance()->logged_in()) {
            $this->template->header = View::factory('templates/header'); //template header
        } else {
            $this->template = View::factory('templates/profile');
            $this->template->header = View::factory('templates/members-header');
            $this->template->sidemenu = View::factory('templates/sidemenu');
        }

        $this->template->title = 'Page not found';
        $this->template->description = 'Page not found';
        $this->template->footer = View::factory('templates/footer'); //template footer

        // Sub requests only!
        if ( ! $this->request->is_initial()) {
            if ($message = rawurldecode($this->request->param('message'))) {
                $this->_message = $message;
            }

            if ($requested_page = rawurldecode($this->request->param('origuri'))) {
                $this->_requested_page = $requested_page;
            }
        } else {
            // This one was directly requested, don't allow
            $this->request->action(404);
            // Set the requested page accordingly
            $this->_requested_page = Arr::get($_SERVER, 'REQUEST_URI');
        }

        $this->response->status((int) $this->request->action());
    }

    public function action_empty() {}

    public function action_404()
    {

        $this->template->title = 'Page not found';
        $this->template->content = View::factory('error/404')
            ->set('error_message', $this->_message)
            ->set('requested_page', $this->_requested_page);


        // Here we check to see if a 404 came from our website. This allows the
        // webmaster to find broken links and update them in a shorter amount of time.
        //if (Request::$initial->referrer() AND strstr(Request::$initial->referrer(), $_SERVER['SERVER_NAME']) !== FALSE)
        //{
        //  // Set a local flag so we can display different messages in our template.
        //  $this->template->local = TRUE;
        //}
    }

    public function action_503()
    {
        $this->response->body('Maintenance Mode');
    }

    public function action_500()
    {
        $this->template->title = 'Page not found';

        $this->template->content = View::factory('error/500')
            ->set('error_message', $this->_message)
            ->set('requested_page', $this->_requested_page);
    }

} // End Controller_Error
