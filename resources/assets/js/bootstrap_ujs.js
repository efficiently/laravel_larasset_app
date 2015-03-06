//= require twitter/bootstrap

// Use jQuery in no conflict mode
(function($) {
  // DOM ready
  $(function() {
    $('a[rel~=popover], .has-popover').popover();
    $('a[rel~=tooltip], .has-tooltip').tooltip();

    // $('div.bootstrap-modal').modal();
    // $('div.bootstrap-modal').modal('hide').addClass('fade');

    // $("a.bootstrap-modal-cancel-button").click(function(event) {
    //  $(event.target).closest("div.modal").modal("hide");
    // });

  });
})(jQuery);
