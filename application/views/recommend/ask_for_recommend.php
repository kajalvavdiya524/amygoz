<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<style>
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
            <legend>Request a Review</legend>
            <form role="form" class="validate-form" method="post" id="reviewForm">
                <div class="form-group" style="position:relative;">
                    <label class="control-label" for="first_name">Name of registered member or email address:</label>

                    <input type="text" name="first_name" id="review-search" class="find_user_autocomplete form-control required" placeholder="Enter Name" autocomplete='off' value="<?php echo (isset($user_to) ? $user_to->user_detail->first_name." ".$user_to->user_detail->last_name  : Request::current()->post('first_name')); ?>" <?php if(isset($user_to)) { ?> disabled="disabled" <?php } ?>  />

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
                    <label class="control-label" for="message">Write few lines below to request a review:</label>
                    <textarea class="required form-control" id="message" name="message" placeholder="Remind how good you are so that you get a great review!" rows="6"></textarea>
                </div>
                <button type="submit" class="btn btn-secondary">Submit</button>
            </form>
        </fieldset>
    </div>
</div>

<?php
    $check_arr =  array();
    $user = Auth::instance()->get_user();
    $user_alreay = ORM::factory('recommend_request')->where('from', '=', $user->id)->find_all()->as_array();
    $i=0;

    foreach($user_alreay as $al_id) {
        $check_arr[$i]=$al_id->to;
        $i++;
    }

    $userss = ORM::factory('user')->with('user_detail');
    if(count($check_arr) > 0) {
        $userss->where('user.id', 'NOT IN', $check_arr);
    }

    $userss->where('sex', '=', $user->user_detail->sex);
    $userss->where('is_deleted', '=', 0);
    $userss->where('is_blocked', '=', 0);
    $userss->where('profile_private','=',0);
    $userss->and_where('profile_public', '=', '0');
    $userss->limit(8);
    $userss->order_by(DB::expr('RAND()'));
    $userss=$userss->find_all()->as_array();      
?>

<div class="row" style="margin-top: 60px;">
    <div class="row marTop10">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading c-list">
                    <span class="title">
                        <h5 style="color:#000 !important;">Get reviewed from more people</h5>
                    </span>
                    <span class="badge pull-right"></span>
                </div> 
                <div class="panel-body">       
                    <div class="container">
                        <div class="row">
                            <?php foreach ($userss as $item_s) {?>   
                                <a href="<?php echo url::base().$item_s->username; ?>" >
                                    <div class="col-md-3">
                                        <div class="profile-sidebar">
                                            <div class="profile-user">
                                            <?php 
                                                $photo = $item_s->photo->profile_pic;
                                                $item_image = file_exists("mobile/upload/" .$photo);
                                                $item_image1 = file_exists("upload/" .$photo);
                                                if(!empty($photo) && $item_image) { ?>
                                                    <img src="<?php echo url::base()."mobile/upload/".$item_s->photo->profile_pic;?>" alt="<?php echo $item_s->user_detail->first_name." ".$item_s->user_detail->last_name; ?>" >
                                                <?php } else if(!empty($photo) && $item_image1) { ?>
                                                    <img src="<?php echo url::base()."upload/".$item_s->photo->profile_pic;?>" alt="<?php echo $item_s->user_detail->first_name." ".$item_s->user_detail->last_name; ?>" >
                                                <?php } else { ?>

                                                    <?php if(!empty($item_s->user_detail->sex)) {
                                                        if($item_s->user_detail->sex=='Male' || $item_s->user_detail->sex=='male') { ?>
                                                            <img src="<?php echo url::base()."mobile/upload/avatar5.png";?>" ></img>
                                                        <?php } ?>

                                                        <?php if($item_s->user_detail->sex=='Female' || $item_s->user_detail->sex=='female') { ?>
                                                            <img src="<?php echo url::base()."mobile/upload/avatar2.jpg";?>" ></img>
                                                        <?php } ?>
                                                    <?php }
                                                } ?>
                                            </div>

                                            <div class="profile-usertitl">
                                                <div class="profile-usertitle-name2">
                                                    <a href="<?php echo url::base().$item_s->username; ?>">
                                                        <?php echo $item_s->user_detail->first_name." ".$item_s->user_detail->  last_name; ?>
                                                    </a>   
                                                </div>
                                            
                                                <div class="profile-usermenu">
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
                                                                ?>
                                                            </span>
                                                        </li>
                                                        <li style="margin-left: 10px;"></li>
                                                    </ul>
                                                </div>

                                                <div class="profile-usermenu">
                                                    <a href="<?php echo url::base()."peoplereview/askreview?ask=".$item_s->username; ?>">
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

</script>