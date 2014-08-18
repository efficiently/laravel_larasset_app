// Use jQuery in no conflict mode
(function($) {

  // Check if the current Web browser supports touch events
  // Source: https://github.com/Modernizr/Modernizr/blob/7bf3046835e4c97e1d5e98f6933288b80e8e7cb8/feature-detects/touchevents.js#L40
  var touchSupport = ('ontouchstart' in window) || navigator.msMaxTouchPoints || (window.DocumentTouch && document instanceof DocumentTouch);

  // iOS fix for position fixed elements on input focus (virtual keyboard visible)
  // Source: http://dansajin.com/2012/12/07/fix-position-fixed/
  if (touchSupport) {
    $(document).on('focus', 'textarea,input,select', function(e) {
      $('.navbar.navbar-fixed-top').css('position', 'absolute');
    }).on('blur', 'textarea,input,select', function(e) {
      $('.navbar.navbar-fixed-top').css('position', 'fixed');

      // Fix for some scenarios where you need to start scrolling
      setTimeout(function() {
        $(document).scrollTop($(document).scrollTop());
      }, 1);
    });
  }

})(jQuery);
