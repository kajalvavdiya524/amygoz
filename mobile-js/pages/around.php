<style>
  /* Always set the map height explicitly to define the size of the div
   * element that contains the map. */
  #map {
    height: 100%;
  }
  /* Optional: Makes the sample page fill the window. */
  html, body {
    height: 100%;
    margin: 0;
    padding: 0;
  }
</style>

<section>
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12">
        <div class="input-group input-group-sm custom-search-form" style="padding: 5px">
          <input type="text" name="radius" id="radius" class="form-control" placeholder="Search for people around you">
          <span class="input-group-btn">
            <button class="btn btn-primary" type="button" id="getPeopleAround">
              <span class="glyphicon glyphicon-search"></span>
            </button>
          </span>
        </div><!-- /input-group -->
      </div>
    </div>
  </div>
  <div id="map"></div>
</section>