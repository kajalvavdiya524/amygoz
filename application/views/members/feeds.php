<?php $session_user = Auth::instance()->get_user(); ?>
<div class="row">
    <div class="col-sm-4">
        <?php echo View::factory('templates/rightsidemenu', array('friends' => $friends)); ?>
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
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading c-list">
                        Profiles to Check Out  
                    </div>
                    <ul class="list-group" id="contact-list">
                        <?php foreach($userss as $friend) { ?>
                        <?php 
                            $recommendations = $friend->recommendations->where('state', '=', 'approve')->order_by('time', 'desc')->find_all()->as_array();
                            $temp_words = array();
                            foreach($recommendations as $recommend) {
                                $words = explode(', ', $recommend->words);
                                $temp_words = array_merge($temp_words, $words);
                            }
                            $tags = array_count_values($temp_words);
                        ?>
                            <li class="list-group-item">
                                <div class="col-xs-3">
                                    <div class="row picbox1">
                                        <?php 
                                            $photo = $friend->photo->profile_pic_s;
                                            $fri_image = file_exists("mobile/upload/" .$photo);
                                            $fri_image1 = file_exists("upload/" .$photo);
                                            if(!empty($photo) && $fri_image) { ?>
                                                <img src="<?php echo url::base()."mobile/upload/".$friend->photo->profile_pic_s;?>" alt="<?php echo $friend->user_detail->first_name." ".$friend->user_detail->last_name; ?>" style="width:100%;max-height:55px;" class="img-thumbnail">
                                        <?php } else if(!empty($photo) && $fri_image1) { ?>
                                                <img src="<?php echo url::base()."upload/".$friend->photo->profile_pic_s;?>" alt="<?php echo $friend->user_detail->first_name." ".$friend->user_detail->last_name; ?>" style="width:100%;max-height:55px;" class="img-thumbnail">
                                        <?php } else { ?>
                                            <div id="inset" class="xs noMar">
                                                <h1>
                                                    <?php echo $friend->user_detail->get_no_image_name();?>
                                                </h1>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                    
                                <div class="col-xs-7">
                                    <span class="name"><a href="<?php echo url::base().$friend->username; ?>"><?php echo $friend->user_detail->first_name." ".$friend->user_detail->last_name; ?></a></span><br/>
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
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>

        <div style="clear:both"></div>
        <!-- Ash removing the two ad blocks
        <div class="row"> 

            <div class="sidebar-content">
                <a href="https://www.callitme.com/peoplereview">
                    <img src="<?php echo url::base(); ?>images/ads/express-your-love-secretely-callitme-com.png" class="img-responsive center-block"/>
                </a>
            </div>  
            <hr>
            <div class="sidebar-content">
                <a href="http://www.apprit.com" target = "_new">
                    <img src="<?php echo url::base(); ?>images/ads/apprit-website-design-development-washington-dc.png" alt="apprit-website-design-development-washington-dc.png" class="img-responsive center-block" target="_new" />
                </a>
            </div>  
        </div>-->
        <div style="clear:both"></div>
    </div>    

    <div class="col-sm-8">
        <input type="hidden" value="home" id="page_name" />
        <div class="main-content-up-block" style="padding:10px 0px;">
            <div class="feeds-post" style="background-color:white;box-shadow:0 0 0 1px rgba(0,0,0,.1),0 2px 3px rgba(0,0,0,.2);">
                <form role="form" class="validate-form" action="<?php echo url::base() . "members/add_post" ?>" method="post">
                    <div class="form-group">
                        <!-- <label class="control-label" for="add_post">What's on your mind?</label>-->
                        <textarea rows="1" class="required form-control" id="add_post" name="post" placeholder="What's going on around you?"></textarea>
                    </div>
                    <button type="submit" class="btn btn-secondary">Post</button>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="posts">
            <?php echo View::factory('members/posts', array('posts' => $posts)); ?>
        </div>

        <div class="posts_header text-center">
            <div style="padding:5px;margin-top:10px;margin-bottom:50px;display:none;" class="alert alert-danger col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4" role="alert" id="loading">
                Loading <img src="<?php echo url::base() . "img/loader.gif" ?>"/>
            </div>
        </div>

        <div class="posts_footer textCenter">
            <?php if (empty($posts)) { ?>
                <h4>No posts yet</h4> <br />
                <a href="<?php echo url::base() . "import" ?>" class="btn btn-primary">Find Friends</a>
            <?php } ?>
        </div>
    </div>
</div>