<html>
    <head>
        <title>Laravel and Larasset Quickstart</title>
        {{ javascript_include_tag('application') }}
        {{ csrf_meta_tags() }}
    </head>
    <body>        
        @yield('content')
    </body>
</html>
