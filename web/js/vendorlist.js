var vendorFilter = {
  form: $('#filter-form'),
  resultEl: $('.mob-filter-results'),
  init: function(){
    vendorFilter.submitFilter();
  },
  submitFilter: function() {
    vendorFilter.form.bind('submit', function(){
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
