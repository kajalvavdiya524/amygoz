<div style="max-height:550px;overflow:auto;">
    
    <form class="edit-form validate-form" role="form" action="<?php echo url::base()."admina/edit_profile/".$user->id; ?>" method="post">
        <fieldset class="fieldset">
            <legend class="padBottom20">Edit Profile</legend>

            <div class="col-md-4">

                <div class="form-group">
                    <label class="control-label" for="email">Email:</label>
                    <input class="form-control email uniqueEmail" id="email" type="text" name="email" value="<?php echo $user->email;?>">
                </div>

                <div class="form-group">
                    <label class="control-label" for="username">Username:</label>
                    <input class="form-control uniqueUsername usernameRegex" id="username" type="text" name="username" value="<?php echo $user->username;?>">
                </div>

                <div class="form-group">
                    <label class="control-label" for="password">Password:</label>
                    <input class="form-control" id="password" type="text" name="password">
                </div>
                

               <div class="form-group">
                    <label class="control-label" for="sex">Sex:</label>
                    <select name="sex" class="form-control">
                        <option value="">Select Sex</option>
                        <?php if($user->user_detail->sex == 'Male') { ?>
                            <option value="Male" selected="selected">Male</option>
                        <?php } else { ?>
                            <option value="Male">Male</option>
                        <?php } ?>
                        <?php if($user->user_detail->sex == 'Female') { ?>
                            <option value="Female" selected="selected">Female</option>
                        <?php } else { ?>
                            <option value="Female">Female</option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label class="control-label" for="birthday" style="display:block;">Birthday:</label>
                    <?php $part = explode('-', $user->user_detail->birthday); ?>
                    <select name="month" class="form-control" style="display:inline-block;width:92px;">
                        <option value="">Month:</option>
                        <option value="01" <?php if($part[1] == '01') { ?>selected="selected" <?php } ?>>January</option>
                        <option value="02" <?php if($part[1] == '02') { ?>selected="selected" <?php } ?>>Febrary</option>
                        <option value="03" <?php if($part[1] == '03') { ?>selected="selected" <?php } ?>>March</option>
                        <option value="04" <?php if($part[1] == '04') { ?>selected="selected" <?php } ?>>April</option>
                        <option value="05" <?php if($part[1] == '05') { ?>selected="selected" <?php } ?>>May</option>
                        <option value="06" <?php if($part[1] == '06') { ?>selected="selected" <?php } ?>>June</option>
                        <option value="07" <?php if($part[1] == '07') { ?>selected="selected" <?php } ?>>July</option>
                        <option value="08" <?php if($part[1] == '08') { ?>selected="selected" <?php } ?>>August</option>
                        <option value="09" <?php if($part[1] == '09') { ?>selected="selected" <?php } ?>>September</option>
                        <option value="10" <?php if($part[1] == '10') { ?>selected="selected" <?php } ?>>October</option>
                        <option value="11" <?php if($part[1] == '11') { ?>selected="selected" <?php } ?>>November</option>
                        <option value="12" <?php if($part[1] == '12') { ?>selected="selected" <?php } ?>>December</option>
                    </select>
                    <select name="day" class="form-control" style="display:inline-block;width:92px;">
                        <option value="">Day:</option>
                        <?php for($i = 1;$i<=31;$i++) { ?>
                            <?php if($part[2] == $i) { ?>
                                <option value="<?php echo ($i < 10) ? '0'.$i : $i;?>" selected="selected"><?php echo $i;?></option>
                            <?php } else { ?>
                                <option value="<?php echo ($i < 10) ? '0'.$i : $i;;?>"><?php echo $i;?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                    <select id="yearOfBirth" class="form-control" name="year" style="display:inline-block;width:92px;">
                        <option value="">Year:</option>
                        <?php $y = date('Y'); ?>
                        <?php for($n = $y-100;$n<=$y;$n++) { ?>
                            <?php if($part[0] == $n) { ?>
                                <option value="<?php echo $n;?>" selected="selected"><?php echo $n;?></option>
                            <?php } else { ?>
                                <option value="<?php echo $n;?>"><?php echo $n;?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="col-md-4"> 
                <div class="form-group">
                    <label class="control-label" for="first_name">First Name:</label>
                    <input class="form-control" id="first_name" type="text" name="first_name" value="<?php echo $user->user_detail->first_name;?>">
                </div>

                <div class="form-group">
                    <label class="control-label" for="last_name">Last Name:</label> 
                    <input class="form-control" id="last_name" type="text" name="last_name" value="<?php echo $user->user_detail->last_name;?>">
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="phase_of_life">Phase Of Life:</label>
                    <select name="phase_of_life" class="form-control required">
                    <option value="">Please Select:</option>
                    <?php foreach(Kohana::$config->load('profile')->get('phase_of_life') as $key => $value) { ?>
                        <?php if($user->user_detail->phase_of_life == $key) { ?>
                        <option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
                        <?php } else { ?>                                    
                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                        <?php } ?>
                    <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label class="control-label" for="phone">Phone Number:</label>
                    <input class="form-control" id="phone" type="text" name="phone" value="<?php echo $user->user_detail->phone;?>">
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="website">Website:</label>
                    <input class="form-control required" id="website" type="text" name="website" value="<?php echo $user->user_detail->website; ?>">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label" for="education">Education:</label>
                    <input class="form-control required" id="education" type="text" name="education" value="<?php echo $user->user_detail->education; ?>">
                </div>
                <div class="form-group">
                    <label class="control-label" for="employment">Working At:</label>
                    <input class="form-control required" id="employment" type="text" name="employment" value="<?php echo $user->user_detail->employment; ?>">
                </div>
                <div class="form-group">
                    <label class="control-label" for="designation">Designation:</label>
                    <input class="form-control required" id="designation" type="text" name="designation" value="<?php echo $user->user_detail->designation; ?>">
                </div>
                <div class="form-group">
                    <label class="control-label" for="about">About me:</label>
                    <textarea class="form-control" name="about"><?php echo $user->user_detail->about;?></textarea>
                </div>
            </div>

            <div style="clear:both;"></div>
            
            <div class="form-actions textCenter">
                <button class="btn btn-primary" type="submit">Update</button>
            </div>
        </fieldset>
    </form>
</div>