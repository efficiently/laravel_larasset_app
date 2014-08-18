@section('content')
	<div class="jumbotron">
		<h1>Welcome to the {{ link_to('https://github.com/efficiently/larasset', "Larasset", ['target' => '_blank']) }} demo!</h1>
	  	<p>The Ultimate Front-End tool for {{ link_to('http://laravel.com', "Laravel", ['target' => '_blank']) }}!</p>
	  	<p>{{ Button::lg_primary_link(route('messages.index'), "Try it!")->with_icon('hand-o-right') }}</p>
	</div>
@stop
