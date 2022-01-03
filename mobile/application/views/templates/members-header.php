<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/fonts/ionicons.eot">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/fonts/ionicons.svg">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/fonts/ionicons.ttf">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/fonts/ionicons.woff">
<?php $session_user = Auth::instance()->get_user(); ?>
<header id="" style="background:#fff;width: 100%;height:46px;box-shadow: 0px 0px 3px black;border-bottom: border-bottom: 1px solid #a8a8a8;;padding-top: 11px;padding-bottom: 40px;">
    <div class="row">
        <div class="container">
            <div class="col-xs-2 text-center">
            <a href="<?php echo url::base(); ?>" style="position: relative;top:-4px;">
            <img class="web-sizing" alt="Amygoz Logo" src="<?php echo url::base() . 'img/amygoz-mobile-logo.png'; ?>" style="width: 35px;"/>
                </a>
            </div>
             
            <div class="col-xs-2 text-center">
                        <a href="<?php echo url::base()."search_member";?>" class="bag-ht bag-ht2 bag-ht3 bag-ht4 bag-ht5"> 
                            <!--<img class="web-sizing img-responsive" alt="Callitme logo" src="<?php// echo url::base() . 'img/search-callitme.png'; ?>" /> -->
                            <img class="web-sizing" alt="Amygoz Logo" src="<?php echo url::base() . 'img/serch.png'; ?>" style="width: 26px;top: 2px;position: relative;"/>
                        </a>
                   </div> 

            <div class="col-xs-2 text-center">
                <a href="<?php echo url::base() . "friends/friends_for_noti"; ?>" class="icon icon_user" id="friend-noti">
                 <!--<img class="web-sizing img-responsive" alt="Callitme logo" src="<?php// echo url::base() . 'img/add-callitme.png'; ?>" />-->  
                    <img class="web-sizing" alt="Callitme logo" src="<?php echo url::base() . 'img/friend-request.png'; ?>" style="top:-1px;width: 32px;"/>
                 <span class="badge not-shad"></span>
                </a>
                    </div>
                    <div class="col-xs-2 text-center">
                        <a href="<?php echo url::base() . "chat"; ?>" class="icon icon_message" id="message-noti">
                           <!--<img class="web-sizing img-responsive" alt="Callitme logo" src="<?php //echo url::base() . 'img/messege-callitme.png'; ?>" />--> 
                           <img class="web-sizing" alt="Callitme logo" src="<?php echo url::base() . 'img/chat.png'; ?>" style="width:30px;top: 0px;"/>
                            <span class="badge not-shad"></span> 
                        </a>
                    </div>
                    <div class="col-xs-2 text-center">
                        <a href="<?php echo url::base() . "activity_notification"; ?>" class="icon icon_notification" id="activity-noti">
                          <!--<img class="web-sizing img-responsive" alt="Callitme logo" src="<?php// echo url::base() . 'img/notification-callitme.png'; ?>" />-->   
                          <img class="web-sizing" alt="Amygoz Logo" src="<?php echo url::base() . 'img/notification.png'; ?>" style="top: 0px;width: 28px;"/>
                          <span class="badge not-shad"></span>
                        </a>
                    </div>
                        <div class="col-xs-2 text-center">
                            <a href="<?php echo url::base() .'navigation'; ?>" >
                                <?php if ($session_user->photo->profile_pic_s) { ?>
                                    <!--<img class="web-sizing img-responsive" alt="Callitme logo" src="<?php// echo url::base() . 'img/menu-callitme.png'; ?>" />-->
                                    <img class="web-sizing" alt="Amygoz Logo" src="<?php echo url::base() . 'img/navigation.png'; ?>" style="top: -4px;width: 34px;"/>
                                <?php } else { ?>
                                <!--<img class="web-sizing img-responsive" alt="Callitme logo" src="<?php// echo url::base() . 'img/menu-callitme.png'; ?>" />-->
                               <img class="web-sizing" alt="Amygoz Logo" src="<?php echo url::base() . 'img/navigation.png'; ?>" style="top: -4px;width: 34px;"/>
                                <?php } ?>
                            </a>
                        </div>
                   </div> 
                <div class="clearfix visible-xs"></div>
            </div>
            <div class="clearfix visible-xs"></div>
        </div>
    </div>
</header>
<script type="text/javascript">
    $('#searchWrapBtn').click(function () {
        $('#searchWrap').slideDown();
    })

    $('#searchWrapBtnClose').click(function () {
        $('#searchWrap').fadeOut();
    })
</script> 
<style>
#imagecorual {
    width: 26px;
    height: 26px;
    background-position: center center;
    background-size: cover;
    border: 1px solid #cccccc;
    margin-top: 7px;
}
.web-sizing{width:22px;position: relative;}
.icn-shad{color: #00bcd4;font-size: 22px;}
.not-shad{background: #ff2a7f !important;position: relative !important;top: -10px;
    right: 10px;border-radius: 3px !important;padding: 2px 3px !important;font-size: 11px !important;}
.img :hover, .img :focus, .img :active{
    /*width: 16.666666666666664%;*/
    color: #089eb1;
}
.img :active{
    /*width: 16.666666666666664%;*/
     color: #089eb1;
}
.img :focus{
   /* width: 16.666666666666664%;*/
     color: #089eb1;
}

</style>       
