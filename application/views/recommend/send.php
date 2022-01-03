<link rel="stylesheet" href="<?php echo url::base();?>assets/multiple/css/normalize.css">
<link rel="stylesheet" href="<?php echo url::base();?>assets/multiple/css/stylesheet.css">
<link rel="stylesheet" href="<?php echo url::base();?>assets/multiple/dist/css/selectize.default.css">

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

<div class="row marTop20">
    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <h4 style="color:#00BCD4 !important;"class="text-justify">You can choose to review publicly or anonymously</h4>
                <h4>Public Review (recommended)</h4>
                <p>The person you are reviewing will know who you are.</p>

                <h4>Anonymous Review</h4>
                <p>The person you are reviewing would not know who you are</p>
            </div>
        </div>

        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- Responsive-Text&Display -->
        <ins class="adsbygoogle"
            style="display:block"
            data-ad-client="ca-pub-7641809175244151"
            data-ad-slot="6765892028"
            data-ad-format="auto"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>

    </div>

    <div class="col-sm-8">
        <?php if(Session::instance()->get('error')) {?>
            <div class="alert alert-danger">
               <span class="glyphicon glyphicon-remove"></span>
               <?php echo Session::instance()->get_once('error');?>
            </div>
        <?php } ?>
        
        <?php if(Session::instance()->get('success')) {?>
            <div class="alert alert-success">
               <span class="glyphicon glyphicon-ok"></span>
               <?php echo Session::instance()->get_once('success');?>
            </div>
        <?php } ?>
        
        <fieldset class="fieldset">
            <legend>Write a Review</legend>
            
            <form role="form" class="validate-form" method="post" id="reviewForm" action="<?php echo url::base(); ?>peoplereview/send">
                <div class="form-group" style="position:relative;">
                    <label class="control-label" for="recommend-email">Name of registered member or email address:</label>
                    <?php if(isset($recommend)) {
                            $user_to = ORM::factory('user', $recommend->to);
                        }
                    ?>

                    <input type="text" name="search" id="review-search" class="find_user_autocomplete form-control required" placeholder="Enter Name" autocomplete='off' value="<?php echo (isset($user_to) ? $user_to->user_detail->first_name." ".$user_to->user_detail->last_name  : Request::current()->post('search')); ?>" <?php if(isset($user_to)) { ?> disabled="disabled" <?php } ?>  />

                    <span class="help-block review-search-error text-danger" style="margin-top:2px;">
                        <small style="font-size:90%;" class="text-danger"><strong><?php echo session::instance()->get_once('error-email'); ?></strong></small>
                    </span>
                </div>
                
                <?php if(isset($recommend)) { ?>
                    <input type="hidden" id="edit_recommend" name="edit_recommend" value="<?php echo $recommend->id; ?>" />
                    <input type="hidden" id="user_email" name="email" value="<?php echo $user_to->email; ?>" />
                <?php } else if(!empty($user_to->email)) { ?>
                    <input type="hidden" id="user_email" name="email" value="<?php echo $user_to->email; ?>" />
                <?php } else { ?>
                    <input type="hidden" id="user_email" name="email" value="" />
                <?php } ?>
                
                <?php if(Request::current()->post('email') && !isset($user_to)) { ?>
                    <div id="not_registered_warning" class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        This email address does not belong to a registered user of Callitme. Please continue below. 
                    </div>
                <?php } ?>
                
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
                    <label class="control-label">
                        How is <?php echo isset($user_to) ? $user_to->user_detail->first_name : "is the person"; ?> related to you?:
                    </label>
                    <select name="relation" class="required form-control">
                        <option value="">Select One</option>
                        
                        <?php foreach($relations as $relation) { ?>
                            <?php if(isset($recommend) && ($relation->name == $recommend->relation)) { ?>
                                <option value="<?php echo $relation->name; ?>" selected="selected">
                                    <?php echo $relation->name; ?>
                                </option>
                            <?php } else { ?>
                                <option value="<?php echo $relation->name; ?>"><?php echo $relation->name; ?></option>
                            <?php } ?>
                        <?php } ?>

                    </select>
                </div>

                
                <div class="form-group <?php if(Session::instance()->get('error-words')) { ?>has-error<?php } ?>">
                    <label class="control-label" for="select-state">
                        Select the words that describe <?php echo isset($user_to) ? $user_to->user_detail->first_name : "the person"; ?>
                    </label>
                    <select id="select-state" name="words[]" multiple class="demo-default selectized required"  placeholder="Enter option separated by comma" required>
                        <option value="Sweet">Sweet</option>
                        <option value="Rude">Rude</option>
                        <option value="Selfish">Selfish</option>
                        <option value="Shy">Shy</option>
                        <option value="Silly">Silly</option>
                        <option value="Materialistic">Materialistic</option>
                        <option value="Social">Social</option>
                        <option value="Honest">Honest</option>
                        <option value="Generous">Generous</option>
                        <option value="Lazy">Lazy</option>
                        <option value="Mean">Mean</option>
                        <option value="Moody">Moody</option>
                        <option value="Courteous">Courteous</option>
                        <option value="Sensitive">Sensitive</option>
                        <option value="Stingy">Stingy</option>
                        <option value="Considerate">Considerate</option>
                        <option value="Affectionate">Affectionate</option>
                        <option value="Ambitious">Ambitious</option>
                        <option value="Bad-tempered">Bad-tempered</option>
                        <option value="Greedy">Greedy</option>
                        <option value="Bossy">Bossy</option>
                        <option value="Charismatic">Charismatic</option>
                        <option value="Courageous">Courageous</option>
                        <option value="Dependable">Dependable</option>
                        <option value="Devious">Devious</option>
                        <option value="Joyful">Joyful</option>
                        <option value="Talkative">Talkative</option>
                        <option value="Sympathetic">Sympathetic</option>
                        <option value="Optimist">Optimist</option>
                        <option value="Pessimist">Pessimist</option>
                        <option value="Dim">Dim</option>
                        <option value="Egotistical">Egotistical</option>
                        <option value="Impulsive">Impulsive</option>
                        <option value="Smart">Smart</option>
                        <option value="Respectful">Respectful</option>
                        <option value="Thoughtful">Thoughtful</option>
                        <option value="Friendly">Friendly</option>
                        <option value="Funny">Funny</option>
                    </select>

                    <?php if(Session::instance()->get('error-words')) { ?>
                        <span class="help-block" style="margin:0px;">
                            <small style="font-size:90%;"><strong><?php echo session::instance()->get_once('error-words'); ?></strong></small>
                        </span>
                    <?php } ?>

                    <small class="text-muted dis-block">Feel free to select whatever you want. This information is confidential and will not be revealed to anyone.</small>
                </div>

                <div class="form-group">
                    <label class="control-label" for="message">Detail review:</label>

                    <textarea class="required form-control" id="message" name="message" rows="6" placeholder="Please describe the person you are reviewing. Example: Good habits, bad habits, your experiences etc."><?php echo (isset($recommend) ? $recommend->message : '');?></textarea>
                </div>
                <button type="submit" name="review_type" value="public" class="btn btn-secondary">Review Publicly</button>
                or
                <button type="submit" name="review_type" value="anonymously" class="btn btn-secondary">Review Anonymously</button>
            </form>
        </fieldset>
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

<script src="<?php echo url::base();?>assets/multiple/dist/js/standalone/selectize.js"></script>
<script src="<?php echo url::base();?>assets/multiple/js/index.js"></script>
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


    $('#select-state').selectize({
        maxItems: 15
    });

</script>