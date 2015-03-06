@extends('app')

@section('content')
	<div class="jumbotron">
		<h1>Welcome to the {!! link_to('https://github.com/efficiently/larasset', "Larasset", ['target' => '_blank']) !!} demo!</h1>
	  	<p>The Ultimate Front-End tool for {!! link_to('http://laravel.com', "Laravel", ['target' => '_blank']) !!}!</p>
	  	<p>
				{!!
			    Button::primary('Try it!')->asLinkTo(route('messages.index'))
			    ->large()->prependIcon(Icon::hand_o_right())
			  !!}
			</p>
	</div>
@stop
