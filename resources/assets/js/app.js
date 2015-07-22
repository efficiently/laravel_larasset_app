// This is a manifest file that'll be compiled into app.js, which will include all the files
// listed below.
//
// Any JavaScript/Coffee file within this directory, lib/assets/js, provider/assets/js,
// or provider/assets/js of packages, if any, can be referenced here using a relative path.
//
// It's not advisable to add code directly here, but if you do, it'll appear in whatever order it
// gets included (e.g. say you have require_tree . then the code will appear after all the directories
// but before any files alphabetically greater than 'app.js'
//
// Read Mincer README (https://github.com/nodeca/mincer#mincer-directives) for details
// about supported directives.
//
//= require jquery
//= require jquery.turbolinks
//= require jquery_ujs
//= require bootstrap_ujs
//= require_tree .
//= require turbolinks

if (typeof Turbolinks !== 'undefined' && Turbolinks) {
  if (typeof Turbolinks.enableProgressBar === 'function') {
    Turbolinks.enableProgressBar();
  }
}