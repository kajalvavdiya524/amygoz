<section id="register" class="js-fullheight">
	<div class="contaier-fluid">
		<div class="row horizontal-margin-none">
			<div class="col-sm-12">
				<!-- multistep form -->
				<form id="msform1" class="msform">
				  	<!-- fieldsets -->
				  	<fieldset id="first">
				    	<h2 class="fs-title">Create your account</h2>
				    	<div class="form-group vertical-margin-none">
					    	<input type="text" name="first_name" id="fname" class="form-control" placeholder="First Name" />
					    </div>
					    <div class="form-group vertical-margin-none">
					    	<input type="text" name="last_name" id="lname" class="form-control" placeholder="Last Name" />
					    </div>
					    <div class="form-group vertical-margin-none">
						    <select name="sex" id="sex" class="required form-control">
		                        <option value="">Select Gender</option>
		                        <option value="Male">Male</option>
		                        <option value="Female">Female</option>
		                    </select>
	                    </div>
	                    <div class="form-group vertical-margin-none">
		                    <select name="phase_of_life" id="phase_of_life" class="form-control required">
		                        <option value="">Phase of life:</option>
		                        <option value="1">Single</option>
		                        <option value="2">Hard to explain</option>
		                        <option value="3">Married</option>
		                        <option value="4">Hanging out with someone</option>
		                        <option value="5">Divorced</option>
		                        <option value="6">Engaged</option>
		                        <option value="7">Widowed</option>
		                    </select>
	                    </div>
					    <input type="button" name="next" class="next btn btn-default primary-bg no-bg-image white-text no-text-shadow" data-type="first" value="Next" />
				  	</fieldset>				  
					<fieldset id="second">
					    <h2 class="fs-title">Personal Info</h2>
					    <div class="form-group text-left vertical-margin-none">
                            <label class="control-label dis-block" for="birthday">Birthday:</label>
                            <div class="row">
                                <div class="col-xs-5" style="padding-right: 0">
                                    <select name="month" id="month" class="dis-in-block form-control">
                                        <option value="">Month:</option>
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                                <div class="col-xs-3" style="padding: 0">
                                    <select name="day" id="day" class="dis-in-block form-control">
                                        <option value="">Day:</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                        <option value="31">31</option>
                                              
                                    </select>
                                </div>
                                <div class="col-xs-4" style="padding-left: 0">
                                    <select id="year" class="dis-in-block form-control" name="year">
                                        <option value="">Year:</option>
                                        <?php for($i = 1916; $i <= date('Y'); $i++){ echo '<option value="'.$i.'">'.$i.'</option>'; }?>         
                                    </select>
                                </div>
                            </div>
                            <div class="form-group vertical-margin-none">
						    	<input id="pacInput" class="form-control controls" type="text" placeholder="Location">
						    </div>						    
                        </div>                     
                        <input name="previous" class="previous next btn btn-default secondary-bg no-bg-image white-text no-text-shadow" value="Previous" type="button">
                        <input name="next" class="next next btn btn-default primary-bg no-bg-image white-text no-text-shadow" value="Next" data-type="second" type="button">
				  	</fieldset>				  
					<fieldset id="third">
					    <h2 class="fs-title">Login Details</h2>
					    <div class="from-group">
					    	<input type="text" name="email" id="emailAddress" class="form-control" placeholder="Email" />
					    </div>
					    <div class="from-group">
					    	<input type="password" name="pass" id="password" class="form-control" placeholder="Password" />
					    </div>			    
					    <div class="form-group">
                            <div class="row">
                                <div class="col-xs-7 answer-varification white-text">
                                    <label class="control-label" for="message">Answer:</label>
                                    <input value="13" name="total" id="total" type="hidden">
                                    ( 10 + 3 ) =                                 
                                </div>
                                <div class="col-xs-5" style="padding-left: 0">
                                    <input class="form-control required digits" name="answer" placeholder="Type your answer here" type="text">
                                </div>
                            </div>
                        </div>
                        <input name="previous" class="previous next btn btn-default secondary-bg no-bg-image white-text no-text-shadow" value="Previous" type="button">
                        <input name="submit" class="next next btn btn-default primary-bg no-bg-image white-text no-text-shadow" value="Submit" type="button" data-type="third">
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</section>

<section class="vertical-padding-lg default-bg text-center">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h3 class="primary-text">One Goal</h3>
                <p>We are dedicated to establishing trust online</p>
            </div>
            <div class="col-xs-12 vertical-margin-md">
                <img src="https://www.callitme.com/images/home1.png" alt="" class="img-responsive center-block">  
            </div>
            <div class="col-xs-12">                      
                <h4 class="text-left hb-mt-80">
                    Callitme is a crowd powered people review network where you can review your friends &amp; family, match your single friends, anonymously ask your crush out for a date, and find singles around you.
                </h4>
            </div>
        </div>
    </div>
</section>

