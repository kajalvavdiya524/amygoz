<div class="profile-detail-box pull-left"> 
    <fieldset class="fieldset">
        <legend>Basic Information</legend>
        
        <div class="fieldset-action">
            <a data-toggle="modal" href="#editBasicInfo" class="btn btn-secondary btn-sm">
                <span class="glyphicon glyphicon-pencil"></span> Edit
            </a>
        </div>
        
        <div class="fieldset-inner">
            <table class="table">
                <thead>
                    <tr>
                        <td>First Name : </td>
                        <td><?php echo $user->user_detail->first_name;?></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Last Name : </td>
                        <td><?php echo $user->user_detail->last_name;?></td>
                    </tr>
                    <tr>
                        <td>Gender : </td>
                        <td><?php echo $user->user_detail->sex;?></td>
                    </tr>
                    <tr>
                        <td>Phase Of Life : </td>
                        <td>
                        <?php
                            $phase_of_life = Kohana::$config->load('profile')->get('phase_of_life');
                            echo $phase_of_life[$user->user_detail->phase_of_life];
                        ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </fieldset>
</div>

<div class="profile-detail-box pull-right"> 
    <fieldset class="fieldset">
        <legend>Contact Information</legend>

        <div class="fieldset-action">
            <a data-toggle="modal" href="#editContactInfo" class="btn btn-secondary btn-sm">
                <span class="glyphicon glyphicon-pencil"></span> Edit
            </a>
        </div>
        
        <div class="ribbion-modal modal fade" id="editContactInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            
                <div class="modal-content">
                
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <img src="<?php echo url::base(); ?>img/close.png" />
                        </button>
                        <div class="ribbion">
                            <h2>Contact Information</h2>
                        </div>
                        <div class="triangle-l"></div>
                        
                        <div class="clearfix"></div>
                    </div>
                    
                    <form class="validate-form2" method="post" role="form">
                        <div class="modal-body">
                        
                            <div class="form-group">
                                <label class="control-label" for="phone">Number:</label>
                                <input class="required form-control"id="phone" type="text" name="phone" value="<?php echo $user->user_detail->phone; ?>">
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label" for="website">Website:</label>
                                <input class="required form-control" id="website" type="text" name="website" value="<?php echo $user->user_detail->website; ?>">
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-transparent" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-secondary">Save changes</button>
                        </div>
                    </form>

                </div><!-- /.modal-content -->
                
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="fieldset-inner" style="">
            <table class="table">
                <thead>
                    <tr>
                        <td>Number : </td>
                        <td><?php echo $user->user_detail->phone;?></td>
                    </tr>
                </thead>
                <tr>
                    <td>Website : </td>
                    <td><?php echo $user->user_detail->website;?></td>
                </tr>
            </table>
        </div>
    </fieldset>
</div>

<div class="profile-detail-box pull-right"> 
    <fieldset class="fieldset">
        <legend>Living</legend>

        <div class="fieldset-action">
            <a data-toggle="modal" href="#editLivingInfo" class="btn btn-secondary btn-sm">
                <span class="glyphicon glyphicon-pencil"></span> Edit
            </a>
        </div>
        
        <div class="ribbion-modal modal fade" id="editLivingInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            
                <div class="modal-content">
                
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <img src="<?php echo url::base(); ?>img/close.png" />
                        </button>
                        <div class="ribbion">
                            <h2>Living Information</h2>
                        </div>
                        <div class="triangle-l"></div>
                        
                        <div class="clearfix"></div>
                    </div>
                    
                    <form class="validate-form3" method="post" role="form">
                        <div class="modal-body">
                        
                            <div class="form-group">
                                <label class="control-label" for="location">Current City:</label>
                                <input class="required form-control" id="current_city" type="text" name="location" value="<?php echo $user->user_detail->location; ?>">
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label" for="home_town">Home Town:</label>
                                <input class="required form-control" id="birth_place" type="text" name="home_town" value="<?php echo $user->user_detail->home_town; ?>">
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-transparent" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-secondary">Save changes</button>
                        </div>
                    </form>

                </div><!-- /.modal-content -->
                
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="fieldset-inner" style="">
            <table class="table">
                <thead>
                    <tr>
                        <td>Current City: </td>
                        <td><?php echo $user->user_detail->location;?></td>
                    </tr>
                </thead>
                <tr>
                    <td>Home Town: </td>
                    <td><?php echo $user->user_detail->home_town;?></td>
                </tr>
            </table>
        </div>
    </fieldset>
