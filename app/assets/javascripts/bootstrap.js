//= require twitter/bootstrap
// Use jQuery in no conflict mode
(function($) {
  // DOM ready
  $(function() {
    $("a[rel~=popover], .has-popover").popover();
    $("a[rel~=tooltip], .has-tooltip").tooltip();

  });
})(jQuery);
