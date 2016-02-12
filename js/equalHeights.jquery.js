/**
 * @file
 * Provides the js for equal heighten the news teasers.
 */

;(function ($) {

  $.fn.equalHeights = function(smallest){
    var largest = 0;
    this.css('height', '').each(function() {
      var height = $(this).outerHeight();
      if (!smallest) {
        if(height > largest) largest = height;
      }
      else {
        if (height < largest || largest === 0) largest = height;
      }
    });
    return this.each(function() {
      var $this = $(this),
          extra = $this.outerHeight() - $this.height();
      $this.height(largest - extra);
    });
  };

  $.fn.wrapEach = function(el, num) {
    for (var i = 0; i < this.length; i += num) {
      this.slice(i, i + num).wrapAll(el);
    }
    return this;
  };

})(jQuery);
