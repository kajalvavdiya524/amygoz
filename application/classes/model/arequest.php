<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * custom auth user
 *
 * @package   
 */
class Model_Arequest extends ORM {
    
    protected $_belongs_to = array(
        'owner' => array(
            'model' => 'user',
            'foreign_key' => 'from',
        ),
        'request_to' => array(
            'model' => 'user',
            'foreign_key' => 'to',
        )
    );
    
    protected $_has_many = array(
        'members' => array(
            'model' => 'arequest_member',
            'foreign_key' => 'arequest_id'
        ),
    );
    
    public function fetch_request_members($user, $user_to, $s_friends) {
        $mutual_friends = $user->mutual_friends_by_gender($user_to, $user->user_detail->sex);
        $arequest_people = array();
        $arequest_already = array();

        $arequest_people[] = $user;
        $arequest_already[] = $user->id;

        if(count($mutual_friends) >= 7) {
            $m_keys = array_rand($mutual_friends, 7);

            foreach ($m_keys as $m_key) {
                $arequest_people[] = $mutual_friends[$m_key];
            }

        } else {

            foreach ($mutual_friends as $mutual_friend) {
                $arequest_people[] = $mutual_friend;
                $arequest_already[] = $mutual_friend->id;
            }

            $remaining = 8 - count($arequest_people);
            $r_friends = $user_to->friends_by_gender_ex_mutual($user->user_detail->sex, $arequest_already);

            if(count($r_friends) >= $remaining) {
                $r_keys = array_rand($r_friends, $remaining);

                if($r_keys !== false && $remaining == 1) {
                    $r_keys = array($r_keys);
                }

                foreach ($r_keys as $r_key) {
                    $arequest_people[] = $r_friends[$r_key];
                }

            } else {

                foreach ($r_friends as $r_friend) {
                    $arequest_people[] = $r_friend;
                    $arequest_already[] = $r_friend->id;
                }

                shuffle($s_friends);

                foreach ($s_friends as $s_friend) {
                    if(!in_array($s_friend->id, $arequest_already)) {
                        $arequest_people[] = $s_friend;
                    }

                    if(count($arequest_people) === 8) {
                        break;
                    }
                }

            }

        }

        return $arequest_people;
    }
}