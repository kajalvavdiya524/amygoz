<div class="container" style="margin-top:50px">
<div class="col-md-10">
     
    <form role="form" method="post" action="<?php echo  url::base()."pp/create"?>">
         <div id="st1">
    <div class="panel panel-default">
  <div class="panel-heading"><h3 class="panel-title"><strong>Who is this public personality? </strong></h3>
  </div>
  
  <div class="panel-body">
   
            <!-- <div class="alert alert-danger">
                <a class="close" data-dismiss="alert" href="#">�</a>Incorrect Username or Password!
            </div>-->
          
                
                  <div class="row">
    			<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
                        <input type="text" name="first_name" id="first_name" class="form-control required" placeholder="First Name" tabindex="1">
					<h5 id="fname"></h5>
          </div>
				</div>
               
			<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="text" name="last_name" id="last_name" class="form-control required" placeholder="Last Name" tabindex="2">
					<h5 id="lname"></h5>
          </div>
			</div>
			</div>
			
			
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
                <select class="form-control" name="gender" id="gender" placeholder="Select Gender">
                                                        
                    <option value="male"> Male </option>                                        
                    <option value="female">  Female</option>   
                </select>
           <h5 id="sex"></h5>                                         
					</div>
				</div>
                            
      <script src="<?php echo url::base();?>country_select/jquery-1.11.1.min.js"></script>
	<script src="<?php echo url::base();?>country_select/jquery-ui.min.js"></script>
	<script src="<?php echo url::base();?>country_select/jquery.select-to-autocomplete.js"></script>
	<script>
	  (function($){
	    $(function(){
	      $('select').selectToAutocomplete();
	     
	    });
	  })(jQuery);
	</script>
	<link rel="stylesheet" href="<?php echo url::base();?>country_select/jquery-ui.css">
                            <script>
	 
	      $('#location').selectToAutocomplete();
	  
	</script>
        <style>
	
    .ui-autocomplete {
      padding: 0;
      list-style: none;
      background-color: #fff;
      width: 218px;
      border: 1px solid #B0BECA;
      max-height: 350px;
      overflow-x: hidden;
    }
    .ui-autocomplete .ui-menu-item {
      border-top: 1px solid #B0BECA;
      display: block;
      padding: 4px 6px;
      color: #353D44;
      cursor: pointer;
    }
    .ui-autocomplete .ui-menu-item:first-child {
      border-top: none;
    }
    .ui-autocomplete .ui-menu-item.ui-state-focus {
      background-color: #D5E5F4;
      color: #161A1C;
    }
	</style>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
                                            <!--<select class="form-control" name="location" id="location" autofocus="autofocus" autocorrect="off" autocomplete="off">
                                                <option value="1">Select country </option>
                                         
						<?php
                                                
                                           //   $c_name=  Kohana::$config->load('countrylist')->get('country_name');
                                         /*  for($i=0;$i<count($c_name);$i++)
                                           {?>
                                                <option value="<?php echo  $c_name[$i];?>"><?php echo  $c_name[$i];?></option>
                                          <?php  }
                                                */ ?>
                                                   </select>-->
                                            
                                            <select name="location" class="form-control location" id="country-selector" autofocus="autofocus" placeholder="select country"autocorrect="off" autocomplete="off">
                <option value="1" selected="selected">Select Country</option>
      <option value="Afghanistan" data-alternative-spellings="AF ?????????">Afghanistan</option>
      <option value="�land Islands" data-alternative-spellings="AX Aaland Aland" data-relevancy-booster="0.5">�land Islands</option>
      <option value="Albania" data-alternative-spellings="AL">Albania</option>
      <option value="Algeria" data-alternative-spellings="DZ ???????">Algeria</option>
      <option value="American Samoa" data-alternative-spellings="AS" data-relevancy-booster="0.5">American Samoa</option>
      <option value="Andorra" data-alternative-spellings="AD" data-relevancy-booster="0.5">Andorra</option>
      <option value="Angola" data-alternative-spellings="AO">Angola</option>
      <option value="Anguilla" data-alternative-spellings="AI" data-relevancy-booster="0.5">Anguilla</option>
      <option value="Antarctica" data-alternative-spellings="AQ" data-relevancy-booster="0.5">Antarctica</option>
      <option value="Antigua And Barbuda" data-alternative-spellings="AG" data-relevancy-booster="0.5">Antigua And Barbuda</option>
      <option value="Argentina" data-alternative-spellings="AR">Argentina</option>
      <option value="Armenia" data-alternative-spellings="AM ????????">Armenia</option>
      <option value="Aruba" data-alternative-spellings="AW" data-relevancy-booster="0.5">Aruba</option>
      <option value="Australia" data-alternative-spellings="AU" data-relevancy-booster="1.5">Australia</option>
      <option value="Austria" data-alternative-spellings="AT �sterreich Osterreich Oesterreich ">Austria</option>
      <option value="Azerbaijan" data-alternative-spellings="AZ">Azerbaijan</option>
      <option value="Bahamas" data-alternative-spellings="BS">Bahamas</option>
      <option value="Bahrain" data-alternative-spellings="BH ???????">Bahrain</option>
      <option value="Bangladesh" data-alternative-spellings="BD ????????" data-relevancy-booster="2">Bangladesh</option>
      <option value="Barbados" data-alternative-spellings="BB">Barbados</option>
      <option value="Belarus" data-alternative-spellings="BY ????????">Belarus</option>
      <option value="Belgium" data-alternative-spellings="BE Belgi� Belgie Belgien Belgique" data-relevancy-booster="1.5">Belgium</option>
      <option value="Belize" data-alternative-spellings="BZ">Belize</option>
      <option value="Benin" data-alternative-spellings="BJ">Benin</option>
      <option value="Bermuda" data-alternative-spellings="BM" data-relevancy-booster="0.5">Bermuda</option>
      <option value="Bhutan" data-alternative-spellings="BT ?????">Bhutan</option>
      <option value="Bolivia" data-alternative-spellings="BO">Bolivia</option>
      <option value="Bonaire, Sint Eustatius and Saba" data-alternative-spellings="BQ">Bonaire, Sint Eustatius and Saba</option>
      <option value="Bosnia and Herzegovina" data-alternative-spellings="BA BiH Bosna i Hercegovina ????? ? ???????????">Bosnia and Herzegovina</option>
      <option value="Botswana" data-alternative-spellings="BW">Botswana</option>
      <option value="Bouvet Island" data-alternative-spellings="BV">Bouvet Island</option>
      <option value="Brazil" data-alternative-spellings="BR Brasil" data-relevancy-booster="2">Brazil</option>
      <option value="British Indian Ocean Territory" data-alternative-spellings="IO">British Indian Ocean Territory</option>
      <option value="Brunei Darussalam" data-alternative-spellings="BN">Brunei Darussalam</option>
      <option value="Bulgaria" data-alternative-spellings="BG ????????">Bulgaria</option>
      <option value="Burkina Faso" data-alternative-spellings="BF">Burkina Faso</option>
      <option value="Burundi" data-alternative-spellings="BI">Burundi</option>
      <option value="Cambodia" data-alternative-spellings="KH ???????">Cambodia</option>
      <option value="Cameroon" data-alternative-spellings="CM">Cameroon</option>
      <option value="Canada" data-alternative-spellings="CA" data-relevancy-booster="2">Canada</option>
      <option value="Cape Verde" data-alternative-spellings="CV Cabo">Cape Verde</option>
      <option value="Cayman Islands" data-alternative-spellings="KY" data-relevancy-booster="0.5">Cayman Islands</option>
      <option value="Central African Republic" data-alternative-spellings="CF">Central African Republic</option>
      <option value="Chad" data-alternative-spellings="TD ????? Tchad">Chad</option>
      <option value="Chile" data-alternative-spellings="CL">Chile</option>
      <option value="China" data-relevancy-booster="3.5" data-alternative-spellings="CN Zhongguo Zhonghua Peoples Republic ??/??">China</option>
      <option value="Christmas Island" data-alternative-spellings="CX" data-relevancy-booster="0.5">Christmas Island</option>
      <option value="Cocos (Keeling) Islands" data-alternative-spellings="CC" data-relevancy-booster="0.5">Cocos (Keeling) Islands</option>
      <option value="Colombia" data-alternative-spellings="CO">Colombia</option>
      <option value="Comoros" data-alternative-spellings="KM ??? ?????">Comoros</option>
      <option value="Congo" data-alternative-spellings="CG">Congo</option>
      <option value="Congo, the Democratic Republic of the" data-alternative-spellings="CD Congo-Brazzaville Repubilika ya Kongo">Congo, the Democratic Republic of the</option>
      <option value="Cook Islands" data-alternative-spellings="CK" data-relevancy-booster="0.5">Cook Islands</option>
      <option value="Costa Rica" data-alternative-spellings="CR">Costa Rica</option>
      <option value="C�te d'Ivoire" data-alternative-spellings="CI Cote dIvoire">C�te d'Ivoire</option>
      <option value="Croatia" data-alternative-spellings="HR Hrvatska">Croatia</option>
      <option value="Cuba" data-alternative-spellings="CU">Cuba</option>
      <option value="Cura�ao" data-alternative-spellings="CW Curacao">Cura�ao</option>
      <option value="Cyprus" data-alternative-spellings="CY ?????? K�pros K?br?s">Cyprus</option>
      <option value="Czech Republic" data-alternative-spellings="CZ ?esk� Ceska">Czech Republic</option>
      <option value="Denmark" data-alternative-spellings="DK Danmark" data-relevancy-booster="1.5">Denmark</option>
      <option value="Djibouti" data-alternative-spellings="DJ ??????? Jabuuti Gabuuti">Djibouti</option>
      <option value="Dominica" data-alternative-spellings="DM Dominique" data-relevancy-booster="0.5">Dominica</option>
      <option value="Dominican Republic" data-alternative-spellings="DO">Dominican Republic</option>
      <option value="Ecuador" data-alternative-spellings="EC">Ecuador</option>
      <option value="Egypt" data-alternative-spellings="EG" data-relevancy-booster="1.5">Egypt</option>
      <option value="El Salvador" data-alternative-spellings="SV">El Salvador</option>
      <option value="Equatorial Guinea" data-alternative-spellings="GQ">Equatorial Guinea</option>
      <option value="Eritrea" data-alternative-spellings="ER ?????? ????">Eritrea</option>
      <option value="Estonia" data-alternative-spellings="EE Eesti">Estonia</option>
      <option value="Ethiopia" data-alternative-spellings="ET ?????">Ethiopia</option>
      <option value="Falkland Islands (Malvinas)" data-alternative-spellings="FK" data-relevancy-booster="0.5">Falkland Islands (Malvinas)</option>
      <option value="Faroe Islands" data-alternative-spellings="FO F�royar F�r�erne" data-relevancy-booster="0.5">Faroe Islands</option>
      <option value="Fiji" data-alternative-spellings="FJ Viti ?????">Fiji</option>
      <option value="Finland" data-alternative-spellings="FI Suomi">Finland</option>
      <option value="France" data-alternative-spellings="FR R�publique fran�aise" data-relevancy-booster="2.5">France</option>
      <option value="French Guiana" data-alternative-spellings="GF">French Guiana</option>
      <option value="French Polynesia" data-alternative-spellings="PF Polyn�sie fran�aise">French Polynesia</option>
      <option value="French Southern Territories" data-alternative-spellings="TF">French Southern Territories</option>
      <option value="Gabon" data-alternative-spellings="GA R�publique Gabonaise">Gabon</option>
      <option value="Gambia" data-alternative-spellings="GM">Gambia</option>
      <option value="Georgia" data-alternative-spellings="GE ??????????">Georgia</option>
      <option value="Germany" data-alternative-spellings="DE Bundesrepublik Deutschland" data-relevancy-booster="3">Germany</option>
      <option value="Ghana" data-alternative-spellings="GH">Ghana</option>
      <option value="Gibraltar" data-alternative-spellings="GI" data-relevancy-booster="0.5">Gibraltar</option>
      <option value="Greece" data-alternative-spellings="GR ??????" data-relevancy-booster="1.5">Greece</option>
      <option value="Greenland" data-alternative-spellings="GL gr�nland" data-relevancy-booster="0.5">Greenland</option>
      <option value="Grenada" data-alternative-spellings="GD">Grenada</option>
      <option value="Guadeloupe" data-alternative-spellings="GP">Guadeloupe</option>
      <option value="Guam" data-alternative-spellings="GU">Guam</option>
      <option value="Guatemala" data-alternative-spellings="GT">Guatemala</option>
      <option value="Guernsey" data-alternative-spellings="GG" data-relevancy-booster="0.5">Guernsey</option>
      <option value="Guinea" data-alternative-spellings="GN">Guinea</option>
      <option value="Guinea-Bissau" data-alternative-spellings="GW">Guinea-Bissau</option>
      <option value="Guyana" data-alternative-spellings="GY">Guyana</option>
      <option value="Haiti" data-alternative-spellings="HT">Haiti</option>
      <option value="Heard Island and McDonald Islands" data-alternative-spellings="HM">Heard Island and McDonald Islands</option>
      <option value="Holy See (Vatican City State)" data-alternative-spellings="VA" data-relevancy-booster="0.5">Holy See (Vatican City State)</option>
      <option value="Honduras" data-alternative-spellings="HN">Honduras</option>
      <option value="Hong Kong" data-alternative-spellings="HK ??">Hong Kong</option>
      <option value="Hungary" data-alternative-spellings="HU Magyarorsz�g">Hungary</option>
      <option value="Iceland" data-alternative-spellings="IS Island">Iceland</option>
      <option value="India" data-alternative-spellings="IN ???? ??????? Hindustan" data-relevancy-booster="3">India</option>
      <option value="Indonesia" data-alternative-spellings="ID" data-relevancy-booster="2">Indonesia</option>
      <option value="Iran, Islamic Republic of" data-alternative-spellings="IR ?????">Iran, Islamic Republic of</option>
      <option value="Iraq" data-alternative-spellings="IQ ???????">Iraq</option>
      <option value="Ireland" data-alternative-spellings="IE �ire" data-relevancy-booster="1.2">Ireland</option>
      <option value="Isle of Man" data-alternative-spellings="IM" data-relevancy-booster="0.5">Isle of Man</option>
      <option value="Israel" data-alternative-spellings="IL ??????? ?????">Israel</option>
      <option value="Italy" data-alternative-spellings="IT Italia" data-relevancy-booster="2">Italy</option>
      <option value="Jamaica" data-alternative-spellings="JM">Jamaica</option>
      <option value="Japan" data-alternative-spellings="JP Nippon Nihon ??" data-relevancy-booster="2.5">Japan</option>
      <option value="Jersey" data-alternative-spellings="JE" data-relevancy-booster="0.5">Jersey</option>
      <option value="Jordan" data-alternative-spellings="JO ??????">Jordan</option>
      <option value="Kazakhstan" data-alternative-spellings="KZ ????????? ?????????">Kazakhstan</option>
      <option value="Kenya" data-alternative-spellings="KE">Kenya</option>
      <option value="Kiribati" data-alternative-spellings="KI">Kiribati</option>
      <option value="Korea, Democratic People's Republic of" data-alternative-spellings="KP North Korea">Korea, Democratic People's Republic of</option>
      <option value="Korea, Republic of" data-alternative-spellings="KR South Korea" data-relevancy-booster="1.5">Korea, Republic of</option>
      <option value="Kuwait" data-alternative-spellings="KW ??????">Kuwait</option>
      <option value="Kyrgyzstan" data-alternative-spellings="KG ??????????">Kyrgyzstan</option>
      <option value="Lao People's Democratic Republic" data-alternative-spellings="LA">Lao People's Democratic Republic</option>
      <option value="Latvia" data-alternative-spellings="LV Latvija">Latvia</option>
      <option value="Lebanon" data-alternative-spellings="LB ?????">Lebanon</option>
      <option value="Lesotho" data-alternative-spellings="LS">Lesotho</option>
      <option value="Liberia" data-alternative-spellings="LR">Liberia</option>
      <option value="Libyan Arab Jamahiriya" data-alternative-spellings="LY ?????">Libyan Arab Jamahiriya</option>
      <option value="Liechtenstein" data-alternative-spellings="LI">Liechtenstein</option>
      <option value="Lithuania" data-alternative-spellings="LT Lietuva">Lithuania</option>
      <option value="Luxembourg" data-alternative-spellings="LU">Luxembourg</option>
      <option value="Macao" data-alternative-spellings="MO">Macao</option>
      <option value="Macedonia, The Former Yugoslav Republic Of" data-alternative-spellings="MK ??????????">Macedonia, The Former Yugoslav Republic Of</option>
      <option value="Madagascar" data-alternative-spellings="MG Madagasikara">Madagascar</option>
      <option value="Malawi" data-alternative-spellings="MW">Malawi</option>
      <option value="Malaysia" data-alternative-spellings="MY">Malaysia</option>
      <option value="Maldives" data-alternative-spellings="MV">Maldives</option>
      <option value="Mali" data-alternative-spellings="ML">Mali</option>
      <option value="Malta" data-alternative-spellings="MT">Malta</option>
      <option value="Marshall Islands" data-alternative-spellings="MH" data-relevancy-booster="0.5">Marshall Islands</option>
      <option value="Martinique" data-alternative-spellings="MQ">Martinique</option>
      <option value="Mauritania" data-alternative-spellings="MR ???????????">Mauritania</option>
      <option value="Mauritius" data-alternative-spellings="MU">Mauritius</option>
      <option value="Mayotte" data-alternative-spellings="YT">Mayotte</option>
      <option value="Mexico" data-alternative-spellings="MX Mexicanos" data-relevancy-booster="1.5">Mexico</option>
      <option value="Micronesia, Federated States of" data-alternative-spellings="FM">Micronesia, Federated States of</option>
      <option value="Moldova, Republic of" data-alternative-spellings="MD">Moldova, Republic of</option>
      <option value="Monaco" data-alternative-spellings="MC">Monaco</option>
      <option value="Mongolia" data-alternative-spellings="MN Mong?ol ulus ?????? ???">Mongolia</option>
      <option value="Montenegro" data-alternative-spellings="ME">Montenegro</option>
      <option value="Montserrat" data-alternative-spellings="MS" data-relevancy-booster="0.5">Montserrat</option>
      <option value="Morocco" data-alternative-spellings="MA ??????">Morocco</option>
      <option value="Mozambique" data-alternative-spellings="MZ Mo�ambique">Mozambique</option>
      <option value="Myanmar" data-alternative-spellings="MM">Myanmar</option>
      <option value="Namibia" data-alternative-spellings="NA Namibi�">Namibia</option>
      <option value="Nauru" data-alternative-spellings="NR Naoero" data-relevancy-booster="0.5">Nauru</option>
      <option value="Nepal" data-alternative-spellings="NP ?????">Nepal</option>
      <option value="Netherlands" data-alternative-spellings="NL Holland Nederland" data-relevancy-booster="1.5">Netherlands</option>
      <option value="New Caledonia" data-alternative-spellings="NC" data-relevancy-booster="0.5">New Caledonia</option>
      <option value="New Zealand" data-alternative-spellings="NZ Aotearoa">New Zealand</option>
      <option value="Nicaragua" data-alternative-spellings="NI">Nicaragua</option>
      <option value="Niger" data-alternative-spellings="NE Nijar">Niger</option>
      <option value="Nigeria" data-alternative-spellings="NG Nijeriya Na�j�r��" data-relevancy-booster="1.5">Nigeria</option>
      <option value="Niue" data-alternative-spellings="NU" data-relevancy-booster="0.5">Niue</option>
      <option value="Norfolk Island" data-alternative-spellings="NF" data-relevancy-booster="0.5">Norfolk Island</option>
      <option value="Northern Mariana Islands" data-alternative-spellings="MP" data-relevancy-booster="0.5">Northern Mariana Islands</option>
      <option value="Norway" data-alternative-spellings="NO Norge Noreg" data-relevancy-booster="1.5">Norway</option>
      <option value="Oman" data-alternative-spellings="OM ????">Oman</option>
      <option value="Pakistan" data-alternative-spellings="PK ???????" data-relevancy-booster="2">Pakistan</option>
      <option value="Palau" data-alternative-spellings="PW" data-relevancy-booster="0.5">Palau</option>
      <option value="Palestinian Territory, Occupied" data-alternative-spellings="PS ??????">Palestinian Territory, Occupied</option>
      <option value="Panama" data-alternative-spellings="PA">Panama</option>
      <option value="Papua New Guinea" data-alternative-spellings="PG">Papua New Guinea</option>
      <option value="Paraguay" data-alternative-spellings="PY">Paraguay</option>
      <option value="Peru" data-alternative-spellings="PE">Peru</option>
      <option value="Philippines" data-alternative-spellings="PH Pilipinas" data-relevancy-booster="1.5">Philippines</option>
      <option value="Pitcairn" data-alternative-spellings="PN" data-relevancy-booster="0.5">Pitcairn</option>
      <option value="Poland" data-alternative-spellings="PL Polska" data-relevancy-booster="1.25">Poland</option>
      <option value="Portugal" data-alternative-spellings="PT Portuguesa" data-relevancy-booster="1.5">Portugal</option>
      <option value="Puerto Rico" data-alternative-spellings="PR">Puerto Rico</option>
      <option value="Qatar" data-alternative-spellings="QA ???">Qatar</option>
      <option value="R�union" data-alternative-spellings="RE Reunion">R�union</option>
      <option value="Romania" data-alternative-spellings="RO Rumania Roumania Rom�nia">Romania</option>
      <option value="Russian Federation" data-alternative-spellings="RU Rossiya ?????????? ??????" data-relevancy-booster="2.5">Russian Federation</option>
      <option value="Rwanda" data-alternative-spellings="RW">Rwanda</option>
      <option value="Saint Barth�lemy" data-alternative-spellings="BL St. Barthelemy">Saint Barth�lemy</option>
      <option value="Saint Helena" data-alternative-spellings="SH St.">Saint Helena</option>
      <option value="Saint Kitts and Nevis" data-alternative-spellings="KN St.">Saint Kitts and Nevis</option>
      <option value="Saint Lucia" data-alternative-spellings="LC St.">Saint Lucia</option>
      <option value="Saint Martin (French Part)" data-alternative-spellings="MF St.">Saint Martin (French Part)</option>
      <option value="Saint Pierre and Miquelon" data-alternative-spellings="PM St.">Saint Pierre and Miquelon</option>
      <option value="Saint Vincent and the Grenadines" data-alternative-spellings="VC St.">Saint Vincent and the Grenadines</option>
      <option value="Samoa" data-alternative-spellings="WS">Samoa</option>
      <option value="San Marino" data-alternative-spellings="SM RSM Repubblica">San Marino</option>
      <option value="Sao Tome and Principe" data-alternative-spellings="ST">Sao Tome and Principe</option>
      <option value="Saudi Arabia" data-alternative-spellings="SA ????????">Saudi Arabia</option>
      <option value="Senegal" data-alternative-spellings="SN S�n�gal">Senegal</option>
      <option value="Serbia" data-alternative-spellings="RS ?????? Srbija">Serbia</option>
      <option value="Seychelles" data-alternative-spellings="SC" data-relevancy-booster="0.5">Seychelles</option>
      <option value="Sierra Leone" data-alternative-spellings="SL">Sierra Leone</option>
      <option value="Singapore" data-alternative-spellings="SG Singapura  ??????????? ???????? ??????">Singapore</option>
      <option value="Sint Maarten (Dutch Part)" data-alternative-spellings="SX">Sint Maarten (Dutch Part)</option>
      <option value="Slovakia" data-alternative-spellings="SK Slovensk� Slovensko">Slovakia</option>
      <option value="Slovenia" data-alternative-spellings="SI Slovenija">Slovenia</option>
      <option value="Solomon Islands" data-alternative-spellings="SB">Solomon Islands</option>
      <option value="Somalia" data-alternative-spellings="SO ???????">Somalia</option>
      <option value="South Africa" data-alternative-spellings="ZA RSA Suid-Afrika">South Africa</option>
      <option value="South Georgia and the South Sandwich Islands" data-alternative-spellings="GS">South Georgia and the South Sandwich Islands</option>
      <option value="South Sudan" data-alternative-spellings="SS">South Sudan</option>
      <option value="Spain" data-alternative-spellings="ES Espa�a" data-relevancy-booster="2">Spain</option>
      <option value="Sri Lanka" data-alternative-spellings="LK ????? ???? ?????? Ceylon">Sri Lanka</option>
      <option value="Sudan" data-alternative-spellings="SD ???????">Sudan</option>
      <option value="Suriname" data-alternative-spellings="SR ?????? Sarnam Sranangron">Suriname</option>
      <option value="Svalbard and Jan Mayen" data-alternative-spellings="SJ" data-relevancy-booster="0.5">Svalbard and Jan Mayen</option>
      <option value="Swaziland" data-alternative-spellings="SZ weSwatini Swatini Ngwane">Swaziland</option>
      <option value="Sweden" data-alternative-spellings="SE Sverige" data-relevancy-booster="1.5">Sweden</option>
      <option value="Switzerland" data-alternative-spellings="CH Swiss Confederation Schweiz Suisse Svizzera Svizra" data-relevancy-booster="1.5">Switzerland</option>
      <option value="Syrian Arab Republic" data-alternative-spellings="SY Syria ?????">Syrian Arab Republic</option>
      <option value="Taiwan, Province of China" data-alternative-spellings="TW ?? ??">Taiwan, Province of China</option>
      <option value="Tajikistan" data-alternative-spellings="TJ ?????????? To�ikiston">Tajikistan</option>
      <option value="Tanzania, United Republic of" data-alternative-spellings="TZ">Tanzania, United Republic of</option>
      <option value="Thailand" data-alternative-spellings="TH ????????? Prathet Thai">Thailand</option>
      <option value="Timor-Leste" data-alternative-spellings="TL">Timor-Leste</option>
      <option value="Togo" data-alternative-spellings="TG Togolese">Togo</option>
      <option value="Tokelau" data-alternative-spellings="TK" data-relevancy-booster="0.5">Tokelau</option>
      <option value="Tonga" data-alternative-spellings="TO">Tonga</option>
      <option value="Trinidad and Tobago" data-alternative-spellings="TT">Trinidad and Tobago</option>
      <option value="Tunisia" data-alternative-spellings="TN ????">Tunisia</option>
      <option value="Turkey" data-alternative-spellings="TR T�rkiye Turkiye">Turkey</option>
      <option value="Turkmenistan" data-alternative-spellings="TM T�rkmenistan">Turkmenistan</option>
      <option value="Turks and Caicos Islands" data-alternative-spellings="TC" data-relevancy-booster="0.5">Turks and Caicos Islands</option>
      <option value="Tuvalu" data-alternative-spellings="TV" data-relevancy-booster="0.5">Tuvalu</option>
      <option value="Uganda" data-alternative-spellings="UG">Uganda</option>
      <option value="Ukraine" data-alternative-spellings="UA Ukrayina ???????">Ukraine</option>
      <option value="United Arab Emirates" data-alternative-spellings="AE UAE ????????">United Arab Emirates</option>
      <option value="United Kingdom" data-alternative-spellings="GB Great Britain England UK Wales Scotland Northern Ireland" data-relevancy-booster="2.5">United Kingdom</option>
      <option value="United States" data-relevancy-booster="3.5" data-alternative-spellings="US USA United States of America">United States</option>
      <option value="United States Minor Outlying Islands" data-alternative-spellings="UM">United States Minor Outlying Islands</option>
      <option value="Uruguay" data-alternative-spellings="UY">Uruguay</option>
      <option value="Uzbekistan" data-alternative-spellings="UZ ?????????? O'zbekstan O�zbekiston">Uzbekistan</option>
      <option value="Vanuatu" data-alternative-spellings="VU">Vanuatu</option>
      <option value="Venezuela" data-alternative-spellings="VE">Venezuela</option>
      <option value="Vietnam" data-alternative-spellings="VN Vi?t Nam" data-relevancy-booster="1.5">Vietnam</option>
      <option value="Virgin Islands, British" data-alternative-spellings="VG" data-relevancy-booster="0.5">Virgin Islands, British</option>
      <option value="Virgin Islands, U.S." data-alternative-spellings="VI" data-relevancy-booster="0.5">Virgin Islands, U.S.</option>
      <option value="Wallis and Futuna" data-alternative-spellings="WF" data-relevancy-booster="0.5">Wallis and Futuna</option>
      <option value="Western Sahara" data-alternative-spellings="EH ?????? ???????">Western Sahara</option>
      <option value="Yemen" data-alternative-spellings="YE ?????">Yemen</option>
      <option value="Zambia" data-alternative-spellings="ZM">Zambia</option>
      <option value="Zimbabwe" data-alternative-spellings="ZW">Zimbabwe</option>
    </select>
    <h5 id="loc"> </h5>
					</div>
				</div>
			</div>
                                    
                                    
                                    
            <a class="btn btn-success" id="btnnxt1">Next step</a>
         </div>
    </div>
  </div>
        <div style="display: none;" id="st2">
             
			   <div class="panel panel-default">
                            <div class="panel-heading"><h3 class="panel-title"><strong>Who is this public personality? </strong></h3>
                            </div>

                            <div class="panel-body">
                                <div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
                                            <textarea class="form-control" name="about" placeholder="What does the person do? Enter words separated by comma. Example Businessman, President of United States, Actor, Politician" required></textarea>
					<h5 id="abt"> </h5>
          </div>
				</div>
                                </div>   
                               
                                           
                                <a class="btn btn-success" id="btnnxt3">Prev step</a>
            <input type="submit" class="btn btn-success" value="submit">
                            </div>
                    
            <hr style="margin-top:10px;margin-bottom:10px;" >
                
		</div>
            
        
           
     </div>
         
  
            

    </form>
</div>
</div>
<script type="text/javascript">
    $( document ).ready(function() {
            $('#btnnxt1').click(function(){
          
                    if($('#first_name').val()=="" )
                    {
                         $('#fname').html('Please fill first name');
                         $('#first_name').focus();
                    }
                     else if($('#last_name').val()=="" )
                    {
                         $('#lname').html('Please fill last name');
                         $('#last_name').focus();
                    }
                     else if($("#gender").val()== "")
                    {    $('#sex').html('Please fill gender');
                         $('#gender').focus();
                    }
                    
                     else if($(".location").val() == "1" )
                    {
                         $('#loc').html('Please fill location');
                         $('#location').focus();
                    }
                    
                    else
                    {
                          $('#st1').hide();
                         $('#st2').show();
                        
                    }
                 
                });
                 $('#btnnxt3').click(function(){
                   $('#st2').hide();
                  $('#st1').show();
                });
    });
    </script>