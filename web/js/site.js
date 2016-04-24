var mob = {
  init: function(){
    mob.showLoader();
  },
  showLoader: function() {
    $('#loader').show();
  },
  hideLoader: function() {
    $('#loader').hide();
  },
  initmap: function() {
    // if(navigator.geolocation) {
    //     navigator.geolocation.getCurrentPosition(function(pos){
    //       mob.getCurrentAddress(pos.coords.latitude, pos.coords.longitude);
    //       //getCurrentAddress(11.350972915344155, 77.72875294089317);
    //     }, function(err){
    //       mob.hideLoader();
    //       console.warn('ERROR(' + err.code + '): ' + err.message);
    //     }, {  enableHighAccuracy: true, timeout: 5000, maximumAge: 0});
    // }
    mob.getCurrentAddress(13.082237193469926,80.27544602751732);
  },
  getCurrentAddress: function(lat, lng) {
    $.ajax({ url:'http://maps.googleapis.com/maps/api/geocode/json?latlng=' + lat + ','+ lng +'&sensor=true',
      success: function(data) {
          var results = data.results;
          if (results.length > 0) {
            for (var i=0; i<results[0].address_components.length; i++) {
              for (var b=0;b<results[0].address_components[i].types.length;b++) {
                if (results[0].address_components[i].types[b] == "administrative_area_level_2") {
                  $('#mob-input-city').val(results[0].address_components[i].long_name);
                  break;
                }
              }
            }
          }
          mob.hideLoader();
      }
    });
  }
};
