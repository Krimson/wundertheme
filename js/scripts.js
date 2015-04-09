;(function($, D, window) {

D.behaviors.initCycle = {
  attach: function(context) {
    $('.field-name-field-carousel-item > .field-items', context).once('initCycle').each(this.init);
  },
  init: function(i, el) {
    var $this = $(this);
    $this.append('<div class="slideshow-pager"></div>');
    $this.cycle({
      slides: '> .field-item',
      autoHeight: 'container',
      pager: '> .slideshow-pager'
    });
  }
};

D.behaviors.takeOverPage = {
  attach: function(context) {
    $('#block-wundertheme-sitetakeoverbypass .field a', context).once('takeOverPage').on('click', this.handler);
  },
  handler: function(e) {
    $.cookie('takeover_bypass', '1', { expires: 1, path: '/' });
  }
};

D.behaviors.propagateClicks = {
  attach: function(context) {
    $('.event-teaser', context).once('propagateClicks').on('click', function(e) {
      var $this = $(e.target);
      if (!$this.is('a') && !$this.is('button') && $this.closest('a').length === 0) {
        $this.find('a')[0].click();
      }
    });
  }
};

})(jQuery, Drupal, this);