</div>

<div class="profile-detail-box pull-left"> 
    <fieldset class="fieldset">
        <legend>Work and Education</legend>

        <div class="fieldset-action">
            <a data-toggle="modal" href="#editWorkInfo" class="btn btn-secondary btn-sm">
                <span class="glyphicon glyphicon-pencil"></span> Edit
            </a>
        </div>
        
        <div class="ribbion-modal modal fade" id="editWorkInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            
                <div class="modal-content">
                
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <img src="<?php echo url::base(); ?>img/close.png" />
                        </button>
                        <div class="ribbion">
                            <h2>Work and Education</h2>
                        </div>
                        <div class="triangle-l"></div>
                        
                        <div class="clearfix"></div>
                    </div>
                    
                    <form class="validate-form4" method="post" role="form">
                        <div class="modal-body">
                        
                            <div class="form-group">
                                <label class="control-label" for="education">Education:</label>
                                <input class="required form-control" id="education" type="text" name="education" value="<?php echo $user->user_detail->education; ?>">
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label" for="employment">Working At:</label>
                                <input class="required form-control" id="employment" type="text" name="employment" value="<?php echo $user->user_detail->employment; ?>">
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label" for="designation">Designation:</label>
                                <input class="required form-control" id="designation" type="text" name="designation" value="<?php echo $user->user_detail->designation; ?>">
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-transparent" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-secondary">Save changes</button>
                        </div>
                    </form>

                </div><!-- /.modal-content -->
                
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="fieldset-inner" style="">
            <table class="table">
                <thead>
                    <tr>
                        <td>Education: </td>
                        <td><?php echo $user->user_detail->education;?></td>
                    </tr>
                </thead>
                <tr>
                    <td>Working At: </td>
                    <td><?php echo $user->user_detail->employment;?></td>
                </tr>
                <tr>
                    <td>Designation: </td>
                    <td><?php echo $user->user_detail->designation;?></td>
                </tr>
            </table>
        </div>
    </fieldset>
</div>

<div class="profile-detail-box pull-right"> 
    <fieldset class="fieldset">
        <legend>About Me</legend>

        <div class="fieldset-action">
            <a data-toggle="modal" href="#editAboutInfo" class="btn btn-secondary btn-sm">
                <span class="glyphicon glyphicon-pencil"></span> Edit
            </a>
        </div>
        
        <div class="ribbion-modal modal fade" id="editAboutInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            
                <div class="modal-content">
                
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <img src="<?php echo url::base(); ?>img/close.png" />
                        </button>
                        <div class="ribbion">
                            <h2>About You</h2>
                        </div>
                        <div class="triangle-l"></div>
                        
                        <div class="clearfix"></div>
                    </div>
                    
                    <form class="validate-form5" method="post" role="form">
                        <div class="modal-body">
                        
                            <div class="form-group">
                                <label class="control-label" for="about">About You:</label>
                                <textarea class="required form-control" name="about"><?php echo $user->user_detail->about; ?></textarea>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-transparent" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-secondary">Save changes</button>
                        </div>
                    </form>

                </div><!-- /.modal-content -->
                
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="fieldset-inner" style="">
            <p><?php echo $user->user_detail->about; ?></p>
        </div>
    </fieldset>
</div>

<div class="clearfix"></div>