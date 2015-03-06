<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	{!! csrf_meta_tags() !!}

	<title>Laravel and Larasset Quickstart</title>

  {!! stylesheet_link_tag('app') !!}
  <!--[if IE 8]>
    {!! javascript_include_tag('compat/respond') !!}
  <![endif]-->
  <!--[if lte IE 8]>
    {{-- Le HTML5 shim, for IE6-8 support of HTML elements --}}
    {!! javascript_include_tag('compat/html5shiv') !!}
    {{-- IE 8 native JSON.parse function is sometimes buggy. E.g. when using a reviver function. Source: http://stackoverflow.com/a/9212073 --}}
    <script type="text/javascript">
      if (typeof JSON !== 'undefined') { JSON.parse = null; }
    </script>
    {!! javascript_include_tag('compat/json2') !!}
    {!! javascript_include_tag('compat/es5.array.reduce') !!}
  <![endif]-->

  {{-- Size should be 32 x 32 pixels --}}
  {{-- favicon_link_tag('favicon.ico', ['rel' => 'shortcut icon') --}}
	{!! javascript_include_tag('app') !!}
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ url('/') }}">Larasset demo</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ route('messages.index') }}">Messages</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
						<li><a href="{{ url('/auth/register') }}">Register</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	<div class="container">
    {{-- check for flash notification messages --}}
		@foreach (['info', 'success', 'warning', 'danger'] as $level)
			<?php $sessionLevel = $level === 'danger' ? 'error' : $level; // 'danger' means 'error' for Bootstrap ?>
			{!! Alert::{$level}(Session::get($sessionLevel))->withAttributes(['data-alert' => 'alert', 'class' => (Session::has($sessionLevel)) ? 'fade in' : 'fade in hidden'])->close() !!}
			<?php Session::forget($sessionLevel); ?>
    @endforeach

    <section id="content">
      @yield('content')
    </section>{{-- /content --}}
  </div>{{-- /container --}}

</body>
</html>
