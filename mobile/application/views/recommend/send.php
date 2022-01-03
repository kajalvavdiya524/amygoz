<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="stylesheet" href="<?php echo url::base();?>assets/multiple/css/normalize.css">
<link rel="stylesheet" href="<?php echo url::base();?>assets/multiple/css/stylesheet.css">

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<style>
    .hd-styl {
        color:#131212;
        font-size: 16px;
        font-weight: 500
    }
    .hd-styl-2 {
        color:#131212;
        font-size: 16px;
        font-weight: 500;
        text-align: center;
    }
    .p-styl-1 {
        color: rgba(19, 18, 18, 0.65);
        font-size: 15px;
        font-weight: 500;
    }
    .ft-clr{ color: black;font-size: 15px;font-weight: 400; }
    .pad-me-1{ padding:15px 0px 15px 0px;border-bottom: 1px solid #ededed; }
    .zemox { 
        font-size: 15px;font-weight: 500;position: relative;
        left: 5px;
    }

    .animated {
        -webkit-transition: height 0.2s;
        -moz-transition: height 0.2s;
        transition: height 0.2s;
    }

    .stars {
        margin: 20px 0;
        font-size: 24px;
        color: #d17581;
    }
    
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
<script type="text/javascript">
    (function(e){var t,o={className:"autosizejs",append:"",callback:!1,resizeDelay:10},i='<textarea tabindex="-1" style="position:absolute; top:-999px; left:0; right:auto; bottom:auto; border:0; padding: 0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden; transition:none; -webkit-transition:none; -moz-transition:none;"/>',n=["fontFamily","fontSize","fontWeight","fontStyle","letterSpacing","textTransform","wordSpacing","textIndent"],s=e(i).data("autosize",!0)[0];s.style.lineHeight="99px","99px"===e(s).css("lineHeight")&&n.push("lineHeight"),s.style.lineHeight="",e.fn.autosize=function(i){return this.length?(i=e.extend({},o,i||{}),s.parentNode!==document.body&&e(document.body).append(s),this.each(function(){function o(){var t,o;"getComputedStyle"in window?(t=window.getComputedStyle(u,null),o=u.getBoundingClientRect().width,e.each(["paddingLeft","paddingRight","borderLeftWidth","borderRightWidth"],function(e,i){o-=parseInt(t[i],10)}),s.style.width=o+"px"):s.style.width=Math.max(p.width(),0)+"px"}function a(){var a={};if(t=u,s.className=i.className,d=parseInt(p.css("maxHeight"),10),e.each(n,function(e,t){a[t]=p.css(t)}),e(s).css(a),o(),window.chrome){var r=u.style.width;u.style.width="0px",u.offsetWidth,u.style.width=r}}function r(){var e,n;t!==u?a():o(),s.value=u.value+i.append,s.style.overflowY=u.style.overflowY,n=parseInt(u.style.height,10),s.scrollTop=0,s.scrollTop=9e4,e=s.scrollTop,d&&e>d?(u.style.overflowY="scroll",e=d):(u.style.overflowY="hidden",c>e&&(e=c)),e+=w,n!==e&&(u.style.height=e+"px",f&&i.callback.call(u,u))}function l(){clearTimeout(h),h=setTimeout(function(){var e=p.width();e!==g&&(g=e,r())},parseInt(i.resizeDelay,10))}var d,c,h,u=this,p=e(u),w=0,f=e.isFunction(i.callback),z={height:u.style.height,overflow:u.style.overflow,overflowY:u.style.overflowY,wordWrap:u.style.wordWrap,resize:u.style.resize},g=p.width();p.data("autosize")||(p.data("autosize",!0),("border-box"===p.css("box-sizing")||"border-box"===p.css("-moz-box-sizing")||"border-box"===p.css("-webkit-box-sizing"))&&(w=p.outerHeight()-p.height()),c=Math.max(parseInt(p.css("minHeight"),10)-w||0,p.height()),p.css({overflow:"hidden",overflowY:"hidden",wordWrap:"break-word",resize:"none"===p.css("resize")||"vertical"===p.css("resize")?"none":"horizontal"}),"onpropertychange"in u?"oninput"in u?p.on("input.autosize keyup.autosize",r):p.on("propertychange.autosize",function(){"value"===event.propertyName&&r()}):p.on("input.autosize",r),i.resizeDelay!==!1&&e(window).on("resize.autosize",l),p.on("autosize.resize",r),p.on("autosize.resizeIncludeStyle",function(){t=null,r()}),p.on("autosize.destroy",function(){t=null,clearTimeout(h),e(window).off("resize",l),p.off("autosize").off(".autosize").css(z).removeData("autosize")}),r())})):this}})(window.jQuery||window.$);

    var __slice=[].slice;(function(e,t){var n;n=function(){function t(t,n){var r,i,s,o=this;this.options=e.extend({},this.defaults,n);this.$el=t;s=this.defaults;for(r in s){i=s[r];if(this.$el.data(r)!=null){this.options[r]=this.$el.data(r)}}this.createStars();this.syncRating();this.$el.on("mouseover.starrr","span",function(e){return o.syncRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("mouseout.starrr",function(){return o.syncRating()});this.$el.on("click.starrr","span",function(e){return o.setRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("starrr:change",this.options.change)}t.prototype.defaults={rating:void 0,numStars:5,change:function(e,t){}};t.prototype.createStars=function(){var e,t,n;n=[];for(e=1,t=this.options.numStars;1<=t?e<=t:e>=t;1<=t?e++:e--){n.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"))}return n};t.prototype.setRating=function(e){if(this.options.rating===e){e=void 0}this.options.rating=e;this.syncRating();return this.$el.trigger("starrr:change",e)};t.prototype.syncRating=function(e){var t,n,r,i;e||(e=this.options.rating);if(e){for(t=n=0,i=e-1;0<=i?n<=i:n>=i;t=0<=i?++n:--n){this.$el.find("span").eq(t).removeClass("glyphicon-star-empty").addClass("glyphicon-star")}}if(e&&e<5){for(t=r=e;e<=4?r<=4:r>=4;t=e<=4?++r:--r){this.$el.find("span").eq(t).removeClass("glyphicon-star").addClass("glyphicon-star-empty")}}if(!e){return this.$el.find("span").removeClass("glyphicon-star").addClass("glyphicon-star-empty")}};return t}();return e.fn.extend({starrr:function(){var t,r;r=arguments[0],t=2<=arguments.length?__slice.call(arguments,1):[];return this.each(function(){var i;i=e(this).data("star-rating");if(!i){e(this).data("star-rating",i=new n(e(this),r))}if(typeof r==="string"){return i[r].apply(i,t)}})}})})(window.jQuery,window);$(function(){return $(".starrr").starrr()})

    $(function() {

        $('#new-review').autosize({append: "\n"});

        var reviewBox = $('#post-review-box');
        var newReview = $('#new-review');
        var openReviewBtn = $('#open-review-box');
        var closeReviewBtn = $('#close-review-box');
        var ratingsField = $('#ratings-hidden');

        openReviewBtn.click(function(e) {
            reviewBox.slideDown(400, function() {
                $('#new-review').trigger('autosize.resize');
                newReview.focus();
            });
            openReviewBtn.fadeOut(100);
            closeReviewBtn.show();
        });

        closeReviewBtn.click(function(e) {
            e.preventDefault();
            reviewBox.slideUp(300, function() {
                newReview.focus();
                openReviewBtn.fadeIn(200);
            });
            closeReviewBtn.hide();
        });

        $('.starrr').on('starrr:change', function(e, value){
            ratingsField.val(value);
        });
    });  
</script>

<div class="row" style="position:relative;top: -19px;background: #fff;">
    <div class="col-xs-12" style="padding: 31px 0px 8px 10px;background:#fff;">
        <!-- <div class="">
            <div class="">
                <h4 class="hd-styl text-justify">You can choose to review publicly or anonymously</h4>
                    <hr>
                <h4 class="hd-styl-2">Public Review (recommended)</h4>
                <P class="p-styl-1">The person you are reviewing will know who you are.</P>
                    <hr>
                <h4 class="hd-styl-2">Anonymous Review</h4>
                <p class="p-styl-1">The person you are reviewing would not know who you are</p>

            </div>

        </div>-->
    </div>
    <div class="col-xs-12">
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
        
        <h4 class="ft-clr" style="text-align: center;font-size: 18px;font-weight: 500;">Write a Review</h4>

        <div class="container">
            <form role="form" class="validate-form" method="post" id="reviewForm" action="<?php echo url::base(); ?>peoplereview/send">
                <div class="form-group" style="position:relative;">
                    <?php if(isset($recommend)) {
                            $user_to = ORM::factory('user', $recommend->to);
                        }
                    ?>
                    <input type="text" name="search" id="review-search" class="find_user_autocomplete form-control" placeholder="Enter Name or email address" autocomplete='off' value="<?php echo (isset($user_to) ? $user_to->user_detail->first_name." ".$user_to->user_detail->last_name  : Request::current()->post('search')); ?>" <?php if(isset($user_to)) { ?> disabled="disabled" <?php } ?> />
                    
                    <span class="help-block review-search-error text-danger" style="margin-top:2px;">
                        <small style="font-size:90%;" class="text-danger"><strong><?php echo Session::instance()->get_once('error-email'); ?></strong></small>
                    </span>
                                        
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

                
                <div class="row">
                    <div class="col-xs-12">
                        <div class="text-center">
                            <a class="btn btn-success" href="#reviews-anchor" id="open-review-box" style="width: 100%;background: none;border: 2px solid #00bcd4;color: #00bcd4;font-weight: 700;">Write a Review</a>
                        </div>
                    </div>
                </div>
        
                <div class="row" id="post-review-box" style="display:none;">
                    <div class="col-md-12">
                        <input id="ratings-hidden" name="rating" type="hidden">
                        
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

                        <div class="form-group">
                            <label class="ft-clr" for="exampleInputEmail1" style="font-size: 18px;font-weight: 500;">
                                How  <?php echo isset($user_to) ? $user_to->user_detail->first_name : "is the person"; ?> related to you?:
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
                        
                        <h3 class="ft-clr" style="text-align: center;font-size: 18px;font-weight: 500;">Choose quality of <?php echo isset($user_to) ? $user_to->user_detail->first_name : "the person"; ?></h3>
                        <hr style="margin-top: 9px;margin-bottom: 9px;" />
                        
                        <div class="form-group <?php if(Session::instance()->get('error-words')) { ?>has-error<?php } ?>">
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
                                <option value="Miser">Miser</option>
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
                        </div>
                    
                        <textarea class="required form-control animated" cols="50" id="message" name="message" placeholder="Please describe about this person!" rows="2"><?php echo (isset($recommend) ? $recommend->message : '');?></textarea>
                        
                        <div class="text-right">
                            <div class="stars starrr" data-rating="0"></div>
                            <button type="submit" name="review_type" value="public" class="btn btn-secondary" style="width: 100%;background: none;border: 2px solid #00bcd4;color: #00bcd4;font-weight: 700;">Review Publicly</button>
                            <br/>
                            <button type="submit" name="review_type" value="anonymously" class="btn btn-secondary" style="width: 100%;background: none;border: 2px solid #f06292;color: #f06292;font-weight: 700;margin: 20px 0px 20px 0px;">Review Anonymously</button>
                            
                            <div class="row text-center">
                                <a class="btn btn-danger btn-sm" href="#" id="close-review-box" style="display:none; margin-right: 10px;">
                                <span class="glyphicon glyphicon-remove"></span>Cancel</a>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
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

<script src="<?php echo url::base();?>assets/multiple/dist/js/standalone/selectize.js"></script>
<script src="<?php echo url::base();?>assets/multiple/js/index.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(document).ready(function() {
        
        <?php if(Session::instance()->get_once('open_box')) { ?>
            $('#open-review-box').trigger('click');
        <?php } ?>
        
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
    function isValidEmailAddress(emailAddress) {
        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        return pattern.test(emailAddress);
    };
</script>