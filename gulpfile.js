var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.less('app.less');
});

/*
 |--------------------------------------------------------------------------
 | Assets Reloading with LiveReload
 |--------------------------------------------------------------------------
 |
 | Installation:
 |   npm install --global gulp
 |   npm install --save-dev gulp-livereload && npm install
 |
 | Usage:
 |   gulp livereload
 */

var gulp = require('gulp');
var livereload = require('gulp-livereload');

var host = 'http://localhost';
var port = 3000;
var assetPrefix = '/assets';
var larassetUrl = host + (port ? ':' + port : '') + assetPrefix;

gulp.task('livereload', function() {
  livereload({start: true});

  var livereloadPage = function() {
    // Reload the whole page
    livereload.reload();
  };

  gulp.watch('resources/views/**/*.blade.php', livereloadPage);
  gulp.watch('resources/lang/**/*.php', livereloadPage);

  // Static files
  gulp.watch('public/**/*.+(css|js|html|gif|ico|jpg|jpeg|png)', function(event) {
    var filePath = event.path.replace(/\\/g, '/').replace(new RegExp('^(.*/)?public(/(.+))$'), '$2');
    livereload.changed(filePath);
  });

  // Images files in assets paths
  gulp.watch('{{resources,lib,provider},{vendor,workbench}/*/*/{resources,lib,provider}}/assets/images/**/*.+(gif|ico|jpg|jpeg|png)', function(event) {
    var filePath = event.path.replace(/\\/g, '/').replace(new RegExp('^(.*)?' + assetPrefix + '/images(/(.+))$'), '$2');
    livereload.changed(larassetUrl + filePath);
  });

  // JavaScript files in assets paths
  gulp.watch('{{resources,lib,provider},{vendor,workbench}/*/*/{resources,lib,provider}}/assets/{js,javascripts}/**/*.+(js|coffee|ts|ejs)', function(event) {
    var filePath = event.path.replace(/\\/g, '/');
    var pattern = new RegExp('resources/assets/(.+?)((\.js)?(\.(coffee|ts))?)(\.ejs)?$');
    var m = filePath.match(pattern);
    if (m && m[1] && m[2]) {
      livereload.changed(larassetUrl + '/app.js');
    }
  });

  // StyleSheets files in assets paths
  gulp.watch('{{resources,lib,provider},{vendor,workbench}/*/*/{resources,lib,provider}}/assets/{css,stylesheets}/**/*.+(css|less|sass|scss|styl|ejs)', function(event) {
    var filePath = event.path.replace(/\\/g, '/');
    var pattern = new RegExp('resources/assets/(.+?)((\.css)?(\.(less|s[ac]ss|styl))?)(\.ejs)?$');
    var m = filePath.match(pattern);
    if (m && m[1] && m[2]) {
      livereload.changed(larassetUrl + '/app.css');
    }
  });
});
