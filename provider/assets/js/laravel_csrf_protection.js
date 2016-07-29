// Use jQuery in no conflict mode
(function($) {

  // Making sure that all forms have actual up-to-date token(cached forms contain old one)
  // Some Server-side frameworks like Laravel need this.
  // If your application use `turbolinks` library
  // You should add this on every `turbolinks:load` event,
  // Otherwise use `$(document).ready(function () { /* ... */ });` or `$(function () { /* ... */ });`
  var refreshForms = function() {
    var tag = $(document).find('meta[name="csrf-token"]');
    if (!tag || tag.length === 0) {
      tag = $(document).filter('meta[name="csrf-token"]');
    }

    var param = $(document).find('meta[name="csrf-param"]');
    if (!param || param.length === 0) {
      param = $(document).filter('meta[name="csrf-param"]');
    }
    var current = {
      node: tag,
      token: tag.attr('content'),
      param: param.attr('content')
    };

    $('form input[name="' + current.param + '"]').val(current.token);
  };

  if (typeof Turbolinks !== 'undefined' && Turbolinks) {
    // For Turbolinks event
    $(document).on('turbolinks:load', function(event) {
      refreshForms();
    });
  } else {
    // DOM ready
    $(function() {
      refreshForms();
    });
  }

})(jQuery);
