<style type="text/css">
  #map-container {
    border-top:1px solid #096369;
    padding: 15px;
    width: 100%;
  }
  
  #map-container img { max-width:none; }

  #map {
    width: 100%;
    height: 400px;
  }
  .info-content {
    float: left;
    margin-left: 10px;
  }

  .info-content h5 {
    margin:0px;
  }
</style>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo Kohana::$config->load('settings')->get('location_api_key'); ?>&libraries=places"></script>
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
<!--<script type="text/javascript" src="<?php echo url::base();?>js/markerclusterer_compiled.js"></script>
-->
<script type="text/javascript">
    var data = <?php print_r(json_encode($mapusers));?>;
    var userlat = <?php echo $userlat;?>;
    var userlong = <?php echo $userlong;?>;
    
    function getInfoContent(user) {
        var contentString = '<div id="info'+user.id+'" class="mapInfo">'+
            '<a href="'+user.url+'" class="pull-left">'+
            '<img src="'+user.image+'" class="img-rounded pull-left">' +
            '</a>'+
            '<div class="info-content">'+
            '<h5>'+user.name+'</h5>'+
            '<p>'+user.age+', '+user.gender+'</p>';
      
        if(user.friend == 'not_friends') {
            contentString = contentString + '<p><a href="'+user.friend_url+'" class="map_add_friend">Add as Friend</a></p>';
        } else if(user.friend == 'friend') {
            contentString = contentString + '<p><i class="icon-ok"></i> Friend</p>';
        } else if(user.friend == 'request_received') {
            contentString = contentString + '<p><i class="icon-ok"></i> Request Received</p>';
        } else if(user.friend == 'request_sent') {
            contentString = contentString + '<p><i class="icon-ok"></i> Request Sent</p>';
        }
      
        contentString = contentString + '<p><a href="'+user.recommend_url+'" >Review</a> | '+
        '<a href="'+user.message_url+'" >Send Message</a> | '+
        '<a href="'+user.request_url+'" >Send Request</a></p>'+
        '</div>';
        return contentString;
    }

    var infowindow = null;
    function initialize() {
        var center = new google.maps.LatLng(userlat, userlong);

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 3,
            center: center,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        infowindow = new google.maps.InfoWindow({
            content: "holding..."
        });

        var markers = [];
        for (var i = 0; i < data.count; i++) {
            var dataUser = data.users[i];
            var latLng = new google.maps.LatLng(dataUser.lat,
                dataUser.long);
            var marker = new google.maps.Marker({
                position: latLng,
                html: getInfoContent(dataUser)
            });


            google.maps.event.addListener(marker, 'click', function() {
                infowindow.setContent(this.html);
                infowindow.open(map,this);
            });

            markers.push(marker);
        }
        var markerCluster = new MarkerClusterer(map, markers);
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>

<div class="main-content-up-block">
    <div class="feeds-post">
     
            <legend><h4>Search for people around you</h4></legend>
            
            <form role="form" method="post" class="form-inline validate-form">
				<div class="form-group">
					Living within (miles):
				</div>
                <div class="form-group">
                    <input class="required form-control" id="radius" type="text" value="<?php echo Request::current()->post('radius') ? Request::current()->post('radius') : 50 ?>"  name="radius">
                </div>
                
                <button type="submit" class="btn" style="background-color:#fafafa;color: #ff2a7f;border: 1px solid #ff2a7f;width: 100%;">Search</button>
            </form>
        
    </div>
</div>

<div id="map-container"><div id="map"></div></div>
