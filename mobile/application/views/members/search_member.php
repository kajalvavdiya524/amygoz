<style>
    .top-header i {
        left: .5rem;
    }
    .top-header i+img {
        position: absolute;
        color: #989898;
        display: none;
        top: 10px;
    }
    .pro-img img{
        border-radius: 50%;
        object-fit: cover;
        height: 50px;
        width: 50px;
    }
    .pro-details .pro-title a{
        color: #010101
    }
    .pro-details .pro-insp{
        font-size: 14px
    }
    .cancel {
        display: none;
        position: absolute;
        top: 8px;
        right: 14px;
    }
    .img-gradient {
        background-image: linear-gradient(#FF585D, #FB947F);
        height: 104px;
        width: 108px;
        border-radius: 4px;
        margin-left: auto;
        margin-right: auto;
    }
    .width-100{
        width: 100%
    }
    .user-search-results{
        position: absolute;
        z-index: 1000;
        background: #fff!important;
        width: 100%;
        left: 0;
        height: 100%;
        padding: 20px 15px;
        display: none;
    }
    .row:before, .row:after {
        width:0px;
        height:0px;
    }
</style>

<!--Search Bar -->

<div class="top-header pt-2 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="d-flex flex-between align-center position-relative">
                    <form class="width-100" role="form" method = "post"  action="<?php echo url::base() . 'members/search_results'; ?>">
                        <input type="text" class="form-control top-search" id="search_query" name="first_name" placeholder="Search for a member">
                        <div class="user-search-results"></div>
                    </form>
             
                    <i class='fa fa-search'></i>
                    <img src="https://i.ibb.co/k5L6nJ9/close-Icon.png" class ="close" alt="">

                    <a href class="ml-2 text-danger cancel">cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $session_user = Auth::instance()->get_user();
$username = $session_user->username;

$posts = DB::select('posts.id','posts.user_id','posts.type','posts.gradient_bg','posts.action','posts.post','posts.photo','users.username')
    ->from('posts')
    ->join('users','RIGHT')
    ->on('users.id','=','posts.user_id')
    ->where('posts.type','=','post')
    ->where('posts.post','!=','')
    ->where('posts.is_deleted','=','0')
    ->order_by(DB::expr('RAND()'))
    ->limit(1)
    ->execute()
    ->as_array();

$post_photo = DB::select('posts.id','posts.user_id','posts.type','posts.gradient_bg','posts.action','posts.post','posts.photo','users.username')
    ->from('posts')
    ->join('users','RIGHT')
    ->on('users.id','=','posts.user_id')
    ->where('posts.type','=','post')
    ->where('posts.photo','!=','')
    ->where('posts.is_deleted','=','0')
    ->order_by(DB::expr('RAND()'))
    ->limit(1)
    ->execute()
    ->as_array();

?>
<?php
    $userss = ORM::factory('user')->with('user_detail')
        ->where('sex', '=', (($session_user->user_detail->sex == 'Male') ? 'Female' : 'Male'))
        ->where('is_deleted', '=', 0)
        ->where('is_blocked', '=', 0)
        ->where('profile_private', '=', 0)
        ->where('profile_public', '=', '0')
        ->where('photo_id', '!=', '0')
        ->order_by(DB::expr('RAND()'))
        //->order_by('id', 'desc')
        ->limit(10)
        ->find_all()
        ->as_array();
?>

<div class="explore">
    <div class="container">
        <h3 class="h3 text-capitalize text-dark mt-3">Explore</h3>
        
        <div class="row no-gutters">
            <div class="col-6 pr-2">
                <?php if(!empty($post_photo)) {
                foreach($post_photo as $photo) { ?>
                    <a href="<?php echo url::base().$photo['username']; ?>" target="_blank"><img src="<?php echo $photo['photo']; ?>"  height="170px"></a>
                    <small><?php echo '@'.$photo['username'];?></small>
                <?php } }?>
            </div> 
        
            <div class="col-6 pl-2">
                <?php if(!empty($posts)) { 
                    foreach($posts as $post) {?>
                        <a href="<?php echo url::base().$post['username']; ?>" target="_blank">
                            <div class="img-gradient w-100 h-170 p-3">
                                <span class="item-text text-white">
                                    <?php echo $post['post']; ?>
                                </span>
                            </div>
                        </a>
                         <small><?php echo '@'.$post['username'];?></small>
                    <?php } 
                } ?>
            </div> 
        </div>
    </div>
            
</div>


<div class="trending-profile">      
    <div class="container">
    <h3 class="h3 text-capitalize text-dark mt-3">Suggestions</h3> 

    <?php foreach($userss as $friend) { ?>
        <?php 
            $photo_image = file_exists("upload/" . $friend->photo->profile_pic_s);
            if(empty($friend->photo->profile_pic_s) || !$photo_image) { 
                continue;
            }
        ?>      

            <div class="d-flex align-items-center py-2 border-bottom">
                <?php if($friend->photo->profile_pic_s) { ?>
                    <div class="pro-img mr-2">
                        <img src="<?php echo url::base()."upload/".$friend->photo->profile_pic;?>" alt="<?php echo $friend->user_detail->get_name(); ?>" class="img-responsive" width="50px" height="50px" />
                    </div>
                <?php } else { ?>
                    <div id="inset" class="xs noMar" style="margin-top: 0px;">
                        <h1 style="margin-left: 8px;">
                            <?php echo $friend->user_detail->get_no_image_name();?>
                        </h1>
                    </div>
                <?php } ?>
    
                <div class="pro-details">
                    <div class="pro-title">
                        <a href="<?php echo url::base().$friend->username; ?>">
                            <?php echo $friend->user_detail->get_name(); ?>
                        </a>
                    </div>
                    <span class="pro-insp text-capitalize">
                        <?php echo implode(', ', $friend->user_detail->list_attributes()); ?>
                    </span>
                </div>

                
            </div>
                
    <?php } ?>
        
</div>

<script type="text/javascript">
    $('.close').on('click',function(){
        $('#search_query').val("")
    })
    $("#search_query").on('input',function(){
        if(!$(this).val() == ''){
            $('.cancel').css('display','block')
            $('.close').css('display','block')
            $('.fa-search').css("display",'none')
        }else{
            $('.cancel').css('display','none')
            $('.close').css('display','none')
            $('.fa-search').css("display",'block')
        }
    });

    $(document).ready(function() {
        var timeout = null;
        var base_url = $('#base_url').val();
        $('#search_query').keyup(function() {
            clearTimeout(timeout);

            var elem = $(this);
            timeout = setTimeout(function() {
                var query = elem.val();
                query = $.trim(query);
                if(query != '') {
                    $.ajax({
                        type: 'get',
                        url: base_url + "members/search",
                        data: 'query='+query,
                        success: function(data) {
                            $('.user-search-results').html(data);
                            $('.user-search-results').show();
                        }
                    });
                } else {
                    $('.user-search-results').hide();
                }
            }, 500);
        });
    });

</script>       