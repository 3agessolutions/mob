var mob = {
  init: function() {
    //mob.showLoader();
    //mob.common();
    mob.hideLoader();
    // vendorFilter.init();
  },
  showLoader: function() {
    $('#loader').show();
  },
  hideLoader: function() {
    $('#loader').hide();
  },
  initmap: function() {
    mob.hideLoader();
    mob.autoComplete();
    //mob.getCurrentAddress(13.082237193469926,80.27544602751732);
  },
  getCurrentAddress: function(lat, lng) {
    $.ajax({
      url: 'http://maps.googleapis.com/maps/api/geocode/json?latlng=' + lat + ',' + lng + '&sensor=true',
      success: function(data) {
        var results = data.results;
        if (results.length > 0) {
          for (var i = 0; i < results[0].address_components.length; i++) {
            for (var b = 0; b < results[0].address_components[i].types.length; b++) {
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
  },
  common: function() {
    $('#mob-input-city').bind('change', function(){
      $('#form-city').submit();
    });
  },
  autoComplete: function() {
    var cityInput = document.getElementById('mob-input-city');
    var autocomplete = new google.maps.places.Autocomplete(cityInput);
    autocomplete.addListener('place_changed', function() {
      var place = autocomplete.getPlace();
      for(var i = 0; i < place.address_components.length; i++) {
        for(var j = 0; j < place.address_components[i].types.length; j++) {
          if(place.address_components[i].types[j] ==  "administrative_area_level_2") {
            cityInput.value = place.address_components[i].long_name;
          }
        }
      }
    });
  }
};
$(document).ready(function(){
  mob.init();
});