<section id="review" class="secondary-bg vertical-padding-lg">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h3 class="white-text">Review People</h3>
                <p class="white-text">You have reviewed products and businesses, now you get to review people.</p>
            </div>
            <div class="col-sm-4">
                <!--<h1>REVIEW</h1>-->
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <div class="step vertical-margin-sm">
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="icon-wrap">
                                <i class="fa fa-check"></i>
                            </div>
                        </div>
                        <div class="col-xs-9">
                            <h3 class="white-text">Step 1</h3>
                            <p class="white-text">Enter the email address of the person you want to review.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="step vertical-margin-sm">
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="icon-wrap">
                                <i class="fa fa-check"></i>
                            </div>
                        </div>
                        <div class="col-xs-9">
                            <h3 class="white-text">Step 2</h3>
                            <p class="white-text">Pick the relationship between you and the person you are reviewing.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="step vertical-margin-sm">
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="icon-wrap">
                                <i class="fa fa-check"></i>
                            </div>
                        </div>
                        <div class="col-xs-9">
                            <h3 class="white-text">Step 3</h3>
                            <p class="white-text">Choose the attributes that best describes the person.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="step vertical-margin-sm">
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="icon-wrap">
                                <i class="fa fa-check"></i>
                            </div>
                        </div>
                        <div class="col-xs-9">
                            <h3 class="white-text">Step 4</h3>
                            <p class="white-text">Describe the person.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="vertical-padding-lg">
    <div class="container">
        <p class="quote-text center-block text-center primary-text">See who you already know in Callitme</p>
        <div class="row-fluid">
            <dic class="col-sm-6 col-sm-offset-3">
                <form class="form-inline text-center" action="https://www.callitme.com/pages/search_results" method="post">
                    <div class="form-group">
                        <input class="form-control" name="first_name" id="exampleInputFirstName" placeholder="First Name" type="text">
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="last_name" id="exampleInputLastName" placeholder="Last Name" type="text">
                    </div>
                    <button type="submit" class="btn btn-default primary-bg no-bg-image white-text no-text-shadow btn-block">Search Now</button>
                </form>
            </dic>
        </div>
    </div>
</section>
<section class="vertical-padding-lg primary-bg">
    <div class="container">
        <p class="white-text text-center">Callitme started as a class project at Harvard where the initial idea was to match two friends who were too shy to express their feelings. Today, with added features, Callitme has become your hub for people review, match making and social dating. </p>
    </div>
</section>
<section class="vertical-padding-lg secondary-bg">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="customNavigation">
				  	<a class="btn prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
				  	<a class="btn next"><i class="glyphicon glyphicon-chevron-right"></i></a>
				</div>
			    <div id="owl-demo">              
					<div class="item text-center">
						<div class="item_box">
							<i class="img profpic" style="background-image: url('m_assets/images/pp-6-L3aU3jxQ.jpg');"></i>
							<div class="progressWrap">
								<div id="container">
				                    <div class="progress-bar position" data-percent="70" data-color="#FFF,#FF2A7F"></div>
				                </div>	
							</div>
							<h3>Ash Shrivastav</h3>
						</div>
					</div>
					<div class="item text-center">
						<div class="item_box">
							<i class="img profpic" style="background-image: url('m_assets/images/pp-504-QD1mDSgX.jpg');"></i>
							<div class="progressWrap">
								<div id="container">
				                    <div class="progress-bar position" data-percent="100" data-color="#FFF,#FF2A7F"></div>
				                </div>	
							</div>
							<h3>Ross Ford</h3>
						</div>
					</div>
					<div class="item text-center">
						<div class="item_box">
							<i class="img profpic" style="background-image: url('m_assets/images/pp-793-PIvSA4FW.jpg');"></i>
							<div class="progressWrap">
								<div id="container">
				                    <div class="progress-bar position" data-percent="50" data-color="#FFF,#FF2A7F"></div>
				                </div>	
							</div>
							<h3>Jackelyn Figueroa</h3>
						</div>
					</div>
					<div class="item text-center">
						<div class="item_box">
							<i class="img profpic" style="background-image: url('m_assets/images/pp-955-SEdXwzC2.jpg');"></i>
							<div class="progressWrap">
								<div id="container">
				                    <div class="progress-bar position" data-percent="100" data-color="#FFF,#FF2A7F"></div>
				                </div>	
							</div>
							<h3>Clara Felix</h3>
						</div>
					</div>
					<div class="item text-center">
						<div class="item_box">
							<i class="img profpic" style="background-image: url('m_assets/images/pp-854-5itgmZ6i.jpg');"></i>
							<div class="progressWrap">
								<div id="container">
				                    <div class="progress-bar position" data-percent="0" data-color="#FFF,#FF2A7F"></div>
				                </div>	
							</div>
							<h3>Gloria Baby</h3>
						</div>
					</div>    
			    </div>
			</div>
		</div>
	</div>
</section>
    
<div id="includedFooter"></div>