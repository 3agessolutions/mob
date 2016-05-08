/*!
 * jQuery lightweight plugin boilerplate
 * Original author: @ajpiano
 * Further changes, comments: @addyosmani
 * Licensed under the MIT license
 */

;
(function($, window, document, undefined) {

  // Create the defaults once
  var defaults = {};

  // The actual plugin constructor
  function DataGrid(element, options) {
    this.element = element;
    this.$element = $(this.element);
    this.options = $.extend({}, defaults, options);
    this.init();
  }

  DataGrid.prototype = {
    init: function() {
      this.rowIndex = 1;
      this.$element.html(this.createHTML());
      this.formSubmit();
    },
    createHTML: function() {
      var html = '<form action="' + this.options.action + '" method="' + this.options.method + '">';
      html += '<input type="hidden" name="id" value="' + this.options.categoryId + '"/>';
      html += '<div class="grid-header">';
      html += '<div class="grid-col">Property</div><div class="grid-col">Data Type</div><div class="grid-col">Value</div><div class="grid-col grid-act"></div>';
      html += '</div>';
      html += '<div class="grid-body">';
      html += this.rowHTML();
      html += '</div>';
      html += '<div class="grid-footer"><button type="submit" class="btn btn-primary">Submit</button></div>'
      html += '</form>';
      return html;
    },
    rowHTML: function() {
      var html = '';
      html += '<div class="grid-row">';
      // html += '<div class="grid-col">' + this.rowIndex + '</div>';
      html += '<div class="grid-col"><input type="" name="category_property[]" value=""/></div>';
      html += '<div class="grid-col">';
      html += '<select name="category_data_type[]">';
      html += '<option value="T">Text</option>';
      html += '<option value="I">Number</option>';
      html += '<option value="C">Choice</option>';
      html += '<option value="R">Radio</option>';
      html += '</select>';
      html += '</div>';
      html += '<div class="grid-col"><input type="" name="category_value[]" value=""/></div>';
      html += '<div class="grid-col grid-act"><a href="#" title="Add new row"><i class="fa fa-plus"></i></a></div>';
      html += '</div>';
      return html;
    },
    addRow: function() {
      this.rowIndex = this.rowIndex + 1;
      this.changeStatus();
      $('.grid-body', this.$element).append(this.rowHTML());
    },
    changeStatus: function() {
      $('.grid-row .grid-act', this.$element).html('<a href="#" title="Delete"><i class="fa fa-minus"></i></a>');
    },
    formSubmit: function() {
      var self = this;
      this.$element.on('click', '.grid-act a', function() {
        if ($(this).attr('title') == 'Delete') {
          $(this).parents('.grid-row').eq(0).remove();
        } else {
          self.addRow();
        }
        return false;
      });
      this.$element.on('click', '.grid-act a', function() {

        return false;
      });
      $('form', this.$element).bind('submit', function() {
        //return false;
        $.ajax({
          url: self.options.action,
          type: 'POST',
          data: $(this).serialize(),
          success: function(data) {
            if(self.options.success)
              self.options.success(data);
          },
          error: function() {
            if(self.options.error)
              self.options.success(data);
          }
        });
        return false;
      });
    }
  };

  $.fn.dataGrid = function(options) {
    return this.each(function() {
      if (!$.data(this, "mob_datagrid")) {
        $.data(this, "mob_datagrid",
          new DataGrid(this, options));
      }
    });
  };

})(jQuery, window, document);
