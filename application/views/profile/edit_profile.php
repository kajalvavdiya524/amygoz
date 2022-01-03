
<?php if (Session::instance()->get('location_error')) {
    ?>
    <div class="alert alert-danger text-center">
        <strong>Error! </strong>
    <?php echo Session::instance()->get_once('location_error'); ?>
    </div>
<?php } ?>

<div class="profile-block">

    <div class="profile-detail" style="padding:30px 50px;">
        <div class="profile-detail-box pull-left"> 
            <fieldset class="fieldset">
                <legend>Basic Information</legend>
                
                <div class="fieldset-action">
                    <a data-toggle="modal" href="#editBasicInfo" class="btn btn-secondary btn-sm">
                        <span class="glyphicon glyphicon-pencil"></span> Edit
                    </a>
                </div>
                
                <div class="ribbion-modal modal fade" id="editBasicInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    
                        <div class="modal-content">
                        
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    <img src="<?php echo url::base(); ?>img/close.png" />
                                </button>
                                <div class="ribbion">
                                    <h2>Basic Information</h2>
                                </div>
                                <div class="triangle-l"></div>
                                
                                <div class="clearfix"></div>
                            </div>
                            
                            <form class="validate-form" method="post" role="form">
                                <div class="modal-body">
                                
                                    <div class="form-group">
                                        <label class="control-label" for="first_name">First Name:</label>
                                        
                                        <input type="text" readonly  class="required form-control" id="first_name" name="first_name" placeholder="First Name" onkeypress="return onlyAlphabets(event,this);" onkeyup="this.value=this.value.replace(/[^A-z/a-z]/g,'');" value="<?php echo $user->user_detail->first_name; ?>">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label" for="last_name">Last Name:</label>
                                        <input type="text" readonly  class="required form-control" id="last_name" name="last_name" placeholder="Last Name" onkeypress="return onlyAlphabets(event,this);" onkeyup="this.value=this.value.replace(/[^A-z/a-z]/g,'');" value="<?php echo $user->user_detail->last_name; ?>">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="required control-label" for="sex">I am:</label>
                                        <input type="text" readonly  class="required form-control"  value="<?php echo $user->user_detail->sex; ?>">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="required control-label" for="phase_of_life">Phase Of Life:</label>
                                        <select name="phase_of_life" class="form-control">
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

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-transparent" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-secondary">Save changes</button>
                                </div>
                            </form>

                        </div><!-- /.modal-content -->
                        
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                
                <div class="fieldset-inner">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>First Name: </td>
                                <td><?php echo $user->user_detail->first_name;?></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Last Name: </td>
                                <td><?php echo $user->user_detail->last_name;?></td>
                            </tr>
                            <tr>
                                <td>Gender: </td>
                                <td><?php echo $user->user_detail->sex;?></td>
                            </tr>
                            <tr>
                                <td>Phase Of Life: </td>
                                <td>
                                <?php
                                $detail = Kohana::$config->load('profile')->get('phase_of_life');
                                echo ($user->user_detail->phase_of_life) ? $detail[$user->user_detail->phase_of_life] : "";
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
                                <?php
                                        $user_ip = $_SERVER['REMOTE_ADDR'];
                                        $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
                                        $country = $geo["geoplugin_countryCode"];

                                        ?>
                                        <input type="hidden" id="country_code" value="<?php echo $country; ?>">
                                    <div class="form-group">
                                        <script src="<?php echo url::base()?>js/intlTelInput.js"></script> 
                                        <link rel="stylesheet" href="<?php echo url::base() ?>css/intlTelInput.css">
                                        <label class="control-label" for="phone">Mobile Number:</label>
                                        <input class="form-control" id="mobile-number" maxlength="10"  type="text" name="phone" placeholder="What's your phone number?" value="<?php echo $user->user_detail->phone; ?>">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label" for="website">Website:</label>
                                        <input class="form-control" id="website" type="text" name="website" placeholder="What is your website?" value="<?php echo $user->user_detail->website; ?>">
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
                                <td>Mobile Number:</td>
                                <td><?php echo $user->user_detail->phone;?></td>
                            </tr>
                        </thead>
                        <tr>
                            <td>Website:</td>
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
               

<div class="ribbion-modal modal fade" style="z-index: 1051 !important;" id="editLivingInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                        <!-- <input class="required form-control" id="current_city" type="text" name="location" placeholder="Where do you live?" value="<?php echo $user->user_detail->location; ?>"> -->
                                    <input  required class="form-control required location" id="searchTextField" placeholder="Type Your Location" type="text" name="location" value="<?php echo $user->user_detail->location; ?>">
                                    <input name="location_chk" type="hidden" id="location_latlng" value="">
                                    <input type="hidden" id="administrative_area_level_1"  value="">
                                    <input type="hidden" id="country" value="">
                                    <input type="hidden" id="locality"  value="">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label" for="home_town">Home Town:</label>
                                        <!-- <input class="required form-control" id="birth_place" type="text" name="home_town" placeholder="Where are your originally from?" value="<?php echo $user->user_detail->home_town; ?>"> -->
                                        <input  required class="form-control required birth_place" id="birth_place" type="text" name="home_town" placeholder="Where are your originally from?" value="<?php echo $user->user_detail->home_town; ?>">
                                    <input name="location_chkb" type="hidden" id="location_latlngb" value="<?php echo Request::current()->post('birth_place'); ?>" />
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
                
                <div class="ribbion-modal modal fade" style="z-index: 1051 !important;" id="editWorkInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                        <label class="control-label" for="education">Education Institution:</label>
                                        <input class="required form-control js-autocomplete" id="education" type="text" name="education" placeholder="Where did you study?" value="<?php echo $user->user_detail->education; ?>">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label" for="employment">Working At:</label>
                                        <input class="form-control" id="employment" type="text" name="employment" placeholder="Where do you work?" value="<?php echo $user->user_detail->employment; ?>">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label" for="designation">Designation:</label>
                                        <input class="form-control" id="designation" type="text" name="designation" placeholder="What is your job title?" value="<?php echo $user->user_detail->designation; ?>">
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
                                        <textarea class="form-control" name="about" placeholder="Write a few lines about yourself"><?php echo $user->user_detail->about; ?></textarea>
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
    </div>

