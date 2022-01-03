<div class="row careers-content">

    <div class="apply-box col-md-8 col-md-offset-2">
        <?php if(Auth::instance()->logged_in()) { ?>
            <fieldset class="fieldset">
                <legend>Personal Information</legend>

                <?php if(Session::instance()->get('error')) {?>
                    <div class="alert alert-danger">
                       <strong>ERROR!</strong>
                       <?php echo Session::instance()->get_once('error');?>
                    </div>
                <?php } ?>

                <div class="fieldset-inner">
                    <form class="validate-form form-horizontal" method="post" action="<?php echo url::base()."careers/apply/".urlencode($job_title); ?>" role="form" enctype="multipart/form-data">

                        <div class="form-group">
                            <label class="col-sm-2 control-label col-sm-offset-1">Position :</label>
                            <div class="col-sm-7" style="padding-top:7px;">
                                <strong><?php echo $job_title; ?></strong>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label col-sm-offset-1">First Name :</label>
                            <div class="col-sm-7">
                                <input class="required form-control" id="first_name" type="text" name="first_name" placeholder="What is your first name?" value="<?php echo $user->user_detail->first_name;?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label col-sm-offset-1">Last Name :</label>
                            <div class="col-sm-7">
                                <input class="required form-control" id="last_name" type="text" name="last_name" placeholder="What is your last name?" value="<?php echo $user->user_detail->last_name;?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label col-sm-offset-1">Email :</label>
                            <div class="col-sm-7">
                                <input class="required form-control email" id="email" type="text" name="email" placeholder="What is your email address?" value="<?php echo $user->email;?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label col-sm-offset-1">Phone :</label>
                            <div class="col-sm-7">
                                <input class="required form-control"id="phone" type="text" name="phone" placeholder="What's your phone number?" value="<?php echo $user->user_detail->phone; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label col-sm-offset-1">Location :</label>
                            <div class="col-sm-7">
                                <input class="required form-control" id="current_city" type="text" name="location" placeholder="Where do you live?" value="<?php echo $user->user_detail->location; ?>">
                            </div>
                        </div>

                        <hr />

                        <div class="form-group">
                            <div class="col-sm-7 col-sm-offset-3">
                                <h4>Upload your resume:</h4>
                                <input class="required" type="file" name="resume">
                            </div>
                        </div>

                        <hr />

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-8">
                                <button type="submit" class="btn btn-secondary">Submit</button>
                                <a href="<?php echo url::base()."careers"?>" class="btn btn-transparent">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>

            </fieldset>
        <?php } else { ?>
            <h2>Please <a href="<?php echo url::base()."careers/login/".urlencode($job_title); ?>">Log In</a> to continue the application</h2>
            <p> 
            	<h4>Are you new to Callitme? <a href="<?php echo url::base()."pages/register"?>"> Register </a></h4>
            <p>
           <!-- <p>While Callitme prefers you login and apply via our online application, you can also email your resume 
            with subject as position name to jobs@Callitme.com to apply.</p> -->
        <?php } ?>
    </div>

</div>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo Kohana::$config->load('settings')->get('location_api_key'); ?>&libraries=places"></script>
<script src="<?php echo url::base();?>js/jquery.geocomplete.min.js" type="text/javascript"></script>
<script>
      $(function(){
        $("#current_city").geocomplete();
      });
</script>