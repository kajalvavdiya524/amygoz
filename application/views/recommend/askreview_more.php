
<div class="recommendations-block marTop20">

    <div class="recommendations-compose">
    
        <?php if(Session::instance()->get('error')) {?>
            <div class="alert alert-danger">
               <strong>Error !</strong>
               <?php echo Session::instance()->get_once('error');?>
            </div>
        <?php } ?>
        
        <?php if(Session::instance()->get('success')) {?>
            <div class="alert alert-success">
               <strong>SUCCESS </strong>
               <?php echo Session::instance()->get_once('success');?>
            </div>
        <?php } ?>
        
        <fieldset class="fieldset">
            <legend>Request a Review</legend>
            
            <form role="form" class="validate-form" method="post">
            
                <div class="form-group" style="position:relative;">
                    <label class="control-label" for="email">Name of registered member or email address:</label>
                    <input class="required email find_user form-control" type="text" name="email" autocomplete='off'
                    value="<?php echo (isset($user_to) ? $user_to->email : Request::current()->post('email')); ?>">
                    
                    <div id="message-suggestion" class="registered_users well-sm">

                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label" for="message">Write few lines below to request a review:</label>
                    <textarea class="required form-control" id="message" name="message" placeholder="Remind how good you are so that you get a great review!" rows="6"></textarea>
                </div>
            
                <button type="submit" class="btn btn-secondary">Submit</button>
            </form>
        </fieldset>

    </div>
</div>
<?php
  $check_arr=  array();
  $user = Auth::instance()->get_user();
  $user_alreay=ORM::factory('recommend_requests')->where('from', '=', $user->id)->find_all()->as_array();
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

<div class="row" style="margin-top: 60px;">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading c-list">
                <span class="title">Review More People</span>
                <span class="badge pull-right"></span>
            </div>
            <div class="panel-body">
                <?php foreach ($userss as $item_s) {?>
                    <a href="<?php echo url::base()."peoplereview/compose?ask=".$item_s->username; ?>" >
                        <div class="col-sm-3" style="margin-bottom:5px;">
                            <div class="card">
                                <canvas class="header-bg" width="250" height="70" id="header-blur"></canvas>
                                <div class="avatar">
                                    <?php 
                                    $photo = $item_s->photo->profile_pic_s;
                                    $item_image = file_exists("mobile/upload/" .$photo);
                                    $item_image1 = file_exists("upload/" .$photo);
                                    if(!empty($photo) && $item_image) { ?>
                                        <img src="<?php echo url::base()."mobile/upload/".$item_s->photo->profile_pic_s;?>"
                                             alt="<?php echo $item_s->user_detail->first_name." ".$item_s->user_detail->last_name; ?>" >
                                    <?php }
                                    else if(!empty($photo) && $item_image1) { ?>
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
                                            <img src="<?php echo url::base()."upload/avatar2.png";?>" ></img>

                                        <?php }?>

                                            <?php
                                        }
                                    } ?>
                                </div>
                                <div style="color:white;">
                                    <p ><a href="<?php echo url::base()."peoplereview/compose?ask=".$item_s->username; ?>" style="color:white;">
                                            <?php echo $item_s->user_detail->first_name." ".$item_s->user_detail->last_name; ?>
                                        </a> <br>
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
                                        ?>
                                       <a href="<?php echo url::base()."peoplereview/compose?ask=".$item_s->username; ?>"><button type="submit" class="btn btn-block friend-btn btn-secondary">
                                           <span class="glyphicon glyphicon-ok"></span> &nbsp;&nbsp;<span class="btn-text">Review </span>
                                       </button></a>
                                   </p>

                                </div>
                            </div>
                        </div>
                    </a>
                    <?php
                }?>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    .src-image {
        display: none;
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