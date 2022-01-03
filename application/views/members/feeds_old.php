  
    <div class="row">

    <div class="col-sm-12">

        <nav class="navbar navbar-default navbar-xs" role="navigation">

            <!-- Brand and toggle get grouped for better mobile display -->

            <div class="navbar-header visible-xs">

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">

                    <span class="sr-only">Toggle navigation</span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                </button>

                <a class="navbar-brand" href="#"><b>Tiny</b> Navbar</a>

            </div>



            <!-- Collect the nav links, forms, and other content for toggling -->

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav">
                       <li><a href="<?php echo url::base();?>"><i class="glyphicon glyphicon-home"></i> Home</a></li>
                    <li><a href="<?php echo url::base().'activity';?>"><i class="demo-icon icon-user-add"></i> Requests</a></li>

                    <li><a href="<?php echo url::base().'friends';?>"><i class="demo-icon icon-users"></i> Friends</a></li>
                     <li><a href="<?php echo url::base().'messages';?>"><i class="fa fa-envelope"></i> Message</a></li>

                    <li><a href="<?php echo url::base().'peoplereview'?>"><i class="demo-icon icon-edit"></i> Review</a></li>

                    <li><a href="<?php echo url::base().'localpeople'?>"><i class="demo-icon icon-street-view"></i> Around</a></li>

                    <li><a href="<?php echo url::base().'upgrade'?>"><i class="demo-icon icon-up-circled2"></i> Upgrade</a></li>

                </ul>

            </div><!-- /.navbar-collapse -->

        </nav>

    </div>

</div>

<hr>

<div class="row marTop10">



    <div class="col-sm-8">



        <?php $session_user = Auth::instance()->get_user(); ?>

        <input type="hidden" value="home" id="page_name" />



        <div class="main-content-up-block">

            <div class="feeds-post primary-bg">

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

                <div style="padding:5px;margin-top:10px;margin-bottom:50px;display:none;" class="alert alert-danger col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4" 

                     role="alert" id="loading">

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

    <div class="col-sm-4">

        <?php echo View::factory('templates/rightsidemenu', array('friends' => $friends)); ?>

    </div>
</div>

