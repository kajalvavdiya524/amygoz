<style>
.web-slizing {
    font-size: 25px;
    width: 18px;
}

.frm-ctrl
{
    background-color: #fff;
    border:none;
    box-shadow: none;
}
.cem-shad
{
    color: #868181;
    font-size: 26px;
   /* margin-left: 115px;*/
}
.post-feed
{
    background: #fff;
margin-top: 1px;
padding-top: 14px;
}
.img-rect
{
    position: absolute;
    color: black;
}

.list-group-item {
    position: relative;
    display: block;
    padding: 5px 0px;
    margin-bottom: -1px;
    background-color: #ffffff;
    border: none;
}

#imagewrapeer {
    width: 35px;
    height: 35px;
    background-position: center center;
    background-size: cover;
    -webkit-box-shadow:none;
    display: inline-block;
    margin-top: 3px;
    position: relative;
    top: 0px;
    right: 8px;
    overflow: hidden;
    border:none;
    background-color: white;
    border-radius: 50%;
}

.img-frame{
  width:40px;
  height: 40px;
  image-orientation:none;
  border: none;
  box-shadow: none;
}


.gallery {
    display: flex;
    flex-wrap: wrap;
    margin: -1rem -1rem;
    padding-bottom: 3rem;
}

.gallery-item {
    position: relative;
    flex: 1 0 22rem;
    margin: 0.2rem;
    color: #fff;
    cursor: pointer;
}

.gallery-item:hover .gallery-item-info,
.gallery-item:focus .gallery-item-info {
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.3);
}

.gallery-item-info {
    display: none;
}

.gallery-item-info li {
    display: inline-block;
    font-size: 1.7rem;
    font-weight: 600;
}

.gallery-item-likes {
    margin-right: 2.2rem;
}

.gallery-item-type {
    position: absolute;
    top: 1rem;
    right: 1rem;
    font-size: 2.5rem;
    text-shadow: 0.2rem 0.2rem 0.2rem rgba(0, 0, 0, 0.1);
}

.fa-clone,
.fa-comment {
    transform: rotateY(180deg);
}

.gallery-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    max-height: 128px;
}

.gallery-imager {
    width: 100%;
    height: auto;
    object-fit: cover;
    max-height: 128px;
}
#imagerather{
    border-radius: 50%;
    border:2px solid #f06163;
}

#imagewrapeer{
    border:2px solid #f06163;
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
                ->order_by(DB::expr('RAND()'))
                ->limit(3)
                ->find_all()
                ->as_array();
?>

 <script>
                            function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
                        </script>

<script>
    $("#files").change(function() {
  filename = this.files[0].name
  console.log(filename);
});
</script>

<div class="row">
<!--<hr style="margin-top: -11px;margin-bottom: 15px;"/>-->
    <div class="container" style="background: whitesmoke;">
        <?php $session_user = Auth::instance()->get_user(); ?>
        <input type="hidden" value="home" id="page_name" />
        <div class="row post-feed" style="border-bottom: 1px solid rgba(0, 0, 0, 0.06);">
        <div class="col-xs-2">
        <center>
            <div id="imagerather">
             <a href="">
                        <?php if($session_user->photo->profile_pic_s) { ?>
                        <img src="<?php echo url::base()."upload/".$session_user->photo->profile_pic;?>" alt="<?php echo $session_user->user_detail->first_name." ".$session_user->user_detail->last_name; ?>" height="100%" class="gallery-image">
                        <?php } else { ?>
                            <div id="inset" class="xs noMar" style="margin-top: 0px;">
                                <h1>
                                    <?php echo $session_user->user_detail->get_no_image_name();?>
                                </h1>
                                
                            </div>
                        <?php } ?>
                    </a>
            </div>
      </center>
        </div>
        <div class="col-xs-10">
            <div class="feeds-post">
                <form role="form" class="validate-form" action="<?php echo url::base() . "members/add_post" ?>" method="post" enctype="multipart/form-data" style="margin-top: -33px;">
                    <!-- <div class="form-group"> -->
                        <textarea rows="1" class="frm-ctrl form-control" id="add_post" name="post" placeholder="What's going on around you?" style="height: 55px;font-weight: 500;margin-bottom: 14px;border: 1px solid #cbcbcb;border-radius: 40px;padding: 4px 18px;"></textarea>
                    <!-- </div> -->
                    <div class="col-sm-3 col-xs-3">
                        <label for="files" class="btn"><i class="fa fa-camera cem-shad"></i></label>
                        <input id="files" style="visibility:hidden;" type="file" name="picture" placeholder="Select Image" onchange="readURL(this);">
                        </div>
                        <div class="col-sm-6 col-xs-6">
                        <img id="blah" src="" alt="" class="img-frame" />
                    </div>
                    <!--<img src="https://www.callitme.com/mobile-test/img/happiness.png" class="img-responsive img-rect" alt="callitme-happyness">
                     <i class="fa fa-camera cem-shad" aria-hidden="true"></i>-->
                     <div class="col-sm-3 col-xs-3">
                    <button type="submit" class="btn btn-secondary pull-right" style="padding: 7px 23px 7px 23px;position: relative;font-size: 18px;font-weight: 500;border-radius: 7px;">Post
                    </button>
                    </div>
                </form>
            </div>
            </div>
        </div>

