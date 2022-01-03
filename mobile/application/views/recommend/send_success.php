<div class="recommendations-block">
<div class="recommendations-compose marTop20">     
            <div class="alert alert-success">
               <span class="glyphicon glyphicon-ok"></span>
               Your review has been successfully sent.
            </div>      
<p class="text-center"><a class="btn btn-primary" href="<?php echo  url::base()."peoplereview/compose"?>"><strong>write new review</strong></a>
</p></div>
</div>

<?php
  $check_arr=  array();
  $user = Auth::instance()->get_user();
  $user_alreay=ORM::factory('recommend')->where('from', '=', $user->id)->find_all()->as_array();
 $i=0;
 foreach($user_alreay as $al_id)
 {
     $check_arr[$i]=$al_id->to;
     $i++;
     
 }
$userss = ORM::factory('user')->with('user_detail')
            ->where('user.id', 'NOT IN', $check_arr)
            ->where('is_deleted', '=', 0)
            ->limit(8)
            ->order_by(DB::expr('RAND()'))->find_all()->as_array();

?>
<div class="col-xs-12" style="margin-top: 10px;background: #fafafa;">
    <div class="row marTop10">
                <div class="col-sm-12" style="background: #fafafa;">
                    <div class="panel" style="background: #fafafa;">
                        <div class="text-center">
                            <span class="title"><h4 style="color:#000 !important;text-align: center;">Review More People</h4></span>
                            <span class="badge pull-right"></span>
                        </div> 
                        <div class="panel-body" style="background: #fafafa;border: none;">       
                            <div class="container">
                                <div class="row text-center">
                                    <?php foreach ($userss as $item_s) {?>   
                                    <a href="<?php echo url::base()."peoplereview/compose?ask=".$item_s->username; ?>" >
                                        <div class="col-xs-12">
                                            <div class="profile-sidebar" style="margin:0px auto;">
                                                <div class="profile-user" style="margin:0px auto;">
                                                <?php if($item_s->photo->profile_pic_s) { ?>
                                                 <img src="<?php echo url::base()."upload/".$item_s->photo->profile_pic_s;?>"
                                                 alt="<?php echo $item_s->user_detail->first_name." ".$item_s->user_detail->last_name; ?>" >
                                            <?php }
                                                else {?>

                                                    <?php  if(!empty($item_s->user_detail->sex))
                                                    {
                                                        if($item_s->user_detail->sex=='Male' || $item_s->user_detail->sex=='male')
                                                        {?>
                                                            <img src="<?php echo url::base()."upload/avatar5.png";?>" ></img>

                                                        <?php }?>

                                                        <?php  if($item_s->user_detail->sex=='Female' || $item_s->user_detail->sex=='female')
                                                    {?>
                                                        <img src="<?php echo url::base()."upload/avatar2.jpg";?>" ></img>

                                                    <?php }?>

                                                        <?php
                                                    }
                                                } ?>
                                                </div>
                                                <div class="profile-usertitl" style="margin:0px auto;margin-top: -24px;margin-bottom: 20px;">
                                                    <div class="profile-usertitle-name2" style="margin:0px auto;">
                                                        <a href="<?php echo url::base()."peoplereview/compose?ask=".$item_s->username; ?>">
                                                            <?php echo $item_s->user_detail->first_name." ".$item_s->user_detail->last_name; ?>
                                                        </a>   
                                                    </div>
                                                    <div class="profile-usermenu" style="margin:0px auto;">
                                                        <ul class="nav mail">
                                                            <li class="active">
                                                                <span style="margin-left:0px;">
                                                               <?php
                                                                    $details = array();
                                                                    if(!empty($item_s->user_detail->sex)) {
                                                                        $details[] = $item_s->user_detail->sex;
                                                                    }

                                                                    if(!empty($item_s->user_detail->phase_of_life)) {
                                                                        $phase_of_life = Kohana::$config->load('profile')->get('phase_of_life');
                                                                        $details[] = $phase_of_life[$item_s->user_detail->phase_of_life];
                                                                    }

                                                                    echo implode(', ', $details);
                                                                    ?></span>
                                                            </li>
                                                            <li style="margin-left: 10px;"></li>
                                                        </ul>
                                                    </div>
                                                     <div class="profile-usermenu" style="margin:0px auto;">
                                                            <a href="<?php echo url::base()."peoplereview/compose?ask=".$item_s->username; ?>">
                                                                <button type="submit" class="btn btn-block friend-btn btn-secondary">
                                                                   <span class="glyphicon glyphicon-ok"></span> &nbsp;&nbsp;<span class="btn-text">Review </span>
                                                                </button>
                                                           </a>
                                                     </div>   
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <?php } ?>
                                </div>
                            </div>    
                        </div>
                    </div>
        </div>
    </div>
</div>

<style type="text/css">
.src-image {
  display: none;
}

.profile-user {
    height: 178px !important;
    width: 160px !important;
}
.profile-user img:hover {
    transform: scale(1.1);
    transition: ease-in 0.5s;
}
/*.profile-sidebar {
  margin-top: 50px;
}
*/
.profile-user > img {
    height: 148px;
    width: 150px;
    border-radius: 100%;
}


.profile-usertitl {
    margin-top: -22px;
    text-align: center;
    width: 151px;
    height: 75px;
}


    .card {
        overflow: hidden;
        position: relative;
        border: 1px solid #F9F4F4;
        border-radius: 8px;
        text-align: center;
        padding: 0;
        background-color: #00bcd4;
        color: rgb(136, 172, 217);
        height: 200px;
    }

    .card .header-bg {
        /* This stretches the canvas across the entire hero unit */
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 90px;
        border-bottom: 1px #FFF solid;
        /* This positions the canvas under the text */
        z-index: 1;
        background-color: mintcream;
    }
    .card .avatar {
        position: relative;
        margin-top: 15px;
        z-index: 100;
    }

    .card .avatar img {
        width: 100px;
        height: 100px;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%;
        border: 2px solid rgba(0,0,30,0.8);
    }


</style>


<script type="text/javascript">
    $(document).ready(function(){
        $('.dial').each(function () {

            var elm = $(this);
            var color = elm.attr("data-fgColor");
            var perc = elm.attr("value");

            elm.knob({
                'value': 0,
                'min':0,
                'max':100,
                "skin":"tron",
                "readOnly":true,
                "thickness":.1,
                "dynamicDraw": true,
                "displayInput":false
            });

            $({value: 0}).animate({ value: perc }, {
                duration: 1000,
                easing: 'swing',
                progress: function () {
                    elm.val(Math.ceil(this.value)).trigger('change')
                }
            });

            //circular progress bar color
            $(this).append(function() {
                elm.parent().parent().find('.circular-bar-content').css('color',color);
                elm.parent().parent().find('.circular-bar-content label').text(perc+'%');
            });

        });

    });
</script>