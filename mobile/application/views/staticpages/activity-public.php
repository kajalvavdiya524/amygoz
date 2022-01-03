<script src="https://www.Callitme.com/js/function.js?v=1.1" type="text/javascript"></script>
<script src="https://www.Callitme.com/js/common.js?v=1.1" type="text/javascript"></script>
<div class="container" style="padding:10px"id="accordion">
  <div class="">
   
        <div class=""> <!-- panel-heading -->
            <h4 class="panel-title"> <!-- title 1 -->
          Select an Activity
            
           </h4>
        </div>
        <!-- panel body -->

        <div id="accordionOne" class="panel-collapse collapse in">
          <div class="panel-body">
            <section class="">
                <div class="container">
                    <div class="row text-center">
                        <div class="col-sm-7">                           
                           <p class="quote-text center-block primary-text">What do you feel like doing?</p>
                            
                            
  								<div class="litesuggest-group demo demo2">
                            <input type="text" name="doing" id="get"  class="required form-control hb-mt-40"  placeholder="Eg. Lunch, biking, group study auto suggestion" > 
                            		</div>

                                                            
                           
 <button style="display:none;" data-toggle="collapse" data-parent="#accordion" href="#accordionTwo" id="call" class="btn btn-primary btn-lg hb-mt-80" style="width:80%">Eg. Lunch, biking, group study auto suggestion</button>	

<link rel="stylesheet" href="<?php echo url::base()."css/litesuggest.css";?>">
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="<?php echo url::base()."css/litesuggest.js";?>"></script>

<script>
$(function() {
$(".demo2").litesuggest({

  words: ["Biking", "Lunch", "Dinner","Swimming", "Movies", "Long Drive","Watch a Game", "Party", "Group Study","Drinks"],

 groupSelector: ".demo"

});
	
  $('#get').change(function () {
    $('#call').click();
});

 


});
</script>
                  
                                                          <!-- <script type="text/javascript">
 
                                                          			$(function() {																		
																		$( "#hider" ).on('keypress',function(){
																			  $('#suggestionBox').css({
																			        position: "absolute",
																			        top: (this.offsetTop + this.offsetHeight) + "px",
																			        left: this.offsetLeft + "px"
																			    });
																			    $('#suggestionBox').show().autoHide();	
																			 });       
																     /*$('#hider').on('change', function() {
																         var selected = $('#hider option:selected').val();

																         if ( selected) {
																       
																            
																         }
																     });*/
																});
                                                            </script>-->
                                
                        </div>
                        <div class="col-sm-5">
                            <p class="quote-text center-block primary-text">Time is a limited commodity</p>
                            <p class="">Spend it with someone you want to</p>
                        </div>
                    </div>
                </div>
            </section>
    </div>
    </div>
    </div>


<div class="panel panel-success" style="background: #fff;border: none;box-shadow: none;">  <!-- accordion 2 -->
      
          <div class="panel-heading" style="background: #fafafa;border: none;"> 
          <h4 class="panel-title"> <!-- title 2 -->
          Select People
          </h4>
          </div>
         <!-- panel body -->
        <div id="accordionTwo" class="panel-collapse collapse">
          <div class="panel-body">
<section class="gap gap-fixed-height-small secondary-bg">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
            
                <p style="color:#fff;">Great, who you want to go lunch with ? </p>
                    
                     <div class="input-group" style="padding-top:15px;">

            <input type="text" id="search-query1" class="required email find_user form-control" name="test" placeholder="Enter email address or name auto suggestion" required>
             <button type="button" class="btn btn-primary" id="snext" onclick="return set_data();" style="color:white;margin-top: 12px;"data-toggle="collapse" data-parent="#accordion" href="#accordionThree"  >Enjoy Game</button>       
                    <div id="message-suggestion1" style="margin-top: 25px;
    margin-left: -9px;" class="registered_users well-sm">
                </div>
                  <!--  <input type="text" class="" name="email" class="form-control " placeholder="Enter email address or name auto suggestion">-->
              
               
            </div>
        </div>        
    </div>
</section>
</div>
    </div>
    </div>

  <div class="panel panel-warning" style="background: #fff;border: none;box-shadow: none;">  <!-- accordion 3 -->
    
        <div class="panel-heading" style="background: #fafafa;border: none;">
          <h4 class="panel-title"> <!-- title 3 -->
          
             Enter Details
           
          </h4>
        </div>
        
        <div id="accordionThree" class="panel-collapse collapse">
          <!-- panel body -->
<script language="JavaScript" type="text/javascript">
function setHiddenValue()
{
  document.getElementById('email_get').value = document.getElementById('search-query1').value;
	var yo=document.getElementById('email_get').value; 
	return yo;
}
</script>





          <div class="panel-body">  
<section class="gap gap-fixed-height-small auth">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">

               <form class="form-inline" method="post" action="<?php echo url::base()."login?page=activity";?>">
               <div class="form-group">
                        <label for="exampleInputName2">Tell about yourself</label>
                       <input type="hidden" id ="set_data1" value="" name="data1">
                       <input type="hidden" id ="set_data2" value="" name="data2">
                        <input type="email" name="email" class="form-control" id="exampleInputName2" placeholder="Email Address" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" id="exampleInputEmail2" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-default" onclick="return call_it_me(); " >Send</button>
             </form>
        </div>        
    </div>
</section>

</div>
</div>
    </div>
    </div>
    <script>
  function call_it_me()
  {
  	var data1=document.getElementById('get').value;
  	$( "#set_data1" ).val(data1);
  	var data2=document.getElementById('search-query1').value;
  	$( "#set_data2" ).val(data2);
  	var data4 =document.getElementById('set_data1').value;
  	var data5 =document.getElementById('set_data2').value;
  	var data3 =document.getElementById('exampleInputName2').value;
  	var data4 =document.getElementById('exampleInputEmail2').value;
  	
  	
  
  }
</script>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <!--Use this block of code-->

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
            </div>
        </div>
    </div>
</section>
