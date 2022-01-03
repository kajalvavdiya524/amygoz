<?php defined('SYSPATH') or die('No direct script access.');

//controller contains all the that does not require login
class Controller_Careers extends Controller_Template {

    public $template = 'templates/careers'; //template file

    public function before() {
        parent::before();

        if(!Auth::instance()->logged_in()) {
            $this->template->header = View::factory('templates/header', array('page' => 'index')); //template header
        } else {
            $this->template->header = View::factory('templates/members-header');
        }

        $this->template->title = 'Explore career opportunities | Callitme';
        $this->template->description = 'Join Callitme Team to help establish trust online';
        $this->template->careers_header = View::factory('templates/careers-header');
        $this->template->footer = View::factory('templates/footer');
    }

    public function action_index() {
        $this->template->content = View::factory('careers/index');
    }

    public function action_apply() {
        $data['user'] =  Auth::instance()->get_user();

        $jobs = array(
            'College Representative',
            'Mobile App Developer',
            'PHP Developer'
        );

        $job_title = urldecode($this->request->param('id'));

        if(!in_array($job_title, $jobs)) {
            $this->request->redirect(url::base()."careers");
        }

        if($this->request->post()) {
            $array = Validation::factory($_FILES);
            $path = $_FILES['resume']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);

            $array->rule('resume', 'Upload::not_empty');
            $array->rule('resume', 'Upload::type', array(':value', array('doc', 'docx', 'pdf')));
            $array->rule('resume', 'Upload::valid');

            if ($array->check()) {
                $post_data = $this->request->post();
                $filename = $post_data['first_name'].time().'.'.$ext;
                $path = Upload::save($array['resume'], $filename, DOCROOT."resumes/");

                $send_email = Email::factory($job_title)
                    ->message(View::factory('mails/candidate_mail', array('data' => $post_data, 'job_title' => $job_title))->render(), 'text/html')
                    ->to('jobs@callitme.com')
                    ->from('noreply@callitme.com', 'Callitme Jobs')
                    ->attach_file($path)
                    ->send();

                Session::instance()->set('success', 'You have successfully applied. Thank for taking your time to apply.  We will get back to you as soon as we can.');
                $this->request->redirect(url::base()."careers");
            } else {
                Session::instance()->set('error', 'Please upload "doc" or "docx" or "pdf" file only.');
            }

        }

        $data['job_title'] = $job_title;
        $this->template->content = View::factory('careers/apply', $data);
    }

    public function action_login() {
        $job_title = urldecode($this->request->param('id'));
        Session::instance()->set('redirect_to', 'careers/apply/'.urlencode($job_title));

        $this->request->redirect(url::base()."pages/login");
    }

}