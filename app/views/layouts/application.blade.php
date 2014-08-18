<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{ csrf_meta_tags() }}

    <title>Laravel and Larasset Quickstart</title>

    {{ stylesheet_link_tag('application') }}
    <!--[if IE 8]>
      {{ javascript_include_tag('compat/respond') }}
    <![endif]-->
    <!--[if lte IE 8]>
        {{-- Le HTML5 shim, for IE6-8 support of HTML elements --}}
        {{ javascript_include_tag('compat/html5shiv') }}
        {{-- IE 8 native JSON.parse function is sometimes buggy. E.g. when using a reviver function. Source: http://stackoverflow.com/a/9212073 --}}
        <script type="text/javascript">
            if (typeof JSON !== 'undefined') { JSON.parse = null; }
        </script>
        {{ javascript_include_tag('compat/json2') }}
        {{ javascript_include_tag('compat/es5.array.reduce') }}
    <![endif]-->

    {{-- Size should be 32 x 32 pixels --}}
    {{-- favicon_link_tag('favicon.ico', ['rel' => 'shortcut icon']) --}}

    {{ javascript_include_tag('application') }}
  </head>
  <body>
    <div class="navbar navbar-fixed-top navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse">
            <span class="sr-only">Show navigation menu</span>
            <span class="glyphicon glyphicon-bars"></span>
          </button>
          {{ link_to(route('home'), "Larasset demo", ['class' => 'navbar-brand']) }}
        </div>{{-- /.navbar-header --}}

        <div class="collapse navbar-collapse">
          <ul id="operation_header" class="nav navbar-nav">
            <li>{{ link_to_route("messages.index", "Messages") }}</li>
          </ul>
        </div>{{-- /.navbar-collapse --}}

      </div>{{-- /container --}}

    </div>{{-- /.navbar-fixed-top --}}

    <div class="container">
      {{-- check for flash notification messages --}}
      @foreach (['info', 'success', 'warning', 'danger', 'error'] as $level)
        {{ Alert::{$level}( Session::get($level), ['data-alert' => 'alert', 'class' => (Session::has($level)) ? 'fade in' : 'fade in hidden'] ) }}
        <?php Session::forget($level); ?>
      @endforeach

      <section id="content">
        @yield('content')
      </section>{{-- /content --}}
    </div>{{-- /container --}}
  </body>
</html>