</div>


<script src="<?php echo url::base();?>js/jquery.geocomplete.min.js" type="text/javascript"></script>
<script>
      $("document").ready(function(){

    $("#birth_place").geocomplete();
    $("#current_city").geocomplete();
        
      });
    
        
</script>


<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Responsive -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-7641809175244151"
     data-ad-slot="3812425620"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

<script type="text/javascript">
        
        //alert(ccode);
        $("#mobile-number").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg").html("Digits Only").show().fadeOut("slow");
        return false;
    }
});
        var ccode = $('#country_code').val();
        var res = ccode.toLowerCase();
        $("#mobile-number").intlTelInput({
             
            autoFormat: false,
            //autoHideDialCode: false,
            defaultCountry:res,
            //nationalMode: true,
            //numberType: "MOBILE",
            //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
            //preferredCountries: ['cn', 'jp'],
            //responsiveDropdown: true,
            utilsScript: "<?php echo url::base()?>js/lib/libphonenumber/build/utils.js"
        });


        $('#first_name').keyup(function()
        {
            $(this).val($(this).val().substr(0, 1).toUpperCase() + $(this).val().substr(1).toLowerCase());
        });

        $('#last_name').keyup(function()
        {
            $(this).val($(this).val().substr(0, 1).toUpperCase() + $(this).val().substr(1).toLowerCase());
        });

        $('#first_name').bind("paste",function(e) { //prevent user to paste anything...
            e.preventDefault();
        });

        $('#last_name').bind("paste",function(e) { //prevent user to paste anything...
            e.preventDefault();
        });

        $('#last_name').blur // first name and last name should not be same 
        (function(){
            var fname=$('#first_name').val();
            var lname = $('#last_name').val();
            if(lname)
            {
                if(fname == lname)
                {
                    $('#last_name').val("");
                    alert('First name and last name should not be same ');
                } else
                {
                    return true;
                } 
            }   
        });

        $('#first_name').blur(function() //first name' length should be greater then 2 
        {
            var fname=$('#first_name').val();
            if(fname)
            {
                if(fname.length < 3)
                {
                    $('#first_name').val("");
                    alert('First name should have 3 letters');
                }else
                {
                return true;
                }
            }
        });
</script>


<!-- <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script> -->
<script>
   /* var element = document.getElementsByClassName('js-autocomplete')[0];
    var autocompleteSchools = new google.maps.places.Autocomplete(element);
    google.maps.event.addListener(autocompleteSchools, 'place_changed', function () {
        var place = autocompleteSchools.getPlace();
        var resultNode = document.getElementsByClassName('js-result')[0];
        resultNode.innerHTML = '';
        resultNode.appendChild(document.createTextNode(JSON.stringify(place.address_components, null, 4)));
    });*/
</script>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo Kohana::$config->load('settings')->get('location_api_key'); ?>&libraries=places"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

             

                <script>
                    $(document).ready(function () {
                        var placeSearch, autocomplete;
                        var component_form = {
                            'locality': 'long_name',
                            'administrative_area_level_1': 'long_name',
                            'country': 'long_name',
                        };

                       
                        var input = document.getElementById('searchTextField');
                        //var birth_place = document.getElementById('birth_place');
                        var options = {
                            types: ['(cities)']
                        };

                        autocomplete = new google.maps.places.Autocomplete(input, options);
                        //birth_place_autocomplete = new google.maps.places.Autocomplete(birth_place, options);

                        google.maps.event.addListener(autocomplete, 'place_changed', function () {
                            var place = autocomplete.getPlace();

                            if (!place.geometry) {
                                alert("No Found");
                                return;
                            } else {
                                for (var j = 0; j < place.address_components.length; j++) {
                                    var att = place.address_components[j].types[0];
                                    if (component_form[att]) {
                                        var val = place.address_components[j][component_form[att]];
                                        document.getElementById(att).value = val;
                                    }
                                }
                                $('#location_latlng').val('done');


                               
                            }
                        });

                        $('#searchTextField').change(function () {
                            $('#location_latlng').val('');
                        });
                        


                    });
                </script>

<script>
                    $(document).ready(function () {
                        var autocomplete;
                        
                        var input = document.getElementById('birth_place');
                        
                        var options = {
                            types: ['(cities)']
                        };

                        autocomplete = new google.maps.places.Autocomplete(input, options);
                        birth_place_autocomplete = new google.maps.places.Autocomplete(birth_place, options);

                        google.maps.event.addListener(birth_place_autocomplete, 'place_changed', function () {
                            var place = birth_place_autocomplete.getPlace();

                            if (!place.geometry) {
                                alert("No Found");
                                return;
                            } else {
                                
                                $('#location_latlngb').val('done');


                               
                            }
                        });

                        $('#birth_place').change(function () {
                            $('#location_latlngb').val('');
                        });
                        


                    });
                </script>