<!--     <div id="load"></div>
    <div id="contents"> -->
<div class="row">
    <div class="row" style="margin: 7px 0px;">
        <div class="" style="background: #fff;">
            <div class=""  style="color: black;margin-bottom: 8px;">
                <p style="font-size: 15px;font-weight: 500;position: relative;left: 14px;top:6px;">Profiles to Check Out</p> 
            </div>
            <ul class="list-group" id="contact-list" style="margin-bottom: -7px;">
                <?php
                    foreach($userss as $friend)
                {?>
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
                <div class="col-xs-2">
              <center>
                    <div id="imagewrapeer"> 

                        <?php if($friend->photo->profile_pic_s) { ?>
                        <img src="<?php echo url::base()."upload/".$friend->photo->profile_pic;?>" alt="<?php echo $friend->user_detail->first_name." ".$friend->user_detail->last_name; ?>" height="100%" class="gallery-image">
                        <?php } else { ?>
                            <div id="inset" class="xs noMar" style="margin-top: 0px;">
                                <h1 style="margin-left: -3px;font-size: 17px;margin-top: -3px;">
                                    <?php echo $friend->user_detail->get_no_image_name();?>
                                </h1>
                                <!--<span><a href=""><i class="fa fa-question-circle"></i> ask photo</a></span>-->
                            </div>
                        <?php } ?>
                    </div>
              </center>
                </div>
                <div class="col-xs-8" style="position: relative;left: -19px;">
                    <span class="name">
                    <a href="<?php echo url::base().$friend->username; ?>" style="font-size: 15px;font-weight: 500;color: black;"><?php echo $friend->user_detail->first_name." ".$friend->user_detail->last_name; ?>
                        
                    </a>
                    </span>
                    <br/>
                    <span style="font-size: 13px;font-weight: 500;color: #818181;">
                        <?php echo implode(', ', $friend->user_detail->list_attributes()); ?>
<!--                        <?php
                            $details = array();
                            if(!empty($friend->user_detail->sex)) {
                                $details[] = $friend->user_detail->sex;
                            }
                            
                            echo implode(', ', $details);
                        ?>,

                    <span style="color:#F06163">
                    <strong> Social <?php echo $friend->calculate_social_percentage($tags);?>%</strong></span>
                    </span> -->
                </div>
                    <div class="col-xs-2">
                        <div class="row" style="margin-top: 8px;">
                            <?php echo View::factory('members/friend_button', array('user' => $friend, 'block' => false)); ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </li>
                <?php }?>
            </ul>
            <!--<p class="text-center"><a href="" style="color: #00bcd4;font-size: 15px;font-weight: 500;">See more</a></p>-->
        </div>
    </div>
</div>
   <!--  </div> -->

        <div class="clearfix"></div>
            <div class="posts">
                <?php echo View::factory('members/posts', array('posts' => $posts)); ?>
            </div>
            <div class="posts_header text-center">
                <div style="padding:5px;margin-top:10px;margin-bottom:50px;display:none;" class="alert alert-danger col-xs-10" 
                     role="alert" id="loading">
                    Loading <img src="<?php echo url::base() . "img/loader.gif" ?>"/>
                </div>
            </div>
            <div class="posts_footer" style="text-align: center;">
                <?php if (empty($posts)) { ?>
                    <h4>No posts yet</h4> <br />
                    <a href="<?php echo url::base() . "import" ?>" class="btn btn-primary">Find Friends</a>
                <?php } ?>
            </div>
    </div>
</div>
<script>
/*document.onreadystatechange = function () 
{
  var state = document.readyState
  if (state == 'interactive') {
       document.getElementById('contents').style.visibility="hidden";
  } else if (state == 'complete') {
      setTimeout(function(){
         document.getElementById('interactive');
         document.getElementById('load').style.visibility="hidden";
         document.getElementById('contents').style.visibility="visible";
      },30000);
  }
}*/
</script>