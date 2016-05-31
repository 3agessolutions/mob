var vendorFilter = {
  form: $('#filter-form'),
  resultEl: $('.mob-filter-results'),
  init: function() {
    vendorFilter.changeFilterOptionAction();
    vendorFilter.locationAutocomplete();
    vendorFilter.submitFilter();
  },
  changeFilterOptionAction: function() {
    // $('input[type="radio"]', vendorFilter.form).bind('click', function(evt) {
    //     if(!this.checked)
    //       this.checked = !this.checked;
    // });
  },
  locationAutocomplete: function() {
    var locEl = document.getElementById('filter-location');
    var autocomplete = new google.maps.places.Autocomplete(locEl);
    autocomplete.addListener('place_changed', function() {
      var place = autocomplete.getPlace();
      console.log(place);
      $('#search-cordinates').val(place.geometry.location.lat() + '_' + place.geometry.location.lng());
    });
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
  }
};
$(document).ready(function() {
  vendorFilter.init();
});
