setTimeout(function(){

    var Accordion = function(el, multiple) {
        this.el = el || {};
        this.multiple = multiple || false;

        // Variables privadas
        var links = this.el.find('.link');
        // Evento
        links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
    }

    Accordion.prototype.dropdown = function(e) {
        var $el = e.data.el;
            $this = $(this),
            $next = $this.next();

        $next.slideToggle();
        $this.parent().toggleClass('open');

        if (!e.data.multiple) {
            $el.find('.submenu').not($next).slideUp().parent().removeClass('open');
        };
    }   

    var accordion = new Accordion($('#accordion'), false); 

    profileHeader();
    progressInfo();
    loadGoogleMapAPI();

}, 500);    

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

function loadMap(){
    initMap();
}

var map;
function initMap() {
    var myLatLng = {lat: 36.2412889, lng: -113.7553377};

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 4,
      center: myLatLng
    });

    var marker = new google.maps.Marker({
      position: myLatLng,
      map: map,
      title: 'Hello World!'
    });
}


// // $(function() {
// //     var Accordion = function(el, multiple) {
// //         this.el = el || {};
// //         this.multiple = multiple || false;

// //         // Variables privadas
// //         var links = this.el.find('.link');
// //         // Evento
// //         links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
// //     }

// //     Accordion.prototype.dropdown = function(e) {
// //         var $el = e.data.el;
// //             $this = $(this),
// //             $next = $this.next();

// //         $next.slideToggle();
// //         $this.parent().toggleClass('open');

// //         if (!e.data.multiple) {
// //             $el.find('.submenu').not($next).slideUp().parent().removeClass('open');
// //         };
// //     }   

// //     var accordion = new Accordion($('#accordion'), false);
// // });

// ;
// (function () {

//     'use strict';

//      var profileHeader = function(){

//         // var cTag = '<div id="profileHeader" class="wordcloud">'+
//         //     '<span data-weight="18">Sweet</span>'+
//         //     '<span data-weight="18">Rude</span>'+
//         //     '<span data-weight="18">Silly</span>'+
//         //     '<span data-weight="18">Social</span>'+
//         //     '<span data-weight="18">Charismatic</span>'+
//         //     '<span data-weight="18">Optimist</span>'+
//         //     '<span data-weight="18">Thoughtful</span>'+
//         //     '<span data-weight="18">Smart</span>'+
//         //     '<span data-weight="18">Materialistic</span>'+
//         //     '<span data-weight="18">Generous</span>'+
//         //     '<span data-weight="18">Mean</span>'+
//         //     '<span data-weight="18">Ambitious</span>'+
//         //     '<span data-weight="18">Egotistical</span>'+
//         //     '<span data-weight="18">Friendly</span>'+
//         //     '<span data-weight="18">Honest</span>'+
//         //     '<span data-weight="18">Courteous</span>'+
//         //     '<span data-weight="18">Affectionate</span>'+
//         //     '<span data-weight="18">Respectful</span>'+
//         //     '<span data-weight="18">Funny</span>'+
//         //     '<span data-weight="18">Courageous</span>'+
//         //     '<span data-weight="18">Dependable</span>'+
//         //     '<span data-weight="18">Joyful</span>'+
//         //     '<span data-weight="18">Sympathetic</span>'+
//         //     '<span data-weight="18">Considerate</span>'+
//         //     '<span data-weight="18">Lazy</span>'+
//         //     '<span data-weight="18">Bossy</span>'+
//         // '</div>';

//         var pWidth = $(window).width();
//         var pHeight = $(window).height();

//         $("#profileHeader").width(pWidth);
//         $("#profileHeader").height(pHeight/3);

//         jQuery(document).on('ready resize orientationchange', function(){
//             jQuery('#profileHeader').css('margin','0 auto');
//         });

//         $("#profileHeader").awesomeCloud({
//             "size" : {
//                 "grid" : 1,
//                 "factor" : 3
//             },
//             "color" : {
//                 "background" : "#036"
//             },
//             "options" : {
//                 "color" : "random-light",
//                 "rotationRatio" : 0.5,
//                 "printMultiplier" : 3
//             },
//             "font" : "'Times New Roman', Times, serif",
//             "shape" : "star"
//         });

//         //$('#profileHeaderWrap').html(cTag);

//     }

//     var progressBar = function(){
//         $('.progress .progress-bar').css("width",
//             function() {
//                 return $(this).attr("aria-valuenow") + "%";
//             }
//         )
//     } 

//     // Document on load.
//     $(function () {
//         profileHeader();    
//         progressBar();
//     });


// }());