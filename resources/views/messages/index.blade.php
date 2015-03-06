@section('content')
  <h1 class="page-header">All messages:</h1>
  <div id="messages">
    {{-- renders app/views/messages/_message.blade.php for each message --}}
    @foreach ($messages as $message)
      @include('messages._message')
    @endforeach
  </div>

	{!!
    Button::success('Add a message')->withAttributes([
      'id' => 'create_message_link',
      'data-remote' => true,
      'data-disable-with' => "Loading...",
    ])->asLinkTo(route('messages.create'))
    ->large()->prependIcon(Icon::plus_circle())
  !!}
@stop
