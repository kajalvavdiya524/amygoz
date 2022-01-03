<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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

    #imagePreview {
        width: 112px;
        height: 112px;
        background-position: center center;
        background-size: cover;
        -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
        display: inline-block;
        overflow: hidden; 
        border: 3px solid white; 
        background-color: white; 
        left: 0px;  
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
    .hd-pad-1
    {
        font-size: 16px;
        font-weight: 500;
        text-align: center;
        padding-top: 20px;
    }
    .hd-pad-2
    {
        font-size: 15px;
        font-weight: 500;
    }
    .hd-pad-3
    {
        font-size: 16px;
        font-weight: 500;
    }
    .hd-pad-3
    {
        font-size: 14px;
    }
    .btn-pad
    {
        border-radius: 5px;
        position: relative;
        top: -8px;

    }
    .bg-panel{background: #00bcd4;}
    .btn-bg-1 
    {
        margin: 0px auto;
        background: none;
        border: 0.01em solid white;
        border-radius: 40px;
        color: white;
        letter-spacing: 1px;
    }
    .ft-clr{font-size: 18px;font-weight: 500;color:#fff;}
    
    .ui-menu {
        max-height: 400px;
        overflow-y: scroll;
    }
    .ui-menu .ui-menu-item {
        list-style-image: none !important;
    }
    .ui-autocomplete-loading {
        background: white url("<?php echo url::base(); ?>img/load_er.gif") right center no-repeat;
    }
    
    .post.selected-user {
        background-color: #d9edf7;
        padding: 10px;
        border-color: #bce8f1;
        
    }
    .post.selected-user .xs {
        margin-top: 0px !important;
    }
    .post.selected-user .post-title {
        margin-left: 5px;
        color: #3a87ad !important;
    }
</style>

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
            <h4 class="hd-pad-1">Request a Review</h4>
            <form role="form" class="validate-form" method="post" id="reviewForm">
                <div class="form-group" style="position:relative;">
                    <label class="hd-pad-2" for="first_name"></label>

                    <input type="text" name="first_name" id="review-search" class="find_user_autocomplete form-control required" placeholder="Enter name or email" autocomplete='off' value="<?php echo (isset($user_to) ? $user_to->user_detail->first_name." ".$user_to->user_detail->last_name  : Request::current()->post('first_name')); ?>" <?php if(isset($user_to)) { ?> disabled="disabled" <?php } ?>  style="font-size:14px;"/>

                    <span class="help-block review-search-error text-danger" style="margin-top:2px;">
                        <small style="font-size:90%;" class="text-danger"><strong><?php echo session::instance()->get_once('error-email'); ?></strong></small>
                    </span>
                    
                    <?php if(!empty($user_to->email)) { ?>
                        <input type="hidden" id="user_email" name="email" value="<?php echo $user_to->email; ?>" />
                    <?php } else { ?>
                        <input type="hidden" id="user_email" name="email" value="" />
                    <?php } ?>
                </div>

                <div class="alert alert-info post selected-user" <?php if(empty($user_to->user_detail->first_name)) { ?>style="display:none;"<?php } ?>>
                    <?php 
                        $selected_user_name = '';
                        $selected_user_no_image = '';
                        $img_src = '';
                        $selected_user_location = '';
                        if(!empty($user_to->email)) {
                            $photo = $user_to->photo->profile_pic_s;
                            $user_image_mob = file_exists("mobile/upload/" .$photo);
                            $user_image = file_exists("upload/" .$photo);
                            if(!empty($photo) && $user_image_mob) {
                                $img_src = url::base()."mobile/upload/".$user_to->photo->profile_pic_s; 
                            } else if(!empty($photo) && $user_image) {
                                $img_src = url::base()."upload/".$user_to->photo->profile_pic_s; 
                            }
                            
                            $selected_user_no_image = $user_to->user_detail->get_no_image_name();
                            $selected_user_name = $user_to->user_detail->get_name();
                            
                            if(!empty($user_to->user_detail->location)) {
                                $loc =  $user_to->user_detail->location; 
                                $b   =  explode(', ', $loc);

                                if(!empty($b[0]) && !empty($b[2])) {
                                    $selected_user_location = $b[0].", ".$b[2];
                                } else if(!empty($b[0])) {
                                    $selected_user_location = ucwords($b[0]);
                                } else {
                                    $selected_user_location = ucwords($b[2]);
                                }
                            } else if(!empty($user_to->user_detail->home_town)) { 
                                $selected_user_location = $user_to->user_detail->home_town;
                            } else {
                                $selected_user_location = 'Washington, DC, United States';
                            }
                        }
                    ?>

                    <div class="user-img pull-left">
                        <img src="<?php echo !empty($img_src) ? $img_src : '/'; ?>" <?php if(empty($img_src)) { ?>style="display:none;max-height:49px;"<?php } else { ?>style="max-height:49px;"<?php } ?>>
                        <div class="xs" id="inset" <?php if(!empty($img_src)) { ?>style="display:none;"<?php } ?>>
                            <h1><?php echo $selected_user_no_image; ?></h1>
                        </div>
                    </div>
                    
                    <div class="post-content">
                        <div class="post-title">
                            <strong> <?php echo $selected_user_name; ?> </strong><br />
                            <span> <?php echo $selected_user_location; ?> </span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="form-group">
                    <label class="hd-pad-2" for="message">Write few lines below to request a review:</label>
                    <textarea class="hd-pad-3 required form-control" id="message" name="message" placeholder="Remind how good you are so that you get a great review!" rows="2"></textarea>
                </div>
                <button type="submit" class="btn-pad btn btn-secondary pull-right">Send</button>
            </form>
        </fieldset>
    </div>
</div>

<?php
    $check_arr = array();
    $user = Auth::instance()->get_user();
    $user_alreay = ORM::factory('recommend_request')->where('from', '=', $user->id)->find_all()->as_array();
    $i = 0;
 
    foreach($user_alreay as $al_id) {
        $check_arr[$i]=$al_id->to;
        $i++;
    }

    $userss = ORM::factory('user')->with('user_detail');
    if(count($check_arr)>0) {
        $userss->where('user.id', 'NOT IN', $check_arr);
    }
    $userss->where('sex', '=', $user->user_detail->sex);
    $userss->where('is_deleted', '=', 0);
    $userss->where('profile_private','=',0);
    $userss->and_where('profile_public', '=', '0');
    $userss->limit(8);
    $userss->order_by(DB::expr('RAND()'));
    $userss=$userss->find_all()->as_array();      
?>

<div class="">
    <div class="row marTop10">
        <div class="col-xs-12 bg-panel">
            <div class="">
                <div class="">
                    <span class="badge pull-right"></span>
                </div> 
                <div class="bg-panel panel-body text-center"> 
                    <span class="title"><h4 class="hd-pad-3">Get reviews from more people</h4></span>      
                    <div class="container">
                        <div class="row">
                            <?php foreach ($userss as $item_s) {?>   
                                <a href="<?php echo url::base().$item_s->username; ?>" >
                                    <div class="col-xs-12">
                                        <div class="profile-sidebar" style="margin-bottom: 39px;">
                                            <center>
                                                <div id="imagePreview">
                                                    <?php if($item_s->photo->profile_pic) { ?>
                                                        <img src="<?php echo url::base()."upload/".$item_s->photo->profile_pic;?>" alt="<?php echo $item_s->user_detail->first_name." ".$item_s->user_detail->last_name; ?>" height="100%">
                                                    <?php } else { ?>
                                                        <?php if(!empty($item_s->user_detail->sex)) {
                                                            if($item_s->user_detail->sex=='Male' || $item_s->user_detail->sex=='male') { ?>
                                                                <img src="<?php echo url::base()."upload/avatar5.png";?>"  height="100%"></img>

                                                            <?php } ?>
                                                            <?php if($item_s->user_detail->sex=='Female' || $item_s->user_detail->sex=='female') { ?>
                                                                <img src="<?php echo url::base()."upload/avatar2.jpg";?>" height="100%"></img>
                                                            <?php } ?>
                                                    <?php
                                                            }
                                                        } ?>
                                                </div>
                                            </center>

                                            <div class="row">
                                                <div class="">
                                                    <a class="ft-clr" href="<?php echo url::base().$item_s->username; ?>">
                                                        <?php echo $item_s->user_detail->first_name." ".$item_s->user_detail->last_name; ?>
                                                    </a>
                                                </div>
                                                <div class="profile-usermenu">
                                                    <ul class="nav mail">
                                                        <li class="active">
                                                            <span style="margin-left:0px;color:#fff;">
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
                                                            </span>
                                                        </li>
                                                        <li style="margin-left: 10px;"></li>
                                                    </ul>
                                                </div>

                                                <div class="profile-usermenu">
                                                    <a href="<?php echo url::base()."peoplereview/askreview?ask=".$item_s->username; ?>">
                                                        <button type="submit" class="btn-bg-1 btn">
                                                           <span class="glyphicon glyphicon-ok"></span>&nbsp;<span class="btn-text">Ask for Review </span>
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

<div class="result post suggestion-sample" style="display:none;">
    <div class="user-img pull-left">
        <img style="width:90%; height:90%;" src="">
        <div class="xs" id="inset" style="margin-top:0px;">                           
            <h1></h1>
        </div>
    </div>
    
    <div class="post-content">
        <div class="post-title">
            <strong></strong>
        </div>
        
        <div class="post-matter" style="margin-left:5px;">
            <span></span>, <strong></strong>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(document).ready(function() {
        $('#reviewForm').submit(function() {
            if($(this).valid()) {
                var email = $('#user_email').val();

                if(email == '') {
                    var search = $('#review-search').val();
                    if(!isValidEmailAddress(search)) {
                        var msg = 'The email Id is not valid. Please enter a valid email address or select any registered member';
                        $('.review-search-error strong').html(msg);
                    } else {
                        $('#user_email').val(search);
                        return true;
                    }
                } else {
                    return true;
                }
            }

            return false;
        });

        $(".find_user_autocomplete").autocomplete({
            source: "<?php echo url::base(); ?>members/find_user_json",
            minLength: 2,
            select: function( event, ui ) {
                event.preventDefault();
                $(".find_user_autocomplete").val(ui.item.name);
                $('#user_email').val(ui.item.email);
                
                elem = $('.selected-user');
                
                elem.find('.post-title strong').html(ui.item.name);
                elem.find('.post-title span').html(ui.item.location);

                if(ui.item.image !== '') {
                    elem.find('img').attr('src', ui.item.image);
                    elem.find('img').show();
                    elem.find('.xs').hide();
                } else {
                    elem.find('img').hide();
                    elem.find('.xs h1').html(ui.item.no_image);
                    elem.find('.xs').show();
                }
                elem.show();
                
            },
            response: function(event, ui) {
                $('#user_email').val('');
                elem = $('.selected-user');
                elem.hide();
                elem.find('.post-title strong').html('');
                elem.find('.post-title span').html('');
                elem.find('.xs h1').html('');
                elem.find('.xs').hide();
                elem.find('img').attr('src', '/');
                elem.find('img').hide();
            }
        }).autocomplete( "instance" )._renderItem = function( ul, item ) {
            elem = $('.suggestion-sample').clone();
            elem.removeClass('suggestion-sample');
            elem.show();
            
            elem.find('.post-title strong').html(item.name);
            elem.find('.post-matter span').html(item.location);
            elem.find('.post-matter strong').html("Social "+item.social+" %");

            if(item.image !== '') {
                elem.find('img').attr('src', item.image);
                elem.find('.xs').remove();
            } else {
                elem.find('img').remove();
                elem.find('.xs h1').html(item.no_image);
            }

            return $( "<li>" )
                .append( elem )
                .appendTo(ul);
        };
        
    });

    function isValidEmailAddress(emailAddress) {
        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        return pattern.test(emailAddress);
    };
</script>