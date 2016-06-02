var vendorFilter = {
  form: $('#filter-form'),
  resultEl: $('.mob-filter-results'),
  init: function() {
    vendorFilter.changeFilterOptionAction();
    vendorFilter.locationAutocomplete();
    vendorFilter.submitFilter();
    vendorFilter.locationRadius();
  },
  changeFilterOptionAction: function() {

  },
  locationRadius: function() {
    var rangeSlider = document.getElementById('range-slider');
    if (rangeSlider && !rangeSlider.noUiSlider) {
      noUiSlider.create(rangeSlider, {
        start: 0,
        step: 5,
        range: {
          'min': 0,
          'max': 100
        }
      });
      rangeSlider.noUiSlider.on('update', function(value){
      	$('#search-distance').val(parseInt(value));
      });
    }
  },
  locationAutocomplete: function() {
    var locEl = document.getElementById('filter-location');
    if (locEl) {
      var autocomplete = new google.maps.places.Autocomplete(locEl);
      autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        var selectedPlace = vendorFilter.getPlaceType(place.address_components[0].types[0]) + '_' + place.geometry.location.lat() + '_' + place.geometry.location.lng();
        $('#search-cordinates').val(selectedPlace);
        console.log(place);
        $('.selected-location', vendorFilter.form).text(place.name);
      });
    }
  },
  submitFilter: function() {
    vendorFilter.form.bind('submit', function() {
      vendorFilter.getVendorList();
      return false;
    });
  },
  getVendorList: function() {
    $.ajax({
      url: 'filter',
      type: 'POST',
      data: vendorFilter.form.serialize(),
      success: function(html) {
        vendorFilter.resultEl.html(html);
      },
      error: function() {

      }
    });
  },
  getPlaceType: function(value) {
    if (value !== '') {
      if (value.indexOf('sublocality') > -1)
        return 'locality';
      else if (value.indexOf('locality') > -1)
        return 'city';
    }
  }
};
$(document).ready(function() {
  vendorFilter.init();
});
