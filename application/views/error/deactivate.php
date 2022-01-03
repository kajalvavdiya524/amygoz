<!DOCTYPE html>
<html lang="en">
  	<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Send an Anonymous Request for an Activity | Callitme</title>
        
        <!-- Bootstrap -->
        <link href="<?php echo url::base(); ?>new_assets/css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
        <!-- Include map script -->   
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        
        <style>
            body { background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAaCAYAAACpSkzOAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEgAACxIB0t1+/AAAABZ0RVh0Q3JlYXRpb24gVGltZQAxMC8yOS8xMiKqq3kAAAAcdEVYdFNvZnR3YXJlAEFkb2JlIEZpcmV3b3JrcyBDUzVxteM2AAABHklEQVRIib2Vyw6EIAxFW5idr///Qx9sfG3pLEyJ3tAwi5EmBqRo7vHawiEEERHS6x7MTMxMVv6+z3tPMUYSkfTM/R0fEaG2bbMv+Gc4nZzn+dN4HAcREa3r+hi3bcuu68jLskhVIlW073tWaYlQ9+F9IpqmSfq+fwskhdO/AwmUTJXrOuaRQNeRkOd5lq7rXmS5InmERKoER/QMvUAPlZDHcZRhGN4CSeGY+aHMqgcks5RrHv/eeh455x5KrMq2yHQdibDO6ncG/KZWL7M8xDyS1/MIO0NJqdULLS81X6/X6aR0nqBSJcPeZnlZrzN477NKURn2Nus8sjzmEII0TfMiyxUuxphVWjpJkbx0btUnshRihVv70Bv8ItXq6Asoi/ZiCbU6YgAAAABJRU5ErkJggg==);}
            .error-template {padding: 40px 15px;text-align: center;}
            .error-actions {margin-top:15px;margin-bottom:15px;}
            .error-actions .btn { margin-right:10px; }
        </style>

    </head>

    <?php $item_fix = ORM::factory('user')->with('user_detail')
                 
                            ->where('username', 'IN', array('rosspford','ClaraFelix','LIpKEOSyW9j814','KhkoEc1ppUz877'))
                            ->where('is_deleted', '=', 0)
                            ->and_where('photo_id','!=','')
                            //->and_where('profile_private','=', '1')
                            ->and_where('profile_public','=', '0')
                            //->order_by(DB::expr('RAND()'))
                            ->find_all()
                            ->as_array();
                            ?>

    <body style="padding-top:15%">

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="error-template paddingBottom">
                        <center>
                            <img src="<?php echo url::base(); ?>/img/logo1.png" class="marginVertical" />
                        </center>
                        <h1 style="font-size:300%">
                            Oops!</h1>
                        <h2>
                            Uh Oh, this member is taking a break!</h2>
                        <div class="error-details">
                            Sometimes member takes a break. Please check back once the member is active again!
                        </div>
                        <div class="error-actions">
                            <a href="<?php echo url::base(); ?>" class="btn btn-primary btn-lg">
                                <span class="glyphicon glyphicon-home"></span>
                                Take Me Home </a>
                                
                            <a href="<?php echo url::base(); ?>company/support" class="btn btn-default btn-lg">
                                <span class="glyphicon glyphicon-envelope"></span>
                                Contact Support </a>
                        </div>
                        <br/>
                        <div class="row text-center" style="text-align: center;margin: 0px auto;width: 375px;">
                        <div class="" id="searchWrap">
                <a href="javascript:void(0)" id="searchWrapBtnClose" class="visible-xs"><i class="fa fa-close"></i></a>

                <form action="https://www.callitme.com/members/search_results" method="post">
                    <div class="input-group">
                        <input id="search-query" class="form-control input-sm" name="first_name" value="" placeholder="Search for your connection" style="height: 28px;border: none;border-radius: 4px 0px 0px 4px !important;font-size: 14px;border: 1px solid #00bcd4;" data-original-title="" title="" type="text">
                        <span class="input-group-btn">
                            <button style="background: rgb(0, 188, 212);border: none;color: #fff;width: 54px;height: 28px;border-radius: 0px 4px 4px 0px;" type="submit" class="btn btn-secondary btn-sm"><span class="glyphicon glyphicon-search"></span></button>
                        </span>
                    </div>
                </form>
            </div>
            </div>
                    </div>
                </div>
            </div>
        </div>
      <section class="deafult-bg">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3>Profiles to check out</h3>
                <hr>
                <?php
                //$i=0;
                foreach($item_fix as $item_fs)
                {
                    $recommendations = $item_fs->recommendations->where('state', '=', 'approve')->order_by('time', 'desc')->find_all()->as_array();
                    $temp_words = array();
                    foreach($recommendations as $recommend) {
                        $words = explode(', ', $recommend->words);
                        $temp_words = array_merge($temp_words, $words);
                    }
                    $tags = array_count_values($temp_words);

                    $percentile_s= $item_fs->friends->calculate_social_percentage($tags);
                    $photo = $item_fs->photo->profile_pic;
                    $photo_image = file_exists("upload/" .$photo);
                ?>
                <?php //if($percentile_s > 60) { 
                     
                     //if($i < 4) { ?>
                <div class="col-sm-3">
                        <div class="imgbox" id="head">

                            <?php
                            $photo = $item_fs->photo->profile_pic;
                            $photo_image = file_exists("mobile/upload/" .$photo);
                            $photo_image1 = file_exists("upload/" .$photo);
                            if (!empty($photo) && $photo_image) { ?>
                                <img src="<?php echo url::base() . "mobile/upload/" . $item_fs->photo->profile_pic; ?>" alt="<?php echo $item_fs->user_detail->first_name." ".$item_fs->user_detail->last_name;?>" class="img-responsive" style="height:100%;width:100%; border-radius: 50%;">
                            <?php }
                            else if (!empty($photo) && $photo_image1) { ?>
                                <img src="<?php echo url::base() . "upload/" . $item_fs->photo->profile_pic; ?>" alt="<?php echo $item_fs->user_detail->first_name." ".$item_fs->user_detail->last_name;?>" class="img-responsive" style="height:100%;width:100%; border-radius: 50%;">
                            <?php }  else { ?>
                                <div id="inset">
                                    <h1>
                                        <?php echo $item_fs->user_detail->first_name[0].$item_fs->user_detail->last_name[0]; ?>
                                    </h1>
                                    <!--<span><a href=""><i class="fa fa-question-circle"></i> ask photo</a></span>-->
                                </div>
                            <?php } ?>
                        </div>
                        <div class="panel-body">
                            <div class="user-title bg_color">
                                    <span class="user-name" style="font-size:15px;">
                                        <a href="<?php echo url::base() . $item_fs->username; ?>">
                                            <?php echo $item_fs->user_detail->first_name . " " . $item_fs->user_detail->last_name; ?>
                                        </a>
                                    </span>
                                <div class="clearfix"></div>
                                <span class="social-score">Social percentile: <?php echo $percentile_s;?>%</span>
                            </div>
                        </div>

                    </div>
                    <?php// $i = $i+1; } ?>
                    <?php //} ?>
                    <?php
                }
                ?>

            </div>
        </div>
    </div>
</section>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="js/jquery.min.js"></script>
    </body>
</html>