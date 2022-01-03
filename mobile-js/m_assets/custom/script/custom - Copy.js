;
(function () {

    'use strict';

    function checkWidth() {
        $(".textResize").each(function(i){
            var len=$(this).text().length;
            if(len>30)
            {
                $(this).text($(this).text().substr(0,30)+'...');
            }
        });
    }
    
    var textResize = function (){

        $(".textResize").each(function(){
            $(this).data({originalTxt: $(this).text()});
        });   

        checkWidth();

    }

    var renderSelect2 = function(){
        
        $('.select2').select2({
            placeholder: "Enter option separated by comma. Feel free to select whatever you want. This information is confidential and will not be revealed to anyone.",
        });

        $('#describe_person_tag').select2({
            placeholder: "Enter option separated by comma. Feel free to select whatever you want. This information is confidential and will not be revealed to anyone.",
            allowClear: true
        });

    }

    $(window).resize(checkWidth);

    function bodyPadding (){

        var position = $('#includedHeader').offset();

        $('body').css('padding-top', position.top);

        $(window).resize(function () {
            $('body').css('padding-top', position.top);            
        });

    }

    var includeSection = function () {

        $("#includedHeader").load("templates/header.html");

    }    

    /* Set section size as window full */
    var fullHeight = function () {

        $('.js-fullheight').css('min-height', $(window).height());
        
        $(window).resize(function () {
            $('.js-fullheight').css('min-height', $(window).height());
        });

    }

    /* Set section size as window half */
    var halfHeight = function () {

        $('.js-halfheight').css('min-height', $(window).height()/2);
        
        $(window).resize(function () {
            $('.js-halfheight').css('min-height', $(window).height()/2);
        });

    }

    /* Centering div position */
    var centerPosition = function(){

        $('.centerAlign').each( function(index) {

            var container = this.closest('section').id;
            var content = $("#"+container+' .centerAlign');

            var containerHeight = $("#"+container).height();
            var contentHeight = content.height();

            var margin = (containerHeight - contentHeight) / 2;
            
            if(contentHeight <= containerHeight){

                content.css('margin-top', margin);
                
            }
            console.log(container+' '+content);

        });

        $(window).resize(function() {
            $('.centerAlign').each( function(index) {

                var container = this.closest('section').id;
                var content = $("#"+container+' .centerAlign');

                var containerHeight = $("#"+container).height();
                var contentHeight = content.height();

                var margin = (containerHeight - contentHeight) / 2;

                if(contentHeight <= containerHeight){

                    content.css('margin-top', margin);

                }                
                
            });
        });
    }

    /* Centering div position */
    var owlCarousel = function(){

        var owl = $(".owl-carousel");

        owl.owlCarousel({
            itemsCustom : [
                [0, 1],
                [450, 1],
                [600, 2],
                [700, 2],
                [1000, 3],
                [1200, ],
                [1400, 3],
                [1600, 3]
            ],
            pagination : false,
            paginationNumbers: false,
            dragBeforeAnimFinish : true,
            mouseDrag : true,
            touchDrag : true,
            autoPlay: 3000,

        });

        $(".owl-controls").hide();

        // Custom Navigation Events
        $(".next").click(function(){
            owl.trigger('owl.next');
        })
        $(".prev").click(function(){
            owl.trigger('owl.prev');
        })

        $('.innerHeight').css({height: $('figure.snip0057').innerHeight(), top: "10px" });
        $('.absolute.right').css('left',($(window).width() - $('.absolute.right').outerWidth()));
        $('.customNavigation a.btn').css('padding-top', $('figure.snip0057').innerHeight()/2)

        $(window).resize(function() {
            $('.innerHeight').css({height: $('figure.snip0057').innerHeight(), top: "10px" });
            $('.absolute.right').css('left',($(window).width() - $('.absolute.right').outerWidth()));
            $('.customNavigation a.btn').css('padding-top', $('figure.snip0057').innerHeight()/2)
        });

    }

    var typed = function(){

        $("#typed").typed({
            // strings: ["Typed.js is a <strong>jQuery</strong> plugin.", "It <em>types</em> out sentences.", "And then deletes them.", "Try it out!"],
            stringsElement: $('#typed-strings'),
            typeSpeed: 30,
            backDelay: 500,
            loop: false,
            contentType: 'html', // or text
            // defaults to false for infinite loop
            loopCount: false,            
        });

    }

    var erTabs = function(){
        //Vertical Tab
        $('#parentVerticalTab').easyResponsiveTabs({
            type: 'vertical', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            closed: false, // Start closed if in accordion view
            tabidentify: 'hor_1', // The tab groups identifier
        });
    }

    var loginBtn = function(){

        $(document).on('click', '#login', function(){

            $('#formHolder').hide();
            $('#loginForm').show("slide", { direction: "left" }, 30000);

        });
        
    }

    

    function loader(){
        var loader = $('#loader');

        loader.empty();

        loader.show();

        var circle = new Sonic({
 
            width: 50,
            height: 50,
            padding: 50,
         
            strokeColor: '#000',
         
            pointDistance: .01,
            stepsPerFrame: 3,
            trailLength: .7,
         
            step: 'fader',
         
            setup: function() {
                this._.lineWidth = 5;
            },
         
            path: [
                ['arc', 25, 25, 25, 0, 360]
            ]
         
        });
         
        circle.play();
         
        loader.append(circle.canvas);

        setTimeout(function(){ 
            loader.hide();
        }, 1000);

    }

    var profileHeader = function(){

        var pWidth = $(window).width();
        var pHeight = $(window).height();

        $("#profileHeader").width(pWidth);
        $("#profileHeader").height(pHeight/3);

        jQuery(document).on('ready resize orientationchange', function(){
            jQuery('#profileHeader').css('margin','0 auto');
        });

        $("#profileHeader").awesomeCloud({
            "size" : {
                "grid" : 1,
                "factor" : 3
            },
            "color" : {
                "background" : "#036"
            },
            "options" : {
                "color" : "random-light",
                "rotationRatio" : 0.5,
                "printMultiplier" : 3
            },
            "font" : "'Times New Roman', Times, serif",
            "shape" : "star"
        });

    }
    var progressBar = function(){
        $('.progress .progress-bar').css("width",
            function() {
                return $(this).attr("aria-valuenow") + "%";
            }
        )
    }

    

    /* ======================================== */
    var intro = function() {

        $(window).load(function(){

            memberhome();
            bodyPadding();

        });

    }

    

    

    $(document).on('click', '.navigationLink', function(){

        eval($(this).data('link')+"()");        

    });

    /* Load navigation page */
    function navigation(){

        var content = '';

        content = '<section>'+
            '<ul class="list-group navigationMenu">'+
                '<li class="list-group-item head">'+
                    '<div class="image pull-left">'+
                        '<a href="#" data-link="singleProfile" class="navigationLink">'+
                            '<i class="img xxs profpic" aria-label="Niloy Rahman" role="img" style="background-image: url(&quot;https://scontent-sin6-1.xx.fbcdn.net/v/t1.0-1/cp0/e15/q65/p43x43/14563379_815801831896423_7174246872104418935_n.jpg?efg=eyJpIjoidCJ9&amp;oh=b78e655fed019af4856013490ee01adc&amp;oe=58928665&quot;);" data-sigil="profile_image"></i>'+
                        '</a>'+
                    '</div>'+
                    '<div class="name pull-left horizontal-padding-sm vertical-padding-sm">'+
                        '<a href="#" data-link="singleProfile" class="navigationLink">'+
                            '<strong>Niloy Rahman</strong>'+
                        '</a>'+
                    '</div>'+
                    '<div class="clearfix"></div>'+
                '</li>'+
                '<li class="list-group-item">'+
                    '<a href="#" class="navigationLink" data-link="review"><i class="ion-compose navIcon"></i> Review</a>'+
                '</li>'+
                '<li class="list-group-item">'+
                    '<a href="#" class="navigationLink" data-link="invite"><i class="ion-android-add-circle navIcon navIcon"></i> Invite</a>'+
                '</li>'+
                '<li class="list-group-item">'+
                    '<a href="#" class="navigationLink" data-link="logout"><i class="ion-log-out navIcon"></i> Logout</a>'+
                '</li>'+
            '</ul>'+
        '</section>';        

        includePageContent(content);

    }

    /* Load member review page */
    function review(){

        var content = '';

        content = '<section>'+
            '<div class="container-fluid">'+
                '<div class="row">'+
                    '<div class="col-xs-12horizontal-margin-none">'+
                        '<div id="parentVerticalTab">'+
                            '<ul class="resp-tabs-list hor_1">'+
                                '<li><i class="ion-compose font-size-lg"></i> Write a  review</li>'+
                                '<li><i class="ion-help font-size-lg"></i> Ask for Review</li>'+
                                '<li><i class="ion-paper-airplane font-size-lg"></i> Reviews sent</li>'+
                                '<li><i class="ion-ios-download-outline font-size-lg"></i> Reviews received</li>'+
                                '<li><i class="ion-information font-size-lg"></i> Reviews requested</li>'+
                            '</ul>'+
                            '<div class="resp-tabs-container hor_1">'+
                                '<div>'+
                                    '<form action="" class="form">'+
                                        '<div class="form-group">'+
                                            '<label for="">Name of registered member or email address:</label>'+
                                            '<input name="email" class="required email find_user form-control userList" id="recommend-email" placeholder="Enter email" autocomplete="off" value="" type="email">'+
                                            '<div id="userList" class="absolute fullWidth white-bg"><ul></ul></div>'+
                                        '</div>'+
                                        '<div class="form-group">'+
                                            '<label for="">How is the person related to you?:</label>'+
                                            '<select name="relation" class="required form-control">'+
                                                '<option value="">Select One</option>'+                        
                                                '<option value="Friend">Friend</option>'+
                                                '<option value="Boyfriend">Boyfriend</option>'+
                                                '<option value="Girlfriend">Girlfriend</option>'+
                                                '<option value="Ex-Girlfriend">Ex-Girlfriend</option>'+
                                                '<option value="Ex-Boyfriend">Ex-Boyfriend</option>'+
                                                '<option value="Father">Father</option>'+
                                                '<option value="Mother">Mother</option>'+
                                                '<option value="Domestic Partner">Domestic Partner</option>'+
                                                '<option value="Step Father">Step Father</option>'+
                                                '<option value="Step Mother">Step Mother</option>'+
                                                '<option value="Neighbor">Neighbor</option>'+
                                                '<option value="Uncle">Uncle</option>'+
                                                '<option value="Aunt">Aunt</option>'+
                                                '<option value="Niece">Niece</option>'+
                                                '<option value="Nephew">Nephew</option>'+
                                                '<option value="Cousin">Cousin</option>'+
                                                '<option value="Sister">Sister</option>'+
                                                '<option value="Brother">Brother</option>'+
                                                '<option value="Grandfather">Grandfather</option>'+
                                                '<option value="Grandmother">Grandmother</option>'+
                                                '<option value="Grandson">Grandson</option>'+
                                                '<option value="Granddaughter">Granddaughter</option>'+
                                                '<option value="Daughter in law">Daughter in law</option>'+
                                                '<option value="Son in law">Son in law</option>'+
                                                '<option value="Sister in law">Sister in law</option>'+
                                                '<option value="Brother in law">Brother in law</option>'+
                                                '<option value="Mother in law">Mother in law</option>'+
                                                '<option value="Father in law">Father in law</option>'+
                                                '<option value="Stepsister">Stepsister</option>'+
                                                '<option value="Stepbrother">Stepbrother</option>'+
                                                '<option value="Stepson">Stepson</option>'+
                                                '<option value="Stepdaughter">Stepdaughter</option>'+
                                                '<option value="Husband">Husband</option>'+
                                                '<option value="Wife">Wife</option>'+
                                                '<option value="Co-Worker">Co-Worker</option>'+
                                                '<option value="Family Friend">Family Friend</option>'+                                                                    
                                            '</select>'+
                                        '</div>'+
                                        '<div class="form-group">'+
                                            '<label for="">Check the words that describe the person</label>'+
                                            '<select id="describe_person_tag" class="form-control" multiple>'+
                                                '<option value="Rude">Rude</option>'+
                                                '<option value="Selfish">Selfish</option>'+
                                                '<option value="Silly">Silly</option>'+
                                                '<option value="Shy">Shy</option>'+
                                                '<option value="Sweet">Sweet</option>'+
                                                '<option value="Social">Social</option>'+
                                                '<option value="Honest">Honest</option>'+
                                                '<option value="Generous">Generous</option>'+
                                                '<option value="Lazy">Lazy</option>'+
                                                '<option value="Mean">Mean</option>'+
                                                '<option value="Materialistic">Materialistic</option>'+
                                                '<option value="Moody">Moody</option>'+
                                                '<option value="Courteous">Courteous</option>'+
                                                '<option value="Sensitive">Sensitive</option>'+
                                                '<option value="Miser">Miser</option>'+
                                            '</select>'+
                                         '</div>'+
                                        '<div class="form-group">'+
                                            '<label for="">Detail review:</label>'+
                                            '<textarea class="required form-control" id="message" name="message" rows="6" placeholder="Please describe the person you are reviewing. Example: Good habits, bad habits, your experiences etc."></textarea>'+
                                        '</div>'+

                                        '<button type="submit" onclick="myfunction()" class="btn btn-transparent secondary-bg white-text">Review Publicly</button>'+

                                        ' or '+

                                        '<button type="submit" onclick="myfunction1();" class="btn btn-transparent primary-bg white-text">Review Anonymously</button>'+
                                    '</form>'+
                                '</div>'+
                                '<div>'+
                                    '<form action="" class="form">'+
                                        '<div class="form-group">'+
                                            '<label for="">Name of registered member or email address:</label>'+
                                            '<input name="email" class="required email find_user form-control userList" id="recommend-email" placeholder="Enter email" autocomplete="off" value="" type="email">'+
                                            '<div id="userList" class="absolute fullWidth white-bg"><ul></ul></div>'+
                                        '</div>'+
                                        '<div class="form-group">'+
                                            '<label for="">Name of registered member or email address:</label>'+
                                            '<textarea class="form-control" placeholder="Remind how good you are so that you get a great review!"></textarea>'+
                                        '</div>'+
                                        '<button type="submit" onclick="myfunction()" class="btn btn-transparent secondary-bg white-text">Submit</button>'+
                                    '</form>'+    
                                '</div>'+
                                '<div>'+
                                    'Lorem consectetur adipiscing elit. Vestibulum nibh urna, euismod ut ornare non, volutpat vel tortor. Integer laoreet placerat suscipit. Sed sodales scelerisque commodo. Nam porta cursus lectus. Proin nunc erat, gravida a facilisis quis, ornare id lectus. Proin consectetur nibh quis.'+
                                    '<br>'+
                                    '<br>'+
                                    '<p>Tab 2 Container</p>'+
                                '</div>'+
                                '<div>'+
                                    'Lorem consectetur adipiscing elit. Vestibulum nibh urna, euismod ut ornare non, volutpat vel tortor. Integer laoreet placerat suscipit. Sed sodales scelerisque commodo. Nam porta cursus lectus. Proin nunc erat, gravida a facilisis quis, ornare id lectus. Proin consectetur nibh quis.'+
                                    '<br>'+
                                    '<br>'+
                                    '<p>Tab 2 Container</p>'+
                                '</div>'+
                                '<div>'+
                                    'Lorem consectetur adipiscing elit. Vestibulum nibh urna, euismod ut ornare non, volutpat vel tortor. Integer laoreet placerat suscipit. Sed sodales scelerisque commodo. Nam porta cursus lectus. Proin nunc erat, gravida a facilisis quis, ornare id lectus. Proin consectetur nibh quis.'+
                                    '<br>'+
                                    '<br>'+
                                    '<p>Tab 2 Container</p>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
            '</div>'+
        '</section>';        
        
        includePageContent(content);
        erTabs();

        renderSelect2();

    }

    /* friends */
    function friends(){
        
    }

    

    

    


    /* Load member profile detail info */
    function singleProfile(){

        var content = '<section>'+
            '<div id="profileHeaderWrap">'+
                '<div id="profileHeader" class="wordcloud">'+
                    '<span data-weight="18">Sweet</span>'+
                    '<span data-weight="18">Rude</span>'+
                    '<span data-weight="18">Silly</span>'+
                    '<span data-weight="18">Social</span>'+
                    '<span data-weight="18">Charismatic</span>'+
                    '<span data-weight="18">Optimist</span>'+
                    '<span data-weight="18">Thoughtful</span>'+
                    '<span data-weight="18">Smart</span>'+
                    '<span data-weight="18">Materialistic</span>'+
                    '<span data-weight="18">Generous</span>'+
                    '<span data-weight="18">Mean</span>'+
                    '<span data-weight="18">Ambitious</span>'+
                    '<span data-weight="18">Egotistical</span>'+
                    '<span data-weight="18">Friendly</span>'+
                    '<span data-weight="18">Honest</span>'+
                    '<span data-weight="18">Courteous</span>'+
                    '<span data-weight="18">Affectionate</span>'+
                    '<span data-weight="18">Respectful</span>'+
                    '<span data-weight="18">Funny</span>'+
                    '<span data-weight="18">Courageous</span>'+
                    '<span data-weight="18">Dependable</span>'+
                    '<span data-weight="18">Joyful</span>'+
                    '<span data-weight="18">Sympathetic</span>'+
                    '<span data-weight="18">Considerate</span>'+
                    '<span data-weight="18">Lazy</span>'+
                    '<span data-weight="18">Bossy</span>'+
                '</div>'+
            '</div>'+
            '<div class="profileImage">'+
                '<i class="img _42b6 _403j profpic" aria-label="Hasib Bin Siddique Refat" role="img" style="background-image: url(&quot;https://scontent-sin6-1.xx.fbcdn.net/v/t1.0-1/cp0/e15/q65/p120x120/14463101_1323824020975792_792117672594284141_n.jpg?efg=eyJpIjoidCJ9&amp;oh=62d3d8d268de6ac3ff24437cf2d31548&amp;oe=5894EE31&quot;);"></i>'+
            '</div>'+
            
            '<h3 class="text-center">Hasib Bin Siddique</h3>'+

            '<div class="profileNav">'+
                '<div class="container-fluid">'+
                    '<ul class="row">'+
                        '<li class="col-xs-4">'+
                            '<i class="ion-email"></i><br>'+
                            'Message'+
                        '</li>'+
                        '<li class="col-xs-4">'+
                            '<i class="ion-person-add"></i><br>'+
                            'Request'+
                        '</li>'+
                        '<li class="col-xs-4">'+
                            '<i class="ion-android-star-half"></i><br>'+
                            'Review'+
                        '</li>'+
                    '</ul>'+
                '</div>'+
            '</div>'+

            '<div class="jumbotron progress_status">'+
                '<div class="container-fluid">'+
                    '<div class="progress skill-bar">'+
                        '<div class="progress-bar primary-bg progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" >'+
                            '<span class="skill">Social percentile<i class="val">90%</i></span>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
            '</div>'+

            '<div id="profileInfo">'+
                '<table class="table">'+
                    '<tbody>'+          
                        '<tr>'+
                            '<td><i class="fa fa-intersex"></i> Gender</td>'+
                            '<td>Male</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td><i class="fa fa-venus-mars"></i> Phase of life</td>'+
                            '<td>Hanging out with someone</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td><i class="ion-university"></i> Education</td>'+
                            '<td>Harvard University</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td><i class="ion-briefcase"></i> Work at</td>'+
                            '<td>Callitme</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td><i class="ion-ios-world-outline"></i> Website</td>'+
                            '<td>www.ashshrivastav.com</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td><i class="ion-ios-home"></i> From</td>'+
                            '<td>Cambridge, MA, United States</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td><i class="ion-location"></i> Live</td>'+
                            '<td>San Francisco, CA, United States</td>'+
                        '</tr>'+
                    '</tbody>'+
                    '<tfoot>    '+                  
                        '<tr>'+
                            '<th colspan="2" class="text-center">I am a nice guy! Review me as a nice guy please please !</th>'+
                        '</tr>'+
                    '</tfoot>'+
                '</table>'+         
            '</div>'+

            '<div class="profileNav">'+
                '<div class="container-fluid">'+
                    '<ul class="row">'+
                        '<li class="col-xs-4">'+
                            '<a class="btn icon-btn btn-transparent btn-md marBottom5" href="#"><span class="badge">61</span> Friends</a>'+
                        '</li>'+
                        '<li class="col-xs-4">'+
                            '<a class="btn icon-btn btn-transparent btn-md marBottom5" href="#"><span class="badge">11</span> Review</a>'+
                        '</li>'+
                        '<li class="col-xs-4">'+
                            '<a class="btn icon-btn btn-transparent btn-md marBottom5" href="#"><span class="badge">2</span> Mutual</a>'+
                        '</li>'+
                    '</ul>'+
                '</div>'+
            '</div>'+

            '<div id="profileReview">'+     
                '<div class="container-fluid">'+
                    '<div class="row">'+
                        '<div class="col-xs-12=">'+
                            '<div class="carousel slide" data-ride="carousel" id="quote-carousel">'+
                                '<div class="carousel-inner">'+
                            
                                    '<div class="item active">'+
                                        '<blockquote>'+
                                            '<div class="row">'+
                                                '<div class="col-xs-12 text-center">'+
                                                    '<div class="image lg">'+
                                                        '<i class="img _42b6 _403j profpic border-radius-50" aria-label="Hasib Bin Siddique Refat" role="img" style="background-image: url(&quot;https://scontent-sin6-1.xx.fbcdn.net/v/t1.0-1/cp0/e15/q65/p120x120/14463101_1323824020975792_792117672594284141_n.jpg?efg=eyJpIjoidCJ9&amp;oh=62d3d8d268de6ac3ff24437cf2d31548&amp;oe=5894EE31&quot;);"></i>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="row">'+
                                                '<div class="col-xs-12">'+
                                                    '<p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit!</p>'+
                                                    '<small>'+
                                                        'Someone famous<br>'+
                                                        '(Ash is Pranay singh`s Friend)<br>'+
                                                         'Reviewed On: 23rd Jul'+
                                                    '</small>'+
                                                '</div>'+
                                            '</div>'+
                                        '</blockquote>'+
                                    '</div>'+

                                    '<div class="item">'+
                                        '<blockquote>'+
                                            '<div class="row">'+
                                                '<div class="col-xs-12 text-center">'+
                                                    '<div class="image lg">'+
                                                        '<i class="img _42b6 _403j profpic border-radius-50" aria-label="Hasib Bin Siddique Refat" role="img" style="background-image: url(&quot;https://scontent-sin6-1.xx.fbcdn.net/v/t1.0-1/cp0/e15/q65/p120x120/14463101_1323824020975792_792117672594284141_n.jpg?efg=eyJpIjoidCJ9&amp;oh=62d3d8d268de6ac3ff24437cf2d31548&amp;oe=5894EE31&quot;);"></i>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="row">'+
                                                '<div class="col-xs-12">'+
                                                    '<p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit!</p>'+
                                                    '<small>'+
                                                        'Someone famous<br>'+
                                                        '(Ash is Pranay singh`s Friend)<br>'+
                                                         'Reviewed On: 23rd Jul'+
                                                    '</small>'+
                                                '</div>'+
                                            '</div>'+
                                        '</blockquote>'+
                                    '</div>'+

                                    '<div class="item">'+
                                        '<blockquote>'+
                                            '<div class="row">'+
                                                '<div class="col-xs-12 text-center">'+
                                                    '<div class="image lg">'+
                                                        '<i class="img _42b6 _403j profpic border-radius-50" aria-label="Hasib Bin Siddique Refat" role="img" style="background-image: url(&quot;https://scontent-sin6-1.xx.fbcdn.net/v/t1.0-1/cp0/e15/q65/p120x120/14463101_1323824020975792_792117672594284141_n.jpg?efg=eyJpIjoidCJ9&amp;oh=62d3d8d268de6ac3ff24437cf2d31548&amp;oe=5894EE31&quot;);"></i>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="row">'+    
                                                '<div class="col-xs-12">'+
                                                    '<p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit!</p>'+
                                                    '<small>'+
                                                        'Someone famous<br>'+
                                                        '(Ash is Pranay singh`s Friend)<br>'+
                                                         'Reviewed On: 23rd Jul'+
                                                    '</small>'+
                                                '</div>'+
                                            '</div>'+
                                        '</blockquote>'+
                                    '</div>'+
                            
                            '<a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>'+
                            '<a data-slide="next" href="#quote-carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>'+
                        '</div>'+                          
                    '</div>'+
                '</div>'+
            '</div>'+
        '</section>';

        includePageContent(content);

        /* Load profile header setting */
        profileHeader();    

        /* Load profile progress bar */    
        progressBar();

    }

    

    /* New message compose event */
    var composeMsg = function(){

        $(document).on('click', '#composeMsg', function(){
            alert('aaa');
        });

    }

    /* Load single message page */
    

    /* Load new message page */
    function newmessage(){

        var content = '';

        content += '<form action="" class="form newmessage">'+
            '<section id="msgHeader" class="default-bg fullWidth">'+
               '<div class="container-fluid">'+
                    '<div class="row">'+
                        '<div class="col-xs-10">'+
                            '<a href="#" class="navigationLink pull-left" style="margin-top:12px" data-link="message">'+
                                '<i class="ion-close"></i>'+
                            '</a>'+
                            '<h4 class="section-title horizontal-margin-sm pull-left">'+
                                'New Message'+
                            '</h4>'+
                        '</div>'+
                        '<div class="col-xs-2 pull-right text-right">'+
                            '<a href="">'+
                                '<h4>'+
                                    '<i class="ion-paper-airplane"></i>'+
                                '</h4>'+
                            '</a>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
            '</section>'+
            '<section>'+
                '<div class="container-fluid">'+
                    '<div class="row">'+
                        '<div class="col-sm-12 horizontal-padding-none">'+
                            '<div class="form-group vertical-margin-none">'+
                                '<input class="form-control userList" placeholder="To:">'+
                                '<div id="userList" class="absolute fullWidth white-bg"><ul></ul></div>'+
                            '</div>'+
                            '<div class="form-group vertical-margin-none">'+
                                '<textarea class="form-control" rows="3" placeholder="Write a message"></textarea>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
            '</section>'+
        '</form>';

        includePageContent(content);

    }

    /* append content in page */
    function includePageContent(content){

        $("#includePageContent").empty();
        $("#includePageContent").html(content);

    }

    /* user list event */
    $(document).on('click', '.userList', function(){

        $('#userList ul').empty();

        var list = [{"user_img":":\/\/placehold.it\/43x43","name":"Hasib Bin Siddique"},{"user_img":":\/\/placehold.it\/43x43","name":"Niloy Rahman"},{"user_img":":\/\/placehold.it\/43x43","name":"Siddique Jubayer"}];
        
        $.each(list, function (index, obj){
            $('#userList ul').append('<li data-name="'+obj.name+'"><div class="image"><i class="img xs profpic" style="background-image: url("'+obj.user_img+'")></i></div><div class="content">'+obj.name+'</div><div class="clearfix"></div></li>')
        });

    });

    /* user list inner event */
    $(document).on('click', '#userList ul li', function(){
        
        $('.userList').val($(this).data('name'))
        $('#userList ul').empty();

    });    

    // Document on load.
    $(function () {
        bodyPadding();
        textResize();
        intro();
        includeSection();
        fullHeight();
        halfHeight();
        centerPosition();
        owlCarousel();
        typed();
        loginBtn();
    });


}());


