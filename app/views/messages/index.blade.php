@section('content')
    <h1 class="page-header">All messages</h1>
    <div id="messages">
        {{-- renders app/views/messages/_message.blade.php for each message --}}
        @foreach ($messages as $message)
            @include('messages._message')
        @endforeach
    </div>

    {{
      Button::lg_success_link(route('messages.create'), 'Add a message', [
        'id' => 'create_message_link', 'data-remote' => true
      ])->with_icon('plus-circle')
    }}
@stop
