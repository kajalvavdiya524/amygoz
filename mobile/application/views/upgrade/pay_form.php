<!-- Vendor libraries -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/1.2.3/jquery.payment.min.js"></script>

<!-- If you're using Stripe for payments -->
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
    // this identifies your website in the createToken call below
    Stripe.setPublishableKey('<?php echo Kohana::$config->load('stripe')->get('publishable_key'); ?>');

    function stripeResponseHandler(status, response) {
        if (response.error) {
            // re-enable the submit button
            $('.submit-button').removeAttr("disabled");
            // show the errors on the form
            if($.type(response.error.param) === "undefined") {
                $(".alert-error").html('<strong>Error!</strong> '+response.error.message);
                $(".alert-error").show();
            } else {
                var elem_class = 'card-'+response.error.param;
                $('.'+elem_class).parents("div.form-group").addClass('has-error');
                $('.'+elem_class).siblings('span').html(response.error.message);
            }
        } else {
            var form$ = $("#payment-form");
            // token contains id, last4, and card type
            var token = response['id'];
            // insert the token into the form so it gets submitted to the server
            form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
            // and submit
            form$.get(0).submit();
        }
    }

    $(document).ready(function() {
        $("#payment-form").submit(function(event) {
            // disable the submit button to prevent repeated clicks
            $('.submit-button').attr("disabled", "disabled");

            // createToken returns immediately - the supplied callback submits the form if there are no errors
            Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-exp_month').val(),
                exp_year: $('.card-exp_year').val()
            }, stripeResponseHandler);
            return false; // submit from callback
        });
    });
</script>
<div>

    <fieldset class="fieldset">
        <h3><?php echo $plan['name']." Plan <strong>".$plan['dollar'];?></strong></h3>
        
        <hr>
        
        <div class="fieldset-inner">
        <!-- to display errors returned by createToken -->
        <div class="alert alert-danger" style="display:none;">
           
        </div>
        
        <div class="container">
            <div class="row">
                <!-- CREDIT CARD FORM START HERE -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row marBottom20">
                            <div class="col-sm-7">
                                <h3>Payment Details</h3>
                            </div>
                            <div class="col-sm-5">
                                <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
                            </div>
                        </div> 
                    </div>
                    <div class="panel-body">
                        <form role="form" id="payment-form">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="cardNumber">Credit/Debit Card Number:</label>
                                        <input type="text" size="20" autocomplete="off" class="form-control card-number" />
                                        <span class="help-inline" style="color:#B94A48"></span>
                                    </div>                            
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-7 col-md-7">
                                    <div class="form-group">
                                        <label for="cardExpiry"><span class="hidden-xs">Expiration Date (MM/YYYY):</span></label>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" size="2" class="form-control card-exp_month dis-in-block" style="width:80px;"/> /
                                                <input class="form-control card-exp_year dis-in-block" type="text" size="4" style="width:100px;"/>
                                                <span class="help-inline" style="color:#B94A48"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-5 col-md-5 pull-right">
                                    <div class="form-group">
                                        <label for="cardCVC">CVC Number</label>
                                        <input type="text" size="4" autocomplete="off" class="form-control card-cvc" />
                                        <span class="help-inline" style="color:#B94A48"></span>
                                    </div>
                                </div>
                            </div>
                            <p class="muted">CVC is last 3 digits of on the back of your card (Visa, Mastercard, Discover). For American Express, it is 4 digits on the right of the front side.</p>
                        </form>
                    </div>
                </div>
                <!-- CREDIT CARD FORM ENDS HERE -->
            </div>
        </div>

        <!--<input type="hidden" name="plan_name" value="<?php //echo $plan_name; ?>" />
        
        <div class="form-group">
            <label class="control-label" for="card-number">Credit/Debit Card Number:</label>
            <input type="text" size="20" autocomplete="off" class="form-control card-number" />
            <span class="help-inline" style="color:#B94A48"></span>
        </div>
    
        <div class="form-group">
            <label class="control-label" for="card-cvc">CVC Number:</label>
            <input type="text" size="4" autocomplete="off" class="form-control card-cvc" />
            <span class="help-inline" style="color:#B94A48"></span>
        </div>
    
        <div class="form-group">
            <label class="control-label">Expiration Date (MM/YYYY):</label>

            <div>
                <input type="text" size="2" class="form-control card-exp_month dis-in-block" style="width:80px;"/> /
                <input class="form-control card-exp_year dis-in-block" type="text" size="4" style="width:100px;"/>
                <span class="help-inline" style="color:#B94A48">
                </span>
            </div>
        </div>

        <p class="muted">CVC is last 3 digits of on the back of your card (Visa, Mastercard, Discover). For American Express, it is 4 digits on the right of the front side.</p>
        </div>
        
        </fieldset>-->
</div>