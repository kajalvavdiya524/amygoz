<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * custom auth user
 *
 * @package   
 */
class Model_Invite extends ORM {
    
    protected $_belongs_to = array(
        'by' => array(
            'model' => 'user',
            'foreign_key' => 'user_id',
        ),
        'to' => array(
            'model' => 'user',
            'foreign_key' => 'invitee_id',
        )
    );

    public function send_invite($user, $user_to, $tags, $mail = true) {
        try {
            $invite = ORM::factory('invite');
            $invite->user_id = $user->id;
            $invite->invitee_id = $user_to->id;
            $invite->invite_date = date('Y-m-d');
            

            if($mail) {
                $invite->mail_send = 1;
            }

            $invite->created = date('Y-m-d H:i:s');
            $invite->save();

        } catch (Database_Exception $e) {}

        if($mail) {
            $data['user'] = $user;
            $data['user_to'] = $user_to;
            $data['tags'] = $tags;
            $data['social'] = $user->calculate_social_percentage($tags);

            $send_email = Email::factory($user->user_detail->get_name()." wants you to join callitme")
                ->message(View::factory('mails/invite_contact_mail', $data)->render(), 'text/html')
                ->to($user_to->email)
                ->from('noreply@callitme.com', 'callitme')
                ->send();
        }
    }

}
