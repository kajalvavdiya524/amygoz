<style>
#imagePreview {
    width: 50px;
    height: 50px;
    background-position: center center;
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
    margin-top: 3px;
    position: relative;top: -7px;right: 6px;overflow: hidden; background-color: white;
}
.pad-all-1
{
    padding: 20px 0px 7px 0px;
}
.bg-pad-tg
{
    background: #12a6bb;
    color: #fff;
    border-top: 1px solid #fff;
}
</style>

<?php $session_user = Auth::instance()->get_user(); ?>
<?php
         $userss = ORM::factory('user')->with('user_detail')
                ->where('sex', '=', (($session_user->user_detail->sex == 'Male') ? 'Female' : 'Male'))
                ->where('is_deleted', '=', 0)
                ->where('is_blocked','=',0)
                ->where('profile_private','=',0)
                ->and_where('profile_public', '=', '0')
                ->order_by(DB::expr('RAND()'))
                ->limit(10)
                ->find_all()
                ->as_array();
?>
<div class="row bg-pad-tg">
    <div class="row" style="margin: 0px;">
        <div class="col-sm-12">
            <div class="text-center">
                <h4 style="font-size: 19px;font-weight: 500;position: relative;left: 8px;">Profiles to Check Out</h4> 
            </div>
            <div class="list-group" id="contact-list">
                <?php
                    foreach($userss as $friend)
                {?>
                 <?php 
                  $recommendations = $friend->recommendations->where('state', '=', 'approve')->order_by('time', 'desc')->find_all()->as_array();
                $temp_words = array();
                foreach($recommendations as $recommend) {
                    $words = explode(', ', $recommend->words);
                    $temp_words = array_merge($temp_words, $words);
                }
                $tags = array_count_values($temp_words);
                 ?>
            <div class="pad-all-1">
                <div class="col-xs-3">
              <center>
                    <div id="imagePreview"> 

                        <?php if($friend->photo->profile_pic_s) { ?>
                        <img src="<?php echo url::base()."upload/".$friend->photo->profile_pic;?>" alt="<?php echo $friend->user_detail->first_name." ".$friend->user_detail->last_name; ?>" height="100%">
                        <?php } else { ?>
                            <div id="inset" class="xs noMar" style="margin-top: 0px;">
                                <h1 style="margin-left: 8px;">
                                    <?php echo $friend->user_detail->get_no_image_name();?>
                                </h1>
                                <!--<span><a href=""><i class="fa fa-question-circle"></i> ask photo</a></span>-->
                            </div>
                        <?php } ?>
                    </div>
              </center>
                </div>
                <div class="col-xs-7" style="margin-top: -8px;">
                    <span class="name">
                    <strong>
                    <a href="<?php echo url::base().$friend->username; ?>" style="color: #fff;"><?php echo $friend->user_detail->first_name." ".$friend->user_detail->last_name; ?>
                    </a>
                    </span>
                    </strong>
                    <br/>
                    <span>
                        <?php
                            $details = array();
                            if(!empty($friend->user_detail->sex)) {
                                $details[] = $friend->user_detail->sex;
                            }
                            if(!empty($friend->user_detail->phase_of_life)) {
                                $phase_of_life = Kohana::$config->load('profile')->get('phase_of_life');
                                $details[] = $phase_of_life[$friend->user_detail->phase_of_life];
                            }
                            echo implode(', ', $details);
                        ?>
                    </span>
                    <br>
                    <span style="color:#fff;">
                    <strong> Social % <?php echo $friend->calculate_social_percentage($tags);?>
                    </strong>
                    </span>
                </div>
                    <div class="col-xs-2">
                        <div class="row">
                            <?php echo View::factory('members/friend_button', array('user' => $friend, 'block' => false)); ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>