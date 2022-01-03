<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12horizontal-margin-none">
                <div id="parentVerticalTab">
                    <ul class="resp-tabs-list hor_1 text-center">
                        <li><i class="ion-compose font-size-lg pull-left"></i> Write a  review</li>
                        <li><i class="ion-help font-size-lg pull-left"></i> Ask for Review</li>
                        <li><i class="ion-paper-airplane font-size-lg pull-left"></i> Reviews sent</li>
                        <li><i class="ion-ios-download-outline font-size-lg pull-left pull-left"></i> Reviews received</li>
                        <li><i class="ion-information font-size-lg pull-left"></i> Reviews requested</li>
                    </ul>
                    <div class="resp-tabs-container hor_1">
                        <div>
                            <form id="writeReview" action="" class="form">
                                <div class="form-group">
                                    <label for="">Name of registered member or email address:</label>
                                    <input name="email" class="required email find_user form-control userList" id="recommend-email" placeholder="Enter email" autocomplete="off" value="" type="email">
                                    <div id="userList" class="absolute fullWidth white-bg" style="z-index: 1"></div>
                                </div>
                                <div class="form-group">
                                    <label for="">How is the person related to you?:</label>
                                    <select name="relation" id="recommend-relation" class="required form-control">
                                        <option value="">Select One</option>                        
                                        <option value="Friend">Friend</option>
                                        <option value="Boyfriend">Boyfriend</option>
                                        <option value="Girlfriend">Girlfriend</option>
                                        <option value="Ex-Girlfriend">Ex-Girlfriend</option>
                                        <option value="Ex-Boyfriend">Ex-Boyfriend</option>
                                        <option value="Father">Father</option>
                                        <option value="Mother">Mother</option>
                                        <option value="Domestic Partner">Domestic Partner</option>
                                        <option value="Step Father">Step Father</option>
                                        <option value="Step Mother">Step Mother</option>
                                        <option value="Neighbor">Neighbor</option>
                                        <option value="Uncle">Uncle</option>
                                        <option value="Aunt">Aunt</option>
                                        <option value="Niece">Niece</option>
                                        <option value="Nephew">Nephew</option>
                                        <option value="Cousin">Cousin</option>
                                        <option value="Sister">Sister</option>
                                        <option value="Brother">Brother</option>
                                        <option value="Grandfather">Grandfather</option>
                                        <option value="Grandmother">Grandmother</option>
                                        <option value="Grandson">Grandson</option>
                                        <option value="Granddaughter">Granddaughter</option>
                                        <option value="Daughter in law">Daughter in law</option>
                                        <option value="Son in law">Son in law</option>
                                        <option value="Sister in law">Sister in law</option>
                                        <option value="Brother in law">Brother in law</option>
                                        <option value="Mother in law">Mother in law</option>
                                        <option value="Father in law">Father in law</option>
                                        <option value="Stepsister">Stepsister</option>
                                        <option value="Stepbrother">Stepbrother</option>
                                        <option value="Stepson">Stepson</option>
                                        <option value="Stepdaughter">Stepdaughter</option>
                                        <option value="Husband">Husband</option>
                                        <option value="Wife">Wife</option>
                                        <option value="Co-Worker">Co-Worker</option>
                                        <option value="Family Friend">Family Friend</option>               
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Check the words that describe the person</label>
                                    <select id="describe_person_tag" name="words[]" class="form-control" multiple>
                                        <option value="Rude">Rude</option>
                                        <option value="Selfish">Selfish</option>
                                        <option value="Silly">Silly</option>
                                        <option value="Shy">Shy</option>
                                        <option value="Sweet">Sweet</option>
                                        <option value="Social">Social</option>
                                        <option value="Honest">Honest</option>
                                        <option value="Generous">Generous</option>
                                        <option value="Lazy">Lazy</option>
                                        <option value="Mean">Mean</option>
                                        <option value="Materialistic">Materialistic</option>
                                        <option value="Moody">Moody</option>
                                        <option value="Courteous">Courteous</option>
                                        <option value="Sensitive">Sensitive</option>
                                        <option value="Miser">Miser</option>
                                    </select>
                                 </div>
                                <div class="form-group">
                                    <label for="">Detail review:</label>
                                    <textarea class="required form-control" id="recommend-message" name="message" rows="6" placeholder="Please describe the person you are reviewing. Example: Good habits, bad habits, your experiences etc."></textarea>
                                </div>

                                <button type="submit" class="btn btn-transparent btn-block secondary-bg white-text reviewPublicly">Review Publicly</button>

                                <div class="row text-center clearfix"> or </div>

                                <button type="submit" class="btn btn-transparent btn-block primary-bg white-text reviewAnonymously">Review Anonymously</button>
                            </form>
                        </div>
                        <div>
                            <form action="" class="form">
                                <div class="form-group">
                                    <label for="">Name of registered member or email address:</label>
                                    <input name="email" class="required email find_user form-control userList" id="recommend-email" placeholder="Enter email" autocomplete="off" value="" type="email">
                                    <div id="userList" class="absolute fullWidth white-bg"><ul></ul></div>
                                </div>
                                <div class="form-group">
                                    <label for="">Name of registered member or email address:</label>
                                    <textarea class="form-control" placeholder="Remind how good you are so that you get a great review!"></textarea>
                                </div>
                                <button type="submit" onclick="myfunction()" class="btn btn-transparent secondary-bg white-text">Submit</button>
                            </form>    
                        </div>
                        <div>
                            'Lorem consectetur adipiscing elit. Vestibulum nibh urna, euismod ut ornare non, volutpat vel tortor. Integer laoreet placerat suscipit. Sed sodales scelerisque commodo. Nam porta cursus lectus. Proin nunc erat, gravida a facilisis quis, ornare id lectus. Proin consectetur nibh quis.'+
                            <br>
                            <br>
                            <p>Tab 2 Container</p>
                        </div>
                        <div>
                            'Lorem consectetur adipiscing elit. Vestibulum nibh urna, euismod ut ornare non, volutpat vel tortor. Integer laoreet placerat suscipit. Sed sodales scelerisque commodo. Nam porta cursus lectus. Proin nunc erat, gravida a facilisis quis, ornare id lectus. Proin consectetur nibh quis.'+
                            <br>
                            <br>
                            <p>Tab 2 Container</p>
                        </div>
                        <div>
                            'Lorem consectetur adipiscing elit. Vestibulum nibh urna, euismod ut ornare non, volutpat vel tortor. Integer laoreet placerat suscipit. Sed sodales scelerisque commodo. Nam porta cursus lectus. Proin nunc erat, gravida a facilisis quis, ornare id lectus. Proin consectetur nibh quis.'+
                            <br>
                            <br>
                            <p>Tab 2 Container</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>