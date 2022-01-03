<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
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
        ->limit(10)
        ->find_all()
        ->as_array();
?>

<div class="row bg-pad-tg">
    <div class="col-sm-12">
        <div class="">
            <div class="text-center">
               <h4> View More Profiles </h4>   
            </div>

            <div class="list-group" id="contact-list">
                <?php
                foreach ($userss as $friend) {
                    ?>

                    <?php
                    $recommendations = $friend->recommendations->where('state', '=', 'approve')->order_by('time', 'desc')->find_all()->as_array();

                    $temp_words = array();
                    foreach ($recommendations as $recommend) {
                        $words = explode(', ', $recommend->words);
                        $temp_words = array_merge($temp_words, $words);
                    }
                    $tags = array_count_values($temp_words);
                    ?>
                    <div class="pad-all-1">
                        <div class="col-xs-3">
                           <div class="fileinput-preview" id="imagePreview">
                        <center>
                                <?php if ($friend->photo->profile_pic_s) { ?>
                                    <img src="<?php echo url::base() . "upload/" . $friend->photo->profile_pic_s; ?>" alt="<?php echo $friend->user_detail->first_name . " " . $friend->user_detail->last_name; ?>" class="img-responsive">
                                <?php } else { ?>
                                    <div id="inset" class="xs noMar" style="margin-top: 0px;">
                                        <h1>
                                            <?php echo $friend->user_detail->first_name[0] . $friend->user_detail->last_name[0]; ?>
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
                            <a href="<?php echo url::base() . $friend->username; ?>" style="color: #fff;"><?php echo $friend->user_detail->first_name . " " . $friend->user_detail->last_name; ?>
                                
                            </a>
                            </strong>
                            </span>
                            <br/>
                            <span>
                                 <?php echo implode(', ', $friend->user_detail->list_attributes()); ?>
                            </span>
                        </div>
                        <div class="col-xs-2">
                            <div class="row">
                                <?php echo View::factory('members/friend_button', array('user' => $friend, 'block' => false)); ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                <?php } ?>
            </div>
        </div>
    </div>
</div>